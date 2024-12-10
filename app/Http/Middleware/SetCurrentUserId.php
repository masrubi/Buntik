<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SetCurrentUserId
{
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            // Set current user ID in MySQL session
            DB::statement("SET @current_user_id = ?", [Auth::id()]);
        }

        return $next($request);
    }
}
