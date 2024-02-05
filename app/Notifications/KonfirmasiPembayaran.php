<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class KonfirmasiPembayaran extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    protected $pemesanan;

    public function __construct($pemesanan)
    {
        $this->pemesanan = $pemesanan;
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
            ->line('pemesanan Anda telah ditanggapi oleh admin.')
            ->line('Subject: ' . $this->pemesanan->subject)
            ->line('Description: ' . $this->pemesanan->description)
            ->action('Lihat pemesanan', route('pemesanan.show', $this->pemesanan->id))
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
            'pemesanan_id' => $this->pemesanan->id,
        ];
    }
}
