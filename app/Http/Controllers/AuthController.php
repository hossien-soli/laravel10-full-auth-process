<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Rules\AlphaSymbolsNumbers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Lang;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Password;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function login(): View
    {
        $data = [
            'pageTitle' => 'ورود به حساب کاربری',
        ];
        return view('auth.login',$data);
    }

    public function loginPOST(Request $request): RedirectResponse
    {
        $request->validate([
            'username_or_email' => ['required','string','max:50'],
            'password' => ['required','string','min:6','max:30',new AlphaSymbolsNumbers],
        ]);

        $usernameOrEmail = strtolower($request->input('username_or_email'));
        $password = $request->input('password');

        $key = 'username';
        if (filter_var($usernameOrEmail,FILTER_VALIDATE_EMAIL)) { $key = 'email'; }
        else {
            $validation = Validator::make(['username_or_email' => $usernameOrEmail],[
                'username_or_email' => 'alpha_dash',
            ]);
            if ($validation->fails()) {
                Session::flash('flash_warning_message',Lang::get('messages.invalid_login_info'));
                return Redirect::back()->withInput();
            }
        }

        $rateLimiterKey = 'login' . $request->ip();
        if (RateLimiter::tooManyAttempts($rateLimiterKey,15)) {
            $seconds = RateLimiter::availableIn($rateLimiterKey);
            $message = $this->rateLimiterMessage($seconds);
            Session::flash('flash_error_message',$message);
            return Redirect::back();
        }

        RateLimiter::hit($rateLimiterKey,3600);

        $user = User::where($key,$usernameOrEmail)->first();
        if (!$user) {
            Session::flash('flash_warning_message',Lang::get('messages.invalid_login_info'));
            return Redirect::back()->withInput();
        }

        if (!Hash::check($password,$user->password)) {
            Session::flash('flash_warning_message',Lang::get('messages.invalid_login_info'));
            return Redirect::back()->withInput();
        }

        Auth::login($user,$request->filled('remember'));
        RateLimiter::clear($rateLimiterKey);

        Session::flash('flash_success_message',Lang::get('messages.successful_login'));
        return Redirect::route('user.panel');
    }

    public function register(): View
    {
        $data = [
            'pageTitle' => 'ثبت نام',
        ];
        return view('auth.register',$data);
    }

    public function registerPOST(Request $request): RedirectResponse
    {
        $request->validate([
            'full_name' => ['required','string','min:5','max:30'],
            'email' => ['required','string','max:50','email'],
            'username' => ['required','string','min:5','max:20','alpha_dash'],
            'password' => ['required','string','min:6','max:30',new AlphaSymbolsNumbers,'confirmed'],
        ]);

        $fullName = $request->input('full_name');
        $email = strtolower($request->input('email'));
        $username = strtolower($request->input('username'));
        $username = str_replace('_','-',$username);
        $password = $request->input('password');

        $emailIsUnique = DB::table('users')->where('email',$email)->count() == 0;
        if (!$emailIsUnique) {
            Session::flash('flash_error_message',Lang::get('messages.email_is_not_unique'));
            return Redirect::back()->withInput();
        }

        $usernameIsUnique = DB::table('users')->where('username',$username)->count() == 0;
        if (!$usernameIsUnique) {
            Session::flash('flash_error_message',Lang::get('messages.username_is_not_unique'));
            return Redirect::back()->withInput();
        }

        $rateLimiterKey = 'register' . $request->ip();
        if (RateLimiter::tooManyAttempts($rateLimiterKey,3)) {
            $seconds = RateLimiter::availableIn($rateLimiterKey);
            $message = $this->rateLimiterMessage($seconds);
            Session::flash('flash_error_message',$message);
            return Redirect::back();
        }

        $user = User::create([
            'full_name' => $fullName,
            'email' => $email,
            'username' => $username,
            'password' => Hash::make($password),
        ]);

        event(new Registered($user));
        RateLimiter::hit($rateLimiterKey,3600);
        Auth::login($user,true);
        $request->session()->regenerate();

        Session::flash('flash_success_message',Lang::get('messages.successful_register'));
        return Redirect::route('user.panel');
    }
}
