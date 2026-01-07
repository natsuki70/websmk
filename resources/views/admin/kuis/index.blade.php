@extends('layouts.admin')

@section('title', 'Manajemen Kuis')

@section('content')
    <div class="page-header">
        <div>
            <h1>Daftar Kuis</h1>
            <p>Kelola data kuis dan soal</p>
        </div>
        <a href="{{ route('admin.kuis.create') }}" class="btn-add" style="text-decoration: none;">+ Buat Kuis Baru</a>
    </div>

    <div class="table-container">
        @if(session('success'))
            <div class="alert alert-success" style="padding: 1rem; background: #d1fae5; color: #065f46; margin-bottom: 1rem; border-radius: 8px;">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger" style="padding: 1rem; background: #fee2e2; color: #991b1b; margin-bottom: 1rem; border-radius: 8px;">
                {{ session('error') }}
            </div>
        @endif

        <table class="admin-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Judul Kuis</th>
                    <th>Mapel</th>
                    <th>Pertemuan</th>
                    <th>KKM</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($kuis as $k)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $k->judul }}</td>
                    <td>{{ $k->mapel->nama_mapel ?? '-' }}</td>
                    <td>
                        @if($k->pertemuan)
                            Pertemuan {{ $k->pertemuan->pertemuan_ke }}
                        @else
                            -
                        @endif
                    </td>
                    <td>{{ $k->kkm }}</td>
                    <td>
                        <span class="badge {{ $k->status == 'aktif' ? 'badge-success' : 'badge-danger' }}">{{ ucfirst($k->status) }}</span>
                    </td>
                    <td>
                        <a href="{{ route('admin.kuis.show', $k->id) }}" class="btn-icon" style="color: #662D8C;" title="Kelola Soal"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('admin.kuis.destroy', $k->id) }}" method="POST" onsubmit="return confirm('Yakin hapus?')" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-icon btn-delete" style="border:none; cursor:pointer;"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" style="text-align:center;">Belum ada kuis.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
