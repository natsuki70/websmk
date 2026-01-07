<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\Mapel;
use Illuminate\Http\Request;

class MapelController extends Controller
{
    public function index()
    {
        $mapels = Mapel::with('kelas')->get();
        $kelas = Kelas::all();
        return view('admin.mapel.index', compact('mapels', 'kelas'));
    }

    public function show(Mapel $mapel)
    {
        $mapel->load('pertemuans');
        return view('admin.mapel.show', compact('mapel'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_mapel' => 'required',
            'kode_mapel' => 'required|unique:mapels',
            'guru_pengampu' => 'required',
            'kelas_id' => 'required|exists:kelas,id',
        ]);

        Mapel::create($request->all());
        return redirect()->route('admin.mapel.index')->with('success', 'Mata Pelajaran berhasil ditambahkan');
    }

    public function edit(Mapel $mapel)
    {
        $kelas = Kelas::all();
        return view('admin.mapel.edit', compact('mapel', 'kelas'));
    }

    public function update(Request $request, Mapel $mapel)
    {
        $request->validate([
            'nama_mapel' => 'required',
            'kode_mapel' => 'required|unique:mapels,kode_mapel,' . $mapel->id,
            'guru_pengampu' => 'required',
            'kelas_id' => 'required|exists:kelas,id',
        ]);

        $mapel->update($request->all());
        return redirect()->route('admin.mapel.index')->with('success', 'Mata Pelajaran berhasil diperbarui');
    }

    public function destroy(Mapel $mapel)
    {
        $mapel->delete();
        return redirect()->route('admin.mapel.index')->with('success', 'Mata Pelajaran berhasil dihapus');
    }
}
