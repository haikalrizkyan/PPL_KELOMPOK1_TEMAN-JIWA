@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card my-4">
                <div class="card-header bg-success text-white fw-bold">
                    {{ $article->psychologist->nama ?? '-' }}
                </div>
                <div class="card-body">
                    <h2 class="fw-bold mb-3">{{ $article->title }}</h2>
                    @if($article->cover)
                        <img src="{{ asset('storage/' . $article->cover) }}" alt="cover" class="mb-3" style="max-width:100%; border-radius:1rem;">
                    @endif
                    <h5 class="fw-semibold">First Section</h5>
                    <p>{{ $article->first_section_description }}</p>
                    @if($article->first_section_attachment)
                        <div class="mb-3"><a href="{{ asset('storage/' . $article->first_section_attachment) }}" target="_blank">Lihat Attachment</a></div>
                    @endif
                    @if($article->second_section_description)
                        <h5 class="fw-semibold mt-4">Second Section</h5>
                        <p>{{ $article->second_section_description }}</p>
                        @if($article->second_section_attachment)
                            <div class="mb-3"><a href="{{ asset('storage/' . $article->second_section_attachment) }}" target="_blank">Lihat Attachment</a></div>
                        @endif
                    @endif
                </div>
            </div>
            <a href="{{ route('article.index') }}" class="btn btn-secondary">Kembali ke Daftar Artikel</a>
        </div>
    </div>
</div>
@endsection 