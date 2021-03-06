<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ConversationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Gabriel',
            'email' => 'itsggabo@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('Luna5555'),
            'remember_token' => Str::random(10),
        ]);
    }
}
