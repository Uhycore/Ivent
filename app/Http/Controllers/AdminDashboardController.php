<?php

namespace App\Http\Controllers;

use App\Models\Pengguna;
use App\Models\Event;
use App\Models\Pendaftaran;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $pengguna = Pengguna::get();
        $event = Event::get();
        $pendaftaran = Pendaftaran::get();
        $transaksi = Transaksi::get();

        // Total data
        $totalPengguna = $pengguna->count();
        $totalEvent = $event->count();
        $totalPendaftaran = $pendaftaran->count();
        $totalTransaksi = $transaksi->sum('jumlah_bayar');

        // Pendaftaran per bulan (tahun sekarang)
        $pendaftarPerBulan = Pendaftaran::selectRaw('MONTH(tanggal_daftar) as bulan, COUNT(*) as total')
            ->whereYear('tanggal_daftar', date('Y'))
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();

        // Pendapatan per bulan (tahun sekarang)
        $pendapatanPerBulan = Transaksi::selectRaw('MONTH(created_at) as bulan, SUM(jumlah_bayar) as total')
            ->whereYear('created_at', date('Y'))
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();

        // Peserta per event
        $pesertaPerEvent = Pendaftaran::selectRaw('event_id, COUNT(*) as total')
            ->groupBy('event_id')
            ->get();

        // Status pendaftaran
        $statusPendaftaran = Pendaftaran::selectRaw('status, COUNT(*) as total')
            ->groupBy('status')
            ->get();

        return view('admin.dashboard', compact(
            'totalPengguna',
            'totalEvent',
            'totalPendaftaran',
            'totalTransaksi',
            'pendaftarPerBulan',
            'pendapatanPerBulan',
            'pesertaPerEvent',
            'statusPendaftaran',
            'event'
        ));
    }
}
