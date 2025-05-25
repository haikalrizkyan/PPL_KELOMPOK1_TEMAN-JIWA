@extends('layouts.app')

@section('content')
<style>
    body {
        font-family: 'Ubuntu', sans-serif !important;
        background-color: #F4FAF9 !important;
    }
    .assessment-edit-card {
        border-radius: 1.5rem !important;
        box-shadow: 0 8px 32px 0 rgba(76,169,163,0.10) !important;
        background: #fff !important;
        padding: 2.5rem 2rem 2rem 2rem;
    }
    .assessment-section-header {
        font-weight: 700;
        color: #264653;
        font-size: 1.3rem;
        margin-bottom: 1.5rem;
        border-bottom: 1px solid #eee;
        padding-bottom: 1rem;
    }
    .form-label {
      color: #264653;
      font-weight: 500;
    }
    .form-control:focus {
      border-color: #4CA9A3;
      box-shadow: 0 0 0 0.2rem rgba(76,169,163,0.15);
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
    .btn-secondary {
        border-radius: 2rem;
        padding-left: 1.5rem;
        padding-right: 1.5rem;
    }
     .btn-add-choice {
        border-radius: 2rem;
        padding: 0.375rem 1.5rem;
     }
     .btn-edit-question {
         border-radius: 2rem !important;
         padding: 0.25rem 1rem !important;
     }
     .btn-delete-question {
         border-radius: 2rem !important;
         padding: 0.25rem 1rem !important;
     }
    .input-group .form-control {
        border-radius: 0.25rem !important; /* Keep default for input group */
    }
    .input-group:first-child .form-control {
         border-top-left-radius: 0.25rem !important;
         border-bottom-left-radius: 0.25rem !important;
    }
    .input-group:last-child .form-control {
         border-top-right-radius: 0.25rem !important;
         border-bottom-right-radius: 0.25rem !important;
    }
     .table td form {
         margin-bottom: 0;
     }
</style>
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mb-4 assessment-edit-card">
                <div class="card-header" style="background: none; border-bottom: none; padding-bottom: 0;">
                    @if(isset($editQuestion))
                        <h3 class="assessment-section-header">Edit Question</h3>
                    @else
                        <h3 class="assessment-section-header">Add Assessment Question</h3>
                    @endif
                </div>
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
                                <label for="pertanyaan" class="form-label">Question</label>
                                <input type="text" class="form-control" id="pertanyaan" name="pertanyaan" value="{{ old('pertanyaan', $editQuestion->pertanyaan) }}" required placeholder="Enter question text">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Choices</label>
                                <div id="edit-pilihan-container">
                                    @foreach($editQuestion->choices as $i => $choice)
                                        <div class="input-group mb-2">
                                            <input type="text" name="choices[{{ $i }}][isi_pilihan]" class="form-control" placeholder="Choice {{ $i+1 }}" value="{{ $choice->isi_pilihan }}" required>
                                        </div>
                                    @endforeach
                                </div>
                                <button type="button" class="btn btn-sm btn-secondary mt-2 btn-add-choice" id="edit-tambah-pilihan">Add Choice</button>
                            </div>
                            <button type="submit" class="btn btn-temanjiwa me-2">Update Question</button>
                            <a href="{{ route('psikolog.assessment.edit', $assessment->id) }}" class="btn btn-secondary">Cancel</a>
                        </form>
                    @else
                        <form method="POST" action="{{ route('psikolog.assessment.storeQuestion', $assessment->id) }}">
                            @csrf
                            <div class="mb-3">
                                <label for="pertanyaan" class="form-label">Question</label>
                                <input type="text" class="form-control" id="pertanyaan" name="pertanyaan" value="{{ old('pertanyaan') }}" required placeholder="Enter question text">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Choices</label>
                                <div id="pilihan-container">
                                    <div class="input-group mb-2">
                                        <input type="text" name="choices[0][isi_pilihan]" class="form-control" placeholder="Choice 1" required>
                                    </div>
                                    <div class="input-group mb-2">
                                        <input type="text" name="choices[1][isi_pilihan]" class="form-control" placeholder="Choice 2" required>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-sm btn-secondary mt-2 btn-add-choice" id="tambah-pilihan">Add Choice</button>
                            </div>
                            <button type="submit" class="btn btn-temanjiwa me-2">Save Question</button>
                            <a href="{{ route('psikolog.assessment.index') }}" class="btn btn-secondary">Done</a>
                        </form>
                    @endif
                </div>
            </div>
            <div class="card mb-4 assessment-edit-card">
                <div class="card-header" style="background: none; border-bottom: none; padding-bottom: 0;">
                    <h3 class="assessment-section-header">Edit Assessment Details</h3>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('psikolog.assessment.update', $assessment->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="judul" class="form-label">Assessment Name</label>
                            <input type="text" class="form-control" id="judul" name="judul" value="{{ old('judul', $assessment->judul) }}" required placeholder="Enter assessment name">
                        </div>
                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Assessment Description</label>
                            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" placeholder="Enter assessment description">{{ old('deskripsi', $assessment->deskripsi) }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-temanjiwa">Save Assessment Details</button>
                    </form>
                </div>
            </div>
            @if(isset($assessment) && $assessment->questions->count())
                <div class="card assessment-edit-card">
                    <div class="card-header" style="background: none; border-bottom: none; padding-bottom: 0;">
                        <h3 class="assessment-section-header">Question List</h3>
                    </div>
                    <div class="card-body">
                        <ol>
                            @foreach($assessment->questions as $q)
                                <li class="mb-3 pb-3" style="border-bottom: 1px solid #eee;">
                                    <strong>{{ $q->pertanyaan }}</strong>
                                    <ul class="mt-2 mb-2">
                                        @foreach($q->choices as $c)
                                            <li>{{ $c->isi_pilihan }}</li>
                                        @endforeach
                                    </ul>
                                    <a href="{{ route('psikolog.assessment.editQuestion', [$assessment->id, $q->id]) }}" class="btn btn-sm btn-primary me-2 btn-edit-question">Edit</a>
                                    <form action="{{ route('psikolog.assessment.deleteQuestion', [$assessment->id, $q->id]) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this question?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger btn-delete-question">Delete</button>
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
    let pilihanIndex = {{ isset($editQuestion) ? $editQuestion->choices->count() : 2 }};
    if(document.getElementById('tambah-pilihan')){
        document.getElementById('tambah-pilihan').onclick = function() {
            const container = document.getElementById('pilihan-container');
            const div = document.createElement('div');
            div.className = 'input-group mb-2';
            div.innerHTML = `<input type=\"text\" name=\"choices[${pilihanIndex}][isi_pilihan]\" class=\"form-control\" placeholder=\"Choice ${pilihanIndex+1}\" required>`;
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
            div.innerHTML = `<input type=\"text\" name=\"choices[${editPilihanIndex}][isi_pilihan]\" class=\"form-control\" placeholder=\"Choice ${editPilihanIndex+1}\" required>`;
            container.appendChild(div);
            editPilihanIndex++;
        };
    }
</script>
@endsection 