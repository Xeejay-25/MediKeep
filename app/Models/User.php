<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Notifications\UserStatusNotification;
use App\Notifications\RegistrationNotification;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, SoftDeletes;

    const ROLE_STAFF = 1;
    const ROLE_ADMIN = 2;
    const ROLE_SUPERADMIN = 3;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'status',
        'role',
        'google_id',
        'email_verified_at',
        'profile_image'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Boot method to add model event listeners.
     */
    protected static function boot()
    {
        parent::boot();

        static::created(function ($user) {
            $notifications = [];

            if ($user->status !== 'approved') {
                $notifications[] = new UserStatusNotification(null, 'created', $user->role);
            }

            if ($user->status === 'approved') {
                $notifications[] = new UserStatusNotification($user->status, 'status', $user->role);
            }

            if ($user->isDirty('role')) {
                $notifications[] = new UserStatusNotification($user->role, 'role', $user->role);
            }

            // Notify admin about the new user creation
            $adminEmail = config('mail.admin_email');
            $admin = User::where('email', $adminEmail)->first();
            if ($admin && $user->email !== $adminEmail) {
                $notificationType = $user->status === 'approved' ? 'created_by_admin' : 'created_by_user';
                $admin->notify(new RegistrationNotification($user, $notificationType));
            }

            foreach ($notifications as $notification) {
                $user->notify($notification);
            }
        });

        static::updating(function ($user) {
            $notifications = [];

            if ($user->isDirty('status')) {
                if ($user->status === 'rejected') {
                    $user->delete();
                } elseif (in_array($user->status, ['approved', 'pending', 'disabled', 'rejected'])) {
                    $notifications[] = new UserStatusNotification($user->status, 'status', $user->role);
                }
            }

            if ($user->isDirty('role')) {
                $notifications[] = new UserStatusNotification($user->role, 'role', $user->role);
            }

            foreach ($notifications as $notification) {
                $user->notify($notification);
            }
        });

        static::deleting(function ($user) {
            if (!$user->isForceDeleting()) {
                if ($user->status !== 'disabled') {
                    $user->status = 'disabled';
                    $user->save();
                    $user->notify(new UserStatusNotification(null, 'archived', $user->role));
                }
            } else {
                $user->notify(new UserStatusNotification(null, 'deleted', $user->role));
            }
        });

        static::restoring(function ($user) {
            $user->status = 'pending';
            $user->save();
            $user->notify(new UserStatusNotification(null, 'restored', $user->role));
        });
    }
}
