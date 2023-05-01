<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Fluent;
use Illuminate\Support\Facades\Session;

use Mail;

use App\Http\Controllers\ImageBarCodeController;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Accept;
use App\Models\AcceptDetail;
use App\Models\MailTemplate;
use App\Models\PickupTime;
use App\Models\BusinessDay;
use App\Mail\ReturnAccepted;

abstract class Front2Controller extends FrontBaseController
{
    protected $accept;
    protected $order;
    protected $orderDetails;
    protected $pickupTimes;
    protected $pickupDays;

    function __construct() {
        parent::__construct();

		$this->init();
    }

    // 2nd ログインチェック
    protected function _chk_login()
    {
        return (Session::get('Loginsts_ft') == 'ok' && (! empty(Session::get('ft_id'))));
    }

    // 年月日８桁数字から日付表示
    //  yyyy/mm/dd 編集           
    protected function show_ymd8_kanji($date)
    {
        if($date > 0){
            $y =substr($date, 0, 4);
            $m =substr($date, 4, 2);
            $d =substr($date, 6, 2);

            return $y."年".(int)$m."月".(int)$d."日　　";
        }

        return "";
    }	


    // validation 2
    protected function _validation(Request $request, $select)
    {

        // OrderDetail レコード
        $orderDetailModel = new OrderDetail();
        $orderDetails = $orderDetailModel->getByOrderId(Session::get('ft_order_id'));
        $orderDetailArray = [];
        foreach($orderDetails as $orderDetail)
        {
            $orderDetailArray[$orderDetail->row_no] = $orderDetail;
        }

        $rules = [];
        
        // Return_second::_set_validation(), order_id_check() 参照
        // オーダID存在チェック
        $rules['order_id'] = 'required|numeric';

        // 登録 reg() でない、かつ、お客様都合返品でない
        if(($this->method != 'reg') && ($request['select'] != 4))
        {
            $rules['post1'] = 'required|numeric';
            $rules['post2'] = 'required|numeric';
        }
        if($request['select'] != 4)
        {
            $rules['address'] = 'required';
            $rules['shipping_tel'] = 'required';
            $rules['shipping_name'] = 'required';
        }

        // 理由
        $rules['comment'] = ['required'];

        // クレーム返品、または、サイズ交換はピックアップあり
        if(($request['select'] == 2) || ($request['select'] == 3))
        {
            $rules['pickup_date'] = ['required','numeric'];
            $rules['pickup_time'] = ['required','numeric'];
        }

        $validator = Validator::make($request->all(),
            $rules,
        );

        $validated = $validator->validate();

        // オーダID存在チェック
        $validator->after(function($validator) use($request) {
            $orderModel = new Order();
            if (! $orderModel->existsOrderId($request->order_id)) {
                $validator->errors()->add('order_id', 'オーダIDを確認してください。');
            }
        });

        $total_price = 0;
        $umo=0;
        $hasError = false;
        foreach ($request->input() as $key => $in) {
            $h = mb_substr($key, 0, 2);
            if($h != "s_")  continue;    // 数量以外は見ない

            $tmp = explode("_", $key);
            if($in == 0 || (! $in)) continue;   // 返品・交換 数量 0

            if($in != -1)   // 数量が選択されて 0 でない
            {
                $umo++;
                $total_price += $request->input()["s_" . $tmp[1]] * $orderDetailArray[$tmp[1]]->unit_price;  // 2018/09/17
                continue;
            }

            // 返品・交換 数量 0 以外が手入力された
            if((! $request->input()["t_" . $tmp[1]]) || ($request->input()["t_" . $tmp[1]] < 0))
            {
                $validator->errors()->add("t_" . $tmp[1], 'No.' . $tmp[1] . ' の数量を入力してください。');
                $hasError = true;
                continue;
            }

            // if(ereg("^[0-9]+$", $this->input->post("t_".$tmp[1]))){  2018/06/11
            if(! preg_match("/^[0-9]+$/", $request->input()["t_" . $tmp[1]]))
            {
                $validator->errors()->add("t_" . $tmp[1], 'No.' . $tmp[1] . ' は数字を入力してください。');
                $hasError = true;
                continue;
            }
    
            if($orderDetailArray[$tmp[1]]->amount < $request->input()["t_" . $tmp[1]])
            {
                $validator->errors()->add("t_" . $tmp[1], 'No.' . $tmp[1] . ' は購入数量を超えています。');
                $hasError = true;
                continue;
            }

            $umo++;
            $total_price += $request->input()["s_" . $tmp[1]] * $orderDetailArray[$tmp[1]]->unit_price;  // 2018/09/05
        }

        if($umo == 0){
            $validator->errors()->add("t_", '対象商品の数量を入力してください。');
            $hasError = true;
        }
        if($total_price > 100000) { // 2018/09/05
            $validator->errors()->add("t_", '返品金額の合計金額が高額となる為、本システムでは受付出来ません。コールセンターまでお問合せ下さい。');
            $hasError = true;
        }

        return $hasError ? $validator : null;
    }

