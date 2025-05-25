@extends('layouts.app')

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
    <h2 class="history-header">Assessment History</h2>
    <div class="card history-card">
        <div class="card-body">
            @if($riwayat->isEmpty())
                <div class="alert alert-info text-center">No assessment history available.</div>
            @else
            <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Assessment Name</th>
                            <th>Score</th>
                            <th>Category</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($riwayat as $i => $item)
                        <tr>
                            <td>{{ $i+1 }}</td>
                            <td>{{ $item->assessment->judul ?? '-' }}</td>
                            <td>{{ $item->skor }}</td>
                            <td><span class="badge bg-primary badge-category">{{ $item->kategori }}</span></td>
                            <td>{{ $item->updated_at->format('d-m-Y H:i') }}</td>
                            <td>
                                <a href="{{ route('assessment.result', $item->id) }}" class="btn btn-info btn-sm btn-view-result">View Result</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endif
            <a href="{{ url('/') }}" class="btn btn-secondary mt-3">Back to Home</a>
        </div>
    </div>
</div>
@endsection 