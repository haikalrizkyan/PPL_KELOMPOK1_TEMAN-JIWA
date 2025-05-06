<?php

namespace App\Http\Controllers;

use App\Models\AssessmentQuestion;
use Illuminate\Http\Request;

class AssessmentQuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $questions = AssessmentQuestion::orderBy('order')->get();
        return view('assessment.questions.index', compact('questions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('assessment.questions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required|string|max:1000',
            'order' => 'required|integer|min:0'
        ]);

        AssessmentQuestion::create($request->all());

        return redirect()->route('assessment.questions.index')
            ->with('success', 'Pertanyaan berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AssessmentQuestion $question)
    {
        return view('assessment.questions.edit', compact('question'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AssessmentQuestion $question)
    {
        $request->validate([
            'question' => 'required|string|max:1000',
            'order' => 'required|integer|min:0',
            'is_active' => 'boolean'
        ]);

        $question->update($request->all());

        return redirect()->route('assessment.questions.index')
            ->with('success', 'Pertanyaan berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AssessmentQuestion $question)
    {
        $question->delete();

        return redirect()->route('assessment.questions.index')
            ->with('success', 'Pertanyaan berhasil dihapus');
    }
}
