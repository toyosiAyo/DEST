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

    //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

   
  
        protected $pin = "";

    
          
    public function get_app_form(Request $request){
        $validator = Validator::make($request->pin, [ 'app_type' => 'required|string',]);
        if ($validator->fails()) {
            return back()->with('fail','app_type is required !');
        }
        
        $data = app('App\Http\Controllers\ConfigController')->auth_user(session('user'));
        $pin = $_COOKIE['pin'];
        $app_type = $_COOKIE['app_type'];
        $form_status = DB::table('applications')->where(['submitted_by'=> $data->email,'app_type'=>$app_type,'status'=>'pending'])->pluck('form_status');
        if($pin && !is_null($form_status)){
            $o_level = DB::table('o_level_subjects')->select('id','subject')->get();
            $faculties = app('App\Http\Controllers\ConfigController')->college_dept_prog($request)['faculties'];
            $sub_grade = array("A1", "B2", "B3", "C4", "C5", "C6", "D7", "E8", "F9");
            return view('/pages/form',['o_level'=> $o_level,'sub_grade'=>$sub_grade,'pin'=>$pin,'data'=> $data,'faculties'=> $faculties,'form_status'=>$form_status ]);
        }
        else {
            return view('/pages/create_application')->with('data',$data);
        } 
    }


    public function checkForUsedPin($request){
        try {
            $data = app('App\Http\Controllers\ConfigController')->auth_user(session('user'));
            $used_pin = DB::table('application_payments')
            ->join('applications','application_payments.rrr','applications.used_pin')
            ->where('application_payments.email',$data->email)->pluck('rrr'); 
            $unused_pin = DB::table('application_payments')->select('rrr')
            ->where('email',$data->email)
            ->where('status_code','00')->where('pay_type', $request->payType) ->whereNotIn('rrr', $used_pin)->get();
            if($unused_pin->count() !=0){
                $pin = $unused_pin[0]->rrr;
                $this->pin = $unused_pin[0]->rrr;
                return $pin;
                return ['status'=>'ok','msg'=>'success','pin'=>$pin];  
            }
            return "false";
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
                    $sch = 'sch'.$index+1;
                    //NOTE: Use find and replace ~ to avoid future error here
                    $sec_sch[$sch] = $request->sec_school[$index]."~".$request->school_start[$index]."~".$request->school_end[$index];
                }
                }else{return response()->json(['status'=>'Nok','msg'=>'failed, Your secondary school fields are required'],401);   }
           //O-LEVEL;
                if(count(array_unique($request->exam)) > 2 || count(array_unique($request->year )) >2){
            return response()->json(['status'=>'Nok','msg'=>'failed, Like you have more than two sittings for your O-leve'],401); 
            }else{
            if(sizeof($request->exam) < 5 && sizeof($request->exam) == sizeof($request->subject) &&  sizeof($request->subject) == sizeof($request->grade ) && sizeof($request->grade) == sizeof($request->year ) 
                ){
                foreach($request->exam as $index => $value){
                    $sub = 'sub'.$index+1;
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
                $inst = 'inst'.$index+1;
                $other_cert[$inst] = $request->institution_name[$index]."~".$request->institution_address[$index]."~".$request->degree[$index]."~".$request->inst_start[$index]."~".$request->inst_end[$index];

            }
            }else{return response()->json(['status'=>'Nok','msg'=>'failed, Kindly complete fields for Other Qualifications'],401);   }
            }  
            
            $app2 = new Application();
            //$app2->submitted_by = $data->email;
            $app2->sec_sch = $sec_sch;
            $app2->o_level = $o_level;
            $app2->other_cert = $other_cert;
            $save = $app2->save();
            if($save){
                return response()->json(['status'=>'ok','msg'=>'success, profile created',],201); 
            }else{
                return response()->json(['status'=>'Nok','msg'=>'failed creating profile'],401); 
            }
              

        }elseif($request->check_step == 'declaration'){
            //unset pin cookie
           
            dd($request->all());
            $validator = Validator::make($request->pin, [ 'pin' => 'required|string|min:10',]);
            if ($validator->fails()) {
                return response()->json(['error' => 'Pin is required, Minimum of ...'], 401);
            }
            
            // "faculty" => "Science"
            // "department" => "CMP"
            // "programme" => "CMP"
            // "combination" => "CMP"
            // "faculty2" => "Humanities"
            // "department2" => "LAW"
            // "programme2" => "LAW"
            // "combination2" => "LAW"
            // "screening_date" => "17/10/2021"
            // "accept_terms" => "on"

            dd($request->all());
        }else{
            return response()->json(['status'=>'Nok','msg'=>'failed, Error with check_step supplied: save_app_form(Request $request)  '],401); 
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
           
            $path = Storage::disk('public')->putFileAs('ProfileImage', $request->file('profileImage'), $data->surname ."_". $data->first_name ."_". $data->other_name ."_". $data->id ."_". date('YmdHis') ."_". $filename);
            $applicant = Applicant::find($data->id);
            $applicant->profile_pix = $path;
            $applicant->save();
            return back()->with('success','image uploaded successfully!');
            //return response()->json(['info' => 'Profile Image Uploaded', 'msg' => 'success']);
        } catch (\Throwable $th) {
            return back()->with('fail','image upload failed!');
            //return response()->json(['error' => 'image upload failed', 'th' => $th], 401);
        }
    }

        public function get_stored_file($filename) {

                $path = storage_path('app/public/ProfileImage/'. $filename);

                if (!File::exists($path)) {
                    abort(404);
                }

                $file = File::get($path);
                $type = File::mimeType($path);

                $response = Response::make($file, 200);

                $response->header("Content-Type", $type);

                return $response;

            }

   
}
