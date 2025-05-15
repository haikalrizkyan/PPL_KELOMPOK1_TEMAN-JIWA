@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-center align-items-center" style="min-height: 60vh;">
        <div class="bg-white rounded-xl shadow-lg p-5 w-100" style="max-width: 600px;">
            <div class="text-center mb-4">
                <span class="fs-2 align-middle">🧠</span>
                <span class="fs-4 fw-bold align-middle">Assessment Mental Health</span>
            </div>
            <p class="text-center text-muted mb-4">
                Assessment ini bertujuan untuk membantumu memahami kondisi kesehatan mentalmu secara lebih mendalam. Jawablah pertanyaan dengan jujur agar hasilnya akurat.
            </p>
            @if($assessment)
                <div class="text-center">
                    <a href="{{ route('assessment.start', $assessment->id) }}" class="btn btn-primary btn-lg">Mulai Assessment</a>
                </div>
            @else
                <div class="text-center text-muted">Belum ada assessment yang tersedia.</div>
            @endif
        </div>
    </div>
</div>
@endsection 