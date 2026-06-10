<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class AuthController extends Controller
{
  
// public function register(Request $request)
// {
//     // ১. ইনপুট ভ্যালিডেশন
//     $validator = Validator::make($request->all(), [
//         'name' => 'required|string|max:255',
//         'email' => 'required|string|email|max:255|unique:users',
//         'password' => 'required|string|min:6|confirmed', // password_confirmation এর সাথে মিলতে হবে
//     ]);

//     if ($validator->fails()) {
//         return response()->json([
//             'success' => false,
//             'message' => 'Validation Error',
//             'errors' => $validator->errors()
//         ], 422);
//     }

//     // ২. নতুন ইউজার তৈরি (ডাটাবেজ ইনসার্ট)
//     // ডিফল্ট রোল 'user' দেওয়া হলো, আপনার সিস্টেমে অন্য লজিক থাকলে পরিবর্তন করতে পারেন
//     $user = User::create([
//         'name' => $request->name,
//         'email' => $request->email,
//         'password' => Hash::make($request->password),
//         'role' => 'user' 
//     ]);

//     // ৩. Sanctum Token তৈরি (রেজিস্ট্রেশনের পর সরাসরি লগইন করানোর জন্য)
//     $token = $user->createToken('auth_token')->plainTextToken;

//     // ৪. রেসপন্স পাঠানো
//     return response()->json([
//         'success' => true,
//         'message' => 'Registration successful!',
//         'token' => $token,
//         'user' => $user
//     ], 201);
// }

public function register(Request $request)
{
    // ১. ইনপুট ভ্যালিডেশন (নতুন ফিল্ডসহ)
    $validator = Validator::make($request->all(), [
        'name'          => 'required|string|max:255',
        'email'         => 'required|string|email|max:255|unique:users',
        'phone'         => 'required|string|max:20',
        'password'      => 'required|string|min:6|confirmed',
        'date_of_birth' => 'required|date',
        'gender'        => 'required|in:male,female,other',
        'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // সর্বোচ্চ ২ মেগাবাইট
    ]);

    if ($validator->fails()) {
        return response()->json([
            'success' => false,
            'message' => 'Validation Error',
            'errors'  => $validator->errors()
        ], 422);
    }

    try {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password = Hash::make($request->password);
        $user->date_of_birth = $request->date_of_birth;
        $user->gender = $request->gender;
        $user->role = 'user';

        // ২. প্রোফাইল ইমেজ আপলোড হ্যান্ডলিং
        if ($request->hasFile('profile_image')) {
            $image = $request->file('profile_image');
            // ইমেজের একটি ইউনিক নাম তৈরি করা (যেমন: 17182930.jpg)
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            // public/uploads/profiles ফোল্ডারে ইমেজটি সেভ হবে
            $image->move(public_path('uploads/profiles'), $imageName);
            
            // ডাটাবেজে পাাথটি সেভ করা
            $user->profile_image = 'uploads/profiles/' . $imageName;
        }

        $user->save();

        // ৩. টোকেন জেনারেট করা
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Registration successful!',
            'token'   => $token,
            'user'    => $user
        ], 201);

    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Server Error: ' . $e->getMessage()
        ], 500);
    }
}
// public function register(Request $request)
// {
//     // ১. ইনপুট ভ্যালিডেশন
//     $validator = Validator::make($request->all(), [
//         'name'     => 'required|string|max:255',
//         'email'    => 'required|string|email|max:255|unique:users',
//         'password' => 'required|string|min:6|confirmed', 
//     ]);

//     if ($validator->fails()) {
//         return response()->json([
//             'success' => false,
//             'message' => 'Validation Error',
//             'errors'  => $validator->errors()
//         ], 422);
//     }

//     try {
//         // ২. নতুন ইউজার তৈরি (Eloquent DB Instance)
//         $user = new User();
//         $user->name = $request->name;
//         $user->email = $request->email;
//         $user->password = Hash::make($request->password); // পাসওয়ার্ড ম্যানুয়ালি হ্যাশ করা হলো
//         $user->role = 'user'; // আপনার রিকোয়ারমেন্ট অনুযায়ী ডিফল্ট রোল
//         $user->save(); // ডাটাবেজে সেভ করা হলো

//         // ৩. Sanctum Token তৈরি
//         $token = $user->createToken('auth_token')->plainTextToken;

//         // ৪. সাকসেস রেসপন্স পাঠানো
//         return response()->json([
//             'success' => true,
//             'message' => 'Registration successful!',
//             'token'   => $token,
//             'user'    => $user
//         ], 201);

//     } catch (\Exception $e) {
//         // যদি ডাটাবেজ বা সার্ভারে কোনো ইন্টারনাল এরর ঘটে, তবে আসল এররটি রেসপন্সে দেখা যাবে
//         return response()->json([
//             'success' => false,
//             'message' => 'Server Error: ' . $e->getMessage()
//         ], 500);
//     }
// }

public function login(Request $request)
{
    // ১. ইনপুট ভ্যালিডেশন
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    // ২. ইউজার ক্রেডেনশিয়াল চেক করা
    if (!Auth::attempt($request->only('email', 'password'))) {
        return response()->json([
            'success' => false,
            'message' => 'Invalid login details'
        ], 401);
    }

    // ৩. ডাটাবেজ থেকে ইউজারকে নেওয়া এবং নতুন Sanctum Token তৈরি করা
    $user = User::where('email', $request->email)->firstOrFail();
    $token = $user->createToken('auth_token')->plainTextToken;

    // ৪. টোকেনটি ফ্রন্টএন্ডে পাঠানো
    return response()->json([
        'success' => true,
        'message' => 'Login successful',
        'token' => $token, // এই টোকেনটিই আপনার দরকার
        'user' => $user
    ], 200);
}

    public function logout(Request $request)
    {
        // বর্তমান লগইন থাকা ইউজারের সচল টোকেনটি ডাটাবেজ থেকে মুছে দেওয়া
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'success' => true,
            'message' => 'Logout successful'
        ], 200);
    }
}