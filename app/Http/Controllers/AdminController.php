<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Application;
use App\Models\ApplicantPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\File;
use PDF;

class AdminController extends Controller
{    
    public function __construct()
    {
       $this->middleware('authcheck',['except' => ['login',]]);
       // $this->middleware('log')->only('index');
       // $this->middleware('subscribed')->except('store');
    }



    public function view_adms_letter($path){
        $s_path = public_path('ADMS_LETTERS/'.$path);  
        if (File::exists($path.'.pdf')){
              return Response::make(file_get_contents($s_path.'.pdf'), 200, [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; filename="'.$path.'"'
            ]);
           
        } else{ return back();}
    }

    public function app_actions(Request $request){
        // view / approve / download ... 
        $validator = Validator::make($request->all(), ['email'=>'required|email','app_id'=>'required','action'=>'required','duration'=>'required']);
        if ($validator->fails()) { return response()->json(['status'=>'Nok','message'=>'Email/app_id/action are required','rsp'=>''], 401);        } 
        $data = app('App\Http\Controllers\ConfigController')->adminUser(session('user'));
        $get_app = Application::join('applicants','applications.submitted_by','applicants.email')
         ->where(['applications.id'=>$request->app_id,'applications.submitted_by'=>$request->email,'adms_y_n'=>'N']) 
         ->select('applications.first_choice->prog as Programme1','applications.second_choice->prog as Programme2','applicants.*','applications.*')->first(); 
         if($get_app){    
        if(strtoupper($request->action) == 'APPROVE'){
            $validator = Validator::make($request->all(), ['session'=>'required|min:8','duration'=>'required','resumption_date'=>'required', 'registration_closing'=>'required',]);
            if ($validator->fails()) { return response()->json(['status'=>'Nok','message'=>'session/duration/resumption_date/registration_closing are required','rsp'=>''], 401);        } 
            $get_app['duration'] = $request->duration;
            $get_app['accept_date'] = Date("F j, Y", strtotime('+14 days'));
            $get_app['session'] = $request->session;
            $get_app['session_formulated'] = substr(explode('/',$request->session)[0],-2). '-'.substr(explode('/',$request->session)[1],-2);
            $get_app['resumption_date'] = $request->resumption_date ; 
            $get_app['registration_closing'] = $request->registration_closing ; 
            // if($get_app->adms_y_n == "N"){
                if($get_app->app_type == 'foundation'){
                    // $pdf = PDF::loadView('foundation_admission',['data'=> $get_app]); 
                    if (File::exists('FOUNDATION_ACCEPTANCE_FORM.pdf') && File::exists('2022_2023_PROPOSED_FOUNDATION_FEE.pdf')) {  
                        if(app('App\Http\Controllers\ConfigController')->applicant_mail_attachment_foundation($get_app,$Subject="RUN DEST ADMISSION",$Msg=$this->get_delivery_msg($get_app))['status'] == 'ok'){
                            $get_app->adms_y_n = "Y";
                            $get_app->approved_by = $data->email;
                            $get_app->approved_at = date("F j, Y, g:i a");
                            $get_app->duration = $request->duration;
                            $get_app->accept_date = Date("F j, Y", strtotime('+14 days'));
                            $get_app->session_admitted = $request->session;
                            $get_app->resumption_date = $request->resumption_date ;
                            $get_app->registration_closing = $request->registration_closing ;
                            $get_app->status ="admitted";
                            unset($get_app->session);
                            unset($get_app->session_formulated);
                            if($get_app->save()){
                                //  File::delete($app_stud->address.'.pdf');
                                 return response(["status"=>"success","message"=>"Admission Letter successfully delivered"],200);  }
                            else{return response(["status"=>"failed","message"=>"Error updating recod for application"],401); }    
                        }else{return response(["status"=>"failed","message"=>"Error sending admission letter email "],401);}
                        }else{return response(["status"=>"failed","message"=>"No supporting document(s) in the directory"],401);  } 

                }elseif($get_app->app_type == 'part_time'){
                //  $pdf = PDF::loadView('part-time_admission',['data'=> $get_app]); 
                $validator = Validator::make($request->all(), ['degree'=>'required',]);
                if ($validator->fails()) { return response()->json(['status'=>'Nok','message'=>'degree is required','rsp'=>''], 401); } 
                    $get_app['degree'] = $request->degree;
                    if (File::exists('PART_TIME_ACCEPTANCE_FORM.pdf')&&File::exists('2022_2023_PROPOSED_CONVERSION_PROGRAMME.pdf')) {
                    if(app('App\Http\Controllers\ConfigController')->applicant_mail_attachment_pt($get_app,$Subject="RUN DEST ADMISSION",$Msg=$this->get_delivery_msg($get_app))['status'] == 'ok'){
                        $get_app->adms_y_n = "Y";
                        $get_app->approved_by = $data->email;
                        $get_app->approved_at = date("F j, Y, g:i a");
                        $get_app->duration = $request->duration;
                        $get_app->accept_date = Date("F j, Y", strtotime('+14 days'));
                        $get_app->session_admitted = $request->session;
                        $get_app->resumption_date = $request->resumption_date ;
                        $get_app->registration_closing = $request->registration_closing ;
                        $get_app->degree_4_pt =$request->degree ;
                        $get_app->status ="admitted";
                        unset($get_app->session);
                        unset($get_app->session_formulated);
                        unset($get_app->degree);
                        if($get_app->save()){
                            //  File::delete($app_stud->address.'.pdf');
                             return response(["status"=>"success","message"=>"Admission Letter successfully delivered"],200);  }
                        else{return response(["status"=>"failed","message"=>"Error updating recod for application"],401); }    
                    }else{return response(["status"=>"failed","message"=>"Error sending admission letter email "],401);}
                    }else{return response(["status"=>"failed","message"=>"No Letter File in the directory"],401);  } 
                 }else{return response(["status"=>"failed","message"=>"Error with application type"],401); }
            // File::put($get_app->surname."_".$get_app->app_type."_".$get_app->id.'.pdf', $pdf->output()); 
            // if (File::exists($get_app->surname."_".$get_app->app_type."_".$get_app->id.'.pdf')) {
            // }else{return response(["status"=>"failed","message"=>"Already approved application"],200) ;} 
        }elseif(strtoupper($request->action) == 'DOWNLOAD'){

                $headers = [ 'Content-Description' => 'File Transfer', 'Content-Type' => 'application/octet-stream',];                
                return Response::download(storage_path('app/'.$get_app->olevel_file),
                strtoupper($get_app->surname).'_O_LEVEL.jpg',$headers);

            }else{
                // foreach ($get_app->other_cert as $index => $val){
                //      explode('~',$val);
                // }
                return response()->json(['status'=>'Nok','message'=>'No category of request found...','rsp'=>''], 404);  
            }
 }else{return response()->json(['status'=>'Nok','message'=>'Application not found...','rsp'=>''], 404);   }

    
    
    }

