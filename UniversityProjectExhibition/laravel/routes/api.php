<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\StudentController;
use App\Http\Controllers\API\ProjectController;
use App\Http\Controllers\API\RegistrationController;



Route::get('/ping', function () {
    return response()->json(['message' => 'pong']);
});

Route::apiResource('users', UserController::class);
Route::apiResource('students', StudentController::class);
Route::apiResource('projects', ProjectController::class);
Route::apiResource('registrations', RegistrationController::class);

Route::post('/posts', function () {
    // $registration = Registration::create([
    //     'student_id' => 1
    // ]);

    // return response()->json([
    //     'message' => 'Saved successfully',
    //     'data' => $registration
    // ]);
    return "posts";
});
