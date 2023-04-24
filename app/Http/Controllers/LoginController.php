<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    //
	function index($login_id) {
        return view('Login/index', ['login_id' => $login_id]);
    }
}