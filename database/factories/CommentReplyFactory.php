<?php

namespace Database\Factories;

use App\Models\CommentReply;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentReplyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CommentReply::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'issue_comment_id' => $this->faker->numberBetween(1,50),
            'user_id' => $this->faker->numberBetween(1,11),
            'reply' => $this->faker->paragraph(1),
        ];
    }
}
