<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FTopController extends FrontBaseController
{
    //
	function index() {
        return view('FTop/index');
    }
}