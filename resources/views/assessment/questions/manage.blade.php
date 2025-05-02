@extends('layouts.app')

@section('title', 'Manajemen Pertanyaan Assessment')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">🧑‍⚕️ Manajemen Pertanyaan Assessment</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card mb-4">
        <div class="card-body">
            <form action="{{ route('assessment.questions.store') }}" method="POST" class="row g-3">
                @csrf
                <div class="col-md-10">
                    <input type="text" name="pertanyaan" class="form-control @error('pertanyaan') is-invalid @enderror" placeholder="Tulis pertanyaan baru..." required>
                    @error('pertanyaan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">Tambah</button>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title mb-3">Daftar Pertanyaan</h5>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th style="width: 60px;">No</th>
                        <th>Pertanyaan</th>
                        <th style="width: 160px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($questions as $q)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $q->pertanyaan }}</td>
                            <td>
                                <a href="{{ route('assessment.questions.edit', $q->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('assessment.questions.destroy', $q->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus pertanyaan ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center text-muted">Belum ada pertanyaan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection 