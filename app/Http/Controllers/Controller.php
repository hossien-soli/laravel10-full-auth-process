<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Lang;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected function rateLimiterMessage(int $seconds): string
    {
        if ($seconds >= (3600 * 2)) {
            $hours = round($seconds / 3600);
            return Lang::get('messages.rate_limiter_hours',['value' => $hours]);
        }

        if ($seconds >= (60 * 2)) {
            $minutes = round($seconds / 60);
            return Lang::get('messages.rate_limiter_minutes',['value' => $minutes]);
        }

        return Lang::get('messages.rate_limiter_seconds',['value' => $seconds]);
    }
}
