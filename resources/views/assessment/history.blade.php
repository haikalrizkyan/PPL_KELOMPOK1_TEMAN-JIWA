@extends('layouts.app')

@section('title', 'Riwayat Assessment  - Teman Jiwa')

@section('content')
<style>
    body {
        font-family: 'Ubuntu', sans-serif !important;
        background-color: #F4FAF9 !important;
    }
    .history-card {
        border-radius: 1.5rem !important;
        box-shadow: 0 8px 32px 0 rgba(76,169,163,0.10) !important;
        background: #fff !important;
        padding: 2rem 1.5rem 1.5rem 1.5rem;
    }
    .history-header {
        font-weight: 700;
        color: #264653;
        font-size: 1.5rem;
        margin-bottom: 2rem;
    }
    .table th, .table td {
        vertical-align: middle;
        color: #264653;
    }
    .table thead th {
        font-weight: 600;
        color: #264653;
        background-color: #e0f7f7;
        border-color: #c3e6cb;
    }
    .badge-category {
        border-radius: 0.5rem;
        padding: 0.3em 0.6em;
        font-size: 0.9rem;
        font-weight: 600;
    }
     .badge-sehat-history {
        background: #66BB6A !important; /* Green color from other pages */
        color: #fff !important;
        border-radius: 0.5rem; /* Match history page border radius */
        padding: 0.3em 0.6em; /* Match history page padding */
        font-size: 0.9rem; /* Match history page font size */
        font-weight: 600;
    }
        .badge-sedang-history {
        background-color: #FFC107 !important; /* Orange color */
        color: #fff !important;
        border-radius: 0.5rem;
        padding: 0.3em 0.6em;
        font-size: 0.9rem;
        font-weight: 600;
    }
    .badge-berat-history {
        background-color: #DC3545 !important; /* Red color */
        color: #fff !important;
        border-radius: 0.5rem;
        padding: 0.3em 0.6em;
        font-size: 0.9rem;
        font-weight: 600;
    }
    .btn-view-result {
        border-radius: 2rem !important;
        padding: 0.25rem 1rem !important;
    }
     .btn-secondary {
        border-radius: 2rem;
        padding-left: 1.5rem;
        padding-right: 1.5rem;
        font-size: 1rem;
    }
    .alert-info {
        border-radius: 1rem;
        font-size: 1rem;
        background: #e3f8fa;
        color: #264653;
        border: none;
    }
</style>
<div class="container py-4">
    <h2 class="text-center mb-4" style="color: #264653; font-weight: 700;">Riwayat Assessment</h2>
    <div class="card history-card">
        <div class="card-body">
            @if($riwayat->isEmpty())
                <div class="alert alert-info text-center">Tidak ada riwayat penilaian yang tersedia.</div>
            @else
            <div class="table-responsive">
                <table class="table table-bordered align-middle">
                <thead>
                    <tr>
                        <th>No</th>
                            <th>Nama Penilaian</th>
                            <th>Poin</th>
                        <th>Kategori</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($riwayat as $i => $item)
                    <tr>
                        <td>{{ $i+1 }}</td>
                        <td>{{ $item->assessment->judul ?? '-' }}</td>
                        <td>{{ $item->skor }}</td>
                            <td>
                                @if($item->kategori == 'Sehat' || $item->kategori == 'Ringan')
                                    <span class="badge badge-sehat-history">{{ $item->kategori }}</span>
                                @elseif($item->kategori == 'Sedang')
                                    <span class="badge badge-sedang-history">{{ $item->kategori }}</span>
                                @elseif($item->kategori == 'Berat')
                                    <span class="badge badge-berat-history">{{ $item->kategori }}</span>
                                @else
                                    <span class="badge bg-secondary badge-category">{{ $item->kategori }}</span> {{-- Use secondary for unknown categories --}}
                                @endif
                            </td>
                        <td>{{ $item->updated_at->format('d-m-Y H:i') }}</td>
                        <td>
                                <a href="{{ route('assessment.result', $item->id) }}" class="btn btn-info btn-sm btn-view-result">Lihat Hasil</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
            @endif
            <a href="{{ route('assessment.index') }}" class="btn btn-secondary mt-3" aria-label="Kembali">Kembali</a>
        </div>
    </div>
</div>
@endsection 