<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Application;
use App\Models\Applicant;
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
use Illuminate\Validation\Rule;

class MiscController extends Controller{ 
    /**
     * @OA\Get(
     *   path="/api/get-dest-student",
     *   tags={"Misc"},
     *   summary="Get a single student by matric number or email",
     *   @OA\Parameter(name="degree", in="query", required=true, @OA\Schema(type="string")),
     *   @OA\Parameter(name="matric_number", in="query", required=true, description="matric number or email", @OA\Schema(type="string")),
     *   @OA\Response(response=200, description="Student found"),
     *   @OA\Response(response=404, description="Student not found"),
     *   @OA\Response(response=422, description="Validation error")
     * )
     */
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
        //$student->genotype = "AA";
        //$student->blood_group = "O+";
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
            //$student->genotype = "AA";
            //$student->blood_group = "O+";
        }
        
        return $students;
    }

    /**
     * @OA\Get(
     *   path="/api/get-all-card-payments",
     *   tags={"Misc"},
     *   summary="Get all card payments in a session",
     *   @OA\Parameter(name="degree", in="query", required=true, @OA\Schema(type="string")),
     *   @OA\Parameter(name="session", in="query", required=true, @OA\Schema(type="string")),
     *   @OA\Response(response=200, description="Payment records returned"),
     *   @OA\Response(response=422, description="Validation error")
     * )
     */
    public function getAllSessionIDCardPayments(Request $request){
        $validator = Validator::make($request->all(), ['session' => 'required','degree' => ['required', Rule::in(['foundation', 'part_time'])]]);
        if($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $payments = DB::table('admission_payments')->join('applicants','admission_payments.email','applicants.email')
            ->where(['admission_payments.status'=>'success','admission_payments.degree'=>$request->degree,'admission_payments.session_name'=>$request->session])
            ->select('applicants.matric_number','admission_payments.reference','admission_payments.created_at','admission_payments.session_name','admission_payments.payload')->get();

        $results = $payments->map(function ($payment) {
            $payload = json_decode($payment->payload, true);

            $items = isset($payload[0]) ? $payload : [$payload];

            // Search for I.D CARD in payment_payload
            $idCardItem = collect($items)->firstWhere('item', 'ID Card');

            if ($idCardItem) {
                return [
                    'matric_number' => $payment->matric_number,
                    'amount'=> $idCardItem['amount'],
                    'reference' => $payment->reference,
                    'payType' => $idCardItem['type'],
                    'session' => $payment->session_name,
                    'date' => $payment->created_at,
                ];
            }
            return null;
        })->filter()->values();
        
        if(count($results) < 1){
            return response()->json(['message' => 'No ID card payment found'], 404);
        }

        return $results;
    }

    /**
     * @OA\Get(
     *   path="/api/get-all-card-exemption",
     *   tags={"Misc"},
     *   summary="Get ID card exemption list in a session",
     *   @OA\Parameter(name="degree", in="query", required=true, @OA\Schema(type="string")),
     *   @OA\Parameter(name="session", in="query", required=true, @OA\Schema(type="string")),
     *   @OA\Response(response=200, description="Payment records returned"),
     *   @OA\Response(response=422, description="Validation error")
     * )
     */

    public function getCardExemptions(Request $request){
        $validator = Validator::make($request->all(), ['session' => 'required','degree' => ['required', Rule::in(['foundation', 'part_time'])]]);
        if($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $card_payments = DB::table('idcard_exemption')->join('applicants','idcard_exemption.email','applicants.email')
            ->select('applicants.matric_number','idcard_exemption.session','idcard_exemption.created_at AS date')
            ->where(['idcard_exemption.session'=>$request->session,'idcard_exemption.degree'=>$request->degree])->get();
            
        if(count($card_payments) < 1){
            return response()->json(['message' => 'No ID card exemption found'], 404);
        }
        
        return $card_payments;
    }

     /**
     * @OA\Patch(
     *   path="/api/update-profile-lock",
     *   tags={"Misc"},
     *   summary="Lock or unlock student profile update",
     *   @OA\Parameter(name="matric_number", in="query", required=true, @OA\Schema(type="string")),
     *   @OA\Parameter(name="action", in="query", required=true, description="Action to perform", @OA\Schema(type="string",enum={"lock","unlock"},default="lock")),
     *   @OA\Response(response=200, description="Payment records returned"),
     *   @OA\Response(response=422, description="Validation error")
     * )
     */
    public function profileLockUpdate(Request $request){
        $validator = Validator::make($request->all(), ['matric_number' => 'required','action' => ['required', Rule::in(['lock', 'unlock'])]]);
        if($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        
        $check = Applicant::where('matric_number',$request->matric_number)->first();
        if($check){
            $check->profile_update_lock = $request->action;
            $check->save();
            return response()->json(['message' => 'Profile '.$request->action.'ed'], 200);
        }
        
        return response()->json(['message' => 'Matric number not found'], 404);
    }
    
    /**
     * @OA\Get(
     *   path="/api/get-card-payments",
     *   tags={"Misc"},
     *   summary="Get card payment history/sample for a student",
     *   @OA\Parameter(name="degree", in="query", required=true, @OA\Schema(type="string")),
     *   @OA\Parameter(name="matric_number", in="query", required=true, description="matric number or email", @OA\Schema(type="string")),
     *   @OA\Response(response=200, description="Payment records returned"),
     *   @OA\Response(response=422, description="Validation error")
     * )
     */
    public function getCardPayments(Request $request){
        $validator = Validator::make($request->all(), ['degree'=>'required', 'matric_number'=>'required']);
        if ($validator->fails()) { 
            return response()->json(['message'=>'Matric number and degree are required'], 422); 
        }

        if (filter_var($request->matric_number, FILTER_VALIDATE_EMAIL)) {
            $table = 'applicants.email';
        } else {
            $table = 'applicants.matric_number';
        }

        if($request->degree == 'foundation'){
            $settings_table = 'settings';
        }
        else{
            $settings_table = 'part_time_settings';
        }

        $payments = DB::table('admission_payments')->join('applicants','admission_payments.email','applicants.email')
            ->join($settings_table,'admission_payments.session',$settings_table.'.id')
            ->where([$table => $request->matric_number,'admission_payments.status'=>'success','admission_payments.degree'=>$request->degree])
            ->select('applicants.matric_number','admission_payments.reference','admission_payments.created_at',$settings_table.'.session','admission_payments.payload')->get();

        $results = $payments->map(function ($payment) {
            $payload = json_decode($payment->payload, true);

            $items = isset($payload[0]) ? $payload : [$payload];

            // Search for I.D CARD in payment_payload
            $idCardItem = collect($items)->firstWhere('item', 'ID Card');

            if ($idCardItem) {
                return [
                    'matric_number' => $payment->matric_number,
                    'amount'=> $idCardItem['amount'],
                    'reference' => $payment->reference,
                    'payType' => $idCardItem['type'],
                    'session' => $payment->session,
                    'date' => $payment->created_at,
                ];
            }
            return null;
        })->filter()->values();
        
        if(count($results) < 1){
            return response()->json(['message' => 'No ID card payment found'], 404);
        }

        return $results;
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

    public function makeApplicantStudent(Request $request){
        set_time_limit(0); 

        $records = 0;
        $students = DB::table('part_time_exemption_list')->where('migrated', 0)->get();
        foreach ($students as $student) {
            DB::table('applicants')->where('email', $student->email)->update(
                ['level' => $student->level, 'status' => 'student']
            );
            $records++;
        }
        return response(['success' => true,'message'=>'Applicants updated successfully!', 'records' => $records], 200);
    }

    public function getDups(Request $request){
        // $dups = DB::table('part_time_exemption_list')
        //     ->select('email', DB::raw('COUNT(*) as count'))
        //     ->groupBy('email')
        //     ->having('count', '>', 1)
        //     ->get();

        // $delete_dups = DB::table('part_time_exemption_list')
        //     ->whereNotIn('id', function($q){
        //         $q->select(DB::raw('MIN(id)'))
        //         ->from('part_time_exemption_list')
        //         ->groupBy('email');
        //     })->delete();

           $deleted = DB::statement("
                DELETE p1 FROM part_time_exemption_list p1
                INNER JOIN part_time_exemption_list p2
                ON p1.email = p2.email
                WHERE p1.id > p2.id
            ");

        return $deleted;
    }
}