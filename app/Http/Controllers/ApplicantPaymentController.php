<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ApplicantPayment;
use Illuminate\Support\Facades\Validator;
use App\Models\Application;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use GuzzleHttp\Client;
use Carbon\Carbon;
class ApplicantPaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('authcheck');
       // $this->middleware('log')->only('index');
       // $this->middleware('subscribed')->except('store');
    }


    public function update_applicant_payment(Request $request){
       
        $validator = Validator::make($request->all(), [ 'email' => 'required|email',
            'paymentReference' => 'required|string',
            //'desc' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response()->json(['status'=>'Nok','msg'=>'Error: email/paymentReference required','rsp'=>''], 400);
        }
        try {
            if($request->has('transactionId') && !empty($request->input('transactionId'))) {
                if($this->update_applicant_payment_db($rrr=$request->paymentReference,$rem_transactionId=$request->transactionId,$rtMsg)){
                    return $rtMsg;
                }
             
            } else {
        
                return response()->json(['status'=>'Nok','msg'=>'Payment failed :transactionId from Remita is empty','rsp'=>''], 400);

            }
          
        } catch (\Throwable $th) {
            return response()->json(['status'=>'Nok','msg'=>'Error from catch... update_special_remita_payment()','rsp'=>''], 401);

        }   
    
    }


    public function update_applicant_payment_db($rrr,$rem_transactionId,&$rtMsg){
        try{
        $payment_record = ApplicantPayment::where('rrr',$rrr)->first();
        if(empty($payment_record)){ $rtMsg = response()->json(['status'=>'Nok','msg'=>'No match RRR record from DB','rsp'=>''],400);return true;}
        if(trim($payment_record->status_code )== "025" && trim($payment_record->status_msg) == "pending"){
        $payment_record->remita_transaction_id = $rem_transactionId;
        $payment_record->status_code = "00" ;
        $payment_record->status_msg = "success";
        //$payment_record->save();
        $save = $payment_record->save();
        if($save){
            $payment_record = ApplicantPayment::where('rrr',$rrr)->first();
            $app_init = new Application();
            $app_init->submitted_by = $payment_record->email;
            $app_init->app_type = $payment_record->pay_type;
            $app_init->save();
            $payment_record->app_id = $app_init->id;
            $payment_record->save();
            $rtMsg = response()->json(['status'=>'ok','msg'=>'Payment successful','rsp'=>''], 200);
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
            if($this->update_applicant_payment_db($rrr=$rrr,$rem_transactionId="REQUERY",$rtMsg)){
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
        if($this->update_applicant_payment_db($rrr=$RRRvalue,$rem_transactionId= $rem_transactionId ,$rtMsg)){
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
        if($this->update_applicant_payment_db($rrr=$RRRvalue,$rem_transactionId= $rem_transactionId ,$rtMsg)){
            return $rtMsg;
        }else{
            return response()->json(['status'=>'Nok','msg'=>'Error: cannot complete response from remita bank payment processing','rsp'=>''], 400);
        }
       
        } catch (\Throwable $th) {
            // throw $th;
            return response()->json(['status' => 'Nok', 'msg' => 'Catch Error : remita_bank_special_payment()'], 401);
        }

    }



    public function view_payments(Request $request){
        
        try {
            $data = app('App\Http\Controllers\ConfigController')->auth_user(session('user'));
            $payments = DB::table('application_payments')->select('*')->where('email', $data->email)->latest()->get();
            return view('pages.payment_history',['payments'=>$payments])->with('data', $data);
        
        } catch (\Throwable $th) {
            return back()->with('view_payments','view_payments');
        }    
       
    }

    public function viewReceipt(Request $request, $ref){
        $data = app('App\Http\Controllers\ConfigController')->auth_user(session('user'));
        $payment_data = DB::table('application_payments')->join('applicants', 'application_payments.email', '=', 'applicants.email')
        ->join('settings', 'application_payments.session', '=', 'settings.id')
        ->where([
                ['application_payments.email',$data->email],
                ['application_payments.trans_ref', $ref],['application_payments.status_code', '00']
            ])->select('application_payments.*','applicants.profile_pix','settings.session')->first();
        return view('receipt',['payment_data'=>$payment_data]);
    }



}
