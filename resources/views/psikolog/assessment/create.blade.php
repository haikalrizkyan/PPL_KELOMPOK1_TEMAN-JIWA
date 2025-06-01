@extends('layouts.app')

@section('title', 'Kelola Assessment - Teman Jiwa')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header">Tambah Pertanyaan Assessment</div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form method="POST" action="{{ route('psikolog.assessment.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="judul" class="form-label">Nama Assessment</label>
                            <input type="text" class="form-control" id="judul" name="judul" value="{{ old('judul', $assessment->judul ?? '') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi Assessment</label>
                            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3">{{ old('deskripsi', $assessment->deskripsi ?? '') }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="pertanyaan" class="form-label">Pertanyaan</label>
                            <input type="text" class="form-control" id="pertanyaan" name="pertanyaan" value="{{ old('pertanyaan') }}" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan Pertanyaan</button>
                        <a href="{{ route('psikolog.assessment.index') }}" class="btn btn-secondary">Selesai</a>
                    </form>
                </div>
            </div>
            @if(isset($assessment) && $assessment->questions->count())
                <div class="card">
                    <div class="card-header">Daftar Pertanyaan</div>
                    <div class="card-body">
                        <ol>
                            @foreach($assessment->questions as $q)
                                <li class="mb-2">
                                    <strong>{{ $q->pertanyaan }}</strong>
                                    <ul>
                                        @foreach($q->choices as $c)
                                            <li>{{ $c->isi_pilihan }} @if($c->is_correct) <span class="badge bg-success">Benar</span> @endif</li>
                                        @endforeach
                                    </ul>
                                </li>
                            @endforeach
                        </ol>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection 