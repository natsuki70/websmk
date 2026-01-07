@extends('layouts.auth')

@section('title', 'Register')

@section('content')
    <div class="auth-header">
        <h2>Buat Akun Baru</h2>
        <p>Bergabunglah bersama kami</p>
    </div>

    <form action="{{ route('register') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Nama Lengkap</label>
            <input type="text" id="name" name="name" placeholder="Masukkan nama lengkap" required>
        </div>

        <div class="form-group">
            <label for="email">Email Address</label>
            <input type="email" id="email" name="email" placeholder="Masukkan email anda" required>
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Buat password" required>
        </div>

        <div class="form-group">
            <label for="password_confirmation">Konfirmasi Password</label>
            <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Ulangi password" required>
        </div>

        <div class="form-group">
            <label style="margin-bottom: 0.8rem;">Daftar Sebagai</label>
            <div class="role-grid">
                <!-- Siswa Option -->
                <div class="role-card">
                    <input type="radio" name="role" id="role-siswa" value="siswa" checked onchange="toggleAdminCode()">
                    <label for="role-siswa" class="role-card-content">
                        <div class="role-icon"><i class="fas fa-user-graduate"></i></div>
                        <div class="role-name">Siswa</div>
                    </label>
                </div>

                <!-- Admin Option -->
                <div class="role-card">
                    <input type="radio" name="role" id="role-admin" value="admin" onchange="toggleAdminCode()">
                    <label for="role-admin" class="role-card-content">
                        <div class="role-icon"><i class="fas fa-user-shield"></i></div>
                        <div class="role-name">Admin</div>
                    </label>
                </div>
            </div>
        </div>

        <div class="form-group" id="admin-code-group" style="display: none;">
            <label for="admin_code">Kode Admin</label>
            <input type="password" id="admin_code" name="admin_code" placeholder="Masukkan kode rahasia admin">
        </div>

        <script>
            function toggleAdminCode() {
                var isAdmin = document.getElementById('role-admin').checked;
                var adminCodeGroup = document.getElementById('admin-code-group');
                if (isAdmin) {
                    adminCodeGroup.style.display = 'block';
                    document.getElementById('admin_code').required = true;
                } else {
                    adminCodeGroup.style.display = 'none';
                    document.getElementById('admin_code').required = false;
                    document.getElementById('admin_code').value = '';
                }
            }
        </script>

        <style>
            .role-grid {
                display: flex;
                gap: 1rem;
            }
            .role-card {
                flex: 1;
            }
            .role-card input {
                display: none;
            }
            .role-card-content {
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                background: rgba(255, 255, 255, 0.1);
                border: 2px solid rgba(255, 255, 255, 0.2);
                border-radius: 12px;
                padding: 1rem;
                cursor: pointer;
                transition: all 0.3s ease;
                height: 100px;
                text-align: center;
                color: #fff !important;
            }
            .role-icon {
                font-size: 1.5rem;
                margin-bottom: 0.5rem;
                color: #ccc;
            }
            .role-name {
                font-weight: 600;
            }
            .role-card input:checked + .role-card-content {
                background: rgba(237, 30, 121, 0.2);
                border-color: #ED1E79;
                box-shadow: 0 0 10px rgba(237, 30, 121, 0.4);
            }
            .role-card input:checked + .role-card-content .role-icon {
                color: #fff;
            }
            .role-card-content:hover {
                background: rgba(255, 255, 255, 0.2);
            }
        </style>

        <button type="submit" class="btn-primary">Daftar</button>
    </form>

    <div class="auth-footer">
        <p>Sudah punya akun? <a href="{{ route('login') }}">Masuk disini</a></p>
        <p><a href="{{ url('/') }}">Kembali ke Home</a></p>
    </div>
@endsection
