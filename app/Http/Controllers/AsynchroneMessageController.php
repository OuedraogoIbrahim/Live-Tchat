<?php

namespace App\Http\Controllers;

use App\Events\TchatEvent;
use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AsynchroneMessageController extends Controller
{
    public function add(Request $request, $user_id)
    {
        $message = new Message();
        $message->message = $request->message;
        $message->user_write = Auth::id();
        $message->user_receive = $user_id;
        $message->save();

        event(new TchatEvent($user_id, $request->message));
        return response()->json(['message' => $request->message]);
    }
}
