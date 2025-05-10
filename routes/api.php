<?php

use App\Http\Controllers\StudentsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/login', \App\Http\Controllers\LoginController::class)
    ->name('login')
    ->middleware('guest');

Route::resource('students', StudentsController::class)
    ->only(['index', 'store', 'show', 'update', 'destroy'])
    ->middleware('auth:sanctum');