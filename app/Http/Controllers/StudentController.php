<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Applicant;
use App\Models\Application;
use App\Models\ApplicantPayment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;


class StudentController extends Controller
{
    public function __construct(){
        $this->middleware('authcheck');
    }

    public function view_registration(Request $request){
        try {   
            if($_COOKIE['degree']=="" || $_COOKIE['prog_id']==""){
                return response()->json(['message'=>'failed', 'info'=>'programme/degree is required!']);
            }   
            $data = app('App\Http\Controllers\ConfigController')->auth_user(session('user'));
            $setting = app('App\Http\Controllers\ConfigController')->settings($request);
            $prog = DB::table('programmes')->where('programme',$_COOKIE['prog_id'])->first();  
            $courses = DB::table('curriculum')->join('courses', 'curriculum.course_code', '=', 'courses.course_code')
                ->where([['curriculum.degree',$_COOKIE['degree']],
                    ['curriculum.semester',$setting->semester_code],['curriculum.year',1],['curriculum.programme_id',$prog->programme_id]])
                ->select('curriculum.*','courses.unit','courses.course_title')->get();
            //$registered = $this->viewRegisteredCourses($request);
            return view('student.registration',['courses'=>$courses,'data'=>$data]);
                
        } catch (\Throwable $th) {
                return response()->json(['status'=>'Nok','message'=>'failed, Error from catch'],401); 
        }
    }

    public function view_registered_courses(Request $request){
        $data = app('App\Http\Controllers\ConfigController')->auth_user(session('user'));
        $setting = app('App\Http\Controllers\ConfigController')->settings($request);
        $courses = DB::table('registration')->join('courses', 'registration.course_code', '=', 'courses.course_code')
            ->where([['student_id', $data->id],['settings_id', $setting->id]])->select('courses.*','registration.unit')->get();
        return view('student.courses',['courses'=>$courses,'data'=>$data]);
    }

    public function saveRegistration(Request $request){
        $request->validate([ 'course' => 'required']);
        try {
            $data = app('App\Http\Controllers\ConfigController')->auth_user(session('user'));
            $setting = app('App\Http\Controllers\ConfigController')->settings($request);
            $check = DB::table('registration')->where(['student_id'=> $data->id,'settings_id'=>$setting->id])->first();
                if($check){
                    return response()->json(['status'=>'Nok','message'=>'Registration already submitted for approval',],401); 
                }
            foreach($request->course as $index => $value){ 
                $course = explode("_", $value);
                DB::table('registration')->insert([
                    'course_code' => $course[0],
                    'student_id' => $data->id,
                    'settings_id' => $setting->id,
                    'unit' => $course[2]
                ]);
            }
            return response()->json(['status'=>'ok','message'=>'Course registration successfully submitted',],201);    
        }   
        catch (\Throwable $th) {
            return response()->json(['status'=>'Nok','message'=>'failed, Error from catch'],401);    
        }

    }

}
