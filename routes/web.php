<?php

use Illuminate\Support\Facades\Route;




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
Route::get('/create_application', function () {
    return view('/pages/create_application');
});
