<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Mail\ResetPasswordForm;
use App\Models\User;

class AuthController extends Controller
{

    public function forgotPassword(){
        return view('admin.forgot-password');
    }
    public function processForgotPassword(Request $request){
        $validator = Validator::make($request->all(),[
            'email' => 'required|email|exists:users,email'
        ]);
        if($validator->fails()){
            return redirect()->route('admin.forgotPassword')->withInput()->withErrors($validator);
        }
        $token = Str::random(60);

        DB::table('password_reset_tokens')->where('email',$request->email)->delete();

        DB::table('password_reset_tokens')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => now()
        ]);
     //send mail
     $user = User::where('email',$request->email)->first();
     $formData = ['token' => $token, 'user' => $user, 'mailSubject' => 'You have requested to reset your password.'];
     Mail::to($request->email)->send(new ResetPasswordForm($formData));
     return redirect()->route('admin.forgotPassword')->with('success','Please check your inbox to reset your password.');
 }

 public function resetPassword($token){
    $tokenExist = DB::table('password_reset_tokens')->where('token',$token)->first();
    if($tokenExist == null ){
     return redirect()->route('admin.forgotPassword')->with('error','Invalid Request.');
    }
     return view('admin.reset-password',['token' => $token]);
 }
 public function processResetPassword(Request $request) {
     $token = $request->token;
     $tokenObj = DB::table('password_reset_tokens')->where('token',$token)->first();
    if($tokenObj == null ){
     return redirect()->route('admin.forgotPassword')->with('error','Invalid Request.');
    }
    $user = User::where('email',$tokenObj->email)->first();

    $validator = Validator::make($request->all(),[
     'new_password' => 'required|min:5',
     'confirm_password' => 'required|same:new_password'
 ]);
 if($validator->fails()){
     return redirect()->route('admin.resetPassword',$token)->withErrors($validator);
 }
 User::where('id',$user->id)->update([
     'password' => Hash::make($request->new_password)
 ]);
 DB::table('password_reset_tokens')->where('email',$user->email)->delete();

 return redirect()->route('admin.login')->with('success','You have successfully updated your password.');

 }
}
