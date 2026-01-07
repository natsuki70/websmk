@extends('layouts.student')

@section('content')
    <div class="quiz-container">
        <div class="quiz-progress">
            <div class="progress-info">
                <span>Soal {{ $no }} dari {{ $totalSoal }}</span>
                <span>{{ $kuis->judul }}</span>
            </div>
            <div class="progress-bar">
                <div class="progress-fill" style="width: {{ ($no / $totalSoal) * 100 }}%"></div>
            </div>
        </div>

        <div class="question-card">
            <h3 class="question-text">{{ $currentSoal->pertanyaan }}</h3>

            <form action="{{ route('siswa.kuis.answer', $kuis->id) }}" method="POST">
                @csrf
                <input type="hidden" name="soal_id" value="{{ $currentSoal->id }}">
                <input type="hidden" name="no" value="{{ $no }}">

                <div class="options-grid">
                    <label class="option-card">
                        <input type="radio" name="jawaban" value="a" required>
                        <span class="option-label">A</span>
                        <span class="option-text">{{ $currentSoal->opsi_a }}</span>
                    </label>

                    <label class="option-card">
                        <input type="radio" name="jawaban" value="b">
                        <span class="option-label">B</span>
                        <span class="option-text">{{ $currentSoal->opsi_b }}</span>
                    </label>

                    <label class="option-card">
                        <input type="radio" name="jawaban" value="c">
                        <span class="option-label">C</span>
                        <span class="option-text">{{ $currentSoal->opsi_c }}</span>
                    </label>

                    <label class="option-card">
                        <input type="radio" name="jawaban" value="d">
                        <span class="option-label">D</span>
                        <span class="option-text">{{ $currentSoal->opsi_d }}</span>
                    </label>
                </div>

                <div class="quiz-footer">
                    <button type="submit" class="btn-next">
                        {{ $no == $totalSoal ? 'Selesai' : 'Lanjut' }} <i class="fas fa-arrow-right"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <style>
        .quiz-container {
            max-width: 800px;
            margin: 0 auto;
        }

        .quiz-progress {
            margin-bottom: 2rem;
        }

        .progress-info {
            display: flex;
            justify-content: space-between;
            margin-bottom: 0.5rem;
            color: #666;
            font-weight: 500;
        }

        .progress-bar {
            height: 8px;
            background: #e0e0e0;
            border-radius: 4px;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            background: #ED1E79;
            transition: width 0.3s ease;
        }

        .question-card {
            background: white;
            padding: 2.5rem;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.05);
        }

        .question-text {
            font-size: 1.3rem;
            color: #333;
            margin-bottom: 2rem;
            line-height: 1.6;
        }

        .options-grid {
            display: grid;
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .option-card {
            display: flex;
            align-items: center;
            padding: 1rem;
            border: 2px solid #f0f0f0;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.2s;
        }

        .option-card:hover {
            border-color: #ED1E79;
            background: #fff0f6;
        }

        .option-card input[type="radio"] {
            display: none;
        }

        .option-card input[type="radio"]:checked + .option-label {
            background: #ED1E79;
            color: white;
            border-color: #ED1E79;
        }

        .option-card input[type="radio"]:checked ~ .option-text {
            font-weight: 600;
            color: #ED1E79;
        }

        /* Highlight the whole card when checked */
        .option-card:has(input[type="radio"]:checked) {
             border-color: #ED1E79;
             background: #fff0f6;
        }

        .option-label {
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px solid #ddd;
            border-radius: 50%;
            margin-right: 1rem;
            font-weight: bold;
            color: #888;
            transition: all 0.2s;
        }

        .option-text {
            font-size: 1.1rem;
            color: #555;
        }

        .quiz-footer {
            text-align: right;
            margin-top: 2rem;
            border-top: 1px solid #eee;
            padding-top: 2rem;
        }

        .btn-next {
            background: #ED1E79;
            color: white;
            border: none;
            padding: 0.8rem 2rem;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: transform 0.2s;
        }

        .btn-next:hover {
            transform: translateY(-2px);
            background: #d81b6d;
        }
    </style>
@endsection
