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
        padding: 2rem 1.5rem 1.5rem 1.5rem;
    }
    .article-header {
        font-weight: 700;
        color: #264653;
        font-size: 1.3rem;
        margin-bottom: 1.5rem;
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
    .btn-edit, .btn-detail {
        border-radius: 2rem !important;
        padding-left: 1.2rem;
        padding-right: 1.2rem;
    }
    .btn-delete {
        border-radius: 2rem !important;
        padding-left: 1.2rem;
        padding-right: 1.2rem;
    }
    .table th, .table td {
        vertical-align: middle;
    }
</style>
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="article-header mb-0">Artikel Saya</h2>
        <a href="{{ route('psikolog.article.create') }}" class="btn btn-temanjiwa"><i class="fas fa-plus"></i> Tambah Artikel</a>
    </div>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <div class="card article-card">
        <div class="card-body">
    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead class="table-light">
                <tr>
                    <th>No.</th>
                    <th>Judul</th>
                    <th>Waktu Unggah</th>
                    <th>Deskripsi</th>
                    <th>Aksi</th>
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
                                    <a href="{{ route('article.show', $article->id) }}" class="btn btn-info btn-sm btn-detail">Detail</a>
                                    <a href="{{ route('psikolog.article.edit', $article->id) }}" class="btn btn-primary btn-sm btn-edit">Edit</a>
                                    <form method="POST" action="{{ route('psikolog.article.destroy', $article->id) }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus artikel ini?')">
                                @csrf
                                @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm btn-delete">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                                <td colspan="5" class="text-center text-muted">Belum ada artikel.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
            </div>
        </div>
    </div>
</div>
@endsection 