    public function login(Request $request){
        $request->validate([
            'email'=>'required|email',
            'password'=>'required|min:4|max:8',
        ]);
       $app = Admin::where([['email',$request->email],['active',1]])->first();
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
        $data = app('App\Http\Controllers\ConfigController')->adminUser(session('user'));
        $applicants = DB::table('applicants')->where('status','applicant')->count();
        $students = DB::table('applications')->select('first_choice->prog as programme')->where('status', 'admitted')->count();
        $applications = DB::table('applications')->count();
        $payments = DB::table('application_payments')->where('status_msg','pending')->count();
        return view('admin.pages.dashboard',['data'=>$data,'applicants'=>$applicants,'students'=>$students,'applications'=>$applications,'payments'=>$payments]);
    }

    public function approve_payments(Request $request){
        $request->validate([ "pay_id" => "required","email"=>"required",'rrr'=>'required' ,'pay_type'=>'required',]);
        $data = app('App\Http\Controllers\ConfigController')->adminUser(session('user'));
        $payment = ApplicantPayment::join('applicants','application_payments.email','applicants.email')
        ->where(['application_payments.id'=>$request->pay_id,'application_payments.email'=>$request->email,
        'rrr'=>$request->rrr,'status_code'=>'025'])->select('application_payments.*','applicants.surname','applicants.first_name AS firstname')->first();
        if(!empty( $payment)){
            $payment->status_code = '00';
            $payment->status_msg = 'success';
            $payment->approved_by = $data->email;
            $payment->approved_at = date("F j, Y, g:i a");
            if($payment->save()){
               $init_app = new Application;
               $init_app->submitted_by = $payment->email;
               $init_app->app_type = $request->pay_type;
               $init_app->status = "pending";
               $init_app->form_status = '0';
               if($init_app->save()){
                   $Msg = 'Payment with Teller ID: '.$request->rrr.' has been successfully approved. <br> Kindly login to the portal and proceed with your application' ;
                    $Subject = " DEST@REDEEMER's UNIVERSITY, PAYMENT APPROVAL NOTIFICATION";
                    if(app('App\Http\Controllers\ConfigController')->applicant_mail($payment,$Subject,$Msg)['status'] == 'ok'){
                        return response()->json(['status'=>'ok','msg'=>'Payment approved successfully!'], 200);
                    }
                    else{ return response()->json(['status'=>'nok','msg'=>'Error sending payment approval!'], 401);  }
               }
            }
        }else{
            return response()->json(['status'=>'Nok','message'=>'Error, maybe Invalid Teller number supplied'], 401);
        }
    }
    public function pendingPayments(Request $request){
        $data = app('App\Http\Controllers\ConfigController')->adminUser(session('user'));
        $payments = DB::table('application_payments')->select('*')->where('status_msg','pending')->orderby('created_at','desc')->get();
        $count = count($payments);
        return view('admin.pages.pending_payments',['data'=>$data,'payments'=>$payments,'count'=>$count]);
    }

