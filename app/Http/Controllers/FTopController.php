<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Message;

class FTopController extends FrontBaseController
{
    //
	function index() {
        // メッセージレコード
        $messageModel = new Message();
        $params['message'] = $messageModel->firstById(0);

        return view('FTop/index', $params);
    }
}