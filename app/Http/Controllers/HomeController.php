<?php

namespace App\Http\Controllers;

use App\Models\Customers;
use Illuminate\Http\Request;
use App\Models\Transaksi;
use Auth;
use Illuminate\Support\Facades\DB;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Customers::where('user_id', Auth::id())->first();
        $transaksi = $jual = DB::table('transaksis')->join('users', 'users.id', '=', 'transaksis.users_id')
        ->join('kavlings', 'kavlings.id', '=', 'transaksis.kavlings_id')
        ->where('transaksis.users_id', Auth::id())
        ->first();
        $tagihan = DB::table('tagihans')
            ->leftJoin('users', 'users.id', '=', 'tagihans.users_id')
            ->leftJoin('transaksis', 'transaksis.id', '=', 'tagihans.transaksi_id')
            ->where('tagihans.users_id', Auth::id())
            ->get();
        // dd($tagihan);
        return view('home', compact('transaksi', 'user', 'tagihan'));
    }
}
