@extends('layouts.app')

@php use Carbon\Carbon; @endphp

@section('title', 'Jadwal Konsultasi - Teman Jiwa')

@section('content')
<style>
    body {
        font-family: 'Ubuntu', sans-serif !important;
        background-color: #F4FAF9 !important;
    }
    .schedule-card {
        border-radius: 1.5rem !important;
        box-shadow: 0 8px 32px 0 rgba(76,169,163,0.10) !important;
        background: #fff !important;
        padding: 1.5rem 1.5rem 1.2rem 1.5rem;
    }
    .schedule-header {
        font-weight: 700;
        color: #264653;
        font-size: 1.3rem;
        margin-bottom: 1.5rem;
    }
    .alert-info {
        border-radius: 1rem;
        font-size: 1rem;
        background: #e3f8fa;
        color: #264653;
        border: none;
    }
</style>
<div class="container py-4">
    <h2 class="schedule-header mb-4">Jadwal Konsultasi Masuk</h2>
    <div class="row">
        @forelse($bookings as $booking)
            <div class="col-md-6 mb-4">
                <div class="card schedule-card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $booking->user->nama ?? $booking->user->name }}</h5>
                        <p class="card-text mb-1"><strong>Tanggal:</strong> {{ Carbon::parse($booking->tanggal)->format('d M Y') }}</p>
                        <p class="card-text mb-1"><strong>Waktu:</strong> {{ $booking->jam }}</p>
                        <p class="card-text mb-1"><strong>Status:</strong> {{ ucfirst($booking->status) }}</p>
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
                            <button type="submit" class="btn btn-primary btn-sm">Simpan Link</button>
                        </form>
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