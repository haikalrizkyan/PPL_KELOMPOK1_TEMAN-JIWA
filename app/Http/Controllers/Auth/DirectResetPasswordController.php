<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Psychologist;

class DirectResetPasswordController extends Controller
{
    // Untuk user & psikolog sekaligus
    public function handle(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'email' => 'required|email',
                'password' => 'required|string|min:8|confirmed',
            ]);

            $email = $request->input('email');
            $password = $request->input('password');

            // Cek di tabel users
            $user = User::where('email', $email)->first();
            if ($user) {
                $user->password = Hash::make($password);
                $user->save();
                return back()->with('success', 'Password has been reset successfully!');
            }

            // Cek di tabel psychologists
            $psikolog = Psychologist::where('email', $email)->first();
            if ($psikolog) {
                $psikolog->password = Hash::make($password);
                $psikolog->save();
                return back()->with('success', 'Password has been reset successfully!');
            }

            return back()->with('error', 'Email not found!');
        }
        return view('auth.passwords.direct_reset');
    }
} 