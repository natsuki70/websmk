<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pertemuan;
use App\Models\Mapel;
use Illuminate\Http\Request;

class PertemuanController extends Controller
{
    public function create(Mapel $mapel, Request $request)
    {
        $pertemuan_ke = $request->query('pertemuan_ke');
        return view('admin.pertemuan.create', compact('mapel', 'pertemuan_ke'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'mapel_id' => 'required|exists:mapels,id',
            'pertemuan_ke' => 'required|integer',
            'pembahasan' => 'required|string',
            'deskripsi' => 'nullable|string',
            'materi' => 'nullable|string',
            'video_url' => 'nullable|string',
        ]);

        Pertemuan::create($request->all());

        return redirect()->route('admin.mapel.show', $request->mapel_id)->with('success', 'Pertemuan berhasil ditambahkan');
    }

    public function edit(Pertemuan $pertemuan)
    {
        return view('admin.pertemuan.edit', compact('pertemuan'));
    }

    public function update(Request $request, Pertemuan $pertemuan)
    {
        $request->validate([
            'pertemuan_ke' => 'required|integer',
            'pembahasan' => 'required|string',
            'deskripsi' => 'nullable|string',
            'materi' => 'nullable|string',
            'video_url' => 'nullable|string',
        ]);

        $pertemuan->update($request->all());

        return redirect()->route('admin.mapel.show', $pertemuan->mapel_id)->with('success', 'Pertemuan berhasil diperbarui');
    }

    public function destroy(Pertemuan $pertemuan)
    {
        $mapel_id = $pertemuan->mapel_id;
        $pertemuan->delete();
        return redirect()->route('admin.mapel.show', $mapel_id)->with('success', 'Pertemuan berhasil dihapus');
    }
}
