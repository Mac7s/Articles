<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\ArticleController;

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

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});
require __DIR__.'/auth.php';

Route::prefix('v1')->group(function(){
    Route::get('articles',[ArticleController::class,'index']);
    Route::get('articles/{article:slug}',[ArticleController::class,'show']);
    Route::post('articles',[ArticleController::class,'store'])->middleware(['auth:sanctum','throttle:3,1']);
    Route::put('articles/{article:slug}',[ArticleController::class,'update'])->middleware(['auth:sanctum','throttle:3,1']);
    Route::delete('articles/{article:slug}',[ArticleController::class,'destory'])->middleware(['auth:sanctum','throttle:3,1']);
});










