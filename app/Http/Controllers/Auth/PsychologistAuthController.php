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
            'nama' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:psychologists',
            'password' => 'required|string|min:8|confirmed',
            'nomor_lisensi' => 'required|string|unique:psychologists',
            'spesialisasi' => 'required|string',
            'pengalaman' => 'required|integer',
            'biaya_konsultasi' => 'required|numeric',
            'deskripsi' => 'nullable|string',
        ]);

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
        ]);

        Auth::guard('psychologist')->login($psikolog);

        return redirect()->route('psikolog.dashboard')
            ->with('success', 'Registrasi berhasil! Selamat datang di dashboard psikolog.');
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        if (!Auth::guard('psychologist')->attempt($request->only('email', 'password'))) {
            return redirect()->back()
                ->withErrors(['email' => 'Email atau password salah'])
                ->withInput();
        }

        return redirect()->route('psikolog.dashboard')
            ->with('success', 'Login berhasil!');
    }

    public function logout(Request $request)
    {
        Auth::guard('psychologist')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('psikolog.login')
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

        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:psychologists,email,' . $psikolog->id,
            'spesialisasi' => 'required|string',
            'pengalaman' => 'required|integer',
            'biaya_konsultasi' => 'required|numeric',
            'deskripsi' => 'nullable|string',
            'foto_profil' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $request->except('foto_profil');

        if ($request->hasFile('foto_profil')) {
            // Pastikan folder tujuan ada
            if (!file_exists(storage_path('app/public/psikolog'))) {
                mkdir(storage_path('app/public/psikolog'), 0777, true);
            }
            // Hapus foto lama jika ada
            if ($psikolog->foto_profil) {
                Storage::delete($psikolog->foto_profil);
            }
            // Upload foto baru
            $path = $request->file('foto_profil')->store('public/psikolog');
            $data['foto_profil'] = str_replace('public/', '', $path);
        }

        $psikolog->update($data);

        return redirect()->route('psikolog.profile')
            ->with('success', 'Profil berhasil diperbarui!');
    }
} 