<?php

namespace Database\Factories;

use App\Models\Conversation;
use App\Models\Message;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class MessageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Message::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $conversation = Conversation::find(1)->first(); 
        return [
            'conversation_id' => $conversation->id,
            'user_id' => User::all()->random()->id,
            'message' => $this->faker->sentence
        ];
    }
}
