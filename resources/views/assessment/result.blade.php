@extends('layouts.app')

@section('content')
<style>
    body {
        font-family: 'Ubuntu', sans-serif !important;
        background-color: #F4FAF9 !important;
    }
    .result-card {
        border-radius: 1.5rem !important;
        box-shadow: 0 8px 32px 0 rgba(76,169,163,0.10) !important;
        background: #fff !important;
        padding: 2.5rem 2rem 2rem 2rem;
        max-width: 600px;
        margin: 0 auto;
    }
    .result-header {
        font-weight: 700;
        color: #264653;
        font-size: 1.8rem;
        margin-bottom: 2rem;
        text-align: center;
    }
    .score-category-text {
        font-size: 1.2rem;
        color: #264653;
        margin-bottom: 1rem;
    }
    .badge-category {
        border-radius: 0.5rem;
        padding: 0.3em 0.6em;
        font-size: 1rem;
        font-weight: 600;
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
        font-size: 1rem;
    }
    .btn-temanjiwa:hover {
        background: #3D8C87;
        color: #fff;
    }
     .btn-secondary {
        border-radius: 2rem;
        padding-left: 1.5rem;
        padding-right: 1.5rem;
        font-size: 1rem;
    }
</style>
<div class="container py-5">
    <h2 class="result-header">Hasil Penilaian</h2>
    <div class="card result-card">
        <div class="card-body">
            <div class="score-category-text"><strong>Poin Kamu:</strong> {{ $skor }}</div>
            <div class="score-category-text"><strong>Kategori:</strong> <span class="badge bg-primary badge-category">{{ $kategori }}</span></div>
            <hr class="my-4">
            <div class="d-flex justify-content-center flex-wrap gap-2">
                <a href="{{ route('assessment.history') }}" class="btn btn-temanjiwa">Lihat Hasil Penilaian</a>
                <a href="{{ route('dashboard') }}" class="btn btn-secondary" aria-label="Kembali ke home">Kembali ke Home</a>
            </div>
        </div>
    </div>
</div>
@endsection 