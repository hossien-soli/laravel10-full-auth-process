<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Config;

class MainController extends Controller
{
    public function home(): View
    {
        $appTitle = Config::get('custom.app_title');
        $data = [
            'pageTitle' => $appTitle,
        ];
        return view('main.home',$data);
    }
}
