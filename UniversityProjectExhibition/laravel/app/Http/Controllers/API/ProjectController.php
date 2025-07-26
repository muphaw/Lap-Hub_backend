<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
    public function index() {
        return Project::all();
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'project_id' => 'required|string|unique:projects',
            'user_id' => 'required|string|exists:users,user_id',
            'project_name' => 'required|string',
            'project_detail' => 'nullable|string',
            'project_date' => 'required|date',
            'project_link' => 'nullable|url',
            'project_image' => 'nullable|string',
            'collaborators' => 'nullable|string',
            'popularity' => 'nullable|integer'
        ]);
        return Project::create($validated);
    }

    public function show($id) {
        return Project::findOrFail($id);
    }

    public function update(Request $request, $id) {
        $project = Project::findOrFail($id);
        $project->update($request->all());
        return $project;
    }

    public function destroy($id) {
        Project::destroy($id);
        return response()->json(['message' => 'Deleted']);
    }
}
