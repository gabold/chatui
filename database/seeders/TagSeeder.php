<?php

namespace Database\Seeders;

use App\Models\Conversation;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tag = 0;
        $rooms = Conversation::all();
        foreach($rooms as $room){             
            for($i=0; $i<mt_rand(1,3); $i++){
                $tag = Tag::all()->random();
                $tag->conversations()->attach($room);
            }
        }
    }
}
