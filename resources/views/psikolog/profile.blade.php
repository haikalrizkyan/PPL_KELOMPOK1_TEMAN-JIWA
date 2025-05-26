@extends('layouts.app')

@section('content')
<style>
    body {
        font-family: 'Ubuntu', sans-serif !important;
        background-color: #F4FAF9 !important;
    }
    .profile-card {
        border-radius: 1.5rem !important;
        box-shadow: 0 8px 32px 0 rgba(76,169,163,0.10) !important;
        background: #fff !important;
        padding: 2.5rem 2rem 2rem 2rem;
    }
    .profile-header {
        font-weight: 700;
        color: #264653;
        font-size: 1.5rem;
        margin-bottom: 2rem;
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
    .profile-photo-preview img {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        object-fit: cover;
        margin-bottom: 1rem;
        border: 3px solid #4CA9A3;
    }
</style>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card profile-card">
                <div class="card-header" style="background: none; border-bottom: none;">
                    <h2 class="profile-header">Edit Profil Psikolog</h2>
                </div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('psikolog.profile.update') }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="foto" class="form-label">Foto Profil</label>
                             @if($psikolog->foto_profil)
                                <div class="profile-photo-preview">
                                    <img src="{{ asset('storage/' . $psikolog->foto_profil) }}" alt="Current Profile Photo">
                                </div>
                            @endif
                            <input type="file" class="form-control" name="foto" id="foto">
                        </div>

                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Lengkap</label>
                            <input id="nama" type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{ old('nama', $psikolog->nama) }}" required>
                            @error('nama')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Alamat Email</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', $psikolog->email) }}" required>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="spesialisasi" class="form-label">Spesialisasi</label>
                            <input id="spesialisasi" type="text" class="form-control @error('spesialisasi') is-invalid @enderror" name="spesialisasi" value="{{ old('spesialisasi', $psikolog->spesialisasi) }}" required>
                            @error('spesialisasi')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="pengalaman" class="form-label">Pengalaman (tahun)</label>
                            <input id="pengalaman" type="number" class="form-control @error('pengalaman') is-invalid @enderror" name="pengalaman" value="{{ old('pengalaman', $psikolog->pengalaman) }}" required>
                            @error('pengalaman')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="biaya_konsultasi" class="form-label">Biaya Konsultasi</label>
                            <input id="biaya_konsultasi" type="number" class="form-control @error('biaya_konsultasi') is-invalid @enderror" name="biaya_konsultasi" value="{{ old('biaya_konsultasi', $psikolog->biaya_konsultasi) }}" required>
                            @error('biaya_konsultasi')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <textarea id="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi" rows="4">{{ old('deskripsi', $psikolog->deskripsi) }}</textarea>
                            @error('deskripsi')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-0">
                            <button type="submit" class="btn btn-temanjiwa me-2">
                                Simpan Perubahan
                            </button>
                            <a href="{{ route('psikolog.dashboard') }}" class="btn btn-secondary">
                                Kembali
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 