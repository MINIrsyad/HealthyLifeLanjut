<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    /** Tampilkan halaman login */
    public function showLogin()
    {
        return view('auth.login');
    }

    /** Proses login */
    public function login(Request $request)
    {
        $email    = $request->input('email', '');
        $password = $request->input('password', '');

        // Server-side fallback validation (client-side JS handles primary UX)
        if (empty($email) && empty($password)) {
            return back()->with('login_alert', 'Email dan Password wajib diisi')->onlyInput('email');
        }
        if (empty($email)) {
            return back()->with('login_alert', 'Email wajib diisi')->onlyInput('email');
        }
        if (empty($password)) {
            return back()->with('login_alert', 'Password wajib diisi')->onlyInput('email');
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return back()->with('login_alert', 'Format email tidak valid')->onlyInput('email');
        }

        // Check if the email exists in the database
        $user = User::where('email', $email)->first();

        if (!$user) {
            // Email not found — we can't know if the password "matches" anything
            return back()->with('login_alert', 'Email tidak ditemukan')->onlyInput('email');
        }

        // Email exists — check password
        if (!Hash::check($password, $user->password)) {
            return back()->with('login_alert', 'Password salah')->onlyInput('email');
        }

        // Both correct — attempt login (will succeed since we already verified)
        if (Auth::attempt(['email' => $email, 'password' => $password], $request->boolean('remember'))) {
            $request->session()->regenerate();

            if (Auth::user()->isAdmin()) {
                return redirect()->route('admin.dashboard')->with('login_alert', 'Login berhasil');
            }

            return redirect()->route('home')->with('login_alert', 'Login berhasil');
        }

        // Fallback (should not reach here)
        return back()->with('login_alert', 'Email atau password tidak sesuai.')->onlyInput('email');
    }

    /** Tampilkan halaman register */
    public function showRegister()
    {
        return view('auth.register');
    }

    /** Proses registrasi */
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Password::min(8)],
        ]);

        $user = User::create([
            'name'     => $validated['name'],
            'email'    => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role'     => 'user',
        ]);

        Auth::login($user);

        return redirect()->route('home');
    }

    /** Logout */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
