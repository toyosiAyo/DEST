<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\ApplicantPaymentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ConfigController;
use App\Http\Controllers\Users\AdminController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::any('create_curriculum', [AdminController::class, 'create_curriculum']);

//Route::post('update_applicant_payment',[ApplicantPaymentController::class,'update_applicant_payment'])->name('update_applicant_payment');
//Route::post('password_reset',[AuthController::class,'password_reset'])->name('password_reset');
// Route::get('college_dept_prog',[ConfigController::class,'college_dept_prog'])->name('college_dept_prog');


