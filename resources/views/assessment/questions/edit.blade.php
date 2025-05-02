@extends('layouts.app')

@section('title', 'Edit Pertanyaan Assessment')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">✏️ Edit Pertanyaan Assessment</h2>
    <div class="card">
        <div class="card-body">
            <form action="{{ route('assessment.questions.update', $question->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="pertanyaan" class="form-label">Pertanyaan</label>
                    <input type="text" name="pertanyaan" id="pertanyaan" class="form-control @error('pertanyaan') is-invalid @enderror" value="{{ old('pertanyaan', $question->pertanyaan) }}" required>
                    @error('pertanyaan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="d-flex justify-content-between">
                    <a href="{{ route('assessment.questions.manage') }}" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection 