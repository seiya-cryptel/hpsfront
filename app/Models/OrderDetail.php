<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    protected $table = 'return_t_order_detail';

    // 返品・交換可能なオーダ明細があるか
    public function existsReturnable($order_id)
    {
        $ret = OrderDetail::where('order_id', $order_id)->where('kbn_return', '<>', 0)->exists();
        return $ret;
    }
}
