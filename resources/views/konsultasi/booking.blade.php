@extends('layouts.app')

@section('content')
<style>
    body {
        background-color: #F5FAFA !important; /* Sinkronisasi dengan aplikasi */
    }
    .card {
        border-radius: 1.5rem;
        box-shadow: 0 8px 32px 0 rgba(76,169,163,0.10);
        border: none;
    }
    .card-header {
        background-color: #4CA9A3;
        color: #fff;
        border-radius: 1.5rem 1.5rem 0 0 !important;
    }
    .btn-primary {
        background-color: #4CA9A3;
        border: none;
        border-radius: 2rem;
        transition: background 0.2s;
    }
    .btn-primary:hover {
        background-color: #3D8C87;
    }
    .alert-danger, .alert-warning, .alert-info {
        border-radius: 1rem;
    }
    .badge.bg-danger {
        background-color: #4CA9A3 !important;
    }
    h2.fw-bold {
        color: #264653;
    }
</style>
<div class="container py-5">
    <div class="text-center mb-5">
        <h2 class="fw-bold">Pemesanan Konsultasi ke Psikolog</h2>
        <p class="text-muted">Bersama <strong>{{ $psychologist->nama }}</strong></p>
    </div>

    @if($errors->any())
        <div class="alert alert-danger text-center" style="max-width: 600px; margin: 0 auto 2rem auto;">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card shadow-lg border-0 rounded-4 mb-4">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div>
                            <h5 class="mb-1">Biaya Konsultasi</h5>
                            <h3 class="text-primary mb-0">Rp {{ number_format($psychologist->biaya_konsultasi, 0, ',', '.') }}</h3>
                        </div>
                        <div class="text-end">
                            <h5 class="mb-1">Saldo Anda</h5>
                            <h3 class="{{ Auth::user()->saldo >= $psychologist->biaya_konsultasi ? 'text-success' : 'text-danger' }} mb-0">
                                Rp {{ number_format(Auth::user()->saldo, 0, ',', '.') }}
                            </h3>
                        </div>
                    </div>
                    @if(Auth::user()->saldo < $psychologist->biaya_konsultasi)
                        <div class="alert alert-warning mb-4">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            Saldo Anda tidak cukup untuk melakukan booking. 
                            <a href="{{ route('dashboard') }}" class="alert-link">Top up saldo</a> terlebih dahulu.
                        </div>
                    @endif
                </div>
            </div>

            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-body p-4">
                    <form method="POST" action="{{ route('konsultasi.booking.store', $psychologist->id) }}" id="bookingForm">
                        @csrf

                        <div class="mb-4">
                            <label class="form-label fw-semibold">📅 Pilih Jadwal Konsultasi</label>
                            @forelse($availableSchedules as $tanggal => $schedules)
                                <div class="card mb-3">
                                    <div class="card-header bg-light">
                                        <h6 class="mb-0">{{ \Carbon\Carbon::parse($tanggal)->format('d F Y') }}</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="row g-2">
                                            @foreach($schedules as $schedule)
                                                @php
                                                    $isBooked = $existingBookings->contains(function($booking) use ($tanggal, $schedule) {
                                                        return $booking->tanggal == $tanggal && $booking->jam == $schedule->jam_mulai->format('H:i');
                                                    });
                                                @endphp
                                                <div class="col-md-4">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" 
                                                            name="jam" id="jam_{{ $schedule->id }}" 
                                                            value="{{ $schedule->jam_mulai->format('H:i') }}"
                                                            {{ $isBooked ? 'disabled' : '' }}
                                                            required>
                                                        <input type="hidden" name="tanggal" value="{{ $tanggal }}">
                                                        <label class="form-check-label {{ $isBooked ? 'text-muted' : '' }}" for="jam_{{ $schedule->id }}">
                                                            {{ $schedule->jam_mulai->format('H:i') }} - {{ $schedule->jam_selesai->format('H:i') }}
                                                            @if($isBooked)
                                                                <span class="badge bg-danger">Sudah Dipesan</span>
                                                            @endif
                                                        </label>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="alert alert-info">
                                    <i class="fas fa-info-circle me-2"></i>
                                    Belum ada jadwal yang tersedia untuk 7 hari ke depan.
                                </div>
                            @endforelse
                        </div>

                        <div class="mb-4">
                            <label for="catatan" class="form-label fw-semibold">📝 Catatan (Opsional)</label>
                            <textarea name="catatan" id="catatan" class="form-control @error('catatan') is-invalid @enderror" 
                                rows="3" placeholder="Contoh: Saya ingin membahas tentang kecemasan...">{{ old('catatan') }}</textarea>
                            @error('catatan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg rounded-pill" 
                                {{ Auth::user()->saldo < $psychologist->biaya_konsultasi || $availableSchedules->isEmpty() ? 'disabled' : '' }}>
                                Pesan Sekarang 🚀
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="text-center mt-4 text-muted small">
                Butuh bantuan? Hubungi kami melalui <a href="#">pusat bantuan</a>.
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('bookingForm');
        const radioButtons = form.querySelectorAll('input[type="radio"]');
        const submitButton = form.querySelector('button[type="submit"]');

        radioButtons.forEach(radio => {
            radio.addEventListener('change', function() {
                if (this.checked) {
                    // Update the hidden tanggal input with the selected date
                    const tanggalInput = this.closest('.card-body').querySelector('input[name="tanggal"]');
                    form.querySelector('input[name="tanggal"]').value = tanggalInput.value;
                }
            });
        });
    });
</script>
@endpush
@endsection