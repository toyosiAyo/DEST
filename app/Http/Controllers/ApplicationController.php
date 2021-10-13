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
        return "Yes";
        $settings = app('App\Http\Controllers\ConfigController')->settings($request);
        return  $settings ;
        // validation
        // "address_resident" 
        // "city_resident" 
        //state_resident 
        // country_resident 
        //state_origin

        // lga_origin 
         //country_origin
        //lga_origin 
        // country_origin

        //sponsor_name 
        //sponsor_relationship
        // sponsor_email 
        //sponsor_phone

       //nok_name 
       //nok_relationship 
        // nok_email 	
        //nok_phone nok_address

        // "dob" => "2021-10-12"
        // "country" => "apple"
        // "state" => "apple"
        // "sponsor" => "weeetre"
        // "marital" => "single"
        // "religion" => "Christianity"
        // "disability" => null
        //"disability_check" => "yes"
        //"disability" => null
        // "next_of_kin" => "QEEEQq"
        // "next_of_kin_address" => "ASDGFH"
        // "sponsor_address" => "wsdwrW"

        // dob email2  religion marital_status disability address_resident
        // city_resident state_resident country_resident state_origin
        // lga_origin  country_origin sponsor_name sponsor_relationship
        // sponsor_email sponsor_phone nok_name nok_relationship 
        // nok_email 	nok_phone nok_address
        // profile_pix deleted_active 


        
        dd($request->all());
        $app = new Applicant;
        $app->address_resident = $request->address;
        $app->dob = $request->dob;
        $app->country_resident = $request->country;
        $app->state_resident = $request->state;
        $app->email = $request->sponsor;
        $app->gender = $request->gender;
        $save = $app->save();
        if($save){
            return response()->json(['status'=>'ok','msg'=>'success, profile created',],200); 
        }else{
            return response()->json(['status'=>'Nok','msg'=>'failed creating profile'],401); 
        }
    }


   
   
}
