<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Message;

class SizeExchangeSecondController extends Front2Controller
{
    function __construct() {
		parent::__construct();

		$this->section_cd = "sizeexchange_second";
		$this->mail_id = config('config.MAIL_SIZEEXCHANGE_ACCEPT');
		$this->request_content_class = config('config.REQUEST_CONTENT_SIZEEXCHANGE');
    }

    // 説明
    function index() {
        $params = [];

        // メッセージレコード
        $messageModel = new Message();
        $params['message'] = $messageModel->firstById(43);

        return view('SizeExchangeSecond/index', $params);
    }

    // 同意なし
    function no() {
        $params = [];

        // メッセージレコード
        $messageModel = new Message();
        $params['message'] = $messageModel->firstById(53);

        return view('SizeExchangeSecond/no', $params);
    }

    // 同意あり　入力フォーム
    function entry($no) {
        if(! $this->_chk_login())
        {
            return redirect('/');
        }

        $params = $this->_entry('sizeexchangesecond', $no);

        // メッセージレコード
        $messageModel = new Message();
        $params['message'] = $messageModel->firstById(63);

        return view('SizeExchangeSecond/entry', $params);
    }

    // 確認フォーム
    function confirm(Request $request, $no) {
        if(! $this->_chk_login())
        {
            return redirect('/');
        }

        $params = $this->_confirm($request, 'sizeexchangesecond', $no);
        $params['returns'] = $this->_get_returns($request);

        // メッセージレコード
        $messageModel = new Message();
        $params['message'] = $messageModel->firstById(73);

        return view('SizeExchangeSecond/confirm', $params);
    }

    // 受付表
    function reg(Request $request, $no) {
        if(! $this->_chk_login())
        {
            return redirect('/');
        }

        $params = $this->_regist($request, 'sizeexchangesecond', $no);

        // メッセージレコード
        $messageModel = new Message();
        $params['message'] = $messageModel->firstById(83);

        return view('SizeExchangeSecond/reg', $params);
    }
    
}