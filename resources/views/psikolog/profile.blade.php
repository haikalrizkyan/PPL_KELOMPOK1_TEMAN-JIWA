@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Profil Psikolog') }}</div>

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
                            <input type="file" class="form-control" name="foto" id="foto">
                        </div>
                        <div class="mb-3">
                            <label for="nama" class="form-label">{{ __('Nama Lengkap') }}</label>
                            <input id="nama" type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{ old('nama', $psikolog->nama) }}" required>
                            @error('nama')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">{{ __('Email') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', $psikolog->email) }}" required>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="spesialisasi" class="form-label">{{ __('Spesialisasi') }}</label>
                            <input id="spesialisasi" type="text" class="form-control @error('spesialisasi') is-invalid @enderror" name="spesialisasi" value="{{ old('spesialisasi', $psikolog->spesialisasi) }}" required>
                            @error('spesialisasi')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="pengalaman" class="form-label">{{ __('Pengalaman (tahun)') }}</label>
                            <input id="pengalaman" type="number" class="form-control @error('pengalaman') is-invalid @enderror" name="pengalaman" value="{{ old('pengalaman', $psikolog->pengalaman) }}" required>
                            @error('pengalaman')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="biaya_konsultasi" class="form-label">{{ __('Biaya Konsultasi') }}</label>
                            <input id="biaya_konsultasi" type="number" class="form-control @error('biaya_konsultasi') is-invalid @enderror" name="biaya_konsultasi" value="{{ old('biaya_konsultasi', $psikolog->biaya_konsultasi) }}" required>
                            @error('biaya_konsultasi')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">{{ __('Deskripsi') }}</label>
                            <textarea id="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi" rows="4">{{ old('deskripsi', $psikolog->deskripsi) }}</textarea>
                            @error('deskripsi')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-0">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Simpan Perubahan') }}
                            </button>
                            <a href="{{ route('psikolog.dashboard') }}" class="btn btn-secondary">
                                {{ __('Kembali') }}
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 