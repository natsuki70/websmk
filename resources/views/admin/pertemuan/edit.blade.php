@extends('layouts.admin')

@section('title', 'Edit Pertemuan')

@section('content')
    <div class="page-header">
        <div>
            <h1>Edit Pertemuan</h1>
            <p>Mata Pelajaran: {{ $pertemuan->mapel->nama_mapel }}</p>
        </div>
        <a href="{{ route('admin.mapel.show', $pertemuan->mapel_id) }}" class="btn-secondary">&larr; Kembali</a>
    </div>

    <div class="table-container" style="max-width: 800px;">
        <form action="{{ route('admin.pertemuan.update', $pertemuan->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="form-group">
                <label>Pertemuan Ke-</label>
                <input type="number" name="pertemuan_ke" value="{{ old('pertemuan_ke', $pertemuan->pertemuan_ke) }}" required min="1">
            </div>

            <div class="form-group">
                <label>Pembahasan / Topik</label>
                <input type="text" name="pembahasan" value="{{ old('pembahasan', $pertemuan->pembahasan) }}" required>
            </div>

            <div class="form-group">
                <label>Link Video URL (YouTube/Lumi)</label>
                <input type="text" name="video_url" value="{{ old('video_url', $pertemuan->video_url) }}">
            </div>

            <div class="form-group">
                <label>Isi Materi Lengkap</label>
                <textarea name="materi" rows="10">{{ old('materi', $pertemuan->materi) }}</textarea>
            </div>

            <div class="form-group">
                <label>Deskripsi Singkat (Opsional)</label>
                <textarea name="deskripsi" rows="3">{{ old('deskripsi', $pertemuan->deskripsi) }}</textarea>
            </div>

            <div style="margin-top: 2rem;">
                <button type="submit" class="btn-primary">Simpan Perubahan</button>
            </div>
        </form>
    </div>
@endsection
