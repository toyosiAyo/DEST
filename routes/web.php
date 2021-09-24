<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () {
    return view('auth/login');
});
Route::get('/register', function () {
    return view('/auth/register');
});
Route::get('/forgot', function () {
    return view('/auth/forgot-password');
});
Route::get('/home', function () {
    return view('/pages/home');
});
