<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function index()
    {
        $kelas = Kelas::withCount('siswas')->get();
        return view('admin.kelas.index', compact('kelas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kelas' => 'required',
            'wali_kelas' => 'required',
        ]);

        Kelas::create($request->all());
        return redirect()->route('admin.kelas.index')->with('success', 'Kelas berhasil ditambahkan');
    }

    public function destroy($id)
    {
        try {
            $kelas = Kelas::findOrFail($id);
            $kelas->delete();
            return redirect()->route('admin.kelas.index')->with('success', 'Kelas berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->route('admin.kelas.index')->with('error', 'Gagal menghapus kelas. Pastikan tidak ada data yang terkait (Siswa/Kuis). Error: ' . $e->getMessage());
        }
    }
}
