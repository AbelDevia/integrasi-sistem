<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class GoogleController extends Controller
{
    public function redirectToGoogle()
{
    return Socialite::driver('google')
        ->scopes(['https://www.googleapis.com/auth/calendar']) // Tambahkan scope yang diperlukan
        ->with(['access_type' => 'offline', 'prompt' => 'consent']) // Meminta refresh token
        ->redirect();
}

    public function handleGoogleCallback()
    {
        try {
            // Mendapatkan data pengguna dari Google
            $googleUser = Socialite::driver('google')->user();
    
            // Mencari pengguna berdasarkan email
            $user = User::where('email', $googleUser->email)->first();
    
            // Jika pengguna tidak ditemukan, buat pengguna baru
            if (!$user) {
                $user = User::create([
                    'name' => $googleUser->name,
                    'email' => $googleUser->email,
                    'password' => bcrypt('password123'), // Password default
                ]);
            }
    // dd($googleUser->refreshToken);
            // Simpan token akses dan refresh token ke dalam database
            $user->google_token = $googleUser->token;
            $user->google_refresh_token = $googleUser->refreshToken;
            $user->save();
    
            // Login pengguna
            Auth::login($user);
    
            // Redirect ke halaman dashboard setelah login
            return redirect()->intended('/dashboard');
        } catch (\Exception $e) {
            // Jika terjadi kesalahan saat login dengan Google
            return redirect('/login')->withErrors(['msg' => 'Login with Google failed!']);
        }
    }
}
