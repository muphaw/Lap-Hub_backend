<?php

namespace App\Http\Controllers\API;

use App\Models\Collaborator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CollaboratorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Collaborator::with('user')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users',
            'name' => 'required|string',
            'email' => 'required|email|unique:collaborators',
            'major' => 'nullable|string',
            'batch' => 'nullable|string',
            'image' => 'nullable|string'
        ]);

        $collaborator = Collaborator::create($validated);
        return response()->json($collaborator, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Collaborator  $collaborator
     * @return \Illuminate\Http\Response
     */
    public function show(Collaborator $collaborator)
    {
        return $collaborator->load('user');
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Collaborator  $collaborator
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Collaborator $collaborator)
    {
        $validated = $request->validate([
            'user_id' => 'sometimes|exists:users',
            'name' => 'sometimes|string',
            'email' => 'sometimesemail|unique:collaborators',
            'major' => 'nullable|string',
            'batch' => 'nullable|string',
            'image' => 'nullable|string',
        ]);

        $collaborator->update($validated);
        return response()->json($collaborator);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Collaborator  $collaborator
     * @return \Illuminate\Http\Response
     */
    public function destroy(Collaborator $collaborator)
    {
        $collaborator->delete();
        return response()->json(['message' => 'Collaborator Deleted']);
    }
}
