<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client;

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
        // Get the current time in PST formatted in 12-hour format
        $timestamp = $this->getCurrentTimeInPST();

        // Log the user activity with relevant details
        Log::info('User  Activity', [
            'user_id'    => Auth::id(),
            'user_role'  => Auth::user()->role,
            'action'     => $request->route()->getName() ?? 'unknown_action', // Action performed
            'url'        => $request->url(), 
            'method'     => $request->method(), 
            'ip_address' => $request->ip(), 
            'user_agent' => $request->header('User -Agent'),
            'timestamp'  => $timestamp, 
        ]);
    }

    /**
     * Get the current time in Philippine Standard Time from TimeAPI.io.
     *
     * @return string
     */
    protected function getCurrentTimeInPST()
    {
        try {
            $client = new Client();
            // Fetch the current time in PST from TimeAPI.io
            $response = $client->get('https://timeapi.io/api/Time/current/zone?timeZone=Asia/Manila');
            $data = json_decode($response->getBody(), true);
            
            // Convert the ISO 8601 datetime to a 12-hour format
            $dateTime = new \DateTime($data['dateTime']);
            return $dateTime->format('Y-m-d h:i:s A'); // Format: 2024-12-05 05:52:21 PM
        } catch (\Exception $e) {
            // In case of an error, fallback to the local time in 12-hour format
            return now()->format('Y-m-d h:i:s A'); // Fallback to local time in 12-hour format
        }
    }
}