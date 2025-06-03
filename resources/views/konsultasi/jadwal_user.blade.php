@extends('layouts.app')

@section('title', 'Jadwal Konsultasi - Teman Jiwa')

@php use Carbon\Carbon; @endphp

@section('content')
<style>
    .schedule-card {
        border-radius: 1.5rem;
        box-shadow: 0 8px 32px 0 rgba(76,169,163,0.10);
        border: none;
        transition: transform 0.2s, box-shadow 0.2s;
    }
    .schedule-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 36px 0 rgba(76,169,163,0.18);
    }
    .schedule-header {
        font-weight: 700;
        color: #264653;
        font-size: 1.3rem;
        margin-bottom: 1.5rem;
    }
    .badge-status {
        font-size: 0.9em;
        border-radius: 1rem;
        padding: 0.3em 0.8em;
        font-weight: 600;
    }
    .badge-paid {
        background: #66BB6A !important;
        color: #fff !important;
    }
    .badge-pending {
        background: #FFC107 !important;
        color: #fff !important;
    }
    .badge-completed {
        background: #4CA9A3 !important;
        color: #fff !important;
    }
    .btn-action {
        border-radius: 2rem;
        font-weight: 600;
        padding: 0.6rem 1.5rem;
        transition: all 0.2s;
    }
    .btn-edit {
        background: #4CA9A3;
        color: #fff;
        border: none;
    }
    .btn-edit:hover {
        background: #3D8C87;
        color: #fff;
        box-shadow: 0 4px 16px 0 rgba(76,169,163,0.18);
    }
    .btn-delete {
        background: #DC3545;
        color: #fff;
        border: none;
    }
    .btn-delete:hover {
        background: #BB2D3B;
        color: #fff;
        box-shadow: 0 4px 16px 0 rgba(220,53,69,0.18);
    }
    .btn-complete {
        background: #28A745;
        color: #fff;
        border: none;
    }
    .btn-complete:hover {
        background: #218838;
        color: #fff;
        box-shadow: 0 4px 16px 0 rgba(40,167,69,0.18);
    }
</style>

<div class="container py-4">
    <h2 class="schedule-header">Jadwal Konsultasi Saya</h2>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    <div class="row">
        @forelse($bookings as $booking)
            <div class="col-md-6 mb-4">
                <div class="card schedule-card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $booking->psychologist->nama }}</h5>
                        <p class="card-text mb-1"><strong>Tanggal:</strong> {{ Carbon::parse($booking->tanggal)->format('d M Y') }}</p>
                        <p class="card-text mb-1"><strong>Jam:</strong> {{ $booking->jam }}</p>
                        <p class="card-text mb-1">
                            <strong>Status:</strong> 
                            <span class="badge badge-status {{ $booking->status === 'paid' ? 'badge-paid' : 'badge-pending' }}">
                                {{ $booking->status === 'paid' ? 'Terkonfirmasi' : ucfirst($booking->status) }}
                            </span>
                            @if($booking->completed_at)
                                <span class="badge badge-status badge-completed">Selesai</span>
                            @endif
                        </p>
                        <p class="card-text mb-1"><strong>Biaya Konsultasi:</strong> Rp {{ number_format($booking->psychologist->biaya_konsultasi, 0, ',', '.') }}</p>
                        @if($booking->catatan)
                            <p class="card-text"><strong>Catatan:</strong> {{ $booking->catatan }}</p>
                        @endif
                        @if($booking->gmeet_link)
                            <p class="card-text mb-1"><strong>Link Konsultasi:</strong> <a href="{{ $booking->gmeet_link }}" target="_blank" class="text-primary">{{ $booking->gmeet_link }}</a></p>
                        @endif
                        @if($booking->status === 'pending')
                            <div class="d-flex gap-2 mt-3">
                                <a href="{{ route('konsultasi.booking.edit', $booking->id) }}" class="btn btn-action btn-edit flex-fill">
                                    <i class="fas fa-edit me-2"></i>Edit
                                </a>
                                <form method="POST" action="{{ route('konsultasi.booking.delete', $booking->id) }}" onsubmit="return confirm('Yakin ingin menghapus booking ini?')" class="flex-fill">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-action btn-delete w-100">
                                        <i class="fas fa-trash me-2"></i>Hapus
                                    </button>
                                </form>
                            </div>
                        @endif

                        @if($booking->status === 'paid' && !$booking->completed_at && $booking->gmeet_link)
                            <form action="{{ route('konsultasi.complete', $booking->id) }}" method="POST" class="mt-3">
                                @csrf
                                <button type="submit" class="btn btn-action btn-complete w-100">
                                    <i class="fas fa-check-circle me-2"></i>Selesai Konsultasi
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info text-center">Belum ada jadwal konsultasi yang dipesan.</div>
            </div>
        @endforelse
    </div>
</div>
@endsection 