<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register(Request $request)
    {
        // Validate user input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'fingerprint' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust image validation rules as needed
        ]);

        // Store user's basic details in the database
        $user->fingerprint = $request->fingerprint;

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        // Handle fingerprint data storage - You'll need to adjust this based on how you store fingerprints
        $user->fingerprint = $request->file('fingerprint')->store('fingerprint_images'); // Store fingerprint image in storage/app/public/fingerprint_images
        $user->save();

        // Redirect user to login page or any other page after successful registration
        return redirect()->route('login')->with('success', 'Registration successful. Please login.');
    }
}
