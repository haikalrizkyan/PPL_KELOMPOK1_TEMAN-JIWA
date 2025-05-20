@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-7">
            <div class="card mt-4 shadow" style="border-radius:1.5rem;">
                <div class="card-body p-4">
                    <h3 class="fw-bold mb-4 text-center">Edit Artikel</h3>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form method="POST" action="{{ route('psikolog.article.update', $article->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label for="title" class="form-label fw-semibold">Judul</label>
                            <input type="text" name="title" id="title" class="form-control form-control-lg" placeholder="Masukkan Judul Artikel" required value="{{ old('title', $article->title) }}">
                        </div>
                        <div class="mb-4">
                            <label for="cover" class="form-label fw-semibold">Gambar Sampul</label>
                            @if($article->cover)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/' . $article->cover) }}" alt="Sampul saat ini" class="img-thumbnail" style="max-height: 200px;">
                                </div>
                            @endif
                            <input type="file" name="cover" id="cover" class="form-control" accept="image/*">
                            <small class="text-muted">Ukuran maks: 2MB. Format yang diizinkan: JPG, JPEG, PNG</small>
                        </div>
                        <div class="mb-4">
                            <label for="youtube_url" class="form-label fw-semibold">URL Video YouTube</label>
                            @if($article->youtube_url)
                                <div class="mb-2">
                                    <div class="ratio ratio-16x9">
                                        <iframe src="{{ $article->youtube_url }}" title="Video YouTube" allowfullscreen></iframe>
                                    </div>
                                </div>
                            @endif
                            <input type="url" name="youtube_url" id="youtube_url" class="form-control" placeholder="https://www.youtube.com/watch?v=..." value="{{ old('youtube_url', $article->youtube_url) }}">
                            <small class="text-muted">Masukkan URL video YouTube yang valid (misal: https://www.youtube.com/watch?v=... atau https://youtu.be/...)</small>
                        </div>
                        <div class="mb-4">
                            <label for="first_section_description" class="form-label fw-semibold">Deskripsi Bagian Pertama</label>
                            <textarea name="first_section_description" id="first_section_description" class="form-control form-control-lg" placeholder="Masukkan deskripsi bagian pertama artikel" rows="4" required>{{ old('first_section_description', $article->first_section_description) }}</textarea>
                        </div>
                        <div class="mb-4">
                            <label for="first_section_attachment" class="form-label fw-semibold">Lampiran Bagian Pertama</label>
                            @if($article->first_section_attachment)
                                <div class="mb-2">
                                    <a href="{{ asset('storage/' . $article->first_section_attachment) }}" target="_blank" class="btn btn-sm btn-info">Lihat Lampiran Saat Ini</a>
                                </div>
                            @endif
                            <input type="file" name="first_section_attachment" id="first_section_attachment" class="form-control">
                            <small class="text-muted">Ukuran maks: 4MB</small>
                        </div>
                        <div class="mb-4">
                            <label for="second_section_description" class="form-label fw-semibold">Deskripsi Bagian Kedua</label>
                            <textarea name="second_section_description" id="second_section_description" class="form-control form-control-lg" placeholder="Masukkan deskripsi bagian kedua artikel" rows="4">{{ old('second_section_description', $article->second_section_description) }}</textarea>
                        </div>
                        <div class="mb-4">
                            <label for="second_section_attachment" class="form-label fw-semibold">Lampiran Bagian Kedua</label>
                            @if($article->second_section_attachment)
                                <div class="mb-2">
                                    <a href="{{ asset('storage/' . $article->second_section_attachment) }}" target="_blank" class="btn btn-sm btn-info">Lihat Lampiran Saat Ini</a>
                                </div>
                            @endif
                            <input type="file" name="second_section_attachment" id="second_section_attachment" class="form-control">
                            <small class="text-muted">Ukuran maks: 4MB</small>
                        </div>
                        <button type="submit" class="btn btn-primary btn-lg w-100" style="border-radius:1rem;">Perbarui Artikel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
