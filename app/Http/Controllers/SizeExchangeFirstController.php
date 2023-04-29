<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Order;
use App\Models\Message;

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
        $params = [];

        // メッセージレコード
        $messageModel = new Message();
        $params['message'] = $messageModel->firstById(13);

        return view('SizeExchangeFirst/index', $params);
    }

    // POST
	public function reg(Request $request)
    {
        $params = [];

		$pwd = parent::reg($request);
        $params['password'] = $pwd;

        // メッセージレコード
        $messageModel = new Message();
        $params['message'] = $messageModel->firstById(23);

        return view('SizeExchangeFirst/pwd', $params); 
    }

    // ログインパスワード表示
	public function pwd()
    {
        return view('SizeExchangeFirst/pwd', []);
    }
    
}