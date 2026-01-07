@extends('layouts.admin')

@section('title', 'Detail Mata Pelajaran')

@section('content')
    <div class="page-header">
        <div>
            <h1>{{ $mapel->nama_mapel }}</h1>
            <p>Kode: {{ $mapel->kode_mapel }} | Guru: {{ $mapel->guru_pengampu }}</p>
        </div>
        <!-- Button global untuk tambah pertemuan baru (default group) -->
        <a href="{{ route('admin.pertemuan.create', $mapel->id) }}" class="btn-add" style="text-decoration: none;">+ Tambah Pertemuan</a>
    </div>

    <div class="table-container">
        @if(session('success'))
            <div class="alert alert-success" style="padding: 1rem; background: #d1fae5; color: #065f46; margin-bottom: 1rem; border-radius: 8px;">
                {{ session('success') }}
            </div>
        @endif

        @php
            $groupedPertemuans = $mapel->pertemuans->groupBy('pertemuan_ke');
        @endphp

        @forelse($groupedPertemuans as $ke => $pertemuans)
            <div class="meeting-group">
                <div class="meeting-header">
                    <h3>Pertemuan {{ $ke }}</h3>
                    <a href="{{ route('admin.pertemuan.create', ['mapel' => $mapel->id, 'pertemuan_ke' => $ke]) }}" class="btn-sm btn-add-topic">+ Tambah Topik</a>
                </div>
                
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Pembahasan</th>
                            <th>Materi / Link</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pertemuans as $p)
                        <tr>
                            <td>
                                <strong>{{ $p->pembahasan }}</strong><br>
                                <small style="color: #666;">{{ Str::limit($p->deskripsi, 50) }}</small>
                            </td>
                            <td>
                                @if($p->video_url)
                                    <a href="{{ $p->video_url }}" target="_blank" style="color: #ED1E79; text-decoration: none;">Link Video</a><br>
                                @endif
                                @if($p->materi)
                                    <small class="badge badge-success">Ada Materi</small>
                                @endif
                                @if($p->kuis)
                                    <small class="badge badge-warning" style="background:#fff3e0; color:#ef6c00;">Ada Kuis</small>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.pertemuan.edit', $p->id) }}" class="btn-icon" style="color: #662D8C; margin-right: 0.5rem;" title="Edit Materi"><i class="fas fa-edit"></i></a>
                                <form action="{{ route('admin.pertemuan.destroy', $p->id) }}" method="POST" onsubmit="return confirm('Yakin hapus?')" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-icon btn-delete" style="border:none; cursor:pointer;"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @empty
            <div style="text-align: center; padding: 2rem; color: #888;">
                <p>Belum ada data pertemuan. Silakan tambah pertemuan baru.</p>
            </div>
        @endforelse
    </div>

    <div style="margin-top: 1rem;">
        <a href="{{ route('admin.mapel.index') }}" style="color: #662D8C; text-decoration: none;">&larr; Kembali ke Daftar Mapel</a>
    </div>

    <style>
        .meeting-group {
            margin-bottom: 2rem;
            border: 1px solid #eee;
            border-radius: 8px;
            overflow: hidden;
        }

        .meeting-header {
            background: #f8f9fa;
            padding: 1rem 1.5rem;
            border-bottom: 1px solid #eee;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .meeting-header h3 {
            margin: 0;
            font-size: 1.1rem;
            color: #333;
        }

        .btn-add-topic {
            background: #e3f2fd;
            color: #1565c0;
            text-decoration: none;
            padding: 0.4rem 0.8rem;
            border-radius: 6px;
            font-size: 0.85rem;
            font-weight: 500;
            transition: background 0.2s;
        }

        .btn-add-topic:hover {
            background: #bbdefb;
        }

        /* Adjust table for embedding */
        .meeting-group .admin-table {
            margin: 0;
            box-shadow: none;
        }
        
        .meeting-group .admin-table thead tr {
            background: white;
            border-bottom: 2px solid #eee;
        }

        .meeting-group .admin-table th {
            color: #888;
            font-size: 0.85rem;
            text-transform: uppercase;
        }
    </style>
@endsection
