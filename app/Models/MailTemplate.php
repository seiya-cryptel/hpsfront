<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MailTemplate extends Model
{
    use HasFactory;

    protected $table = 'return_tm_mailtemplate';


    // メールIDでレコードを検索して返す
    public function findByMailId($mail_id)
    {
        $ret = MailTemplate::where('id', $mail_id)->first();
        return $ret;
    }
}
