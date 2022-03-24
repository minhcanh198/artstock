<?php

namespace App\Http\Controllers;

use App\Services\Chat;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Channel;
use Session;

class ChatController extends Controller
{
    private Chat $chatService;

    public function __construct(Chat $chat)
    {
        $this->chatService = $chat;
    }

    public function getChats()
    {
        $userId = Auth::id();
        $chats = $this->chatService->getChats($userId);
        return response()->json($chats);
    }

    public function getMessages(int $chatId)
    {
        $messages = $this->chatService->getMessages($chatId);
        return response()->json($messages);
    }

    public function sendMessage(Request $request)
    {

    }
}
