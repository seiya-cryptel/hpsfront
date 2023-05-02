<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'return_t_order';
    protected $primaryKey = 'order_id';
    const UPDATED_AT = 'last_modified';

    // オーダID存在チェック
    public function existsOrderId($order_id)
    {
        $ret = Order::where('order_id', $order_id)->exists();
        return $ret;
    }

    // オーダID、電話番号存在チェック
    public function existsOrderIdTel($order_id, $tel)
    {
        $ret = Order::where('order_id', $order_id)->where('tel', $tel)->exists();
        return $ret;
    }

    // オーダIDで検索
    public function getByOrderId($order_id)
    {
        $ret = Order::where('order_id', $order_id)->first();
        return $ret;
    }

    // インポート日数をもとに、出荷日からの経過日数をチェック
    public function expiredForChange($order_id, $days)
    {
        $order = Order::where('order_id', $order_id)->first();
        if(! empty($order['date_added']))  // インポートからの日数で判断
        {
            // $strDateLimit = date('Y-m-d', strtotime('+21 days', strtotime($row['shipment_day'])));
            $strDateLimit = date('Y-m-d', strtotime('+' . $days . ' days', strtotime($order['date_added'])));    // 2018/09/22
            if(date('Y-m-d') >= $strDateLimit)
            {
                return false;
            }
        }
        return true;
    }

    // 返品・交換を記録する
    public function setReturnStatus($order_id, $select, $accept_no)
    {
        $order = Order::where('order_id', $order_id)->first();
        switch($select)
        {
            case 1:
            case 2:
                $order->return1_no = $accept_no;
                $order->return1_status = 1;
                $order->return1_date = date('Y-m-d H:i:s');
                break;
            case 3:
                $order->sizeexchange_no = $accept_no;
                $order->sizeexchange_status = 1;
                $order->sizeexchange_date = date('Y-m-d H:i:s');
                break;
            case 4:
                $order->return2_no = $accept_no;
                $order->return2_status = 1;
                $order->return2_date = date('Y-m-d H:i:s');
                break;
            default:
                break;
        }
        $order->update();
        return $order;
    }
}
