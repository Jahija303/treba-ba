<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'firstname' => 'Jahija',
            'lastname' => 'Okan',
            'email' => 'admin@treba.ba',
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
            'username' => 'admin',
            'city_id' => 1,
            'status' => 1,
        ])->assignRole('super-admin');

        User::create([
            'firstname' => 'Local',
            'lastname' => 'Admin',
            'email' => 'localadmin@treba.ba',
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
            'username' => 'localadmin',
            'city_id' => 1,
            'status' => 1,
        ])->assignRole('local-admin');

        User::create([
            'firstname' => 'test',
            'lastname' => 'user',
            'email' => 'user@treba.ba',
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
            'username' => 'user',
            'city_id' => 1,
            'status' => 1,
        ])->assignRole('user');

        User::factory(10)->create()->each(function ($user) {
            $user->assignRole('user');
        });
    }
}
