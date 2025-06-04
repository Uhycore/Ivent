<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Event;
use App\Models\Pengguna;
use App\Models\Kelompok;
use App\Models\Perorangan;
use App\Models\Transaksi;
use App\Models\Pendaftaran;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class TransaksiController extends Controller
{
    public function index()
    {
        echo "halo";
    }
    public function checkout(Request $request)
    {
        $request->validate([
            'pendaftaran_id' => 'required|exists:pendaftaran,id',
        ]);

        $pendaftaranId = $request->pendaftaran_id;

        $eventName = Pendaftaran::findOrFail($pendaftaranId)->event->nama_event;

        

        $pendaftaran = Pendaftaran::with('event')->findOrFail($request->pendaftaran_id);

        $userId = Auth::id();
        $user = User::findOrFail($userId);

        $pengguna = new Pengguna();

        $pengguna = $pengguna->searchPenggunaByUserId($userId);

        // $noHp = $pengguna[0]->no_hp;

        // $alamat = $pengguna[0]->alamat;

        $pendaftaran = Pendaftaran::with(['event', 'user', 'perorangan', 'kelompok'])->findOrFail($request->pendaftaran_id);

    // Ambil data kontak langsung dari relasi yang tersedia
    if ($pendaftaran->perorangan) {
        $noHp = $pendaftaran->perorangan->no_hp;
        $alamat = $pendaftaran->perorangan->alamat;
    } else {
        $noHp = $pendaftaran->kelompok->no_hp_ketua ?? $pendaftaran->kelompok->no_hp_kelompok;
        $alamat = $pendaftaran->kelompok->alamat_ketua ?? $pendaftaran->kelompok->alamat_kelompok;
    }




        $eventId = $pendaftaran->event_id;
        $jumlahBayar = $pendaftaran->event->harga_pendaftaran;

        $kodeTransaksi = 'TRX-' . strtoupper(Str::random(10));

        Transaksi::create([
            'user_id' => $userId,
            'event_id' => $eventId,
            'event_name' => $eventName,
            'pendaftaran_id' => $pendaftaranId,
            'kode_transaksi' => $kodeTransaksi,
            'jumlah_bayar' => $jumlahBayar,
            'status' => 'unpaid',
        ]);



        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = config('midtrans.is_production');
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $params = array(
            'transaction_details' => array(
                'order_id' => $kodeTransaksi,
                'gross_amount' => $jumlahBayar,
            ),
            'customer_details' => array(
                'first_name' => $user->username,
                'alamat' => $alamat,
                'phone' => $noHp,
            ),
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);
        return view('checkout', compact('snapToken', 'kodeTransaksi', 'jumlahBayar', 'user', 'noHp', 'pendaftaranId','eventName','alamat'));
    }

    public function midtransCallback(Request $request)
    {
        $serverKey = config('midtrans.server_key');
        $signatureKey = hash('sha512', $request->order_id . $request->status_code . $request->gross_amount . $serverKey);

        if ($request->transaction_status === 'capture') {
            $transaksi = Transaksi::where('kode_transaksi', $request->order_id)->first();
            if ($transaksi && $transaksi->status === 'unpaid') {
                $transaksi->update(['status' => 'paid']);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Transaksi tidak ditemukan atau sudah dibayar.',
                ], 404);
            }
        }
    }

    public function Invoice($id)
    {
        $invoice = Transaksi::where('kode_transaksi', $id)->first();

        $user = User::findOrFail($invoice->user_id);

        $event = Event::findOrFail($invoice->event_id);

        if (!$invoice) {
            return redirect()->back()->with('error', 'Transaksi tidak ditemukan.');
        }

        return view('invoice', compact('invoice', 'user', 'event'));
    }

    public function showListTransaksi()
    {
        $transaksiList = Transaksi::with(['user', 'event', 'pendaftaran'])->get();
        return view('admin.transaksi.list_transaksi', compact('transaksiList'));
    }

    public function destroy($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->delete();

        return redirect()->route('admin.transaksi.index')->with('success', 'Transaksi berhasil dihapus!');
    }
    public function bulkDelete(Request $request)
    {
        $ids = $request->input('selected', []);

        if (count($ids) > 0) {
            Transaksi::whereIn('id', $ids)->delete();
            return back()->with('success', 'Transaksi terpilih berhasil dihapus.');
        }

        return back()->with('error', 'Tidak ada transaksi yang dipilih.');
    }
}
