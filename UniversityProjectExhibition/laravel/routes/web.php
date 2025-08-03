<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\StudentController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\ProjectController;
use App\Http\Controllers\API\RegistrationController;

Route::get('/', function () {
    return view('welcome');
});
Route::apiResource('students', StudentController::class);
Route::apiResource('users', UserController::class);
Route::apiResource('projects', ProjectController::class);
Route::apiResource('registrations', RegistrationController::class);
