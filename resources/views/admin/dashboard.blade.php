@extends('layouts.admin')

@section('content')
    <div class="dashboard-header">
        <h2>Dashboard</h2>
        <p>Ringkasan statistik website pembelajaran</p>
    </div>

    <!-- Stats Grid -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon icon-purple">
                <i class="fas fa-users"></i>
            </div>
            <div class="stat-info">
                <h3>Total Siswa</h3>
                <p>120</p>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon icon-magenta">
                <i class="fas fa-chalkboard"></i>
            </div>
            <div class="stat-info">
                <h3>Total Kelas</h3>
                <p>5</p>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon icon-blue">
                <i class="fas fa-clipboard-check"></i>
            </div>
            <div class="stat-info">
                <h3>Kuis Aktif</h3>
                <p>8</p>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon icon-green">
                <i class="fas fa-user-clock"></i>
            </div>
            <div class="stat-info">
                <h3>Online</h3>
                <p>3</p>
            </div>
        </div>
    </div>

    <!-- Recent Activity Section (Example) -->
    <div class="recent-section">
        <h3>Aktivitas Terbaru</h3>
        <div class="activity-list">
            <div class="activity-item">
                <div class="activity-icon"><i class="fas fa-user-plus"></i></div>
                <div class="activity-desc">
                    <strong>Ahmad Rizki</strong> mendaftar sebagai siswa baru.
                    <span>5 menit yang lalu</span>
                </div>
            </div>
            <div class="activity-item">
                <div class="activity-icon"><i class="fas fa-file-upload"></i></div>
                <div class="activity-desc">
                    <strong>Pak Budi</strong> mengupload materi baru di Kelas X TKJ 1.
                    <span>1 jam yang lalu</span>
                </div>
            </div>
        </div>
    </div>
@endsection