    protected function _RegenerateAcceptDetail(Request $request, $select)
    {
        // 既存明細レコード削除
        $acceptDetailModel = new AcceptDetail();
        $acceptDetailModel->where('accept_id', Session::get('ft_id'))->delete();

        $returns = $this->_get_returns($request);   // 返品・交換対象
        $orderDetailModel = new OrderDetail();
        foreach($returns as $row_no => $amount)
        {
            // OrderDetail レコード
            $orderDetail = $orderDetailModel->firstByOrderIdRowNo(Session::get('ft_order_id'), $row_no);
            $acceptDetailModel->createFromOrderDetail(
                Session::get('ft_id'),
                $orderDetail,
                $select,
                $amount
            );

        }
    }

    // メール送信用データ作成
    protected function _generateMailData(Request $request, $order, $accept, &$mailData)
    {
        $returns =$this->_get_returns($request);
        $pickupTimeModel = new PickupTime();
        $pickup_time_array = $pickupTimeModel->getListbox();

        $pickup_datetime = '';
        if(! empty($accept->pickup_date))
        {
            $pickup_datetime = "【集荷日時】\n "
             . $this->show_ymd8_kanji($accept->pickup_date)
             . "　"
             . $pickup_time_array[$accept->pickup_time]
             ;
        }

        $orderDetailModel = new OrderDetail();
        $orderDetails = $orderDetailModel->getByOrderId($order->order_id);
        $orderDetailArray = [];
        foreach($orderDetails as $orderDetail)
        {
            $orderDetailArray[$orderDetail->row_no] = $orderDetail;
        }
        $product_info = '';
        foreach($returns as $no => $val){
            $product_info = $product_info . $orderDetailArray[$no]->product_nm . " 数量： " . $val . "\n";
        }


        $mailReplaceTable = [
            "##date##" =>  strftime('%Y/%m/%d'),
            "##date time##" =>strftime('%Y/%m/%d %H:%M'),
            "##accept_no##" =>$accept->accept_no,
            "##order_id##" =>$accept->order_id,
            "##name##" =>$accept->name,
            "##email##" =>$accept->email,
            "##comment##" => $accept->comment,
            "##request_method##" => config('config.request_method')[$accept->request_content_class],
            "##post##" =>$accept->post,
            "##address##" =>$accept->address,
            "##company##" =>$accept->company,      // 2018/09/05
            "##division##" =>$accept->division,
            "##shipping_tel##" =>$accept->shipping_tel,
            "##shipping_name##" =>$accept->shipping_name,
            "##pickup_datetime##" =>$pickup_datetime,
            "##product_info##" =>$product_info,
        ];

        $source = array_keys($mailReplaceTable);
        $destination = array_values($mailReplaceTable);

        // メールテンプレートを取得する
        $mailtemplateModel = new MailTemplate();
        $mailtemplate = $mailtemplateModel->findByMailId($this->mail_id);

        //body
        $mail_body = str_replace($source, $destination, $mailtemplate->body);
        $mailData['body'] = $mail_body;

        //from_name
        $mail_from_name = str_replace($source, $destination, $mailtemplate->from_name);
        $mailData['from_name'] = $mail_from_name;

        //from_mail
        $mail_from_email = str_replace($source, $destination, $mailtemplate->from_mail);
        $mailData['from_email'] = $mail_from_email;

        // bcc
        $pieces = explode("\n", $mailtemplate->bcc);
        $bcc_str=implode( ",", $pieces );
        $mailData['bcc'] = $bcc_str;

        //subject
        $subject = str_replace($source, $destination, $mailtemplate["subject"]);
        $mail_subject = str_replace($source, $destination, $mailtemplate->subject);
        $mailData['subject'] = $mail_subject;
    }

    public function init()
    {
		
    }

