<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Applicant;
use App\Models\Application;
use App\Models\ApplicantPayment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ApplicationController extends Controller
{

    //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
    public function get_app_form(Request $request){

        if($request->session()->has('user')){
           
        $data = app('App\Http\Controllers\ConfigController')->auth_user(session('user'));
        //return view('/pages/form')->with('data',$data);

        // DB::table('application_payments')->select('application_payments.rrr')
        // ->join('applications','application_payments.rrr','=','applications.used_pin')
        // ->where('application_payments.email',  $data->email)
        // ->where('applications.submitted_by', $data->email)
        // ->get()
        // $all =  DB::table('application_payments')->select('application_payments.rrr')
        // ->whereNotIn('application_payments.rrr',
        //    ['260514910326']
        // )->get();
        // $all = DB::table('application_payments')->select('application_payments.rrr')
        //     ->whereNOTIn('application_payments.rrr',function($query){
        //        $query->select('applications.used_pin')->from('applications');
        //     })->get();
        // $all = DB::select(DB::raw("SELECT rrr FROM application_payments 
        // WHERE email = :somevariable"), array( 'somevariable' => $data->email,));
        $rrr =  DB::select(DB::raw("SELECT rrr FROM application_payments 
        JOIN applications ON application_payments.rrr = applications.used_pin 
        WHERE email = '$data->email'"));
        $array_rrr = [];
       if(!empty($rrr)){
            foreach($rrr as $key => $val){
                $array_rrr =  $val->rrr;
            }
            $all =  DB::select(DB::raw("SELECT rrr FROM application_payments 
            WHERE rrr NOT IN ($array_rrr)"));
             if(!empty($all)){
                // $form_view  = view('/pages/form')->with('data',$data);
                return true;
            }
            return false;
        }
        return false;
       
    
           // dd($all);
    //   $rrr = ApplicantPayment::where(['status_code'=>'00','email'=>$data->email])->select('rrr')->first();
    //   if($rrr == Null){
    //     return response()->json(['status'=>'Nok','msg'=>'Like no rrr or pend rr',]); 
    //   }else{
    //     if (Application::where('used_pin',ApplicantPayment::where(['status_code'=>'00','email'=>$data->email])
    //     ->select('rrr')->first()->rrr)->exists()) {
    //         return response()->json(['status'=>'Nok','msg'=>'pin used',],401); 
    //      }else{
            
    //         return response()->json(['status'=>'ok','msg'=>'pin available',],200); 
    //      }
    //     }
          }
          else{
              dd("No Session");  
          }
       
    }

    public function redirect_page(Request $request){
        if($request->session()->has('user')){
            $data = app('App\Http\Controllers\ConfigController')->auth_user(session('user'));
            if($this->checkForUsedPin()){
                return view('/pages/form')->with('data',$data);
            };
            
        }
    }

    public function checkForUsedPin(){
        $data = app('App\Http\Controllers\ConfigController')->auth_user(session('user'));
        $rrr =  DB::select(DB::raw("SELECT rrr FROM application_payments 
                JOIN applications ON application_payments.rrr = applications.used_pin 
                WHERE email = '$data->email'"));
                $array_rrr = [];
        if(!empty($rrr)){
            foreach($rrr as $key => $val){
                $array_rrr =  $val->rrr;
            }
            $all =  DB::select(DB::raw("SELECT rrr FROM application_payments 
            WHERE rrr NOT IN ($array_rrr)"));
            if(!empty($all)){
                return true;
            }
            return false;
        }
    }

    public function create_application(Request $request){
        if($request->session()->has('user')){
            $data = app('App\Http\Controllers\ConfigController')->auth_user(session('user'));
           
    //      $rrr =  DB::select(DB::raw("SELECT rrr FROM application_payments 
    //     JOIN applications ON application_payments.rrr = applications.used_pin 
    //     WHERE email = '$data->email'"));
    //     $array_rrr = [];
    //    if(!empty($rrr)){
    //         foreach($rrr as $key => $val){
    //             $array_rrr =  $val->rrr;
    //         }
    //    }
    //    //dd($array_rrr);
    //    $all =  DB::select(DB::raw("SELECT rrr FROM application_payments 
    //     WHERE rrr NOT IN ($array_rrr)"));
    //     if(!empty($all)){
    //         return redirect('/get_app_form');
    //     }
    //     return "Not DOne";
       
           
            return view('/pages/create_application')->with('data', $data);
          }
          else{
              dd("No Session");  
          }
       
      
       
    }

 
    public function save_app_form(Request $request){
        //$settings = app('App\Http\Controllers\ConfigController')->settings($request)->semester_name;
      
        
        if($request->check_step == 'basic'){
            $app =  Applicant::findOrFail('teewhy@gmail.com');
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
            $app2->submitted_by = "teewhy@gmail.com";
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




   
   
}
