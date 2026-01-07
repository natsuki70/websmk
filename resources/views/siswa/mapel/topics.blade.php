@extends('layouts.student')

@section('content')
    <div class="dashboard-header back-header">
        <a href="{{ route('siswa.mapel.show', $mapel->id) }}" class="btn-back"><i class="fas fa-arrow-left"></i> Kembali ke Daftar Pertemuan</a>
        <div>
            <h2>Pertemuan {{ $pertemuan_ke }}</h2>
            <p>{{ $mapel->nama_mapel }}</p>
        </div>
    </div>

    <div class="topic-list">
        @forelse($topics as $topic)
            @if($topic->is_locked)
                <div class="topic-card locked">
                    <div class="topic-icon">
                        <i class="fas fa-lock"></i>
                    </div>
                    <div class="topic-content">
                        <h3>{{ $topic->pembahasan }}</h3>
                        <p class="text-locked"><i class="fas fa-lock"></i> Terkunci - Selesaikan materi sebelumnya</p>
                    </div>
                    <div class="topic-action">
                        <span class="btn-read btn-disabled">Terkunci</span>
                    </div>
                </div>
            @else
                <a href="{{ route('siswa.mapel.read', ['mapel' => $mapel->id, 'pertemuan' => $topic->id]) }}" class="topic-card">
                    <div class="topic-icon">
                        <i class="fas fa-file-alt"></i>
                    </div>
                    <div class="topic-content">
                        <h3>{{ $topic->pembahasan }}</h3>
                        @if($topic->deskripsi)
                            <p>{{ $topic->deskripsi }}</p>
                        @endif
                    </div>
                    <div class="topic-action">
                        <span class="btn-read">Baca Materi</span>
                    </div>
                </a>
            @endif
        @empty
            <div class="empty-state">
                <p>Belum ada pembahasan untuk pertemuan ini.</p>
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

        .topic-list {
            display: flex;
            flex-direction: column;
            gap: 1rem;
            max-width: 800px;
        }

        .topic-card {
            background: white;
            border-radius: 12px;
            padding: 1.2rem;
            display: flex;
            align-items: center;
            gap: 1.2rem;
            text-decoration: none;
            color: #333;
            border: 1px solid #eee;
            transition: all 0.2s;
        }

        .topic-card:hover {
            border-color: #ED1E79;
            box-shadow: 0 4px 12px rgba(237, 30, 121, 0.1);
        }

        .topic-card.locked {
            background: #f5f5f5;
            border-color: #ddd;
            cursor: not-allowed;
            opacity: 0.8;
        }

        .topic-card.locked:hover {
            box-shadow: none;
            border-color: #ddd;
        }

        .topic-card.locked .topic-icon {
            background: #eee;
            color: #999;
        }

        .text-locked {
            color: #d32f2f;
            font-size: 0.85rem;
            margin-top: 0.2rem;
        }

        .btn-disabled {
            background: #ccc !important;
            cursor: not-allowed;
        }

        .topic-icon {
            width: 45px;
            height: 45px;
            background: #f3e5f5;
            color: #9c27b0;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
        }

        .topic-content {
            flex: 1;
        }

        .topic-content h3 {
            font-size: 1.1rem;
            font-weight: 600;
            color: #333;
            margin-bottom: 0.2rem;
        }

        .topic-content p {
            font-size: 0.9rem;
            color: #777;
            margin: 0;
        }

        .topic-action .btn-read {
            background: #28a745;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 6px;
            font-size: 0.85rem;
            font-weight: 500;
        }

        .empty-state {
            text-align: center;
            padding: 3rem;
            color: #999;
        }
    </style>
@endsection
