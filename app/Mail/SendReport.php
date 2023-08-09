<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Queue\SerializesModels;

class SendReport extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data, $panti, $user)
    {
        $this->data = $data;
        $this->panti = $panti;
        $this->user = $user;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            from: new Address('pondok.duafa.khair@gmail.com', 'Pondok Duafa'),
            subject: 'Laporan Penggalangan Dana',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function build()
    {
        return $this->view('donatur.email-laporan')
                   ->subject('Laporan Penggalangan Dana')
                   ->attach(public_path() . '/storage' .'/' . 'laporan/' . $this->user->username .'/' . $this->panti->nama_panti .'/' . $this->data->laporan, [
                    'as' => 'Laporan Penggalangan Dana ' . '-' . $this->data->judul .'.pdf',
                    'mime' => 'image/*, application/pdf',
                ]);
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
