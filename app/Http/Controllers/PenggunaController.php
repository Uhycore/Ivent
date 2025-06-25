<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Pengguna;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class PenggunaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mengambil semua pengguna beserta relasi user-nya
        $pengguna = Pengguna::with('user')->get(); // Menggunakan pagination untuk menampilkan 10 pengguna per halaman

        return view('admin.pengguna.management_pengguna', compact('pengguna'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pengguna.create_pengguna');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|email|unique:user,email',
            'password' => 'required|string|min:8|confirmed',
            // 'full_name' => 'required|string|max:255',
            'no_hp' => 'required|string|max:20',
            'alamat' => 'required|string',
            'role' => '',
            // 'status' => 'required|string|in:active,inactive,pending',
            // 'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);



        // Create user first
        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role,
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

        return redirect()->route('admin.pengguna.index')->with('success', 'Pengguna created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pengguna $pengguna)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    // Edit Method
    public function edit($id)
    {
        $user = User::with('pengguna')->findOrFail($id);

        return view('admin.pengguna.edit_pengguna', compact('user'));
    }

    // Update Method
    // Update Method
    public function update(Request $request, $id)
    {
      

        $user = User::findOrFail($id);

        $request->validate([
            'username' => 'required|string|max:255|unique:user,username,' . $id,
            'email' => 'required|string|email|max:255|unique:user,email,' . $id,
            
            'password' => 'nullable|string|min:8|confirmed',
            'no_hp' => 'required|string|max:20',
            'alamat' => 'required|string',
            
        ]);

        $userData = [
            'username' => $request->username,
            'email' => $request->email,
        ];

        if ($request->filled('password')) {
            $userData['password'] = Hash::make($request->password);
        }

        $user->update($userData);

        $user->pengguna->update([
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
        ]);


        return redirect()->route('admin.pengguna.index')->with('success', 'User updated successfully!');
    }


    // Destroy Method
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->pengguna()->delete();
        $user->delete();

        return redirect()->route('admin.pengguna.index')->with('success', 'User deleted successfully!');
    }
}
