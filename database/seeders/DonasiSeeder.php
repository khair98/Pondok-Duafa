<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Donasi;

class DonasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Donasi::create([
            'id_penggalangan' => 1,
            'nama' => 'Hamba Allah',
            'email' => 'ditadetian@gmail.com',
            'jumlah' => 5000000,
            'bukti_pembayaran' => 'bukti pembayaran.jpeg',
            'metode_pembayaran' => 'qris',
            'kirim_email' => true,
            'email' => 'ditadetian@gmail.com',
            'verif' => 2,
        ]);
        Donasi::create([
            'id_penggalangan' => 1,
            'nama' => 'Hamba Allah',
            'email' => 'risiummulkhair98@gmail.com',
            'jumlah' => 1000000,
            'bukti_pembayaran' => 'bukti pembayaran.jpeg',
            'metode_pembayaran' => 'bsi',
            'kirim_email' => true,
            'verif' => 1,
        ]);
        Donasi::create([
            'id_penggalangan' => 1,
            'nama' => 'Hamba Allah',
            'email' => 'ditadetyan@gmail.com',
            'jumlah' => 1500000,
            'bukti_pembayaran' => 'bukti pembayaran.jpeg',
            'metode_pembayaran' => 'qris',
            'kirim_email' => false,
            'verif' => 0,
        ]);
        Donasi::create([
            'id_penggalangan' => 1,
            'nama' => 'Hamba Allah',
            'email' => 'ditadetyan@gmail.com',
            'jumlah' => 15000000,
            'bukti_pembayaran' => 'bukti pembayaran.jpeg',
            'metode_pembayaran' => 'bsi',
            'verif' => 2,
        ]);
        Donasi::create([
            'id_penggalangan' => 2,
            'nama' => 'Hamba Allah',
            'email' => 'ditadetyan@gmail.com',
            'jumlah' => 6000000,
            'bukti_pembayaran' => 'bukti pembayaran.jpeg',
            'metode_pembayaran' => 'qris',
            'kirim_email' => true,
            'verif' => 2,
        ]);
        Donasi::create([
            'id_penggalangan' => 2,
            'nama' => 'Hamba Allah',
            'email' => 'ditadetyan@gmail.com',
            'jumlah' => 1000000,
            'bukti_pembayaran' => 'bukti pembayaran.jpeg',
            'metode_pembayaran' => 'qris',
            'kirim_email' => true,
            'verif' => 2,
        ]);
        Donasi::create([
            'id_penggalangan' => 3,
            'nama' => 'Hamba Allah',
            'email' => 'ditadetyan@gmail.com',
            'jumlah' => 1400000,
            'bukti_pembayaran' => 'bukti pembayaran.jpeg',
            'metode_pembayaran' => 'qris',
            'kirim_email' => true,
            'verif' => 2,
        ]);
        Donasi::create([
            'id_penggalangan' => 4,
            'nama' => 'Hamba Allah',
            'email' => 'ditadetyan@gmail.com',
            'jumlah' => 2300000,
            'bukti_pembayaran' => 'bukti pembayaran.jpeg',
            'metode_pembayaran' => 'qris',
            'kirim_email' => true,
            'verif' => 2,
        ]);
    }
}
