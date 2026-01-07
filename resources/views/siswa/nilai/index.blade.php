@extends('layouts.student')

@section('content')
    <div class="dashboard-header">
        <h2>Riwayat Nilai</h2>
        <p>Daftar hasil kuis dan latihan yang telah dikerjakan</p>
    </div>

    <div class="table-container">
        <table class="data-table">
            <thead>
                <tr>
                    <th>Mata Pelajaran</th>
                    <th>Pertemuan</th>
                    <th>Judul Kuis</th>
                    <th>Tanggal</th>
                    <th>Skor</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($nilais as $nilai)
                    <tr>
                        <td>
                            <strong>{{ $nilai->kuis?->mapel?->nama_mapel ?? '-' }}</strong>
                        </td>
                        <td>{{ $nilai->kuis?->pertemuan?->pertemuan_ke ? 'Pertemuan ' . $nilai->kuis->pertemuan->pertemuan_ke : '-' }}</td>
                        <td>{{ $nilai->kuis->judul }}</td>
                        <td>{{ $nilai->created_at->format('d M Y H:i') }}</td>
                        <td>
                            <span class="score-badge {{ $nilai->skor >= $nilai->kuis->kkm ? 'pass' : 'fail' }}">
                                {{ $nilai->skor }}
                            </span>
                        </td>
                        <td>
                            @if($nilai->skor >= $nilai->kuis->kkm)
                                <span class="status-badge status-pass">Lulus</span>
                            @else
                                <span class="status-badge status-fail">Belum Lulus</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="text-align: center; padding: 2rem;">
                            <img src="https://cdn-icons-png.flaticon.com/512/7486/7486777.png" alt="Empty" style="width: 64px; opacity: 0.5; margin-bottom: 1rem;">
                            <p style="color: #888;">Belum ada riwayat nilai.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <style>
        .table-container {
            background: white;
            border-radius: 16px;
            padding: 1.5rem;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
            overflow-x: auto;
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
            min-width: 600px;
        }

        .data-table th {
            text-align: left;
            padding: 1rem;
            border-bottom: 2px solid #f0f0f0;
            color: #888;
            font-weight: 600;
            font-size: 0.9rem;
        }

        .data-table td {
            padding: 1rem;
            border-bottom: 1px solid #f0f0f0;
            color: #333;
            vertical-align: middle;
        }

        .score-badge {
            font-weight: bold;
            font-size: 1.1rem;
        }

        .score-badge.pass {
            color: #00c853;
        }

        .score-badge.fail {
            color: #d50000;
        }

        .status-badge {
            padding: 0.4rem 0.8rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .status-pass {
            background: #e8f5e9;
            color: #2e7d32;
        }

        .status-fail {
            background: #ffebee;
            color: #c62828;
        }
    </style>
@endsection
