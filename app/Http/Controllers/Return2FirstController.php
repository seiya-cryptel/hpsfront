<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Return2FirstController extends FrontBaseController
{

    function __construct() {
		parent::__construct();

		$this->section_cd = "return1_first";
		$this->mail_id = config('config.MAIL_RETURN02_PASS');
		$this->request_content_class = config('config.REQUEST_CONTENT_CLASS_RETURN2');
    }

    // GET
	function index() {
        return view('Return2First/index', []);
    }

    // POST
	public function reg(Request $request)
    {
		$pwd = parent::reg($request);

        return view('return2first/pwd', ['password' => $pwd]); 
    }

    // ログインパスワード表示
	public function pwd()
    {
        return view('Return2First/pwd', []);
    }
}