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

Route::get('test',function(){
    $client = new \IPPanel\Client(config('services.sms.api_key'));
    $messageId = $client->send(
        config('services.sms.originator_number'),          // originator
        ["+989336024962"],    // recipients
        "این یک پیام لاراول است",// message
        'this is description'
    );
    dd($messageId);
});

