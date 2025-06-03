<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Psychologist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class PsychologistAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.psikolog.login');
    }

    public function showRegistrationForm()
    {
        return view('auth.psikolog.register');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'nama' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:psychologists',
            'password' => 'required|string|min:8|confirmed',
            'nomor_lisensi' => 'required|string|unique:psychologists',
            'spesialisasi' => 'required|string',
            'pengalaman' => 'required|integer',
            'biaya_konsultasi' => 'required|numeric',
            'deskripsi' => 'nullable|string',
        ]);

        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('psikolog', 'public'); // simpan di storage/app/public/psikolog
            $foto_profil = $path; // cukup simpan 'psikolog/nama-file.jpg' saja
        } else {
            $foto_profil = null;
        }
        
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $psikolog = Psychologist::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'nomor_lisensi' => $request->nomor_lisensi,
            'spesialisasi' => $request->spesialisasi,
            'pengalaman' => $request->pengalaman,
            'biaya_konsultasi' => $request->biaya_konsultasi,
            'deskripsi' => $request->deskripsi,
            'foto_profil' => $foto_profil,
        ]);

        Auth::guard('psychologist')->login($psikolog);

        return redirect()->route('psikolog.dashboard')
            ->with('success', 'Registrasi berhasil! Selamat datang di dashboard psikolog.');
    }

    public function login(Request $request)
    {
        \Log::info('Attempting psychologist login', [
            'email' => $request->email,
            'session' => session()->all()
        ]);

        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            \Log::warning('Psychologist login validation failed', [
                'errors' => $validator->errors()->toArray()
            ]);
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        if (!Auth::guard('psychologist')->attempt($request->only('email', 'password'))) {
            \Log::warning('Psychologist login failed - invalid credentials', [
                'email' => $request->email
            ]);
            return redirect()->back()
                ->withErrors(['email' => 'Email atau password salah'])
                ->withInput();
        }

        \Log::info('Psychologist login successful', [
            'user' => Auth::guard('psychologist')->user(),
            'session' => session()->all()
        ]);

        return redirect()->route('psikolog.dashboard')
            ->with('success', 'Login berhasil!');
    }

    public function logout(Request $request)
    {
        Auth::guard('psychologist')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/')
            ->with('success', 'Logout berhasil!');
    }

    public function dashboard()
    {
        $psikolog = Auth::guard('psychologist')->user();
        return view('psikolog.dashboard', compact('psikolog'));
    }

    public function profile()
    {
        $psikolog = Auth::guard('psychologist')->user();
        return view('psikolog.profile', compact('psikolog'));
    }

    public function updateProfile(Request $request)
{
    $psikolog = Auth::guard('psychologist')->user();

    $request->validate([
        'nama' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:psychologists,email,' . $psikolog->id,
        'spesialisasi' => 'required|string',
        'pengalaman' => 'required|integer',
        'biaya_konsultasi' => 'required|numeric',
        'deskripsi' => 'nullable|string',
        'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
    ]);

    // Simpan semua data biasa
    $psikolog->nama = $request->nama;
    $psikolog->email = $request->email;
    $psikolog->spesialisasi = $request->spesialisasi;
    $psikolog->pengalaman = $request->pengalaman;
    $psikolog->biaya_konsultasi = $request->biaya_konsultasi;
    $psikolog->deskripsi = $request->deskripsi;

    // Upload foto jika ada
    if ($request->hasFile('foto')) {
        if ($psikolog->foto_profil) {
            Storage::delete('public/' . $psikolog->foto_profil);
        }

        $path = $request->file('foto')->store('psikolog', 'public');
        $psikolog->foto_profil = $path; // karena path-nya sudah tanpa "public/"
    }

    //dd($request->file('foto'), $psikolog->foto_profil);
    // Simpan perubahan
    $psikolog->save();

    return redirect()->route('psikolog.profile')
        ->with('success', 'Profil berhasil diperbarui!');
}

} 