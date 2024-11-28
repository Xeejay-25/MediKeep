<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogViewerAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    //set 1 for staff, 2 for admin, 3 for super admin, dedending on who should be 
    //allowed to access the log-viewer
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();
        if ($user && $user->role === 3) {
            return $next($request);
        }

        return redirect('/'); 
    }
}