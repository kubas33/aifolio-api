<?php

use App\Http\Controllers\V1\AiImageController;
use App\Http\Controllers\V1\AiImageMetaController;
use App\Http\Controllers\V1\AiModelController;
use App\Http\Controllers\V1\CategoryController;
use App\Http\Controllers\V1\TagController;
use App\Http\Controllers\Auth\AuthController;
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

Route::middleware('auth:api')->get('/auth/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'prefix' => 'auth',
], function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
});

Route::group([
    'prefix' => 'v1',
    'middleware' => 'auth:api'
], function () {
    Route::resource('ai-model', AiModelController::class)->except('create', 'edit');
    Route::resource('category', CategoryController::class)->except('create', 'edit');
    Route::resource('tag', TagController::class)->except('create', 'edit');
    Route::resource('ai-image', AiImageController::class)->except('create', 'edit');
    Route::resource('ai-image-meta', AiImageMetaController::class)->except('create', 'edit');
});
