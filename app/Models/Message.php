<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $table = 'return_tm_message';

    // メッセージIDで検索
    public function firstById($id)
    {
        $ret = Message::where('id', $id)->first();
        return $ret;
    }
}
