<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    //reverse many conversation to many tags
    public function conversations(){
        return $this->belongsToMany(Conversation::class);
    }
}
