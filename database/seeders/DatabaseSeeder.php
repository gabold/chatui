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
        $this->call([ConversationSeeder::class]);

        //seedeing faking information
        \App\Models\Conversation::factory(10)->create();
        \App\Models\Tag::factory(10)->create();
        \App\Models\Message::factory(20)->create();
    }
}
