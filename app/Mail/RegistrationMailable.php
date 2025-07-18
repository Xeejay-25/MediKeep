<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RegistrationMailable extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $notificationType;

    /**
     * Create a new message instance.
     *
     * @param object $user
     * @param string $notificationType
     */
    public function __construct($user, $notificationType)
    {
        $this->user = $user;
        $this->notificationType = $notificationType;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('notification.registration-email')
            ->with([
                'user' => $this->user,
                'notificationType' => $this->notificationType
            ])
            ->subject('New User Registration Request')
            ->from('no-reply@medikeep.com', 'Team MediKeep');
    }
}