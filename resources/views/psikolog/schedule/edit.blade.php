@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2 class="card-title mb-0">Edit Jadwal Konsultasi</h2>
                        <a href="{{ route('psikolog.schedule.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('psikolog.schedule.update', $schedule) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="tanggal" class="form-label">Tanggal</label>
                            <input type="date" class="form-control @error('tanggal') is-invalid @enderror" 
                                id="tanggal" name="tanggal" 
                                value="{{ old('tanggal', $schedule->tanggal->format('Y-m-d')) }}" 
                                min="{{ date('Y-m-d') }}" required>
                            @error('tanggal')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="jam_mulai" class="form-label">Jam Mulai</label>
                                <input type="time" class="form-control @error('jam_mulai') is-invalid @enderror" 
                                    id="jam_mulai" name="jam_mulai" 
                                    value="{{ old('jam_mulai', $schedule->jam_mulai->format('H:i')) }}" required>
                                @error('jam_mulai')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="jam_selesai" class="form-label">Jam Selesai</label>
                                <input type="time" class="form-control @error('jam_selesai') is-invalid @enderror" 
                                    id="jam_selesai" name="jam_selesai" 
                                    value="{{ old('jam_selesai', $schedule->jam_selesai->format('H:i')) }}" required>
                                @error('jam_selesai')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="alert alert-info">
                            <i class="fas fa-info-circle"></i>
                            Pastikan jadwal yang Anda edit tidak bertabrakan dengan jadwal yang sudah ada.
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const jamMulai = document.getElementById('jam_mulai');
        const jamSelesai = document.getElementById('jam_selesai');

        jamMulai.addEventListener('change', function() {
            if (jamSelesai.value && jamSelesai.value <= jamMulai.value) {
                jamSelesai.value = '';
                alert('Jam selesai harus lebih besar dari jam mulai');
            }
        });

        jamSelesai.addEventListener('change', function() {
            if (jamSelesai.value <= jamMulai.value) {
                jamSelesai.value = '';
                alert('Jam selesai harus lebih besar dari jam mulai');
            }
        });
    });
</script>
@endpush
@endsection 