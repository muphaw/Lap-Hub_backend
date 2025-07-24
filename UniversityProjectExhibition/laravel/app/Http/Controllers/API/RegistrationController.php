<?php

namespace App\Http\Controllers\API;

use App\Models\Registrations;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRegistrationRequest;
use App\Http\Requests\UpdateRegistrationRequest;
use App\Http\Resources\RegistrationResource;
use Illuminate\Http\Request;
use Carbon\Carbon;


class RegistrationController extends Controller
{
    public function index() { 
        return RegistrationResource::collection(Registrations::all()); 
        //return "Index";
    }

    public function store(StoreRegistrationRequest $request)
    {
        // $registration = Registration::create($request->validated());
        // return new RegistrationResource($registration);


        // $request->validate([
        //     'student_id' => 'required|integer|exists:students,student_id'
        // ]);
        $id = $request->student_id;

     $registration = Registrations::create([
        'student_id' => $request->student_id,
        'email' => $request->email,
        'purpose' => $request->purpose,
        'otp_code' => $request->otp_code,
        'expires_at' => Carbon::now()->addMinute(10),
    ]);

        return response()->json([
            'message' => 'Registration created successfully',
            'data' => $registration
        ], 201);
    
    }

    public function show($id)
    {
        return new RegistrationResource(Registration::findOrFail($id));
    }

    public function update(UpdateRegistrationRequest $request, $id)
    {
        $registration = Registration::findOrFail($id);
        $registration->update($request->validated());
        return new RegistrationResource($registration);
    }

    public function destroy($name)
    {
        Registration::destroy($id);
        return response()->json(['message' => 'Registration deleted']);
    }
}
