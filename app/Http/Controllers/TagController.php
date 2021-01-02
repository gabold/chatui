<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index (){
        return Tag::all();
    }

    public function show($roomId){
        $room = Conversation::find($roomId);
        return $room->tags;
    }
}
