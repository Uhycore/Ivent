<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class HistoryController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect('/');
        }

        $history = Auth::user();



        $pendaftaranList = $history->pendaftarans()->with(['event', 'perorangan', 'kelompok.anggota_kelompok'])->get(); // ambil semua pendaftaran milik user ini

        // echo "<pre>";
        // print_r($riwayatPendaftaran->toArray()); // menampilkan data pendaftaran dalam format array
        // echo "</pre>";


        return view('history', compact('pendaftaranList'));
    }

    // app/Http/Controllers/HistoryController.php

}
