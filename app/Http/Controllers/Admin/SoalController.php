<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Soal;
use App\Models\Kuis;
use Illuminate\Http\Request;

class SoalController extends Controller
{
    public function store(Request $request)
    {
        // If user wants to finish without saving the current (empty) form
        if ($request->input('action') === 'finish') {
            return redirect()->route('admin.kuis.index')->with('success', 'Kuis selesai dibuat.');
        }

        $request->validate([
            'kuis_id' => 'required|exists:kuis,id',
            'pertanyaan' => 'required|string',
            'opsi_a' => 'required|string',
            'opsi_b' => 'required|string',
            'opsi_c' => 'required|string',
            'opsi_d' => 'required|string',
            'jawaban' => 'required|in:a,b,c,d',
        ]);

        Soal::create($request->all());

        return redirect()->route('admin.kuis.show', $request->kuis_id)->with('success', 'Soal berhasil ditambahkan. Lanjut ke nomor berikutnya.');
    }

    public function destroy(Soal $soal)
    {
        $kuis_id = $soal->kuis_id;
        $soal->delete();
        return redirect()->route('admin.kuis.show', $kuis_id)->with('success', 'Soal berhasil dihapus');
    }
}
