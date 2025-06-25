<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Password;

class ResetPasswordController extends Controller
{


    public function showResetForm(Request $request, $token)
    {
        try {
            $decryptedEmail = Crypt::decryptString($request->email);
        } catch (\Exception $e) {
            abort(403, 'Email tidak valid atau rusak.');
        }

        return view('auth.reset-password', [
            'token' => $token,
            'email' => $decryptedEmail
        ]);
    }


    public function reset(Request $request)
    {
        try {
            $email = $request->input('email');
        } catch (\Exception $e) {
            return back()->withErrors([
                'email' => 'Decrypt gagal: ' . $e->getMessage(),
            ]);
        }



        $request->merge(['email' => $email]);

        $request->validate([
            'token'    => 'required',
            'email'    => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                    'remember_token' => Str::random(60),
                ])->save();
                
                // Auth::login($user);
            }
        );

        // return $status == Password::PASSWORD_RESET
        //     ? redirect()->route('guest.landing_pages')->with('status', __($status))
        //     : back()->withErrors(['email' => [__($status)]]);

         if ($status == Password::PASSWORD_RESET) {
        return redirect()
            ->route('guest.landing_pages')
            ->with('status', 'Password berhasil direset. Anda sekarang sudah login.');
    } else {
        return back()->withErrors([
            'email' => 'Reset password gagal: ' . __($status),
        ]);
    }
    }


    //public function reset(Request $request)
    // {
    //     $request->validate([
    //         'token'    => 'required',
    //         'email'    => 'required|email',
    //         'password' => 'required|min:8|confirmed',
    //     ]);

    //     $status = Password::reset(
    //         $request->only('email', 'password', 'password_confirmation', 'token'),
    //         function ($user, $password) {
    //             $user->forceFill([
    //                 'password' => Hash::make($password),
    //                 'remember_token' => Str::random(60),
    //             ])->save();
    //         }
    //     );

    //     return $status == Password::PASSWORD_RESET
    //         ? redirect()->route('login')->with('status', __($status))
    //         : back()->withErrors(['email' => [__($status)]]);
    // }
}
