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
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
            'priority' => 1,
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('issues')->insert([
            'user_id' => 2,
            'city_id' => 2,
            'category_id' => 3,
            'district_id' => 2,
            'latitude' => '40.7128',
            'longitude' => '74.0060',
            'title' => 'Zagađenje zraka',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
            'priority' => 2,
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('issues')->insert([
            'user_id' => 1,
            'city_id' => 3,
            'category_id' => 2,
            'district_id' => 3,
            'latitude' => '40.7128',
            'longitude' => '74.0060',
            'title' => 'Smece pored puta',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
            'priority' => 1,
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('issues')->insert([
            'user_id' => 3,
            'city_id' => 3,
            'category_id' => 1,
            'district_id' => 1,
            'latitude' => '40.7128',
            'longitude' => '74.0060',
            'title' => 'Rupe na ulici',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
            'priority' => 3,
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('issues')->insert([
            'user_id' => 4,
            'city_id' => 4,
            'category_id' => 1,
            'district_id' => 1,
            'latitude' => '40.7128',
            'longitude' => '74.0060',
            'title' => 'Vandaliziran objekat',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
            'priority' => 3,
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('issues')->insert([
            'user_id' => 6,
            'city_id' => 1,
            'category_id' => 4,
            'district_id' => 2,
            'latitude' => '40.7128',
            'longitude' => '74.0060',
            'title' => 'Zagađenje vode',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
            'priority' => 2,
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('issues')->insert([
            'user_id' => 1,
            'city_id' => 1,
            'category_id' => 1,
            'district_id' => 3,
            'latitude' => '40.7128',
            'longitude' => '74.0060',
            'title' => 'Ne radi semafor',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
            'priority' => 1,
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('issues')->insert([
            'user_id' => 6,
            'city_id' => 1,
            'category_id' => 3,
            'district_id' => 3,
            'latitude' => '40.7128',
            'longitude' => '74.0060',
            'title' => 'Smrad pored ulice',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
            'priority' => 1,
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
