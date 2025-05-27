@extends('layouts.app')

@section('title', 'Tambah Artikel - Teman Jiwa')

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
    }
    .form-control {
         font-size: 1rem; /* Consistent form control font size */
         padding: 0.75rem 1rem; /* Consistent form control padding */
         border-color: #ced4da; /* Default border color */
         border-radius: 0.5rem; /* Rounded corners for inputs */
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
    }

</style>
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-7">
            <div class="card shadow-lg rounded-4 mt-4">
                <div class="card-header text-center">
                    Tambah Artikel
                </div>
                <div class="card-body p-4">
                    @if ($errors->any())
                        <div class="alert alert-danger mb-4">
                            <ul class="mb-0" style="list-style: none; padding: 0;">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form method="POST" action="{{ route('psikolog.article.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-4">
                            <label for="title" class="form-label">Judul</label>
                            <input type="text" name="title" id="title" class="form-control" placeholder="Masukkan Judul Artikel" required value="{{ old('title') }}">
                        </div>
                        <div class="mb-4">
                            <label for="cover" class="form-label">Gambar Sampul</label>
                            <input type="file" name="cover" id="cover" class="form-control" accept="image/*">
                            <small class="form-text text-muted mt-1">Ukuran maks: 2MB. Format yang diperbolehkan: JPG, JPEG, PNG</small>
                        </div>
                        <div class="mb-4">
                            <label for="youtube_url" class="form-label">URL Video YouTube</label>
                            <input type="url" name="youtube_url" id="youtube_url" class="form-control" placeholder="https://www.youtube.com/watch?v=..." value="{{ old('youtube_url') }}">
                            <small class="form-text text-muted mt-1">Masukkan URL video YouTube yang valid (misalnya: https://www.youtube.com/watch?v=... atau https://youtu.be/...)</small>
                        </div>
                        <div class="mb-4">
                            <label for="first_section_description" class="form-label">Deskripsi Bagian Pertama</label>
                            <textarea name="first_section_description" id="first_section_description" class="form-control" placeholder="Masukkan deskripsi bagian pertama artikel" rows="4" required>{{ old('first_section_description') }}</textarea>
                        </div>
                        <div class="mb-4">
                            <label for="first_section_attachment" class="form-label">Lampiran Bagian Pertama</label>
                            <input type="file" name="first_section_attachment" id="first_section_attachment" class="form-control">
                            <small class="form-text text-muted mt-1">Ukuran maks: 4MB</small>
                        </div>
                        <div class="mb-4">
                            <label for="second_section_description" class="form-label">Deskripsi Bagian Kedua</label>
                            <textarea name="second_section_description" id="second_section_description" class="form-control" placeholder="Masukkan deskripsi bagian kedua artikel" rows="4">{{ old('second_section_description') }}</textarea>
                        </div>
                        <div class="mb-4">
                            <label for="second_section_attachment" class="form-label">Lampiran Bagian Kedua</label>
                            <input type="file" name="second_section_attachment" id="second_section_attachment" class="form-control">
                            <small class="form-text text-muted mt-1">Ukuran maks: 4MB</small>
                        </div>
                        <div class="d-grid mt-3">
                             <button type="submit" class="btn btn-primary btn-lg">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
