<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Queue\SerializesModels;

class SendPenarikanDanaGagal extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data, $penggalangan, $panti)
    {
        $this->data = $data;
        $this->penggalangan = $penggalangan;
        $this->panti = $panti;
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
            subject: 'Penarikan Dana Penggalangan Dana ' . $this->penggalangan->judul .' ditolak',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function build()
    {
        return $this->view('pelaksana.role.panti.email-penarikan-dana')
                   ->subject('Laporan Penarikan Dana')
                   ->with(
                    [
                        'judul' => $this->penggalangan->judul,
                        'panti' => $this->panti->nama_panti,
                        'alasan' => $this->data->catatan_status,
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
