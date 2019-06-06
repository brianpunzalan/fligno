<?php

namespace Fligno\Http\Controllers\Auth;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Fligno\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    protected function redirectTo() {
        return '/';
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except(['logout', 'apiLogout']);
    }

    /**
     * Login via API
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Fligno\User $user
     */
     public function apiLogin(Request $request) 
     {
        $data = $request->input();
        if (auth()->attempt(['email' => $data['email'], 'password' => $data['password']])) {
            // Authentication passed...
            $user = auth()->user();
            if ($user->is_admin) {
                $user->api_token = str_random(60);
                $user->save();
                return $user;   
            }
        }
        
        return response()->json([
            'error' => 'Unauthenticated user',
            'code' => 401,
        ], 401);
     }


     /**
     * Logout via API
     *
     * @param  \Illuminate\Http\Request  $request
     * @return json
     */
     public function apiLogout(Request $request)
     {
        if (auth()->user()) {
            $user = auth()->user();
            $user->api_token = null; // clear api token
            $user->save();
    
            return response()->json([
                'message' => 'Thank you for using our application',
            ]);
        }
        
        return response()->json([
            'error' => 'Unable to logout user',
            'code' => 401,
        ], 401);
     }
}
