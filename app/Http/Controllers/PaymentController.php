<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\ApplicantPayment;
use App\Models\AdmissionPayment;
use App\Models\SchoolfeesPayment;
use Illuminate\Support\Facades\Http;
use App\Models\Applicant;
use App\Models\Application;
use Illuminate\Support\Facades\Cookie;

class PaymentController extends Controller
{
    public function __construct(){
        $this->middleware('authcheck');
    }

    public function checkAdmissionPayment($app_id, $total){
        $data = app('App\Http\Controllers\ConfigController')->auth_user(session('user'));

        $check_payment = DB::table("admission_payments")->where(['email'=>$data->email,'app_id'=>$app_id,'amount'=>$total,
            'status'=>'success'])->first();
        if($check_payment){
            return $check_payment->status;
        }
    }

    public function checkSchoolfeePayment($request){
        $data = app('App\Http\Controllers\ConfigController')->auth_user(session('user'));
        $settings = $request->settings;

        $check_payment = DB::table("fees_payments")
            ->join('fees_payments_breakdown', 'fees_payments.trans_ref', 'fees_payments_breakdown.trans_ref')
            ->select('fees_payments.trans_ref', 'fees_payments_breakdown.item_id', 'fees_payments_breakdown.amount_paid', 'fees_payments.status')
            ->where(['email'=>$data->email,'status'=>'success','degree'=>$_COOKIE['degree'],'session'=>$settings->session])->get();
        return $check_payment;
    }

    public function getPaymentSchedule(Request $request){
        if($request->app_type =="part_time"){
            $settings = app('App\Http\Controllers\ConfigController')->part_time_settings($request);
        }else{
            $settings = app('App\Http\Controllers\ConfigController')->settings($request);
        }
        $request->merge(['settings'=>$settings]);

        $settings = $request->settings;
        $semester = $settings->semester_code;

        $category = app('App\Http\Controllers\ApplicationController')->getFacultyCategory($request->app_id);
        $payload = DB::table('fee_schedule')->where(['degree'=>$request->app_type,'type'=>$request->type,'category'=>$category])
        ->select('id','item','type','amount','degree','category','installment','semester_amount->'.$semester.' as amount_due')->get();
        $total = $payload->sum('amount');
        $payment_status = "";

        if($request->type == "admission"){
            $payment_status = $this->checkAdmissionPayment($request->app_id,$total);
            return response(['payload'=>$payload,'total'=>$total,'payment_status'=>$payment_status], 200);
        }
        else{
            $payment_status = $this->checkSchoolfeePayment($request);
            $combined = $payload->map(function ($item) use ($payment_status) {
                $payments = $payment_status->where('item_id', $item->id);
                $item->amount_paid = count($payments) > 0 ? $payments->sum('amount_paid') : 0;
                $item->payment_count = count($payments);
                if($item->amount_due === null && $item->amount_paid === 0){ 
                    $item->amount_due = $item->amount;
                }
                if($item->amount_paid >= $item->amount_due){
                    $item->amount_due = $item->amount - $item->amount_paid;
                }
                if($item->amount_paid < $item->amount_due){
                    $item->amount_due = $item->amount_due - $item->amount_paid;
                }
                return $item;
            });
            return ['payload'=>$payload,'total'=>$total,'combined'=>$combined];
        }
    }

