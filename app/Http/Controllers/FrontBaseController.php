<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Fluent;

use Mail;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Accept;
use App\Models\MailTemplate;
use App\Mail\ReturnAccepted;


abstract class FrontBaseController extends Controller
{
    // MY_Controller から
	var $controller;//コントローラ名
	var $method;//メソッド

	var $sel_lang; //選択言語
	var $lang_index;

	var $page_limit; // 1ページに表示するの数
	var $page_title; // 1ページに表示するの数
	var $description;
	var $keywords;

	var $header; //画面ヘッダーのコンテンツ
	var $side_left; //画面左のコンテンツ
	var $side_right; //画面右のコンテンツ
	var $footer; //画面フッダーのコンテンツ
	var $navbar;

	var $main_model; //使用する主なマスターテーブル
	var $model; //使用する主なマスターテーブルのモデルオブジェクト

	var $section_cd; //（サブ）セクションコード
	var $section_nm; //（サブ）セクション名

	var $view_prefix; //viewのファイル名接頭辞

	var $ref_url; //リダイレクトURL

//	var $body_onload; //body　オンロード

	var $agent_type;

	var $regMail_errpage_view;
	var $regMail_okpage_view;
	var $regMail_login_url;
	var $mail_id;

	var $cookie_limit;

	var $site_name;//サイト名
	var $member_name;//会員の呼び名
	var $service_name;//スタッフの呼び名
	var $admin_email;//管理者メールアドレス

	var $find_key;
	var $find_key_val;
	var $find_key_add;

	var $login_id;
	var $msg;

	var $upload_path;
	var $img_m_width;
	var $img_m_height;
	var	$img_s_width;
	var $img_s_height;

    function __construct() {
        // parent::__construct();

        // $this->controller = explode('.', Route::currentRouteName())[0];
		// $this->method = explode('.', Route::currentRouteName())[1];
        $tmp1 = explode("@", Route::currentRouteAction());
        $tmp2 = explode('\\', $tmp1[0]);
        $this->method = $tmp1[1];
        $this->controller = end($tmp2);
		$this->regMail_login_url = url('/', null, true) . "/login/index/";

		$this->init();
		// $this->set_find_key();
    }

    public function init()
    {
		
    }


}