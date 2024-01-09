<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class Authentication extends Controller
{
    public function register(Request $r){
        //validate the request
        $r->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|confirmed|min:8'
        ]);

        $data = $r->all();
        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);

        return view('home');
    }

    public function login (Request $r){
        //validate the request
        $credentials = $r->validate([
            'email' => 'required|string|email',
            'password' => 'required|string|min:8'
        ]);

        if(Auth::attempt($credentials)){
            $user = $r->user();
            $token = $user->createToken('authToken')->accessToken; //create token

            return redirect()->route('index');
        }
        else {
            return response()->json([
                'message' => 'invalid credentials'
            ], 401);
        }
    }

    public function logout(Request $r){

        auth()->user()->tokens()->delete();
        
        return redirect('/');
    }
}
