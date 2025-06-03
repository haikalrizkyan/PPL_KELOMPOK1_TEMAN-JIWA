@extends('layouts.app')

@section('content')
<style>
    /* Add or modify styles specific to psychologist article view if needed */
    /* Keep styles from public view for consistency */
     body {
        font-family: 'Poppins', sans-serif;
        background-color: var(--light-bg);
        color: var(--text-color);
    }
    .article-card {
        border-radius: 1.5rem;
        box-shadow: 0 8px 32px 0 rgba(76,169,163,0.10);
        border: none;
    }
    .article-card-header {
        background: linear-gradient(90deg, var(--primary-color) 0%, var(--secondary-color) 100%);
        color: var(--white);
        font-size: 1.2rem;
        font-weight: 700;
        border-radius: 1.5rem 1.5rem 0 0;
        padding: 1rem 1.5rem;
    }
    .article-title {
        font-size: 1.6rem;
        font-weight: 700;
        color: var(--text-color);
        margin-bottom: 1.5rem;
    }
    .section-title {
        font-size: 1.2rem;
        font-weight: 600;
        color: var(--text-color);
        margin-top: 1.5rem;
        margin-bottom: 0.8rem;
    }
    .article-content p {
        font-size: 1rem;
        color: #4F4F4F;
        line-height: 1.6;
        margin-bottom: 1rem;
    }
    .btn-temanjiwa {
        background: var(--primary-color);
        color: var(--white);
        font-weight: 600;
        border-radius: 2rem;
        border: none;
        transition: background 0.2s;
        padding: 0.75rem 1.5rem;
        font-size: 1.1rem;
    }
    .btn-temanjiwa:hover {
        background: var(--secondary-color);
        color: var(--white);
    }
     .btn-secondary {
        border-radius: 2rem;
        padding: 0.75rem 1.5rem;
        font-size: 1.1rem;
        font-weight: 600;
        margin-top: 1.5rem;
     }
     .article-image {
        max-width: 100%;
        border-radius: 1rem;
        margin-bottom: 1.5rem;
     }
     .video-container {
        margin-bottom: 1.5rem;
     }
      .card-body.article-body {
          padding: 1.5rem !important;
      }
    .attachment-image {
        max-width: 100%;
        height: auto;
        border-radius: 1rem;
        margin-bottom: 1rem; /* Adjusted margin */
    }
</style>

<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card my-4 article-card">
                <div class="card-header article-card-header">
                    {{ $article->psychologist->nama ?? '-' }}
                </div>
                <div class="card-body article-body">
                    <h2 class="article-title">{{ $article->title }}</h2>
                    @if($article->cover)
                        <img src="{{ asset('storage/' . $article->cover) }}" alt="Sampul" class="article-image">
                    @endif
                    @if($article->youtube_url)
                        <div class="video-container">
                            <h5 class="section-title">Video</h5>
                            <div class="ratio ratio-16x9">
                                <iframe src="{{ $article->youtube_url }}" title="Video YouTube" class="rounded" allowfullscreen></iframe>
                            </div>
                        </div>
                    @endif
                    <h5 class="section-title">Bagian Pertama</h5>
                    <div class="article-content">
                        <p>{{ $article->first_section_description }}</p>
                    </div>
                    @if($article->first_section_attachment)
                        @php
                            $attachmentPath = 'storage/' . $article->first_section_attachment;
                            $mimeType = Storage::disk('public')->mimeType($article->first_section_attachment);
                        @endphp
                        <div class="mb-3">
                            @if(Str::startsWith($mimeType, 'image/'))
                                <img src="{{ asset($attachmentPath) }}" alt="Lampiran Bagian Pertama" class="img-fluid rounded mb-3 attachment-image">
                                <a href="{{ asset($attachmentPath) }}" target="_blank" class="btn btn-temanjiwa btn-sm">
                                     <i class="fas fa-download me-1"></i> Unduh Gambar
                                </a>
                            @else
                                <a href="{{ asset($attachmentPath) }}" target="_blank" class="btn btn-temanjiwa btn-sm">
                                    <i class="fas fa-file-download me-1"></i> Unduh Lampiran
                                </a>
                            @endif
                        </div>
                    @endif
                    @if($article->second_section_description)
                        <h5 class="section-title">Bagian Kedua</h5>
                        <div class="article-content">
                             <p>{{ $article->second_section_description }}</p>
                        </div>
                        @if($article->second_section_attachment)
                            @php
                                $attachmentPath = 'storage/' . $article->second_section_attachment;
                                $mimeType = Storage::disk('public')->mimeType($article->second_section_attachment);
                            @endphp
                            <div class="mb-3">
                                @if(Str::startsWith($mimeType, 'image/'))
                                    <img src="{{ asset($attachmentPath) }}" alt="Lampiran Bagian Kedua" class="img-fluid rounded mb-3 attachment-image">
                                     <a href="{{ asset($attachmentPath) }}" target="_blank" class="btn btn-temanjiwa btn-sm">
                                         <i class="fas fa-download me-1"></i> Unduh Gambar
                                     </a>
                                @else
                                    <a href="{{ asset($attachmentPath) }}" target="_blank" class="btn btn-temanjiwa btn-sm">
                                        <i class="fas fa-file-download me-1"></i> Unduh Lampiran
                                    </a>
                                @endif
                            </div>
                        @endif
                    @endif
                </div>
            </div>
            {{-- Link to go back to the psychologist's article list --}}
            <a href="{{ route('psikolog.article.list') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-1"></i> Kembali ke Daftar Artikel Saya
            </a>
        </div>
    </div>
</div>
@endsection 