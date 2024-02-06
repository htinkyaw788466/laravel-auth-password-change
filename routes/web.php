<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//password change route
Route::get('/change-password',([App\Http\Controllers\Auth\ChangePasswordController::class,'index']))
        ->name('password.change');
Route::post('/change-password',([App\Http\Controllers\Auth\ChangePasswordController::class,'update']))
        ->name('password.update');
