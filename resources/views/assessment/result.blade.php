@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Hasil Assessment</h2>
    <div class="card mt-4">
        <div class="card-body">
            <h4>Skor Anda: {{ $skor }}</h4>
            <h5>Kategori: <span class="badge bg-primary">{{ $kategori }}</span></h5>
            <hr>
            <a href="{{ route('assessment.history') }}" class="btn btn-success">Lihat Riwayat Assessment</a>
            <a href="{{ url('/') }}" class="btn btn-secondary">Kembali ke Beranda</a>
        </div>
    </div>
</div>
@endsection 