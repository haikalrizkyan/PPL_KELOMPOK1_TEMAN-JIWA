@extends('layouts.app')

@php use Carbon\Carbon; @endphp

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
    <h2 class="schedule-header mb-4">Incoming Consultation Schedule</h2>
    <div class="row">
        @forelse($bookings as $booking)
            <div class="col-md-6 mb-4">
                <div class="card schedule-card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $booking->user->nama ?? $booking->user->name }}</h5>
                        <p class="card-text mb-1"><strong>Date:</strong> {{ Carbon::parse($booking->tanggal)->format('d M Y') }}</p>
                        <p class="card-text mb-1"><strong>Time:</strong> {{ $booking->jam }}</p>
                        <p class="card-text mb-1"><strong>Status:</strong> {{ ucfirst($booking->status) }}</p>
                        @if($booking->catatan)
                            <p class="card-text"><strong>Note:</strong> {{ $booking->catatan }}</p>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info text-center">No consultation schedule has been booked yet.</div>
            </div>
        @endforelse
    </div>
</div>
@endsection 