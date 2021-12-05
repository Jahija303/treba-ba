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
            'name' => 'Infrastruktura',
            'description' => 'Problems related to infrastructure',
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('categories')->insert([
            'name' => 'Smeće',
            'description' => 'Problems related to garbage pollution',
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('categories')->insert([
            'name' => 'Zagađenje Zraka',
            'description' => 'Problems related to air pollution',
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('categories')->insert([
            'name' => 'Zagađenje Vode',
            'description' => 'Problems related to water pollution',
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
