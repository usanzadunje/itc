<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTimeRequest;
use App\Http\Requests\UpdateTimeRequest;
use App\Models\Project;
use App\Models\Time;
use Symfony\Component\HttpFoundation\Response;

class TimeController extends Controller
{
    public function store(StoreTimeRequest $request, Project $project): Response {
        $project->times()
            ->create($request->validated());

        return response()->json([
            'message' => 'Successfully added new project time!',
        ], Response::HTTP_CREATED);
    }

    public function update(UpdateTimeRequest $request, Project $project, Time $time): Response {
        $time->update($request->validated());

        return response()->json([
            'message' => 'Successfully updated project time!',
        ], Response::HTTP_OK);
    }

    public function destroy(Project $project, Time $time): Response {
        $project->times()->delete($time);

        return response()->json([
            'message' => 'Successfully removed project time!',
        ], Response::HTTP_OK);
    }
}
