<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            RolesAndPermissionsSeeder::class,
            UserSeeder::class,
            CitySeeder::class,
            CategorySeeder::class,
            DistrictSeeder::class,
            IssueSeeder::class,
            IssueCommentSeeder::class,
            LikeSeeder::class,
            CommentReplySeeder::class
        ]);
    }
}
