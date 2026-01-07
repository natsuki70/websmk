@extends('layouts.student')

@section('content')
    <div class="result-container">
        <div class="result-card">
            <div class="result-icon">
                @if($nilai->skor >= $kuis->kkm)
                    <i class="fas fa-trophy" style="color: #FFD700;"></i>
                @else
                    <i class="fas fa-book-reader" style="color: #ED1E79;"></i>
                @endif
            </div>
            
            <h1>{{ $nilai->skor >= $kuis->kkm ? 'Selamat!' : 'Tetap Semangat!' }}</h1>
            <p class="subtitle">Kamu telah menyelesaikan kuis {{ $kuis->judul }}</p>

            <div class="score-box">
                <span class="score-label">Skor Kamu</span>
                <span class="score-value {{ $nilai->skor >= $kuis->kkm ? 'pass' : 'fail' }}">{{ $nilai->skor }}</span>
                <span class="kkm-label">KKM: {{ $kuis->kkm }}</span>
            </div>

            <div class="stats-grid">
                <div class="stat-item">
                    <span class="stat-value">{{ $nilai->benar }}</span>
                    <span class="stat-label">Benar</span>
                </div>
                <div class="stat-item">
                    <span class="stat-value">{{ $nilai->salah }}</span>
                    <span class="stat-label">Salah / Kosong</span>
                </div>
                <!-- Future: Duration -->
            </div>

            <div class="action-buttons">
                <a href="{{ route('siswa.mapel.show', $kuis->mapel_id) }}" class="btn-primary">Kembali ke Materi</a>
                @if($nilai->skor < $kuis->kkm)
                    <!-- Retry mechanism can be added here -->
                    <a href="{{ route('siswa.kuis.show', $kuis->id) }}" class="btn-outline">Coba Lagi</a>
                @endif
            </div>
        </div>
    </div>

    <style>
        .result-container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 70vh;
        }

        .result-card {
            background: white;
            padding: 3rem;
            border-radius: 24px;
            text-align: center;
            box-shadow: 0 10px 40px rgba(0,0,0,0.08);
            max-width: 500px;
            width: 100%;
        }

        .result-icon {
            font-size: 4rem;
            margin-bottom: 1.5rem;
        }

        .result-card h1 {
            color: #333;
            margin-bottom: 0.5rem;
        }

        .subtitle {
            color: #888;
            margin-bottom: 2rem;
        }

        .score-box {
            background: #f8f9fa;
            border-radius: 16px;
            padding: 2rem;
            margin-bottom: 2rem;
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .score-label {
            font-size: 0.9rem;
            color: #888;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .score-value {
            font-size: 4rem;
            font-weight: 800;
            line-height: 1;
        }

        .score-value.pass {
            color: #00c853;
        }

        .score-value.fail {
            color: #d50000;
        }

        .kkm-label {
            font-size: 0.85rem;
            color: #aaa;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .stat-item {
            border: 1px solid #eee;
            border-radius: 12px;
            padding: 1rem;
        }

        .stat-value {
            display: block;
            font-size: 1.5rem;
            font-weight: bold;
            color: #333;
        }

        .stat-label {
            font-size: 0.85rem;
            color: #888;
        }

        .action-buttons {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .btn-primary {
            display: block;
            background: #ED1E79;
            color: white;
            padding: 1rem;
            border-radius: 12px;
            text-decoration: none;
            font-weight: bold;
            transition: transform 0.2s;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
        }

        .btn-outline {
            display: block;
            background: transparent;
            color: #666;
            padding: 0.8rem;
            border-radius: 12px;
            text-decoration: none;
            border: 2px solid #eee;
            font-weight: 600;
        }
    </style>
@endsection
