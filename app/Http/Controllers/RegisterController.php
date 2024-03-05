<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function __construct()
    {
        // $this->middleware('guest');
    }
    public function register_form()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $valid = $request->validate([
            'name' => ['required', 'between:4,10'],
            'email' => ['email', 'required'],
            'password' => ['required', 'between:6,12']
        ]);

        $user = new User();
        $user->name = $valid['name'];
        $user->email = $valid['email'];
        $user->password = $valid['password'];
        $user->save();

        Auth::login($user);
        return 'Inscription reussi';
    }
}
