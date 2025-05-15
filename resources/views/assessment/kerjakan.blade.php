@extends('layouts.app')

@section('content')
<style>
    .assessment-card {
        background: #fff;
        border-radius: 1.5rem;
        box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.15);
        padding: 2.5rem 2rem;
        max-width: 700px;
        margin: 0 auto;
    }
    .assessment-title {
        font-size: 2.2rem;
        font-weight: 700;
        color: #4f46e5;
        margin-bottom: 1.5rem;
        letter-spacing: 1px;
        text-align: center;
    }
    .assessment-progress {
        background: #e0e7ff;
        border-radius: 1rem;
        height: 12px;
        margin-bottom: 1.2rem;
        overflow: hidden;
    }
    .assessment-progress-bar {
        background: linear-gradient(90deg, #6366f1 0%, #7c3aed 100%);
        height: 100%;
        border-radius: 1rem;
        transition: width 0.4s;
    }
    .assessment-question {
        background: #f3f4f6;
        border-radius: 1rem;
        padding: 1.2rem 1rem;
        margin-bottom: 1.5rem;
        box-shadow: 0 2px 8px 0 rgba(99, 102, 241, 0.06);
    }
    .assessment-question-title {
        font-weight: 600;
        font-size: 1.1rem;
        margin-bottom: 0.7rem;
        color: #3730a3;
    }
    .assessment-choice {
        display: flex;
        align-items: center;
        margin-bottom: 0.5rem;
        font-size: 1.05rem;
    }
    .assessment-choice input[type="radio"] {
        width: 1.3em;
        height: 1.3em;
        accent-color: #6366f1;
        margin-right: 0.7em;
    }
    .assessment-submit-btn {
        background: linear-gradient(90deg, #6366f1 0%, #7c3aed 100%);
        color: #fff;
        font-size: 1.2rem;
        font-weight: 600;
        border: none;
        border-radius: 2rem;
        padding: 0.8rem 2.5rem;
        margin-top: 1.5rem;
        box-shadow: 0 4px 16px 0 rgba(99, 102, 241, 0.12);
        transition: background 0.3s, box-shadow 0.3s;
    }
    .assessment-submit-btn:hover {
        background: linear-gradient(90deg, #7c3aed 0%, #6366f1 100%);
        box-shadow: 0 8px 24px 0 rgba(99, 102, 241, 0.18);
    }
</style>
<div class="container py-5">
    <div class="assessment-card">
        <div class="assessment-title">Kerjakan Assessment</div>
        <div class="mb-4 text-center">
            <div class="fw-semibold mb-2">Petunjuk Pengisian Skala:</div>
            <div class="d-flex justify-content-center gap-3 flex-wrap">
                <span><b>1</b> = Sangat jarang</span>
                <span><b>2</b> = Jarang</span>
                <span><b>3</b> = Kadang-kadang</span>
                <span><b>4</b> = Sering</span>
                <span><b>5</b> = Sangat sering</span>
            </div>
        </div>
        @if($userAssessment->assessment->questions->count() == 0)
            <div class="alert alert-warning text-center">Belum ada pertanyaan pada assessment ini.</div>
        @else
        <form method="POST" action="{{ route('assessment.submit', $userAssessment->id) }}" id="assessmentForm">
            @csrf
            <div class="assessment-progress">
                <div class="assessment-progress-bar" id="progressBar" style="width: 0%"></div>
            </div>
            <div class="text-end text-sm text-muted mb-3">
                <span id="answeredCount">0</span> / {{ $userAssessment->assessment->questions->count() }} Terjawab
            </div>
            @foreach($userAssessment->assessment->questions as $index => $question)
                <div class="assessment-question">
                    <div class="assessment-question-title">{{ $index+1 }}. {{ $question->pertanyaan }}</div>
                    @foreach($question->choices as $choice)
                        <label class="assessment-choice">
                            <input type="radio" name="question_{{ $question->id }}" value="{{ $choice->id }}" required>
                            {{ $choice->isi_pilihan }}
                        </label>
                    @endforeach
                </div>
            @endforeach
            <div class="text-center">
                <button type="submit" class="assessment-submit-btn">Selesai & Lihat Hasil</button>
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
