<?php

namespace Database\Seeders;

use App\Models\CommentReply;
use Illuminate\Database\Seeder;

class CommentReplySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        COmmentReply::factory(30)->create();
    }
}
