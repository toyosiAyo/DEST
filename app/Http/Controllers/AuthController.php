<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
//use App\Http\Controllers\FreakMailer;

class AuthController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware('auth');
    //     $this->middleware('log')->only('index');
    //     $this->middleware('subscribed')->except('store');
    // }

 

    public function auth_login(){
       
       // $data = array('yellow','red','red','blue','pupple');
        //return count(array_unique($data));
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
             'password'=>'required|confirmed|min:4',
             'gender'=>'required|size:1',
         ]) ;
         $app = new Applicant;
         $app->surname = $request->surname;
         $app->first_name = $request->firstname;
         $app->other_name = $request->othername;
         $app->phone = $request->phone;
         $app->email = $request->email;
         $app->gender = $request->gender;
         $app->password = Hash::make($request->password);
         $save = $app->save();
         if($save){
            return back()->with('success','Account created successfully');
         }else{
             return back()->with('fail','Issue creating account');
         }
    }

    public function auth_check(Request $request){
       // dd($request->all());
        $request->validate([
            'email'=>'required|email',
            'password'=>'required|min:4|max:8',
        ]);
       $app = Applicant::where('email',$request->email)->first();
       if(!$app){return back()->with('fail','We do not recognize the supplied email');}
       else{
           if(Hash::check($request->password,$app->password)){
              
            $request->session()->put('user',$app->email);

            return redirect('dashboard');
           }else{return back()->with('fail','incorrect email/password!'); }
       }
    }

    public function applicant_dashboard(Request $request){
       
        if($request->session()->has('user')){
            $data = app('App\Http\Controllers\ConfigController')->auth_user(session('user'));
            $applications = DB::table('applications')->select('*','first_choice->prog as Programme')
                ->where('submitted_by', $data->email)->get();
            return view('pages.home',['apps'=>$applications])->with('data', $data);
          }
          else{
              dd("No Session");  
          }
       
       
    }


    public function user_profile(Request $request){
        if($request->session()->has('user')){
            $data = app('App\Http\Controllers\ConfigController')->auth_user(session('user'));
            return view('pages.profile')->with('data', $data);
          }
          else{
              dd("No Session");  
          }
    }

    public function view_applications(Request $request){
        if($request->session()->has('user')){
            $data = app('App\Http\Controllers\ConfigController')->auth_user(session('user'));
            $applications = DB::table('applications')->select('*','first_choice->prog as Programme')
                ->where('submitted_by', $data->email)->get();
            return view('pages.applications',['apps'=>$applications])->with('data', $data);
        }
        else{
              dd("No Session");  
        }
    }

    public function view_payments(Request $request){
        if($request->session()->has('user')){
            $data = app('App\Http\Controllers\ConfigController')->auth_user(session('user'));
            $payments = DB::table('application_payments')->select('*')->where('email', $data->email)->get();
            return view('pages.payment_history',['payments'=>$payments])->with('data', $data);
        }
        else{
              dd("No Session");  
        }
    }


    public function forgot_password(){

        return view('auth.forgot-password');
    }
    public function forgot_password_post(){

        return redirect('forgot/password');
    }

    public function logout(){
        if(session()->has('user')){
            session()->pull('user');
            return redirect('/');
        }
    }













}
