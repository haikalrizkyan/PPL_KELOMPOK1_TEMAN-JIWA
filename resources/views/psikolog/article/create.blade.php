@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-7">
            <div class="card mt-4 shadow" style="border-radius:1.5rem;">
                <div class="card-body p-4">
                    <h3 class="fw-bold mb-4 text-center">Tambah Artikel</h3>
                    <form method="POST" action="{{ route('psikolog.article.store') }}">
                        @csrf
                        <div class="mb-4">
                            <label for="title" class="form-label fw-semibold">Title</label>
                            <input type="text" name="title" id="title" class="form-control form-control-lg" placeholder="Enter Article Title" required value="{{ old('title') }}">
                        </div>
                        <div class="mb-4">
                            <label for="first_section_description" class="form-label fw-semibold">First Section Description</label>
                            <textarea name="first_section_description" id="first_section_description" class="form-control form-control-lg" placeholder="Enter Article First Section Description" rows="4" required>{{ old('first_section_description') }}</textarea>
                        </div>
                        <div class="mb-4">
                            <label for="second_section_description" class="form-label fw-semibold">Second Section Description</label>
                            <textarea name="second_section_description" id="second_section_description" class="form-control form-control-lg" placeholder="Enter Article Second Section Description" rows="4">{{ old('second_section_description') }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary btn-lg w-100" style="border-radius:1rem;">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 