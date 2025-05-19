@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="fw-bold my-4">Edit Artikel</h2>
    <div class="row justify-content-center">
        <div class="col-md-10 col-lg-8">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('psikolog.article.update', $article->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" name="title" id="title" class="form-control" placeholder="Enter Article Title" required value="{{ old('title', $article->title) }}">
                        </div>
                        <div class="mb-3">
                            <label for="cover" class="form-label">Cover</label>
                            <input type="file" name="cover" id="cover" class="form-control">
                            @if($article->cover)
                                <div class="mt-2"><img src="{{ asset('storage/' . $article->cover) }}" alt="cover" style="max-width:120px;"></div>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="first_section_description" class="form-label">First Section Description</label>
                            <textarea name="first_section_description" id="first_section_description" class="form-control" required>{{ old('first_section_description', $article->first_section_description) }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="first_section_attachment" class="form-label">First Section Attachment</label>
                            <input type="file" name="first_section_attachment" id="first_section_attachment" class="form-control">
                            @if($article->first_section_attachment)
                                <div class="mt-2"><a href="{{ asset('storage/' . $article->first_section_attachment) }}" target="_blank">Lihat Attachment</a></div>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="second_section_description" class="form-label">Second Section Description</label>
                            <textarea name="second_section_description" id="second_section_description" class="form-control">{{ old('second_section_description', $article->second_section_description) }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="second_section_attachment" class="form-label">Second Section Attachment</label>
                            <input type="file" name="second_section_attachment" id="second_section_attachment" class="form-control">
                            @if($article->second_section_attachment)
                                <div class="mt-2"><a href="{{ asset('storage/' . $article->second_section_attachment) }}" target="_blank">Lihat Attachment</a></div>
                            @endif
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="{{ route('psikolog.article.list') }}" class="btn btn-secondary ms-2">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 