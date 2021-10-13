<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Applicant;

class ApplicationController extends Controller
{

    //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
    public function get_app_form(Request $request){
        
        return view('/pages/form');
       
    }
    public function create_application(Request $request){
        return view('/pages/create_application');
       
    }

 
    public function save_app_form(Request $request){
        //$settings = app('App\Http\Controllers\ConfigController')->settings($request)->semester_name;
       //Fields for validation here
        //"address_resident" 
        //"basic" => "basic"
        //"dob" 
        //"city_resident" 
        //"country" 
       // "state_origin" 
       // "lga_origin" 
       // "religion" 
       // "marital" 
       // "disability_check" => "yes"
        //"disability" => "GOD"
        //"next_of_kin"
        //"nok_phone" 
        //"nok_relationship" 
       // "next_of_kin_address" 
        //"sponsor_name" 
        //"sponsor_email" 
        //"sponsor_phone" 

        // dob email2  religion marital_status disability address_resident
        // city_resident state_resident country_resident state_origin
        // lga_origin  country_origin sponsor_name sponsor_relationship
        // sponsor_email sponsor_phone nok_name nok_relationship 
        // nok_email 	nok_phone nok_address gender
        // profile_pix deleted_active 

        
        if($request->check_step == 'basic'){
            dd($request->all());
            $app =  Applicant::findOrFail(1);
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
            return "Yes";
            dd($request->all());

        }elseif($request->check_step == 'declaration'){
            dd($request->all());
        }else{
            return response()->json(['status'=>'Nok','msg'=>'failed, Error with check_step supplied: save_app_form(Request $request)  '],401); 
        }
       
    }




   
   
}
