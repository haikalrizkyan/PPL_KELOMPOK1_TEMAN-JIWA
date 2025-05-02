@extends('layouts.app')

@section('title', 'Edit Artikel')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h2 class="card-title mb-4">✏️ Edit Artikel</h2>

                    <form action="{{ route('articles.update', $article->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="judul" class="form-label">Judul Artikel</label>
                            <input type="text" class="form-control @error('judul') is-invalid @enderror" id="judul" name="judul" value="{{ old('judul', $article->judul) }}" required>
                            @error('judul')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="kategori" class="form-label">Kategori</label>
                            <select class="form-select @error('kategori') is-invalid @enderror" id="kategori" name="kategori" required>
                                <option value="">Pilih Kategori</option>
                                <option value="kesehatan_mental" {{ old('kategori', $article->kategori) == 'kesehatan_mental' ? 'selected' : '' }}>Kesehatan Mental</option>
                                <option value="perawatan_diri" {{ old('kategori', $article->kategori) == 'perawatan_diri' ? 'selected' : '' }}>Perawatan Diri</option>
                                <option value="hubungan" {{ old('kategori', $article->kategori) == 'hubungan' ? 'selected' : '' }}>Hubungan</option>
                                <option value="manajemen_stres" {{ old('kategori', $article->kategori) == 'manajemen_stres' ? 'selected' : '' }}>Manajemen Stres</option>
                                <option value="kecemasan" {{ old('kategori', $article->kategori) == 'kecemasan' ? 'selected' : '' }}>Kecemasan</option>
                                <option value="depresi" {{ old('kategori', $article->kategori) == 'depresi' ? 'selected' : '' }}>Depresi</option>
                            </select>
                            @error('kategori')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="gambar" class="form-label">Gambar Artikel</label>
                            @if($article->gambar)
                                <div class="mb-2">
                                    <img src="{{ Storage::url($article->gambar) }}" alt="Gambar saat ini" class="img-thumbnail" style="max-height: 200px;">
                                </div>
                            @endif
                            <input type="file" class="form-control @error('gambar') is-invalid @enderror" id="gambar" name="gambar" accept="image/*">
                            @error('gambar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">Format yang didukung: JPEG, PNG, JPG, GIF. Maksimal 2MB.</div>
                        </div>

                        <div class="mb-3">
                            <label for="konten" class="form-label">Konten Artikel</label>
                            <textarea class="form-control @error('konten') is-invalid @enderror" id="konten" name="konten" rows="15" required>{{ old('konten', $article->konten) }}</textarea>
                            @error('konten')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('articles.show', $article->id) }}" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js"></script>
<script>
    tinymce.init({
        selector: '#konten',
        height: 500,
        plugins: [
            'advlist autolink lists link image charmap print preview anchor',
            'searchreplace visualblocks code fullscreen',
            'insertdatetime media table paste code help wordcount'
        ],
        toolbar: 'undo redo | formatselect | bold italic backcolor | \
                alignleft aligncenter alignright alignjustify | \
                bullist numlist outdent indent | removeformat | help'
    });
</script>
@endpush
@endsection 