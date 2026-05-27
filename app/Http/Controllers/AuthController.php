<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function loginView()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            if (Auth::user()->is_blocked) {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                return back()->withErrors([
                    'email' => 'Akun Anda telah diblokir. Silakan hubungi admin.',
                ])->onlyInput('email');
            }

            $request->session()->regenerate();
            Auth::user()->logActivity('Masuk ke akun');

            if (Auth::user()->role === 'admin') {
                return redirect()->intended('/admin/dashboard');
            }

            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => 'Email atau password yang Anda masukkan salah.',
        ])->onlyInput('email');
    }

    public function registerView()
    {
        return view('registrasi');
    }

    public function register(Request $request)
    {
        $phoneInput = $request->input('phone');
        $countryCode = $request->input('country_code', '+62');
        $combinedPhone = null;

        if ($phoneInput !== null && $phoneInput !== '') {
            $digits = ltrim($phoneInput, '0');
            $digits = preg_replace('/[^0-9]/', '', $digits);
            
            $codeDigits = ltrim($countryCode, '+');
            if (str_starts_with($digits, $codeDigits)) {
                $digits = substr($digits, strlen($codeDigits));
            }
            
            $combinedPhone = $countryCode . $digits;
        }

        $request->merge(['phone' => $combinedPhone]);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['nullable', 'string', 'max:20'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'password' => Hash::make($validated['password']),
            'role' => 'user',
        ]);

        $user->profile()->create([
            'avatar_url' => null,
            'bio' => null,
            'address' => null,
            'is_public' => true,
            'email_notifications' => true,
            'dark_mode' => false,
        ]);

        $user->logActivity('Mendaftar akun baru');

        Auth::login($user);

        return redirect('/');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
