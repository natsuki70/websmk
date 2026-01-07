@extends('layouts.student')

@section('content')
    <div class="dashboard-header back-header">
        <a href="{{ route('siswa.mapel.index') }}" class="btn-back"><i class="fas fa-arrow-left"></i> Kembali</a>
        <div>
            <h2>{{ $mapel->nama_mapel }}</h2>
            <p>{{ $mapel->guru_pengampu }}</p>
        </div>
    </div>

    <div class="pertemuan-grid">
        @forelse($pertemuans as $pertemuan)
            <a href="{{ route('siswa.mapel.topics', ['mapel' => $mapel->id, 'ke' => $pertemuan->pertemuan_ke]) }}" class="pertemuan-card">
                <div class="card-icon">
                    <span>{{ $pertemuan->pertemuan_ke }}</span>
                </div>
                <div class="card-info">
                    <h3>Pertemuan {{ $pertemuan->pertemuan_ke }}</h3>
                    <p>Klik untuk melihat daftar pembahasan</p>
                </div>
                <div class="card-arrow">
                    <i class="fas fa-chevron-right"></i>
                </div>
            </a>
        @empty
            <div class="empty-state">
                <p>Belum ada pertemuan untuk mata pelajaran ini.</p>
            </div>
        @endforelse
    </div>

    <style>
        .back-header {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .btn-back {
            color: #666;
            text-decoration: none;
            font-size: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: color 0.3s;
        }

        .btn-back:hover {
            color: #ED1E79;
        }

        .pertemuan-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 1.5rem;
        }

        .pertemuan-card {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            display: flex;
            align-items: center;
            gap: 1rem;
            text-decoration: none;
            color: #333;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .pertemuan-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 15px rgba(0,0,0,0.1);
        }

        .card-icon {
            width: 50px;
            height: 50px;
            background: #fce4ec;
            color: #ED1E79;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            font-weight: bold;
            flex-shrink: 0;
        }

        .card-info h3 {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 0.2rem;
        }

        .card-info p {
            font-size: 0.85rem;
            color: #888;
        }

        .card-arrow {
            margin-left: auto;
            color: #ccc;
        }

        .empty-state {
            grid-column: 1 / -1;
            text-align: center;
            padding: 3rem;
            color: #999;
        }
    </style>
@endsection
