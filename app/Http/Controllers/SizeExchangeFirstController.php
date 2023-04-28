<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Order;

class SizeExchangeFirstController extends Front1Controller
{
    function __construct() {
		parent::__construct();

		$this->section_cd = "sizeexchange_first";
		$this->mail_id = config('config.MAIL_SIZEEXCHANGE_PASS');
		$this->request_content_class = config('config.REQUEST_CONTENT_SIZEEXCHANGE');
    }

    // GET
	public function index()
    {
        return view('SizeExchangeFirst/index', []);
    }

    // POST
	public function reg(Request $request)
    {
		$pwd = parent::reg($request);

        return view('SizeExchangeFirst/pwd', ['password' => $pwd]); 
    }

    // ログインパスワード表示
	public function pwd()
    {
        return view('SizeExchangeFirst/pwd', []);
    }
    
}