<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TopUpController extends Controller
{
    public function topUp(Request $request)
    {
        
        $request->validate([
            'amount' => 'required|numeric|min:1', 
            'payment_method' => 'required|string', 
        ]);

        
        $amount = $request->input('amount'); 
        $paymentMethod = $request->input('payment_method'); 

        
        $user = Auth::user(); 
        $user->saldo += $amount; 
        $user->save(); 

        
        return redirect()->route('dashboard')->with('success', 'Top up saldo berhasil! Saldo Anda: Rp ' . number_format($user->saldo, 0, ',', '.'));
    }
}
