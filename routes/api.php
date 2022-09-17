<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\ArticleController;
use App\Http\Controllers\CategoryArticleController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\SmsverifyController;

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
    Route::get('categories/{category:name}/articles',[CategoryArticleController::class,'index'])->name('categories.articles.index');
    Route::post('send-verification',[SmsverifyController::class,'askForVerify'])->middleware('throttle:3,30');
    Route::post('verify-number',[SmsverifyController::class,'VerifyNumber'])->middleware('throttle:3,30');
    Route::get('articles/{article:slug}/likes',[LikeController::class,'addLike'])->middleware('auth:sanctum');
    Route::get('articles/{article:slug}/dislikes',[LikeController::class,'addDislike'])->middleware(['auth:sanctum','throttle:3,1']);
    Route::post('articles/{article:slug}/comments',[CommentController::class,'store'])->middleware(['auth:sanctum','throttle:3,1']);
    Route::put('articles/{article:slug}/comments/{comment:id}',[CommentController::class,'update'])->middleware(['auth:sanctum','throttle:3,1']);
    Route::delete('articles/{article:slug}/comments/{comment:id}',[CommentController::class,'destroy'])->middleware(['auth:sanctum','throttle:3,1']);
});










