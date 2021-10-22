<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cities')->insert([
            'name' => 'Zenica',
            'description' => 'Grad Celika',
            'status' => '1',
            'population' => 73751,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('cities')->insert([
            'name' => 'Sarajevo',
            'description' => 'Glavni Grad',
            'status' => '1',
            'population' => 291422,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('cities')->insert([
            'name' => 'Jajce',
            'description' => 'Kraljevski Grad',
            'status' => '1',
            'population' => 30758,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('cities')->insert([
            'name' => 'Mostar',
            'description' => 'Hercegovacko blago',
            'status' => '1',
            'population' => 65286,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
