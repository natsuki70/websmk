@extends('layouts.auth')

@section('title', 'Login')

@section('content')
    <div class="auth-header">
        <h2>Selamat Datang</h2>
        <p>Silakan masuk ke akun Anda</p>
    </div>

    <form action="{{ route('login') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="email">Email Address</label>
            <input type="email" id="email" name="email" placeholder="Masukkan email anda" required>
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Masukkan password anda" required>
        </div>

        <div class="form-actions">
            <label class="remember-me">
                <input type="checkbox" name="remember"> Ingat Saya
            </label>
            <a href="#" class="forgot-password">Lupa Password?</a>
        </div>

        <button type="submit" class="btn-primary">Masuk</button>
    </form>

    <div class="auth-footer">
        <p>Belum punya akun? <a href="{{ route('register') }}">Daftar disini</a></p>
        <p><a href="{{ url('/') }}">Kembali ke Home</a></p>
    </div>
@endsection
