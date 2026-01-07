@extends('layouts.admin')

@section('title', 'Edit Mata Pelajaran')

@section('content')
    <div class="page-header">
        <div>
            <h1>Edit Mata Pelajaran</h1>
            <p>Perbarui informasi mata pelajaran</p>
        </div>
        <a href="{{ route('admin.mapel.index') }}" class="btn-secondary">&larr; Kembali</a>
    </div>

    <div class="table-container" style="max-width: 600px;">
        <form action="{{ route('admin.mapel.update', $mapel->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="form-group">
                <label>Nama Mata Pelajaran</label>
                <input type="text" name="nama_mapel" value="{{ $mapel->nama_mapel }}" required>
            </div>

            <div class="form-group">
                <label>Kelas</label>
                <select name="kelas_id" required style="width: 100%; padding: 0.8rem; border-radius: 8px; border: 1px solid #ddd;">
                    <option value="">Pilih Kelas</option>
                    @foreach($kelas as $k)
                        <option value="{{ $k->id }}" {{ $mapel->kelas_id == $k->id ? 'selected' : '' }}>{{ $k->nama_kelas }}</option>
                    @endforeach
                </select>
                <small style="color: #666; display: block; margin-top: 0.3rem;">Pilih kelas untuk mata pelajaran ini.</small>
            </div>

            <div class="form-group">
                <label>Kode Mapel</label>
                <input type="text" name="kode_mapel" value="{{ $mapel->kode_mapel }}" required>
            </div>

            <div class="form-group">
                <label>Guru Pengampu</label>
                <input type="text" name="guru_pengampu" value="{{ $mapel->guru_pengampu }}" required>
            </div>

            <div style="margin-top: 2rem;">
                <button type="submit" class="btn-primary">Update Mata Pelajaran</button>
            </div>
        </form>
    </div>
@endsection
