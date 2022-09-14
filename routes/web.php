<?php

use App\Http\Controllers\Api\V1\ArticleController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\RateLimiter;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/password-reset/{token}', function ($token) {
    return view('reset-password', ['token' => $token]);
})->middleware('guest');

Route::get('one',function(){
    echo "test";
})->middleware('throttle:3,1');



