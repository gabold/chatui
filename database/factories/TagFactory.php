<?php

namespace Database\Factories;

use App\Models\Conversation;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\Factory;

class TagFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Tag::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $conversation = Conversation::find(1);
        return [
            'name' => $this->faker->sentence(1)
        ];
    }
}
