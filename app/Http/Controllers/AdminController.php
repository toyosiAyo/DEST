<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{    
    public function login(Request $request){
        $request->validate([
            'email'=>'required|email',
            'password'=>'required|min:4|max:8',
        ]);
       $app = Applicant::where([['email',$request->email],['status','admin']])->first();
        if(!$app){
            return response()->json(['status'=>'Nok','message'=>'You dont have the permission to access this resource'], 401);
        }
       else{
            if(Hash::check($request->password,$app->password)){
                $request->session()->put('user',$app->email);
                return response()->json(['status'=>'ok','message'=>'Login was successful'], 200);
            }
            else{
                return response()->json(['status'=>'Nok','message'=>'Wrong Credentilas'], 401);
            }
       }
    }

    public function adminDashboard(Request $request){
        $data = app('App\Http\Controllers\ConfigController')->auth_user(session('user'));
        return view('admin.pages.dashboard',['data'=>$data]);
    }

    public function pendingPayments(Request $request){
        $data = app('App\Http\Controllers\ConfigController')->auth_user(session('user'));
        $payments = DB::table('application_payments')->select('*')->where('status_msg','pending')->orderby('created_at','desc')->get();
        $count = count($payments);
        return view('admin.pages.pending_payments',['data'=>$data,'payments'=>$payments,'count'=>$count]);
    }

    public function allPayments(Request $request){
        $data = app('App\Http\Controllers\ConfigController')->auth_user(session('user'));
        $payments = DB::table('application_payments')->select('*')->orderby('created_at','desc')->get();
        $count = count($payments);
        return view('admin.pages.payments',['data'=>$data,'payments'=>$payments,'count'=>$count]);
    }

    public function viewApplicants(Request $request){
        $data = app('App\Http\Controllers\ConfigController')->auth_user(session('user'));
        $applicants = DB::table('applicants')->select('*')->where('status','applicant')->get();
        $count = count($applicants);
        return view('admin.pages.applicants',['data'=>$data,'applicants'=>$applicants,'count'=>$count]);
    }

    public function viewApplications(Request $request){
        $data = app('App\Http\Controllers\ConfigController')->auth_user(session('user'));
        $applications = DB::table('applications')->join('applicants', 'applications.submitted_by', '=', 'applicants.email')
        ->select('applications.*','first_choice->prog as Programme','applicants.surname','applicants.first_name','applicants.other_name')->get();
        $count = count($applications);
        return view('admin.pages.applications',['data'=>$data,'applications'=>$applications,'count'=>$count]);
    }

    public function viewPendingApplications(Request $request){
        $data = app('App\Http\Controllers\ConfigController')->auth_user(session('user'));
        $applications = DB::table('applications')->join('applicants', 'applications.submitted_by', '=', 'applicants.email')
        ->select('applications.*','first_choice->prog as Programme','applicants.surname','applicants.first_name','applicants.other_name')
        ->where('applications.status', 'pending')->get();
        $count = count($applications);
        return view('admin.pages.pending_applications',['data'=>$data,'applications'=>$applications,'count'=>$count]);
    }

    public function curriculum(Request $request){
        $data = app('App\Http\Controllers\ConfigController')->auth_user(session('user'));
        $courses = DB::table('courses')->select('*')->get();
        $programmes = DB::table('programmes')->select('*')->get();
        return view('admin.pages.curriculum',['data'=>$data,'courses'=>$courses,'programmes'=>$programmes]);
    }

    public function logout(){
        if(session()->has('user')){
            session()->pull('user');
            return redirect('/admin');
        }
    }
}
