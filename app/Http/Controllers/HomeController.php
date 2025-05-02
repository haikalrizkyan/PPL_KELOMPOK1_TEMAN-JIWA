<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Membuat instance controller baru
     *
     * @return void
     */
    public function __construct()
    {
        // Menambahkan middleware auth untuk memastikan pengguna yang tidak login tidak bisa mengakses dashboard
        $this->middleware('auth');
    }

    /**
     * Menampilkan dashboard aplikasi
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Mendapatkan data pengguna yang sedang login
        $user = Auth::user();

        // Ambil assessment terakhir user
        $lastAssessment = \App\Models\Assessment::where('user_id', $user->id)->latest()->first();

        // Ambil 3 assessment terakhir untuk recent activity
        $recentAssessments = \App\Models\Assessment::where('user_id', $user->id)->latest()->take(3)->get();
        foreach ($recentAssessments as $assessment) {
            $assessment->activity_type = 'assessment';
        }

        // Ambil 3 top up terakhir untuk recent activity
        $recentTopups = DB::table('topup_logs')->where('user_id', $user->id)->latest()->take(3)->get();
        foreach ($recentTopups as $topup) {
            $topup->activity_type = 'topup';
        }

        // Gabungkan dan urutkan berdasarkan waktu terbaru
        $recentActivities = collect($recentAssessments)->merge($recentTopups)->sortByDesc(function($item) {
            return $item->created_at;
        })->take(3);

        // Mengirimkan data pengguna, assessment terakhir, dan recent activity ke view dashboard
        return view('dashboard', compact('user', 'lastAssessment', 'recentActivities'));
    }
}
