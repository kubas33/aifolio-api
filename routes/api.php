<?php

use App\Http\Controllers\AiImageController;
use App\Http\Controllers\AiImageMetaController;
use App\Http\Controllers\AiModelController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TagController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'prefix' => 'v1'
], function () {
    Route::resource('ai-model', AiModelController::class)->except('create', 'edit');
    Route::resource('category', CategoryController::class)->except('create', 'edit');
    Route::resource('tag', TagController::class)->except('create', 'edit');
    Route::resource('ai-image', AiImageController::class)->except('create', 'edit');
    Route::resource('ai-image-meta', AiImageMetaController::class)->except('create', 'edit');
});
