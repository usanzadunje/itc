<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Symfony\Component\HttpFoundation\Response;

class ProjectController extends Controller
{
    public function __construct() {
        $this->authorizeResource(Project::class, 'project');
    }

    public function index(): ResourceCollection {
        $projects = auth()->user()
            ->projects()
            ->with('latestTime')
            ->get();

        return ProjectResource::collection($projects);
    }

    public function show(Project $project): ProjectResource {
        return new ProjectResource($project->load('times'));
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
