<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Admin;

class UserAndAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Seeder untuk User
        User::create([
            'name' => 'John Doe',
            'email' => 'user@example.com',
            'no_wa' => '089505737115',
            'password' => Hash::make('password'), // Password: password
        ]);

        // Seeder untuk Admin
        Admin::create([
            'name' => 'Admin Master',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'), // Password: password
        ]);

        // Seeder untuk School
        \App\Models\School::create([
            'id_school' => 1,
            'name' => 'MTS TAHFIZH ALAM Furqon', // Kita isikan MTS TAHFIZH ALAM Furqon sesuai instruksi
            'address' => 'Silakan Edit Alamat',
            'phone' => 'Silakan Edit Telepon',
            'email' => 'admin@example.com',
            'principal_name' => 'Silakan Edit Kepala Sekolah'
        ]);
    }
}
