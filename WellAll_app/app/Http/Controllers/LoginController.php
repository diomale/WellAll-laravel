<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    /**
     * Show the login form.
     */
    public function showLoginForm()
    {
        // If already logged in, redirect to dashboard
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }

        return view('auth.login');
    }

    /**
     * Handle login form submission.
     */
    public function login(Request $request)
    {
        // Validate input
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Find user by username
        $user = User::where('username', $request->username)->first();

        if (!$user) {
            return back()->withErrors([
                'username' => 'User not found.'
            ])->withInput();
        }

        // Check password
        if (!Hash::check($request->password, $user->password)) {
            return back()->withErrors([
                'password' => 'Incorrect password.'
            ])->withInput();
        }

        // Log in user
        Auth::login($user);

        // Regenerate session to prevent fixation attacks
        $request->session()->regenerate();

        // Redirect to dashboard
        return redirect()->route('dashboard');
    }

    /**
     * Handle logout.
     */
    public function logout(Request $request)
    {
        Auth::logout(); // log out user

        // Invalidate and regenerate session to prevent session fixation
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('status', 'You have been logged out.');
    }


}
