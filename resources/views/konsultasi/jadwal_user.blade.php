@extends('layouts.app')

@section('title', 'Jadwal Konsultasi - Teman Jiwa')

@php use Carbon\Carbon; @endphp

@section('content')
<div class="container">
    <h2 class="mb-4">Jadwal Konsultasi Saya</h2>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    <div class="row">
        @forelse($bookings as $booking)
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $booking->psychologist->nama }}</h5>
                        <p class="card-text mb-1"><strong>Tanggal:</strong> {{ Carbon::parse($booking->tanggal)->format('d M Y') }}</p>
                        <p class="card-text mb-1"><strong>Jam:</strong> {{ $booking->jam }}</p>
                        <p class="card-text mb-1">
                            <strong>Status:</strong> 
                            <span class="badge {{ $booking->status === 'paid' ? 'bg-success' : 'bg-warning' }}">
                                {{ $booking->status === 'paid' ? 'Terkonfirmasi' : ucfirst($booking->status) }}
                            </span>
                        </p>
                        <p class="card-text mb-1"><strong>Biaya Konsultasi:</strong> Rp {{ number_format($booking->psychologist->biaya_konsultasi, 0, ',', '.') }}</p>
                        @if($booking->catatan)
                            <p class="card-text"><strong>Catatan:</strong> {{ $booking->catatan }}</p>
                        @endif
                        @if($booking->status === 'pending')
                            <div class="d-flex gap-2 mt-2">
                                <a href="{{ route('konsultasi.booking.edit', $booking->id) }}" class="btn btn-primary flex-fill">Edit</a>
                                <form method="POST" action="{{ route('konsultasi.booking.delete', $booking->id) }}" onsubmit="return confirm('Yakin ingin menghapus booking ini?')" class="flex-fill">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger w-100">Hapus</button>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info">Belum ada jadwal konsultasi.</div>
            </div>
        @endforelse
    </div>
</div>
@endsection 