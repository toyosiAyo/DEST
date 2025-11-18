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
            $prog = DB::table('programmes')->where('programme',$_COOKIE['prog_id'])->first();  
            
            if($_COOKIE['degree']=="part_time"){
                $setting = app('App\Http\Controllers\ConfigController')->part_time_settings($request);
                $courses = DB::table('part_time_curriculum')->join('part_time_courses', 'part_time_curriculum.course_id','part_time_courses.id')
                ->where(['part_time_curriculum.semester'=>$setting->semester_code,'part_time_curriculum.level'=>$data->level,'part_time_curriculum.programme_id'=>$prog->programme_id])
                ->select('part_time_curriculum.*','part_time_courses.code AS course_code','part_time_courses.unit','part_time_courses.description AS course_title')->get();
                return view('student.registration',['courses'=>$courses,'data'=>$data, 'settings'=>$setting]);
            }
            
            $setting = app('App\Http\Controllers\ConfigController')->settings($request);
            $courses = DB::table('curriculum')->join('courses', 'curriculum.course_code', 'courses.course_code')
                ->where([['curriculum.degree','foundation_new'],
                    ['curriculum.semester',$setting->semester_code],['curriculum.year',1],['curriculum.programme_id',$prog->programme_id]])
                ->select('curriculum.*','courses.unit','courses.course_title','courses.status as course_id')->get();
                
            return view('student.registration',['courses'=>$courses,'data'=>$data, 'settings'=>$setting]);
                
        } catch (\Throwable $th) {
            return response()->json(['status'=>'Nok','message'=>'failed, Error from catch'],401); 
        }
    }

    public function view_registered_courses(Request $request){
        $data = app('App\Http\Controllers\ConfigController')->auth_user(session('user'));
        if($_COOKIE['degree']=="part_time"){
            $setting = app('App\Http\Controllers\ConfigController')->part_time_settings($request);
            $courses = DB::table('part_time_registered_courses')->join('part_time_courses', 'part_time_registered_courses.course_id', 'part_time_courses.id')
                ->join('part_time_registrations', 'part_time_registered_courses.reg_id', 'part_time_registrations.id')
                ->where(['matric_number'=> $data->matric_number,'settings_id'=> $setting->id])
                ->select('part_time_courses.code AS course_code','part_time_courses.description AS course_title','part_time_registered_courses.unit','part_time_registered_courses.status')
                ->get();
            return view('student.courses',['courses'=>$courses,'data'=>$data,'settings'=>$setting]);
        }
        
        $setting = app('App\Http\Controllers\ConfigController')->settings($request);
        $courses = DB::table('registration')->join('courses', 'registration.course_code', '=', 'courses.course_code')
            ->where([['student_id', $data->id],['settings_id', $setting->id]])->select('courses.*','registration.unit')->get();
        return view('student.courses',['courses'=>$courses,'data'=>$data,'settings'=>$setting]);
    }

    public function saveRegistration(Request $request){
        //return response(['status'=>'Nok','message'=>'Registration not opened for the semester yet',],401);
        $request->validate([ 'course' => 'required']);
        try {
            $data = app('App\Http\Controllers\ConfigController')->auth_user(session('user'));
            
            if($_COOKIE['degree']=="part_time"){
                $setting = app('App\Http\Controllers\ConfigController')->part_time_settings($request);
            }else{
                $setting = app('App\Http\Controllers\ConfigController')->settings($request);
            }
            $request->merge(['settings'=>$setting]);
            $check_payment = app('App\Http\Controllers\PaymentController')->checkSchoolfeePayment($request);
            if(count($check_payment) < 1){
                $check_exemption = app('App\Http\Controllers\PaymentController')->checkExemption($data->email);
                if(!$check_exemption){
                    return response(['status'=>'Nok','message'=>'School fee payment required for course registration',],403); 
                }
            }

            if($_COOKIE['degree']=="part_time"){
                //return response(['status'=>'Nok','message'=>'Registration not opened for the semester yet',],401);
                if($data->matric_number == ""){
                    return response(['status'=>'Nok','message'=>'Matric number required for registration!'],403); 
                }
                //$setting = app('App\Http\Controllers\ConfigController')->part_time_settings($request);
                $check = DB::table('part_time_registrations')->where(['matric_number'=> $data->matric_number,'settings_id'=>$setting->id,'status'=>1])->first();
                
                if($check){
                    return response()->json(['status'=>'Nok','message'=>'Registration already submitted for approval',],403); 
                }
                
                DB::beginTransaction();
                $id = DB::table('part_time_registrations')->insertGetId(
                    ['matric_number' => $data->matric_number, 'settings_id' => $setting->id,'level'=> $data->level]
                );
            
                foreach($request->course as $index => $value){ 
                    $course = explode("_", $value);
                    DB::table('part_time_registered_courses')->insert(['reg_id' =>$id , 'course_id' => $course[4],'unit'=>$course[2],'status' => $course[3]]);
                }
                DB::commit();
                return response(['status'=>'ok', 'message'=>'Course registration successfully submitted','settings'=>$setting],200);
            }
            
            //$setting = app('App\Http\Controllers\ConfigController')->settings($request);
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

    public function fetchSchoolFeesPayload(Request $request){
        $data = app('App\Http\Controllers\ConfigController')->auth_user(session('user'));

        if($_COOKIE['degree']=="part_time"){
            $settings = app('App\Http\Controllers\ConfigController')->part_time_settings($request);
        }else{
            $settings = app('App\Http\Controllers\ConfigController')->settings($request);
        }

        $request->merge(['app_id' => $_COOKIE['app_id'], 'app_type' => $_COOKIE['degree'], 'type' => 'school fees','settings'=>$settings]);

        $fee_schedule = app('App\Http\Controllers\PaymentController')->getPaymentSchedule($request);
        return view('student.payment_schedule',['payload'=>$fee_schedule['combined'],'settings'=>$settings, 'data'=> $data]);

    }

    public function viewTransactions(){
        $data = app('App\Http\Controllers\ConfigController')->auth_user(session('user'));
        $payments = DB::table('fees_payments')->where('email',$data->email)->orderBy('id','desc')->get();
        
        return view('student.transactions',['payments'=>$payments,'data'=>$data]);
    }
}
