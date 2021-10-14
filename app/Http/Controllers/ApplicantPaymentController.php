<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApplicantPaymentController extends Controller
{

    public function update_special_remita_payment(Request $request){
       
        $validator = Validator::make($request->all(), [ 'mat_no' => 'required|string',
            'paymentReference' => 'required|string',
            'desc' => 'required|string',]);
        if ($validator->fails()) {
            return response()->json(['status'=>'Nok','msg'=>'Error: mat_no/paymentReference required','rsp'=>''], 400);
        }
        try {
            if($request->has('transactionId') && !empty($request->input('transactionId'))) {
                if($this->update_special_remita_payment_db($rrr=$request->paymentReference,$rem_transactionId=$request->transactionId,$rtMsg)){
                    return $rtMsg;
                }
             
            } else {
        
                return response()->json(['status'=>'Nok','msg'=>'Payment failed :transactionId from Remita is empty','rsp'=>''], 400);

            }
          
        } catch (\Throwable $th) {
            return response()->json(['status'=>'Nok','msg'=>'Error from catch... update_special_remita_payment()','rsp'=>''], 401);

        }   
    
    }


    public function update_special_remita_payment_db($rrr,$rem_transactionId,&$rtMsg){
        try{
        $data = SpecialPayment::where('rrr',$rrr)->first();
        if(empty($data)){ $rtMsg = response()->json(['status'=>'Nok','msg'=>'No match RRR record from DB','rsp'=>''],400);return true;}
        if(trim($data->status_code )== "025" && trim($data->status_msg) == "pending"){
        $data->remita_transaction_id = $rem_transactionId;
        $data->status_code = "00" ;
        $data->status_msg = "success";
        $save = $data->save();
        if($save){$rtMsg = response()->json(['status'=>'ok','msg'=>'Payment successful','rsp'=>''], 200);
            return true;}else{
                return response()->json(['status'=>'Nok','msg'=>'Error Updating Transaction... update_special_remita_payment()','rsp'=>''], 401);
            }
       }else{
        $rtMsg = response()->json(['status'=>'ok','msg'=>'Record updated already!','rsp'=>''], 200);
        return true;
       }
          
    } catch (\Throwable $th) {
        return response()->json(['status'=>'Nok','msg'=>'Error from catch... update_special_remita_payment()','rsp'=>''], 401);

    } 

    }



    public function re_query_applicant_transaction(Request $request)
    {
        $validator = Validator::make($request->all(), [ 'rrr' => 'required|string',]);
    if ($validator->fails()) {
        return response()->json(['status'=>'Nok','msg'=>'Error: rrr required','rsp'=>''], 400);
    }
  
        ini_set('max_execution_time', 0);
        $merchantId = "4161150426";
        $apiKey = "258341";
        $rrr = $request->rrr;
        try {
            $apiHash = hash('sha512', $rrr . $apiKey . $merchantId);
            $client = new Client();
            $response = $client->request('GET', 'https://login.remita.net/remita/ecomm/' . $merchantId . '/' . $rrr . "/" . $apiHash . '/status.reg', []);
            $data = json_decode($response->getBody());
           if(trim($data->message) == "Approved"){
            if($this->update_special_remita_payment_db($rrr=$rrr,$rem_transactionId="REQUERY",$rtMsg)){
                return $rtMsg;
            }else{
                return response()->json(['status'=>'Nok','msg'=>'Error: cannot complete re-query process','rsp'=>''], 400);
            }
           }
        } catch (\Throwable $th) {
            // throw $th;
            return response()->json(['status' => 'Nok', 'msg' => 'Catch Error requerying transaction: re_query_transaction()'], 401);
        }
      
        return response()->json(['status' => 'Nok', 'msg' => 'Transaction pending','data'=>$data], 200);

    }
    
    public function remita_bank_applicant(Request $request){

        try {
             // Log::info($request);
        $data =  $request->getContent();
        
        $getRRR = stristr($data, "rrr");
        $findCommaRRR = strpos($getRRR, ",");
        $RRRsingleString = substr($getRRR, 0, $findCommaRRR);
        $findRRRString = explode('"', $RRRsingleString);
        $RRRvalue = $findRRRString[2]; //RRR

        $getAmount = stristr($data, "amount");
        $amountComma = strpos($getAmount, ',');
        $amountsingleString = substr($getAmount, 0, $amountComma);
        $amountNew = explode(':', $amountsingleString);
        $amountValue = $amountNew[1]; //AMOUNT

        $td = stristr($data, "transactiondate");
        $tdcomma = strpos($td, ',');
        $tdfinal = substr($td, 0, $tdcomma);
        $tdnew = explode('"', $tdfinal);
        $tdvalue = $tdnew[2]; //TRANSACTION DATE
       
        // $request = new Request([
        //     'payment' => ['rrr' => $RRRvalue],
        //     'remitaResponse' => ['amount' => $amountValue,'transactiontime' => $tdvalue],
        // ]);
        $rem_transactionId = "REMITABANK@".$tdvalue;
        if($this->update_special_remita_payment_db($rrr=$RRRvalue,$rem_transactionId= $rem_transactionId ,$rtMsg)){
            return $rtMsg;
        }else{
            return response()->json(['status'=>'Nok','msg'=>'Error: cannot complete response from remita bank payment processing','rsp'=>''], 400);
        }
       
        } catch (\Throwable $th) {
            // throw $th;
            return response()->json(['status' => 'Nok', 'msg' => 'Catch Error : remita_bank_special_payment()'], 401);
        }

    }
    public function test_remita_bank_applicant(Request $request){

        try {
             // Log::info($request);
        $data =  $request->getContent();
        
        $getRRR = stristr($data, "rrr");
        $findCommaRRR = strpos($getRRR, ",");
        $RRRsingleString = substr($getRRR, 0, $findCommaRRR);
        $findRRRString = explode('"', $RRRsingleString);
        $RRRvalue = $findRRRString[2]; //RRR

        $getAmount = stristr($data, "amount");
        $amountComma = strpos($getAmount, ',');
        $amountsingleString = substr($getAmount, 0, $amountComma);
        $amountNew = explode(':', $amountsingleString);
        $amountValue = $amountNew[1]; //AMOUNT

        $td = stristr($data, "transactiondate");
        $tdcomma = strpos($td, ',');
        $tdfinal = substr($td, 0, $tdcomma);
        $tdnew = explode('"', $tdfinal);
        $tdvalue = $tdnew[2]; //TRANSACTION DATE
       
        // $request = new Request([
        //     'payment' => ['rrr' => $RRRvalue],
        //     'remitaResponse' => ['amount' => $amountValue,'transactiontime' => $tdvalue],
        // ]);
        $rem_transactionId = "REMITABANK@".$tdvalue;
        if($this->update_special_remita_payment_db($rrr=$RRRvalue,$rem_transactionId= $rem_transactionId ,$rtMsg)){
            return $rtMsg;
        }else{
            return response()->json(['status'=>'Nok','msg'=>'Error: cannot complete response from remita bank payment processing','rsp'=>''], 400);
        }
       
        } catch (\Throwable $th) {
            // throw $th;
            return response()->json(['status' => 'Nok', 'msg' => 'Catch Error : remita_bank_special_payment()'], 401);
        }

    }



}
