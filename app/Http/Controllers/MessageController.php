<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function index(Request $request, $roomId){
        return Message::where('conversation_id', $roomId)->with('user')->orderBy('created_at', 'DESC')->get();
    }

    public function store(Request $request, $roomId){
        $newMessage = Message::create([
            'conversation_id' => $roomId,
            'from' => Auth::id(),
            'message' => $request->message
        ]);

        return $newMessage;
    }
}
