@extends('layouts.admin')

@section('content')
    <div class="dashboard-header">
        <h2>Manajemen Mata Pelajaran</h2>
        <p>Daftar mata pelajaran yang diajarkan</p>
    </div>

    <div class="action-bar">
        <a href="#" class="btn-add"><i class="fas fa-plus"></i> Tambah Mapel</a>
    </div>

    <div class="table-container">
        @if(session('success'))
            <div class="alert alert-success" style="padding: 1rem; background: #d1fae5; color: #065f46; margin-bottom: 1rem; border-radius: 8px;">
                {{ session('success') }}
            </div>
        @endif

        <table class="admin-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Mata Pelajaran</th>
                    <th>Kelas</th>
                    <th>Kode Mapel</th>
                    <th>Guru Pengampu</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($mapels as $mapel)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $mapel->nama_mapel }}</td>
                    <td>{{ $mapel->kelas->nama_kelas ?? '-' }}</td>
                    <td>{{ $mapel->kode_mapel }}</td>
                    <td>{{ $mapel->guru_pengampu }}</td>
                    <td>
                        <a href="{{ route('admin.mapel.show', $mapel->id) }}" class="btn-icon" style="color: #662D8C;" title="Lihat Detail"><i class="fas fa-eye"></i></a>
                        <a href="{{ route('admin.mapel.edit', $mapel->id) }}" class="btn-icon" style="color: #F89C25;" title="Edit"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('admin.mapel.destroy', $mapel->id) }}" method="POST" onsubmit="return confirm('Yakin hapus?')" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-icon btn-delete" style="border:none; cursor:pointer;"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="text-align:center;">Belum ada data mata pelajaran.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Add Mapel Modal -->
    <div id="addModal" class="modal" style="display:none;">
        <div class="modal-content">
            <span class="close-btn" onclick="document.getElementById('addModal').style.display='none'">&times;</span>
            <h3>Tambah Mata Pelajaran</h3>
            <form action="{{ route('admin.mapel.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>Nama Mapel</label>
                    <input type="text" name="nama_mapel" required>
                </div>
                <div class="form-group">
                    <label>Kelas</label>
                    <select name="kelas_id" required style="width: 100%; padding: 0.8rem; border-radius: 8px; border: 1px solid #ddd;">
                        <option value="">Pilih Kelas</option>
                        @foreach($kelas as $k)
                            <option value="{{ $k->id }}">{{ $k->nama_kelas }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Kode Mapel</label>
                    <input type="text" name="kode_mapel" required>
                </div>
                <div class="form-group">
                    <label>Guru Pengampu</label>
                    <input type="text" name="guru_pengampu" required>
                </div>
                <button type="submit" class="btn-primary">Simpan</button>
            </form>
        </div>
    </div>

    <script>
        document.querySelector('.btn-add').addEventListener('click', function(e) {
            e.preventDefault();
            document.getElementById('addModal').style.display = 'flex';
        });
    </script>
@endsection
