<?php 

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{

public function run(): void
{
    User::create([
    'name' => 'Admin Kepala Sekolah',
    'email' => 'kepsek@learnflux.test',
    'password' => bcrypt('password'),
    'role' => 'kepala_sekolah',
]);

User::create([
    'name' => 'Guru Utama',
    'email' => 'guru@learnflux.test',
    'password' => bcrypt('password'),
    'role' => 'guru',
]);

User::create([
    'name' => 'Siswa Demo',
    'email' => 'siswa@learnflux.test',
    'password' => bcrypt('password'),
    'role' => 'siswa',
]);

        $this->call(UserSeeder::class);
    }
}

