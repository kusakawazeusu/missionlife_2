<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Department;
use Validator;
use Illuminate\Http\Request;
use App\Http\Requests;
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
            'confirmed' => '輸入資料與確認密碼不符合。',
        ];

        $validator = Validator::make($data, [
            'name' => 'required|max:255',
            'email' => ['required','email','max:255','unique:users','regex:/.*@mail\.ntust\.edu\.tw/'],
            'password' => 'required|min:6|confirmed',
        ],$messages);

        if ($validator->fails()) {
            return $validator;
        }
        else{//註冊成功時 該department+1
            $department = Department::find($data['department_id']);
            $department->people += 1;
            $department->save();
            return $validator;
        }
/*
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => ['required','email','max:255','unique:users','regex:/.*@mail\.ntust\.edu\.tw/'],
            'password' => 'required|min:6|confirmed',
        ],$messages);*/
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'gender' => $data['gender'],
            'department_id' => $data['department_id'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    public function updateaa(Request $request,$id)
    {

        //無法在這個controller寫任何其它的function，原因未知。
        /*$messages = [
            'required' => '這個欄位是必填的！',
            'max' => '這個欄位最多只能輸入255個字元。',
        ];

        $this->validate($request,[
            'name'=>'required|max:255',
            ],$messages);

        $user = User::find($id);
        $user->name = $request->name;
        $user->gender = $request->gender;
        $user->department_id = $request->department_id;
        $user->save();

        return redirect('/account');*/
        /*$success = 1;
        return redirect('/account')->withInput($success);   */

        /*$quest = new Quest;
        $quest->name = $request->title;
        $quest->creator = Auth::user()->name;
        $quest->start_at = $request->start_date;
        $quest->end_at = $request->end_date;
        $quest->description = $request->description;
        $quest->salary = $request->salary;
        $quest->point = 10;
        $quest->activation = 1;
        $quest->workforce = $request->workforce;//人數
        $quest->catalog = $request->catalog;
        $quest->save();
        return redirect('quest');*/
        //return view('quest');
        //return 'hello~'.$id;
    }
}
