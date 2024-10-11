<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(){
        $data = request()->validate([
            'name' => ['queried', 'string', 'max:255'],
            'email' => ['queried', 'email', 'max:255', 'unique:usres'],
            'password' => ['queried', 'string', 'min:8', 'confirmed']
        ]);

        $user = User::create($data);

        $token =$user->createToken(env('SANCTUM_NAME'))->plainTextToken;

        return response()->json(['token' => $token]);
    }
    public function login(){

    }
    public function logout(){

    }
}
