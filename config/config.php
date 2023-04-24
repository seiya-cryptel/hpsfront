<?php

use Illuminate\Support\Facades\Facade;

return [
    'copyright' => 'Copyright © ' . strftime('%Y') . ' MIDORI ANZEN Co.,Ltd All Rights Reserved.',

    // config/constants.php から
    'MAIL_RETURN01_PASS'        => 100, // 認証パスワード通知(クレーム)
    'MAIL_RETURN01_ACCEPT'      => 110, // 受付完了(クレーム)
    'MAIL_RETURN02_PASS'        => 200, // 認証パスワード通知(お客様都合返品)
    'MAIL_RETURN02_ACCEPT'      => 210, // 受付完了(お客様都合返品)
    'MAIL_SIZEEXCHANGE_PASS'    => 300, // 認証パスワード通知(サイズ交換)
    'MAIL_SIZEEXCHANGE_ACCEPT'  => 310, // 受付完了(サイズ交換)

    'REQUEST_CONTENT_CLASS_RETURN1'     => '1',
    'REQUEST_CONTENT_SIZEEXCHANGE'      => '2',
    'REQUEST_CONTENT_CLASS_RETURN2'     => '3',

    'SITE_NAME' => '',
];
