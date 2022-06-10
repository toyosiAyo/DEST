<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\ConfigController;
use App\Http\Controllers\RemitaConfig;
use App\Http\Controllers\ApplicantPaymentController;
use App\Http\Controllers\AdminController;

use Illuminate\Support\Facades\Http;


// some comments here
Route::get('test_mail',[ApplicationController::class,'test_mail'])->name('test_mail');
Route::get('getFile',[ApplicationController::class,'getFile'])->name('getFile');
Route::post('saveFile',[ApplicationController::class,'saveFile'])->name('saveFile');

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

});






Route::get('forgot/password',[AuthController::class,'forgot_password'])->name('forgot.password');
Route::post('forgot/password',[AuthController::class,'forgot_password_post'])->name('forgot.password');
Route::post('auth/check',[AuthController::class,'auth_check'])->name('auth.check');
Route::get('logout',[AuthController::class,'logout'])->name('logout');
Route::post('save/account/form',[AuthController::class,'save_new_account'])->name('save.account.form');
Route::get('account_activate_view',[AuthController::class,'account_activate_view'])->name('account_activate_view');
Route::post('account_activate',[AuthController::class,'account_activate'])->name('account_activate');
Route::get('resend_otp',[AuthController::class,'resend_otp'])->name('resend_otp');

Route::get('student',function(){
    return view('auth/student');
});
Route::get('/applicant',[AuthController::class,'auth_login']);



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
    Route::get('get_country',[ConfigController::class,'get_country'])->name('get_country');
    Route::post('log_new_rrr',[RemitaConfig::class,'log_new_rrr'])->name('log_new_rrr');
    Route::post('update_applicant_payment',[ApplicantPaymentController::class,'update_applicant_payment'])->name('update_applicant_payment');
    Route::get('profile',[ConfigController::class,'user_profile'])->name('profile');
    Route::get('application',[ApplicationController::class,'view_applications'])->name('application');
    Route::get('payments',[ApplicantPaymentController::class,'view_payments'])->name('payments');
    Route::get('/receipt/{id}',[ApplicantPaymentController::class,'viewReceipt']);

    Route::post('password_reset',[AuthController::class,'password_reset'])->name('password_reset');
    Route::post('log_new_teller',[RemitaConfig::class,'log_new_teller'])->name('log_new_teller');



    //********************************************Admin Authenticated Route************************************************

    Route::post('approve_payments',[AdminController::class,'approve_payments']);
    Route::get('admin/dashboard',[AdminController::class,'adminDashboard']);
    Route::get('admin/pending_payments',[AdminController::class,'pendingPayments'])->name('pending_payments');
    Route::get('admin/payments',[AdminController::class,'allPayments'])->name('allpayments');
    Route::get('admin/applicants',[AdminController::class,'viewApplicants'])->name('viewApplicants');
    Route::get('admin/applications',[AdminController::class,'viewApplications'])->name('viewApplications');
    Route::get('admin/pending_applications',[AdminController::class,'viewPendingApplications'])->name('viewPendingApplications');
    Route::get('admin/curriculum',[AdminController::class,'curriculum'])->name('curriculum');
    Route::get('admin/events',[AdminController::class,'viewEventsPage'])->name('events');
    Route::post('create_event',[AdminController::class,'postEvents']);
    Route::get('admin/advance',function(){
        return view('admin/pages/form-advanced');
    });
});

//******************************************************Admin Normal Route******************************************************

Route::get('admin',function(){
    return view('admin/auth/auth-login');
});
Route::post('admin_login_auth',[AdminController::class,'login']);
Route::get('admin/logout',[AdminController::class,'logout'])->name('adminlogout');


