<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class RegisteredUserController extends Controller
{
    public function create(){
        return view('auth.register');
    }

    public function store(Request $request){

        $attributes = $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'confirmed', Password::min(6)]
        ]);

        $role = Role::where('name', 'customer')->first();

        $user = User::create($attributes);
        $user->roles()->attach($role);

        Auth::login($user);

        return redirect('/');

    }
}
