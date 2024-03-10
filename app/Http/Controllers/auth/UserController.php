<?php

// namespace App\Http\Controllers\Auth;
// use Illuminate\Support\Facades\Log;
// use App\Http\Controllers\Controller;
// use Illuminate\Http\Request;
// use App\Models\User;
// use Illuminate\Support\Facades\Hash;

// class UserController extends Controller
// {
//     public function showRegistrationForm()
//     {
//         return view('auth.register'); // Adjust the view path as necessary
//     }
    
//     public function register(Request $request)
//     {
//         Log::info('Register method was called');
//         // Validate user input
//         $request->validate([
//             'name' => 'required|string|max:255',
//             'email' => 'required|string|email|max:255|unique:users',
//             'password' => 'required|string|min:8',
//             'fingerprint_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust image validation rules as needed
//         ]);

//         // Store user's basic details in the database
//         $user = new User();
//         $user->name = $request->name;
//         $user->email = $request->email;
//         $user->password = Hash::make($request->password);

//         // Handle fingerprint data storage - You'll need to adjust this based on how you store fingerprints
//         $user->fingerprint = $request->file('fingerprint_image')->store('fingerprint_images'); // Store fingerprint image in storage/app/public/fingerprint_images
        
//         $user->save();

//         // Redirect user to login page or any other page after successful registration
//         return redirect()->route('login')->with('success', 'Registration successful. Please login.');
//     }

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register'); // Adjust the view path as necessary
    }
    
    public function register(Request $request)
    {
        Log::info('Register method was called');
        // Validate user input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'fingerprint_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust image validation rules as needed
        ]);

        // Store user's basic details in the database
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        // Handle fingerprint data storage
        // Assuming you're storing the path to the fingerprint image
        $fingerprintPath = $request->file('fingerprint_image')->store('fingerprint_images', 'public');
        $user->fingerprint = $fingerprintPath;
        
        $user->save();

        // Redirect user to login page or any other page after successful registration
        return redirect()->route('login')->with('success', 'Registration successful. Please login.');
    }

}
