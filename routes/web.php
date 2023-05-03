<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/* 2023/04/10
Route::get('/', function () {
    return view('welcome');
});
*/

use App\Http\Controllers\FTopController;
use App\Http\Controllers\SizeExchangeFirstController;
use App\Http\Controllers\SizeExchangeSecondController;
use App\Http\Controllers\Return1FirstController;
use App\Http\Controllers\Return1SecondController;
use App\Http\Controllers\Return2FirstController;
use App\Http\Controllers\Return2SecondController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ImageBarCodeController;

// トップ
Route::get('/', [FTopController::class, 'index']);

// サイズ交換
Route::get('/sizeexchangefirst', [SizeExchangeFirstController::class, 'index']);
Route::post('/sizeexchangefirst', [SizeExchangeFirstController::class, 'reg']);
// Route::get('/sizeexchangefirst/pwd', [SizeExchangeFirstController::class, 'pwd']);

Route::get('/sizeexchangesecond', [SizeExchangeSecondController::class, 'index']);  // サイズ交換について
Route::get('/sizeexchangesecond/no', [SizeExchangeSecondController::class, 'no']);  // 同意できない
Route::get('/sizeexchangesecond/entry/{no}', [SizeExchangeSecondController::class, 'entry']);
Route::post('/sizeexchangesecond/entry/{no}', [SizeExchangeSecondController::class, 'entry']);
Route::post('/sizeexchangesecond/confirm/{no}', [SizeExchangeSecondController::class, 'confirm']);
Route::post('/sizeexchangesecond/reg/{no}', [SizeExchangeSecondController::class, 'reg']);

// 商品不良等
Route::get('/return1first', [Return1FirstController::class, 'index']);
Route::post('/return1first', [Return1FirstController::class, 'reg']);
// Route::get('/returnReturn1first/pwd', [ReturnReturn1FirstController::class, 'pwd']);

Route::get('/return1second', [Return1SecondController::class, 'index']);  // サイズ交換について
Route::get('/return1second/entry/{no}', [Return1SecondController::class, 'entry']);
Route::post('/return1second/entry/{no}', [Return1SecondController::class, 'entry']);
Route::post('/return1second/confirm/{no}', [Return1SecondController::class, 'confirm']);
Route::post('/return1second/reg/{no}', [Return1SecondController::class, 'reg']);

// お客様都合
Route::get('/return2first', [Return2FirstController::class, 'index']);
Route::post('/return2first', [Return2FirstController::class, 'reg']);
// Route::get('/return2first/pwd', [Return2FirstController::class, 'pwd']);

Route::get('/return2second', [Return2SecondController::class, 'index']);  // サイズ交換について
Route::get('/return2second/no', [Return2SecondController::class, 'no']);  // 同意できない
Route::get('/return2second/entry/{no}', [Return2SecondController::class, 'entry']);
Route::post('/return2second/entry/{no}', [Return2SecondController::class, 'entry']);
Route::post('/return2second/confirm/{no}', [Return2SecondController::class, 'confirm']);
Route::post('/return2second/reg/{no}', [Return2SecondController::class, 'reg']);

// ログイン
Route::get('/login/index/{login_id}', [LoginController::class, 'index']);
Route::post('/login/check/{login_id}', [LoginController::class, 'check']);

// バーコード画像生成
// Route::get('/imagebarcode/show/{code}', [ImageBarCodeController::class, 'show']);
Route::get('/imagebarcode/show/{code}', function($code){
    // echo DNS1D::getBarcodeHTML($code, "C128", 3, 70, 'black', true);
    // echo DNS1D::getBarcodeHTML($code, "C39", 3, 70, 'black', true);
    // echo DNS1D::getBarcodeHTML($code, "QRCODE");
    echo DNS1D::getBarcodeHTML($code, "C39", 1, 70, 'black', 12);
});
