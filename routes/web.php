<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\ConfigController;
use App\Http\Controllers\RemitaConfig;
use App\Http\Controllers\ApplicantPaymentController;




Route::post('image_upload',[ConfigController::class,'image_upload'])->name('image_upload');


Route::get('forgot/password',[AuthController::class,'forgot_password'])->name('forgot.password');
Route::post('forgot/password',[AuthController::class,'forgot_password_post'])->name('forgot.password');
Route::post('auth/check',[AuthController::class,'auth_check'])->name('auth.check');
Route::get('logout',[AuthController::class,'logout'])->name('logout');
Route::post('save/account/form',[AuthController::class,'save_new_account'])->name('save.account.form');


Route::group(['middleware'=>['authcheck']], function() {
    Route::get('register',[AuthController::class,'register_form'])->name('get.account.form');
    Route::get('/',[AuthController::class,'auth_login'])->name('auth.login');
    Route::get('dashboard',[AuthController::class,'applicant_dashboard'])->name('applicant.dashboard');


    Route::post('save/app/form',[ApplicationController::class,'save_app_form'])->name('save.app.form');
    Route::get('app_form',[ApplicationController::class,'get_app_form'])->name('app.form');
    Route::get('create_application',[ApplicationController::class,'create_application'])->name('create.application');


    Route::get('get_remita_config',[RemitaConfig::class,'get_remita_config'])->name('get_remita_config');
    Route::get('college_dept_prog',[ConfigController::class,'college_dept_prog'])->name('college_dept_prog');
    Route::get('check_pend_rrr',[RemitaConfig::class,'check_pend_rrr'])->name('check_pend_rrr');
    Route::post('log_new_rrr',[RemitaConfig::class,'log_new_rrr'])->name('log_new_rrr');
    Route::post('update_applicant_payment',[ApplicantPaymentController::class,'update_applicant_payment'])->name('update_applicant_payment');
    Route::get('profile',[AuthController::class,'user_profile'])->name('profile');
    Route::get('application',[AuthController::class,'view_applications'])->name('application');
    Route::get('payments',[AuthController::class,'view_payments'])->name('payments');



   
});



// Route::get('/create_application', function () {
//     return view('/pages/create_application');
// });


// Route::get('/form', function () {
//     return view('/pages/form');
// });

// Route::get('loaddata',[ConfigController::class,'load_data'])->name('load.data');

// Route::any('get_lga_state_country',[ConfigController::class,'get_lga_state_country'])->name('get_lga_state_country');
// Route::any('get_state_given_country',[ConfigController::class,'get_state_given_country'])->name('get_state_given_country');



// Route::post('save/app/form',[ApplicationController::class,'save_app_form'])->name('save.app.form');
// Route::get('get_app_form',[ApplicationController::class,'get_app_form'])->name('get.app.form');
// Route::get('create_application',[ApplicationController::class,'create_application'])->name('create.application');
