@extends('layouts.student')

@section('content')
    <div class="dashboard-header">
        <h2>Dashboard Siswa</h2>
        <p>Selamat datang kembali, semangat belajar!</p>
    </div>

    <!-- Stats Grid -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon icon-purple">
                <i class="fas fa-book-open"></i>
            </div>
            <div class="stat-info">
                <h3>Mata Pelajaran</h3>
                <p>{{ $mapelCount }}</p>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon icon-magenta">
                <i class="fas fa-tasks"></i>
            </div>
            <div class="stat-info">
                <h3>Kuis Tersedia</h3>
                <p>{{ $kuisCount }}</p>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon icon-blue">
                <i class="fas fa-trophy"></i>
            </div>
            <div class="stat-info">
                <h3>Rata-rata Nilai</h3>
                <p>85</p>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon icon-green">
                <i class="fas fa-clock"></i>
            </div>
            <div class="stat-info">
                <h3>Waktu Belajar</h3>
                <p>24 Jam</p>
            </div>
        </div>
    </div>

    <!-- Recent Activity Section (Example) -->
    <div class="recent-section">
        <h3>Aktivitas Terbaru Anda</h3>
        <div class="activity-list">
            <div class="activity-item">
                <div class="activity-icon"><i class="fas fa-check-circle"></i></div>
                <div class="activity-desc">
                    <strong>Anda</strong> menyelesaikan kuis Matematika.
                    <span>10 menit yang lalu</span>
                </div>
            </div>
            <div class="activity-item">
                <div class="activity-icon"><i class="fas fa-book"></i></div>
                <div class="activity-desc">
                    <strong>Anda</strong> membuka materi Bahasa Indonesia.
                    <span>1 jam yang lalu</span>
                </div>
            </div>
        </div>
    </div>
@endsection
