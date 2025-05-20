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

        $user = Auth::user();
        $biaya = $psychologist->biaya_konsultasi;

        // Check if user has sufficient balance
        if ($user->saldo < $biaya) {
            return redirect()->back()->with('error', 'Saldo tidak cukup untuk melakukan booking. Silakan top up saldo terlebih dahulu.');
        }

        // Create booking
        $booking = Booking::create([
            'user_id' => $user->id,
            'psychologist_id' => $psychologist->id,
            'tanggal' => $request->tanggal,
            'jam' => $request->jam,
            'catatan' => $request->catatan,
            'status' => 'paid', // Set status langsung ke paid karena sudah dibayar
        ]);

        // Deduct balance
        $user->saldo -= $biaya;
        $user->save();

        return redirect()->route('konsultasi.index')->with('success', 'Booking konsultasi berhasil! Saldo Anda telah dikurangi sebesar Rp ' . number_format($biaya, 0, ',', '.'));
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

    public function editBooking(Booking $booking)
    {
        if ($booking->user_id !== Auth::id() || $booking->status !== 'pending') {
            return redirect()->route('konsultasi.jadwal.user')->with('error', 'Tidak diizinkan mengedit booking ini.');
        }
        return view('konsultasi.edit_booking', compact('booking'));
    }

    public function updateBooking(Request $request, Booking $booking)
    {
        if ($booking->user_id !== Auth::id() || $booking->status !== 'pending') {
            return redirect()->route('konsultasi.jadwal.user')->with('error', 'Tidak diizinkan mengedit booking ini.');
        }
        $request->validate([
            'tanggal' => 'required|date|after_or_equal:today',
            'jam' => 'required',
            'catatan' => 'nullable|string',
        ]);
        $booking->update([
            'tanggal' => $request->tanggal,
            'jam' => $request->jam,
            'catatan' => $request->catatan,
        ]);
        return redirect()->route('konsultasi.jadwal.user')->with('success', 'Booking berhasil diupdate!');
    }

    public function deleteBooking(Booking $booking)
    {
        if ($booking->user_id !== Auth::id() || $booking->status !== 'pending') {
            return redirect()->route('konsultasi.jadwal.user')->with('error', 'Tidak diizinkan menghapus booking ini.');
        }
        $booking->delete();
        return redirect()->route('konsultasi.jadwal.user')->with('success', 'Booking berhasil dihapus!');
    }
} 