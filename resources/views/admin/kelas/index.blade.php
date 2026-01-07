@extends('layouts.admin')

@section('content')
    <div class="dashboard-header">
        <h2>Manajemen Kelas</h2>
        <p>Daftar kelas dan wali kelas</p>
    </div>

    <div class="action-bar">
        <a href="#" class="btn-add"><i class="fas fa-plus"></i> Tambah Kelas</a>
    </div>

    <div class="table-container">
        @if(session('success'))
            <div class="alert alert-success" style="padding: 1rem; background: #d1fae5; color: #065f46; margin-bottom: 1rem; border-radius: 8px;">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger" style="padding: 1rem; background: #fee2e2; color: #991b1b; margin-bottom: 1rem; border-radius: 8px;">
                {{ session('error') }}
            </div>
        @endif

        <table class="admin-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Kelas</th>
                    <th>Wali Kelas</th>
                    <th>Total Siswa</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($kelas as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->nama_kelas }}</td>
                    <td>{{ $item->wali_kelas }}</td>
                    <td>{{ $item->siswas_count ?? 0 }}</td>
                    <td>
                        <form action="{{ route('admin.kelas.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin hapus?')" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-icon btn-delete" style="border:none; cursor:pointer;"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="text-align:center;">Belum ada data kelas.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Simple Add Modal (Inline for simplicity) -->
    <div id="addModal" class="modal" style="display:none;">
        <div class="modal-content">
            <span class="close-btn" onclick="document.getElementById('addModal').style.display='none'">&times;</span>
            <h3>Tambah Kelas Baru</h3>
            <form action="{{ route('admin.kelas.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>Nama Kelas</label>
                    <input type="text" name="nama_kelas" required placeholder="Contoh: X TKJ 1">
                </div>
                <div class="form-group">
                    <label>Wali Kelas</label>
                    <input type="text" name="wali_kelas" required placeholder="Nama Wali Kelas">
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
