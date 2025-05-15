@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Riwayat Assessment</h2>
    <div class="card mt-4">
        <div class="card-body">
            @if($riwayat->isEmpty())
                <p>Belum ada riwayat assessment.</p>
            @else
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Assessment</th>
                        <th>Skor</th>
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
                        <td><span class="badge bg-primary">{{ $item->kategori }}</span></td>
                        <td>{{ $item->updated_at->format('d-m-Y H:i') }}</td>
                        <td>
                            <a href="{{ route('assessment.result', $item->id) }}" class="btn btn-info btn-sm">Lihat Hasil</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @endif
            <a href="{{ url('/') }}" class="btn btn-secondary mt-3">Kembali ke Beranda</a>
        </div>
    </div>
</div>
@endsection 