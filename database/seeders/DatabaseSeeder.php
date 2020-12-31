<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        
        
        //seedeing faking information
        \App\Models\User::factory(10)->create();
        
        //creating user in conversationseeder
        $this->call([UserSeeder::class]);

        //seeding faking information
        \App\Models\Conversation::factory(10)->create();
        \App\Models\Tag::factory(10)->create();
        \App\Models\Message::factory(50)->create();

        //attaching faking tags to conversations
        $this->call([TagSeeder::class]);
    }
}
