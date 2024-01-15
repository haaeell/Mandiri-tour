<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class KeluhanBaruNotification extends Notification
{
    use Queueable;

    protected $keluhan;

    /**
     * Create a new notification instance.
     *
     * @param  \App\Models\Keluhan  $keluhan
     */
    public function __construct($keluhan)
    {
        $this->keluhan = $keluhan;
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

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->line('Ada keluhan baru dari pengguna.')
            ->line('Subject: ' . $this->keluhan->subject)
            ->line('Description: ' . $this->keluhan->description)
            ->action('Lihat Keluhan', route('keluhan.show', $this->keluhan->id))
            ->line('Terima kasih telah menggunakan aplikasi kami!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'keluhan_id' => $this->keluhan->id,
            'subject' => $this->keluhan->subject,
            'description' => $this->keluhan->description,
            'user_id' => $this->keluhan->user_id,
            'status' => $this->keluhan->status,
        ];
    }
}
