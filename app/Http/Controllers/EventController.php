<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $event = Event::get();
        return view('admin.event.management_event', compact('event'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.event.create_event');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_event' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'deskripsi' => 'required|string',
            'tipe_event' => 'required|string|in:semua,perorangan,kelompok',
            'kuota' => 'required|integer|min:1',
            'max_anggota_kelompok' => 'required_if:tipe_event,kelompok|required_if:tipe_event,semua|nullable|integer|min:1',
            'gambar' => '',
            'harga_pendaftaran' => 'required|numeric|min:0',
        ]);


        Event::create([
            'nama_event' => $request->nama_event,
            'tanggal' => $request->tanggal,
            'deskripsi' => $request->deskripsi,
            'tipe_event' => $request->tipe_event,
            'kuota' => $request->kuota,
            'max_anggota_kelompok' => $request->max_anggota_kelompok,
            'gambar' => $request->file('gambar') ? $request->file('gambar')->store('event_images', 'public') : null,
            'harga_pendaftaran' => $request->harga_pendaftaran,
        ]);

        return redirect()->route('admin.event.index')->with('success', 'Event berhasil ditambahkan!');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $event = Event::findOrFail($id);
        return view('admin.event.edit_event', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     */


    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_event' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'deskripsi' => 'required|string',
            'tipe_event' => 'required|string|in:semua,perorangan,kelompok',
            'kuota' => 'required|integer|min:1',
            'max_anggota_kelompok' => 'required|integer|nullable',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'harga_pendaftaran' => 'required|numeric|min:0',
        ]);

        $event = Event::findOrFail($id);
        $event->update([
            'nama_event' => $request->nama_event,
            'tanggal' => $request->tanggal,
            'deskripsi' => $request->deskripsi,
            'tipe_event' => $request->tipe_event,
            'kuota' => $request->kuota,
            'max_anggota_kelompok' => $request->max_anggota_kelompok,
            'gambar' => $request->file('gambar') ? $request->file('gambar')->store('event_images', 'public') : $event->gambar,
            'harga_pendaftaran' => $request->harga_pendaftaran,
        ]);

        return redirect()->route('admin.event.index')->with('success', 'Event berhasil diperbarui!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $event = Event::findOrFail($id);
// dd($event->gambar);

          // Hapus file gambar jika ada
    if ($event->gambar) {
        // Path gambar di storage/app/public/event_images/filename.jpg
         Storage::disk('public')->delete($event->gambar);
    }
        $event->delete() ;



        return redirect()->route('admin.event.index')->with('success', 'Event berhasil dihapus!');
    }
}
