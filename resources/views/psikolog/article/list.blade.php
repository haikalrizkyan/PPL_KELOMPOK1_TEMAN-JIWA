@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="fw-bold my-4">Daftar Artikel Saya</h2>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <div class="mb-3 text-end">
        <a href="{{ route('psikolog.article.create') }}" class="btn btn-success">Tambah Artikel</a>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead class="table-light">
                <tr>
                    <th>No.</th>
                    <th>Title</th>
                    <th>Uploaded Time</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($articles as $i => $article)
                    <tr>
                        <td>{{ $i+1 }}</td>
                        <td>{{ $article->title }}</td>
                        <td>{{ $article->created_at->format('Y-m-d H:i:s') }}</td>
                        <td>{{ Str::limit($article->first_section_description, 80) }}</td>
                        <td class="d-flex gap-2">
                            <a href="{{ route('article.show', $article->id) }}" class="btn btn-info btn-sm">Detail</a>
                            <a href="{{ route('psikolog.article.edit', $article->id) }}" class="btn btn-primary btn-sm">Edit</a>
                            <form method="POST" action="{{ route('psikolog.article.destroy', $article->id) }}" onsubmit="return confirm('Yakin ingin menghapus artikel ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">Belum ada artikel.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection 