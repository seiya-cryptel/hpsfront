<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Order;
use App\Models\Message;

class Return1FirstController extends Front1Controller
{
    function __construct() {
		parent::__construct();

		$this->section_cd = "return1_first";
		$this->mail_id = config('config.MAIL_RETURN01_PASS');
		$this->request_content_class = config('config.REQUEST_CONTENT_CLASS_RETURN1');
    }

    // GET
	function index() {
        $params = [];

        // メッセージレコード
        $messageModel = new Message();
        $params['message'] = $messageModel->firstById(11);

        return view('Return1First/index', $params);
    }

    // POST
	public function reg(Request $request)
    {
        $params = [];

		$pwd = parent::reg($request);
        $params['password'] = $pwd;

        // メッセージレコード
        $messageModel = new Message();
        $params['message'] = $messageModel->firstById(21);

        return view('return1first/pwd', $params); 
    }

    // ログインパスワード表示
	public function pwd()
    {
        return view('Return1First/pwd', []);
    }
}