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
        padding: 2rem 1.5rem 1.5rem 1.5rem !important;
    }
    .card.h-100 {
        border-radius: 1rem !important;
        box-shadow: 0 4px 16px 0 rgba(76,169,163,0.08) !important;
        padding: 1rem !important;
    }
    h2.mb-0 {
        font-weight: 700 !important;
        color: #264653 !important;
        font-size: 1.3rem !important;
        margin-bottom: 1.5rem !important;
    }
    .btn-primary {
        background: #4CA9A3 !important;
        color: #fff !important;
        font-weight: 600 !important;
        border-radius: 2rem !important;
        border: none !important;
        padding: 0.5rem 1.5rem !important;
        transition: background 0.2s !important;
    }
    .btn-primary:hover {
        background: #3D8C87 !important;
    }
    .btn-success, .btn-danger {
        border-radius: 2rem !important;
        padding: 0.5rem 1.2rem !important; /* Konsisten dengan btn-sm */
        font-weight: 500 !important;
        transition: background 0.2s !important;
    }
    .btn-success {
        background: #28a745 !important;
    }
    .btn-success:hover {
        background: #218838 !important;
    }
    .btn-danger {
        background: #dc3545 !important;
    }
    .btn-danger:hover {
        background: #c82333 !important;
    }
    .alert-success, .alert-danger {
        border-radius: 1rem !important;
    }
    .badge.bg-success, .badge.bg-danger {
        background-color: #4CA9A3 !important;
        border-radius: 0.5rem !important;
        padding: 0.3em 0.6em !important;
        font-weight: 600 !important;
    }
</style>
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Kelola Jadwal Konsultasi</h2>
        <a href="{{ route('psikolog.schedule.create') }}" class="btn btn-primary" aria-label="Tambah jadwal konsultasi">
            <i class="fas fa-plus"></i> Tambah Jadwal
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
            @forelse($schedules as $tanggal => $jadwalHarian)
                <div class="mb-4">
                    <h4 class="border-bottom pb-2 mb-3">{{ \Carbon\Carbon::parse($tanggal)->format('d F Y') }}</h4>
                    <div class="row">
                        @foreach($jadwalHarian as $schedule)
                            <div class="col-md-6 col-lg-4 mb-3">
                                <div class="card h-100 {{ $schedule->is_available ? 'border-success' : 'border-danger' }}">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-start mb-2">
                                            <h5 class="card-title mb-0">
                                                {{ \Carbon\Carbon::parse($schedule->jam_mulai)->format('H:i') }} - 
                                                {{ \Carbon\Carbon::parse($schedule->jam_selesai)->format('H:i') }}
                                            </h5>
                                            <span class="badge {{ $schedule->is_available ? 'bg-success' : 'bg-danger' }}">
                                                {{ $schedule->is_available ? 'Tersedia' : 'Tidak Tersedia' }}
                                            </span>
                                        </div>
                                        <div class="btn-group w-100">
                                            <a href="{{ route('psikolog.schedule.edit', $schedule) }}" class="btn btn-primary btn-sm" aria-label="Edit jadwal">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                            <form action="{{ route('psikolog.schedule.toggle', $schedule) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn {{ $schedule->is_available ? 'btn-danger btn-sm' : 'btn-success btn-sm' }}" 
                                                        aria-label="{{ $schedule->is_available ? 'Tandai tidak tersedia' : 'Tandai tersedia' }}">
                                                    <i class="fas {{ $schedule->is_available ? 'fa-times' : 'fa-check' }}"></i>
                                                    {{ $schedule->is_available ? 'Tidak Tersedia' : 'Tersedia' }}
                                                </button>
                                            </form>
                                            <form action="{{ route('psikolog.schedule.destroy', $schedule) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" 
                                                        onclick="return confirm('Apakah Anda yakin ingin menghapus jadwal ini?')" 
                                                        aria-label="Hapus jadwal">
                                                    <i class="fas fa-trash"></i> Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @empty
                <div class="text-center py-4">
                    <i class="fas fa-calendar-times fa-3x text-muted mb-3"></i>
                    <p class="text-muted">Belum ada jadwal yang ditambahkan.</p>
                    <a href="{{ route('psikolog.schedule.create') }}" class="btn btn-primary" aria-label="Tambah jadwal pertama">
                        <i class="fas fa-plus"></i> Tambah Jadwal Pertama
                    </a>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection