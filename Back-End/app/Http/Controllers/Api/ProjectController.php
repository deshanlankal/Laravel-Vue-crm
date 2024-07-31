<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Project;
use App\Http\Resources\ProjectResource; 
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;



class ProjectController extends Controller
{
    public function index()
    {
        $project = Project::get();
        if ($project->count() > 0) {
            return ProjectResource::collection($project);
        } else {
            return response()->json(['message' => 'No record available'], 200);
        }
    }

    public function store(StoreProjectRequest $request)
    {

        $project = Project::create($request->validated());

        return response()->json([
            'message' => 'New Customer Created Successfully',
            'data' => new ProjectResource($project)
        ], 200);
    }

    public function show(Project $project)
    {
        return new ProjectResource($project);
    }

    public function update(StoreProjectRequest $request, Project $project)
    {

        $project->update($request->validated());

        return response()->json([
            'message' => 'New Project Created Successfully',
            'data' => new ProjectResource($project)
        ], 200);
    }

    public function destroy(Project $project)
    {
        $project->delete();
        return response()->json([
            'message'=> 'Project Deleted Successfully',
        ],200);
    }
}