    public function initSchoolFessPayment(Request $request){
        $items = $request->item;    // array of item values
        $amounts = $request->amount; // array of amount values

        $total_amount = array_sum($amounts);
        $settings = json_decode($request->settings);

        // Validate that both arrays are present and have the same length
        if (!is_array($items) || !is_array($amounts) || count($items) !== count($amounts)) {
            return response(['status'=>'failed','message'=>'Invalid input arrays'], 400);
        }

        $check_pending_payment = DB::table('fees_payments')
            ->where(['email'=>$request->email,'amount'=>$total_amount,'degree'=>$_COOKIE['degree'],'status'=>'pending','session'=>$settings->id])->first();

        if($check_pending_payment){
            return response(['status'=>'ok','message'=>'Redirecting to payment gateway...', 'url'=>$check_pending_payment->url], 200);
        }

        $timesammp = DATE("dmyHis"); 
        $reference = app('App\Http\Controllers\RemitaConfig')->remita_generate_trans_ID();

        $body = [
            'amount' => $total_amount * 100,
            'bearer' => 0,
            'callbackUrl' => 'https://destadms.run.edu.ng/validate-schoolfees-payment',
            'channels' => ['card', 'bank'],
            'currency' => 'NGN',
            'customerFirstName' => $request->first_name,
            'customerLastName' => $request->surname,
            'email' => $request->email,
            'reference' => $reference,
        ];

        $headers = [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => '1PUB6199pVbAtClO8n3DBSLG7H9yW6xesgi2Xn',
        ];

        $response = Http::withHeaders($headers)->post('https://api.credocentral.com/transaction/initialize', $body);
        $data = $response->json();

        if($data["status"] == 200){
            $details = $data["data"];

            $payment = new SchoolfeesPayment();
            $payment->email = $request->email;
            $payment->amount = $total_amount;
            $payment->degree = $_COOKIE['degree'];
            $payment->trans_ref = $reference;
            $payment->session = $settings->session;
            $payment->url = $details["authorizationUrl"];
            $payment->reference = $details["credoReference"];
            $payment->status = 'pending';
            $payment->save();

            foreach ($items as $index => $item) {
                DB::table('fees_payments_breakdown')->insert([
                    'item_id' => $item,
                    'amount_paid' => $amounts[$index],
                    'trans_ref' => $reference,
                ]);
            }

            return response(['status'=>'ok','message'=>'Payment successfully logged', 'url'=>$details["authorizationUrl"]], 201);
        }
        return response(['status'=>'failed','message'=>'Unable to initiate payment'], 400);
    }

    public function initAdmissionPayment(Request $request){
        $validator = Validator::make($request->all(), [ 
            'app_id' => 'required|string',
            'degree' => 'required|string',
            'email' => 'required|string',
            'payload' => 'required',
            'amount' => 'required|string',
            'surname' => 'required|string',
            'first_name' => 'required|string'
        ]);
        if ($validator->fails()) {
            return response(['status'=>'failed','message'=>'Validation error'], 400);
        }

        //$session = app('App\Http\Controllers\ConfigController')->settings($request)->id;
        $session = "9";
        $check_pending_payment = DB::table('admission_payments')->where(['email'=>$request->email,'amount'=>$request->amount,'app_id'=>$request->app_id,'status'=>'pending','session'=>$session])->first();

        if($check_pending_payment){
            return response(['status'=>'ok','message'=>'Redirecting to payment gateway...', 'url'=>$check_pending_payment->url], 200);
        }

        $timesammp = DATE("dmyHis"); 
        $reference = app('App\Http\Controllers\RemitaConfig')->remita_generate_trans_ID();
            
        $body = [
            'amount' => $request->amount * 100,
            'bearer' => 0,
            'callbackUrl' => 'https://destadms.run.edu.ng/validate-admission-payment',
            'channels' => ['card', 'bank'],
            'currency' => 'NGN',
            'customerFirstName' => $request->first_name,
            'customerLastName' => $request->surname,
            'email' => $request->email,
            'reference' => $reference,
        ];

        $headers = [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => '1PUB6199pVbAtClO8n3DBSLG7H9yW6xesgi2Xn',
        ];

        $response = Http::withHeaders($headers)->post('https://api.credocentral.com/transaction/initialize', $body);
        $data = $response->json();

        if($data["status"] == 200){
            $details = $data["data"];

            $payment = new AdmissionPayment();
            $payment->email = $request->email;
            $payment->amount = $request->amount;
            $payment->app_id = $request->app_id;
            $payment->degree = $request->degree;
            $payment->trans_ref = $reference;
            $payment->session = $session;
            $payment->url = $details["authorizationUrl"];
            $payment->reference = $details["credoReference"];
            $payment->payload = json_encode($request->payload);
            $payment->status = 'pending';
            $payment->save();

            return response(['status'=>'ok','message'=>'Payment successfully logged', 'url'=>$details["authorizationUrl"]], 201);
        }
        
        return response(['status'=>'failed','message'=>'Unable to initiate payment'], 400);
    
    }
    
