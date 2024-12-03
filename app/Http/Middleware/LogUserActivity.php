<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;

class LogUserActivity
{
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            ActivityLog::create([
                'user_id'    => Auth::id(),
                'user_role'  => Auth::user()->role,  // Assuming you have a 'role' column in the users table
                'action'     => $request->route()->getName(),
                'url'        => $request->url(),
                'method'     => $request->method(),
                'ip_address' => $request->ip(),
                'user_agent' => $request->header('User-Agent'),
            ]);
        }
        return $next($request);
    }
}
