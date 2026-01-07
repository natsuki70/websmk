<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Kuis;
use App\Models\Mapel;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // Count Mapel specific for student's class
        $mapelCount = Mapel::where('kelas_id', $user->kelas_id)->count();

        // Count Kuis specific for student's class
        $kuisCount = Kuis::where('kelas_id', $user->kelas_id)->count();

        return view('siswa.dashboard', compact('mapelCount', 'kuisCount'));
    }
}
