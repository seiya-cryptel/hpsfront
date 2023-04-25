<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Fluent;
use Illuminate\Support\Facades\Session;

use Mail;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Accept;
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

    // validation 2
    protected function _validation(Request $request, $select)
    {

        // Return_second::_set_validation(), order_id_check() 参照
        // オーダID存在チェック
        $rules = [
            // オーダID存在チェック
            'order_id' => [['required','numeric'], function($attribute, $value, $fail) {
                $orderModel = new Order();
                if (! $orderModel->existsOrderId($value)) {
                    return $fail('オーダIDを確認してください。');
                }
            }],
        ];

        // 登録 reg() でない、かつ、お客様都合返品でない
        if(($this->method != 'reg') && ($request['select'] != 4))
        {
            $rules['post1'] = 'required|numeric';
            $rules['post2'] = 'required|numeric';
        }

/*

        // お客様都合返品でない
        if($request['select'] != 4)
        {
            $rules['address'] = ['required'];
            $rules['shipping_tel'] = ['required'];
            $rules['shipping_name'] = ['required'];
        }

        // 理由
        $rules['comment'] = ['required'];

        // クレーム返品、または、お客様都合返品
        if(($request['select'] == 2) || ($request['select'] == 3))
        {
            $rules['pickup_date'] = ['required','numeric'];
            $rules['pickup_time'] = ['required','numeric'];
        }
*/
        $validator = Validator::make($request->all(),
            $rules,
        );

        $validated = $validator->validate();

        // 入力 entry() でない
        $total_price = 0;
        if($this->method != 'entry')
        {
			$umo=0;
			foreach ($request as $key => $in) {
				$h = mb_substr($key, 0, 2);
				if($h == "s_")    // 数量
                {
					$tmp = explode("_", $key);
					if($in == 0 || (! $in))
                    {
                        // 返品・交換 数量 0
					}
                    else
                    {
                        // 返品・交換 数量 0 以外
						if($in == -1)
                        {
							if((! $request("t_" . $tmp[1])) || ($request("t_" . $tmp[1]) < 0))
                            {
                                $validator->errors()->add("t_" . $tmp[1], '数量を入力してください。');
							}
                            else
                            {
	    						// if(ereg("^[0-9]+$", $this->input->post("t_".$tmp[1]))){  2018/06/11
								if(preg_match("/^[0-9]+$/", $request("t_" . $tmp[1])))
                                {
									if($order_detail[$tmp[1]]->amount < $request("t_" . $tmp[1]))
                                    {
                                        $validator->errors()->add("t_" . $tmp[1], '購入数量を超えています。');
									}
                                    else
                                    {
										$umo++;
                                        $total_price += $request("s_" . $tmp[1]) * $order_detail[$tmp[1]]->unit_price;  // 2018/09/05
									}
								}
                                else
                                {
                                    $validator->errors()->add("t_" . $tmp[1], '数字を入力してください。');
								}
							}
						}
                        else
                        {
							$umo++;
                            $total_price += $request("s_" . $tmp[1]) * $order_detail[$tmp[1]]->unit_price;  // 2018/09/17
						}
					}
				}
			}

			if($umo == 0){
                $validator->errors()->add("t_", '対象商品の数量を入力してください。');
			}
			if($total_price > 100000) { // 2018/09/05
                $validator->errors()->add("t_", '返品金額の合計金額が高額となる為、本システムでは受付出来ません。コールセンターまでお問合せ下さい。');
			}
        }

        $validated = $validator->validate();
    }

    public function init()
    {
		
    }

    // 入力フォームの準備
    protected function _entry($no) {
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
        $params['select'] = $no;
        $params['order_id'] = Session::get('ft_order_id');
        $params['orderDetails'] = $this->orderDetails;

        return $params;
    }

    // 入力フォームの評価
    protected function _confirm(Request $request, $select)
    {
        $this->_validation($request, $select);

        $params = [];

        return $params;
    }

}