<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

        dd($request->all());
    }


   
   
}
