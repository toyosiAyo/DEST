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


class ApplicationController extends Controller
{
        public function __construct()
    {
        $this->middleware('authcheck');
       // $this->middleware('log')->only('index');
       // $this->middleware('subscribed')->except('store');
    }

    
    public function test_mail(){
        $data = (object)[];
        $data->email = 'reganalyst@yahoo.com';
        $data->surname = 'Teewhy';
        $data->firstname = 'baba';
        $subject = "Email Testing";
        $msg = "From dest ............... Just to test if mail service it working fine";
        if(app('App\Http\Controllers\ConfigController')->applicant_mail($data,$subject,$msg)['status'] == 'ok'){
            dd('working');
        }
        dd('Not working');
        // 
    }

   
  
        protected $pin = "";

        //return back()->with('fail','incorrect email/password!'); 
    public function get_app_form(Request $request){
        $validator = Validator::make($_COOKIE, [ 'app_type' => 'required|string',]);
        if ($validator->fails()) {
            return back()->with('fail','app_type is required !');
        }
        try {
            $data = app('App\Http\Controllers\ConfigController')->auth_user(session('user'));
            $pin = $_COOKIE['pin'];
            $app_type = $_COOKIE['app_type'];
            $form_status = DB::table('applications')->where(['submitted_by'=> $data->email,'app_type'=>$app_type,'status'=>'pending'])->pluck('form_status');
            dd($form_status);
            if(!empty($pin) && !$form_status->isEmpty()){
                $o_level = DB::table('o_level_subjects')->select('id','subject')->get();
                $faculties = app('App\Http\Controllers\ConfigController')->college_dept_prog($request)['faculties'];
                $sub_grade = array("A1", "B2", "B3", "C4", "C5", "C6", "D7", "E8", "F9");
                return view('/pages/form',['o_level'=> $o_level,'sub_grade'=>$sub_grade,'pin'=>$pin,'data'=> $data,'faculties'=> $faculties,'form_status'=>$form_status ]);
            }
            else {
                return view('/pages/create_application')->with('data',$data);
            } 
        } catch (\Throwable $th) {
            return back()->with('fail','Error getting application form!'); 
        }
     
    }


    public function checkForUsedPin($request){
        try {
            $data = app('App\Http\Controllers\ConfigController')->auth_user(session('user'));
            $used_pin = DB::table('application_payments')
            ->join('applications','application_payments.rrr','applications.used_pin')
            ->where('application_payments.email',$data->email)->pluck('rrr'); 

            $success_pin = DB::table('application_payments')->select('rrr')
            ->where('email',$data->email)
            ->where('status_code','00')->where('pay_type', $request->payType)->whereNotIn('rrr', $used_pin)->get();
            // Remove when payment gateway is ready
            $pending_pin = DB::table('application_payments')->select('rrr')
            ->where('email',$data->email)
            ->where('status_msg','pending')->where('pay_type', $request->payType)->whereNotIn('rrr', $used_pin)->get();
           // Remove when payment gateway is ready
            if($pending_pin->count() !=0){
                $pin = $pending_pin[0]->rrr;
                $this->pin = $pending_pin[0]->rrr;
               // return $pin;
                return ['status'=>'ok','msg'=>'pending','pin'=>$pin];  
            }
            if($success_pin->count() !=0){
                $pin = $success_pin[0]->rrr;
                $this->pin = $success_pin[0]->rrr;
               // return $pin;
                return ['status'=>'ok','msg'=>'success','pin'=>$pin];  
            }
            return ['status'=>'Nok','msg'=>'No Pin','pin'=>''];  

        } catch (\Throwable $th) {
            return response()->json(['status'=>'Nok','msg'=>'Failed, in checkForUsedPin() catch '], 401);
        }
    }

