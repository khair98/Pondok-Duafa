<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Penggalangan;
use Carbon\Carbon;



class PenggalanganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Penggalangan::create([
            'id_panti' => 1,
            'judul' => 'Pengeluaran Bulanan',
            'deskripsi' => 'Pengeluaran Bulan Maret Panti Asuhan Hidayatullah',
            'foto' => 'courses-1.jpg',
            'jumlah' => 30000000,
            'waktu_mulai' => Carbon::now()->format('Y-m-d'),
            'waktu_selesai' => '2023-10-12',
            'proposal' => 'proposal.pdf',
            'bukti_pencairan_dana' => 'bukti_pencairan_dana.pdf',
            'laporan' => 'laporan.pdf',
            'status' => true,
            'verif' => 2,
        ]);
        Penggalangan::create([
            'id_panti' => 1,
            'judul' => 'Pengeluaran Bulanan',
            'deskripsi' => 'Pengeluaran Bulan April Panti Asuhan Hidayatullah',
            'foto' => 'courses-2.jpg',
            'jumlah' => 33500000,
            'waktu_mulai' => Carbon::now()->format('Y-m-d'),
            'waktu_selesai' => '2023-10-23',
            'proposal' => 'proposal.pdf',
            'bukti_pencairan_dana' => 'bukti_pencairan_dana.pdf',
            'laporan' => 'laporan.pdf',
            'status' => true,
            'verif' => 2,
        ]);
        Penggalangan::create([
            'id_panti' => 1,
            'judul' => 'Pengeluaran Bulanan',
            'deskripsi' => 'Pengeluaran Bulan Mei Panti Asuhan Hidayatullah',
            'foto' => 'courses-3.jpg',
            'jumlah' => 28000000,
            'waktu_mulai' => Carbon::now()->format('Y-m-d'),
            'waktu_selesai' => '2023-05-12',
            'proposal' => 'proposal.pdf',
            'bukti_pencairan_dana' => 'bukti_pencairan_dana.pdf',
            'laporan' => 'laporan.pdf',
            'status' => true,
            'verif' => 2,
        ]);
        Penggalangan::create([
            'id_panti' => 1,
            'judul' => 'Pengeluaran Bulanan',
            'deskripsi' => 'Pengeluaran Bulan Juni Panti Asuhan Hidayatullah',
            'foto' => 'courses-4.jpg',
            'jumlah' => 16500000,
            'waktu_mulai' => Carbon::now()->format('Y-m-d'),
            'waktu_selesai' => '2023-10-23',
            'proposal' => 'proposal.pdf',
            'bukti_pencairan_dana' => 'bukti_pencairan_dana.pdf',
            'laporan' => 'laporan.pdf',
            'status' => true,
            'verif' => 2,
        ]);
    }
}
