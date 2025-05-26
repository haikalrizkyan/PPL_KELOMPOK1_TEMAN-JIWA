@extends('layouts.app')

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
        padding: 2.5rem 2rem 2rem 2rem;
        max-width: 500px;
        margin: 0 auto;
    }
    .assessment-emoji {
        font-size: 3rem;
        display: block;
        margin-bottom: 0.5rem;
    }
    .assessment-title {
        font-size: 1.7rem;
        font-weight: 700;
        color: #264653;
        margin-bottom: 1rem;
    }
    .assessment-desc {
        color: #264653;
        font-size: 1.05rem;
        margin-bottom: 2rem;
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
        font-size: 1.1rem;
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
    <div class="d-flex justify-content-center align-items-center" style="min-height: 60vh;">
        <div class="assessment-card">
            <div class="text-center mb-3">
                <span class="assessment-emoji">🧠</span>
                <div class="assessment-title">Mental Health Assessment</div>
            </div>
            <p class="text-center assessment-desc">
                Penilaian ini bertujuan untuk membantu Anda lebih memahami kondisi kesehatan mental Anda. Jawablah pertanyaan-pertanyaan yang ada dengan jujur untuk mendapatkan hasil yang paling akurat.
            </p>
            @if($assessment)
                <div class="text-center">
                    <a href="{{ route('assessment.start', $assessment->id) }}" class="btn btn-temanjiwa btn-lg">Mulai Assessment</a>
                </div>
            @else
                <div class="text-center assessment-empty">Tidak ada penilaian yang tersedia saat ini.</div>
            @endif
        </div>
    </div>
</div>
@endsection 