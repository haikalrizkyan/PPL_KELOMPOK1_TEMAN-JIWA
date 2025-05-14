@extends('layouts.app')

@section('title', 'Article - Teman Jiwa')

@push('style')
    <style>
        .truncate-2-lines {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
            height: 3em;
            /* 2 lines * 1.5em line-height */
            line-height: 1.5em;
            word-break: break-word;
            /* important to break words properly */
        }
    </style>
@endpush

@section('content')
    <div class="container">
        <h1 class="text-center my-4">Article List</h1>
        <div class="row justify-content-center g-4">
            @foreach ($articles as $key => $data)
                <div class="col-md-3 d-flex">
                    <div class="card shadow-sm w-100">
                        <img src="{{ url('article/cover/' . $data->cover) }}" class="card-img-top" alt="Book Cover">
                        <div class="card-body d-flex flex-column">
                            <span class="badge bg-success mb-2 text-center">
                                <i class="bi bi-circle-fill me-1" style="font-size: 0.5rem;"></i> {{ $data->user->name }}
                            </span>

                            <h5 class="card-title mt-2 text-center">
                                {{ $data->title }}
                            </h5>

                            <div class="truncate-2-lines mt-2">
                                {!! Str::limit(strip_tags($data->first_section), 150) !!}
                            </div>
                        </div>
                        <div class="card-footer bg-white border-0 text-center d-flex justify-content-end">
                            <a href="{{ route('article.detail', $data->id) }}" class="btn btn-primary rounded-pill">
                                Read More
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
