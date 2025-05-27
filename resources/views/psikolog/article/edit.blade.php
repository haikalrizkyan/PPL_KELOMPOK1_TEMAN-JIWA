@extends('layouts.app')

@section('title', 'Edit Artikel - Teman Jiwa')

@section('content')
<style>
    body {
        font-family: 'Ubuntu', sans-serif !important;
        background-color: #F4FAF9 !important;
    }
    .card {
        border-radius: 1.5rem !important;
        box-shadow: 0 8px 32px 0 rgba(76,169,163,0.10) !important;
        border: none !important;
    }
    .card-body {
        padding: 2rem !important; /* Increased padding for better spacing */
    }
    .card-header {
        background-color: #fff;
        color: #264653;
        font-weight: 700;
        font-size: 1.5rem; /* Slightly larger header font */
        border-bottom: none;
        padding: 1.5rem 2rem 1rem 2rem; /* Adjusted header padding */
        margin-bottom: 1.5rem; /* Space below header */
        text-align: center;
        border-radius: 1.5rem 1.5rem 0 0 !important;
    }
    .form-label {
        color: #264653;
        font-weight: 600; /* Make labels a bit bolder */
        margin-bottom: 0.5rem; /* Space below label */
        display: block; /* Ensure label is a block element for proper stacking */
    }
    .form-control {
         font-size: 1rem; /* Consistent form control font size */
         padding: 0.75rem 1rem; /* Consistent form control padding */
         border-color: #ced4da; /* Default border color */
         border-radius: 0.5rem; /* Rounded corners for inputs */
         margin-bottom: 0; /* Remove default bottom margin from form control */
    }
    .form-control-lg {
        font-size: 1rem; /* Keep consistent font size even for lg class */
        padding: 0.75rem 1rem; /* Keep consistent padding */
        border-radius: 0.5rem; /* Keep consistent rounded corners */
    }
    .form-control:focus {
        border-color: #4CA9A3;
        box-shadow: 0 0 0 0.2rem rgba(76,169,163,0.15);
    }
    .btn-primary {
        background-color: #4CA9A3; /* Teman Jiwa green */
        border-color: #4CA9A3; /* Teman Jiwa green */
        font-weight: 600;
        border-radius: 2rem; /* Pill-shaped button */
        padding: 0.75rem 1.5rem; /* Button padding */
        transition: background-color 0.2s, border-color 0.2s;
    }
    .btn-primary:hover {
        background-color: #3D8C87; /* Darker green on hover */
        border-color: #3D8C87; /* Darker green on hover */
    }
    .alert {
        border-radius: 1rem; /* Rounded alerts */
        font-size: 1rem; /* Consistent alert font size */
        padding: 1rem 1.5rem; /* Adjusted alert padding */
        margin-bottom: 1.5rem; /* Space below alert */
    }
    .text-muted {
        font-size: 0.875rem; /* Standard small text size */
        display: block; /* Ensure small text is on its own line */
        margin-top: 0.25rem; /* Space above small text */
    }
    .img-thumbnail {
        background-color: #e9ecef; /* Light background for thumbnail */
        border: 1px solid #dee2e6; /* Subtle border */
        padding: 0.25rem;
        border-radius: 0.5rem;
    }
    /* Adjustments for spacing within form groups */
    .form-group > .mb-2 {
         margin-bottom: 0.75rem !important; /* Space below preview elements */
    }
     .form-group small {
         margin-top: 0.5rem !important; /* Increase space above small text */
     }
     .mb-3 {
        margin-bottom: 1.5rem !important; /* Increase space between form groups */
    }
    .mb-4 {
         margin-bottom: 2rem !important; /* Increase space for the last form group */
    }

