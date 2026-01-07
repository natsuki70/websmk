<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OnboardingController extends Controller
{
    public function index()
    {
        $kelas = Kelas::all();
        return view('siswa.onboarding', compact('kelas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nisn' => 'required|numeric|unique:users,nisn,' . Auth::id(),
            'kelas_id' => 'required|exists:kelas,id',
        ]);

        $user = User::find(Auth::id());
        $user->nisn = $request->nisn;
        $user->kelas_id = $request->kelas_id;
        $user->save();

        return redirect()->route('siswa.dashboard')->with('success', 'Selamat datang! Profil Anda telah diperbarui.');
    }
}
