<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Mpdf\Mpdf;
use Illuminate\Support\Facades\View;
use App\Models\Account;
use App\Models\Kategori;
use App\Models\Transaksi;
use App\Models\DetailTransaksi;

class DetailTransaksiController extends Controller
{
    public function show()
    {
        if (!session('logged_in')) {
            return redirect()->route('login');
        }

        $transaksi = Transaksi::all();
        $i = 1;
        $account = Account::all();
        $date = Carbon::now();

        $user = session('user_id');
        $user = Account::find($user);

        return view('transaksi.history', compact('transaksi', 'i', 'account', 'date', 'user'));
    }

    public function showDetail($transaksi_id)
    {
        $detail = DetailTransaksi::where('transaksi_id', $transaksi_id)->get();
        $transaksi = Transaksi::where('transaksi_id', $transaksi_id)->first();

        $account = Account::all();
        $date = Carbon::now();
        $currentDate = Carbon::now()->format('H:i, j F Y');

        $user = session('user_id');
        $user = Account::find($user);

        $total = 0;
        foreach ($detail as $item) {
            $total += $item->harga * $item->jumlah;
        }

        return view('transaksi.detail', [
            // 'transaksi_id' => $transaksi_id,
            'detail' => $detail,
            'transaksi' => $transaksi,
            'currentDate' => $currentDate,
            'date' => $date,
            'account' => $account,
            'total' => $total,
            'user' => $user
        ]);
    }

    public function showPrint($transaksi_id) {
        $detail = DetailTransaksi::where('transaksi_id', $transaksi_id)->get();
        $transaksi = Transaksi::where('transaksi_id', $transaksi_id)->first();
        $account = Account::all();
        $currentDate = Carbon::now()->format('H:i, j F Y');
        $total = 0;
        $date = Carbon::now();

        foreach ($detail as $item) {
            $harga = $item->harga;
            $jumlah = $item->jumlah;

            $total += $item->harga * $item->jumlah;
        }

        $html = view('transaksi.print', [
            'detail' => $detail,
            'transaksi' => $transaksi,
            'currentDate' => $currentDate,
            'account' => $account,
            'total' => $total,
        ])->render();

        // Buat objek Mpdf
        $mpdf = new \Mpdf\Mpdf();
        $mpdf->WriteHTML($html);
        $mpdf->Output();

    }
}
