<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function panel(): View
    {
        $user = Auth::user();
        $data = [
            'pageTitle' => 'پنل کاربری',
            'user' => $user,
        ];
        return view('user.panel',$data);
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return Redirect::route('main.home');
    }
}
