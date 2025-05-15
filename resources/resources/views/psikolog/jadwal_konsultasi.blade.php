@extends('layouts.app')

@php use Carbon\Carbon; @endphp

@section('content')
<div class="container">
    <h2 class="mb-4">Jadwal Konsultasi Masuk</h2>
    <div class="row">
        @forelse($bookings as $booking)
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $booking->user->nama ?? $booking->user->name }}</h5>
                        <p class="card-text mb-1"><strong>Tanggal:</strong> {{ Carbon::parse($booking->tanggal)->format('d M Y') }}</p>
                        <p class="card-text mb-1"><strong>Jam:</strong> {{ $booking->jam }}</p>
                        <p class="card-text mb-1"><strong>Status:</strong> {{ ucfirst($booking->status) }}</p>
                        @if($booking->catatan)
                            <p class="card-text"><strong>Catatan:</strong> {{ $booking->catatan }}</p>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info">Belum ada jadwal konsultasi yang dibooking.</div>
            </div>
        @endforelse
    </div>
</div>
@endsection 