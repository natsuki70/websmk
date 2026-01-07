<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'in:admin,siswa'],
        ]);

        if ($request->role === 'admin') {
            if ($request->admin_code !== 'Teguh') {
                return back()->withErrors(['admin_code' => 'Kode Admin salah!'])->withInput();
            }
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        Auth::login($user);

        // Redirect based on role
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        // For siswa, redirect to onboarding if needed
        return redirect()->route('siswa.onboarding'); 
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $request->remember)) {
            $request->session()->regenerate();

            // Simple role redirect check if needed, for now just dashboard
            // If email contains 'admin', redirect to admin dashboard (simple check)
            if (str_contains($request->email, 'admin')) {
                  return redirect()->intended(route('admin.dashboard'));
            }

            // Check if student profile is complete (NISN & Kelas)
            if (Auth::user()->role == 'siswa' && (empty(Auth::user()->nisn) || empty(Auth::user()->kelas_id))) {
                return redirect()->route('siswa.onboarding');
            }

            return redirect()->intended(route('siswa.dashboard'));
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
