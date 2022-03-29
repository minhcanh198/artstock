<?php

namespace App\Http\Controllers;

use App\Services\Chat;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Channel;
use Illuminate\Support\Facades\Hash;
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
        // $chats = [];
        return response()->json($chats);
    }

    public function getChat($chatId)
    {
        return response()->json($this->chatService->getChat($chatId));
    }

    public function getMessages(int $chatId)
    {
        $messages = $this->chatService->getMessages($chatId);
        return response()->json($messages);
    }

    public function sendMessage(Request $request, int $chatId): \Illuminate\Http\JsonResponse
    {
        $sender_id = Auth::id();
        $message = $this->chatService->sendMessage($sender_id, $request->get("to"), [
            "chat_id" => $chatId,
            "message" => $request->get("message")
        ]);
        return $message ? response()->json($message) : response()->json(['message' => "failed"]);
    }

    public function startChat(Request $request)
    {
        $sender_id = Auth::id();
        $newChatId = $this->chatService->startChat($sender_id, $request->get("to"));

        return response()->json($newChatId);
    }
}
