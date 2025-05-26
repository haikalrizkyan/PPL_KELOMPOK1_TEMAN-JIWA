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
        border: none;
        overflow: hidden; /* To contain the rounded image */
        display: flex;
        flex-direction: column;
        height: 100%; /* Ensure cards in a row have equal height */
    }
    .article-cover-img {
        width: 100%;
        height: 200px; /* Fixed height for cover */
        object-fit: cover;
        /* border-top-left-radius: 1.5rem;
        border-top-right-radius: 1.5rem; */ /* Radius handled by card overflow */
    }
    .article-body {
        padding: 1.5rem;
        flex-grow: 1; /* Allow body to take available space */
        display: flex;
        flex-direction: column;
    }
    .article-header {
        font-weight: 700;
        color: #264653;
        font-size: 1.5rem;
        margin-bottom: 2rem;
    }
    .article-title {
        font-size: 1.2rem;
        font-weight: 700;
        color: #264653;
        margin-top: 0.5rem;
        margin-bottom: 0.5rem;
    }
     .article-meta {
         font-size: 0.9rem;
         color: #888;
         margin-bottom: 1rem;
     }
    .btn-outline-temanjiwa {
        border: 1px solid #4CA9A3;
        color: #4CA9A3;
        font-weight: 600;
        border-radius: 2rem;
        background: #fff;
        transition: background 0.2s, color 0.2s;
        padding: 0.5rem 1.5rem;
        align-self: flex-start; /* Align button to the left */
        margin-top: auto; /* Push button to the bottom */
    }
    .btn-outline-temanjiwa:hover {
      background: #4CA9A3;
      color: #fff;
    }
    .alert-info {
        border-radius: 1rem;
        font-size: 1rem;
        background: #e3f8fa;
        color: #264653;
        border: none;
    }
    .badge-category {
        background-color: #e0f7f7;
        color: #3b7c7c;
        font-size: 0.85rem;
        font-weight: 600;
        padding: 0.3em 0.8em;
        border-radius: 1rem;
        margin-bottom: 0.5rem;
        display: inline-block;
    }
</style>
<div class="container py-5">
    <h2 class="text-center article-header">Daftar Artikel</h2>
    <div class="row justify-content-center">
        @forelse($articles as $article)
            <div class="col-md-4 col-sm-6 mb-4 d-flex">
                <div class="card article-card w-100">
                    @if($article->cover)
                        <img src="{{ asset('storage/' . $article->cover) }}" class="article-cover-img" alt="Article Cover Image">
                    @endif
                    <div class="article-body">
                         @if($article->category)
                            <span class="badge badge-category mb-2">{{ $article->category->name ?? $article->category }}</span>
                        @endif
                        <h5 class="article-title mt-0 mb-1">{{ $article->title }}</h5>
                        <div class="article-meta mb-2">
                            By {{ $article->psychologist->nama ?? '-' }} | {{ $article->created_at->format('F d, Y') }}
                    </div>
                        <p class="card-text flex-grow-1 mb-3">{{ Str::limit($article->first_section_description, 120) }}</p>
                        <a href="{{ route('article.show', $article->id) }}" class="btn btn-outline-temanjiwa mt-auto">Baca Selengkapnya</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info text-center">Belum ada artikel yang tersedia.</div>
            </div>
        @endforelse
    </div>
</div>
@endsection
