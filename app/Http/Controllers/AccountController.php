<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Account;
use App\Models\Transaksi;
use App\Models\Barang;
use App\Models\Kategori;
use App\Models\DetailTransaksi;
use Carbon\Carbon;

class AccountController extends Controller
{
    public function showLogin() {
        if (Auth::check()) {
            return redirect('/dashboard');
        }

        return view('login.login');
    }

    public function login(Request $request) {
        $usernameOrEmail = $request->input('username');
        $password = $request->input('password');

        $account = Account::where('username', $usernameOrEmail)
                          ->orWhere('email', $usernameOrEmail)
                          ->first();

        if ($account) {
            if ($password === $account->password) {
                session([
                    'logged_in' => true,
                    'user_id' => $account->id,
                    'nama' => $account->nama,
                    'role' => $account->role
                ]);
                return redirect('/dashboard');
            } else {
                return redirect()->back()->withErrors(['error' => 'Password is incorrect']);
            }
        } else {
            return redirect()->back()->withErrors(['error' => 'Account not found.']);
        }
    }


    public function logout()
    {
        session()->forget('logged_in');
        return redirect()->route('login');
    }

    public function dashboard() {
        $account = Account::all();
        $date = Carbon::now();
        $countItem = Barang::count();
        $countTrx = Transaksi::count();
        $countItemSold = DetailTransaksi::sum('jumlah');
        $countCategory = Kategori::count();
        $total = DetailTransaksi::select(DB::raw('SUM(harga * jumlah) as total'))->first()->total;

        if (!session('logged_in')) {
            return redirect()->route('login');
        }

        $user = session('user_id');
        $user = Account::find($user);

        return view('pages.dashboard', compact(
            'date',
            'account',
            'countItem',
            'countTrx',
            'countItemSold',
            'countCategory',
            'total',
            'user'
        ));
    }

    public function showAccount() {
        $i = 1;
        $account = Account::all();
        $date = Carbon::now();

        if (!session('logged_in')) {
            return redirect()->route('login');
        }

        $user = session('user_id');
        $user = Account::find($user);

        if ($user->role === 'KASIR') {
            return redirect()->back();
        }

        return view('account.account', compact('date', 'account', 'i', 'user'));
    }

    public function store(Request $request) {
        $account = new Account();
        $account -> nama = $request->input('nama');
        $account -> email = $request->input('email');
        $account -> username = $request->input('username');
        $account -> password = $request->input('password');
        $account -> role = $request->input('role');
        $account -> save();

        if (!session('logged_in')) {
            return redirect()->route('login');
        }

        $user = session('user_id');
        $user = Account::find($user);

        if ($user->role === 'KASIR') {
            return redirect()->back();
        }

        session()->flash('showSuccessAdd', true);
        return redirect()->back()->with('registration_success', true);
    }

    public function destroy($id) {
        $account = Account::findOrFail($id);
        $account -> delete();

        $user = session('user_id');
        $user = Account::find($user);

        if ($user->role === 'KASIR') {
            return redirect()->back();
        }

        session()->flash('showSuccessDelete', true);
        return redirect()->back();
    }

    public function edit($id) {
        $accounts = Account::findOrFail($id);
        $account = Account::all();
        $date = Carbon::now();

        if (!session('logged_in')) {
            return redirect()->route('login');
        }

        $user = session('user_id');
        $user = Account::find($user);

        if ($user->role === 'KASIR') {
            return redirect()->back();
        }

        return view('account.edit', compact('accounts', 'date', 'account', 'user'));
    }

    public function update(Request $request, $id) {
        $accounts = Account::findOrFail($id);
        $accounts -> nama = $request->input('nama');
        $accounts -> email = $request->input('email');
        $accounts -> username = $request->input('username');
        $accounts -> password = $request->input('password');
        $accounts -> save();

        $user = session('user_id');
        $user = Account::find($user);

        if ($user->role === 'KASIR') {
            return redirect()->back();
        }

        session()->flash('showSuccessUpdate', true);
        return redirect()->route('account');
    }
}