    // 入力フォームの準備
    protected function _entry($urlController, $select) {
        // Accept レコード
        $acceptModel = new Accept();
        $this->accept = $acceptModel->firstById(Session::get('ft_id'));

        // Order レコード
        $orderModel = new Order();
        $this->order = $orderModel->getByOrderId(Session::get('ft_order_id'));

        // OrderDetail レコード
        $orderDetailModel = new OrderDetail();
        $this->orderDetails = $orderDetailModel->getByOrderId(Session::get('ft_order_id'));

        // 集荷時間帯配列を作る
        $pickupTimeModel = new PickupTime();
		$this->pickupTimes =$pickupTimeModel->getListbox();

        // 集荷日配列を作る
        $businessDayModel = new BusinessDay();
        $this->pickupDays = $businessDayModel->getListbox();

		// $data["request_method_array"] = $this->config->item('request_method','config');
		// $data["returns"] =$this->_get_returns();

        $params = [];
        $params['urlController'] = $urlController;
        $params['select'] = $select;
        $params['order_id'] = Session::get('ft_order_id');
        $params['order'] = $this->order;
        $params['orderDetails'] = $this->orderDetails;
        $params['accept'] = $this->accept;
        $params['pickupDays'] = $this->pickupDays;
        $params['pickupTimes'] = $this->pickupTimes;

        return $params;
    }

    // 入力フォームの評価
    protected function _confirm(Request $request, $urlController, $select)
    {
        $validator = $this->_validation($request, $select);
        if(! is_null($validator)) {
            throw new ValidationException($validator);
        }

        $params = $this->_entry($urlController, $select);

        // OrderDetail レコード配列を作り直す
        $orderDetailModel = new OrderDetail();
        $orderDetails = $orderDetailModel->getByOrderId(Session::get('ft_order_id'));
        $confirmOrderDetails = [];
        foreach($orderDetails as $orderDetail)
        {
            $confirmOrderDetails[$orderDetail->row_no] = $orderDetail;
        }
        $params['orderDetails'] = $confirmOrderDetails;

        $params['request'] = $request;
        $params['act'] = 'reg';

        // 未登録の時
        // $data = $this->_show_post_page($data);
        // $data=$this->_set_message_confirm($data);

        return $params;
    }

    // レコード登録と受付表表示
    protected function _regist(Request $request, $urlController, $select)
    {
        // $validator = $this->_validation($request, $select);
        // if(! is_null($validator)) {
        //     return back()->withInput()->withErrors($validator);
        // }

        $params = $this->_entry($urlController, $select);

        // 受付レコード更新
        $acceptModel = new Accept();
        $acceptModel->setAcceptNo(Session::get('ft_id'));
        $accept = $acceptModel->firstById(Session::get('ft_id'));
        $accept_no = $accept->accept_no;

        $accept->post = $request->input()['post1'] . '-' . $request->input()['post2'];
        $accept->address = $request->input()['address'];
        $accept->company = $request->input()['company'];
        $accept->division = $request->input()['division'];
        $accept->pickup_date = $request->input()['pickup_date'];
        $accept->pickup_time = $request->input()['pickup_time'];
        $accept->comment = $request->input()['comment'];
        $accept->update();

        // 受付明細レコード削除と追加
        $this->_RegenerateAcceptDetail($request, $select);

        // メールデータ作成
        $mailData = []; 
        $this->_generateMailData($request, $this->order, $this->accept, $mailData);

        // メール送信
        $Mailer = new ReturnAccepted($mailData);
        Mail::to($this->accept->email)->send($Mailer);

        // バーコード
        // $params['barcode'] = \DNS1D::getBarcodeHTML($accept_no, "C39", 1, 70, 'black', 12);
        $params['barcode'] = \DNS1D::getBarcodeSVG($accept_no, "C39", 1, 70, 'black', 12);

        // 返品・交換情報
        $pickupTimeModel = new PickupTime();
        $pickup_time_array = $pickupTimeModel->getListbox();
        $returns = $this->_get_returns($request);   // 返品・交換対象
        // OrderDetail レコード
        $orderDetailModel = new OrderDetail();
        $orderDetails = $orderDetailModel->getByOrderId(Session::get('ft_order_id'));
        $orderDetailArray = [];
        foreach($orderDetails as $orderDetail)
        {
            $orderDetailArray[$orderDetail->row_no] = $orderDetail;
        }

        $params['accept'] = $accept;
        $params['order_id'] = Session::get('ft_order_id');
        $params['pickup_datetime'] = "【集荷日時】\n "
        . $this->show_ymd8_kanji($accept->pickup_date)
        . "　"
        . $pickup_time_array[$accept->pickup_time]
        ;
        $params['returns'] = $returns;
        $params['orderDetails'] = $orderDetailArray;

        return $params;
    }

}