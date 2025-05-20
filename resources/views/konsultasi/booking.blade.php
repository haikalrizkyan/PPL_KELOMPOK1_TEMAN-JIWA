@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="text-center mb-5">
        <h2 class="fw-bold">Booking Konsultasi</h2>
        <p class="text-muted">Bersama <strong>{{ $psychologist->nama }}</strong></p>
    </div>

    @if(session('error'))
        <div class="alert alert-danger text-center" style="max-width: 600px; margin: 0 auto 2rem auto;">
            {{ session('error') }}
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
                    <form method="POST" action="{{ route('konsultasi.booking.store', $psychologist->id) }}">
                        @csrf

                        <div class="mb-4">
                            <label for="tanggal" class="form-label fw-semibold">📅 Tanggal Konsultasi</label>
                            <input type="date" name="tanggal" id="tanggal" class="form-control @error('tanggal') is-invalid @enderror" required min="{{ date('Y-m-d') }}">
                            @error('tanggal')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="jam" class="form-label fw-semibold">⏰ Jam Konsultasi</label>
                            <input type="time" name="jam" id="jam" class="form-control @error('jam') is-invalid @enderror" required>
                            @error('jam')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="catatan" class="form-label fw-semibold">📝 Catatan (Opsional)</label>
                            <textarea name="catatan" id="catatan" class="form-control @error('catatan') is-invalid @enderror" rows="3" placeholder="Contoh: Saya ingin membahas tentang kecemasan..."></textarea>
                            @error('catatan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg rounded-pill" {{ Auth::user()->saldo < $psychologist->biaya_konsultasi ? 'disabled' : '' }}>
                                Booking Sekarang 🚀
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
@endsection