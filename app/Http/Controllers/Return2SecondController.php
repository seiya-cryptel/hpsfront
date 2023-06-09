<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Message;

class Return2SecondController extends Front2Controller
{
    function __construct() {
		parent::__construct();

		$this->section_cd = "return1_second";
		$this->mail_id = config('config.MAIL_RETURN02_ACCEPT');
		$this->request_content_class = config('config.REQUEST_CONTENT_CLASS_RETURN2');
    }

    // 説明
    function index() {
        $params = [];

        // メッセージレコード
        $messageModel = new Message();
        $params['message'] = $messageModel->firstById(44);

        return view('Return2Second/index', $params);
    }

    // 同意なし
    function no() {
        $params = [];

        // メッセージレコード
        $messageModel = new Message();
        $params['message'] = $messageModel->firstById(54);

        return view('Return2Second/no', $params);
    }

    // 同意あり　入力フォーム
    function entry($no) {
        if(! $this->_chk_login())
        {
            return redirect('/');
        }

        $params = $this->_entry('return2second', $no);

        // メッセージレコード
        $messageModel = new Message();
        $params['message'] = $messageModel->firstById(64);

        return view('Return2Second/entry', $params);
    }

    // 確認フォーム
    function confirm(Request $request, $no) {
        if(! $this->_chk_login())
        {
            return redirect('/');
        }

        $params = $this->_confirm($request, 'return2second', $no);
        $params['returns'] = $this->_get_returns($request);

        // メッセージレコード
        $messageModel = new Message();
        $params['message'] = $messageModel->firstById(74);

        return view('Return2Second/confirm', $params);
    }

    // 受付表
    function reg(Request $request, $no) {
        if(! $this->_chk_login())
        {
            return redirect('/');
        }

        $params = $this->_regist($request, 'return2second', $no);

        // メッセージレコード
        $messageModel = new Message();
        $params['message'] = $messageModel->firstById(84);

        return view('Return2Second/reg', $params);
    }
    
}