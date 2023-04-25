<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SizeExchangeSecondController extends Front2Controller
{

    // 説明
    function index() {
        return view('SizeExchangeSecond/index', []);
    }

    // 同意なし
    function no() {
        return view('SizeExchangeSecond/no', []);
    }

    // 同意あり　入力フォーム
    function entry($no) {
        if(! $this->_chk_login())
        {
            return redirect('/');
        }

        $params = $this->_entry($no);

        return view('SizeExchangeSecond/entry', $params);
    }

    // 確認フォーム
    function confirm(Request $request, $no) {
        if(! $this->_chk_login())
        {
            return redirect('/');
        }

        $params = $this->_confirm($request, $no);

        return view('SizeExchangeSecond/confirm', $params);
    }

    // 受付表
    function reg($no) {
        return view('SizeExchangeSecond/reg', []);
    }
    
}