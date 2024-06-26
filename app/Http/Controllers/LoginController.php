<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Show the login form
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Handle login form submission
    // app/Http/Controllers/LoginController.php

public function login(Request $request)
{
    // Validate the form data
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    // Attempt to log the user in
    $credentials = $request->only('email', 'password');
    if (Auth::attempt($credentials)) {
        // Authentication passed...
        return redirect()->intended('table'); // Redirect to authenticated page (dashboard)
    }

    // Authentication failed...
    return redirect()->back()->withErrors([
        'email' => 'The provided credentials do not match our records.',
    ]);
}
public function logout(Request $request)
{
    Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login'); 
}


}
