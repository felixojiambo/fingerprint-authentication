<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Client;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $this->validateLogin($request);

       
        if ($request->auth_method == 'email_password') {
            if ($this->attemptLogin($request)) {
                return $this->sendLoginResponse($request);
            }
        }
        
        if ($request->auth_method == 'fingerprint') {
            if ($this->authenticateWithFingerprint($request)) {
                return $this->sendLoginResponse($request);
            }
        }

        return $this->sendFailedLoginResponse($request);
    }

    protected function attemptLogin(Request $request)
    {
        return $this->guard()->attempt(
            $this->credentials($request), $request->filled('remember')
        );
    }

    protected function authenticateWithFingerprint(Request $request)
    {
        // Check if the fingerprint image was uploaded
        if ($request->hasFile('fingerprint_image')) {
            $image = $request->file('fingerprint_image');

            // Validate the image file 
            $request->validate([
                'fingerprint_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            
            $imageBase64 = base64_encode(file_get_contents($image));

            // Initialize the Guzzle HTTP client
            $client = new Client();

            // Define the API endpoint and parameters
            $apiEndpoint = 'https://fingerprint-api.com/verify';
            $apiKey = 'api_key_here';

            try {
                // Make a POST request to the API
                $response = $client->post($apiEndpoint, [
                    'headers' => [
                        'Content-Type' => 'application/json',
                        'Authorization' => 'Bearer ' . $apiKey,
                    ],
                    'json' => [
                        'fingerprint_image' => $imageBase64,
                    ],
                ]);

                // Decode the response
                $responseData = json_decode($response->getBody(), true);

                // Check if the fingerprint is verified
                if ($responseData['verified'] === true) {
                    // The fingerprint is verified, log the user in
                    $user = User::find($responseData['user_id']);
                    Auth::login($user);
                    return true;
                }
            } catch (\Exception $e) {
                // Handle exceptions (e.g., API errors)
                // You might want to log the error or show a message to the user
            }
        }

        return false;
    }
}


// namespace App\Http\Controllers\Auth;

// use App\Http\Controllers\Controller;
// use Illuminate\Foundation\Auth\AuthenticatesUsers;

// class LoginController extends Controller
// {
//     /*
//     |--------------------------------------------------------------------------
//     | Login Controller
//     |--------------------------------------------------------------------------
//     |
//     | This controller handles authenticating users for the application and
//     | redirecting them to your home screen. The controller uses a trait
//     | to conveniently provide its functionality to your applications.
//     |
//     */

//     use AuthenticatesUsers;

//     /**
//      * Where to redirect users after login.
//      *
//      * @var string
//      */
//     protected $redirectTo = '/home';

//     /**
//      * Create a new controller instance.
//      *
//      * @return void
//      */
//     public function __construct()
//     {
//         $this->middleware('guest')->except('logout');
//     }
// }


//////////using our scanner
// use GuzzleHttp\Client;

// protected function authenticateWithFingerprint(Request $request)
// {
 
//     $fingerprintData = $request->input('fingerprint_data');

    
//     $client = new Client();

 
//     $apiEndpoint = 'securegenverify';
//     $apiKey = 'api_key_here';

//     try {
       
//         $response = $client->post($apiEndpoint, [
//             'headers' => [
//                 'Content-Type' => 'application/json',
//                 'Authorization' => 'Bearer ' . $apiKey,
//             ],
//             'json' => [
//                 'fingerprint_data' => $fingerprintData,
//             ],
//         ]);

        
//         $responseData = json_decode($response->getBody(), true);

      
//         if ($responseData['verified'] === true) {
         
//             $user = User::find($responseData['user_id']);
//             Auth::login($user);
//             return true;
//         }
//     } catch (Exception $e) {
      
//     }

//     return false;
// }
