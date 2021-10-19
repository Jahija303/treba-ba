<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'admin',
            'email' => 'admin@treba.ba',
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
        ])->assignRole('super-admin');

        User::factory(10)->create()->each(function ($user) {
            $user->assignRole('user');
        });
    }
}
