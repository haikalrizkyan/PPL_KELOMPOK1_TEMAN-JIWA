@extends('layouts.app')

@section('content')
<style>
    body {
        font-family: 'Ubuntu', sans-serif !important;
        background-color: #F4FAF9 !important;
    }
    .card {
        border-radius: 1.5rem !important;
        box-shadow: 0 8px 32px 0 rgba(76,169,163,0.10) !important;
        border: none !important;
        padding: 1.5rem !important;
    }
    h2.mb-0 {
        font-weight: 700 !important;
        color: #264653 !important;
        font-size: 1.3rem !important;
        margin-bottom: 1.5rem !important;
    }
    .btn-temanjiwa {
        background: #4CA9A3 !important;
        color: #fff !important;
        font-weight: 600 !important;
        border-radius: 2rem !important;
        border: none !important;
        padding: 0.5rem 1.5rem !important;
        transition: background 0.2s !important;
    }
    .btn-temanjiwa:hover {
        background: #3D8C87 !important;
    }
    .btn-edit {
        background: #0d6efd !important; /* Bootstrap primary blue */
        color: #fff !important;
        font-weight: 500 !important;
        border-radius: 2rem !important;
        border: none !important;
        padding: 0.5rem 1.2rem !important;
        transition: background 0.2s !important;
    }
    .btn-edit:hover {
        background: #0b5ed7 !important;
    }
    .btn-success {
        background: #28a745 !important;
        color: #fff !important;
        font-weight: 500 !important;
        border-radius: 2rem !important;
        border: none !important;
        padding: 0.5rem 1.2rem !important;
        transition: background 0.2s !important;
    }
    .btn-success:hover {
        background: #218838 !important;
    }
    .btn-danger {
        background: #dc3545 !important;
        color: #fff !important;
        font-weight: 500 !important;
        border-radius: 2rem !important;
        border: none !important;
        padding: 0.5rem 1.2rem !important;
        transition: background 0.2s !important;
    }
    .btn-danger:hover {
        background: #c82333 !important;
    }
    .alert-success, .alert-danger {
        border-radius: 1rem !important;
    }
    .badge.bg-success {
        background-color: #4CA9A3 !important; /* Use temanjiwa green for Tersedia */
        border-radius: 0.5rem !important;
        padding: 0.3em 0.6em !important;
        font-weight: 600 !important;
    }
     .badge.bg-danger {
        background-color: #dc3545 !important; /* Use Bootstrap danger red for Tidak Tersedia */
        border-radius: 0.5rem !important;
        padding: 0.3em 0.6em !important;
        font-weight: 600 !important;
     }
     .table th, .table td {
        vertical-align: middle;
    }
</style>
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Kelola Jadwal Konsultasi</h2>
        <a href="{{ route('psikolog.schedule.create') }}" class="btn btn-temanjiwa" aria-label="Tambah jadwal konsultasi">
            <i class="fas fa-plus me-2"></i> Tambah Jadwal
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Tanggal</th>
                            <th>Waktu</th>
                            <th>Status</th>
                            <th style="width: 350px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($allSchedules as $schedule)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($schedule->tanggal)->format('d F Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($schedule->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($schedule->jam_selesai)->format('H:i') }}</td>
                                <td>
                                    <span class="badge {{ $schedule->is_available ? 'bg-success' : 'bg-danger' }}">
                                        {{ $schedule->is_available ? 'Tersedia' : 'Tidak Tersedia' }}
                                    </span>
                                </td>
                                <td style="width: 350px;">
                                    <div class="d-flex gap-2 justify-content-center align-items-center">
                                        <a href="{{ route('psikolog.schedule.edit', $schedule) }}" class="btn btn-edit btn-sm" aria-label="Edit jadwal">
                                            <i class="fas fa-edit me-1"></i> Edit
                                        </a>
                                        <form action="{{ route('psikolog.schedule.toggle', $schedule) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn {{ $schedule->is_available ? 'btn-danger' : 'btn-success' }} btn-sm" 
                                                    aria-label="{{ $schedule->is_available ? 'Tandai tidak tersedia' : 'Tandai tersedia' }}">
                                                <i class="fas {{ $schedule->is_available ? 'fa-times me-1' : 'fa-check me-1' }}"></i>
                                                {{ $schedule->is_available ? 'Tidak Tersedia' : 'Tersedia' }}
                                            </button>
                                        </form>
                                        <form action="{{ route('psikolog.schedule.destroy', $schedule) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" 
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus jadwal ini?')" 
                                                    aria-label="Hapus jadwal">
                                                <i class="fas fa-trash me-1"></i> Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted">Belum ada jadwal yang ditambahkan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection