@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Daftar Psikolog</h2>
    <div class="row">
        @forelse($psikologs as $psikolog)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title">{{ $psikolog->nama }}</h5>
                        <p class="card-text mb-1"><strong>Spesialisasi:</strong> {{ $psikolog->spesialisasi }}</p>
                        <p class="card-text mb-1"><strong>Pengalaman:</strong> {{ $psikolog->pengalaman }} tahun</p>
                        <p class="card-text mb-1"><strong>Biaya Konsultasi:</strong> Rp {{ number_format($psikolog->biaya_konsultasi, 0, ',', '.') }}</p>
                        <p class="card-text">{{ $psikolog->deskripsi }}</p>
                        <a href="{{ route('konsultasi.booking.form', $psikolog->id) }}" class="btn btn-primary w-100">Book Konsultasi</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info">Belum ada psikolog yang tersedia.</div>
            </div>
        @endforelse
    </div>
</div>
@endsection 