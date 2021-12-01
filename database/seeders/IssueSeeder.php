<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IssueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('issues')->insert([
            'user_id' => 1,
            'city_id' => 1,
            'category_id' => 1,
            'district_id' => 1,
            'latitude' => '40.7128',
            'longitude' => '74.0060',
            'title' => 'Srusena Bandera',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua',
            'priority' => 1,
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('issues')->insert([
            'user_id' => 1,
            'city_id' => 1,
            'category_id' => 3,
            'district_id' => 2,
            'latitude' => '40.7128',
            'longitude' => '74.0060',
            'title' => 'Zagađenje zraka',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua',
            'priority' => 2,
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('issues')->insert([
            'user_id' => 1,
            'city_id' => 1,
            'category_id' => 2,
            'district_id' => 3,
            'latitude' => '40.7128',
            'longitude' => '74.0060',
            'title' => 'Smece pored puta',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua',
            'priority' => 1,
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('issues')->insert([
            'user_id' => 1,
            'city_id' => 1,
            'category_id' => 1,
            'district_id' => 1,
            'latitude' => '40.7128',
            'longitude' => '74.0060',
            'title' => 'Godzilla is attacking',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua',
            'priority' => 3,
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('issues')->insert([
            'user_id' => 1,
            'city_id' => 1,
            'category_id' => 1,
            'district_id' => 1,
            'latitude' => '40.7128',
            'longitude' => '74.0060',
            'title' => 'Apocalypse Now',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua',
            'priority' => 3,
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('issues')->insert([
            'user_id' => 1,
            'city_id' => 1,
            'category_id' => 3,
            'district_id' => 2,
            'latitude' => '40.7128',
            'longitude' => '74.0060',
            'title' => 'Sudar na M17',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua',
            'priority' => 2,
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('issues')->insert([
            'user_id' => 1,
            'city_id' => 1,
            'category_id' => 2,
            'district_id' => 3,
            'latitude' => '40.7128',
            'longitude' => '74.0060',
            'title' => 'Rupa na putu',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua',
            'priority' => 1,
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('issues')->insert([
            'user_id' => 1,
            'city_id' => 1,
            'category_id' => 2,
            'district_id' => 3,
            'latitude' => '40.7128',
            'longitude' => '74.0060',
            'title' => 'Smrad iz ulice',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua',
            'priority' => 1,
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
