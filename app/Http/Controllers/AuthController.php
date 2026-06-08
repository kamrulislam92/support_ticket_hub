<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // 1. user খুঁজে বের করা
        $user = User::where('email', $request->email)->first();

        // 2. user আছে কিনা check
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not found'
            ], 404);
        }

        // 3. password check
        if (!Hash::check($request->password, $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid password'
            ], 401);
        }

        // 4. success response
        return response()->json([
            'success' => true,
            'message' => 'Login Successful',
            'role' => $user->role,
            'user' => $user
        ]);
    }

    // public function logout(Request $request)
    // {
    //     Auth::logout();

    //     $request->session()->invalidate();
    //     $request->session()->regenerateToken();

    //     return response()->json([
    //         'success' => true,
    //         'message' => 'Logout successful'
    //     ]);
    // }
    public function logout(Request $request)
{
    Auth::logout();

    return response()->json([
        'success' => true,
        'message' => 'Logout successful'
    ]);
}
}