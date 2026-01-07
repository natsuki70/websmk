<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web Pembelajaran TKJ</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        /* Guide Section Styles */
        .guide-section {
            padding: 5rem 2rem;
            background: #f9f9f9;
            text-align: center;
        }

        .section-title {
            font-size: 2rem;
            color: #333;
            margin-bottom: 0.5rem;
            font-weight: 700;
        }

        .section-subtitle {
            color: #666;
            margin-bottom: 3rem;
            font-size: 1.1rem;
        }

        .guide-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            max-width: 1200px;
            margin: 0 auto;
        }

        .guide-card {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            transition: transform 0.3s;
            text-align: left;
            padding-bottom: 1.5rem;
        }

        .guide-card:hover {
            transform: translateY(-10px);
        }

        .card-image {
            position: relative;
            background: #eee;
            height: 200px; /* Reduced height for better card ratio */
            overflow: hidden;
        }

        .card-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: top; /* Show top part of screenshot */
            transition: transform 0.3s;
        }
        
        .guide-card:hover .card-image img {
            transform: scale(1.05);
        }

        .step-badge {
            position: absolute;
            top: 1rem;
            left: 1rem;
            width: 40px;
            height: 40px;
            background: #ED1E79;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 1.2rem;
            box-shadow: 0 4px 10px rgba(237, 30, 121, 0.4);
        }

        .guide-card h3 {
            padding: 1.5rem 1.5rem 0.5rem;
            margin: 0;
            color: #333;
            font-size: 1.3rem;
        }

        .guide-card p {
            padding: 0 1.5rem;
            color: #666;
            font-size: 0.95rem;
            line-height: 1.6;
        }
    </style>
