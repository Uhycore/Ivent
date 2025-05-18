<?php

namespace App\Http\Controllers;

use App\Models\Event;

class PenggunaDashboardController extends Controller
{
    public function index()
    {
        $event = Event::get();

        // kirim data event ke view user.dashboard
        return view('user.dashboard', compact('event'));
    }
}
