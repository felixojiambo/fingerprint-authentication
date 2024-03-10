<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class LoginController extends Controller
{
    public function fingerprintLogin(Request $request)
    {
       
        $request->validate([
            'email' => 'required|email',
            'fingerprint' => 'required|string', 
        ]);

    
        $user = User::where('email', $request->input('email'))->first();

        
        if (!$user) {
            return redirect()->back()->withErrors(['email' => 'User not found.']);
        }

      
        $storedFingerprint = $user->fingerprint;

       
        if (!$storedFingerprint || !$this->verifyFingerprint($request->input('fingerprint'), $storedFingerprint)) {
            return redirect()->back()->withErrors(['fingerprint' => 'Fingerprint authentication failed.']);
        }

      
        auth()->login($user);
        return redirect()->intended('/home');
    }

    protected function verifyFingerprint($providedFingerprint, $storedFingerprint)
    {
    
        $decryptedStoredFingerprint = Crypt::decryptString($storedFingerprint);

      
        return $providedFingerprint === $decryptedStoredFingerprint;
    }
    public function showLoginForm()
    {
        return view('auth.login');
    }

}




// use Illuminate\Support\Facades\Auth;
// use Laravel\Sanctum\PersonalAccessToken;

// public function login(Request $request)
// {
//     $fingerprintData = $request->input('fingerprint');
//     $hashedFingerprint = Hash::make($fingerprintData); // Hash the provided fingerprint data

//     // Retrieve the user by email or another identifier
//     $user = User::where('email', $request->input('email'))->first();

//     if ($user && Hash::check($fingerprintData, $user->fingerprint)) {
//         // The fingerprint matches, authenticate the user
//         // Authenticate the user and issue a token
//         $token = $user->createToken('authToken')->plainTextToken;

//         return response()->json(['message' => 'User authenticated successfully', 'token' => $token]);
//     } else {
//         // The fingerprint does not match or the user does not exist
//         return response()->json(['error' => 'Invalid credentials'], 401);
//     }
// }
