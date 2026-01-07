@extends('layouts.admin')

@section('title', 'Kelola Soal Kuis')

@section('content')
    <div class="page-header">
        <div>
            <h1>{{ $kuis->judul }}</h1>
            <p>
                Mapel: {{ $kuis->mapel->nama_mapel ?? 'Mapel Tidak Ditemukan' }} | 
                KKM: <strong>{{ $kuis->kkm }}</strong> | 
                Durasi: {{ $kuis->durasi_menit }} Menit |
                Status: <span class="badge {{ $kuis->status == 'aktif' ? 'badge-success' : 'badge-danger' }}">{{ ucfirst($kuis->status) }}</span>
            </p>
        </div>
        <div>
            <a href="{{ route('admin.kuis.index') }}" class="btn-secondary" style="text-decoration: none; margin-right: 1rem;">Selesai / Kembali</a>
        </div>
    </div>

    <!-- Add Soal Section -->
    <div class="content-wrapper" style="display: flex; gap: 2rem; padding: 0;">
        
        <!-- Left: Form Input Soal -->
        <div style="flex: 1; background: #fff; padding: 1.5rem; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); height: fit-content;">
            <h3>Tambah Soal Baru</h3>
            
            @if($errors->any())
                <div class="alert alert-danger" style="padding: 0.8rem; background: #fee2e2; color: #991b1b; margin-bottom: 1rem; border-radius: 6px; font-size: 0.9rem;">
                    <ul style="margin: 0; padding-left: 1.2rem;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.soal.store') }}" method="POST">
                @csrf
                <input type="hidden" name="kuis_id" value="{{ $kuis->id }}">

                <div class="form-group">
                    <label>Pertanyaan</label>
                    <textarea name="pertanyaan" rows="3" required placeholder="Tulis pertanyaan di sini...">{{ old('pertanyaan') }}</textarea>
                </div>

                <div class="form-group">
                    <label>Opsi A</label>
                    <input type="text" name="opsi_a" required placeholder="Jawaban A" value="{{ old('opsi_a') }}">
                </div>
                <div class="form-group">
                    <label>Opsi B</label>
                    <input type="text" name="opsi_b" required placeholder="Jawaban B" value="{{ old('opsi_b') }}">
                </div>
                <div class="form-group">
                    <label>Opsi C</label>
                    <input type="text" name="opsi_c" required placeholder="Jawaban C" value="{{ old('opsi_c') }}">
                </div>
                <div class="form-group">
                    <label>Opsi D</label>
                    <input type="text" name="opsi_d" required placeholder="Jawaban D" value="{{ old('opsi_d') }}">
                </div>

                <div class="form-group">
                    <label>Kunci Jawaban Benar</label>
                    <select name="jawaban" required>
                        <option value="">-- Pilih Kunci --</option>
                        <option value="a" {{ old('jawaban') == 'a' ? 'selected' : '' }}>A</option>
                        <option value="b" {{ old('jawaban') == 'b' ? 'selected' : '' }}>B</option>
                        <option value="c" {{ old('jawaban') == 'c' ? 'selected' : '' }}>C</option>
                        <option value="d" {{ old('jawaban') == 'd' ? 'selected' : '' }}>D</option>
                    </select>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-top: 1.5rem;">
                    <button type="submit" name="action" value="next" class="btn-primary" style="width: 100%; border-radius: 8px; font-weight: bold; background: linear-gradient(135deg, #662D8C 0%, #ED1E79 100%); border: none; padding: 0.8rem;">
                        Simpan & Lanjut <i class="fas fa-arrow-right"></i>
                    </button>
                    <button type="submit" name="action" value="finish" formnovalidate class="btn-secondary" style="width: 100%; border-radius: 8px; font-weight: bold; background: #fff; border: 2px solid #662D8C; color: #662D8C; padding: 0.8rem;">
                        <i class="fas fa-check"></i> Selesai (Tanpa Simpan)
                    </button>
                </div>
                
                <div style="margin-top: 1rem; text-align: center;">
                    <small style="color: #666;">* Klik "Selesai" jika sudah tidak ingin menambah soal lagi.</small>
                </div>
            </form>
        </div>

        <!-- Right: List Soal -->
        <div style="flex: 1.5;">
            
            @if(session('success'))
                <div class="alert alert-success" style="padding: 1rem; background: #d1fae5; color: #065f46; margin-bottom: 1rem; border-radius: 8px;">
                    {{ session('success') }}
                </div>
            @endif

            <h3 style="margin-bottom: 1rem;">Daftar Soal ({{ $soals->count() }})</h3>

            @forelse($soals as $index => $soal)
                <div class="card" style="background: #fff; padding: 1rem; border-radius: 8px; margin-bottom: 1rem; border: 1px solid #eee;">
                    <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                        <div style="font-weight: bold; margin-bottom: 0.5rem; color: #662D8C;">No. {{ $index + 1 }}</div>
                        <form action="{{ route('admin.soal.destroy', $soal->id) }}" method="POST" onsubmit="return confirm('Hapus soal ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="background: none; border: none; color: #dc3545; cursor: pointer;">
                                <i class="fas fa-trash"></i> Hapus
                            </button>
                        </form>
                    </div>
                    
                    <p style="margin-bottom: 1rem; font-size: 1.05rem;">{{ $soal->pertanyaan }}</p>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0.5rem; font-size: 0.9rem;">
                        <div style="{{ $soal->jawaban == 'a' ? 'color: #10b981; font-weight: bold;' : '' }}">A. {{ $soal->opsi_a }}</div>
                        <div style="{{ $soal->jawaban == 'b' ? 'color: #10b981; font-weight: bold;' : '' }}">B. {{ $soal->opsi_b }}</div>
                        <div style="{{ $soal->jawaban == 'c' ? 'color: #10b981; font-weight: bold;' : '' }}">C. {{ $soal->opsi_c }}</div>
                        <div style="{{ $soal->jawaban == 'd' ? 'color: #10b981; font-weight: bold;' : '' }}">D. {{ $soal->opsi_d }}</div>
                    </div>
                </div>
            @empty
                <div style="text-align: center; color: #888; padding: 2rem; background: #fff; border-radius: 8px;">
                    Belum ada soal dibuat.
                </div>
            @endforelse

        </div>

    </div>
@endsection
