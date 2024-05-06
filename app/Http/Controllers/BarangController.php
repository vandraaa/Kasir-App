<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Account;
use App\Models\Barang;
use App\Models\Kategori;
use Carbon\Carbon;

class BarangController extends Controller
{
    public function show(Request $request)
    {
        if (!session('logged_in')) {
            return redirect()->route('login');
        }

        $i = 1;
        $account = Account::all();
        $date = Carbon::now();

        // Mendapatkan kode barang berikutnya
        $lastBarang = Barang::orderBy('id', 'desc')->first();
        $lastKode = $lastBarang ? $lastBarang->kode_barang : '0000';
        $nextKode = str_pad((int)$lastKode + 1, 4, '0', STR_PAD_LEFT);

        // Mengambil data barang berdasarkan kategori jika ada filter kategori yang dipilih
        $barangQuery = Barang::query();
        if ($request->filled('kategori')) {
            $barangQuery->where('kategori_id', $request->kategori);
        }
        $barang = $barangQuery->get();

        $kategori = Kategori::all();

        $user = session('user_id');
        $user = Account::find($user);

        if ($user->role === 'KASIR') {
            return redirect()->back();
        }

        return view('barang.barang', compact('date', 'barang', 'i', 'account', 'nextKode', 'kategori', 'user'));
    }



    public function store(Request $request) {
        $lastBarang = Barang::orderBy('id', 'desc')->first();
        $lastKode = $lastBarang ? $lastBarang->kode_barang : '0000';

        // Membuat kode barang baru dengan menambah 1 ke kode terakhir
        $nextKode = str_pad((int)$lastKode + 1, 4, '0', STR_PAD_LEFT);

        $barang = new Barang();
        $barang -> kode_barang = $nextKode;
        $barang -> nama_barang = $request->input('nama_barang');
        $barang -> kategori = $request->input('kategori');
        $barang -> harga = $request->input('harga');

        $barang -> save();

        $user = session('user_id');
        $user = Account::find($user);

        if ($user->role === 'KASIR') {
            return redirect()->back();
        }

        session()->flash('add', true);
        return redirect()->back();
    }

    public function edit($id) {
        $barang = Barang::findOrFail($id);

        $account = Account::all();
        $date = Carbon::now();
        $kategori = Kategori::all();

        $user = session('user_id');
        $user = Account::find($user);

        if ($user->role === 'KASIR') {
            return redirect()->back();
        }

        return view('barang.edit', compact('barang', 'date', 'account', 'kategori', 'user'));
    }

    public function update(Request $request, $id) {
        $barang = Barang::findOrFail($id);
        $barang -> nama_barang = $request->input('nama_barang');
        $barang -> kategori = $request->input('kategori');
        $barang -> harga = $request->input('harga');
        $barang -> save();

        $user = session('user_id');
        $user = Account::find($user);

        if ($user->role === 'KASIR') {
            return redirect()->back();
        }

        session()->flash('update', true);
        return redirect()->route('barang');
    }

    public function destroy($id) {
        $barang = Barang::findOrFail($id);
        $barang -> delete();

        $user = session('user_id');
        $user = Account::find($user);

        if ($user->role === 'KASIR') {
            return redirect()->back();
        }

        session()->flash('delete', true);
        return redirect()->route('barang');
    }
}
