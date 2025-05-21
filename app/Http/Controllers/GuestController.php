<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class GuestController extends Controller
{
    public function index()
    {
        $events = Event::get();
        return view('landing_pages', compact('events'));
    }
}
