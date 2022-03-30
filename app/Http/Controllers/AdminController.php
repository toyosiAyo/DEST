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
        $applicants = DB::table('applicants')->where('status','applicant')->count();
        $students = DB::table('applicants')->where('status','student')->count();
        $applications = DB::table('applications')->count();
        $payments = DB::table('application_payments')->where('status_msg','pending')->count();
        return view('admin.pages.dashboard',['data'=>$data,'applicants'=>$applicants,'students'=>$students,'applications'=>$applications,'payments'=>$payments]);
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
        return view('admin.pages.curriculum2',['data'=>$data,'courses'=>$courses,'programmes'=>$programmes]);
    }

    public function viewEventsPage(Request $request){
        $data = app('App\Http\Controllers\ConfigController')->auth_user(session('user'));
        $events = DB::table('events')->select('*')->get();
        $count = count($events);
        return view('admin.pages.events',['data'=>$data,'events'=>$events,'count'=>$count]);
    }


    public function create_curriculum(Request $request){
        $validator = Validator::make($request->all(), ['programme'=>'required',
        'user'=>'required','year'=>'required', 'degree'=>'required'] );
        if ($validator->fails()) {
            return response()->json(['error' => 'programme, degree, user, and year are required' ], 401);
        }
        try {
            $data = [];
            for($x=1; $x<=10; $x++){
                $index = 'row'.$x;
                if((!is_null($request->$index[0]) && $request->$index[0] !== '' ) &&
                (!is_null($request->$index[1]) && $request->$index[1] !== '' ) &&
                (!is_null($request->$index[2]) && $request->$index[2] !== '' )){
                array_push($data,["course_code"=>$request->$index[0], "programme_id"=>$request->programme,"course_status"=>$request->$index[1], "semester"=>$request->$index[2], "year"=>$request->year, "degree"=>$request->degree, "created_by"=>$request->user]);
                }
            }
            $res =  DB::table('curriculum')->insertOrIgnore($data);
            return response()->json(['success' => $res.' Rocords created by '.$request->user], 201);
       } 
        catch (\Throwable $th) {
            return response()->json(['error' => 'Error creating curriculum', 'th' => $th], 401);
        }      
    }

    public function postEvents(Request $request){
        //try{
            $filename = $request->file('image')->getClientOriginalName();
            $path = Storage::putFileAs('EventImage', $request->file('image'), $request->title ."_". date('YmdHis') ."_". $filename);
            DB::table('events')->insert([
                'title' => $request->title,'body' => $request->body,'date' => $request->date,'location' => $request->location,
                'image' => $path,'created_by' => Auth::user()->email
            ]);
            return response()->json(['status'=>'ok','message'=>'Event created!'], 200);
        // }
        // catch (\Throwable $th) {
        //     return response()->json(['status'=>'Nok','message'=>'Error creating event'], 500);
        // } 
    }

    public function logout(){
        if(session()->has('user')){
            session()->pull('user');
            return redirect('/admin');
        }
    }
}
