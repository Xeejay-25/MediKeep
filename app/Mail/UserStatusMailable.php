<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserStatusMailable extends Mailable
{
    use Queueable, SerializesModels;

    public $status;
    public $type;
    public $user;
    public $role;

    /**
     * Create a new message instance.
     *
     * @param string $status
     * @param string $type
     * @param object $user
     * @param string $role
     */
    public function __construct($status, $type, $user, $role)
    {
        $this->status = $status;
        $this->type = $type;
        $this->user = $user;
        $this->role = $role;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('notification.email')
            ->with([
                'status' => $this->status,
                'type' => $this->type,
                'user' => $this->user,
                'role' => $this->role
            ])
            ->subject('Your Account Status Update')
            ->from('no-reply@medikeep.com', 'Team MediKeep');
    }
}