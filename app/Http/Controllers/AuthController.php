<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
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
         $save = $app->save();
         if($save){
            $From = "ict@run.edu.ng";
            $FromName = "DEST@REDEEMER's UNIVERSITY";
            $Msg = app('App\Http\Controllers\ConfigController')->email_msg($code=$num_str);
            $Subject = "Email Verification";
            $HTML_type = true;
           // $res = Http::asForm()->post('http://adms.run.edu.ng/codebehind/destEmail.php',["From"=>$From,"FromName"=>$FromName,"To"=>$request->email,"Recipient_names"=>$request->surname,"Msg"=>$Msg, "Subject"=>$Subject,"HTML_type"=>$HTML_type,]);
            Http::asForm()->post('http://adms.run.edu.ng/codebehind/destEmail.php',["From"=>$From,"FromName"=>$FromName,"To"=>$request->email,"Recipient_names"=>$request->surname,"Msg"=>$Msg, "Subject"=>$Subject,"HTML_type"=>$HTML_type,]);
            return redirect('account_activate_view')->with('account_created','Account created successfully, Kindly get OTP sent to your email for account activation!');
         }else{
             return back()->with('fail','Issue creating account');
         }
    }

 

    public function auth_check(Request $request){
        $request->validate([
            'email'=>'required|email',
            'password'=>'required|min:4|max:8',
        ]);
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

    public function applicant_dashboard(Request $request){
       
            try {
                $data = app('App\Http\Controllers\ConfigController')->auth_user(session('user'));
                $applications = DB::table('applications')->select('*','first_choice->prog as Programme')
                ->where('submitted_by', $data->email)->get();
                $count = count($applications);
                return view('pages.home',['apps'=>$applications,'count'=>$count])->with('data', $data);
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


    public function forgot_password_post(){

        return redirect('forgot/password');
    }

    public function account_activate_view(){

        return view('auth/verify');
    }

    public function account_activate(Request $request){
        // $validator = Validator::make($_COOKIE, [ 'email' => 'required|string',]);
        // if ($validator->fails()) {
        //     return back()->with('fail','Email issue!');
        // }
        // $request->validate(['otp'=>'required|min:6|max:6',]) ;
        try {
            $app = Applicant::where('email','teewhy10@gmail.com')->first();
            if($app->otp == $request->otp){
                $app->email_verified_at = Carbon::now();
                $app->save();
                return redirect('/')->with('verified','Account verified successfully, Kindly login now'); 
            }
            return back()->with('fail','Error verifying account, supply correct OTP!');

        } catch (\Throwable $th) {
            return back()->with('fail','Error verifying account, Supply correct Email!');
        }
        
    }
    public function resend_otp(Request $request){
        // $validator = Validator::make($_COOKIE, [ 'email' => 'required|string',]);
        // if ($validator->fails()) {
        //     return back()->with('fail','Email issue!');
        // }
        // $request->validate(['otp'=>'required|min:6|max:6',]) ;
        try {
          
            $app = Applicant::where('email','reganalyst@yahoo.com')->first();
            if(!empty($app)){
                $From = "ict@run.edu.ng";
                $FromName = "DEST@REDEEMER's UNIVERSITY";
                $Msg = app('App\Http\Controllers\ConfigController')->email_msg($code=$app->otp);
                $Subject = "Email Verification";
                $HTML_type = true;
                Http::asForm()->post('http://adms.run.edu.ng/codebehind/destEmail.php',["From"=>$From,"FromName"=>$FromName,"To"=>$app->email,"Recipient_names"=>$app->surname,"Msg"=>$Msg, "Subject"=>$Subject,"HTML_type"=>$HTML_type,]);
                return back()->with('resend','OTP is successfully resent to  '.$app->email.' !');
               
            }
            return back()->with('fail','Error resending OTP 1 !');

        } catch (\Throwable $th) { 
            return back()->with('fail','Error resending OTP 2 ! ');
        }
        
    }


    public function logout(){
        if(session()->has('user')){
            session()->pull('user');
            if (isset($_COOKIE['pin']) && isset($_COOKIE['app_type'])) {
                unset($_COOKIE['pin']);
                unset($_COOKIE['app_type']);
               // setcookie('key', '', time() - 3600, '/'); // empty value and old timestamp
            }
            return redirect('/');
        }
    }













}
