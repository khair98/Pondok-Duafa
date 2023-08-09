<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Panti;

class PantiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Panti::create([
            'id_user' => 2,
            'nama_panti' => 'Panti Asuhan Hidayatullah',
            'alamat' => 'Jl. Tabrani Ahmad',
            'email' => 'panti.hidayatullah@gmail.com',
            'kontak' => '6289693838246',
            'jumlah_anak' =>40,
            'status' => 'Active',
            'diajukan' => true,
            'profil' => '<div><strong>Nama Pemilik</strong></div><div>Ibu Ferliani Anggraeni<br><br></div><div><strong>Alamat</strong></div><div>Jl Banjaran Pucung, Gg. Masjid Al Ikhlas Jl. Emeralda Raya No.100, RT.3/RW.10, Cilangkap, Kec. Tapos, Kota Depok, Jawa Barat 16458, Indonesia<br><br></div><div><strong>Deskripsi</strong></div><div>Panti kami telah berdiri di Kota Depok sejak tahun 2009, yang berkonsentrasi di pelayanan: 1. Tumbuh kembang anak yatim dan dhuafa yang berusia balita hingga remaja terlantar (yang dititipkan oleh kepolisian, dinas sosial, serta warga sekitar depok &amp; luar depok) 2. Taman Anak Sejahtera, (program dari Kementrian Sosial RI untuk wilayah Depok), program ini layaknya Daycare, namun untuk anak dari orang tua berpenghasilan minim yang harus bekerja untuk memenuhi kebutuhan hidupnya (pedagang kaki lima, buruh cuci, buruh pasar, dll), dan setelah bekerja mereka akan menjemput anaknya pulang ke rumah.</div><div><strong><br>Deskripsi Kebutuhan</strong></div><div>beras,susu,pampers</div><div><strong><br>Tag Kebutuhan</strong></div><div>Makanan</div>'
        ]);
    }
}
?>
