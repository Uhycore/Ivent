<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    public function showLinkRequestForm()
    {
        return view('auth.forgot-password');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        // return $status === Password::RESET_LINK_SENT
        //     ? back()->with(['status' => __($status)])
        //     : back()->withErrors(['email' => __($status)]);
        if ($status === Password::RESET_LINK_SENT) {
        return back()->with([
            'status' => 'Link reset password berhasil dikirim ke email Anda.'
        ]);
    } else {
        // Ganti pesan default Laravel dengan pesan buatan sendiri
        return back()->withErrors([
            'email' => 'Email tidak ditemukan dalam sistem kami. Silakan periksa kembali.'
        ]);
    }

    }
}
