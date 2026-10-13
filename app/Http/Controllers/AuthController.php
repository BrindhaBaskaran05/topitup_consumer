<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RegisterRequest;
use App\Models\User;

use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str; 

use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Display the login page.
     */
    public function showLogin()
    {
        return view('auth.login');
    }

    /**
     * Authenticate the user.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => [
                'required',
                'email',
                 'max:191',
            ],
            'password' => [
                'required',
                'string',
            ],
            'remember' => ['nullable', 'boolean'],
        ]);
 $remember = $request->boolean('remember');
       // $credentials['status'] = true;
          $key = Str::lower($request->input('email')) . '|' . $request->ip();

    if (RateLimiter::tooManyAttempts($key, 5)) {
        return back()
            ->withErrors([
                'email' => 'Too many login attempts. Please try again later.',
            ])
            ->onlyInput('email');
    }

       if (Auth::attempt([
    'email' => $credentials['email'],
    'password' => $credentials['password'],
    'status' => 1,
],$remember)) {
       RateLimiter::clear($key);
            $request->session()->regenerate();

            return redirect()->intended(route('dashboard'));
        }
RateLimiter::hit($key, 60);
        return back()
            ->withErrors([
                'email' => 'The email or password is incorrect.',
            ])
            ->onlyInput('email');
    }

    /**
     * Logout the authenticated user.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }


/**
 * Display the registration page.
 */
public function showRegister()
{
    return view('auth.register');
}

/**
 * Register a new user.
 */
public function register(RegisterRequest $request)
{
     $validated = $request->validated();
        
       User::create([ 'first_name' => $validated['first_name'], 
        'last_name' => $validated['last_name'], 
        'email' => $validated['email'],
         'mobile' => $validated['mobile'], 
         'password' => Hash::make($validated['password']), 'status' => 1, ]);

          return redirect() ->route('login') ->with('success', 'Registration successful. Please login.');
}


}
