<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'nama' => 'Administrator',
            'username' => 'admin',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'status' => true,
        ]);

        User::create([
            'nama' => 'Guru Demo',
            'username' => 'guru01',
            'password' => Hash::make('guru123'),
            'role' => 'guru',
            'status' => true,
        ]);

        User::create([
            'nama' => 'Staff Demo',
            'username' => 'staff01',
            'password' => Hash::make('staff123'),
            'role' => 'staff',
            'status' => true,
        ]);

        User::create([
            'nama' => 'Siswa Demo',
            'username' => 'siswa01',
            'password' => Hash::make('siswa123'),
            'role' => 'siswa',
            'status' => true,
        ]);
    }
}
