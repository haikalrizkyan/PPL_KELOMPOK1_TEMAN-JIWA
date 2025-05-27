@extends('layouts.app')

@section('title', 'Home Psikolog - Teman Jiwa')

@section('content')
<style>
    body {
        font-family: 'Ubuntu', sans-serif !important;
        background-color: #F4FAF9 !important;
    }
    .dashboard-card {
        border-radius: 1.5rem !important;
        box-shadow: 0 8px 32px 0 rgba(76,169,163,0.10) !important;
        background: #fff !important;
        padding: 2.5rem 2rem 2rem 2rem;
    }
    .dashboard-header {
        background: #fff !important;
        font-weight: 700;
        color: #264653;
        border-bottom: none !important;
        font-size: 1.3rem;
        border-radius: 1.5rem 1.5rem 0 0;
        text-align: center;
        padding: 1.5rem 2rem 1rem 2rem;
        margin-bottom: 1.5rem;
    }
    .profile-label {
        color: #264653;
        font-weight: 500;
    }
    .btn-temanjiwa {
        background: #4CA9A3;
        color: #fff;
        font-weight: 600;
        border-radius: 2rem;
        border: none;
        transition: background 0.2s;
        padding-left: 2rem;
        padding-right: 2rem;
    }
    .btn-temanjiwa:hover {
        background: #3D8C87;
        color: #fff;
    }
    .btn-logout {
        border-radius: 2rem;
        padding-left: 2rem;
        padding-right: 2rem;
    }
</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card dashboard-card">
                <div class="card-header dashboard-header" style="background: #fff !important; border-bottom: none !important; border-radius: 1.5rem 1.5rem 0 0;">Dashboard Psikolog</div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    <div class="row">
                        <!-- Profile Photo & Basic Info -->
                        <div class="col-md-4">
                            <div class="card text-center border-0" style="background: none; box-shadow: none;">
                                <div class="card-body">
                                    <img src="{{ asset('storage/' . $psikolog->foto_profil) }}" class="rounded-circle mb-3" width="100" height="100" alt="Psychologist Photo" style="object-fit: cover;">
                                    <h5 class="fw-bold">{{ $psikolog->nama }}</h5>
                                    <p class="text-muted mb-1">{{ $psikolog->spesialisasi }}</p>
                                    <p class="text-muted small">Psychologist</p>
                                </div>
                            </div>
                        </div>
                        <!-- Profile Detail Info -->
                        <div class="col-md-8">
                            <div class="card mb-3" style="border-radius: 1rem;">
                                <div class="card-header bg-white fw-semibold" style="border-radius: 1rem 1rem 0 0; font-weight:600; color:#264653;">Informasi Profil</div>
                                <div class="card-body">
                                    @php
                                        $fields = [
                                            'Email' => $psikolog->email,
                                            'Nomor Lisensi' => $psikolog->nomor_lisensi,
                                            'Spesialisasi' => $psikolog->spesialisasi,
                                            'Pengalaman' => $psikolog->pengalaman . ' tahun',
                                            'Biaya Konsultasi' => 'Rp ' . number_format($psikolog->biaya_konsultasi, 0, ',', '.'),
                                            'Deskripsi' => $psikolog->deskripsi
                                        ];
                                    @endphp
                                    @foreach ($fields as $label => $value)
                                        <div class="row mb-2">
                                            <div class="col-sm-4 profile-label">{{ $label }}</div>
                                            <div class="col-sm-8">{{ $value }}</div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <!-- Action Buttons -->
                            <div class="d-flex justify-content-between align-items-center">
                                <a href="{{ route('psikolog.profile') }}" class="btn btn-temanjiwa">
                                    <i class="fas fa-edit me-2"></i>Edit Profil
                                </a>
                                <form id="logout-form" action="{{ route('psikolog.logout') }}" method="POST">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
