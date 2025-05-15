<?php

namespace App\Http\Controllers;

use App\Models\Psychologist;
use Illuminate\Http\Request;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;

class ConsultationController extends Controller
{
    public function index()
    {
        // Ambil semua psikolog yang statusnya aktif
        $psikologs = Psychologist::where('status', 'aktif')->get();
        return view('konsultasi.index', compact('psikologs'));
    }

    public function bookingForm(Psychologist $psychologist)
    {
        return view('konsultasi.booking', compact('psychologist'));
    }

    public function bookingStore(Request $request, Psychologist $psychologist)
    {
        $request->validate([
            'tanggal' => 'required|date|after_or_equal:today',
            'jam' => 'required',
            'catatan' => 'nullable|string',
        ]);

        Booking::create([
            'user_id' => Auth::id(),
            'psychologist_id' => $psychologist->id,
            'tanggal' => $request->tanggal,
            'jam' => $request->jam,
            'catatan' => $request->catatan,
            'status' => 'pending',
        ]);

        return redirect()->route('konsultasi.index')->with('success', 'Booking konsultasi berhasil!');
    }

    public function jadwalUser()
    {
        $bookings = Booking::with('psychologist')
            ->where('user_id', Auth::id())
            ->orderBy('tanggal', 'desc')
            ->orderBy('jam', 'desc')
            ->get();
        return view('konsultasi.jadwal_user', compact('bookings'));
    }

    public function bayarBooking(Request $request, Booking $booking)
    {
        $user = Auth::user();
        $biaya = $booking->psychologist->biaya_konsultasi;

        if ($booking->user_id !== $user->id) {
            return back()->with('error', 'Akses tidak diizinkan.');
        }
        if ($booking->status !== 'pending') {
            return back()->with('error', 'Booking sudah dibayar atau tidak valid.');
        }
        if ($user->saldo < $biaya) {
            return back()->with('error', 'Saldo tidak cukup untuk melakukan pembayaran.');
        }

        // Kurangi saldo user
        $user->saldo -= $biaya;
        $user->save();

        // Update status booking
        $booking->status = 'paid';
        $booking->save();

        return back()->with('success', 'Pembayaran berhasil! Anda bisa mulai konsultasi.');
    }

    public function jadwalPsikolog()
    {
        $psikolog = Auth::guard('psychologist')->user();
        $bookings = Booking::with('psychologist', 'user')
            ->where('psychologist_id', $psikolog->id)
            ->orderBy('tanggal', 'desc')
            ->orderBy('jam', 'desc')
            ->get();
        return view('psikolog.jadwal_konsultasi', compact('bookings', 'psikolog'));
    }
} 