<?php

namespace App\Http\Controllers\Psychologist;

use App\Http\Controllers\Controller;
use App\Models\Assessment;
use App\Models\Question;
use App\Models\Choice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AssessmentController extends Controller
{
    // Daftar assessment milik psikolog
    public function index()
    {
        $assessments = Assessment::where('psychologist_id', Auth::guard('psychologist')->id())->get();
        return view('psikolog.assessment.index', compact('assessments'));
    }

    // Form tambah assessment
    public function create()
    {
        // Return view untuk form tambah assessment
        return view('psikolog.assessment.create');
    }

    // Simpan assessment baru
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        Assessment::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'psychologist_id' => Auth::guard('psychologist')->id(),
        ]);

        return redirect()->route('psikolog.assessment.index')->with('success', 'Assessment berhasil ditambahkan.');
    }

    // Edit assessment & pertanyaan
    public function edit($id)
    {
        $assessment = Assessment::with('questions.choices')->where('psychologist_id', Auth::guard('psychologist')->id())->findOrFail($id);
        return view('psikolog.assessment.edit', compact('assessment'));
    }

    // Update assessment
    public function update(Request $request, $id)
    {
        $assessment = Assessment::where('psychologist_id', Auth::guard('psychologist')->id())->findOrFail($id);
        $assessment->update($request->only('judul', 'deskripsi'));
        return back()->with('success', 'Assessment diperbarui.');
    }

    // Hapus assessment
    public function destroy($id)
    {
        $assessment = Assessment::where('psychologist_id', Auth::guard('psychologist')->id())->findOrFail($id);
        $assessment->delete();
        return redirect()->route('psikolog.assessment.index')->with('success', 'Assessment dihapus.');
    }

    // Tambah pertanyaan
    public function storeQuestion(Request $request, $assessmentId)
    {
        $request->validate([
            'pertanyaan' => 'required',
        ]);
        $question = Question::create([
            'assessment_id' => $assessmentId,
            'pertanyaan' => $request->pertanyaan,
        ]);
        // Otomatis membuat pilihan 1 sampai 5
        for ($i = 1; $i <= 5; $i++) {
            Choice::create([
                'question_id' => $question->id,
                'isi_pilihan' => $i, // Isi pilihan adalah angka 1-5
                'score' => $i, // Skor sama dengan isi pilihan
                'is_correct' => false,
            ]);
        }
        return back()->with('success', 'Pertanyaan berhasil ditambahkan.');
    }

    // Hapus pertanyaan
    public function destroyQuestion($assessmentId, $questionId)
    {
        $question = Question::where('assessment_id', $assessmentId)->findOrFail($questionId);
        $question->delete();
        return back()->with('success', 'Pertanyaan dihapus.');
    }

    public function editQuestion($assessmentId, $questionId)
    {
        $assessment = Assessment::with('questions.choices')->where('psychologist_id', Auth::guard('psychologist')->id())->findOrFail($assessmentId);
        $editQuestion = Question::with('choices')->where('assessment_id', $assessmentId)->findOrFail($questionId);
        return view('psikolog.assessment.edit', compact('assessment', 'editQuestion'));
    }

    public function updateQuestion(Request $request, $assessmentId, $questionId)
    {
        $request->validate([
            'pertanyaan' => 'required',
            'choices' => 'required|array|min:2',
            'choices.*.isi_pilihan' => 'required',
        ]);
        $question = Question::where('assessment_id', $assessmentId)->findOrFail($questionId);
        $question->update(['pertanyaan' => $request->pertanyaan]);
        // Hapus pilihan lama
        $question->choices()->delete();
        // Simpan pilihan baru
        foreach ($request->choices as $choice) {
            $question->choices()->create([
                'isi_pilihan' => $choice['isi_pilihan'],
                'score' => $choice['score'] ?? 0,
                'is_correct' => false,
            ]);
        }
        return redirect()->route('psikolog.assessment.edit', $assessmentId)->with('success', 'Pertanyaan berhasil diperbarui.');
    }
} 