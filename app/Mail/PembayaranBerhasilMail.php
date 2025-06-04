<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PembayaranBerhasilMail extends Mailable
{
    use Queueable, SerializesModels;

    public $transaksi;
    public $user;
    public $event;

    public function __construct($transaksi, $user, $event)
    {
        $this->transaksi = $transaksi;
        $this->user = $user;
        $this->event = $event;
    }

    public function build()
    {
        return $this->subject('Pembayaran Berhasil')
            ->view('emails.pembayaran_berhasil');
    }
}
