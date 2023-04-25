<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Fluent;

use Mail;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Accept;
use App\Models\MailTemplate;
use App\Mail\ReturnAccepted;

abstract class Front1Controller extends FrontBaseController
{

    function __construct() {
        parent::__construct();

		$this->init();
    }

    // validation 1
    protected function _validation(Request $request)
    {
        // Return_first::_set_validation(), order_id_check() 参照
        $validator = Validator::make($request->all(), [
            // オーダID存在チェック
            'order_id' => [['required','numeric'], function($attribute, $value, $fail) {
                $orderModel = new Order();
                if (! $orderModel->existsOrderId($value)) {
                    return $fail('オーダIDを確認してください。');
                }
            }],
            // 電話番号整合性チェック
            'tel' => ['required','numeric'],
            // メールアドレスチェック
            'email' => ['required','email'],
            'email2' => ['required','email'],
        ]);

        // オーダIDと電話番号の整合性チェック
        $validator->after(function($validator) use($request) {
            $orderModel = new Order();
            if (! $orderModel->existsOrderIdTel($request->order_id, $request->tel)) {
                $validator->errors()->add('tel', 'オーダＩＤと注文者電話番号が一致しません。');
            }
        });

        // インポートからの経過日数
        $validator->after(function($validator) use($request) {
            $orderModel = new Order();
            if (! $orderModel->expiredForChange($request->order_id, 21)) {
                $validator->errors()->add('order_id', 'オーダＩＤは出荷から日数が経過しているのでWebサイトからお申込みいただけません。コールセンターにお問い合わせください。');
            }    
        });

        // 返品・交換済みのオーダ
        $validator->after(function($validator) use($request) {
            $acceptModel = new Accept();
            if ($acceptModel->alreadyReturned($request->order_id)) {
                $validator->errors()->add('order_id', 'オーダＩＤは、すでに交換や返品を承っております。コールセンターにお問い合わせください。');
            }    
        });

        // 返品・交換可能なオーダ明細はあるか
        $validator->after(function($validator) use($request) {
            $orderDetailModel = new OrderDetail();
            if (! $orderDetailModel->existsReturnable($request->order_id)) {
                $validator->errors()->add('order_id', '大変申し訳ありません。お客様がご注文された商品は、返品・交換の対応ができません。');
            }    
        });

        // email 同一チェック
        $validator->after(function($validator) use($request) {
            if ($request->email <> $request->email2) {
                $validator->errors()->add('mail', 'メールアドレスが確認用メールアドレスと一致しません');
            }    
        });

        $validated = $validator->validate();
    }

    protected function _genPassword()
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $length = 12;
        $random_string = '';
        for ($i = 0; $i < $length; $i++) {
          $random_int = random_int(0, strlen($characters) - 1);
          $random_string .= $characters[$random_int];
        }
        return $random_string;    
    }

    // 受付レコード作成
    protected function _createAccept($order, $request, $pwd)
    {
        $acceptModel = new Accept();
        $accept = $acceptModel->create([
            'order_id'                  => $request->order_id,
            'email'                     => $request->email,
            'password'                  => $pwd,
            'name'                      => $order->order_name,
            'login_id'                  => md5(uniqid()),
            'request_content_class'     => $this->request_content_class,
            'date_added'                => date('Y-m-d\TH:i:sP'),
            'last_modified'             => date('Y-m-d\TH:i:sP'),
            't_register'                => $request->ip(),
            'u_register'                => $request->ip(),

            'shipping_tel'              => $order->shipping_tel,
            'shipping_name'             => $order->shipping_name,
            'date_dl_history'           => date('Y-m-d\TH:i:sP', strtotime('0')),
            'p_arrangement_order_id'    => '',
            'comment_irai'              => '',
        ]);
        return $accept;
    }

    // メール送信用データ作成
    protected function _generateMailData($order, $accept, &$mailData)
    {
        $mailReplaceTable = [
            "##date##"          => strftime('%Y/%m/%d'),
            "##date time##"     => strftime('%Y/%m/%d %H:%M'),
            "##site_url##"      => url('/', null, true),
            "##password##"      => $accept->password,
            "##name##"          => $order->order_name,
            "##confirmation_url##"     => $this->regMail_login_url . $accept->login_id,
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

    // POST
	public function reg(Request $request)
    {
        // 入力チェック
        $this->_validation($request);

        // ログイン用パスワード生成
        $pwd = $this->_genPassword();

        // 対象オーダ レコード 取得
        $orderModel = new Order();
        $order = $orderModel->getbyOrderId($request->order_id);

        // 受付レコード作成
        $accept = $this->_createAccept($order, $request, $pwd);

        // メールデータ作成
        $mailData = []; 
        $this->_generateMailData($order, $accept, $mailData);

        // メール送信
        $Mailer = new ReturnAccepted($mailData);
        Mail::to($request->email)->send($Mailer);

        return $pwd;
    }

}