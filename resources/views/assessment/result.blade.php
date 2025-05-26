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
        padding: 2rem !important;
        max-width: 500px;
        margin: 2rem auto;
    }
    .result-header {
        font-weight: 700;
        color: #264653;
        font-size: 1.6rem;
        margin-bottom: 2rem;
        text-align: center;
    }
    .score-category-container {
        text-align: center;
    }
    .score-category-text {
        font-size: 1.2rem;
        color: #264653;
        margin-bottom: 0.8rem;
        line-height: 1.5;
    }
    .badge-category {
        border-radius: 0.5rem;
        padding: 0.3em 0.6em;
        font-size: 0.9rem;
        font-weight: 600;
    }
    .badge-sehat-result {
        background: #66BB6A !important;
        color: #fff !important;
        border-radius: 0.5rem;
        padding: 0.3em 0.6em;
        font-size: 0.9rem;
        font-weight: 600;
    }
    .btn-temanjiwa {
        background: #4CA9A3;
        color: #fff;
        font-weight: 600;
        border-radius: 2rem;
        border: none;
        transition: background 0.2s;
        padding: 0.75rem 1.5rem;
        font-size: 1.1rem;
        margin-top: 1rem;
    }
    .btn-temanjiwa:hover {
        background: #3D8C87;
        color: #fff;
    }
     .btn-secondary {
        border-radius: 2rem;
        padding: 0.6rem 1.5rem;
        font-size: 1rem;
        font-weight: 600;
        margin-top: 1.5rem;
    }
    hr.my-4 {
        margin-top: 1.5rem !important;
        margin-bottom: 1.5rem !important;
        border-color: rgba(0, 0, 0, 0.1);
    }
</style>
<div class="container py-5">
    <h2 class="result-header">Hasil Assessment</h2>
    <div class="card result-card">
        <div class="card-body text-center">
             <div class="score-category-container">
                <div class="score-category-text"><strong>Poin Kamu:</strong> {{ $skor }}</div>
                <div class="score-category-text"><strong>Kategori:</strong>
                     @if($kategori == 'Sehat')
                         <span class="badge badge-sehat-result">{{ $kategori }}</span>
                     @else
                         <span class="badge bg-primary badge-category">{{ $kategori }}</span>
                     @endif
                 </div>
             </div>
            <hr class="my-4">
            <a href="{{ route('assessment.history') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
</div>
@endsection 