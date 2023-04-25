<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// 集荷時間帯
class PickupTime extends Model
{
    use HasFactory;

    protected $table = 'return_tm_pickup_time';

    // 名称をリストにして返す
    public function getListbox()
    {
        $names = [];
        $names[""] = "-------------";

        $recs = PickupTime::orderBy('sort')->get();
        foreach($recs as $rec)
        {
            $names[$rec->id] = $rec->name;
        }
        return $names;
    }
}
