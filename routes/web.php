<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ApplicationController;





Route::get('forgot/password',[AuthController::class,'forgot_password'])->name('forgot.password');
Route::post('forgot/password',[AuthController::class,'forgot_password_post'])->name('forgot.password');
Route::post('auth/check',[AuthController::class,'auth_check'])->name('auth.check');
Route::get('logout',[AuthController::class,'logout'])->name('logout');
Route::post('save/account/form',[AuthController::class,'save_new_account'])->name('save.account.form');


Route::group(['middleware'=>['authcheck']], function() {
    Route::get('get/account/form',[AuthController::class,'register_form'])->name('get.account.form');
    Route::get('/',[AuthController::class,'auth_login'])->name('auth.login');
    Route::get('dashboard',[AuthController::class,'applicant_dashboard'])->name('applicant.dashboard');
   
});



Route::get('/create_application', function () {
    return view('/pages/create_application');
});
