<?php

namespace App\Http\Controllers;


use App\Models\Event;


class PenggunaDashboardController extends Controller
{
    public function index()
    {
        $events = Event::get();

        // kirim data event ke view user.dashboard
        return view('landing_pages', compact('events'));
    }
}
