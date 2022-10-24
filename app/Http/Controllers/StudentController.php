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
            $courses = DB::table('curriculum')->where([['degree',$_COOKIE['degree']],
                ['semester',1],['year',1],['programme_id',$prog->programme_id]])->select('*')->get();
            
            //$registered = $this->viewRegisteredCourses($request);
            return view('student.registration',['courses'=>$courses]);
                
        } catch (\Throwable $th) {
                return response()->json(['status'=>'Nok','msg'=>'failed, Error from catch'],401); 
        }
    }

}
