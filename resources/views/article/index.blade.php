@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-center fw-bold my-4">Article List</h2>
    <div class="row justify-content-center">
        @forelse($articles as $article)
            <div class="col-md-4 col-sm-6 mb-4 d-flex align-items-stretch">
                <div class="card w-100" style="border-radius:1rem; box-shadow:0 2px 12px 0 rgba(0,0,0,0.07);">
                    <div class="card-header bg-success text-white text-center fw-semibold" style="border-radius:1rem 1rem 0 0;">
                        {{ $article->psychologist->nama ?? '-' }}
                    </div>
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title fw-bold">{{ $article->title }}</h5>
                        <p class="card-text flex-grow-1">{{ Str::limit($article->first_section_description, 120) }}</p>
                        <a href="{{ route('article.show', $article->id) }}" class="btn btn-primary mt-2 align-self-end">Read More</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info text-center">Belum ada artikel.</div>
            </div>
        @endforelse
    </div>
</div>
@endsection 