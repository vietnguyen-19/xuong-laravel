<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(){
        $data = request()->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed']
        ]);

        $user = User::create($data);

        $token =$user->createToken(env('SANCTUM_NAME'))->plainTextToken;

        return response()->json(['token' => $token]);
    }
    public function login(){

        $data = request()->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = User::query()->firstWhere('email', $data['email']);

        if(!$user){
            return response()->json([
                'message' => 'email không tồn tại người dùng'
            ],404);
        }

        if(Hash::check($data['password'], $user->password)){
            return response()->json([
                'message' => 'mật khẩu sai'
            ],400);
        }

        $token =$user->createToken(env('SANCTUM_NAME'))->plainTextToken;

        return response()->json(['token' => $token]);
        // Auth::login($user);

    }
    public function logout(){
        $user = request()->user();

        $user->currentAccessToken()->delete();

        return response()->json([] , 204);
    }
}
