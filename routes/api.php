<?php

use App\Http\Controllers\BuildingController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::apiResource('users', UserController::class)
    ->only(['index']);

Route::apiResource('buildings', BuildingController::class)
    ->only(['index']);

Route::apiResource('buildings.tasks', TaskController::class)
    ->only(['index', 'store']);

Route::apiResource('tasks.comments', CommentController::class)
    ->only(['store']);
