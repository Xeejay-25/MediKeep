<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    protected $fillable = [
        'user_id', 'user_role', 'action', 'url', 'method', 'ip_address', 'user_agent'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
