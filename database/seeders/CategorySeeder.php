<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            'name' => 'Infrastructure',
            'description' => 'Problems related to infrastructure',
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('categories')->insert([
            'name' => 'Garbage Pollution',
            'description' => 'Problems related to garbage pollution',
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('categories')->insert([
            'name' => 'Air Pollution',
            'description' => 'Problems related to air pollution',
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('categories')->insert([
            'name' => 'Water Pollution',
            'description' => 'Problems related to water pollution',
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
