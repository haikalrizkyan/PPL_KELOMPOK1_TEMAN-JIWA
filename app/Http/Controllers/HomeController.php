<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        // Ambil hasil assessment terakhir user yang sudah selesai
        $lastAssessment = \App\Models\UserAssessment::with('assessment')
            ->where('user_id', $user->id)
            ->where('selesai', true)
            ->orderByDesc('updated_at')
            ->first();
        // Mengirimkan data pengguna dan hasil assessment terakhir ke view dashboard
        return view('dashboard', compact('user', 'lastAssessment'));
    }

    public function editProfile()
    {
        $user = auth()->user();
        return view('profile.edit', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = auth()->user();
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'tanggal_lahir' => 'nullable|date',
            'jenis_kelamin' => 'nullable|in:Laki-laki,Perempuan',
            'alamat' => 'nullable|string',
            'nomor_telepon' => 'nullable|string',
        ]);
        $user->update($request->only('nama', 'email', 'tanggal_lahir', 'jenis_kelamin', 'alamat', 'nomor_telepon'));
        return redirect()->route('profile.edit')->with('success', 'Profil berhasil diperbarui!');
    }
}
