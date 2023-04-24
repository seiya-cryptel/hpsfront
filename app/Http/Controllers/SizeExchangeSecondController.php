<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SizeExchangeSecondController extends FrontBaseController
{
    function index() {
        return view('SizeExchangeSecond/index', []);
    }

    // 同意なし
    function no() {
        return view('SizeExchangeSecond/no', []);
    }

    // 同意あり　入力フォーム
    function entry($no) {
        return view('SizeExchangeSecond/entry', []);
    }

    // 確認フォーム
    function confirm($no) {
        return view('SizeExchangeSecond/confirm', []);
    }

    // 受付表
    function reg($no) {
        return view('SizeExchangeSecond/reg', []);
    }
    
}