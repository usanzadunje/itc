<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Http\Resources\ProjectResorce;
use App\Models\Project;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Symfony\Component\HttpFoundation\Response;

class ProjectController extends Controller
{
    public function index(): ResourceCollection {
        $projects = auth()->user()->projects;

        return ProjectResorce::collection($projects);
    }

    public function store(StoreProjectRequest $request): Response {
        auth()->user()
            ->projects()
            ->create($request->validated());

        return response()->json([
            'message' => 'Successfully created new project!',
        ], Response::HTTP_CREATED);
    }

    public function update(UpdateProjectRequest $request, Project $project): Response {
        $project->update($request->validated());

        return response()->json([
            'message' => 'Successfully updated project!',
        ], Response::HTTP_OK);
    }

    public function destroy(Project $project): Response {
        $project->delete();

        return response()->json([
            'message' => 'Successfully deleted project!',
        ], Response::HTTP_OK);
    }
}
