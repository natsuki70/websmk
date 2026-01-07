@extends('layouts.student')

@section('content')
    <div class="dashboard-header back-header">
        <a href="{{ url()->previous() }}" class="btn-back"><i class="fas fa-arrow-left"></i> Kembali</a>
    </div>

    <div class="quiz-intro-container">
        <div class="quiz-header">
            <span class="badge-quiz">Kuis</span>
            <h1>{{ $kuis->judul }}</h1>
            <p>Pertemuan: {{ $kuis->pertemuan->pertemuan_ke }} - {{ $kuis->pertemuan->pembahasan }}</p>
        </div>

        <div class="quiz-details">
            <div class="detail-item">
                <i class="fas fa-clock"></i>
                <div>
                    <h4>Durasi</h4>
                    <p>{{ $kuis->durasi_menit }} Menit</p>
                </div>
            </div>
            <div class="detail-item">
                <i class="fas fa-check-circle"></i>
                <div>
                    <h4>KKM</h4>
                    <p>Skor Minimal {{ $kuis->kkm }}</p>
                </div>
            </div>
            <div class="detail-item">
                <i class="fas fa-list-ol"></i>
                <div>
                    <h4>Jumlah Soal</h4>
                    <p>{{ $kuis->soals->count() }} Soal</p>
                </div>
            </div>
        </div>

        <div class="quiz-instructions">
            <h3>Petunjuk Pengerjaan:</h3>
            <ul>
                <li>Berdoalah sebelum memulai kuis.</li>
                <li>Dilarang membuka tab lain atau bekerjasama.</li>
                <li>Waktu akan berjalan otomatis saat tombol "Mulai" ditekan.</li>
                <li>Pastikan koneksi internet stabil.</li>
            </ul>
        </div>

        <div class="quiz-actions">
            <form action="{{ route('siswa.kuis.start', $kuis->id) }}" method="POST">
                @csrf
                <button type="submit" class="btn-primary btn-lg btn-block">Mulai Kuis Sekarang</button>
            </form>
        </div>
    </div>

    <style>
        .quiz-intro-container {
            background: white;
            border-radius: 20px;
            padding: 3rem;
            max-width: 700px;
            margin: 2rem auto;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        }

        .badge-quiz {
            background: #fff3e0;
            color: #ef6c00;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-weight: bold;
            font-size: 0.9rem;
            display: inline-block;
            margin-bottom: 1rem;
        }

        .quiz-header h1 {
            font-size: 2rem;
            color: #333;
            margin-bottom: 0.5rem;
        }

        .quiz-header p {
            color: #777;
        }

        .quiz-details {
            display: flex;
            justify-content: center;
            gap: 2rem;
            margin: 3rem 0;
            flex-wrap: wrap;
        }

        .detail-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            text-align: left;
            background: #f8f9fa;
            padding: 1rem 1.5rem;
            border-radius: 12px;
            min-width: 180px;
        }

        .detail-item i {
            font-size: 1.8rem;
            color: #ED1E79;
        }

        .detail-item h4 {
            font-size: 0.9rem;
            color: #888;
            margin: 0;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .detail-item p {
            font-size: 1.2rem;
            font-weight: bold;
            color: #333;
            margin: 0;
        }

        .quiz-instructions {
            text-align: left;
            background: #e3f2fd;
            padding: 2rem;
            border-radius: 12px;
            margin-bottom: 3rem;
            color: #0d47a1;
        }

        .quiz-instructions h3 {
            font-size: 1.1rem;
            margin-bottom: 1rem;
        }

        .quiz-instructions ul {
            margin: 0;
            padding-left: 1.2rem;
        }

        .quiz-instructions li {
            margin-bottom: 0.5rem;
        }

        .btn-block {
            width: 100%;
            padding: 1rem;
            font-size: 1.1rem;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(237, 30, 121, 0.3);
            border: none;
            transition: transform 0.2s;
        }

        .btn-block:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(237, 30, 121, 0.4);
        }
    </style>
@endsection
