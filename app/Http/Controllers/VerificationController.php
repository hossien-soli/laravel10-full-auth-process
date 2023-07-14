<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Auth;

class VerificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('signed')->only('verify');
    }

    public function notice(): View
    {
        $user = Auth::user();
        $data = [
            'pageTitle' => 'تایید آدرس ایمیل',
            'user' => $user,
        ];
        return view('verification.notice',$data);
    }

    public function noticePOST(Request $request): RedirectResponse
    {
        if (!$request->filled('confirm')) {
            Session::flash('flash_error_message',Lang::get('messages.no_form_confirmation'));
            return Redirect::back();
        }

        $rateLimiterKey = 'verification-email' . $request->ip();
        if (RateLimiter::tooManyAttempts($rateLimiterKey,3)) {
            $seconds = RateLimiter::availableIn($rateLimiterKey);
            $message = $this->rateLimiterMessage($seconds);
            Session::flash('flash_error_message',$message);
            return Redirect::route('user.panel');
        }

        $request->user()->sendEmailVerificationNotification();
        RateLimiter::hit($rateLimiterKey,3600);

        Session::flash('flash_success_message',Lang::get('messages.verification_email_sent'));
        return Redirect::back();
    }

    public function verify(EmailVerificationRequest $request): RedirectResponse
    {
        $request->fulfill();
        Session::flash('flash_success_message',Lang::get('messages.email_verified'));
        return Redirect::route('user.panel');
    }
}