    public function create_application(Request $request){

            $data = app('App\Http\Controllers\ConfigController')->auth_user(session('user'));
            return view('/pages/create_application')->with('data', $data);
       
         }

 
    public function save_app_form(Request $request){
        //$settings = app('App\Http\Controllers\ConfigController')->settings($request)->semester_name;    
        $validator = Validator::make($_COOKIE, [ 'pin' => 'required|string', 'app_type'=> 'required|string',]);
        if ($validator->fails()) {
            return back()->with('fail','pin/app_type are required !');
        }
       
        try {
        $data = app('App\Http\Controllers\ConfigController')->auth_user(session('user')); 
        if($request->check_step == 'basic'){
            $app =  Applicant::findOrFail($data->id);
            if($request->disability_check == "yes") $app->disability = $request->disability;
            $app->address_resident = $request->address_resident;
            $app->dob = $request->dob;
            $app->city_resident = $request->city_resident;
            $app->country_resident = $request->country;
            $app->state_origin = $request->state_origin;
            $app->lga_origin = $request->lga_origin;
            $app->religion = $request->religion;
            $app->marital_status = $request->marital;
            $app->nok_name = $request->next_of_kin;
            $app->nok_phone = $request->nok_phone;
            $app->nok_relationship = $request->nok_relationship;
            $app->nok_address = $request->next_of_kin_address;
            $app->sponsor_name = $request->sponsor_name;
            $app->sponsor_email = $request->sponsor_email;
            $app->sponsor_phone = $request->sponsor_phone;
            
            $save = $app->save();
            if($save){
                $app_record = Application::where(['submitted_by'=>$app->email,'status'=>'pending','app_type'=>$_COOKIE['app_type']])->first();
                $app_record->form_status = $app_record->form_status+1;
                $app_record->save();
                return response()->json(['status'=>'ok','msg'=>'success, profile created',],201); 
            }else{
                return response()->json(['status'=>'Nok','msg'=>'failed creating profile'],401); 
            }

        }elseif($request->check_step == 'academic'){
            $sec_sch = []; 
            $o_level = []; 
            $other_cert  = []; 
            // SECONDARY SCHOOL;
            if(sizeof($request->sec_school) == 0 || sizeof($request->school_start) == 0  || sizeof($request->school_end) == 0  ) {
                return response()->json(['status'=>'Nok','msg'=>'failed, Your secondary school fields are required'],401);   
            }
            elseif(sizeof($request->sec_school) > 0 && sizeof($request->sec_school) == sizeof($request->school_start )
             && sizeof($request->sec_school) == sizeof($request->school_end )  ){
                foreach($request->sec_school as $index => $value){ 
                    $x = $index + 1;
                    $sch = 'sch'.$x;
                    //NOTE: Use find and replace ~ to avoid future error here
                    $sec_sch[$sch] = $request->sec_school[$index]."~".$request->school_start[$index]."~".$request->school_end[$index];    
                }
                }else{return response()->json(['status'=>'Nok','msg'=>'failed, Your secondary school fields are required'],401);   }
           //O-LEVEL;
                if(count(array_unique($request->exam)) > 2 || count(array_unique($request->year )) >2){
            return response()->json(['status'=>'Nok','msg'=>'failed, Like you have more than two sittings for your O-leve'],401); 
            }else{
            if(!sizeof($request->exam) < 5 && sizeof($request->exam) == sizeof($request->subject) &&  sizeof($request->subject) == sizeof($request->grade ) && sizeof($request->grade) == sizeof($request->year ) 
                ){
                foreach($request->exam as $index => $value){
                    $x = $index + 1;
                    $sub = 'sub'.$x;
                    $o_level[$sub] = $request->exam[$index]."~".$request->subject[$index]."~".$request->grade[$index]."~".$request->year[$index];
                }
                
            }else{
                return response()->json(['status'=>'Nok','msg'=>'failed, Minimum of five subjects is required!'],401); 
            }

            }
            if($request->has('institution_name') && $request->filled('institution_name') ) {
            if(sizeof($request->institution_name) == sizeof($request->institution_address ) && 
            sizeof($request->degree) == sizeof($request->institution_address ) &&  
            sizeof($request->inst_start) == sizeof($request->institution_name ) &&  
            sizeof($request->inst_end) == sizeof($request->degree )  
            ){
            foreach($request->institution_name as $index => $value){
                $x = $index + 1;
                $inst = 'inst'.$x;
                $other_cert[$inst] = $request->institution_name[$index]."~".$request->institution_address[$index]."~".$request->degree[$index]."~".$request->inst_start[$index]."~".$request->inst_end[$index];

            }
            }else{return response()->json(['status'=>'Nok','msg'=>'failed, Kindly complete fields for Other Qualifications'],401);   }
            }  
            $app_record2 = Application::where(['submitted_by'=>$data->email,'status'=>'pending','app_type'=>$_COOKIE['app_type']])->first();
            $app_record2->form_status = $app_record2->form_status+1;
            $app_record2->sec_sch = $sec_sch;
            $app_record2->o_level = $o_level;
            $app_record2->other_cert = $other_cert;
            $save = $app_record2->save();
            if($save){
                return response()->json(['status'=>'ok','msg'=>'success, academic created',],201); 
            }else{
                return response()->json(['status'=>'Nok','msg'=>'failed creating academic'],401); 
            }
              

        }elseif($request->check_step == 'declaration'){
            if($_COOKIE['pin'] == "" || empty($_COOKIE['pin'] )){
                return back()->with('fail','pin is required for final submition!');
            }
         
            $fac_name = app('App\Http\Controllers\ConfigController')->get_faculty_name_given_id($request->faculty);
            $dept_name = app('App\Http\Controllers\ConfigController')->get_dept_name_given_id($request->department);
            $prog_name = app('App\Http\Controllers\ConfigController')->get_prog_name_given_id($request->programme);

            $fac_name2 = app('App\Http\Controllers\ConfigController')->get_faculty_name_given_id($request->faculty2);
            $dept_name2 = app('App\Http\Controllers\ConfigController')->get_dept_name_given_id($request->department2);
            $prog_name2 = app('App\Http\Controllers\ConfigController')->get_prog_name_given_id($request->programme2);
          
            $first_choice = [ "faculty"=>$fac_name, "dept"=>$dept_name,"prog"=>$prog_name,"subj"=>$request->combination];
            $second_choice = [ "faculty"=>$fac_name2, "dept"=>$dept_name2,"prog"=>$prog_name2,"subj"=>$request->combination2];
            
            $app_record3 =  Application::where(['submitted_by'=>$data->email,'status'=>'pending','app_type'=>$_COOKIE['app_type']])->first();
           
            $app_record3->screen_date =  $request->screening_date;
            $app_record3->accept_terms =  $request->accept_terms;
            $app_record3->first_choice =  $first_choice ;
            $app_record3->second_choice =  $second_choice ;
      
            $filename1 = $request->file('signature')->getClientOriginalName();
            $path1 = Storage::disk('public')->putFileAs('credentials', $request->file('signature'), $data->surname ."_". $data->first_name ."_". $data->other_name ."_". $data->id ."_". date('YmdHis') ."_". $filename1); 
            $filename2 = $request->file('olevel')->getClientOriginalName();
            $path2 = Storage::disk('public')->putFileAs('credentials', $request->file('olevel'), $data->surname ."_". $data->first_name ."_". $data->other_name ."_". $data->id ."_". date('YmdHis') ."_". $filename2);
            $filename3 = $request->file('birth_cert')->getClientOriginalName();
            $path3 = Storage::disk('public')->putFileAs('credentials', $request->file('birth_cert'), $data->surname ."_". $data->first_name ."_". $data->other_name ."_". $data->id ."_". date('YmdHis') ."_". $filename3);
           
            $app_record3->olevel_file =  $path2;
            $app_record3->birth_cert =  $path3;
            $app_record3->used_pin =  $_COOKIE['pin'];
            $app_record3->form_status = $app_record3->form_status+1;
            $app =  Applicant::findOrFail($data->id);

            $app->signature =  $path1;
            $app->save();
            $app_save = $app_record3->save();
            if($app_save){ 
                if (isset($_COOKIE['pin']) && isset($_COOKIE['app_type'])) {
                    unset($_COOKIE['pin']); setcookie('pin', '', time() - 3600, '/');
                    unset($_COOKIE['app_type']); setcookie('app_type', '', time() - 3600, '/');
                   // setcookie('key', '', time() - 3600, '/'); // empty value and old timestamp
                } 
                return redirect('application')->with('appSubmit','application successfully completed!');
            }
            
           
        }else{
            return response()->json(['status'=>'Nok','msg'=>'failed, Error with check_step supplied: save_app_form(Request $request)  '],401); 
        }
    } catch (\Throwable $th) {
        return back()->with('appError','Error submitting application!');
    }
    }




   
    public function uploadProfileImage(Request $request)
    {
        $data = app('App\Http\Controllers\ConfigController')->auth_user(session('user'));
        if(!is_null($data->profile_pix)){
            Storage::delete($data->profile_pix);
        }

        try {
            $filename = $request->file('profileImage')->getClientOriginalName();
            $path = Storage::disk('public')->putFileAs('profileImage', $request->file('profileImage'), $data->surname ."_". $data->first_name ."_". $data->other_name ."_". $data->id ."_". date('YmdHis') ."_". $filename);
            $applicant = Applicant::find($data->id);
            $applicant->profile_pix = $path;
            $applicant->save();
            return back()->with('success','image uploaded successfully!');
        } catch (\Throwable $th) {
           return back()->with('fail','image upload failed!');
       }
    }

        public function get_stored_file($filename) {

                $path = storage_path('app/public/profileImage/'. $filename);

                if (!File::exists($path)) {
                    abort(404);
                }

                $file = File::get($path);
                $type = File::mimeType($path);

                $response = Response::make($file, 200);

                $response->header("Content-Type", $type);

                return $response;

            }



            public function view_applications(Request $request){
       
                try {
                    $data = app('App\Http\Controllers\ConfigController')->auth_user(session('user'));
                    $applications = DB::table('applications')->select('*','first_choice->prog as Programme')
                        ->where('submitted_by', $data->email)->get();
                    return view('pages.applications',['apps'=>$applications])->with('data', $data);
                } catch (\Throwable $th) {
                    return back()->with('view_applications','view_applications');
                }
            
        }





        // Testing document upload START
        public function getFile(){
            return view('getFile');
        }
        public function saveFile(Request $request){
           //getClientOriginalName()
           //extension()
           $data =  $request->file('cert')->extension();
           dd($data);
            return back()->with('view_applications','view_applications');
            Storage::disk('public')->putFileAs();

        }
        // Testing document upload END









   
}
