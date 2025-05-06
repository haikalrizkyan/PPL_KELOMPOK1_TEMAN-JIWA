@extends('layouts.app')

@section('title', 'Assessment')

@section('content')
<div class="container py-5">

    {{-- Section Intro --}}
    <div id="intro-section" class="text-center">
        <div class="card shadow p-5 mx-auto border-0 rounded-4" style="max-width: 720px;">
            <h1 class="mb-3">🧠 Assessment Mental Health</h1>
            <p class="mb-4 text-muted fs-5">
                Assessment ini bertujuan untuk membantumu memahami kondisi kesehatan mentalmu secara lebih mendalam.
                Jawablah pertanyaan dengan jujur agar hasilnya akurat.
            </p>
            <button class="btn btn-lg btn-primary px-5 py-2 rounded-pill shadow" onclick="startAssessment()">Mulai Assessment</button>
        </div>
    </div>

    {{-- Section Form --}}
    <div id="form-section" style="display: none; animation: fadeIn 0.6s ease;">
        <div class="card shadow-lg border-0 rounded-4 p-5 mt-5">
            <h2 class="mb-3">📝 Jawab Pertanyaan Berikut</h2>
            <p class="text-muted mb-4">Silakan jawab pertanyaan di bawah ini dengan jujur.</p>

            {{-- Progress Bar --}}
            <div class="progress mb-4 rounded-pill" style="height: 22px; overflow: hidden;">
                <div id="progress-bar" class="progress-bar bg-success fw-bold d-flex align-items-center ps-3" role="progressbar" style="width: 0%;">
                    <span id="progress-text" class="text-white">0%</span>
                </div>
            </div>

            <form method="POST" action="{{ route('assessment.store') }}">
                @csrf

                @foreach($questions as $index => $question)
                    <div class="mb-5">
                        <label class="form-label fw-semibold fs-5">{{ $index + 1 }}. {{ $question->question }}</label>
                        <div class="d-flex flex-wrap gap-3 mt-2">
                            @foreach (['Tidak Pernah', 'Jarang', 'Kadang-kadang', 'Sering', 'Sangat Sering'] as $i => $opt)
                                <div class="form-check">
                                    <input class="form-check-input question-radio" 
                                           type="radio" 
                                           name="question{{ $question->id }}" 
                                           value="{{ $opt }}" 
                                           id="q{{ $question->id }}{{ $i }}" 
                                           required>
                                    <label class="form-check-label" for="q{{ $question->id }}{{ $i }}">{{ $opt }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach

                <div class="text-end mt-4">
                    <button type="submit" class="btn btn-success btn-lg px-5 py-2 rounded-pill">Kirim Assessment</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Fade-in Animation --}}
<style>
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(30px); }
    to { opacity: 1; transform: translateY(0); }
}
</style>

{{-- Script --}}
<script>
    function startAssessment() {
        document.getElementById('intro-section').style.display = 'none';
        document.getElementById('form-section').style.display = 'block';
    }

    document.addEventListener("DOMContentLoaded", function () {
        const radios = document.querySelectorAll(".question-radio");
        const totalQuestions = parseInt(`{{ count($questions) }}`);
        const progressBar = document.getElementById("progress-bar");
        const progressText = document.getElementById("progress-text");

        radios.forEach(function (radio) {
            radio.addEventListener("change", function () {
                let answered = 0;
                for (let i = 1; i <= totalQuestions; i++) {
                    if (document.querySelector(`input[name="question${i}"]:checked`)) {
                        answered++;
                    }
                }
                const progress = Math.round((answered / totalQuestions) * 100);
                progressBar.style.width = `${progress}%`;
                progressText.textContent = `${progress}%`;
            });
        });
    });
</script>
@endsection
