@extends('layouts.app')

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
        <h2 class="assessment-header mb-0">My Assessments</h2>
        <a href="{{ route('psikolog.assessment.create') }}" class="btn btn-temanjiwa">
            <i class="fas fa-plus"></i> Add Assessment
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
                        <th>Question</th>
                        <th style="width: 140px;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($assessments as $assessment)
                        @foreach($assessment->questions as $q)
                            <tr>
                                <td>{{ $no++ }}. {{ $q->pertanyaan }}</td>
                                <td>
                                    <a href="{{ route('psikolog.assessment.editQuestion', [$assessment->id, $q->id]) }}" class="btn btn-sm btn-primary btn-edit">Edit</a>
                                    <form action="{{ route('psikolog.assessment.deleteQuestion', [$assessment->id, $q->id]) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this question?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger btn-delete">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
            @if($assessments->sum(fn($a) => $a->questions->count()) == 0)
                <div class="text-center text-muted">No assessments yet. Click the add button to create a new assessment.</div>
            @endif
        </div>
    </div>
</div>
@endsection 