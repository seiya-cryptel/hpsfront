<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SizeExchangeSecondController extends Front2Controller
{

    // 説明
    function index() {
        $params = [];

        // メッセージレコード
        $messageModel = new Message();
        $params['message'] = $messageModel->firstById(43);

        return view('SizeExchangeSecond/index', params);
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

        $params = $this->_entry($no);

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

        $params = $this->_confirm($request, $no);       

        // メッセージレコード
        $messageModel = new Message();
        $params['message'] = $messageModel->firstById(73);

        return view('SizeExchangeSecond/confirm', $params);
    }

    // 受付表
    function reg($no) {
        return view('SizeExchangeSecond/reg', []);
    }
    
}