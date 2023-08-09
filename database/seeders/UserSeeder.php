<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Admin
        $admin = User::create([
            'username' => 'admin',
            'name' => 'Admin',
            'email' => 'admin1512@gmail.com',
            'no_hp' => null,
            'alamat' => 'Jl. Wonobaru Gg. Melda No. 6',
            'password' => Hash::make('123123123'),
            'status' => 'Active',
        ]);
        $admin->assignRole('admin');

        // Panti
        $admin = User::create([
            'username' => 'panti_hidayatullah',
            'name' => 'Panti Asuhan Hidayatullah',
            'email' => 'panti.hidayatullah@gmail.com',
            'no_hp' => null,
            'alamat' => 'Jl. Tabrani Ahmad',
            'password' => Hash::make('123123123'),
            'status' => 'Active',
        ]);
        $admin->assignRole('panti');

    }
}
?>
