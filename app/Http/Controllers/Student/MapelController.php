<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Mapel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MapelController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        // Fetch subjects assigned to the student's class
        $mapels = Mapel::where('kelas_id', $user->kelas_id)->get();
        return view('siswa.mapel.index', compact('mapels'));
    }

    public function show(Mapel $mapel)
    {
        // Check access
        if ($mapel->kelas_id !== Auth::user()->kelas_id) {
            abort(403);
        }

        // Get unique Meeting Numbers (Pertemuan Ke)
        // Group by pertemuan_ke to show folders
        // We fetch distinct pertemuan_ke values
        $pertemuans = $mapel->pertemuans()
                            ->select('pertemuan_ke')
                            ->distinct()
                            ->orderBy('pertemuan_ke')
                            ->get();

        return view('siswa.mapel.show', compact('mapel', 'pertemuans'));
    }

    public function listTopics(Mapel $mapel, $pertemuan_ke)
    {
        // Check access
        if ($mapel->kelas_id !== Auth::user()->kelas_id) {
            abort(403);
        }

        // Fetch all topics/pembahasan for this specific meeting number
        // Order by ID (creation order) to establish sequence
        $topics = $mapel->pertemuans()
                        ->where('pertemuan_ke', $pertemuan_ke)
                        ->orderBy('id', 'asc') // Ensure sequence
                        ->with(['kuis.soals']) // Eager load quiz
                        ->get();

        // Calculate Locked Status
        $previousPassed = true; // First item is always unlocked
        
        foreach ($topics as $topic) {
            $topic->is_locked = !$previousPassed;

            // Check if THIS topic is passed (to determine next one)
            if ($topic->kuis) {
                // Check if user passed this quiz
                $nilai = \App\Models\Nilai::where('user_id', Auth::id())
                                        ->where('kuis_id', $topic->kuis->id)
                                        ->latest()
                                        ->first();
                
                if ($nilai && $nilai->skor >= $topic->kuis->kkm) {
                    $previousPassed = true;
                } else {
                    $previousPassed = false;
                }
            } else {
                // If no quiz, assume passed (or maybe just reading is enough? 
                // For now, if no quiz, we consider it "passed" immediately so next one opens)
                $previousPassed = true; 
            }
        }

        return view('siswa.mapel.topics', compact('mapel', 'topics', 'pertemuan_ke'));
    }

    public function read(Mapel $mapel, \App\Models\Pertemuan $pertemuan)
    {
        // Security check: Ensure pertemuan belongs to mapel
        if ($pertemuan->mapel_id !== $mapel->id) {
            abort(404);
        }

        // Security check: Ensure mapel belongs to student's class
        if ($mapel->kelas_id !== Auth::user()->kelas_id) {
            abort(403);
        }

        return view('siswa.mapel.read', compact('mapel', 'pertemuan'));
    }
}
