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
        
        $psikologs = Psychologist::where('status', 'aktif')->get();
        return view('konsultasi.index', compact('psikologs'));
    }

    public function bookingForm(Psychologist $psychologist)
    {
        // Get available schedules for the next 7 days
        $startDate = now();
        $endDate = now()->addDays(7);
        
        $availableSchedules = $psychologist->schedules()
            ->where('is_available', true)
            ->whereBetween('tanggal', [$startDate, $endDate])
            ->orderBy('tanggal')
            ->orderBy('jam_mulai')
            ->get()
            ->groupBy('tanggal');

        // Get existing bookings for the same period
        $existingBookings = Booking::where('psychologist_id', $psychologist->id)
            ->whereBetween('tanggal', [$startDate, $endDate])
            ->get();

        return view('konsultasi.booking', compact('psychologist', 'availableSchedules', 'existingBookings'));
    }

    public function bookingStore(Request $request, Psychologist $psychologist)
    {
        $request->validate([
            'tanggal' => 'required|date|after_or_equal:today',
            'jam' => 'required',
            'catatan' => 'nullable|string',
        ]);

        // Check if the selected time slot is available
        $schedule = $psychologist->schedules()
            ->where('tanggal', $request->tanggal)
            ->where('jam_mulai', $request->jam)
            ->where('is_available', true)
            ->first();

        if (!$schedule) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['jam' => 'Jadwal yang dipilih tidak tersedia.']);
        }

        // Check if the time slot is already booked
        $existingBooking = Booking::where('psychologist_id', $psychologist->id)
            ->where('tanggal', $request->tanggal)
            ->where('jam', $request->jam)
            ->exists();

        if ($existingBooking) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['jam' => 'Jadwal ini sudah dipesan oleh pasien lain.']);
        }

        $user = Auth::user();
        $biaya = $psychologist->biaya_konsultasi;

        if ($user->saldo < $biaya) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['saldo' => 'Saldo tidak cukup untuk melakukan booking. Silakan top up saldo terlebih dahulu.']);
        }

        $booking = Booking::create([
            'user_id' => $user->id,
            'psychologist_id' => $psychologist->id,
            'tanggal' => $request->tanggal,
            'jam' => $request->jam,
            'catatan' => $request->catatan,
            'status' => 'paid',
        ]);

        $user->saldo -= $biaya;
        $user->save();

        return redirect()->route('konsultasi.index')
            ->with('success', 'Booking konsultasi berhasil! Saldo Anda telah dikurangi sebesar Rp ' . number_format($biaya, 0, ',', '.'));
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

    // Metode baru untuk mengupdate Google Meet link
    public function updateGmeetLink(Request $request, Booking $booking)
    {
        // Pastikan psikolog yang login adalah psikolog yang terkait dengan booking ini
        if ($booking->psychologist_id !== Auth::guard('psychologist')->id()) {
            return back()->with('error', 'Tidak diizinkan mengupdate booking ini.');
        }

        $request->validate([
            'gmeet_link' => 'nullable|url',
        ]);

        $booking->gmeet_link = $request->gmeet_link;
        $booking->save();

        return back()->with('success', 'Link Google Meet berhasil diperbarui.');
    }

    public function completeConsultation(Booking $booking)
    {
        // Check if the user is authorized to complete this consultation
        if (Auth::guard('psychologist')->check()) {
            if ($booking->psychologist_id !== Auth::guard('psychologist')->id()) {
                return back()->with('error', 'Tidak diizinkan menyelesaikan konsultasi ini.');
            }
        } else {
            if ($booking->user_id !== Auth::id()) {
                return back()->with('error', 'Tidak diizinkan menyelesaikan konsultasi ini.');
            }
        }

        // Check if the consultation has already been completed
        if ($booking->completed_at) {
            return back()->with('error', 'Konsultasi ini sudah diselesaikan.');
        }

        // Mark the consultation as completed
        $booking->completed_at = now();
        $booking->save();

        return back()->with('success', 'Konsultasi berhasil diselesaikan.');
    }
} 