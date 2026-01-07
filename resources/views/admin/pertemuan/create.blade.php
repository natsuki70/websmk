@extends('layouts.admin')

@section('title', 'Tambah Pertemuan')

@section('content')
    <div class="page-header">
        <div>
            <h1>Tambah Pertemuan</h1>
            <p>Mata Pelajaran: {{ $mapel->nama_mapel }}</p>
        </div>
        <a href="{{ route('admin.mapel.show', $mapel->id) }}" class="btn-secondary">&larr; Kembali</a>
    </div>

    <div class="table-container" style="max-width: 800px;">
        <form action="{{ route('admin.pertemuan.store') }}" method="POST">
            @csrf
            <input type="hidden" name="mapel_id" value="{{ $mapel->id }}">
            
            <div class="form-group">
                <label>Pertemuan Ke-</label>
                <input type="number" name="pertemuan_ke" required min="1" placeholder="Urutan pertemuan (contoh: 1)" value="{{ $pertemuan_ke ?? '' }}">
            </div>

            <div class="form-group">
                <label>Pembahasan / Topik</label>
                <input type="text" name="pembahasan" required placeholder="Contoh: Pengenalan Algoritma">
            </div>

            <div class="form-group">
                <label>Link Video URL (YouTube/Lumi)</label>
                <input type="text" name="video_url" placeholder="https://youtube.com/...">
                <small style="color: #666; display: block; margin-top: 0.3rem;">Opsional. Masukkan link video materi jika ada.</small>
            </div>

            <div class="form-group">
                <label>Isi Materi Lengkap</label>
                <textarea name="materi" rows="10" placeholder="Tuliskan materi lengkap di sini..."></textarea>
            </div>

            <div class="form-group">
                <label>Deskripsi Singkat (Opsional)</label>
                <textarea name="deskripsi" rows="3" placeholder="Ringkasan singkat untuk ditampilkan di daftar..."></textarea>
            </div>

            <div style="margin-top: 2rem;">
                <button type="submit" class="btn-primary">Simpan Pertemuan</button>
            </div>
        </form>
    </div>
@endsection
