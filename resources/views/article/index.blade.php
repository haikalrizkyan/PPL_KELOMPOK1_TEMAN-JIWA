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
    }
    .article-header {
        font-weight: 700;
        color: #264653;
        font-size: 1.5rem;
        margin-bottom: 2rem;
    }
    .btn-temanjiwa {
        background: #4CA9A3;
        color: #fff;
        font-weight: 600;
        border-radius: 2rem;
        border: none;
        transition: background 0.2s;
        padding-left: 1.5rem;
        padding-right: 1.5rem;
    }
    .btn-temanjiwa:hover {
        background: #3D8C87;
        color: #fff;
    }
    .alert-info {
        border-radius: 1rem;
        font-size: 1rem;
        background: #e3f8fa;
        color: #264653;
        border: none;
    }
</style>
<div class="container py-5">
    <h2 class="text-center article-header">Article List</h2>
    <div class="row justify-content-center">
        @forelse($articles as $article)
            <div class="col-md-4 col-sm-6 mb-4 d-flex align-items-stretch">
                <div class="card article-card w-100">
                    <div class="card-header text-white text-center fw-semibold" style="border-radius:1.5rem 1.5rem 0 0; background:#4CA9A3;">
                        {{ $article->psychologist->nama ?? '-' }}
                    </div>
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title fw-bold">{{ $article->title }}</h5>
                        <p class="card-text flex-grow-1">{{ Str::limit($article->first_section_description, 120) }}</p>
                        <a href="{{ route('article.show', $article->id) }}" class="btn btn-temanjiwa mt-2 align-self-end">Read More</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info text-center">No articles available yet.</div>
            </div>
        @endforelse
    </div>
</div>
@endsection
