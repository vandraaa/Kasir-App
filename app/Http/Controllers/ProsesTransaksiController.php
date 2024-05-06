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

class ProsesTransaksiController extends Controller
{
    public function store(Request $request) {
        $barang = Barang::findOrFail($request->item_id);

        $prosesTransaksi = new ProsesTransaksi();
        $prosesTransaksi->transaksi_id = $request->transaksi_id;
        $prosesTransaksi->nama_item = $barang->nama_barang;
        $prosesTransaksi->harga = $barang->harga;
        $prosesTransaksi->jumlah = 1; // Jumlah tetap 1 sesuai permintaan
        $prosesTransaksi->save();

        return redirect()->route('transaksi')->with('scrollToBottom', true);
    }

    public function destroy($id) {
        $prosesTransaksi = ProsesTransaksi::findOrFail($id);

        $prosesTransaksi->delete();

        return redirect()->route('transaksi')->with('scrollToBottom', true);
    }
}
