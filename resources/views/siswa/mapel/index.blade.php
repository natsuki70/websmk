@extends('layouts.student')

@section('content')
    <div class="dashboard-header">
        <h2>Mata Pelajaran Saya</h2>
        <p>Akses materi dan kuis untuk kelas Anda</p>
        <div style="background: #e3f2fd; color: #0d47a1; padding: 0.8rem; border-radius: 8px; font-size: 0.9rem; margin-top: 0.5rem; border: 1px solid #bbdefb;">
            <i class="fas fa-info-circle"></i> Anda terdaftar di kelas: <strong>{{ Auth::user()->kelas->nama_kelas ?? 'Belum ada kelas' }}</strong>
        </div>
    </div>

    <div class="mapel-grid">
        @forelse($mapels as $mapel)
            <a href="{{ route('siswa.mapel.show', $mapel->id) }}" class="mapel-card">
                <div class="mapel-icon">
                    <i class="fas fa-book-open"></i>
                </div>
                <div class="mapel-info">
                    <h3>{{ $mapel->nama_mapel }}</h3>
                    <p>{{ $mapel->guru_pengampu }}</p>
                </div>
                <div class="mapel-arrow">
                    <i class="fas fa-chevron-right"></i>
                </div>
            </a>
        @empty
            <div class="empty-state">
                <i class="fas fa-box-open"></i>
                <p>Belum ada mata pelajaran untuk kelas Anda.</p>
            </div>
        @endforelse
    </div>

    <style>
        .mapel-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 1.5rem;
            margin-top: 2rem;
        }

        .mapel-card {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            display: flex;
            align-items: center;
            gap: 1.5rem;
            text-decoration: none;
            color: #333;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .mapel-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 15px rgba(0,0,0,0.1);
        }

        .mapel-icon {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, #662D8C 0%, #ED1E79 100%);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
            flex-shrink: 0;
        }

        .mapel-info h3 {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 0.2rem;
            color: #333;
        }

        .mapel-info p {
            color: #666;
            font-size: 0.9rem;
        }

        .mapel-arrow {
            margin-left: auto;
            color: #ccc;
            transition: transform 0.3s ease;
        }

        .mapel-card:hover .mapel-arrow {
            color: #ED1E79;
            transform: translateX(5px);
        }

        .empty-state {
            grid-column: 1 / -1;
            text-align: center;
            padding: 3rem;
            color: #999;
        }
        .empty-state i {
            font-size: 3rem;
            margin-bottom: 1rem;
            display: block;
        }
    </style>
@endsection
