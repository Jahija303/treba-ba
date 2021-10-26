<?php

namespace Database\Seeders;

use App\Models\IssueComment;
use Database\Factories\IssueCommentFactory;
use Illuminate\Database\Seeder;

class IssueCommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        IssueComment::factory(30)->create()->unique;
    }
}
