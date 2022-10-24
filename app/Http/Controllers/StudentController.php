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
                return response()->json(['msg'=>'failed', 'info'=>'programme/degree is required!']);
            }   
            $prog = DB::table('programmes')->where('programme',$_COOKIE['prog_id'])->first();            
            $courses = DB::table('curriculum')->join('courses', 'curriculum.course_code', '=', 'courses.course_code')
                ->where([['degree',$_COOKIE['degree']],
                    ['curriculum.semester',1],['year',1],['programme_id',$prog->programme_id]])
                ->select('curriculum.*','courses.unit','courses.course_title')->get();
            
            //$registered = $this->viewRegisteredCourses($request);
            return view('student.registration',['courses'=>$courses]);
                
        } catch (\Throwable $th) {
                return response()->json(['status'=>'Nok','msg'=>'failed, Error from catch'],401); 
        }
    }

}
