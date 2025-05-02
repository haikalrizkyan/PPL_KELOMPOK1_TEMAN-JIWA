@extends('layouts.app')

@section('title', $article->judul)

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <article class="card shadow-sm">
                @if($article->gambar)
                    <img src="{{ Storage::url($article->gambar) }}" class="card-img-top" alt="{{ $article->judul }}" style="height: 400px; object-fit: cover;">
                @endif
                <div class="card-body">
                    <h1 class="card-title mb-4">{{ $article->judul }}</h1>
                    
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="text-muted">
                            <i class="fas fa-user"></i> {{ $article->penulis->name }}
                            <br>
                            <i class="fas fa-calendar"></i> {{ $article->tanggal_terbit->format('d M Y') }}
                        </div>
                        <span class="badge bg-primary">{{ ucfirst(str_replace('_', ' ', $article->kategori)) }}</span>
                    </div>

                    <div class="article-content mb-4">
                        {!! $article->konten !!}
                    </div>

                    @can('update', $article)
                        <div class="d-flex gap-2">
                            <a href="{{ route('articles.edit', $article->id) }}" class="btn btn-outline-primary">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            @if($article->status === 'draft')
                                <form action="{{ route('articles.publish', $article->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-success">
                                        <i class="fas fa-paper-plane"></i> Terbitkan
                                    </button>
                                </form>
                            @endif
                            <form action="{{ route('articles.destroy', $article->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus artikel ini?')">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            </form>
                        </div>
                    @endcan
                </div>
            </article>

            <!-- Bagian Komentar -->
            <div class="card mt-4">
                <div class="card-body">
                    <h4 class="card-title">Komentar</h4>

                    @auth
                        <form action="{{ route('article.comments.store', $article->id) }}" method="POST" class="mb-4">
                            @csrf
                            <div class="form-group">
                                <textarea name="komentar" class="form-control @error('komentar') is-invalid @enderror" rows="3" placeholder="Tulis komentar Anda...">{{ old('komentar') }}</textarea>
                                @error('komentar')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary mt-2">Kirim Komentar</button>
                        </form>
                    @else
                        <p class="text-muted">Silakan <a href="{{ route('login') }}">login</a> untuk menambahkan komentar.</p>
                    @endauth

                    <div class="comments-list">
                        @forelse($article->komentar()->with('user')->latest()->get() as $comment)
                            <div class="comment border-bottom py-3">
                                <div class="d-flex justify-content-between">
                                    <h6 class="mb-1">{{ $comment->user->name }}</h6>
                                    <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                                </div>
                                <p class="mb-1">{{ $comment->komentar }}</p>
                                @if(Auth::check() && Auth::id() === $comment->user_id)
                                    <form action="{{ route('article.comments.destroy', ['articleId' => $article->id, 'commentId' => $comment->id]) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus komentar ini?')">Hapus</button>
                                    </form>
                                @endif
                            </div>
                        @empty
                            <p class="text-muted">Belum ada komentar.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 