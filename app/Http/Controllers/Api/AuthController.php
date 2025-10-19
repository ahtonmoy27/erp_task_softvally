<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\Api\ApiResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    use ApiResponseTrait;
     // Register new user
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = $user->createToken('erpToken')->plainTextToken;

        $code = 201;

        return $this->sendResponse($code, 'User registered successfully', $user, [], [
            'token' => $token
        ]);
    }

    // Login user and return token
    public function login(Request $request)
    {
        try{
           
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $token = $user->createToken('erpToken')->plainTextToken;

        $code = 200;

        return $this->sendResponse($code, 'User logged in successfully', $user, [], [
            'token' => $token
        ]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Server Error'. $e->getMessage()], 500);
        }

        
    }

    // Logout user (revoke current token)
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        $code = 200;

        return $this->sendResponse($code, 'User logged out successfully');
    }
}
