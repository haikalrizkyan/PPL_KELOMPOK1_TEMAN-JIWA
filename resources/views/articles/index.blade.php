@extends('layouts.app')

@section('title', 'Artikel Kesehatan Mental')

@section('content')
<div class="container py-5">
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="mb-3">📚 Artikel Kesehatan Mental</h2>
            @auth
                <a href="{{ route('articles.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Buat Artikel Baru
                </a>
            @endauth
        </div>
    </div>

    <div class="row">
        @forelse($articles as $article)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card h-100 shadow-sm">
                    @if($article->gambar)
                        <img src="{{ Storage::url($article->gambar) }}" class="card-img-top" alt="{{ $article->judul }}" style="height: 200px; object-fit: cover;">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $article->judul }}</h5>
                        <p class="card-text text-muted">
                            <small>
                                <i class="fas fa-user"></i> {{ $article->penulis->name }}
                                <br>
                                <i class="fas fa-calendar"></i> {{ $article->tanggal_terbit->format('d M Y') }}
                            </small>
                        </p>
                        <p class="card-text">{{ Str::limit(strip_tags($article->konten), 150) }}</p>
                        <a href="{{ route('articles.show', $article->id) }}" class="btn btn-outline-primary">Baca Selengkapnya</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info">
                    Belum ada artikel yang tersedia.
                </div>
            </div>
        @endforelse
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $articles->links() }}
    </div>
</div>
@endsection 