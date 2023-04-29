<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Order;
use App\Models\Message;

class Return2FirstController extends Front1Controller
{

    function __construct() {
		parent::__construct();

		$this->section_cd = "return2_first";
		$this->mail_id = config('config.MAIL_RETURN02_PASS');
		$this->request_content_class = config('config.REQUEST_CONTENT_CLASS_RETURN2');
    }

    // GET
	function index() {
        $params = [];

        // メッセージレコード
        $messageModel = new Message();
        $params['message'] = $messageModel->firstById(14);

        return view('Return2First/index', $params);
    }

    // POST
	public function reg(Request $request)
    {
        $params = [];

		$pwd = parent::reg($request);
        $params['password'] = $pwd;

        // メッセージレコード
        $messageModel = new Message();
        $params['message'] = $messageModel->firstById(24);

        return view('Return2First/pwd', $params); 
    }

    // ログインパスワード表示
	public function pwd()
    {
        return view('Return2First/pwd', []);
    }
}