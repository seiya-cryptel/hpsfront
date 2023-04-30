<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accept extends Model
{
    use HasFactory;

    const CREATED_AT = null;
    const UPDATED_AT = 'last_modified';

    protected $table = 'return_t_accept';

    protected $fillable = [
        'accept_no',
        'order_id',
        'name',
        'email',
        'login_id',
        'password',
        'request_content_class',
        'status',
        'input_source',
        'tanto_input',
        'invoice_no',
        'post',
        'ken',
        'address',
        'company',
        'division',
        'shipping_tel',
        'shipping_name',
        'pickup_date',
        'pickup_time',
        'comment',
        'date_logistics_accept',
        'tanto_logistics_accept',
        'flg_dl_pickup',
        'date_dl_pickup',
        'date_login',
        'date_accept',
        'flg_dl_history',
        'date_dl_history',
        'tanto_accept_confirm',
        'tanto_gyomu',
        'not_accepted_method',
        'inquiry_class',
        'request_for_investigation',
        'sales_destination',
        'comment_cc',
        'p_arrangement',
        'flg_p_arrangement_dtime',
        'p_arrangement_pickup_date',
        'p_arrangement_pickup_time',
        'p_arrangement_delivery_com',
        'p_arrangement_order_id',
        'p_arrangement_invoice_no',
        'repay_response',
        'invest_flg_photo',
        'invest_flg_cc_action',
        'invest_text1',
        'invest_date',
        'invest_requester',
        'invest_contents',
        'invest_bad_acceptance',
        'invest_product_final_place',
        'invest_result',
        'invest_last_action',
        'gyom_size_act',
        'gyom_size_memo',
        'gyom_size_voucher_date',
        'gyom_size_voucher_time',
        'gyom_returns_act',
        'gyom_returns_memo',
        'gyom_returns_voucher_date',
        'gyom_returns_voucher_time',
        'gyom_claim_act',
        'gyom_claim_memo',
        'gyom_claim_voucher_date',
        'gyom_claim_voucher_time',
        'gyom_going_first_act',
        'gyom_going_first_memo',
        'gyom_going_first_voucher_date',
        'gyom_going_first_voucher_time',
        'comment_gyom',
        'response_request',
        'response_requester',
        'response_responder',
        'action_status',
        'comment_irai',
        'date_response_request',
        'kbn_carriage_cancel',
        'kbn_product_select',
        't_register',
        'last_modified',
        'u_register',
        'latest_updater',
    ];

    protected $guarded = [
        'date_added',
    ];

    // オーダIDを持つレコードがあるか
    public function existsByOrderId($order_id)
    {
        $accepts = Accept::where('order_id', $order_id)->get();
        return ($accepts->count() == 0) ? false : true;
    }

    // オーダIDで返品・交換処理済みか調べる
    public function alreadyReturned($order_id)
    {
        $accepts = Accept::where('order_id', $order_id)->get();
        foreach($accepts as $accept)
        {
            if(! empty($accept->accept_no)) return true;
        }
        return false;
    }

    // ログインIDで検索する
    public function firstByLoginId($login_id)
    {
        $accept = Accept::where('login_id', $login_id)->first();
        return $accept;
    }

    // IDで検索する
    public function firstById($id)
    {
        $accept = Accept::where('id', $id)->first();
        return $accept;
    }

    // パスワードで認証する
    public function authPassword($password)
    {
        return ($this->password == $password);
    }

    // accept_no に最大値を割り当てる
    public function setAcceptNo($id)
    {
        $accept = self::firstById($id);
        if(is_null($accept))    return null;
        if(! empty($accept->accept_no)) return null;

        $yyyy = date('Y');
        $pre_no = self::where('accept_no', '<>', '')->max('accept_no');
        $wyyyy = substr($pre_no, 0, 4);
        if($wyyyy == $yyyy)
        {
            $accept->accept_no = $pre_no + 1;
        }
        else
        {
            $accept->accept_no = $yyyy . "00001";
        }
        $accept->save();
        return $accept->accept_no;
    }
    
}
