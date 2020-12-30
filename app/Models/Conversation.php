<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    use HasFactory;

    //Many conversations to Many users
    public function users(){
        return $this->belongsToMany(User::class);
    }

    //One conversation to Many messages
    public function messages(){
        return $this->hasMany(Message::class);
    }

    //Many conversation to many tags
    public function tags(){
        return $this->belongsToMany(User::class);
    }
}
