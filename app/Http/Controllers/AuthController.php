<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class AuthController extends Controller
{

    public function __construct()
    {
        $this->middleware('authcheck',['only' => ['password_reset','applicant_dashboard']]);
       // $this->middleware('log')->only('index');
       // $this->middleware('subscribed')->except('store');
    }
 

    public function auth_login(){
        return view('auth.login');
    }
    public function register_form(){
        
        return view('auth.register');
    }


    public function save_new_account(Request $request){
            
         $request->validate([
             'surname'=>'required|string',
             'firstname'=>'required|string',
             'othername'=>'required|string',
             'phone'=>'required|string|min:8|max:15|unique:applicants,phone',
             'email'=>'required|email|unique:applicants,email',
             'password'=>'required|confirmed|min:4|max:8',
             'gender'=>'required|size:1',
         ]) ;
         $num_str = sprintf("%06d", mt_rand(1, 999999));
         $app = new Applicant;
         $app->surname = $request->surname;
         $app->first_name = $request->firstname;
         $app->other_name = $request->othername;
         $app->phone = $request->phone;
         $app->email = $request->email;
         $app->gender = $request->gender;
         $app->password = Hash::make($request->password);
         $app->otp = $num_str;
         if($app->save()){
             //setcookie(name, value, expire, path, domain, secure, httponly);
            setcookie('email',$request->email,time()+(84000*30),'/');
            $Msg = app('App\Http\Controllers\ConfigController')->email_msg($code=$num_str);
            $Subject = " DEST@REDEEMER's UNIVERSITY, Email Verification";
            if(app('App\Http\Controllers\ConfigController')->applicant_mail($request,$Subject,$Msg)['status'] == 'ok'){
                return redirect('account_activate_view')->with('account_created','Account created successfully, Kindly get OTP sent to your email for account activation!');
            }
            return back()->with('fail','Issue sending mail for account activation!');         
        }else{
             return back()->with('fail','Issue creating account');
         }
    }

 

    public function auth_check(Request $request){
        $request->validate([
            'email'=>'required|email',
            'password'=>'required|min:4|max:8',
        ]);
        $email_cookie = setcookie('email',$request->email, time() + (86400 * 30), "/");
       $app = Applicant::where('email',$request->email)->first();
       if(!$app){return back()->with('fail','We do not recognize the supplied email');}
       else{
            if(empty($app->email_verified_at)){
                return redirect('account_activate_view')->with('verify',' Kindly supply here, OTP sent to your email for account activation!');}
           if(Hash::check($request->password,$app->password)){
            $request->session()->put('user',$app->email);
            return redirect('dashboard');
           }else{return back()->with('fail','incorrect email/password!'); }
       }
    }

    public function studentLogin(Request $request){
        $request->validate([
            'student_email'=>'required|email',
            'student_password'=>'required',
        ]);
        $app = Application::where([
            ['submitted_by', $request->student_email],
            ['status', 'admitted'],
        ])->first();
        $user = Applicant::where('email',$request->student_email)->first();
        if(!$app){
            return response(['status'=>'Nok','message'=>'Login failed... We do not recognize your credentials'], 401);
        }
        else{
            if(Hash::check($request->student_password,$user->password)){
                $request->session()->put('user',$app->student_email);
                return response(['status'=>'ok','message'=>'Login was successful'], 200);
            }
            else{
                return response(['status'=>'Nok','message'=>'Login failed... Incorrect password'], 401);
            }
       }
    }

    public function applicant_dashboard(Request $request){
       
            try {
                $data = app('App\Http\Controllers\ConfigController')->auth_user(session('user'));
                $applications = DB::table('applications')->select('*','first_choice->prog as Programme')
                ->where('submitted_by', $data->email)->latest()->get();
                $count = count($applications);
                $success = DB::table('applications')->where([
                    ['submitted_by', $data->email],
                    ['status', 'success'],
                ])->count();
                $pending = DB::table('applications')->where([
                    ['submitted_by', $data->email],
                    ['status', 'pending'],
                ])->count();
                return view('pages.home',['apps'=>$applications,'count'=>$count,'success'=>$success,'pending'=>$pending])->with('data', $data);
            } catch (\Throwable $th) {
                return back()->with('applicant_dashboard','applicant_dashboard');
            }  
       
    }



    public function password_reset(Request $request){
        $request->validate(['password'=>'required|confirmed|min:4|max:8', 'current_pass'=>'required|min:4|max:8',]) ;

        try {
            $data = app('App\Http\Controllers\ConfigController')->auth_user(session('user')); 
            $user_obj = Applicant::findOrFail($data->id);
            if(Hash::check($request->current_pass,$user_obj->password)){
                $user_obj->password = Hash::make($request->password);
                $user_obj->save();
                return response()->json(['status'=>'ok','msg'=>"Password reset successfully!"],201); 
               }else{
                return response()->json(['status'=>'Nok','msg'=>"Your old password isn't match!"],401); 
                }
        } catch (\Throwable $th) {
            return response()->json(['status'=>'Nok','msg'=>'failed reseting password'],401); 
        }
    }


    public function forgot_password(){

        return view('auth.forgot-password');
    }


    public function forgot_password_post(Request $request){
        $request->validate(['email'=>'required|email',]) ;
        try {
          $app = Applicant::where('email',$request->email)->first();
          if(!empty($app)){
              $auto_pass = app('App\Http\Controllers\ConfigController')->generateRandomString(6);
              $app->password = Hash::make($auto_pass);
              if($app->save()){
                $Msg = 'Kindly use this auto-generated password '.$auto_pass.' to login into your portal </br></br>
                Note: Remeber to change this password!';
                $Subject = "DEST@REDEEMER's UNIVERSITY Password Reset!";
                if(app('App\Http\Controllers\ConfigController')->applicant_mail($app,$Subject,$Msg)['status'] == 'ok'){
                    return redirect('/')->with('pass_reset','Success, Check your email for the new password!');
                } return back()->with('fail','Error sending email for password reset!');          
              }
          }
          return back()->with('fail','Wrong email supplied!');
        } catch (\Throwable $th) {
            return back()->with('fail','Email issue with forgot password!');
        }

    }

    public function account_activate_view(){

        return view('auth/verify');
    }

    public function account_activate(Request $request){
        //dd($_COOKIE);
        $validator = Validator::make($_COOKIE, [ 'email' => 'required|string',]);
        if ($validator->fails()) {
            return back()->with('fail','Email issue!');
        }
        $request->validate(['otp'=>'required|min:6|max:6',]) ;
        try {
            $app = Applicant::where('email',$_COOKIE['email'])->first();
            if($app->otp == $request->otp){
                $app->email_verified_at = Carbon::now();
                $app->save();
                if (isset($_COOKIE['email'])) { unset($_COOKIE['email']); setcookie('email', '', time() - 3600, '/');}
                return redirect('/')->with('verified','Account verified successfully, Kindly login now'); 
            }
            return back()->with('fail','Error verifying account, supply correct OTP!');

        } catch (\Throwable $th) {
            return back()->with('fail','Error verifying account, Supply correct Email!');
        }
        
    }
    public function resend_otp(Request $request){
        $validator = Validator::make($_COOKIE, [ 'email' => 'required|string',]);
        if ($validator->fails()) {
            return back()->with('fail','Email issue!');
        }
        //try {
          
            $app = Applicant::where('email',$_COOKIE['email'])->first();
            if(!empty($app)){
                $Msg = app('App\Http\Controllers\ConfigController')->email_msg($code=$app->otp);
                $Subject = " DEST@REDEEMER's UNIVERSITY, Email Verification";
                if(app('App\Http\Controllers\ConfigController')->applicant_mail($app,$Subject,$Msg)['status'] == 'ok'){
                    return back()->with('resend','OTP is successfully resent to  '.$app->email.' !');
                }               
            }
            return back()->with('fail','Error resending OTP 1 !');

        // } catch (\Throwable $th) { 
        //     return back()->with('fail','Error resending OTP 2 ! ');
        // }
        
    }


    public function logout(){
        if(session()->has('user')){
            session()->pull('user');
            if (isset($_COOKIE['pin']) && isset($_COOKIE['app_type'])) {
                unset($_COOKIE['pin']); setcookie('pin', '', time() - 3600, '/');
                unset($_COOKIE['app_type']); setcookie('app_type', '', time() - 3600, '/');
               // setcookie('key', '', time() - 3600, '/'); // empty value and old timestamp
            }
            return redirect('/');
        }
    }













}
