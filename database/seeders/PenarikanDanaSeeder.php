<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PenarikanDana;

class PenarikanDanaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PenarikanDana::create([
            'id_penggalangan' => 1,
            'jumlah' => 1000000,
            'nama' => 'Dita Adetia Nadila',
            'nama_bank' => 'BNI',
            'no_rekening' => '0460080083',
            'status' => 2,
        ]);

        PenarikanDana::create([
            'id_penggalangan' => 1,
            'jumlah' => 200000,
            'nama' => 'Ismail',
            'nama_bank' => 'BNI',
            'no_rekening' => '888888',
            'status' => 2,
        ]);

        PenarikanDana::create([
            'id_penggalangan' => 1,
            'jumlah' => 100000,
            'nama' => 'Emilia Ramadhanty Gunawan',
            'nama_bank' => 'BNI',
            'no_rekening' => '0460080083',
            'status' => 0,
        ]);
    }
}
