<?php

namespace App\Http\Controllers;

use App\Models\Assessment;
use App\Models\AssessmentQuestion;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AssessmentController extends Controller
{
    public function index()
    {
        $questions = AssessmentQuestion::where('is_active', true)
            ->orderBy('order')
            ->get();
        return view('assessment.index', compact('questions'));
    }

    public function store(Request $request)
    {
        $data = $request->except('_token');

        Assessment::create([
            'user_id' => Auth::id(),
            'answers' => $data,
        ]);

        return redirect()->route('assessment.history')->with('success', 'Assessment berhasil disimpan.');
    }

    public function history()
    {
        $assessments = Assessment::where('user_id', Auth::id())->latest()->get();

        foreach ($assessments as $assessment) {
            $score = 0;

            foreach ($assessment->answers as $answer) {
                switch ($answer) {
                    case 'Jarang':
                        $score += 1;
                        break;
                    case 'Kadang-kadang':
                        $score += 2;
                        break;
                    case 'Sering':
                        $score += 3;
                        break;
                    case 'Sangat Sering':
                        $score += 4;
                        break;
                    default: // "Tidak Pernah" atau undefined
                        $score += 0;
                }
            }

            if ($score <= 15) {
                $assessment->result = 'Tidak ada indikasi gangguan mental';
            } elseif ($score <= 30) {
                $assessment->result = 'Indikasi gangguan ringan';
            } elseif ($score <= 45) {
                $assessment->result = 'Indikasi gangguan sedang';
            } else {
                $assessment->result = 'Indikasi gangguan berat';
            }

            $assessment->score = $score;
        }

        return view('assessment.history', compact('assessments'));
    }
}
