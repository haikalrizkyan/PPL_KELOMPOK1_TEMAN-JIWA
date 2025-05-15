@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Dashboard Psikolog') }}</div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-md-4">
                            <div class="card mb-4">
                                <div class="card-body text-center">
                                    <h5 class="card-title">{{ $psikolog->nama }}</h5>
                                    <p class="card-text text-muted">{{ $psikolog->spesialisasi }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-8">
                            <div class="card mb-4">
                                <div class="card-header">
                                    Informasi Profil
                                </div>
                                <div class="card-body">
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Email</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0">{{ $psikolog->email }}</p>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Nomor Lisensi</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0">{{ $psikolog->nomor_lisensi }}</p>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Pengalaman</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0">{{ $psikolog->pengalaman }} tahun</p>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Biaya Konsultasi</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0">Rp {{ number_format($psikolog->biaya_konsultasi, 0, ',', '.') }}</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Deskripsi</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0">{{ $psikolog->deskripsi }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header">
                                    Menu Cepat
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <a href="{{ route('psikolog.profile') }}" class="btn btn-primary w-100">
                                                Edit Profil
                                            </a>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <form method="POST" action="{{ route('psikolog.logout') }}">
                                                @csrf
                                                <button type="submit" class="btn btn-danger w-100">
                                                    Logout
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 