<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $messages = [
            'regex' => '請使用臺灣科技大學學生信箱(mail.ntust.edu.tw)註冊。',
            'required' => '這個欄位是必填的！',
            'email' => '請輸入Email格式',
            'max' => '這個欄位最多只能輸入255個字元。',
            'unique' => '這個Email已經被註冊過了！',
            'min' => '密碼需要至少6個字元',
        ];


        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => ['required','email','max:255','unique:users','regex:/.*@mail\.ntust\.edu\.tw/'],
            'password' => 'required|min:6|confirmed',
        ],$messages);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $k = rand(1000000,9999999);
        

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'activation' => 'false',
            'point' => '0',
            'gender' => '0',
            'department_id' => '0',
            'fame' => '0',

        ]);
    }
}
