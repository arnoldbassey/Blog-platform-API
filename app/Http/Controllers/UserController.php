<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserController extends Controller
{
    public function register(Request $request)
       {
           $validatedData = $request->validate([
               'username' => 'required|unique:users',
               'email' => 'required|email|unique:users',
               'password' => 'required|min:6'
           ]);

           $user = User::create([
               'username' => $validatedData['username'],
               'email' => $validatedData['email'],
               'password' => Hash::make($validatedData['password']),
           ]);

           $token = JWTAuth::fromUser($user);

           return response()->json(compact('user', 'token'), 201);
       }

       public function login(Request $request)
       {
           $credentials = $request->only('email', 'password');

           #Debugging lines
           $user = \App\User::where('email', $request->email)->first();
           if (!$user) {
               return response()->json(['error' => 'User not found'], 404);
           }

           if (!\Illuminate\Support\Facades\Hash::check($request->password, $user->password)) {
               return response()->json(['error' => 'invalid password'], 401);
           }

           if (!$token = JWTAuth::attempt($credentials)) {
               return response()->json(['error' => 'Invalid credentials'], 401);
           }

           #return response()->json(compact('token'));
           return $this->respondWithToken($token);
       }

       protected function respondWithToken($token)
       {
           return response()->json([
               'access_token' => $token,
               'token_type' => 'bearer',
               'expires_in' => Auth::factory()->getTTL() * 60
           ]);
        }

       public function logout()
       {
           JWTAuth::invalidate(JWTAuth::getToken());

           return response()->json(['message' => 'Successfully logged out']);
       }

       public function getUsers()
       {
           $users = User::all();
           return response()->json($users);
       }

       public function getUser($id)
       {
           $user = User::find($id);

           if (!$user) {
               return response()->json(['error' => 'User not found'], 404);
           }

           return response()->json($user);
       }
}
