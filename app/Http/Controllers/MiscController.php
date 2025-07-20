<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Application;
use App\Models\ApplicantPayment;
use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use App\Imports\StudentScoresImport;
use Maatwebsite\Excel\Facades\Excel;

class MiscController extends Controller{ 
    public function getStudent(Request $request){
        $validator = Validator::make($request->all(), ['degree'=>'required','matric_number'=>'required']);
        if ($validator->fails()) { 
            return response()->json(['message'=>'degree and matric number are required'], 422); 
        } 
        if (filter_var($request->matric_number, FILTER_VALIDATE_EMAIL)) {
            $table = 'applicants.email';
        } else {
            $table = 'applicants.matric_number';
        }
        
        $student = DB::table('applicants')->join('applications','applicants.email','applications.submitted_by')
                ->where(['applications.app_type'=>$request->degree,'applications.status' => 'admitted',
                $table => $request->matric_number])
                ->select('applicants.id as applicant_id','applicants.matric_number','applicants.surname','applicants.first_name','applicants.other_name','applicants.phone','applicants.email','applicants.level','applicants.gender','applications.first_choice->prog as prog','applications.first_choice->dept as dept','applications.first_choice->faculty as faculty','applicants.profile_pix','applicants.genotype','applicants.blood_group')->first();
        if(!$student){
            return response(["message"=>"Student not found"], 404);
        }
        if($request->degree == 'foundation'){
            $student->level = 'FOUNDATION';
        }
        $student->profile_pix = "https://destadms.run.edu.ng/storage/".$student->profile_pix;
        $student->genotype = "AA";
        $student->blood_group = "O+";
        return $student;
    }
    
    public function getStudents(Request $request){
        $validator = Validator::make($request->all(), ['degree'=>'required']);
        if ($validator->fails()) { 
            return response()->json(['message'=>'degree is required'], 422); 
        }
        $students = DB::table('applicants')->join('applications','applicants.email','applications.submitted_by')
            ->where(['applications.app_type'=>$request->degree,'applications.status' => 'admitted'])
            ->select('applicants.matric_number','applicants.surname','applicants.first_name','applicants.other_name','applicants.phone','applicants.email','applicants.gender','applications.first_choice->prog as prog','applications.first_choice->dept as dept','applications.first_choice->faculty as faculty','applicants.profile_pix','applicants.genotype','applicants.blood_group')->groupBy('applications.submitted_by')->
                orderBy('applicants.matric_number')->get();
        foreach($students as $student){
            $student->profile_pix = "https://destadms.run.edu.ng/storage/".$student->profile_pix;
            $student->genotype = "AA";
            $student->blood_group = "O+";
        }
        
        return $students;
    }
    
    public function getCardPayments(Request $request){
        $validator = Validator::make($request->all(), ['degree'=>'required', 'matric_number'=>'required']);
        if ($validator->fails()) { 
            return response()->json(['message'=>'Matric number and degree are required'], 422); 
        }
         return [[
            'matric_number' => $request->matric_number,
            'amount'=> 5000,
            'reference' => '67343234667',
            'payType' => 'school fees',
            'session' => '2024/2025',
            'date' => '2022-04-22 17:09:27',
        ]];
    }
    
    public function updateScores(Request $request){

        // $student = Registration::join('applicants','registration.student_id','applicants.id')
        //     ->where(['course_code'=>'RUN-GST 109','settings_id'=>'7','surname'=> $request->surname,'other_name' =>$request->other_name])
        //     ->first();
        // return $student;

        DB::statement("
            UPDATE registration
            JOIN applicants ON registration.student_id = applicants.id
            JOIN mass ON mass.surname = applicants.surname AND mass.other_name = applicants.other_name
            SET 
                registration.score = mass.score,
                registration.grade = mass.grade 
            WHERE registration.course_code = 'RUN-GST 109' AND registration.settings_id = 7");

        // $massRecords = DB::table('mass')->get();
        // $count = 0;

        // foreach ($massRecords as $record) {
        //     // Match student using surname and firstname
        //     $student = DB::table('applicants')
        //         ->where('surname', $record->surname)
        //         ->where('other_name', $record->other_name)
        //         ->select('applicants.id as student_id')
        //         ->first();

        //     if ($student) {
        //         // Update the registration table for that student
        //         DB::table('registration')
        //             ->where(['course_code'=>'RUN-GST 109','settings_id'=>'7'])
        //             ->where('student_id', $student->student_id)
        //             ->update([
        //                 'score' => $record->score,
        //                 'grade' => $record->grade
        //             ]);
        //         $count++;
        //     }
        // }

        // $validator = Validator::make($request->all(), ['file'=>'required']);
        // if ($validator->fails()) { 
        //     return response()->json(['message'=>'file is required'], 422); 
        // }

        // $response = Excel::import(new StudentScoresImport, $request->file('file'));

        return response(['message'=>'Successful'], 200);         
    }
}