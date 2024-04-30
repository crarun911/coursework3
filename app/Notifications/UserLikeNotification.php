<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class UserLikeNotification extends Notification
{
    use Queueable;
    public $user;
    
    /**
     * Create a new notification instance.
     */
    public function __construct($user)
    {
        $this->user=$user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }


    public function toArray(object $notifiable): array
    {
        
        if ($this->user) {

            return [
                'user_id' =>(string) $this->user['id'],
                'name' => $this->user['name'],
                'email' => $this->user['email']
            ];
        }else{
            return [];
        }
    }
}
