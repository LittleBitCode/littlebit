<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Api\V1\Common\BaseController;
use App\Models\Foundation\User;
use Dingo\Api\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class LoginController extends BaseController
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    public function login(Request $request)
    {
        $this->validate($request,[
           'username' => 'required',
           'password' => 'required'
        ]);
        $inputUserName = $request->input('username');
        $inputPassword = $request->input('password');
        $user = User::where(['mobile' => $inputUserName])
                  ->orWhere(['name'   => $inputUserName])
                  ->orWhere(['email'  => $inputUserName])
                  ->first();
        if ($user){
            if (Hash::check($inputPassword,$user->password)){
                $token = JWTAuth::fromUser($user);
                return $this->sendLoginResponse($request,$token);
            }else{
                return $this->sendFailedLoginResponse($request);
            }
        }else{
            return $this->response->error('该用户尚未注册',400);
        }
    }

    public function sendLoginResponse(Request $request, $token)
    {
        $this->clearLoginAttempts($request);
        return $this->authenticated($token);
    }

    public function authenticated($token)
    {
        return $this->response->array([
            'access_token' => $token,
            'status_code'  => 200,
            'message'      => '用户认证成功！'
        ]);
    }

    public function sendFailedLoginResponse()
    {
        return $this->response->error('用户名或密码错误！',400);
    }

    public function logout()
    {
        $this->guard()->logout();
        JWTAuth::invalidate(JWTAuth::getToken());
        return $this->response->array([
            'status_code' => 200,
            'message'     => '退出成功！'
        ]);
    }
}
