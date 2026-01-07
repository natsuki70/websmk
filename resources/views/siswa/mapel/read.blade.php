@extends('layouts.student')

@section('content')
    <div class="dashboard-header back-header">
        <a href="{{ route('siswa.mapel.show', $mapel->id) }}" class="btn-back"><i class="fas fa-arrow-left"></i> Kembali ke Daftar Pertemuan</a>
    </div>

    <div class="content-reader">
        <div class="reader-header">
            <span class="badge-pertemuan">Pertemuan {{ $pertemuan->pertemuan_ke }}</span>
            <h1>{{ $pertemuan->pembahasan }}</h1>
            <p class="meta-info"><i class="fas fa-calendar-alt"></i> Diposting pada {{ $pertemuan->created_at->format('d M Y') }}</p>
        </div>

        @if($pertemuan->video_url)
            <div class="video-container">
                <!-- Helper to handle YouTube Embeds or direct links -->
                @php
                    $videoID = '';
                    if(preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $pertemuan->video_url, $match)) {
                        $videoID = $match[1];
                    }
                @endphp

                @if($videoID)
                    <iframe src="https://www.youtube.com/embed/{{ $videoID }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                @else
                    <div class="alert-info">Link video tersedia: <a href="{{ $pertemuan->video_url }}" target="_blank">{{ $pertemuan->video_url }}</a></div>
                @endif
            </div>
        @endif

        <div class="material-content">
            {!! nl2br(e($pertemuan->materi)) !!}
        </div>

        @if($pertemuan->kuis)
            <div class="quiz-section">
                <div class="quiz-card">
                    <div class="quiz-info">
                        <h3><i class="fas fa-pencil-alt"></i> Kuis: {{ $pertemuan->kuis->judul }}</h3>
                        <p>Uji pemahamanmu tentang materi ini.</p>
                    </div>
                    <!-- Link to future Student Quiz Start Route -->
                    <a href="{{ route('siswa.kuis.show', $pertemuan->kuis->id) }}" class="btn-start-quiz disabled" id="btn-quiz" onclick="return false;">
                        <i class="fas fa-clock"></i> Tunggu <span id="timer">15</span>s
                    </a>
                </div>
            </div>
        @endif

        <!-- Navigation Buttons (Future) -->
        <div class="reader-footer">
            <button class="btn-secondary" onclick="window.history.back()">Selesai Membaca</button>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const btnQuiz = document.getElementById('btn-quiz');
            const timerSpan = document.getElementById('timer');
            
            if (btnQuiz) {
                let timeLeft = 15;
                
                const countdown = setInterval(() => {
                    timeLeft--;
                    timerSpan.innerText = timeLeft;
                    
                    if (timeLeft <= 0) {
                        clearInterval(countdown);
                        btnQuiz.classList.remove('disabled');
                        btnQuiz.innerHTML = 'Mulai Kuis';
                        btnQuiz.onclick = null; // Remove the prevent default handler
                    }
                }, 1000);
            }
        });
    </script>

    <style>
        .quiz-section {
            margin-top: 3rem;
            border-top: 2px dashed #eee;
            padding-top: 2rem;
        }

        .quiz-card {
            background: #fff3e0;
            border: 1px solid #ffe0b2;
            padding: 1.5rem;
            border-radius: 12px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .quiz-info h3 {
            color: #ef6c00;
            margin: 0 0 0.5rem 0;
            font-size: 1.2rem;
        }

        .quiz-info p {
            margin: 0;
            color: #e65100;
        }

        .btn-start-quiz {
            background: #ef6c00;
            color: white;
            padding: 0.8rem 1.5rem;
            border-radius: 8px;
            text-decoration: none;
            font-weight: bold;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-start-quiz:hover {
            background: #e65100;
            transform: translateY(-2px);
        }

        .btn-start-quiz.disabled {
            background: #ccc;
            cursor: not-allowed;
            pointer-events: none; /* Prevent clicks effectively */
            transform: none;
        }

        .back-header {
            margin-bottom: 2rem;
        }

        .btn-back {
            color: #666;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            font-weight: 500;
        }

        .content-reader {
            background: white;
            border-radius: 16px;
            padding: 3rem;
            max-width: 900px;
            margin: 0 auto;
            box-shadow: 0 4px 20px rgba(0,0,0,0.05);
        }

        .reader-header {
            text-align: center;
            margin-bottom: 3rem;
            border-bottom: 1px solid #eee;
            padding-bottom: 2rem;
        }

        .badge-pertemuan {
            background: #e3f2fd;
            color: #1565c0;
            padding: 0.4rem 1rem;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            display: inline-block;
            margin-bottom: 1rem;
        }

        .reader-header h1 {
            font-size: 2rem;
            color: #333;
            margin-bottom: 0.5rem;
        }

        .meta-info {
            color: #999;
            font-size: 0.9rem;
        }

        .video-container {
            margin-bottom: 3rem;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        .video-container iframe {
            width: 100%;
            height: 450px; /* Adjust height as needed */
            display: block;
        }

        .material-content {
            font-size: 1.1rem;
            line-height: 1.8;
            color: #444;
            text-align: justify;
        }

        .reader-footer {
            margin-top: 4rem;
            text-align: center;
            border-top: 1px solid #eee;
            padding-top: 2rem;
        }
    </style>
@endsection
