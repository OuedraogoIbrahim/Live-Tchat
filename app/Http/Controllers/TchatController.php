<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TchatController extends Controller
{

    public function index(Request $request, User $user)
    {
        $messages_sent = Message::query()->where('user_write', Auth::id())->where('user_receive', $user->id)->get();
        $messages_received = Message::query()->where('user_write', $user->id)->where('user_receive', Auth::id())->get();
        $messages_merged = $messages_received->merge($messages_sent);
        $messages_merged = $messages_merged->sortBy('id');

        $auth = Auth::id();

        return view('messages', ['messages' => $messages_merged, 'user_id' => $user->id, 'auth' => $auth]);
    }
}
