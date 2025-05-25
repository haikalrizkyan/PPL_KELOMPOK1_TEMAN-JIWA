@extends('layouts.app')

@section('content')
<style>
    body {
        font-family: 'Ubuntu', sans-serif !important;
        background-color: #F4FAF9 !important;
    }
    .assessment-card {
        background: #fff;
        border-radius: 1.5rem;
        box-shadow: 0 8px 32px 0 rgba(76,169,163,0.10);
        padding: 2.5rem 2rem;
        max-width: 700px;
        margin: 0 auto;
    }
    .assessment-title {
        font-size: 1.8rem;
        font-weight: 700;
        color: #264653;
        margin-bottom: 1.5rem;
        text-align: center;
    }
    .scale-instructions {
        font-weight: 600;
        color: #264653;
        margin-bottom: 1rem;
        text-align: center;
    }
    .scale-options span {
        color: #264653;
        font-size: 0.95rem;
    }
     .scale-options span b {
         color: #4CA9A3;
     }
    .assessment-progress-container {
        background: #e0f7f7;
        border-radius: 1rem;
        height: 12px;
        margin-bottom: 1.2rem;
        overflow: hidden;
    }
    .assessment-progress-bar {
        background: #4CA9A3;
        height: 100%;
        border-radius: 1rem;
        transition: width 0.4s;
    }
    .question-count {
        text-align: end;
        font-size: 0.9rem;
        color: #888;
        margin-bottom: 1rem;
    }
    .assessment-question {
        background: #f8fafc;
        border-radius: 0.8rem;
        padding: 1.2rem;
        margin-bottom: 1.5rem;
        border: 1px solid #eee;
    }
    .assessment-question-title {
        font-weight: 600;
        font-size: 1.1rem;
        margin-bottom: 1rem;
        color: #264653;
    }
    .assessment-choice label {
        display: flex;
        align-items: center;
        margin-bottom: 0.6rem;
        font-size: 1.05rem;
        color: #264653;
        cursor: pointer;
    }
    .assessment-choice input[type="radio"] {
        width: 1.3em;
        height: 1.3em;
        accent-color: #4CA9A3;
        margin-right: 0.8em;
        cursor: pointer;
    }
    .btn-temanjiwa {
        background: #4CA9A3;
        color: #fff;
        font-size: 1.1rem;
        font-weight: 600;
        border: none;
        border-radius: 2rem;
        padding: 0.8rem 2.5rem;
        margin-top: 1rem;
        box-shadow: 0 4px 12px 0 rgba(76,169,163,0.15);
        transition: background 0.2s, box-shadow 0.2s;
    }
    .btn-temanjiwa:hover {
        background: #3D8C87;
        box-shadow: 0 6px 16px 0 rgba(76,169,163,0.25);
    }
     .alert-warning {
        border-radius: 1rem;
        font-size: 1rem;
        background: #fff3cd;
        color: #664d03;
        border-color: #ffecb5;
     }
</style>
<div class="container py-5">
    <div class="assessment-card">
        <div class="assessment-title">Memulai Penilaian</div>
        <div class="mb-4">
            <div class="scale-instructions">Petunjuk Skala Penilaian:</div>
            <div class="d-flex justify-content-center gap-3 flex-wrap scale-options">
                <span><b>1</b> = Sangat jarang</span>
                <span><b>2</b> = Jarang</span>
                <span><b>3</b> = Kadang-kadang</span>
                <span><b>4</b> = Sering</span>
                <span><b>5</b> = Sangat sering</span>
            </div>
        </div>
        @if($userAssessment->assessment->questions->count() == 0)
            <div class="alert alert-warning text-center">Tidak ada pertanyaan yang tersedia untuk penilaian ini.</div>
        @else
        <form method="POST" action="{{ route('assessment.submit', $userAssessment->id) }}" id="assessmentForm">
            @csrf
            <div class="assessment-progress-container">
                <div class="assessment-progress-bar" id="progressBar" style="width: 0%"></div>
            </div>
            <div class="question-count">
                <span id="answeredCount">0</span> / {{ $userAssessment->assessment->questions->count() }} Jawaban
            </div>
            @foreach($userAssessment->assessment->questions as $index => $question)
                <div class="assessment-question">
                    <div class="assessment-question-title">{{ $index+1 }}. {{ $question->pertanyaan }}</div>
                    <div class="assessment-choice">
                        @foreach($question->choices as $choice)
                            <label>
                                <input type="radio" name="question_{{ $question->id }}" value="{{ $choice->id }}" required>
                                {{ $choice->isi_pilihan }}
                            </label>
                        @endforeach
                    </div>
                </div>
            @endforeach
            <div class="text-center">
                <button type="submit" class="btn btn-temanjiwa">Selesai & Lihat Hasil</button>
            </div>
        </form>
        @endif
    </div>
</div>
<script>
window.questionIds = @json($userAssessment->assessment->questions->pluck('id'));
window.totalQuestions = {{ $userAssessment->assessment->questions->count() }};
</script>
<script src="{{ asset('js/assessment-progress.js') }}"></script>
@endsection