    public function allPayments(Request $request){
        $data = app('App\Http\Controllers\ConfigController')->adminUser(session('user'));
        $payments = DB::table('application_payments')->select('*')->orderby('created_at','desc')->get();
        $count = count($payments);
        return view('admin.pages.payments',['data'=>$data,'payments'=>$payments,'count'=>$count]);
    }

    public function viewApplicants(Request $request){
        $data = app('App\Http\Controllers\ConfigController')->adminUser(session('user'));
        $applicants = DB::table('applicants')->select('*')->where('status','applicant')->get();
        $count = count($applicants);
        return view('admin.pages.applicants',['data'=>$data,'applicants'=>$applicants,'count'=>$count]);
    }

    public function viewApplications(Request $request){
        $data = app('App\Http\Controllers\ConfigController')->adminUser(session('user'));
        $applications = DB::table('applications')->join('applicants', 'applications.submitted_by', '=', 'applicants.email')
        ->select('applications.*','first_choice->prog as Programme','applicants.surname','applicants.first_name','applicants.other_name')->latest()
        ->get();
        $count = count($applications);
        return view('admin.pages.applications',['data'=>$data,'applications'=>$applications,'count'=>$count]);
    }

    public function viewPendingApplications(Request $request){
        $data = app('App\Http\Controllers\ConfigController')->adminUser(session('user'));
        $applications = DB::table('applications')->join('applicants', 'applications.submitted_by', '=', 'applicants.email')
        ->select('applications.*','first_choice->prog as Programme','applicants.surname','applicants.first_name','applicants.other_name')
        ->where('applications.status', 'pending')->get();
        $count = count($applications);
        return view('admin.pages.pending_applications',['data'=>$data,'applications'=>$applications,'count'=>$count]);
    }

    public function curriculum(Request $request){
        $data = app('App\Http\Controllers\ConfigController')->adminUser(session('user'));
        $courses = DB::table('courses')->select('*')->get();
        $programmes = DB::table('programmes')->select('*')->get();
        return view('admin.pages.curriculum2',['data'=>$data,'courses'=>$courses,'programmes'=>$programmes]);
    }

    public function viewTemplate(Request $request){
        $data = app('App\Http\Controllers\ConfigController')->adminUser(session('user'));
        return view('template',['data'=>$data]);
    }

