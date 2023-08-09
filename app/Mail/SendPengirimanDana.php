<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Queue\SerializesModels;

class SendPengirimanDana extends Mailable
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
            subject: 'Laporan Penarikan Dana Penggalangan Dana ' . $this->penggalangan->judul,
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
                    ])
                   ->attach(public_path() . '/storage' .'/' . 'bukti pencairan dana/' . $this->data->bukti_transfer, [
                    'as' => 'Laporan Penarikan Dana' . '-' . $this->data->bukti_transfer .'.pdf',
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
