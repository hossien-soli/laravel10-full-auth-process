<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Lang;
use App\Rules\AlphaSymbolsNumbers;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\RateLimiter;
use App\Events\PasswordResetEvent;

class PasswordController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function forgot(): View
    {
        $data = [
            'pageTitle' => 'بازنشانی رمز عبور',
        ];
        return view('password.forgot',$data);
    }

    public function forgotPOST(Request $request): RedirectResponse
    {
        $request->validate([
            'username_or_email' => ['required','string','max:50'],
        ]);

        $usernameOrEmail = strtolower($request->input('username_or_email'));
        $key = 'username';
        if (filter_var($usernameOrEmail,FILTER_VALIDATE_EMAIL)) { $key = 'email'; }
        else {
            $validation = Validator::make(['username_or_email' => $usernameOrEmail],[
                'username_or_email' => ['alpha_dash'],
            ]);

            if ($validation->fails()) {
                Session::flash('flash_error_message',Lang::get('messages.invalid_username_or_email'));
                return Redirect::back()->withInput();
            }
        }

        $rateLimiterKey = 'password-forgot' . $request->ip();
        if (RateLimiter::tooManyAttempts($rateLimiterKey,3)) {
            $seconds = RateLimiter::availableIn($rateLimiterKey);
            $message = $this->rateLimiterMessage($seconds);
            Session::flash('flash_error_message',$message);
            return Redirect::back();
        }

        $status = Password::sendResetLink([$key => $usernameOrEmail]);
        if ($status != Password::RESET_LINK_SENT) {
            Session::flash('flash_error_message',Lang::get('messages.invalid_username_or_email'));
            return Redirect::back()->withInput();
        }

        RateLimiter::hit($rateLimiterKey,3600);

        Session::flash('flash_success_message',Lang::get('messages.password_reset_link_sent'));
        return Redirect::back()->withInput();
    }

    public function reset(Request $request): View
    {
        $token = $request->query('token');
        $email = $request->query('email');
        $validate = $token && $email;
        if (!$validate) { abort(404); }
        $email = strtolower($email);
        $data = [
            'pageTitle' => 'تنظیم رمز عبور جدید',
            'token' => $token,
            'email' => $email,
        ];
        return view('password.reset',$data);
    }

    public function resetPOST(Request $request): RedirectResponse
    {
        $request->validate([
            'token' => ['required'],
            'email' => ['required','string','max:50','email'],
            'password' => ['required','string','min:6','max:30',new AlphaSymbolsNumbers,'confirmed'],
        ]);

        $creds = [
            'email' => strtolower($request->input('email')),
            'password' => $request->input('password'),
            'password_confirmation' => $request->input('password_confirmation'),
            'token' => $request->input('token'),
        ];

        $rateLimiterKey = 'password-reset' . $request->ip();
        if (RateLimiter::tooManyAttempts($rateLimiterKey,3)) {
            $seconds = RateLimiter::availableIn($rateLimiterKey);
            $message = $this->rateLimiterMessage($seconds);
            Session::flash('flash_error_message',$message);
            return Redirect::back();
        }

        $status = Password::reset($creds,function (User $user,string $password) {
            $user->forceFill([
                'password' => Hash::make($password)
            ])->setRememberToken(Str::random(60));
            $user->save();
            event(new PasswordResetEvent($user));
        });

        if ($status != Password::PASSWORD_RESET) {
            Session::flash('flash_error_message',Lang::get('messages.password_reset_error'));
            return Redirect::back();
        }

        RateLimiter::hit($rateLimiterKey,3600);

        Session::flash('flash_success_message',Lang::get('messages.password_was_reset'));
        return Redirect::route('auth.login');
    }
}
