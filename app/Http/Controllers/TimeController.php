<?php

namespace App\Http\Controllers;

use App\Actions\ParseTimeStringAction;
use App\Http\Requests\StoreTimeRequest;
use App\Http\Requests\UpdateTimeRequest;
use App\Models\Project;
use App\Models\Time;
use Symfony\Component\HttpFoundation\Response;

class TimeController extends Controller
{
    public function __construct() {
        $this->authorizeResource(Time::class, 'time');
    }

    public function store(StoreTimeRequest $request, Project $project, ParseTimeStringAction $parseTimeStringAction): Response {
        $project->times()
            ->create([
                'time_spent' => $parseTimeStringAction->handle($request->validated()['time_spent']),
            ]);

        return response()->json([
            'message' => 'Successfully added new project time!',
        ], Response::HTTP_CREATED);
    }

    public function update(UpdateTimeRequest $request, Project $project, Time $time, ParseTimeStringAction $parseTimeStringAction): Response {
        $time->update([
            'time_spent' => $parseTimeStringAction->handle($request->validated()['time_spent']),
        ]);

        return response()->json([
            'message' => 'Successfully updated project time!',
        ], Response::HTTP_OK);
    }

    public function destroy(Project $project, Time $time): Response {
        $time->delete();

        return response()->json([
            'message' => 'Successfully removed project time!',
        ], Response::HTTP_OK);
    }
}
