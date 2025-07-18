<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;

class ActivityLogController extends Controller
{
    public function index()
    {
        // $logs = ActivityLog::with('user')->orderBy('created_at', 'desc')->paginate(10); // Order by created_at descending
        // return view('admin.activitylogs', compact('logs'));

        $logs = ActivityLog::orderBy('created_at', 'desc')->get();
        return view('admin.activitylogs', compact('logs'));
    }


}

