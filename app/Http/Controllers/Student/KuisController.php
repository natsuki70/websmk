<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Kuis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KuisController extends Controller
{
    public function show(Kuis $kuis)
    {
        // Security: Ensure student can access this quiz (via class)
        if ($kuis->kelas_id != Auth::user()->kelas_id) {
            abort(403, 'Akses ditolak. Kuis ini bukan untuk kelas Anda.');
        }

        return view('siswa.kuis.show', compact('kuis'));
    }

    public function start(Kuis $kuis)
    {
        // Init session for this quiz
        $soal_ids = $kuis->soals()->pluck('id')->toArray();
        if (empty($soal_ids)) {
            return back()->with('error', 'Soal belum tersedia untuk kuis ini.');
        }

        // Shuffle questions if needed, or keep order
        // session(['quiz_order_' . $kuis->id => $soal_ids]); 
        
        // Reset previous answers
        session()->forget('quiz_answers_' . $kuis->id);

        return redirect()->route('siswa.kuis.main', ['kuis' => $kuis->id, 'no' => 1]);
    }
    
    public function main(Kuis $kuis, $no)
    {
        $soals = $kuis->soals; // Or use cached order
        
        if ($no < 1 || $no > $soals->count()) {
            return redirect()->route('siswa.kuis.result', $kuis->id);
        }

        $currentSoal = $soals[$no - 1];
        $totalSoal = $soals->count();

        return view('siswa.kuis.question', compact('kuis', 'currentSoal', 'no', 'totalSoal'));
    }

    public function answer(Request $request, Kuis $kuis)
    {
        $request->validate([
            'soal_id' => 'required',
            'jawaban' => 'required',
            'no' => 'required'
        ]);

        // Save answer to session
        $answers = session('quiz_answers_' . $kuis->id, []);
        $answers[$request->soal_id] = $request->jawaban;
        session(['quiz_answers_' . $kuis->id => $answers]);

        $nextNo = $request->no + 1;
        $totalSoal = $kuis->soals()->count();

        if ($nextNo > $totalSoal) {
            return redirect()->route('siswa.kuis.finish', $kuis->id);
        }

        return redirect()->route('siswa.kuis.main', ['kuis' => $kuis->id, 'no' => $nextNo]);
    }

    public function finish(Kuis $kuis)
    {
        $answers = session('quiz_answers_' . $kuis->id, []);
        $soals = $kuis->soals;
        
        $benar = 0;
        $salah = 0;
        $kosong = 0;

        foreach ($soals as $soal) {
            if (!isset($answers[$soal->id])) {
                $kosong++;
                continue;
            }

            if ($answers[$soal->id] == $soal->jawaban) {
                $benar++;
            } else {
                $salah++;
            }
        }

        $totalSoal = $soals->count();
        $skor = ($totalSoal > 0) ? round(($benar / $totalSoal) * 100) : 0;

        // Save to Database
        \App\Models\Nilai::create([
            'user_id' => Auth::id(),
            'kuis_id' => $kuis->id,
            'skor' => $skor,
            'benar' => $benar,
            'salah' => $salah + $kosong, // Treat unanswered as wrong for now
        ]);

        // Clear Session
        session()->forget('quiz_answers_' . $kuis->id);

        return redirect()->route('siswa.kuis.result', $kuis->id);
    }

    public function result(Kuis $kuis)
    {
        // Fetch latest result
        $nilai = \App\Models\Nilai::where('user_id', Auth::id())
                                ->where('kuis_id', $kuis->id)
                                ->latest()
                                ->first();

        return view('siswa.kuis.result', compact('kuis', 'nilai'));
    }
}
