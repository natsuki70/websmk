@extends('layouts.auth')

@section('title', 'Lengkapi Profil')

@section('content')
    <div class="auth-header">
        <h2>Lengkapi Profil</h2>
        <p>Satu langkah lagi untuk memulai belajar</p>
    </div>

    <form action="{{ route('siswa.onboarding.store') }}" method="POST">
        @csrf
        
        <div class="form-group">
            <label for="nisn">NISN</label>
            <input type="text" id="nisn" name="nisn" placeholder="Masukkan Nomor Induk Siswa Nasional" required>
        </div>

        <div class="form-group" style="margin-top: 1.5rem;">
            <label style="margin-bottom: 1rem;">Pilih Kelas</label>
            <div class="class-grid">
                @foreach($kelas as $k)
                    <div class="class-card">
                        <input type="radio" name="kelas_id" id="kelas-{{ $k->id }}" value="{{ $k->id }}" required>
                        <label for="kelas-{{ $k->id }}" class="class-card-content">
                            <span class="class-name">{{ $k->nama_kelas }}</span>
                            <span class="class-icon"><i class="fas fa-chalkboard-teacher"></i></span>
                        </label>
                    </div>
                @endforeach
            </div>
        </div>

        <button type="submit" class="btn-primary" style="width: 100%; margin-top: 2rem;">Mulai Belajar</button>
    </form>
    
    <style>
        .class-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(100px, 1fr));
            gap: 1rem;
        }

        .class-card input {
            display: none;
        }

        .class-card-content {
            display: flex !important;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background: rgba(255, 255, 255, 0.1);
            border: 2px solid rgba(255, 255, 255, 0.2);
            border-radius: 12px;
            padding: 1.5rem;
            cursor: pointer;
            transition: all 0.3s ease;
            height: 100%;
            text-align: center;
            color: #fff !important; /* Ensure text color is white */
        }

        .class-card input:checked + .class-card-content {
            background: rgba(237, 30, 121, 0.2);
            border-color: #ED1E79;
            box-shadow: 0 0 15px rgba(237, 30, 121, 0.4);
            transform: translateY(-2px);
        }

        .class-card-content:hover {
            background: rgba(255, 255, 255, 0.2);
        }

        .class-name {
            font-size: 1.2rem;
            font-weight: 700;
            color: #fff;
            margin-bottom: 0.5rem;
        }

        .class-icon {
            font-size: 1.5rem;
            color: #ccc;
        }

        .class-card input:checked + .class-card-content .class-icon,
        .class-card input:checked + .class-card-content .class-name {
            color: #fff;
        }
    </style>
@endsection
