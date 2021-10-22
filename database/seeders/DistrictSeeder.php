<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('districts')->insert([
            'name' => 'Crkvice',
            'description' => 'A borough of Zenica',
            'status' => 1,
            'city_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('districts')->insert([
            'name' => 'Blatusa',
            'description' => 'A borough of Zenica',
            'status' => 1,
            'city_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('districts')->insert([
            'name' => 'Travnicka',
            'description' => 'A borough of Zenica',
            'status' => 1,
            'city_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('districts')->insert([
            'name' => 'Bilimisce',
            'description' => 'A borough of Zenica',
            'status' => 1,
            'city_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('districts')->insert([
            'name' => 'Stara Carsija',
            'description' => 'A borough of Zenica',
            'status' => 1,
            'city_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('districts')->insert([
            'name' => 'Mokusnice',
            'description' => 'A borough of Zenica',
            'status' => 1,
            'city_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('districts')->insert([
            'name' => 'Carina',
            'description' => 'A borough of Zenica',
            'status' => 1,
            'city_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('districts')->insert([
            'name' => 'Nova Zenica',
            'description' => 'A borough of Zenica',
            'status' => 1,
            'city_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('districts')->insert([
            'name' => 'Novi Grad',
            'description' => 'A borough of Sarajevo',
            'status' => 1,
            'city_id' => 2,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('districts')->insert([
            'name' => 'Novo Sarajevo',
            'description' => 'A borough of Sarajevo',
            'status' => 1,
            'city_id' => 2,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('districts')->insert([
            'name' => 'Ilidza',
            'description' => 'A borough of Sarajevo',
            'status' => 1,
            'city_id' => 2,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('districts')->insert([
            'name' => 'Bascarsija',
            'description' => 'A borough of Sarajevo',
            'status' => 1,
            'city_id' => 2,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
