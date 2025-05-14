@extends('layouts.app')

@section('title', 'Article - Teman Jiwa')

@push('style')
    <style>
        .img-hover-zoom img {
            transition: transform 0.5s ease;
        }

        .img-hover-zoom:hover img {
            transform: scale(1.05);
        }

        .btn-hover:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }

        .transition {
            transition: all 0.3s ease-in-out;
        }
    </style>
@endpush

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">

                <!-- Gambar Artikel -->
                @if (in_array(strtolower(pathinfo($article->first_attachment, PATHINFO_EXTENSION)), ['jpg', 'jpeg', 'png', 'gif', 'svg']))
                    <div class="img-hover-zoom mb-4">
                        <img src="{{ url('article/attachment/images/' . $article->first_attachment) }}"
                            class="img-fluid rounded" alt="Gambar Artikel">
                    </div>
                @else
                    <div class="ratio ratio-4x3">
                        <video controls>
                            <source src="{{ url('article/attachment/videos/' . $article->first_attachment) }}"
                                type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    </div>
                @endif

                <!-- Judul Artikel -->
                <h1 class="mb-3">{{ $article->title }}</h1>

                <!-- Info Penulis -->
                <div class="text-muted mb-4">
                    Dipublikasikan pada {{ date('Y-m-d', strtotime($article->created_at)) }} oleh
                    <strong>{{ $article->user->name }}</strong>
                </div>

                <!-- Isi Artikel -->
                <p>
                    {{ $article->first_section }}
                </p>

                @if ($article->second_attachment)
                    @if (in_array(strtolower(pathinfo($article->second_attachment, PATHINFO_EXTENSION)), ['jpg', 'jpeg', 'png', 'gif', 'svg']))
                        <div class="img-hover-zoom mb-4">
                            <img src="{{ url('article/attachment/images/' . $article->second_attachment) }}"
                                class="img-fluid rounded" alt="Gambar Artikel">
                        </div>
                    @else
                        <div class="ratio ratio-4x3">
                            <video controls>
                                <source src="{{ url('article/attachment/videos/' . $article->second_attachment) }}"
                                    type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        </div>
                    @endif
                @endif

                @if ($article->second_section)
                    <p>
                        {{ $article->second_section }}
                    </p>
                @endif

                <!-- Tombol Aksi -->
                <div class="mt-5 d-flex justify-content-between">
                    <a href="{{ route('article.index') }}" class="btn btn-outline-secondary btn-hover transition">←
                        Kembali</a>
                </div>

                <!-- Komentar -->
            </div>
        </div>
    </div>
@endsection
