<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\FotoPanti;

class FotoPantiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        FotoPanti::create([
            'id_panti' => 1,
            'foto' => '1.jpeg',
        ]);
        FotoPanti::create([
            'id_panti' => 1,
            'foto' => '2.jpeg',
        ]);
        FotoPanti::create([
            'id_panti' => 1,
            'foto' => '3.jpeg',
        ]);
        FotoPanti::create([
            'id_panti' => 1,
            'foto' => '4.jpeg',
        ]);
    }
}
?>
