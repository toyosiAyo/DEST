<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use Illuminate\Http\Request;
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
            dd($request->all());
         $request->validate([
             'surname'=>'required|string',
             'firstName'=>'required|string',
             'otherName'=>'required|string',
             'phone'=>'required|string|unique:applicants',
             'email'=>'required|email|unique:applicants',
             'password'=>'required|confirmed|min:4',
         ]) ;
         $app = new Applicant;
         
         $app->surname = $request->surname;
         $app->first_name = $request->firstName;
         $app->other_name = $request->otherName;
         $app->phone = $request->phone;
         $app->email = $request->email;
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

    public function applicant_dashboard(){
        $data = ['user'=> Applicant::where('email',session('user'))->first()];
      return view('pages.home',$data);
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
