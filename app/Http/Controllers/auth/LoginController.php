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
        // Validate incoming request data
        $request->validate([
            'email' => 'required|email',
            'fingerprint' => 'required|string', // Assuming fingerprint is sent as a string
        ]);

        // Retrieve user by email
        $user = User::where('email', $request->input('email'))->first();

        // Check if user exists
        if (!$user) {
            return redirect()->back()->withErrors(['email' => 'User not found.']);
        }

        // Decrypt stored fingerprint for comparison
        $storedFingerprint = $user->fingerprint;

        // Compare provided fingerprint with stored fingerprint
        if (!$storedFingerprint || !$this->verifyFingerprint($request->input('fingerprint'), $storedFingerprint)) {
            return redirect()->back()->withErrors(['fingerprint' => 'Fingerprint authentication failed.']);
        }

        // Fingerprint authentication successful, log in user
        auth()->login($user);
        return redirect()->intended('/home');
    }

    protected function verifyFingerprint($providedFingerprint, $storedFingerprint)
    {
        // Decrypt stored fingerprint
        $decryptedStoredFingerprint = Crypt::decryptString($storedFingerprint);

        // Compare provided fingerprint with decrypted stored fingerprint
        return $providedFingerprint === $decryptedStoredFingerprint;
    }
    public function showLoginForm()
    {
        return view('auth.login');
    }

}
