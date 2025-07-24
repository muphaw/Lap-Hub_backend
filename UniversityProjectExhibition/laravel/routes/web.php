<?php

use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\StudentController;
use App\Http\Controllers\API\ProjectController;
use App\Http\Controllers\API\RegistrationController;

Route::resource('users', UserController::class);
Route::resource('students', StudentController::class);
Route::resource('projects', ProjectController::class);
Route::resource('registrations', RegistrationController::class);




