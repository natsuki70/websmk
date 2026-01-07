@extends('layouts.admin')

@section('title', 'Buat Kuis Baru')

@section('content')
    <div class="page-header">
        <div>
            <h1>Buat Kuis Baru</h1>
            <p>Atur detail kuis, mapel, dan KKM</p>
        </div>
        <a href="{{ route('admin.kuis.index') }}" class="btn-secondary">&larr; Kembali</a>
    </div>

    <div class="table-container" style="max-width: 800px;">
        <form action="{{ route('admin.kuis.store') }}" method="POST">
            @csrf
            
            <div class="form-group">
                <label>Judul Kuis</label>
                <input type="text" name="judul" required placeholder="Contoh: Ulangan Harian Bab 1">
            </div>

            <div class="form-group">
                <label>Mata Pelajaran</label>
                <select name="mapel_id" id="mapelSelect" required onchange="filterPertemuan()">
                    <option value="">-- Pilih Mapel --</option>
                    @foreach($mapels as $m)
                        <option value="{{ $m->id }}" data-pertemuans='{{ json_encode($m->pertemuans) }}'>
                            {{ $m->nama_mapel }} - {{ $m->kode_mapel }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Pembahasan / Pertemuan (Opsional)</label>
                <select name="pertemuan_id" id="pertemuanSelect">
                    <option value="">-- Pilih Pertemuan --</option>
                    <!-- Populated via JS -->
                </select>
                <small style="color: #666;">Pilih mapel dulu untuk melihat daftar pertemuan.</small>
            </div>

            <div class="form-group">
                <label>Kelas (Opsional - Kosongkan jika untuk semua kelas)</label>
                <select name="kelas_id">
                    <option value="">-- Semua Kelas --</option>
                    @foreach($kelas as $k)
                        <option value="{{ $k->id }}">{{ $k->nama_kelas }}</option>
                    @endforeach
                </select>
            </div>

            <div class="row" style="display: flex; gap: 2rem;">
                <div class="form-group" style="flex: 1;">
                    <label>KKM (Nilai Minimal)</label>
                    <input type="number" name="kkm" value="75" required min="0" max="100">
                </div>
                <div class="form-group" style="flex: 1;">
                    <label>Durasi (Menit)</label>
                    <input type="number" name="durasi_menit" value="60" required min="1">
                </div>
            </div>

            <div class="form-group">
                <label>Status</label>
                <select name="status" required>
                    <option value="aktif">Aktif</option>
                    <option value="non-aktif">Non-Aktif</option>
                </select>
            </div>

            <div style="margin-top: 2rem;">
                <button type="submit" class="btn-primary">Lanjut: Buat Soal &rarr;</button>
            </div>
        </form>
    </div>

    <script>
        function filterPertemuan() {
            const mapelSelect = document.getElementById('mapelSelect');
            const pertemuanSelect = document.getElementById('pertemuanSelect');
            const selectedOption = mapelSelect.options[mapelSelect.selectedIndex];
            
            pertemuanSelect.innerHTML = '<option value="">-- Pilih Pertemuan --</option>';

            if (selectedOption.value) {
                const pertemuans = JSON.parse(selectedOption.getAttribute('data-pertemuans'));
                pertemuans.forEach(p => {
                    const option = document.createElement('option');
                    option.value = p.id;
                    option.textContent = `Pertemuan ${p.pertemuan_ke}: ${p.pembahasan}`;
                    pertemuanSelect.appendChild(option);
                });
            }
        }
    </script>
@endsection
