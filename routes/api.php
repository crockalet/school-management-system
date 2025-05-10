<?php

use App\Http\Controllers\ClassroomsController;
use App\Http\Controllers\StudentsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/login', \App\Http\Controllers\LoginController::class)
    ->name('login')
    ->middleware('guest');

Route::resource('students', StudentsController::class)
    ->only(['index', 'store', 'show', 'update', 'destroy'])
    ->middleware('auth:sanctum');

Route::resource('classrooms', ClassroomsController::class)
    ->only(['index', 'store', 'show', 'update', 'destroy'])
    ->middleware('auth:sanctum');

Route::prefix('classrooms/{classroom}/students')
    ->middleware('auth:sanctum')
    ->group(function () {
        Route::post('assign', [\App\Http\Controllers\ClassroomStudentsController::class, 'assign'])
            ->name('classrooms.students.assign');

        Route::post('unassign', [\App\Http\Controllers\ClassroomStudentsController::class, 'unassign'])
            ->name('classrooms.students.unassign');
    });