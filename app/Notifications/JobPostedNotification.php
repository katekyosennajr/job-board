<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class JobPostedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $job;

    public function __construct($job)
    {
        $this->job = $job;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Lowongan Baru Diposting')
                    ->line('Lowongan baru telah diposting: ' . $this->job->title)
                    ->action('Lihat Lowongan', url('/jobs/' . $this->job->id))
                    ->line('Terima kasih telah menggunakan platform kami!');
    }
}
