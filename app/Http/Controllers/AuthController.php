<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        // Validasi input
        $credentials = $request->validate([
            'email-username' => 'required',
            'password' => 'required',
        ]);

        // Cek login menggunakan email atau username
        $loginField = filter_var($credentials['email-username'], FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        if (Auth::attempt([$loginField => $credentials['email-username'], 'password' => $credentials['password']])) {
            // Login berhasil, redirect ke halaman dashboard
            return redirect()->route('dashboard');
        }

        // Login gagal, kembali ke halaman login dengan pesan error
        return back()->withErrors([
            'email-username' => 'Email, username, atau password salah.',
        ])->onlyInput('email-username');
    }

    public function destroy(Request $request)
    {
        Auth::logout(); // Logout the user

        // Optional: Flash a message to the session
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('status', 'You have been logged out successfully.'); // Redirect to login page with a message
    }
}
