@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="text-center mb-5">
        <h2 class="fw-bold">Booking Konsultasi</h2>
        <p class="text-muted">Bersama <strong>{{ $psychologist->nama }}</strong></p>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-7">
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
                            <button type="submit" class="btn btn-primary btn-lg rounded-pill">
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