    public function viewEventsPage(Request $request){
        $data = app('App\Http\Controllers\ConfigController')->adminUser(session('user'));
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

    public function import_courses(Request $request){
        try {
            $validator = Validator::make(
                [ 'courses'      => $request->courses,
                    'extension' => strtolower($request->courses->getClientOriginalExtension())],
                [ 'courses'          => 'required',
                    'extension'      => 'required|in:csv,xlsx,xls' ],
                ['user'=>'required']
            );
            if ($validator->fails()) {
              return response()->json(['error' => 'select proper excel file to import or User required'], 401);
            }
            $failed_data = [];
            $data =  Excel::toArray(new CourseImport, request()->file('courses'));
            foreach($data[0] as $index => $row){
                if($index == 0) continue;
                    if (strlen(ltrim(rtrim($row[0]))) < 7) {
                    $failed_data = $row;
                    continue;
                }
                DB::table('courses')->insertOrIgnore([
                'course_code'=> $row[0],
                'course_title'=> $row[1],
                'unit'=> $row[2],
                'status'=> $row[3],
                'semester'=> $row[4],
                ]);
            }
                return response()->json(['success' => 'Course(s) uploaded successfully','failed'=>$failed_data], 201);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Error Uploading Courses', 'th' => $th], 401);
        }
    }

    public function adminviewCurriculum(Request $request){
        $data = app('App\Http\Controllers\ConfigController')->adminUser(session('user'));         
        $curriculum = DB::table('curriculum')->join('programmes', 'curriculum.programme_id', '=', 'programmes.programme_id')
            ->join('courses', 'curriculum.course_code', '=', 'courses.course_code')
            ->select('curriculum.*','courses.course_code','courses.course_title','courses.unit','programmes.programme')
            ->orderby('programme_id')->get();
        $count = count($curriculum);
        return view('admin.pages.view_curriculum',['count'=>$count, 'curriculum'=>$curriculum,'data'=>$data]);
    }

    public function getStudentsRegistrations(Request $request){
        $data = app('App\Http\Controllers\ConfigController')->adminUser(session('user'));    
        $setting = app('App\Http\Controllers\ConfigController')->settings($request);       
        $students = DB::table('registration')->join('applicants', 'registration.student_id', '=', 'applicants.id')
            ->join('courses', 'registration.course_code', '=', 'courses.course_code')
            ->join('applications', 'applicants.email', '=', 'applications.submitted_by')
            ->where([['applications.status','admitted'],['registration.settings_id',$setting->id]])
            ->select('registration.*','applicants.id AS stud_id','applicants.surname','applicants.first_name','applicants.email',
            'applications.first_choice->prog AS programme','applications.app_type')
            ->groupBy('registration.settings_id', 'registration.student_id')
            ->get();
        $count = count($students);
        return view('admin.pages.registration',['count'=>$count, 'students'=>$students,'data'=>$data]);
    }

    public function viewRegisteredCourses(Request $request){
        $setting = app('App\Http\Controllers\ConfigController')->settings($request);
        $courses = DB::table('registration')->join('courses', 'registration.course_code', '=', 'courses.course_code')
        ->where([['registration.student_id',$request->id],
            ['registration.settings_id',$setting->id]])->select('registration.course_code','registration.unit','courses.course_title')->get();
        return $courses;
    }

    public function viewRegPerProgramme(Request $request){
        $data = app('App\Http\Controllers\ConfigController')->adminUser(session('user'));    
        $setting = app('App\Http\Controllers\ConfigController')->settings($request);
        $students = DB::table('registration')->join('applicants', 'registration.student_id', '=', 'applicants.id')
            ->join('applications', 'applicants.email', '=', 'applications.submitted_by')
            ->where([['applications.status','admitted'],['registration.settings_id',$setting->id],
                ['registration.course_code',$data->role]])
            ->select('registration.*','applicants.id AS stud_id','applicants.surname','applicants.first_name',
            'applications.first_choice->prog AS programme','applications.app_type')->get();
        $count = count($students);
        return view('admin.pages.score_input',['count'=>$count, 'students'=>$students,'data'=>$data]);
    }

    public function viewLecturers(Request $request){
        $data = app('App\Http\Controllers\ConfigController')->adminUser(session('user'));
        $lecturers = DB::table('admin')->whereNotIn('role', ['director', 'admin', 'accountant'])->get();
        $programmes = DB::table('programmes')->select('*')->get();
        $count = count($lecturers);
        return view('admin.pages.lecturers',['count'=>$count,'programmes'=>$programmes, 'lecturers'=>$lecturers,'data'=>$data]);
    }

    public function createLecturers(Request $request){
        try{
            $check = DB::table('admin')->where('email',$request->email)->first();
            if($check){
                return response(['status'=>'Nok','message'=>'Email already exists!'], 500);
            }
            $password = Hash::make('12345678');
            DB::table('admin')->insert([
                'name' => $request->name, 'email'=> $request->email,'role' => $request->programme, 'password' => $password
            ]);
            return response(['status'=>'ok','message'=>'Lecturer created!'], 200);
        }
        catch (\Throwable $th) {
            return response(['status'=>'Nok','message'=>'Error creating lecturer'], 500);
        } 
    }

    public function postEvents(Request $request){
        try{
            $data = app('App\Http\Controllers\ConfigController')->adminUser(session('user'));
            $user = $data->email;
            $filename = $request->file('image')->getClientOriginalName();
            $path = Storage::putFileAs('EventImage', $request->file('image'), $request->title ."_". date('YmdHis') ."_". $filename);
            DB::table('events')->insert([
                'title' => $request->title,'body' => $request->body,'date' => $request->date,'location' => $request->location,
                'image' => $path,'created_by' => $user
            ]);
            return response()->json(['status'=>'ok','message'=>'Event created!'], 200);
        }
        catch (\Throwable $th) {
            return response()->json(['status'=>'Nok','message'=>'Error creating event'], 500);
        } 
    }

    public function logout(){
        if(session()->has('user')){
            session()->pull('user');
            return redirect('/admin');
        }
    }



    public function get_delivery_msg($data){
        try {
            return "Kindly find attached, Admission letter for
             ". $data->surname . " ".$data->firstname ." with email ". $data->submitted_by;
        } catch (\Throwable $th) {
            //throw $th;
        }
    }




















}
