@extends('layouts.app')

@section('title', 'Assessment - Teman Jiwa')

@section('content')
<style>
    body {
        font-family: 'Ubuntu', sans-serif !important;
        background-color: #F4FAF9 !important;
    }
    .assessment-card {
        border-radius: 1.5rem !important;
        box-shadow: 0 8px 32px 0 rgba(76,169,163,0.10) !important;
        background: #fff !important;
        padding: 2rem 1.5rem 1.5rem 1.5rem;
        max-width: 400px;
        margin: 0 auto;
    }
    .assessment-emoji {
        font-size: 2.5rem;
        display: block;
        margin-bottom: 0.5rem;
    }
    .assessment-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: #264653;
        margin-bottom: 0.8rem;
    }
    .assessment-desc {
        color: #264653;
        font-size: 0.95rem;
        margin-bottom: 1.5rem;
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
    .assessment-empty {
        color: #888;
        font-size: 1.05rem;
        margin-top: 1.5rem;
    }
</style>
<div class="container py-5">
    <h1 class="text-center mb-5">Apa Yang Sedang Kamu Rasakan?</h1>
    <p class="text-center mb-5">Yuk, pilih perasaan yang sedang kamu hadapi dan temukan bantuan yang kamu butuhkan sekarang!</p>

    <div class="row justify-content-center">
        @forelse($assessments as $assessment)
            <div class="col-md-3 mb-4">
                <div class="card h-100 assessment-card">
                    <div class="card-body text-center">
                        {{-- You might want to add an icon or image here based on the assessment type --}}
                        <span class="assessment-emoji">🧠</span> {{-- Placeholder emoji --}}
                        <h5 class="card-title assessment-title">{{ $assessment->judul }}</h5>
                        <p class="card-text assessment-desc">{{ $assessment->deskripsi }}</p>
                        <a href="{{ route('assessment.start', $assessment->id) }}" class="btn btn-temanjiwa">Mulai Assessment</a>
            </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="text-center assessment-empty">Tidak ada penilaian yang tersedia saat ini.</div>
        </div>
        @endforelse
    </div>
</div>
@endsection 