<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kuis;
use App\Models\Mapel;
use App\Models\Kelas;
use Illuminate\Http\Request;

class KuisController extends Controller
{
    public function index()
    {
        $kuis = Kuis::with(['mapel', 'kelas', 'pertemuan'])->get();
        return view('admin.kuis.index', compact('kuis'));
    }

    public function create()
    {
        $mapels = Mapel::with('pertemuans')->get(); // Load pertemuans for dropdown
        $kelas = Kelas::all();
        return view('admin.kuis.create', compact('mapels', 'kelas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'mapel_id' => 'required|exists:mapels,id',
            'pertemuan_id' => 'nullable|exists:pertemuans,id',
            'kelas_id' => 'nullable|exists:kelas,id',
            'kkm' => 'required|integer|min:0|max:100',
            'durasi_menit' => 'required|integer',
            'status' => 'required|in:aktif,non-aktif',
        ]);

        $kuis = Kuis::create($request->all());
        
        return redirect()->route('admin.kuis.show', $kuis->id)->with('success', 'Kuis berhasil dibuat. Silakan tambah soal.');
    }

    public function show(Kuis $kuis)
    {
        $kuis->load(['mapel', 'kelas', 'pertemuan']);
        // Fetch soals explicitly to ensure we get the latest data
        $soals = \App\Models\Soal::where('kuis_id', $kuis->id)->orderBy('created_at', 'desc')->get();
        
        return view('admin.kuis.show', compact('kuis', 'soals'));
    }

    public function destroy($id)
    {
        try {
            $kuis = Kuis::findOrFail($id);
            // Manual cleanup
            $kuis->soals()->delete(); 
            $kuis->delete();
            return redirect()->route('admin.kuis.index')->with('success', 'Kuis berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->with('error', 'Gagal menghapus kuis: Database Constraint Error. Pastikan tidak ada data lain yang terhubung.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus: ' . $e->getMessage());
        }
    }
}
