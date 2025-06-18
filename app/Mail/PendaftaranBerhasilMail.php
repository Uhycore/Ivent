<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class PendaftaranBerhasilMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $pendaftaran;

    public function __construct($user, $pendaftaran)
    {
        $this->user = $user;
        $this->pendaftaran = $pendaftaran;
    }

    public function build()
    {
        return $this->subject('Meminta pembayaran')
            ->view('emails.meminta_pembayaran');
    }
}
