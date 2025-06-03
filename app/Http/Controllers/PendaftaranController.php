<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Event;
use App\Models\Kelompok;
use App\Models\Perorangan;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use App\Models\AnggotaKelompok;
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
            'nama_lengkap' => 'required_if:tipe_pendaftaran,perorangan',
            'no_hp' => 'required_if:tipe_pendaftaran,perorangan',
            'alamat' => 'required_if:tipe_pendaftaran,perorangan',
            'nama_kelompok' => 'required_if:tipe_pendaftaran,kelompok',
            'no_hp_ketua' => 'required_if:tipe_pendaftaran,kelompok',
            'alamat_ketua' => 'required_if:tipe_pendaftaran,kelompok',
            'anggota.*.nama_anggota' => 'required_if:tipe_pendaftaran,kelompok',
            'anggota.*.no_hp' => 'required_if:tipe_pendaftaran,kelompok',
        ]);

        $event = Event::findOrFail($request->event_id);
        if ($event->sisa_kuota <= 0) {
            return back()->withErrors(['event_id' => 'Kuota untuk event ini sudah penuh.']);
        }


        $event->sisa_kuota -= 1;
        $event->save();

        if (
            ($event->tipe_event === 'perorangan' && $request->tipe_pendaftaran !== 'perorangan') ||
            ($event->tipe_event === 'kelompok' && $request->tipe_pendaftaran !== 'kelompok')
        ) {
            return back()->withErrors(['tipe_pendaftaran' => 'Tipe pendaftaran tidak sesuai dengan tipe event']);
        }


        $pendaftaran = Pendaftaran::create([
            'user_id' => Auth::id(),
            'event_id' => $request->event_id,
            'tipe_pendaftaran' => $request->tipe_pendaftaran,
            'status' => 'pending',
            'tanggal_daftar' => Carbon::now(),
        ]);

        if ($request->tipe_pendaftaran === 'perorangan') {
            Perorangan::create([
                'pendaftaran_id' => $pendaftaran->id,
                'nama_lengkap' => $request->nama_lengkap,
                'no_hp' => $request->no_hp,
                'alamat' => $request->alamat,
            ]);
        }

        if ($request->tipe_pendaftaran === 'kelompok') {
            $kelompok = Kelompok::create([
                'pendaftaran_id' => $pendaftaran->id,
                'nama_kelompok' => $request->nama_kelompok,
                'no_hp_ketua' => $request->no_hp_ketua,
                'alamat_ketua' => $request->alamat_ketua,
            ]);

            $namaAnggota = $request->nama_anggota;
            $noHpAnggota = $request->no_hp_anggota;

            foreach ($namaAnggota as $index => $nama) {
                $noHp = $noHpAnggota[$index];



                AnggotaKelompok::create([
                    'kelompok_id' => $kelompok->id,
                    'nama_anggota' => $nama,
                    'no_hp' => $noHp,
                ]);
            }
        }

        return redirect()->route('user.landing_pages')
            ->with('success', 'Pendaftaran berhasil dilakukan.');
    }


    public function success()
    {
        return view('success_pendaftaran');
    }

    public function approve($id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);

        $pendaftaran->status = 'diterima';
        $pendaftaran->save();

        return redirect()->route('admin.pendaftar')->with('success', 'Pendaftaran berhasil disetujui.');
    }
}