</head>
<body>

    <nav class="navbar">
        <div class="logo">SMK Kamal Persada Cilawu</div>
        
        <div class="nav-content"> 
            <ul class="menu" id="nav-menu">
                <li class="active"><a href="{{ url('/') }}">Home</a></li>
                
                <li><a href="#" onclick="openModal(); return false;">Profil Sekolah</a></li>
                
                <!-- "Tentang Kami" removed -->
                
                <!-- Mobile Only Links -->
                <li class="nav-login-link"><a href="{{ route('login') }}" class="btn-login-small">Masuk</a></li>
                <li class="nav-login-link"><a href="{{ route('register') }}" class="btn-register-small">Register</a></li>
            </ul>
        
            <div class="nav-actions">
                <a href="{{ route('register') }}" class="btn-register-desktop">Register</a>
                <a href="{{ route('login') }}" class="btn-login-desktop">Masuk</a>
            </div>
        </div>

        <button class="menu-toggle" aria-label="Toggle navigation">
            <span class="hamburger"></span>
        </button>
    </nav>

    <section class="hero">
        <div class="hero-content">
            <h1>WEB PEMBELAJARAN TEKNIK<br>KOMPUTER DAN JARINGAN</h1>
            <p class="subtitle">
                Web pembelajaran ini digunakan sebagai media pembelajaran di jurusan
                Teknik Komputer dan Jaringan (TKJ)
            </p>

            <h2>WELCOME!</h2>
            <p class="desc">
                Selamat belajar di web pembelajaran ini, tetap semangat dalam menuntut ilmu,
                agar kelak kalian menjadi anak yang hebat dan sukses.
            </p>

            <a href="{{ route('login') }}" class="btn-login">Login</a>
        </div>
    </section>

    <!-- Modal Profil Sekolah -->
    <div id="profil-modal" class="modal">
        <div class="modal-content">
            <span class="close-btn" onclick="closeModal()">&times;</span>
            <div class="modal-header">
                <h2>PROFIL SEKOLAH</h2>
                <p class="school-name">SMK KAMAL PERSADA CILAWU</p>
            </div>
            
            <div class="modal-body">
                <div class="intro-section">
                    <p>SMK Kamal Persada Cilawu, menempati lokasi strategis di kaki Gunung Cikuray.</p>
                    <p><strong>Islamic Boarding School, Informatika, dan Kewirausahaan</strong> menjadi pilar utama. Kami berkomitmen menciptakan lulusan yang siap kerja dan berakhlak mulia.</p>
                </div>

                <div class="visi-misi-section">
                    <div class="visi">
                        <h3>VISI SEKOLAH</h3>
                        <p>Menjadi Lembaga Pendidikan Islam Unggulan, Pencetak Generasi Qur'ani, Cerdas, Mandiri dan Berjiwa Wirausaha.</p>
                    </div>
                    <div class="misi">
                        <h3>MISI SEKOLAH</h3>
                        <p>"Terciptanya Insan yang Kuat, Cerdas, dan Berakhlak Mulia"</p>
                    </div>
                </div>

                <div class="programs-section">
                    <h3>Program & Konsentrasi Keahlian</h3>
                    <div class="program-grid">
                        <div class="program-card">
                            <h4>Pengembangan Perangkat Lunak dan GIM (PPLG)</h4>
                            <p>Mencetak talenta di bidang pengembangan aplikasi, website, dan game.</p>
                        </div>
                        <div class="program-card">
                            <h4>Pemasaran E-Bisnis Digital</h4>
                            <p>Mencetak wirausahawan handal, ahli dalam pemasaran online dan e-commerce.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Guide Section -->
    <section class="guide-section">
        <h2 class="section-title">CARA MEMULAI BELAJAR</h2>
        <p class="section-subtitle">Ikuti 3 langkah mudah untuk mengakses materi pembelajaran</p>
        
        <div class="guide-grid">
            <div class="guide-card">
                <div class="card-image">
                    <img src="{{ asset('img/guide/step1_register.png') }}" alt="Register">
                    <div class="step-badge">1</div>
                </div>
                <h3>Daftar Akun</h3>
                <p>Klik tombol <strong>Register</strong>, isi nama lengkap, email, dan password. Jangan lupa pilih role sebagai <strong>Siswa</strong>.</p>
            </div>

            <div class="guide-card">
                <div class="card-image">
                    <img src="{{ asset('img/guide/step2_profile.png') }}" alt="Profile">
                    <div class="step-badge">2</div>
                </div>
                <h3>Lengkapi Profil</h3>
                <p>Masukkan <strong>NISN</strong> dan pilih <strong>Kelas</strong> Anda (10, 11, atau 12) agar sistem dapat menyesuaikan materi pembelajaran.</p>
            </div>

            <div class="guide-card">
                <div class="card-image">
                    <img src="{{ asset('img/guide/step3_dashboard.png') }}" alt="Dashboard">
                    <div class="step-badge">3</div>
                </div>
                <h3>Mulai Belajar</h3>
                <p>Masuk ke <strong>Dashboard</strong>, pilih Mata Pelajaran, baca materi, tonton video, dan kerjakan kuisnya!</p>
            </div>
        </div>
    </section>

    <footer class="footer">
        <div class="footer-content">
            <div class="footer-section about">
                <h3>Tentang Kami</h3>
                <p>Web pembelajaran ini didedikasikan untuk mendukung siswa Jurusan Teknik Komputer dan Jaringan dalam memahami materi-materi kejuruan dengan lebih mudah dan interaktif. Kami berkomitmen untuk menyediakan konten berkualitas yang dapat diakses kapan saja dan di mana saja.</p>
            </div>
            <div class="footer-section social">
                <h3>Ikuti Kami</h3>
                <div class="social-links">
                    <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i> Facebook</a>
                    <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i> Instagram</a>
                    <a href="#" aria-label="Twitter"><i class="fab fa-twitter"></i> Twitter</a>
                    <a href="#" aria-label="YouTube"><i class="fab fa-youtube"></i> YouTube</a>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            &copy; 2025 SMK Kamal Persada Cilawu. All Rights Reserved.
        </div>
    </footer>

    <!-- Script can be handled by app.js if needed, or inline for toggle -->
    <script>
        const menuToggle = document.querySelector('.menu-toggle');
        const navMenu = document.querySelector('#nav-menu');
        const modal = document.getElementById('profil-modal');

        menuToggle.addEventListener('click', () => {
            navMenu.classList.toggle('active');
        });

        function openModal() {
            modal.style.display = 'flex';
            document.body.style.overflow = 'hidden'; // Prevent scrolling
        }

        function closeModal() {
            modal.style.display = 'none';
            document.body.style.overflow = 'auto'; // Restore scrolling
        }

        // Close modal when clicking outside
        window.onclick = function(event) {
            if (event.target == modal) {
                closeModal();
            }
        }
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</body>
</html>
