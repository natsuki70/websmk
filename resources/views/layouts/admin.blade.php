<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - SMK Kamal Persada Cilawu</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="dashboard-container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <h3>Admin Panel</h3>
                <p>SMK Kamal Persada</p>
            </div>
            
            <ul class="sidebar-menu">
                <li class="active">
                    <a href="{{ route('admin.dashboard') }}"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
                </li>
                <li>
                    <a href="{{ route('admin.siswa.index') }}"><i class="fas fa-users"></i> Manajemen Siswa</a>
                </li>
                <li>
                    <a href="{{ route('admin.kelas.index') }}"><i class="fas fa-chalkboard-teacher"></i> Manajemen Kelas</a>
                </li>
                <li>
                    <a href="{{ route('admin.mapel.index') }}"><i class="fas fa-book"></i> Manajemen Mata Pelajaran</a>
                </li>
                <li>
                    <a href="{{ route('admin.kuis.index') }}"><i class="fas fa-clipboard-list"></i> Manajemen Kuis</a>
                </li>
                <li class="sidebar-divider"></li>
                <li>
                    <form action="{{ route('logout') }}" method="POST" id="logout-form">
                        @csrf
                        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </a>
                    </form>
                </li>
            </ul>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <header class="topbar">
                <div class="toggle-sidebar">
                    <i class="fas fa-bars"></i>
                </div>
                <div class="user-info">
                    <span>Selamat Datang, {{ Auth::user()->name }}</span>
                    <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=662D8C&color=fff" alt="Admin Profile">
                </div>
            </header>

            <div class="content-wrapper">
                @yield('content')
            </div>
        </main>
    </div>
</body>
</html>
