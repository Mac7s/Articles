<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\RateLimiter;

class EmailVerificationNotificationController extends Controller
{
    /**
     * Send a new email verification notification.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return response()->json([
                'message'=>'you have verified your email before'
            ]);
        }

        if (RateLimiter::tooManyAttempts('verify-email:'.$request->user()->id, $perMinute = 2)) {
            return response()->json([
                'message'=>'Too many attempts!'
            ]);
        }
        RateLimiter::hit('verify-email:'.$request->user()->id);
        $request->user()->sendEmailVerificationNotification();
        return response()->json(['status' => 'verification-link-sent']);

    }
}
