<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class SessionController extends Controller
{
    public function create(){
        return view('auth.login');
    }

    public function store(){
        //validation
        $attributes = request()->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);
        //sign in user
        if (!Auth::attempt($attributes)){
            throw ValidationException::withMessages([
                'email' => 'These credentials do not match!'
            ]);
        }

        request()->session()->regenerate();

        return redirect('/');

    }

    public function destroy(){
        Auth::logout();

        return redirect('/');
    }
}
