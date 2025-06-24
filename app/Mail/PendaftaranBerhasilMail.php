<?php

namespace App\Mail;

use App\Models\Event;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class PendaftaranBerhasilMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $pendaftaran;
    public $event;

    public function __construct($user, $pendaftaran)
    {
        $this->user = $user;
        $this->pendaftaran = $pendaftaran;
        $this->event = Event::findOrFail($pendaftaran->event_id);
    }

    public function build()
    {
        return $this->subject('Meminta pembayaran')
            ->view('emails.meminta_pembayaran');
    }
}
