<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Return1FirstController extends FrontBaseController
{
    function __construct() {
		parent::__construct();

		$this->section_cd = "return1_first";
		$this->mail_id = config('config.MAIL_RETURN01_PASS');
		$this->request_content_class = config('config.REQUEST_CONTENT_CLASS_RETURN1');
    }

    // GET
	function index() {
        return view('Return1First/index', []);
    }

    // ログインパスワード表示
	public function pwd()
    {
        return view('Return1First/pwd', []);
    }
}