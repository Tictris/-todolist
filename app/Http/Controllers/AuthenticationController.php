<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthenticationController extends Controller
{
    //REGISTER
    public function register(Request $r){
        //validate the request
        $r->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|confirmed|min:8'
        ]);

        //make variable to hold request data
        $data = $r->all();
        //hash the password using Hash class
        $data['password'] = Hash::make($data['password']);
        //create a new user instance and save it in db
        $user = User::create($data);
        //return to home page
        return redirect()->route('/');

    }
    //LOGIN
    public function login(Request $r){
        //validate the request
        $credentials = $r->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if(Auth::attempt($credentials)){

            session()->put('name', $credentials->name);

            return redirect()->route('index');
        } else {
            return response()->json([
                'message' => 'Invalid credentials'
            ], 401);
        }
    }

    //LOGOUT
    public function logout(Request $r){

            //logout authenticated user
            Auth::logout();

            return redirect()->route('/');

    }
}
