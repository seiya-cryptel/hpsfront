<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// 当社営業日
class BusinessDay extends Model
{
    use HasFactory;

    protected $table = 'return_t_businessday';

    // 名称をリストにして返す
    public function getListbox($dayOffset = 2, $days = 14)
    {
        // 当社営業日でオフセット日後の日付を求める
        $skipDays = 0;
        for($dayIndex = 0; $skipDays < $dayOffset; $dayIndex++)
        {
            $daytime = strtotime('+' . $dayIndex . ' day');     // dayIndex 日後
            $w = date('w', $daytime);
            if($w == 0 || $w == 6)  continue;   // 土日は休業日
            $yyyymmdd = date('Ymd', $daytime);
            $rec = BusinessDay::where('id', $yyyymmdd)->first();
            if((! is_null($rec)) && ($rec->day_type == '1'))    continue;   // 休業日
            $skipDays++;
        }

        $names = [];
        $names[""] = "-------------";

        for($nx = 0; $nx < $days; $nx++)
        {
            $daytime = strtotime('+' . ($dayIndex + $nx) . ' day');     // dayIndex 日後
            $names[date('Ymd', $daytime)] = date('Y年m月d日', $daytime);
        }

        return $names;
    }
}
