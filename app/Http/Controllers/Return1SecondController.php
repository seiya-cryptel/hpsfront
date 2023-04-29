<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Message;

class Return1SecondController extends Front2Controller
{
    function __construct() {
		parent::__construct();

		$this->section_cd = "return2_second";
		$this->mail_id = config('config.MAIL_RETURN02_ACCEPT');
		$this->request_content_class = config('config.REQUEST_CONTENT_CLASS_RETURN2');
    }

    // 説明
    function index() {
        $params = [];

        // メッセージレコード
        $messageModel = new Message();
        $params['message'] = $messageModel->firstById(44);

        return view('Return1Second/index', $params);
    }

    // 入力フォーム
    //  $select 1: お取替え, 2: 返品
    function entry($select) {
        if(! $this->_chk_login())
        {
            return redirect('/');
        }

        $params = $this->_entry('return1second', $select);

        // メッセージレコード
        $messageModel = new Message();
        $params['message'] = $messageModel->firstById(61);

        return view('Return1Second/entry', $params);
    }

    // 確認フォーム
    function confirm(Request $request, $no) {
        if(! $this->_chk_login())
        {
            return redirect('/');
        }

        $params = $this->_confirm($request, 'return1second', $no);
        $params['returns'] = $this->_get_returns($request);

        // メッセージレコード
        $messageModel = new Message();
        $params['message'] = $messageModel->firstById(71);

        return view('Return1Second/confirm', $params);
    }

    // 受付表
    function reg(Request $request, $no) {
        if(! $this->_chk_login())
        {
            return redirect('/');
        }

        $params = $this->_regist($request, 'return1second', $no);

        // メッセージレコード
        $messageModel = new Message();
        $params['message'] = $messageModel->firstById(81);

        return view('Return1Second/reg', $params);
    }
    
}