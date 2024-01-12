<?php

use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('posts', \App\Http\Controllers\Api\PostController::class);
Route::apiResource('posts.tags', \App\Http\Controllers\Api\TagController::class);
Route::apiResource('languages', \App\Http\Controllers\Api\LanguageController::class)->only('index');

Route::get('search-post', [\App\Http\Controllers\Api\PostController::class, 'search']);
