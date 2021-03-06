<?php

namespace App\Http\Controllers;

use App\Events\NewChatMessage;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function index(Request $request, $roomId){
        return Message::where('conversation_id', $roomId)->with('user')->orderBy('created_at', 'DESC')->get();
    }

    public function store(Request $request, $roomId){
        // $newMessage = Message::create([
        //     'conversation_id' => $roomId,
        //     'user_id' => Auth::id(),
        //     'message' => $request->message
        // ]);
        $newMessage = new Message;
        $newMessage->conversation_id = $roomId;
        $newMessage->user_id = Auth::id();
        $newMessage->message = $request->message;
        $newMessage->save();
        
        broadcast(new NewChatMessage($newMessage))->toOthers();
        return $newMessage;
    }
}
