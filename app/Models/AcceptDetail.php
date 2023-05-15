<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcceptDetail extends Model
{
    use HasFactory;

    const CREATED_AT = null;
    const UPDATED_AT = 'last_modified';

    protected $table = 'return_t_accept_detail';

    protected $fillable = [
        'accept_id',
        'row_no',
        'order_id',
        'product_nm',
        'amount',
        'product_no',
        'request_content_class',

    ];

    protected $guarded = [
        'date_added',
    ];

    // accept_idで削除する
    public function deleteByAcceptId($accept_id)
    {
        self::where('accept_id', $accept_id)->delete();
    }

    // orderDetail から acceptDetail を作成、追加する
    public function createFromOrderDetail($accept_id, $orderDetail, $select, $amount)
    {
        $acceptDetail = self::create([
            'accept_id' => $accept_id,
            'row_no' => $orderDetail->row_no,
            'order_id' => $orderDetail->order_id,
            'product_nm' => $orderDetail->product_nm,
            'amount' => $amount,
            'product_no' => $orderDetail->product_no,
            'request_content_class' => $select,
        ]);        
    }
    
    // 返品リスtを返す
	public static function get_list_id($accept_id)
    {
        $ret = [];
        $rows = self::where('accept_id', $accept_id)->get();
        foreach ($rows as $row) {
            $ret[$row->row_no] = $row;
        }
        return $ret;
    }
}
