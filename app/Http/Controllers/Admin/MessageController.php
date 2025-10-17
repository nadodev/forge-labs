<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;

class MessageController extends Controller
{
    public function index()
    {
        $messages = Message::orderBy('created_at', 'desc')->paginate(20);
        return view('admin.messages.index', compact('messages'));
    }

    public function markRead(Message $message)
    {
        $message->markAsRead();
        return back()->with('success', 'Mensagem marcada como lida.');
    }

    public function destroy(Message $message)
    {
        $message->delete();
        return back()->with('success', 'Mensagem removida.');
    }
}


