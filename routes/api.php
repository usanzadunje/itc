<?php


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TimeController;
use Illuminate\Support\Facades\Route;

// Route for fetching currently logged-in user
Route::get('/auth/user', AuthController::class)->middleware(['auth:sanctum']);

Route::apiResource('project', ProjectController::class)
    ->middleware(['auth:sanctum']);

Route::apiResource('project.time', TimeController::class)
    ->except('index', 'show')
    ->middleware(['auth:sanctum']);