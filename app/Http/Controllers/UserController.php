<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;
use Validator;
use Hash;
use Auth;
use File;
use Carbon\Carbon;

class UserController extends Controller
{
    //

    public function update(Request $request,$id){
    	//$user = User::where('username',$request->username)->first();
    	/*$user = User::where('username',$username)->first();
        $user->password = $request->password;
    	$user->money = $request->money;
    	$user->save();
    	return redirect('');*/

    	$messages = [
            'required' => '這個欄位是必填的!!!！',
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
        return redirect('account');
        //$success = 1;
        //return view('account',['success'=>$success]);
    	// return $request->name.' '.$request->gender.' '.$request->department_id.' '.$id;
    }
    public function change_img(Request $request,$id){

    	// getting all of the post data
  		//$file = $request->file('input_image');

  		// $rules = array('image' => 'required',); //mimes:jpeg,bmp,png and for max size max:10000

  		// doing the validation, passing post data, rules and the messages
  		$messages = [
  			'required' => '尚未選擇圖片！',
            'image' => '只接受.jpeg .png .bmp .gif .svg的圖片！',
            'max' => '檔案大小請勿超過2MB！',
        ];
  		$this->validate($request,[
            'input_image' => 'required|image|max:2000',
        ],$messages);


        //執行到這時已通過validation
        if ($request->hasFile('input_image')&&$request->file('input_image')->isValid()) {
            $destinationPath = base_path().'/public/personal_img/'; // upload path
            $extension = $request->file('input_image')->getClientOriginalExtension(); // getting image extension
            $fileName = Carbon::now('Asia/Taipei')->format('Y_m_d_H_i_s').'_'.Auth::user()->id.'.'.$extension;
            //return 'sucess '.$extension.time();
            
            $request->file('input_image')->move($destinationPath, $fileName);//將照片存到personal_img資料夾

            $user = User::find($id);
            if ($user->picture_path == 'default_img.jpg') {
                $user->picture_path = $fileName;
                $user->save();
                return redirect('account');
            }
            else{//要將舊照片刪掉
                $old_picture = $user->picture_path;
                $user->picture_path = $fileName;
                $user->save();
                File::delete($destinationPath.$old_picture);
                return redirect('account');
            }
            // return $fileName;
        }

        return 'upload image fail.';
        /*
            $destinationPath = base_path().'/public/personal_img/'; // upload path
            $extension = $request->file('input_image')->getClientOriginalExtension(); // getting image extension
            $fileName = Carbon::now('Asia/Taipei')->format('Y_m_d_H_i_s').'_'.Auth::user()->id.'.'.$extension;
            //return 'sucess '.$extension.time();
            $request->file('input_image')->move($destinationPath, $fileName);
            return $fileName;
            //測試一下上面的if為什麼不會過*/


  		/*if ($validator->fails()) {
		    // send back to the page with the input data and errors
		    // return Redirect::to('upload')->withInput()->withErrors($validator);
		    return '$validator->fails()';
		}//if
		else {
		    // checking file is valid.
		    if ($request->file('input_image')->isValid()) {
		      $destinationPath = 'personal_img'; // upload path
		      $extension = $request->file('input_image')->getClientOriginalExtension(); // getting image extension
		      // $fileName = rand(11111,99999).'.'.$extension; // renameing image
		      $fileName = 'success'.'.'.$extension;
		      $request->file('input_image')->move($destinationPath, $fileName); // uploading file to given path
		      // sending back with message
		      // Session::flash('success', 'Upload successfully'); 
		      // return Redirect::to('upload');
		      return 'success upload';
		    }
		    else {
		      // sending back with error message.
		      // Session::flash('error', 'uploaded file is not valid');
		      // return Redirect::to('upload');
		    	return 'upload failed';
		    }
		}//else*/
    }
    public function update_pwd(Request $request,$id){
        $messages = [
            'required' => '這個欄位是必填的！',
            'min' => '密碼需要至少:min個字元',
            'confirmed' => '輸入資料與確認密碼不符合。',
        ];

        $user = User::find($id);
        if(Hash::check($request->old_pwd,$user->password)){
            // 舊密碼相同時
            $this->validate($request,[
            'old_pwd'=>'required',
            'new_pwd'=>'required|min:6|confirmed',
            ],$messages);
            //假如其它欄位驗證通過
            // 以下是將新密碼存入
            $user->fill([
                'password' => Hash::make($request->new_pwd)
            ])->save();
            return redirect('/account');
        }
        else{
            // 輸入舊密碼錯誤
            $validator = Validator::make($request->all(),[
            'old_pwd'=>'required',
            'new_pwd'=>'required|min:6|confirmed',
            ],$messages);
            $validator->after(function($validator){
                $validator->errors()->add('old_pwd', '密碼不符合！');
            });
            if ($validator->fails()) {
                return redirect('/account/change_pwd')
                        ->withErrors($validator)
                        ->withInput();
            }
                // return redirect('/account/change_pwd');
        }
        /*
        $validator = Validator::make($request->all(),[
            'old_pwd'=>'required',
            'new_pwd'=>'required|min:6|confirmed',
            ],$messages);

        $validator->after(function($validator,Request $request) {
            if (Hash::check($request->old_pwd,$user->password)) {
                
            }else{
                $validator->errors()->add('old_pwd', '密碼不符合！');
            }
        });

        if ($validator->fails()) {
            //
            return redirect('/account/change_pwd')
                        ->withErrors($validator)
                        ->withInput();
        }*/


    }
}
