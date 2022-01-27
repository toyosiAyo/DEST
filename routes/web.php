<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\ConfigController;
use App\Http\Controllers\RemitaConfig;
use App\Http\Controllers\ApplicantPaymentController;
use App\Http\Controllers\AdminController;

use Illuminate\Support\Facades\Http;



Route::get('/http', function () {
    //$response->body() : string;
    // $response->json() : array|mixed;
    // $response->object() : object;
    // $response->collect() : Illuminate\Support\Collection;
    // $response->status() : int;
    // $response->ok() : bool;
    // $response->successful() : bool;
    // $response->failed() : bool;
    // $response->serverError() : bool;
    // $response->clientError() : bool;
    // $response->header($header) : string;
    // $response->headers() : array;
    
    
$From = "ict@run.edu.ng";
$FromName = "Dest@REDEEMER's UNIVERSITY";
$x="hamendment@gmail.com";
$y="oluwatusint@run.edu.ng";
$To = " $x, $y ";
$Recipient_names = "Hamed David";
$code = sprintf("%06d", mt_rand(1, 999999));
$Msg ='<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="author" content="Murewa Ayodele">
        <title>RUNResult|</title>
        <link rel="shortcut icon" href="http://results.run.edu.ng/images/run_logo.png" type="image/png">
        <style>
            @font-face{
                font-family: Quicksand;
                src: url(http://results.run.edu.ng/fonts/Quicksand-Regular.otf);
            }

            @font-face{
                font-family: Quicksand;
                font-weight: bold;
                src: url(http://results.run.edu.ng/fonts/Quicksand-Bold.otf);
            }

            body, html{
                width: 100%;
                margin: 0;
                padding: 0;
                background-color: #ffffff;
            }

            header{
                width: 100%;
                height: 100px;
                background: #ffffff;
                border-bottom-style: solid;
                border-bottom-width: 1px;
                border-bottom-color: #eef0ef;
                padding-left: 50px;
                padding-right: 50px;
                padding-top: 5px;
            }

            header img {
                height: 90px;
            }

            header a {
                font-family: Quicksand;
                font-weight: bold;
                font-size: 22px;
                color: #555555;
            }

            .dp_container {
                float: right;
                margin-right: 100px;
                text-align: center;
            }

            #dp {
                height: 90px;
                border-style: solid;
                border-width: 1px;
                border-color: #ffffff;
                border-radius: 200px;
            }

            .dp_container a {
                font-family: Quicksand;
                font-weight: normal;
                font-size: 11px;
                color: #555555;
            }

            .result_container {
                width: 100%;
                background-color: #e8e9f1;
                font-family: Helvetica;
            }

            #blue{
                color: #1c2767;
            }

            .result_table {
                width: 100%;
                border-collapse: collapse;
                margin-bottom: 70px;
            }

            .result_table th, .result_table td {
                padding: 10px 10px 10px 10px;
                font-family: Quicksand;
                font-weight: normal;
                border: 1px solid #e5e5e5;
            }

            .result_container tr:nth-child(even){
                background-color: #ffffff;
            }
            
            .result_container tr:nth-child(even) td{
                background-color: #ffffff;
            }

            .result_container th {
                background-color: #1c2767;
                color: #ffffff;
                text-align: left;
                font-size: 22px;
            }

            .result_table caption {
                width: 100%;
                text-align: center;
                background-color: #ffffff;
                font-family: Quicksand;
                font-weight: normal;
                color: #222222;
                padding-top: 20px;
                padding-bottom: 5px;
                font-size: 25px;
            }

            #logout_button{
                text-decoration: none;
                font-family: Quicksand;
                color: #7e0000;
            }

            #email-popup-button img {
                height: 20px;
                cursor: pointer;
            }

            footer{
                width: 100%;
                display: block;
                font-size: 14px;
                font-family: Quicksand;
                color: #2a2a2a;
                text-align: center;
                background-color: #ffffff;
            }

            #footer_border{
                height: 2px;
                width: 100%;
                background-color: #977b1f; /* For browsers that do not support gradients */
                background: -webkit-linear-gradient(left, #977b1f, #b99f39, #f4ec70); /* For Safari 5.1 to 6.0 */
                background: -o-linear-gradient(right, #977b1f, #b99f39, #f4ec70, #977b1f, #b99f39); /* For Opera 11.1 to 12.0 */
                background: -moz-linear-gradient(bright, #977b1f, #b99f39, #f4ec70, #977b1f, #b99f39); /* For Firefox 3.6 to 15 */
                background: linear-gradient(to right, #977b1f, #b99f39, #f4ec70, #977b1f, #b99f39); /* Standard syntax */
                padding: 0;
                margin: 0;
            }

            footer img{
                width: 40px;
            }
        </style>
    </head>
    <body>
        <header>
            <img src="http://results.run.edu.ng/images/logo.gif"/>
            <div class="dp_container">
                <table>
                    <tr>
                        <td><img id="dp" src="" /></td>
                        <td>
                            <a></a><br>
                            <a></a><br>
                            <a></a><br>
                        </td>
                    </tr>
                </table>
            </div>
        </header>

        <center> 
        <p>Here is your OTP : '. $code. '</p>
        </center>
        

        <div id="footer_border"></div>
        <div class="result_container">
            
        </div>
        <footer>
        <div id="footer_border"></div>
        <table align="center">
            <tr>
                <td>
                    <img src="http://results.run.edu.ng/images/run_logo_2.png" />
                </td>
                <td>
                    &copy; Redeemer\'s University ' . date("Y") . '. All rights reserved<br>
                </td>
            </tr>
        </table>
    </footer>
    </body>
</html>'; //"<html><p> Kindly note that your Dest account password is about already being reset to : </p><br><p>11223344</p></html>";
$Subject = "Password Reset";
$HTML_type = true;
    $res = Http::asForm()->post('http://adms.run.edu.ng/codebehind/destEmail.php',[
        "From"=>$From,"FromName"=>$FromName,"To"=>$To,"Recipient_names"=>$Recipient_names,
        "Msg"=>$Msg, "Subject"=>$Subject,"HTML_type"=>$HTML_type,
    ]);
    //return "testing";
    dd($res->body());
});






Route::get('forgot/password',[AuthController::class,'forgot_password'])->name('forgot.password');
Route::post('forgot/password',[AuthController::class,'forgot_password_post'])->name('forgot.password');
Route::post('auth/check',[AuthController::class,'auth_check'])->name('auth.check');
Route::get('logout',[AuthController::class,'logout'])->name('logout');
Route::post('save/account/form',[AuthController::class,'save_new_account'])->name('save.account.form');
Route::get('account_activate_view',[AuthController::class,'account_activate_view'])->name('account_activate_view');
Route::post('account_activate',[AuthController::class,'account_activate'])->name('account_activate');
Route::get('resend_otp',[AuthController::class,'resend_otp'])->name('resend_otp');


Route::group(['middleware'=>['authcheck']], function() {
    Route::get('register',[AuthController::class,'register_form'])->name('get.account.form');
    Route::get('/',[AuthController::class,'auth_login'])->name('auth.login');
    Route::get('dashboard',[AuthController::class,'applicant_dashboard'])->name('applicant.dashboard');


    Route::post('save/app/form',[ApplicationController::class,'save_app_form'])->name('save.app.form');
    Route::get('app_form',[ApplicationController::class,'get_app_form'])->name('app.form');
    Route::get('create_application',[ApplicationController::class,'create_application'])->name('create.application');

    Route::post('uploadProfileImage',[ApplicationController::class,'uploadProfileImage'])->name('uploadProfileImage');

    Route::get('get_remita_config',[RemitaConfig::class,'get_remita_config'])->name('get_remita_config');
    Route::get('college_dept_prog',[ConfigController::class,'college_dept_prog'])->name('college_dept_prog');
    Route::get('check_pend_rrr',[RemitaConfig::class,'check_pend_rrr'])->name('check_pend_rrr');
    Route::post('log_new_rrr',[RemitaConfig::class,'log_new_rrr'])->name('log_new_rrr');
    Route::post('update_applicant_payment',[ApplicantPaymentController::class,'update_applicant_payment'])->name('update_applicant_payment');
    Route::get('profile',[ConfigController::class,'user_profile'])->name('profile');
    Route::get('application',[ApplicationController::class,'view_applications'])->name('application');
    Route::get('payments',[ApplicantPaymentController::class,'view_payments'])->name('payments');

    Route::post('password_reset',[AuthController::class,'password_reset'])->name('password_reset');
    Route::post('log_new_teller',[RemitaConfig::class,'log_new_teller'])->name('log_new_teller');



    //********************************************Admin Authenticated Route************************************************

    Route::get('admin/dashboard',[AdminController::class,'adminDashboard']);
    Route::get('admin/pending_payments',[AdminController::class,'pendingPayments'])->name('pending_payments');
    Route::get('admin/payments',[AdminController::class,'allPayments'])->name('allpayments');
    Route::get('admin/applicants',[AdminController::class,'viewApplicants'])->name('viewApplicants');
});

//******************************************************Admin Normal Route******************************************************

Route::get('admin',function(){
    return view('admin/auth/auth-login');
});
Route::post('admin_login_auth',[AdminController::class,'login']);
Route::get('admin/logout',[AdminController::class,'logout'])->name('adminlogout');


