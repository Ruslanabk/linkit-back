<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    public function authenticate(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'device_name' => 'required'
        ]);
     
        $user = User::where('email', $request->email)->first();
     
        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }
     
        $token = $user->createToken($request->device_name)->plainTextToken;
        $user = [
            'id' => $user->id,
            'username' => $user->username,
            'email' => $user->email
        ];

        return response()->json(['status' => 'success', 'result' => [
            'token' => $token,
            'user' => $user
        ]]);
    }

    public function register(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'username' => 'required',
            'password' => 'required'
        ]);
        $user = User::where('email', $request->input('email'))->orWhere('username', $request->input('username'))->first();
        if(!empty($user))
            return response()->json(['status' => 'fail', 'message' => 'The email or username exists'], 409);
        
        if(User::Create([
            'email' => $request->email,
            'username' => $request->username,
            'password' => Hash::make($request->password)
        ]))
            return response()->json(['status' => 'success']);
        return response()->json(['status' => 'fail'], 401);
    }
}
