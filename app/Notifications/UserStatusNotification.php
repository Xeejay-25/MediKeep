<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserStatusNotification extends Notification
{
    use Queueable;

    protected $status;
    protected $type;
    protected $role;

    /**
     * Create a new notification instance.
     *
     * @param string $status
     * @param string $type
     * @param string $role
     */
    public function __construct($status, $type, $role)
    {
        $this->status = $status;
        $this->type = $type;
        $this->role = $role;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new \App\Mail\UserStatusMailable($this->status, $this->type, $notifiable, $this->role))
                    ->to($notifiable->email);
    }
}