@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-7">
            <div class="card mt-4 shadow" style="border-radius:1.5rem;">
                <div class="card-body p-4">
                    <h3 class="fw-bold mb-4 text-center">Tambah Artikel</h3>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form method="POST" action="{{ route('psikolog.article.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-4">
                            <label for="title" class="form-label fw-semibold">Judul</label>
                            <input type="text" name="title" id="title" class="form-control form-control-lg" placeholder="Masukkan Judul Artikel" required value="{{ old('title') }}">
                        </div>
                        <div class="mb-4">
                            <label for="cover" class="form-label fw-semibold">Gambar Sampul</label>
                            <input type="file" name="cover" id="cover" class="form-control" accept="image/*">
                            <small class="text-muted">Ukuran maks: 2MB. Format yang diperbolehkan: JPG, JPEG, PNG</small>
                        </div>
                        <div class="mb-4">
                            <label for="youtube_url" class="form-label fw-semibold">URL Video YouTube</label>
                            <input type="url" name="youtube_url" id="youtube_url" class="form-control" placeholder="https://www.youtube.com/watch?v=..." value="{{ old('youtube_url') }}">
                            <small class="text-muted">Masukkan URL video YouTube yang valid (misalnya: https://www.youtube.com/watch?v=... atau https://youtu.be/...)</small>
                        </div>
                        <div class="mb-4">
                            <label for="first_section_description" class="form-label fw-semibold">Deskripsi Bagian Pertama</label>
                            <textarea name="first_section_description" id="first_section_description" class="form-control form-control-lg" placeholder="Masukkan deskripsi bagian pertama artikel" rows="4" required>{{ old('first_section_description') }}</textarea>
                        </div>
                        <div class="mb-4">
                            <label for="first_section_attachment" class="form-label fw-semibold">Lampiran Bagian Pertama</label>
                            <input type="file" name="first_section_attachment" id="first_section_attachment" class="form-control">
                            <small class="text-muted">Ukuran maks: 4MB</small>
                        </div>
                        <div class="mb-4">
                            <label for="second_section_description" class="form-label fw-semibold">Deskripsi Bagian Kedua</label>
                            <textarea name="second_section_description" id="second_section_description" class="form-control form-control-lg" placeholder="Masukkan deskripsi bagian kedua artikel" rows="4">{{ old('second_section_description') }}</textarea>
                        </div>
                        <div class="mb-4">
                            <label for="second_section_attachment" class="form-label fw-semibold">Lampiran Bagian Kedua</label>
                            <input type="file" name="second_section_attachment" id="second_section_attachment" class="form-control">
                            <small class="text-muted">Ukuran maks: 4MB</small>
                        </div>
                        <button type="submit" class="btn btn-primary btn-lg w-100" style="border-radius:1rem;">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
