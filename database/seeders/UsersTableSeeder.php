<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{


    public function run()
    {
        DB::table('users')->insert([
            'first_name' => 'Super',
            'last_name' => 'Admin',
            'email' => 'essononguema16@gmail.com',
            'password' => Hash::make('password123'),
            'role' => 'admin', // ✅ Champ ajouté pour identifier le type d’utilisateur
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('users')->insert([
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'pascaljunior16@outlook.fr',
            'password' => Hash::make('password456'),
            'role' => 'director', // ✅ Champ ajouté pour identifier le type d’utilisateur
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('users')->insert([
            'first_name' => 'Jane',
            'last_name' => 'Smith',
            'email' => 'janesmith@gmail.com',
            'password' => Hash::make('password789'),
            'role' => 'developer', // ✅ Champ ajouté pour identifier le type d’utilisateur
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('users')->insert([
            'first_name' => 'Alice',
            'last_name' => 'Johnson',
            'email' => 'alicejohn@gmail.com',
            'password' => Hash::make('password101'),
            'role' => 'security', // ✅ Champ ajouté pour identifier le type d’utilisateur
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

}
