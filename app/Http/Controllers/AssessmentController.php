<?php

namespace App\Http\Controllers;

use App\Models\Assessment;
use App\Models\UserAssessment;
use App\Models\UserAnswer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AssessmentController extends Controller
{
    // Halaman awal assessment
    public function index()
    {
        // Ambil semua assessment yang tersedia
        $assessments = Assessment::all();
        return view('assessment.index', compact('assessments'));
    }

    // Mulai assessment (buat user_assessment baru)
    public function start($id)
    {
        $user = Auth::user();
        $assessment = Assessment::findOrFail($id);
        $userAssessment = UserAssessment::firstOrCreate([
            'user_id' => $user->id,
            'assessment_id' => $assessment->id,
            'selesai' => false
        ]);
        return redirect()->route('assessment.do', $userAssessment->id);
    }

    // Kerjakan assessment
    public function do($userAssessmentId)
    {
        $userAssessment = UserAssessment::with(['assessment.questions.choices'])->findOrFail($userAssessmentId);
        if ($userAssessment->selesai) {
            return redirect()->route('assessment.result', $userAssessment->id);
        }
        return view('assessment.kerjakan', compact('userAssessment'));
    }

    // Simpan jawaban
    public function submit(Request $request, $userAssessmentId)
    {
        $userAssessment = UserAssessment::with('assessment.questions.choices')->findOrFail($userAssessmentId);
        $totalSkor = 0;
        $jumlahSoal = $userAssessment->assessment->questions->count();
        foreach ($userAssessment->assessment->questions as $question) {
            $answer = $request->input('question_' . $question->id);
            if ($answer) {
                $choice = $question->choices->where('id', $answer)->first();
                // Ambil skor langsung dari isi_pilihan (yang berupa angka 1-5)
                $skor = is_numeric($choice->isi_pilihan) ? intval($choice->isi_pilihan) : 0;
                $totalSkor += $skor;
                UserAnswer::updateOrCreate(
                    [
                        'user_assessment_id' => $userAssessment->id,
                        'question_id' => $question->id
                    ],
                    [
                        'choice_id' => $answer
                    ]
                );
            }
        }
        // Kategori disesuaikan berdasarkan jumlah soal dan rentang skor 1-5 per soal
        $skorMaksimum = $jumlahSoal * 5;

        $kategori = 'Sehat'; // Rentang skor terendah

        // Contoh rentang proporsional (bisa disesuaikan)
        if ($totalSkor >= $skorMaksimum * 0.2 && $totalSkor < $skorMaksimum * 0.4) {
            $kategori = 'Ringan';
        } elseif ($totalSkor >= $skorMaksimum * 0.4 && $totalSkor < $skorMaksimum * 0.6) {
            $kategori = 'Sedang';
        } elseif ($totalSkor >= $skorMaksimum * 0.6) {
            $kategori = 'Berat';
        }

        $userAssessment->skor = $totalSkor;
        $userAssessment->kategori = $kategori;
        $userAssessment->selesai = true;
        $userAssessment->save();
        return redirect()->route('assessment.result', $userAssessment->id);
    }

    // Hasil assessment
    public function result($userAssessmentId)
    {
        $userAssessment = UserAssessment::with(['assessment', 'answers.choice'])->findOrFail($userAssessmentId);
        $skor = $userAssessment->skor;
        $kategori = $userAssessment->kategori;
        return view('assessment.result', compact('userAssessment', 'skor', 'kategori'));
    }

    // Riwayat assessment user
    public function history()
    {
        $user = Auth::user();
        $riwayat = UserAssessment::with('assessment')->where('user_id', $user->id)->where('selesai', true)->get();
        return view('assessment.history', compact('riwayat'));
    }
} 