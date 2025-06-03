@extends('layouts.app')

@php use Carbon\Carbon; @endphp

@section('title', 'Jadwal Konsultasi - Teman Jiwa')

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
    .btn-save {
        background: #4CA9A3;
        color: #fff;
        border: none;
    }
    .btn-save:hover {
        background: #3D8C87;
        color: #fff;
        box-shadow: 0 4px 16px 0 rgba(76,169,163,0.18);
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
    .form-control {
        border-radius: 1rem;
        border: 2px solid #E8F5F4;
        padding: 0.8rem 1.2rem;
    }
    .form-control:focus {
        border-color: #4CA9A3;
        box-shadow: 0 0 0 0.2rem rgba(76,169,163,0.15);
    }
    .form-label {
        font-weight: 600;
        color: #264653;
        margin-bottom: 0.5rem;
    }
</style>

<div class="container py-4">
    <h2 class="schedule-header">Jadwal Konsultasi Masuk</h2>
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
                        <h5 class="card-title">{{ $booking->user->nama ?? $booking->user->name }}</h5>
                        <p class="card-text mb-1"><strong>Tanggal:</strong> {{ Carbon::parse($booking->tanggal)->format('d M Y') }}</p>
                        <p class="card-text mb-1"><strong>Waktu:</strong> {{ $booking->jam }}</p>
                        <p class="card-text mb-1">
                            <strong>Status:</strong> 
                            <span class="badge badge-status {{ $booking->status === 'paid' ? 'badge-paid' : 'badge-pending' }}">
                                {{ $booking->status === 'paid' ? 'Terkonfirmasi' : ucfirst($booking->status) }}
                            </span>
                            @if($booking->completed_at)
                                <span class="badge badge-status badge-completed">Selesai</span>
                            @endif
                        </p>
                        @if($booking->catatan)
                            <p class="card-text"><strong>Catatan:</strong> {{ $booking->catatan }}</p>
                        @endif
                        <form action="{{ route('psikolog.jadwal.updateGmeetLink', $booking->id) }}" method="POST" class="mt-3">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="gmeet_link_{{ $booking->id }}" class="form-label">Link Google Meet</label>
                                <textarea class="form-control" id="gmeet_link_{{ $booking->id }}" name="gmeet_link" rows="2" placeholder="Masukkan link Google Meet">{{ $booking->gmeet_link }}</textarea>
                            </div>
                            <button type="submit" class="btn btn-action btn-save">
                                <i class="fas fa-save me-2"></i>Simpan Link
                            </button>
                        </form>

                        @if($booking->status === 'paid' && !$booking->completed_at && $booking->gmeet_link)
                            <form action="{{ route('psikolog.konsultasi.complete', $booking->id) }}" method="POST" class="mt-3">
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