@extends('layouts.admin')

@section('content')
    <div class="dashboard-header">
        <h2>Manajemen Siswa</h2>
        <p>Kelola data siswa di sini</p>
    </div>

    <div class="action-bar">
        <a href="#" class="btn-add"><i class="fas fa-plus"></i> Tambah Siswa</a>
        <div class="search-box">
            <input type="text" placeholder="Cari siswa...">
            <button><i class="fas fa-search"></i></button>
        </div>
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
                    <th>Nama Lengkap</th>
                    <th>NISN</th>
                    <th>Kelas</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($siswas as $siswa)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $siswa->name }}</td>
                    <td>{{ $siswa->nisn }}</td>
                    <td>{{ $siswa->kelas->nama_kelas ?? '-' }}</td>
                    <td>
                        <form action="{{ route('admin.siswa.destroy', $siswa->id) }}" method="POST" onsubmit="return confirm('Yakin hapus?')" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-icon btn-delete" style="border:none; cursor:pointer;"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="text-align:center;">Belum ada data siswa.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Add Siswa Modal -->
    <div id="addModal" class="modal" style="display:none;">
        <div class="modal-content">
            <span class="close-btn" onclick="document.getElementById('addModal').style.display='none'">&times;</span>
            <h3>Tambah Siswa Baru</h3>
            <form action="{{ route('admin.siswa.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input type="text" name="name" required>
                </div>
                <div class="form-group">
                    <label>NISN</label>
                    <input type="text" name="nisn" required>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" required>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" required>
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
