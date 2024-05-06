<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Account;
use App\Models\Kategori;
use App\Models\Barang;
use App\Models\Transaksi;
use App\Models\ProsesTransaksi;
use App\Models\DetailTransaksi;

class TransaksiController extends Controller
{
    public function show() {
        if (!session('logged_in')) {
            return redirect()->route('login');
        }
        Carbon::setLocale('id_ID');
        $date = Carbon::now();
        $currentDateTime = $date->tz('Asia/Jakarta');
        $currentDate = $currentDateTime->format('H:i, j F Y');

        $transaksi = Transaksi::all();
        $i = 1;
        $account = Account::all();
        $barang = Barang::all();
        $prosesTransaksi = ProsesTransaksi::all();

        $lastTrx = Transaksi::orderBy('id', 'desc')->first();
        $lastKode = $lastTrx ? $lastTrx->transaksi_id : '0000';

        // Membuat kode barang baru dengan menambah 1 ke kode terakhir
        $nextKode = str_pad((int)$lastKode + 1, 4, '0', STR_PAD_LEFT);

        $total = 0;
        foreach ($prosesTransaksi as $trx) {
            $total += $trx->harga * $trx->jumlah;
        }

        $user = session('user_id');
        $user = Account::find($user);

        if ($user->role === 'ADMIN') {
            return redirect()->back();
        }

        return view('transaksi.transaksi', compact(
            'transaksi',
            'i',
            'account',
            'date',
            'barang',
            'nextKode',
            'currentDate',
            'currentDateTime',
            'prosesTransaksi',
            'total',
            'user'
        ));
    }

    public function updateJumlah(Request $request)
    {
        $id = $request->input('id');
        $jumlah = $request->input('jumlah');

        $trx = ProsesTransaksi::find($id);

        if (!$trx) {
            return response()->json(['success' => false, 'message' => 'Transaksi tidak ditemukan'], 404);
        }

        $trx->jumlah = $jumlah;
        $trx->save();

        return response()->json(['success' => true, 'message' => 'Jumlah berhasil diperbarui'], 200);
    }

    public function store(Request $request) {
        $lastTrx = Transaksi::orderBy('id', 'desc')->first();
        $lastKode = $lastTrx ? $lastTrx->transaksi_id : '0000';
        $nextKode = str_pad((int)$lastKode + 1, 4, '0', STR_PAD_LEFT);

        Carbon::setLocale('id_ID');
        $date = Carbon::now();
        $currentDateTime = $date->tz('Asia/Jakarta');
        $currentDate = $currentDateTime->format('H:i, j F Y');

        $transaksi = new Transaksi();
        $transaksi -> transaksi_id = $nextKode;
        $transaksi -> tanggal = $date;
        $transaksi -> metode_pembayaran = $request->input('metode_pembayaran');
        $transaksi -> nama = $request->input('nama');
        $transaksi -> bayar = $request->input('bayar');
        $transaksi -> save();

        $prosesTransaksi = ProsesTransaksi::all();

        foreach ($prosesTransaksi as $trx) {
            DetailTransaksi::create([
                'transaksi_id' => $nextKode,
                'nama_item' => $trx->nama_item,
                'harga' => $trx->harga,
                'jumlah' => $trx->jumlah,
            ]);

            $trx->delete();
        }

        session()->flash('store', true);
        return redirect('/detailtransaksi/' . $nextKode);
    }
}
