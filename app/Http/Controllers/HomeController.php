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

        // Mengirimkan data pengguna ke view dashboard
        return view('dashboard', compact('user'));
    }
}
