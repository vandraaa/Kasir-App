<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Account;
use App\Models\Kategori;

class KategoriController extends Controller
{
    public function show() {
        if (!session('logged_in')) {
            return redirect()->route('login');
        }

        $i = 1;
        $account = Account::all();
        $kategori = Kategori::all();
        $date = Carbon::now();

        $user = session('user_id');
        $user = Account::find($user);

        if ($user->role === 'KASIR') {
            return redirect()->back();
        }

        return view('kategori.kategori', compact('date', 'kategori', 'i','account', 'user'));
    }

    public function store(Request $request) {
        $kategori = new Kategori();
        $kategori -> nama_kategori = $request->input('nama_kategori');
        $kategori -> save();

        $user = session('user_id');
        $user = Account::find($user);

        if ($user->role === 'KASIR') {
            return redirect()->back();
        }

        session()->flash('addCategory', true);
        return redirect()->back();
    }

    public function edit($id) {
        $kategori = Kategori::findOrFail($id);

        $user = session('user_id');
        $user = Account::find($user);

        if ($user->role === 'KASIR') {
            return redirect()->back();
        }

        $account = Account::all();
        $date = Carbon::now();

        return view('kategori.edit', compact('kategori', 'date', 'account', 'user'));
    }

    public function destroy($id) {
        $kategori = Kategori::findOrFail($id);
        $kategori -> delete();

        $user = session('user_id');
        $user = Account::find($user);

        if ($user->role === 'KASIR') {
            return redirect()->back();
        }

        session()->flash('deleteCategory', true);
        return redirect()->back();
    }

    public function update(Request $request, $id) {
        $kategori = Kategori::findOrFail($id);
        $kategori -> nama_kategori = $request->input('nama_kategori');
        $kategori -> save();

        $user = session('user_id');
        $user = Account::find($user);

        if ($user->role === 'KASIR') {
            return redirect()->back();
        }

        session()->flash('updateCategory', true);
        return redirect()->route('kategori');
    }
}
