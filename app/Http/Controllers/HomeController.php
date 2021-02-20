<?php

namespace App\Http\Controllers;

use App\Models\Customers;
use Illuminate\Http\Request;
use App\Models\Transaksi;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\User;

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

    public function edit(Request $request)
    {
        $user = User::find(Auth::id());
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        if($user){
            $cust = Customers::where('user_id', $user->id)->first();
            $cust->address = $request->alamat;
            $cust->phone_number = $request->phone;
            $cust->save();
            return redirect()->back()->with('sukses', 'sukses Update Profile');
        }

        
    }
}
