@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header">@if(isset($editQuestion)) Edit Pertanyaan @else Tambah Pertanyaan Assessment @endif</div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if(isset($editQuestion))
                        <form method="POST" action="{{ route('psikolog.assessment.updateQuestion', [$assessment->id, $editQuestion->id]) }}">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="pertanyaan" class="form-label">Pertanyaan</label>
                                <input type="text" class="form-control" id="pertanyaan" name="pertanyaan" value="{{ old('pertanyaan', $editQuestion->pertanyaan) }}" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Pilihan Ganda</label>
                                <div id="edit-pilihan-container">
                                    @foreach($editQuestion->choices as $i => $choice)
                                        <div class="input-group mb-2">
                                            <input type="text" name="choices[{{ $i }}][isi_pilihan]" class="form-control" placeholder="Pilihan {{ $i+1 }}" value="{{ $choice->isi_pilihan }}" required>
                                        </div>
                                    @endforeach
                                </div>
                                <button type="button" class="btn btn-sm btn-secondary" id="edit-tambah-pilihan">Tambah Pilihan</button>
                            </div>
                            <button type="submit" class="btn btn-primary">Update Pertanyaan</button>
                            <a href="{{ route('psikolog.assessment.edit', $assessment->id) }}" class="btn btn-secondary">Batal</a>
                        </form>
                    @else
                        <form method="POST" action="{{ route('psikolog.assessment.storeQuestion', $assessment->id) }}">
                            @csrf
                            <div class="mb-3">
                                <label for="pertanyaan" class="form-label">Pertanyaan</label>
                                <input type="text" class="form-control" id="pertanyaan" name="pertanyaan" value="{{ old('pertanyaan') }}" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Pilihan Ganda</label>
                                <div id="pilihan-container">
                                    <div class="input-group mb-2">
                                        <input type="text" name="choices[0][isi_pilihan]" class="form-control" placeholder="Pilihan 1" required>
                                    </div>
                                    <div class="input-group mb-2">
                                        <input type="text" name="choices[1][isi_pilihan]" class="form-control" placeholder="Pilihan 2" required>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-sm btn-secondary" id="tambah-pilihan">Tambah Pilihan</button>
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan Pertanyaan</button>
                            <a href="{{ route('psikolog.assessment.index') }}" class="btn btn-secondary">Selesai</a>
                        </form>
                    @endif
                </div>
            </div>
            <div class="card mb-4">
                <div class="card-header">Edit Assessment</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('psikolog.assessment.update', $assessment->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="judul" class="form-label">Nama Assessment</label>
                            <input type="text" class="form-control" id="judul" name="judul" value="{{ old('judul', $assessment->judul) }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi Assessment</label>
                            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3">{{ old('deskripsi', $assessment->deskripsi) }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan Nama Assessment</button>
                    </form>
                </div>
            </div>
            @if(isset($assessment) && $assessment->questions->count())
                <div class="card">
                    <div class="card-header">Daftar Pertanyaan</div>
                    <div class="card-body">
                        <ol>
                            @foreach($assessment->questions as $q)
                                <li class="mb-2">
                                    <strong>{{ $q->pertanyaan }}</strong>
                                    <ul>
                                        @foreach($q->choices as $c)
                                            <li>{{ $c->isi_pilihan }}</li>
                                        @endforeach
                                    </ul>
                                    <a href="{{ route('psikolog.assessment.editQuestion', [$assessment->id, $q->id]) }}" class="btn btn-sm btn-info">Edit</a>
                                    <form action="{{ route('psikolog.assessment.deleteQuestion', [$assessment->id, $q->id]) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus pertanyaan ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                    </form>
                                </li>
                            @endforeach
                        </ol>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
<script>
    let pilihanIndex = 2;
    if(document.getElementById('tambah-pilihan')){
        document.getElementById('tambah-pilihan').onclick = function() {
            const container = document.getElementById('pilihan-container');
            const div = document.createElement('div');
            div.className = 'input-group mb-2';
            div.innerHTML = `<input type=\"text\" name=\"choices[${pilihanIndex}][isi_pilihan]\" class=\"form-control\" placeholder=\"Pilihan ${pilihanIndex+1}\" required>`;
            container.appendChild(div);
            pilihanIndex++;
        };
    }
    if(document.getElementById('edit-tambah-pilihan')){
        let editPilihanIndex = {{ isset($editQuestion) ? $editQuestion->choices->count() : 2 }};
        document.getElementById('edit-tambah-pilihan').onclick = function() {
            const container = document.getElementById('edit-pilihan-container');
            const div = document.createElement('div');
            div.className = 'input-group mb-2';
            div.innerHTML = `<input type=\"text\" name=\"choices[${editPilihanIndex}][isi_pilihan]\" class=\"form-control\" placeholder=\"Pilihan ${editPilihanIndex+1}\" required>`;
            container.appendChild(div);
            editPilihanIndex++;
        };
    }
</script>
@endsection 