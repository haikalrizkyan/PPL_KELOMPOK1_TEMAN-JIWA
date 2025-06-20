@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Edit Pemesanan Konsultasi dengan {{ $booking->psychologist->nama }}</h2>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('konsultasi.booking.update', $booking->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="tanggal" class="form-label">Tanggal Konsultasi</label>
                            <input type="date" name="tanggal" id="tanggal" class="form-control @error('tanggal') is-invalid @enderror" required min="{{ date('Y-m-d') }}" value="{{ old('tanggal', $booking->tanggal) }}">
                            @error('tanggal')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="jam" class="form-label">Jam Konsultasi</label>
                            <input type="time" name="jam" id="jam" class="form-control @error('jam') is-invalid @enderror" required value="{{ old('jam', $booking->jam) }}">
                            @error('jam')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="catatan" class="form-label">Catatan (Opsional)</label>
                            <textarea name="catatan" id="catatan" class="form-control @error('catatan') is-invalid @enderror" rows="3">{{ old('catatan', $booking->catatan) }}</textarea>
                            @error('catatan')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-success w-100">Perbarui Pemesanan</button>
                        <a href="{{ route('konsultasi.jadwal.user') }}" class="btn btn-secondary w-100 mt-2">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 