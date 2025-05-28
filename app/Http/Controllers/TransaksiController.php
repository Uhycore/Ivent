<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Transaksi;
use App\Models\Pendaftaran;
use App\Models\Pengguna;
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

        $pendaftaran = Pendaftaran::with('event')->findOrFail($request->pendaftaran_id);

        $userId = Auth::id();
        $user = User::findOrFail($userId);

        $pengguna = new Pengguna();

        $pengguna = $pengguna->searchPenggunaByUserId($userId);

        $noHp = $pengguna[0]->no_hp;



        $eventId = $pendaftaran->event_id;
        $jumlahBayar = $pendaftaran->event->harga_pendaftaran;

        $kodeTransaksi = 'TRX-' . strtoupper(Str::random(10));

        Transaksi::create([
            'user_id' => $userId,
            'event_id' => $eventId,
            'kode_transaksi' => $kodeTransaksi,
            'jumlah_bayar' => $jumlahBayar,
            'status' => 'unpaid',
        ]);



        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
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

                'phone' => $noHp,
            ),
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);
        return view('checkout', compact('snapToken', 'kodeTransaksi', 'jumlahBayar', 'user', 'noHp'));
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
}
