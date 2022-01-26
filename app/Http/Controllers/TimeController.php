<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTimeRequest;
use App\Http\Requests\UpdateTimeRequest;
use App\Models\Time;

class TimeController extends Controller
{

    public function index() {
        //
    }

    public function store(StoreTimeRequest $request) {
        //
    }

    public function update(UpdateTimeRequest $request, Time $time) {
        //
    }

    public function destroy(Time $time) {
        //
    }
}
