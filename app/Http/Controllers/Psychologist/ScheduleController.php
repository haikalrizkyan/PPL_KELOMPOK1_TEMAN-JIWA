<?php

namespace App\Http\Controllers\Psychologist;

use App\Http\Controllers\Controller;
use App\Models\PsychologistSchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ScheduleController extends Controller
{
    public function index()
    {
        \Log::info('Accessing schedule index', [
            'auth_check' => Auth::guard('psychologist')->check(),
            'user' => Auth::guard('psychologist')->user(),
            'session' => session()->all()
        ]);

        // Get all schedules without grouping first
        $allSchedules = PsychologistSchedule::where('psychologist_id', Auth::guard('psychologist')->id())
            ->orderBy('tanggal')
            ->orderBy('jam_mulai')
            ->get();

        // Group the schedules by date after getting them
        $schedules = $allSchedules->groupBy('tanggal');

        return view('psikolog.schedule.index', compact('schedules', 'allSchedules'));
    }

    public function create()
    {
        \Log::info('Accessing schedule create', [
            'auth_check' => Auth::guard('psychologist')->check(),
            'user' => Auth::guard('psychologist')->user(),
            'session' => session()->all()
        ]);

        return view('psikolog.schedule.create');
    }

    public function store(Request $request)
    {
        \Log::info('Attempting to store schedule', [
            'auth_check' => Auth::guard('psychologist')->check(),
            'user' => Auth::guard('psychologist')->user(),
            'request' => $request->all(),
            'session' => session()->all()
        ]);

        $validator = Validator::make($request->all(), [
            'tanggal' => 'required|date|after_or_equal:today',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
        ]);

        if ($validator->fails()) {
            \Log::warning('Schedule validation failed', [
                'errors' => $validator->errors()->toArray()
            ]);
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Format waktu ke format yang benar
        $jamMulai = date('H:i:s', strtotime($request->jam_mulai));
        $jamSelesai = date('H:i:s', strtotime($request->jam_selesai));

        // Check for overlapping schedules
        $overlapping = PsychologistSchedule::where('psychologist_id', Auth::guard('psychologist')->id())
            ->where('tanggal', $request->tanggal)
            ->where(function ($query) use ($jamMulai, $jamSelesai) {
                $query->whereBetween('jam_mulai', [$jamMulai, $jamSelesai])
                    ->orWhereBetween('jam_selesai', [$jamMulai, $jamSelesai])
                    ->orWhere(function ($q) use ($jamMulai, $jamSelesai) {
                        $q->where('jam_mulai', '<=', $jamMulai)
                            ->where('jam_selesai', '>=', $jamSelesai);
                    });
            })
            ->exists();

        if ($overlapping) {
            \Log::warning('Schedule overlap detected', [
                'request' => $request->all()
            ]);
            return redirect()->back()
                ->withErrors(['jam_mulai' => 'Jadwal bertabrakan dengan jadwal yang sudah ada'])
                ->withInput();
        }

        try {
            $schedule = PsychologistSchedule::create([
                'psychologist_id' => Auth::guard('psychologist')->id(),
                'tanggal' => $request->tanggal,
                'jam_mulai' => $jamMulai,
                'jam_selesai' => $jamSelesai,
                'is_available' => true
            ]);

            \Log::info('Schedule created successfully', [
                'schedule' => $schedule
            ]);

            return redirect()->route('psikolog.schedule.index')
                ->with('success', 'Jadwal berhasil ditambahkan');
        } catch (\Exception $e) {
            \Log::error('Failed to create schedule', [
                'error' => $e->getMessage(),
                'request' => $request->all()
            ]);
            
            return redirect()->back()
                ->withErrors(['error' => 'Terjadi kesalahan saat menyimpan jadwal. Silakan coba lagi.'])
                ->withInput();
        }
    }

    public function edit(PsychologistSchedule $schedule)
    {
        if ($schedule->psychologist_id !== Auth::guard('psychologist')->id()) {
            return redirect()->route('psikolog.schedule.index')
                ->with('error', 'Anda tidak memiliki akses untuk mengedit jadwal ini.');
        }

        return view('psikolog.schedule.edit', compact('schedule'));
    }

    public function update(Request $request, PsychologistSchedule $schedule)
    {
        if ($schedule->psychologist_id !== Auth::guard('psychologist')->id()) {
            return redirect()->route('psikolog.schedule.index')
                ->with('error', 'Anda tidak memiliki akses untuk mengedit jadwal ini.');
        }

        $request->validate([
            'tanggal' => 'required|date|after_or_equal:today',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
        ]);

        // Check for overlapping schedules excluding current schedule
        $overlapping = PsychologistSchedule::where('psychologist_id', Auth::guard('psychologist')->id())
            ->where('id', '!=', $schedule->id)
            ->where('tanggal', $request->tanggal)
            ->where(function($query) use ($request) {
                $query->whereBetween('jam_mulai', [$request->jam_mulai, $request->jam_selesai])
                    ->orWhereBetween('jam_selesai', [$request->jam_mulai, $request->jam_selesai])
                    ->orWhere(function($q) use ($request) {
                        $q->where('jam_mulai', '<=', $request->jam_mulai)
                            ->where('jam_selesai', '>=', $request->jam_selesai);
                    });
            })
            ->exists();

        if ($overlapping) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['jam_mulai' => 'Jadwal ini bertabrakan dengan jadwal yang sudah ada.']);
        }

        $schedule->update([
            'tanggal' => $request->tanggal,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
        ]);

        return redirect()->route('psikolog.schedule.index')
            ->with('success', 'Jadwal berhasil diperbarui.');
    }

    public function destroy(PsychologistSchedule $schedule)
    {
        if ($schedule->psychologist_id !== Auth::guard('psychologist')->id()) {
            return redirect()->route('psikolog.schedule.index')
                ->with('error', 'Anda tidak memiliki akses untuk menghapus jadwal ini.');
        }

        $schedule->delete();

        return redirect()->route('psikolog.schedule.index')
            ->with('success', 'Jadwal berhasil dihapus.');
    }

    public function toggleAvailability(PsychologistSchedule $schedule)
    {
        if ($schedule->psychologist_id !== Auth::guard('psychologist')->id()) {
            return redirect()->route('psikolog.schedule.index')
                ->with('error', 'Anda tidak memiliki akses untuk mengubah ketersediaan jadwal ini.');
        }

        $schedule->update(['is_available' => !$schedule->is_available]);

        return redirect()->route('psikolog.schedule.index')
            ->with('success', 'Status ketersediaan jadwal berhasil diubah.');
    }
} 