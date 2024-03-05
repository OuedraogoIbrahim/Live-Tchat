<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class dashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $user = Auth::user();

        $messages  = Message::query()->where('user_write', Auth::id())->orWhere('user_receive', Auth::id())->get();

        if ($messages->isEmpty()) {
            $no_message = 'Vous n\'avez pas de messages';
            return view('dashboard', ['user' => $user, 'no_message' => $no_message]);
        } else {
            $users_received_message = [];
            $i = 0; // Permet de savoir que l'on vient de commencer le parcours messages
            foreach ($messages as $m) {
                if ($i == 0) {
                    $users_received_message[0] = $m->user_receive == Auth::id() ? $m->user_write : $m->user_receive;
                    $i++;
                } else {
                    if (Auth::id() == $m->user_write) {
                        if (!in_array($m->user_receive, $users_received_message)) {
                            $users_received_message[$i] = $m->user_receive;
                            $i++;
                        }
                    } else {
                        if (!in_array($m->user_write, $users_received_message)) {
                            $users_received_message[$i] = $m->user_write;
                            $i++;
                        }
                    }
                }
            }
            for ($j = 0; $j < count($users_received_message); $j++) {
                $users_received_message[$j] = User::query()->find($users_received_message[$j], ['id', 'name']);
            }
            return view('dashboard', ['user' => $user, 'messages_received_by' => $users_received_message]);
        }
    }
}
