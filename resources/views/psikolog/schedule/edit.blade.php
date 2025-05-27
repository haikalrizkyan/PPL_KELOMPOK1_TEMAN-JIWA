@extends('layouts.app')

@section('title', 'Edit Jadwal- Teman Jiwa')

@section('content')
<style>
    body {
        font-family: 'Ubuntu', sans-serif !important;
        background-color: #F4FAF9 !important;
    }
    .card {
        border-radius: 1.5rem;
        box-shadow: 0 8px 32px 0 rgba(76,169,163,0.10);
        border: none;
        padding: 1.5rem;
    }
    .card-header {
        background-color: #fff;
        color: #264653;
        font-weight: 700;
        font-size: 1.3rem;
        border-bottom: none;
        padding: 1rem 1.5rem 0.5rem 1.5rem;
        margin-bottom: 1.5rem;
        text-align: center;
    }
    .form-label {
        color: #264653;
        font-weight: 500;
    }
    .form-control:focus {
        border-color: #4CA9A3;
        box-shadow: 0 0 0 0.2rem rgba(76,169,163,0.15);
    }
    .btn-temanjiwa {
        background: #4CA9A3;
        color: #fff;
        font-weight: 600;
        border-radius: 2rem;
        border: none;
        transition: background 0.2s;
        padding-left: 1.5rem;
        padding-right: 1.5rem;
    }
    .btn-temanjiwa:hover {
        background: #3D8C87;
        color: #fff;
    }
    .btn-secondary {
        border-radius: 2rem;
        padding-left: 1.5rem;
        padding-right: 1.5rem;
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
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header">Edit Jadwal Konsultasi</div>
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2 class="card-title mb-0" style="visibility: hidden; height: 0;">Edit Jadwal Konsultasi</h2>
                        <a href="{{ route('psikolog.schedule.index') }}" class="btn btn-secondary ms-auto">
                            <i class="fas fa-arrow-left me-2"></i> Kembali
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
                            <i class="fas fa-info-circle me-2"></i>
                            Pastikan jadwal yang Anda edit tidak bertabrakan dengan jadwal yang sudah ada.
                        </div>

                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-temanjiwa" aria-label="Simpan perubahan jadwal">
                                <i class="fas fa-save me-2"></i> Simpan Perubahan
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