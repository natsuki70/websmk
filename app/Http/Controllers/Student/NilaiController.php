<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Nilai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NilaiController extends Controller
{
    public function index()
    {
        $nilais = Nilai::where('user_id', Auth::id())
                    ->with(['kuis.mapel', 'kuis.pertemuan'])
                    ->orderBy('created_at', 'desc')
                    ->get();

        return view('siswa.nilai.index', compact('nilais'));
    }
}
