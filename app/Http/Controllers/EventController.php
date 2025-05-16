<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

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
        ]);

        Event::create([
            'nama_event' => $request->nama_event,
            'tanggal' => $request->tanggal,
            'deskripsi' => $request->deskripsi,
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
        ]);

        $event = Event::findOrFail($id);
        $event->update([
            'nama_event' => $request->nama_event,
            'tanggal' => $request->tanggal,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('admin.event.index')->with('success', 'Event berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $event = Event::findOrFail($id);
        $event->delete();

        return redirect()->route('admin.event.index')->with('success', 'Event berhasil dihapus!');
    }
}
