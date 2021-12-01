<?php

namespace Database\Factories;

use App\Models\IssueComment;
use Illuminate\Database\Eloquent\Factories\Factory;

class IssueCommentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = IssueComment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'issue_id' => $this->faker->numberBetween(1,8),
            'user_id' => $this->faker->numberBetween(1,11),
            'comment' => $this->faker->paragraph(2),
        ];
    }
}
