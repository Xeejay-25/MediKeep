<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LogUserActivity {
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Check if the user is authenticated
        if (Auth::check()) {
            // Log user activity
            $this->logActivity($request);
        }

        return $next($request);
    }

    /**
     * Log the user activity to the log file.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    protected function logActivity($request)
    {
        Log::info('User  Activity', [
            'user_id'    => Auth::id(),
            'user_role'  => Auth::user()->role,  // Ensure 'role' exists in the User model
            'action'     => $request->route()->getName() ?? 'unknown_action', // Fallback if route name is not set
            'url'        => $request->url(),
            'method'     => $request->method(),
            'ip_address' => $request->ip(),
            'user_agent' => $request->header('User-Agent'),
            'timestamp'  => now(), 
        ]);
    }
}