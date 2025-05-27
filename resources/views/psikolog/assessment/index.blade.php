@extends('layouts.app')

@section('title', 'Kelola Assessment - Teman Jiwa')

@section('content')
<style>
    body {
        font-family: 'Ubuntu', sans-serif !important;
        background-color: #F4FAF9 !important;
    }
    .assessment-card {
        border-radius: 1.5rem !important;
        box-shadow: 0 8px 32px 0 rgba(76,169,163,0.10) !important;
        background: #fff !important;
        padding: 2rem 1.5rem 1.5rem 1.5rem;
    }
    .assessment-header {
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
    .btn-edit {
        border-radius: 2rem;
        padding-left: 1.2rem;
        padding-right: 1.2rem;
    }
    .btn-delete {
        border-radius: 2rem;
        padding-left: 1.2rem;
        padding-right: 1.2rem;
    }
    .table th, .table td {
        vertical-align: middle;
    }
</style>
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="assessment-header mb-0">Daftar Assessment Saya</h2>
        <a href="{{ route('psikolog.assessment.create') }}" class="btn btn-temanjiwa">
            <i class="fas fa-plus"></i> Tambah Assessment
        </a>
    </div>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <div class="card assessment-card">
        <div class="card-body">
            @php $no = 1; @endphp
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Pertanyaan</th>
                        <th style="width: 140px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($assessments as $assessment)
                        @foreach($assessment->questions as $q)
                            <tr>
                                <td>{{ $no++ }}. {{ $q->pertanyaan }}</td>
                                <td>
                                    <a href="{{ route('psikolog.assessment.editQuestion', [$assessment->id, $q->id]) }}" class="btn btn-sm btn-primary btn-edit">Edit</a>
                                    <form action="{{ route('psikolog.assessment.deleteQuestion', [$assessment->id, $q->id]) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pertanyaan ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger btn-delete">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
            @if($assessments->sum(fn($a) => $a->questions->count()) == 0)
                <div class="text-center text-muted">Belum ada assessment. Klik tombol tambah untuk membuat assessment baru.</div>
            @endif
        </div>
    </div>
</div>
@endsection 