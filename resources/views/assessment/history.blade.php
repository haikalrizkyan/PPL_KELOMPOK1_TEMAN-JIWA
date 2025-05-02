@extends('layouts.app')

@section('title', 'Riwayat Assessment')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">📊 Riwayat Assessment</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @forelse($assessments as $assessment)
        @php
            $jawaban = $assessment->answers;
            $labels = [
                'Tidak Pernah' => 'secondary',
                'Jarang' => 'info',
                'Kadang-kadang' => 'warning',
                'Sering' => 'primary',
                'Sangat Sering' => 'danger',
            ];
        @endphp

        <div class="card mb-4 shadow-sm rounded-4">
            <div class="card-body">
                <h5 class="card-title mb-3">📝 Assessment #{{ $loop->iteration }}</h5>

                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead class="table-light">
                            <tr>
                                <th>Pertanyaan</th>
                                <th>Jawaban</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($jawaban as $key => $value)
                                <tr>
                                    <td>{{ Str::replace('question', 'Pertanyaan ', $key) }}</td>
                                    <td>
                                        <span class="badge bg-{{ $labels[$value] ?? 'secondary' }} px-3 py-2">
                                            {{ $value }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-3">
                    <p><strong>📅 Tanggal:</strong> {{ \Carbon\Carbon::parse($assessment->created_at)->format('d M Y, H:i') }}</p>
                    <p><strong>💯 Skor:</strong> <span class="text-success fw-bold">{{ $assessment->score }}</span></p>
                    <p><strong>🧾 Hasil:</strong> {{ $assessment->result }}</p>
                </div>
            </div>
        </div>
    @empty
        <div class="alert alert-info">Belum ada data assessment.</div>
    @endforelse
</div>
@endsection
