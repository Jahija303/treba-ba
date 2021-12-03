<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('images')->insert([
            'issue_id' => '1',
            'name' => '1.jpeg',
        ]);

        DB::table('images')->insert([
            'issue_id' => '2',
            'name' => '2.jpg',
        ]);

        DB::table('images')->insert([
            'issue_id' => '3',
            'name' => '3.jpg',
        ]);

        DB::table('images')->insert([
            'issue_id' => '4',
            'name' => '4.jpeg',
        ]);

        DB::table('images')->insert([
            'issue_id' => '5',
            'name' => '1.jpeg',
        ]);

        DB::table('images')->insert([
            'issue_id' => '6',
            'name' => '2.jpg',
        ]);

        DB::table('images')->insert([
            'issue_id' => '7',
            'name' => '3.jpg',
        ]);

        DB::table('images')->insert([
            'issue_id' => '8',
            'name' => '4.jpeg',
        ]);
    }
}
