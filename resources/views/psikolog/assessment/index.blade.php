@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Daftar Assessment Saya</h2>
        <a href="{{ route('psikolog.assessment.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Assessment
        </a>
    </div>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <div class="card">
        <div class="card-body">
            @php $no = 1; @endphp
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Pertanyaan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($assessments as $assessment)
                        @foreach($assessment->questions as $q)
                            <tr>
                                <td>{{ $no++ }}. {{ $q->pertanyaan }}</td>
                                <td>
                                    <a href="{{ route('psikolog.assessment.editQuestion', [$assessment->id, $q->id]) }}" class="btn btn-sm btn-info">Edit</a>
                                    <form action="{{ route('psikolog.assessment.deleteQuestion', [$assessment->id, $q->id]) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus pertanyaan ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
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