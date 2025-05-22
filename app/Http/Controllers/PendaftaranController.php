<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pendaftaran;
use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class PendaftaranController extends Controller
{
    // Tampilkan form pendaftaran (dengan event dan user)
    public function index()
    {
        echo "halaman pendaftaran";
    }
    public function create($eventId)
    {
        $event = Event::findOrFail($eventId);
        $user = Auth::user();

        return view('pendaftaran.create_pendaftaran', compact('event', 'user'));
    }

    // Simpan data pendaftaran
    public function store(Request $request)
    {
        $request->validate([
            'event_id' => 'required|exists:event,id',
            'tipe_pendaftaran' => 'required|in:perorangan,kelompok',
        ]);

        $event = Event::findOrFail($request->event_id);

        // Validasi tipe_pendaftaran sesuai tipe_event
        if ($event->tipe_event === 'perorangan' && $request->tipe_pendaftaran !== 'perorangan') {
            return back()->withErrors(['tipe_pendaftaran' => 'Event ini hanya menerima pendaftaran perorangan']);
        }

        if ($event->tipe_event === 'kelompok' && $request->tipe_pendaftaran !== 'kelompok') {
            return back()->withErrors(['tipe_pendaftaran' => 'Event ini hanya menerima pendaftaran kelompok']);
        }

        // Simpan pendaftaran
        Pendaftaran::create([
            'user_id' => Auth::id(),
            'event_id' => $request->event_id,
            'tipe_pendaftaran' => $request->tipe_pendaftaran,
            'status' => 'pending',
            'tanggal_daftar' => Carbon::now(),
        ]);

        return redirect()->route('pendaftaran.success')->with('success', 'Pendaftaran berhasil dikirim!');
    }

    // Halaman sukses pendaftaran (opsional)
    public function success()
    {
        return view('pendaftaran.success');
    }
}
