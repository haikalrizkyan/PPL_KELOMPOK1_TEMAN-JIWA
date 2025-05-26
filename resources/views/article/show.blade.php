@extends('layouts.app')

@section('content')
<style>
    body {
        font-family: 'Ubuntu', sans-serif !important;
        background-color: #F4FAF9 !important;
    }
    .article-card {
        border-radius: 1.5rem !important;
        box-shadow: 0 8px 32px 0 rgba(76,169,163,0.10) !important;
        background: #fff !important;
        border: none !important;
    }
    .article-card-header {
        background: linear-gradient(90deg, #4CA9A3 0%, #A8E6CF 100%);
        color: #fff;
        font-size: 1.2rem;
        font-weight: 700;
        border-radius: 1.5rem 1.5rem 0 0;
        padding: 1rem 1.5rem; /* Adjusted padding */
    }
    .article-title {
        font-size: 1.6rem; /* Adjusted font size */
        font-weight: 700;
        color: #264653;
        margin-bottom: 1.5rem; /* Adjusted margin */
    }
    .section-title {
        font-size: 1.2rem; /* Adjusted font size */
        font-weight: 600;
        color: #264653;
        margin-top: 1.5rem; /* Adjusted margin */
        margin-bottom: 0.8rem; /* Adjusted margin */
    }
    .article-content p {
        font-size: 1rem; /* Adjusted font size */
        color: #4F4F4F; /* Slightly darker grey for readability */
        line-height: 1.6; /* Improved line height */
        margin-bottom: 1rem; /* Adjusted margin */
    }
    .btn-temanjiwa {
        background: #4CA9A3;
        color: #fff;
        font-weight: 600;
        border-radius: 2rem;
        border: none;
        transition: background 0.2s;
        padding: 0.75rem 1.5rem; /* Adjusted padding */
        font-size: 1.1rem; /* Adjusted font size */
    }
    .btn-temanjiwa:hover {
        background: #3D8C87;
        color: #fff;
    }
     .btn-secondary {
        border-radius: 2rem;
        padding: 0.75rem 1.5rem; /* Adjusted padding */
        font-size: 1.1rem; /* Adjusted font size */
        font-weight: 600;
        margin-top: 1.5rem; /* Added top margin */
     }
     .article-image {
        max-width: 100%;
        border-radius: 1rem; /* Rounded corners for image */
        margin-bottom: 1.5rem; /* Adjusted margin */
     }
     .video-container {
        margin-bottom: 1.5rem; /* Adjusted margin */
     }
      .card-body.article-body {
          padding: 1.5rem !important; /* Consistent padding */
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
                        <div class="mb-3">
                            <a href="{{ asset('storage/' . $article->first_section_attachment) }}" target="_blank" class="btn btn-temanjiwa btn-sm">
                                <i class="fas fa-file-download me-1"></i> Unduh Lampiran
                            </a>
                        </div>
                    @endif
                    @if($article->second_section_description)
                        <h5 class="section-title">Bagian Kedua</h5>
                        <div class="article-content">
                             <p>{{ $article->second_section_description }}</p>
                        </div>
                        @if($article->second_section_attachment)
                            <div class="mb-3">
                                <a href="{{ asset('storage/' . $article->second_section_attachment) }}" target="_blank" class="btn btn-temanjiwa btn-sm">
                                    <i class="fas fa-file-download me-1"></i> Unduh Lampiran
                                </a>
                            </div>
                        @endif
                    @endif
                </div>
            </div>
            <a href="{{ route('article.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-1"></i> Kembali ke Daftar Artikel
            </a>
        </div>
    </div>
</div>
@endsection
