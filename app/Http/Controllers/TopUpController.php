<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TopUpController extends Controller
{
    public function topUp(Request $request)
    {
        // Validasi input
        $request->validate([
            'amount' => 'required|numeric|min:1', // Mengecek apakah jumlah saldo yang dimasukkan adalah angka dan lebih dari 0
            'payment_method' => 'required|string', // Mengecek apakah metode pembayaran terpilih
        ]);

        // Ambil data dari form
        $amount = $request->input('amount'); // Mendapatkan nilai jumlah saldo dari form
        $paymentMethod = $request->input('payment_method'); // Mendapatkan metode pembayaran dari form

        // Update saldo pengguna
        $user = Auth::user(); // Mendapatkan pengguna yang sedang login
        $user->saldo += $amount; // Menambahkan saldo baru ke saldo yang sudah ada
        $user->save(); // Menyimpan perubahan ke database

        // Redirect kembali ke dashboard dengan pesan sukses
        return redirect()->route('dashboard')->with('success', 'Top up saldo berhasil! Saldo Anda: Rp ' . number_format($user->saldo, 0, ',', '.'));
    }
}
