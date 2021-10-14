<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RemitaConfig extends Controller
{
    
    public function check_pend_rrr(Request $request){

        $validator = Validator::make($request->all(), [ 
            'payType' => 'required|string',
            'mat_no' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response()->json(['status'=>'Nok','msg'=>'parameter error(payType or mat_no)','rsp'=>''], 400);
        }

        $session_id = app('App\Http\Controllers\AuthController')->get_current_session()->session_id_FK;
        $payType_r = trim(strtoupper($request->payType));
        $mat_no_r = $request->mat_no;
        if(!$this->getRemitaPaymentConfig2($serviceTypeID,$merchantId, $apiKey ,$payType_r)){
           
            return response()->json(['status'=>'Nok','msg'=>'Error getting serviceTypeID, Line ... RemitaSpecialPayment Controller','rsp'=>''], 400);

        }

        if($this->check_pend_rrr_from_db($mat_no_r,$payType_r,$pend_rrr,$pend_orderID,$session_id,$rtMsg)){
           
           return response()->json(['status'=>'ok','msg'=>$rtMsg,'p_rrr'=>$pend_rrr,'p_orderID'=>$pend_orderID], 201);

        }
        else{
            return response()->json(['status'=>'Nok','msg'=>$rtMsg,], 200);

        } 

    }



    public function log_new_rrr(Request $request){
        
     
        $validator = Validator::make($request->all(), [ 
            'payType' => 'required|string',
            'mat_no' => 'required|string',
            'payerName' => 'required|string',
            'rrr' => 'required|string',
            'orderID' => 'required|string',
            'amount' => 'required|string',
            'statuscode' => 'required|string',
            'statusMsg' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response()->json(['status'=>'Nok','msg'=>'Error with supplied parama while loging new RRR','rsp'=>''], 400);
        }

        try {
             if(!$this->confirm_description_to_amount_from_db($request->amount,$request->payType)){
                return response()->json(['status'=>'Nok','msg'=>'Amount does not match','rsp'=>''], 400);
 
             }

            $timesammp = DATE("dmyHis"); 
            $session =  app('App\Http\Controllers\AuthController')->get_current_session()->session_id_FK;
            $payment = new SpecialPayment();
            $payment->matric_number = $request->mat_no;
            $payment->names = $request->payerName;
            $payment->amount = $request->amount;
            $payment->rrr = $request->rrr;
            $payment->trans_ref = $request->orderID;
            $payment->pay_type = $request->payType;
            $payment->session = $session;
            $payment->status_code = $request->statuscode;
            $payment->status_msg = 'pending';
            $payment->time_stamp = $timesammp;
            $payment->save();
            return response()->json(['status'=>'ok','msg'=>'New RRR logged successfully','rsp'=>''], 201);
        }
        catch (\Throwable $th) {
            $rtMsg = "";
            return response()->json(['status'=>'Nok','msg'=>'Error loging new RRR, record exist maybe','rsp'=>''], 401);

        }

    }



   public function check_pend_rrr_from_db($mat_no_r,$payType_r,&$pend_rrr,&$pend_orderID,$session_id,&$rtMsg){
        try {    
            $rtMsg = "Defualt from check_pend_rrr_from_db";  
            $data = DB::table('t_payment_special_remita')
            ->where('matric_number',$mat_no_r)
            ->where('pay_type',$payType_r)
            ->where('session',$session_id)
            ->where('status_code','025')
            ->where('status_msg','pending')
            ->first();
           if(!empty($data)){
            $pend_rrr = $data->rrr;
            $pend_orderID = $data->trans_ref;
            $rtMsg = "success";
            return true;
         }
          $rtMsg = "No pending RRR for ". $payType_r;
          return false;
            }
        catch (\Throwable $th) {
            $rtMsg = response()->json(['status'=>'Nok','msg'=>'Error from the catch; check_pend_rrr_from_db()','rsp'=>''], 401);

        }
        
        }

    public function get_remita_config(Request $request){

        $validator = Validator::make($request->all(), [
             'payType' => 'required|string',
             'mat_no' => 'required|string',
            ]);
        if ($validator->fails()) {
            return response()->json(['status'=>'Nok','msg'=>'Error with payType or mat_no','rsp'=>''], 400);
        }
        try {
            $payType = $request->payType;
            $orderID = $this->remita_generate_trans_ID();
            if($this->getRemitaPaymentConfig2($serviceTypeID,$merchantId, $apiKey ,$payType)){
                $stud = Students::findOrFail($request->mat_no);
                return response()->json(['status'=>'ok','msg'=>'success',
               'data'=>[ 'serviceTypeID'=>$serviceTypeID,
               'merchantId'=>$merchantId,'apiKey'=>$apiKey,
               'payType'=>$payType,'orderID'=>$orderID,'surname'=>$stud->surname,
               'firstname'=>$stud->firstname,'othernames'=>$stud->othernames,
               'phone'=>$stud->student_phone,'email'=>$stud->email1]], 200);
            
            }
    
            return response()->json(['status'=>'Nok','msg'=>'Error getting serviceTypeID, Line ... RemitaSpecialPayment Controller','rsp'=>''], 400);
            
           
        } catch (\Throwable $th) {
            return response()->json(['status'=>'Nok','msg'=>'Error from catch... get_remita_config()','rsp'=>''], 401);

        }
      
    }


    public function getRemitaPaymentConfig2(&$serviceTypeID,&$merchantId, &$apiKey ,$payType) {
    
        $serviceTypeID = $this->get_service_id_given_payType($payType);
        $merchantId = "4161150426";
        $apiKey = "258341";  
        if(!is_null($serviceTypeID)){
            return true;
        }  
        return false; 
     //$serviceTypeID = "4430731";
     //$merchantId = "2547916";
     //$apiKey = "1946";  
     
     }
     
     
     public function get_service_id_given_payType($payType){
      
          if($payType == "CONVOCATION_FEE_2015"){
             return "8201419983";
         }
         else if($payType == "CONVOCATION_FEE_2014"){
             return "8201486496";
         }
         else if($payType == "ANNUAL_TAB_MAINT_FEE"){
             return "8201440958";
         }
         else if($payType == "ATS_REGISTRATION_FEES"){
             return "8197136992";
         }
         else if($payType == "ATS_LECTURE_FEES"){
             return "8197131649";
         }
         else if($payType == "ATS_LECTURE_FEES_HALF"){
             return "8197120781";
         }
       
         else if($payType == "SAMSUNG_TAB_92500"){
            return "8201354740";
        }
        else if($payType == "SAMSUNG_TAB"){
            return "8197088683";
        }
        else if($payType == "CONVOCATION_FEE_2021_PG"){
            return "8176753193";
        }
        else if($payType == "CONVOCATION_FEE_2021_UNDERGRADUATE"){
            return "7122972919";
        }
        else if($payType == "CONVOCATION_FEE_2020"){
            return "8201465747";
        }
        else if($payType == "CONVOCATION_FEE_2019"){
            return "8201409265";
        }
        else if($payType == "CONVOCATION_FEE_2017"){
            return "8201413554";
        }
        else if($payType == "CONVOCATION_FEE_2016"){
            return "8201416145";
        }
    
        else if($payType == "TRANSCRIPT_US_CANADA_UNDERGRAD"){
            return "8201449890";
        }
        else if($payType == "TRANSCRIPT_NIGERIA_UNDERGRAD"){
            return "8201452263";
        }
        else if($payType == "TRANSCRIPT_FAR_EUROPE_UNDERGRAD"){
            return "8201380610";
        }
        else if($payType == "TRANSCRIPT_EUROPE_AFRICA_UNDERGRAD"){
            return "8201376113";
        }
        else if($payType == "TRANSCRIPT_ASIA_UNDERGRAD"){
            return "8201462144";
        }
        else if($payType == "SAMSUNG_TAB_92500_HALF"){
            return "8201360055";
        }
        else if($payType == "SAMSUNG_TAB_HALF"){
            return "8201447076";
        }
        
     }
    



     public function remita_generate_trans_ID(){

        try {

            $txId = "";
            srand(time());
            $txId = $txId . rand(0, 9);
            $txId = $txId . rand(0, 9);
            $txId = $txId . $this->frnt_2_digit_pad_wit_zero(idate("d")); // day
            $txId = $txId . rand(0, 9);
            $txId = $txId . $this->frnt_2_digit_pad_wit_zero(idate("H")); // hour
            $txId = $txId . rand(0, 9);
            $txId = $txId . $this->frnt_2_digit_pad_wit_zero(idate("m"));  // minute
            $txId = $txId . rand(0, 9);
            $txId = $txId . $this->frnt_2_digit_pad_wit_zero(idate("s"));  // seconds
    
            return "13-" . $txId;
        } catch (Exception $ex) {
            return false;
        }

     }

     public function  frnt_2_digit_pad_wit_zero($xVal) {
        if (strlen($xVal) < 2) {
            return "0" . $xVal;
        }
        return $xVal;
    }
    

    public function confirm_description_to_amount_from_db($amount,$payType){
        try {
           
            $data = DB::table('t_non_tution_payments_for_remita')
            ->where('_desc',$payType)->first();
                if($data->_amount == $amount && $data->_desc == $payType){
                    return true;
                }
                return false;
           
        } catch (\Throwable $th) {
            return response()->json(['status'=>'Nok','msg'=>'Error from catch... confirm_description_to_amount_from_db()','rsp'=>''], 401);

        }
    
    }

   
//php

}
