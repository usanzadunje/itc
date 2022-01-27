<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTimeRequest;
use App\Http\Requests\UpdateTimeRequest;
use App\Models\Time;
use Symfony\Component\HttpFoundation\Response;

class TimeController extends Controller
{
    public function store(StoreTimeRequest $request) {
        //
    }

    public function update(UpdateTimeRequest $request, Time $time) {
        //
    }

    public function destroy(Time $time): Response {
        $time->delete();

        return response()->json([
            'message' => 'Successfully removed time!',
        ], Response::HTTP_OK);
    }
}