    public function initApplicationPayment(Request $request){
        $validator = Validator::make($request->all(), [ 
            'payType' => 'required|string',
            'email' => 'required|string',
            'surname' => 'required|string',
            'first_name' => 'required|string',
            'amount' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response(['status'=>'failed','msg'=>'Validation error'], 400);
        }
        //try {
            
            $status = app('App\Http\Controllers\ApplicationController')->checkForUsedPin($request)['msg'];
            if($status == "success"){
                // Cookie::make('app_type', $request->payType, 120);
                // Cookie::make('pin', $pin, 120);
                $pin = app('App\Http\Controllers\ApplicationController')->checkForUsedPin($request)['pin'];
                setcookie("app_type", $request->payType, time() + 3600, "/");
                setcookie("pin", $pin, time() + 3600, "/");
                
                return response(['status'=>'ok','message'=>'Redirecting to application form...', 'url'=>'/app_form'], 201);
            }
            
            //$session = app('App\Http\Controllers\ConfigController')->settings($request)->id;
            $session = "9";
            $check_pending_payment = ApplicantPayment::where(['email'=>$request->email,'amount'=>$request->amount,'pay_type'=>$request->payType,'status_msg'=>'pending','session'=>$session])->first();

            if($check_pending_payment){
                return response(['status'=>'ok','message'=>'Redirecting to payment gateway...', 'url'=>$check_pending_payment->rrr], 201);
            }
            
            $timesammp = DATE("dmyHis"); 
            $reference = app('App\Http\Controllers\RemitaConfig')->remita_generate_trans_ID();
            
            $body = [
              'amount' => $request->amount * 100,
              'bearer' => 0,
              'callbackUrl' => 'https://destadms.run.edu.ng/validate-payment',
              'channels' => ['card', 'bank'],
              'currency' => 'NGN',
              'customerFirstName' => $request->first_name,
              'customerLastName' => $request->surname,
              'email' => $request->email,
              'reference' => $reference,
            ];
            
            $headers = [
              'Content-Type' => 'application/json',
              'Accept' => 'application/json',
              'Authorization' => '1PUB6199pVbAtClO8n3DBSLG7H9yW6xesgi2Xn',
            ];
            
            $response = Http::withHeaders($headers)->post('https://api.credocentral.com/transaction/initialize', $body);
            $data = $response->json();
            
            if($data["status"] == 200){
                $details = $data["data"];

                $payment = new ApplicantPayment();
                $payment->email = $request->email;
                $payment->names = $request->surname.' '.$request->first_name;
                $payment->amount = $request->amount;
                $payment->trans_ref = $reference;
                $payment->pay_type = $request->payType;
                $payment->session = $session;
                $payment->rrr = $details["authorizationUrl"];
                $payment->remita_transaction_id = $details["credoReference"];
                $payment->status_code = '025';
                $payment->status_msg = 'pending';
                $payment->time_stamp = $timesammp;
                $payment->save();
    
                return response(['status'=>'ok','message'=>'Payment successfully logged', 'url'=>$details["authorizationUrl"]], 201);
            }
            
            return response(['status'=>'failed','message'=>'Unable to initiate payment'], 400);
            
            
        // }
        // catch (\Throwable $th) {
        //     return response(['status'=>'failed','message'=>'Error loging new payment'], 500);
        // }
    }

    public function validateSchoolfeesPayment(Request $request){
        $validator = Validator::make($request->all(), [ 
            'reference' => 'required|string',
            'transAmount' => 'required|string'
        ]);
        if ($validator->fails()) {
            return response(['status'=>'failed','message'=>'Validation error'], 400);
        }
        $reference = $request->reference;

        $check = SchoolfeesPayment::where(['status'=>'pending','trans_ref'=>$reference])->first(); 
        if($check){
            $data = $this->validatePaymentEngine($reference);
            if($data["status"] == 200){
                $details = $data["data"];
                if($details["status"] == 0 && $details["statusMessage"] == "Successfully processed"){
                    $check->status = 'success';
                    if($check->save()){
                        if($request->action == "requery"){
                            return response(['status'=>'success','message'=>"Transaction successfully updated"], 200);
                        }
                        return redirect('/transactions');
                    }
                    return redirect('/student_dashboard');
                }
                if($request->action == "requery"){
                    return response(['status'=>'failed','message'=>"Transaction still pending"], 400);
                }
                return redirect('/student_dashboard');
            }
            return redirect('/student_dashboard');
        }
        return redirect('/student_dashboard');

    }

    public function validateAdmissionPayment(Request $request){
        $validator = Validator::make($request->all(), [ 
            'reference' => 'required|string',
            'transAmount' => 'required|string'
        ]);
        if ($validator->fails()) {
            return response(['status'=>'failed','message'=>'Validation error'], 400);
        }
        $reference = $request->reference;

        $check = AdmissionPayment::where(['status'=>'pending','trans_ref'=>$reference])->first(); 

        if($check){
            $data = $this->validatePaymentEngine($reference);
            if($data["status"] == 200){
                $details = $data["data"];
                if($details["status"] == 0 && $details["statusMessage"] == "Successfully processed"){
                    $check->status = 'success';
                    if($check->save()){
                        DB::table('applicants')->where('email', $check->email)->update(['status' => 'student']);
                        if($request->action == "requery"){
                            return response(['status'=>'success','message'=>"Transaction successfully updated"], 200);
                        }
                        return redirect('/payments');
                    }
                    return redirect('/dashboard');
                }
                if($request->action == "requery"){
                    return response(['status'=>'failed','message'=>"Transaction still pending"], 400);
                }
                return redirect('/dashboard');
            }
            return redirect('/dashboard');
        }
        return redirect('/dashboard');
    }
    
    public function validateApplicationPayment(Request $request){
        $validator = Validator::make($request->all(), [ 
            'reference' => 'required|string',
            'transAmount' => 'required|string'
        ]);
        if ($validator->fails()) {
            return response(['status'=>'failed','message'=>'Validation error'], 400);
        }
        
        $reference = $request->reference;
        // $credoMessage = $request->errorMessage;
        
        $check = ApplicantPayment::where(['status_msg'=>'pending','trans_ref'=>$reference])->first(); // add 'amount'=>$request->transAmount,
        if($check){
            $data = $this->validatePaymentEngine($reference);
            if($data["status"] == 200){
                $details = $data["data"];
                if($details["status"] == 0 && $details["statusMessage"] == "Successfully processed"){
                    $check->status_code = '00';
                    $check->status_msg = 'success';
                    $check->approved_by = 'E-tranzact';
                    $check->approved_at = date("F j, Y, g:i a");
                    if($check->save()){
                       $init_app = new Application;
                       $init_app->submitted_by = $check->email;
                       $init_app->app_type = $check->pay_type;
                       $init_app->status = "pending";
                       $init_app->form_status = '0';
                       $init_app->save();
                       
                       setcookie("app_type", $check->pay_type, time() + 3600, "/");
                       setcookie("pin", $check->rrr, time() + 3600, "/");
                       if($request->action == "requery"){
                            return response(['status'=>'success','message'=>"Transaction successfully updated, you will be redirected to application form now"], 200);
                       }
                       return redirect('/app_form');
                    }
                    return redirect('/dashboard');
                }
                if($request->action == "requery"){
                    return response(['status'=>'failed','message'=>"Transaction still pending"], 400);
                }
                return redirect('/dashboard');
            }
            return redirect('/dashboard');
        }
        return redirect('/dashboard');
    }

    public function validatePaymentEngine($reference){
        $headers = [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => '1PRI6199K1cCrgmOk4OclzZ3neg3cZC31yQzZx',
        ];
        $response = Http::withHeaders($headers)->get('https://api.credocentral.com/transaction/'.$reference.'/verify');
        $data = $response->json();
        return $data;
    }
    
}