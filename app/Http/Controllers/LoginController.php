<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\Accept;
use App\Models\Message;

// class LoginController extends Controller
class LoginController extends FrontBaseController
{
    function __construct() {
		parent::__construct();

		$this->main_model="accept";
		$this->section_cd="login";
		$this->section_nm="";//トップページ
		$this->ref_url = "";
		$this->page_title="";//
    }
    // validation
    protected function _loginValidation(Request $request, Accept $accept)
    {
        $validator = Validator::make($request->all(), [
            // パスワード チェック
            'password' => 'bail|required',
        ]);

        $validated = $validator->validate();

        // パスワード確認
        $validator->after(function($validator) use($request, $accept) {
            if (! $accept->authPassword($request->password)) {
                $validator->errors()->add('password', '認証エラーです。');
            }
        });

        $validated = $validator->validate();
    }

    // GET
    // 認証画面表示
	public function index($login_id) {
        $acceptModel = new Accept();
        $accept = $acceptModel->firstByLoginId($login_id);
        if(is_null($accept))
        {
            // 不正なログインID
            return redirect('/');
        }
        $params = [];
        $params['login_id'] = $login_id;
        $params['request_content_class'] = $accept->request_content_class;

        // メッセージレコード
        $messageModel = new Message();
        $params['message'] = $messageModel->firstById(30);

        return view('Login/index', $params);
    }

    // POST
    // 認証
	public function check(Request $request, string $login_id) {
        // Accept 取得
        $acceptModel = new Accept();
        $accept = $acceptModel->firstByLoginId($login_id);
        if(is_null($accept))
        {
            return redirect('/');   // 不正なログインID
        }

        // Message 取得
        $messageModel = new Message();
        $message = $messageModel->firstById(30);

        // 入力チェック
        $this->_loginValidation($request, $accept);

        // Accept 更新 Login::check() から
        $accept->update([
            'status' => 1,
            'date_login' => date('Y-m-d H:i:s'),
            'last_modified' => date('Y-m-d H:i:s'),
            'u_register' => $request->ip(),
        ]);

        // セッション変数に保存
        $request->session()->put([
            'Loginsts_ft'   => 'ok',
            'ft_id'         => $accept->id,
            'ft_login_id'   => $login_id,
            'ft_order_id'   => $accept->order_id,
        ]);
     
        // リダイレクト
        switch($accept->request_content_class)
        {
            case 1:     // Return1
                return redirect('return1second');

            case 3:     // SizeExchange
                return redirect('sizeexchangesecond');

            case 4:     // Return2
                return redirect('return2second');

            default:
                break;
        }
        
    }
}