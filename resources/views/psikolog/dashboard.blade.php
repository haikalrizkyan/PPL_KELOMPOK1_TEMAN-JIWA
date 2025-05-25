@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-header bg-white fw-bold">Dashboard Psikolog</div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="row">
                        <!-- Profile Photo & Basic Info -->
                        <div class="col-md-4">
                            <div class="card text-center border-0">
                                <div class="card-body">
                                <img src="{{ asset('storage/' . $psikolog->foto_profil) }}" class="rounded-circle mb-3" width="120" height="120" alt="Foto Psikolog">
                                    <h5 class="fw-bold">{{ $psikolog->nama }}</h5>
                                    <p class="text-muted mb-1">{{ $psikolog->spesialisasi }}</p>
                                    <p class="text-muted small">Psikolog</p>
                                </div>
                            </div>
                        </div>

                        <!-- Profile Detail Info -->
                        <div class="col-md-8">
                            <div class="card mb-3">
                                <div class="card-header bg-white fw-semibold">Informasi Profil</div>
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
                                            <div class="col-sm-4 text-muted">{{ $label }}</div>
                                            <div class="col-sm-8">{{ $value }}</div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('psikolog.profile') }}" class="btn btn-info text-white px-4">
                                    <i class="fas fa-edit me-2"></i>Edit Profil
                                </a>
                                <form id="logout-form" action="{{ route('psikolog.logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-danger text-white px-4">
                                        <i class="fas fa-sign-out-alt me-2"></i>Logout
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

@endsection
