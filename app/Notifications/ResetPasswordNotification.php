<?php

namespace App\Notifications;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class ResetPasswordNotification extends Notification
{
    public $token;

    public function __construct($token)
    {
        $this->token = $token;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        // Enkripsi email sebelum dimasukkan ke URL
        $encryptedEmail = Crypt::encryptString($notifiable->email);

        $url = url('/reset-password/' . $this->token . '?email=' . urlencode($encryptedEmail));

        return (new MailMessage)
            ->subject('Reset Password Akun Anda')
            ->greeting('Halo ' . $notifiable->name . '!')
            ->line('Kami menerima permintaan untuk mereset password akun Anda.')
            ->action('Reset Password', $url)
            ->line('Jika Anda tidak meminta reset password, abaikan email ini.')
            ->salutation('Salam, Admin');
    }
}
