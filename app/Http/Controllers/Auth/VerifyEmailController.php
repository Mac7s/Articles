<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     *
     * @param  \Illuminate\Foundation\Auth\EmailVerificationRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(EmailVerificationRequest $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return response()->json([
                'message'=>'you verified your email before'
            ]);
        }
        if (RateLimiter::tooManyAttempts('GET:verify-email:'.$request->user()->id, $perMinute = 2)) {
            return response()->json([
                'message'=>'Too many attempts!'
            ]);
        }
        RateLimiter::hit('GET:verify-email:'.$request->user()->id);
        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        return response()->json([
            'message'=>'your email verified successfully'
        ]);
    }
}
