<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Pengguna;

class AuthController extends Controller
{
    // Tampilkan form login
    public function showLoginForm()
    {
        return redirect()->route('guest.landing_pages')->with('error', 'Silakan login terlebih dahulu.');
    }

    // Proses login manual
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required'],
        ]);
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Cek role dan redirect
            if (Auth::user()->role_id == 1) {
                // return redirect()->route('admin.dashboard')->with('success', 'Selamat datang di dashboard admin!');
                return response()->json([
                    'success' => true,
                    'message' => 'Selamat datang di dashboard admin!',
                    'redirect' => route('admin.dashboard')
                ]);
            } else {


                // return redirect()->route('user.landing_pages')->with('success', 'Selamat datang di Ivent!');
                return response()->json([
                    'success' => true,
                    'message' => 'Selamat datang di Ivent!',
                    'redirect' => route('user.landing_pages')
                ]);
            }
        }

//         if (Auth::attempt($credentials)) {
//     $request->session()->regenerate();
//     return response()->json(['redirect' => route(Auth::user()->role_id == 1 ? 'admin.dashboard'  : 'user.landing_pages' )]);
// }

        // return back()->withErrors(['login' => 'Username atau password salah.'])->withInput();
        return response()->json(['message' => 'Username atau password salah.'], 422); // Status kode untuk validasi gagal

    }

    // Tampilkan form register
    public function showRegisterForm()
    {
        echo "piye carane register";
    }
    // Proses register
    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:user',
            'password' => 'required|string|min:8',
            // 'full_name' => 'required|string|max:255',
            'no_hp' => 'required|string|max:20',
            'alamat' => 'required|string',

            // 'status' => 'required|string|in:active,inactive,pending',
            // 'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);



        // Create user first
        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => 2, // Role ID for pengguna
            // 'status' => $request->status,
        ]);

        // Handle profile picture upload
        $profilePicturePath = null;
        if ($request->hasFile('profile_picture')) {
            $profilePicturePath = $request->file('profile_picture')->store('profile_pictures', 'public');
        }

        // Create pengguna
        $pengguna = Pengguna::create([
            'user_id' => $user->id,
            // 'full_name' => $request->full_name,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
            // 'profile_picture' => $profilePicturePath,
        ]);



        // return redirect()->route('guest.landing_pages')->with('success', 'Registrasi berhasil! Silakan login.');
         return response()->json(['message' => 'Registrasi berhasil',]);
    }

    // Logout user
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Anda telah logout.');
    }
}