</style>
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-7">
            <div class="card shadow-lg rounded-4 mt-4">
                 <div class="card-header text-center">
                    Edit Artikel
                </div>
                <div class="card-body p-4">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0" style="list-style: none; padding: 0;">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form method="POST" action="{{ route('psikolog.article.update', $article->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3 form-group">
                            <label for="title" class="form-label">Judul</label>
                            <input type="text" name="title" id="title" class="form-control" placeholder="Masukkan Judul Artikel" required value="{{ old('title', $article->title) }}">
                        </div>
                        <div class="mb-3 form-group">
                            <label for="cover" class="form-label">Gambar Sampul</label>
                            <div class="d-flex align-items-center flex-wrap">
                            @if($article->cover)
                                    <div class="mb-2 me-3">
                                        <img src="{{ asset('storage/' . $article->cover) }}" alt="Sampul saat ini" class="img-thumbnail" style="max-height: 100px; height: auto;">
                                </div>
                            @endif
                                <input type="file" name="cover" id="cover" class="form-control flex-grow-1" accept="image/*">
                            </div>
                            <small class="form-text text-muted">Ukuran maks: 2MB. Format yang diizinkan: JPG, JPEG, PNG</small>
                        </div>
                        <div class="mb-3 form-group">
                            <label for="youtube_url" class="form-label">URL Video YouTube</label>
                            <div class="d-flex align-items-center flex-wrap">
                            @if($article->youtube_url)
                                    <div class="mb-2 me-3" style="max-width: 150px;">
                                    <div class="ratio ratio-16x9">
                                        <iframe src="{{ $article->youtube_url }}" title="Video YouTube" allowfullscreen></iframe>
                                    </div>
                                </div>
                            @endif
                                <input type="url" name="youtube_url" id="youtube_url" class="form-control flex-grow-1" placeholder="https://www.youtube.com/watch?v=..." value="{{ old('youtube_url', $article->youtube_url) }}">
                            </div>
                            <small class="form-text text-muted">Masukkan URL video YouTube yang valid (misal: https://www.youtube.com/watch?v=... atau https://youtu.be/...)</small>
                        </div>
                        <div class="mb-3 form-group">
                            <label for="first_section_description" class="form-label">Deskripsi Bagian Pertama</label>
                            <textarea name="first_section_description" id="first_section_description" class="form-control" placeholder="Masukkan deskripsi bagian pertama artikel" rows="4" required>{{ old('first_section_description', $article->first_section_description) }}</textarea>
                        </div>
                        <div class="mb-3 form-group">
                            <label for="first_section_attachment" class="form-label">Lampiran Bagian Pertama</label>
                            @if($article->first_section_attachment)
                                <div class="mb-2">
                                    <a href="{{ asset('storage/' . $article->first_section_attachment) }}" target="_blank" class="btn btn-sm btn-secondary">Lihat Lampiran Saat Ini</a>
                                </div>
                            @endif
                            <input type="file" name="first_section_attachment" id="first_section_attachment" class="form-control">
                            <small class="form-text text-muted">Ukuran maks: 4MB</small>
                        </div>
                        <div class="mb-3 form-group">
                            <label for="second_section_description" class="form-label">Deskripsi Bagian Kedua</label>
                            <textarea name="second_section_description" id="second_section_description" class="form-control" placeholder="Masukkan deskripsi bagian kedua artikel" rows="4">{{ old('second_section_description', $article->second_section_description) }}</textarea>
                        </div>
                        <div class="mb-4 form-group">
                            <label for="second_section_attachment" class="form-label">Lampiran Bagian Kedua</label>
                            @if($article->second_section_attachment)
                                <div class="mb-2">
                                    <a href="{{ asset('storage/' . $article->second_section_attachment) }}" target="_blank" class="btn btn-sm btn-secondary">Lihat Lampiran Saat Ini</a>
                                </div>
                            @endif
                            <input type="file" name="second_section_attachment" id="second_section_attachment" class="form-control">
                            <small class="form-text text-muted">Ukuran maks: 4MB</small>
                        </div>
                        <div class="d-grid">
                             <button type="submit" class="btn btn-primary btn-lg">Perbarui Artikel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
