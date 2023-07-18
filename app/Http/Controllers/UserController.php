<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Lang;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function panel(): View
    {
        $user = Auth::user();
        $userUnreadNotifications = $user->unreadNotifications()->take(15)->get(['id','data']);
        $data = [
            'pageTitle' => 'پنل کاربری',
            'user' => $user,
            'userUnreadNotifications' => $userUnreadNotifications,
        ];
        return view('user.panel',$data);
    }

    public function panelPOST(Request $request): RedirectResponse
    {
        $action = $request->input('action');
        $validActions = ['notification_mark_as_read'];
        if (!in_array($action,$validActions)) {
            Session::flash('flash_error_message',Lang::get('messages.no_required_info'));
            return Redirect::back();
        }

        if ($action == 'notification_mark_as_read') {
            $notificationId = $request->input('notification_id');
            if (!$notificationId) {
                Session::flash('flash_error_message',Lang::get('messages.no_required_info'));
                return Redirect::back();
            }

            $user = Auth::user();
            $notification = $user->unreadNotifications()->where('id',$notificationId)->first(['id']);
            if (!$notification) {
                Session::flash('flash_error_message',Lang::get('messages.no_required_info'));
                return Redirect::back();
            }

            $notification->markAsRead();
            return Redirect::back();
        }
    }

    public function notifications(): View
    {

    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return Redirect::route('main.home');
    }
}
