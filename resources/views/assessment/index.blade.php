@extends('layouts.app')

@section('title', 'Assessment')

@section('content')
<div class="container py-5">
    {{-- CRUD Pertanyaan Assessment untuk Psikolog --}}
    @if(Auth::check() && Auth::user()->isPsikolog())
        <div class="card mb-4">
            <div class="card-body">
                <form action="{{ route('assessment.questions.store') }}" method="POST" class="row g-3">
                    @csrf
                    <div class="col-md-10">
                        <input type="text" name="pertanyaan" class="form-control @error('pertanyaan') is-invalid @enderror" placeholder="Tulis pertanyaan baru..." required>
                        @error('pertanyaan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary w-100">Tambah Pertanyaan</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title mb-3">Daftar Pertanyaan</h5>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th style="width: 60px;">No</th>
                            <th>Pertanyaan</th>
                            <th style="width: 160px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($questions as $q)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $q->pertanyaan }}</td>
                                <td>
                                    <form action="{{ route('assessment.questions.destroy', $q->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus pertanyaan ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                    </form>
                                    <a href="{{ route('assessment.questions.edit', $q->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center text-muted">Belum ada pertanyaan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    @endif
    {{-- Section Intro --}}
    <div id="intro-section" class="d-flex justify-content-center align-items-center" style="min-height: 60vh;">
        <div class="glass-card shadow-lg p-5 mx-auto border-0 rounded-5 animate-fadein" style="max-width: 540px;">
            <div class="mb-3">
                <!-- SVG Brain Illustration -->
                <svg width="64" height="64" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <ellipse cx="32" cy="32" rx="28" ry="24" fill="#f9e7ff"/>
                  <path d="M24 44c-4-2-6-7-6-12s2-10 6-12c2-6 14-6 16 0 4 2 6 7 6 12s-2 10-6 12c-2 6-14 6-16 0z" fill="#e26ee5"/>
                  <ellipse cx="32" cy="32" rx="10" ry="12" fill="#fff" opacity=".7"/>
                  <ellipse cx="28" cy="30" rx="2" ry="3" fill="#e26ee5"/>
                  <ellipse cx="36" cy="30" rx="2" ry="3" fill="#e26ee5"/>
                  <ellipse cx="32" cy="38" rx="4" ry="2" fill="#e26ee5"/>
                </svg>
            </div>
            <h1 class="mb-2 display-5 fw-bold font-title">Assessment Mental Health</h1>
            <p class="mb-4 text-secondary fs-5" style="font-weight: 400; letter-spacing: 0.01em;">
                Assessment ini bertujuan untuk membantumu memahami kondisi kesehatan mentalmu secara lebih mendalam.<br>Jawablah pertanyaan dengan jujur agar hasilnya akurat.
            </p>
            <button class="btn btn-lg btn-gradient px-5 py-2 rounded-pill shadow-sm mt-2" style="position:relative;z-index:1000;" onclick="startAssessment()">
                <i class="fas fa-play me-2"></i>Mulai Assessment
            </button>
        </div>
    </div>
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
                @foreach($questions as $index => $q)
                    <div class="question-card mb-4 p-4 rounded-4 shadow-sm animate-fadein">
                        <div class="d-flex align-items-center mb-2">
                            <div class="question-number me-3">{{ $index + 1 }}</div>
                            <div class="fw-semibold fs-5">{{ $q->pertanyaan }}</div>
                        </div>
                        <div class="d-flex flex-wrap gap-3 mt-2">
                            @foreach (['Tidak Pernah', 'Jarang', 'Kadang-kadang', 'Sering', 'Sangat Sering'] as $i => $opt)
                                <label class="custom-radio">
                                    <input class="form-check-input question-radio" type="radio" name="question{{ $index + 1 }}" value="{{ $opt }}" required>
                                    <span class="radio-label {{ str_replace(' ', '-', strtolower($opt)) }}">{{ $opt }}</span>
                                </label>
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
@keyframes fadeInScale {
    from { opacity: 0; transform: scale(0.95) translateY(30px); }
    to { opacity: 1; transform: scale(1) translateY(0); }
}
.glass-card {
    background: rgba(255,255,255,0.75);
    box-shadow: 0 8px 32px 0 rgba(31,38,135,0.10);
    backdrop-filter: blur(8px);
    border: 1.5px solid rgba(255,255,255,0.18);
    border-radius: 2rem;
    transition: box-shadow 0.2s;
}
.glass-card:hover {
    box-shadow: 0 12px 36px 0 rgba(226,110,229,0.13);
}
.font-title {
    font-family: 'Ubuntu', 'Segoe UI', Arial, sans-serif;
    letter-spacing: 0.01em;
}
.btn-gradient {
    background: linear-gradient(90deg, #0d6efd 60%, #e26ee5 100%);
    color: #fff;
    font-weight: 600;
    border: none;
    transition: box-shadow 0.2s, background 0.2s;
}
.btn-gradient:hover {
    background: linear-gradient(90deg, #e26ee5 60%, #0d6efd 100%);
    color: #fff;
    box-shadow: 0 4px 16px 0 rgba(13,110,253,0.18);
}
.animate-fadein {
    animation: fadeInScale 0.8s cubic-bezier(.39,.575,.56,1.000);
}
.question-card {
    background: #fff;
    border: 1.5px solid #f0f0f0;
    box-shadow: 0 4px 16px 0 rgba(13,110,253,0.07);
    transition: box-shadow 0.2s;
}
.question-card:hover {
    box-shadow: 0 8px 32px 0 rgba(13,110,253,0.13);
}
.question-number {
    background: #0d6efd;
    color: #fff;
    font-weight: bold;
    width: 38px;
    height: 38px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.2rem;
}
.custom-radio {
    position: relative;
    display: flex;
    align-items: center;
    cursor: pointer;
    margin-right: 1.5rem;
}
.custom-radio input[type="radio"] {
    display: none;
}
.radio-label {
    padding: 0.5rem 1.2rem;
    border-radius: 2rem;
    background: #f4f8fb;
    color: #222;
    font-weight: 500;
    transition: background 0.2s, color 0.2s;
    border: 2px solid transparent;
}
.custom-radio input[type="radio"]:checked + .radio-label {
    background: #0d6efd;
    color: #fff;
    border-color: #0d6efd;
}
.radio-label.tidak-pernah { background: #e9ecef; color: #6c757d; }
.radio-label.jarang { background: #cff4fc; color: #0dcaf0; }
.radio-label.kadang-kadang { background: #fff3cd; color: #ffc107; }
.radio-label.sering { background: #cfe2ff; color: #0d6efd; }
.radio-label.sangat-sering { background: #f8d7da; color: #dc3545; }
.custom-radio input[type="radio"]:checked + .radio-label.tidak-pernah { background: #6c757d; color: #fff; }
.custom-radio input[type="radio"]:checked + .radio-label.jarang { background: #0dcaf0; color: #fff; }
.custom-radio input[type="radio"]:checked + .radio-label.kadang-kadang { background: #ffc107; color: #fff; }
.custom-radio input[type="radio"]:checked + .radio-label.sering { background: #0d6efd; color: #fff; }
.custom-radio input[type="radio"]:checked + .radio-label.sangat-sering { background: #dc3545; color: #fff; }
</style>

{{-- Script --}}
<script>
    function startAssessment() {
        var intro = document.getElementById('intro-section');
        var form = document.getElementById('form-section');
        if (intro && form) {
            intro.parentNode.removeChild(intro);
            form.style.display = 'block';
            setTimeout(function() {
                form.scrollIntoView({ behavior: 'smooth' });
            }, 100);
        }
    }
    // Progress bar logic
    document.addEventListener("DOMContentLoaded", function () {
        const radios = document.querySelectorAll('.question-radio');
        const totalQuestions = {{ count($questions) }};
        const progressBar = document.getElementById('progress-bar');
        const progressText = document.getElementById('progress-text');
        if (radios.length && progressBar && progressText) {
            radios.forEach(function (radio) {
                radio.addEventListener('change', function () {
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
        }
    });
</script>
@endsection
