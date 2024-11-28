<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role)
    {
        $roleMapping = [
            'staff' => 1,
            'admin' => 2,
            'superadmin' => 3,
        ];
    
        if (!$request->user() || $request->user()->role !== $roleMapping[$role]) {
            abort(403, 'Unauthorized action.');
        }
    
        return $next($request);
    }
    
}