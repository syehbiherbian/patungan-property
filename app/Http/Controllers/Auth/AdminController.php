<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Customers;
use App\Models\Kavling;
use App\Models\Tagihan;
use App\Models\Transaksi;
use App\Models\Blog;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    /**
     * show dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.index');
    }

    public function listCustomer()
    {
        $user = User::with('customer')->get();
        return view('admin.customer.list', compact('user'));
    }
    public function addCustomer()
    {
        return view('admin.customer.add');
    }

    public function addPostCustomer(Request $request)
    {
        // dd($request);
        $validator = Validator::make($request->all(), [
            'email' => 'required|unique:users|email',
            'name' => 'required|max:45',
            'phone' => 'required|numeric',
            'alamat' => 'required',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect('admin/customers/add')
                        ->withErrors($validator)
                        ->withInput();
        }
        else{
            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();

            $customers = new Customers;
            $customers->user_id = $user->id;
            $customers->address = $request->alamat;
            $customers->phone_number = $request->phone;
            $customers->save();

            return redirect('admin/customers/list')->with('message', 'IT WORKS!');
        }

    }

    public function listKavling(){
        $kavling = Kavling::all();
        return view('admin.kavling.list', compact('kavling'));
    }

    public function addKavling(){
        return view('admin.kavling.add');
    }

    public function addPostKavling(Request $request){
        $kavling = new Kavling;
        $kavling->kavling_name = $request->name;
        $kavling->blok_kavling = $request->blok;
        $kavling->harga = $request->harga;
        $kavling->save();

        return redirect('admin/kavling/list')->with('message', 'sukses nambah data');
    }

    public function listPenjualan(){
        $jual = DB::table('transaksis')->join('users', 'users.id', '=', 'transaksis.users_id')
                ->join('kavlings', 'kavlings.id', '=', 'transaksis.kavlings_id')
                ->select('transaksis.*', 'users.name', 'kavlings.kavling_name')
                ->get();
        // dd($jual);
        return view('admin.penjualan.list', compact('jual'));
    }

    public function addPenjualan(){
        $users = User::all();
        $kavling = Kavling::all();
        return view('admin.penjualan.add', compact('users', 'kavling'));
    }

    public function addPostPenjualan(Request $request)
    {
        // dd($request->date);
        $validator = Validator::make($request->all(), [
            'nama_konsumen' => 'required',
            'kavling' => 'required',
            'tenor' => 'required',
            'date' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect('admin/penjualan/add')
                        ->withErrors($validator)
                        ->withInput();
        }
        else{
            $transaksi = new Transaksi;
            $transaksi->users_id = $request->nama_konsumen;
            $transaksi->kavlings_id = $request->kavling;
            $transaksi->tenor = $request->tenor;
            $transaksi->jumlah_angsuran = $request->angsuran;
            $transaksi->tanggal_penagihan = $request->date;
            $transaksi->save();

            return redirect('admin/penjualan/list')->with('message', 'sukses nambah data');

        }

    }

    public function listTagihan(){
        $tagihan = DB::table('tagihans')
            ->leftJoin('users', 'users.id', '=', 'tagihans.users_id')
            ->leftJoin('transaksis', 'transaksis.id', '=', 'tagihans.transaksi_id')
            ->select('tagihans.*', 'users.*', 'transaksis.*')
            ->get();
        $user = User::all();
        // dd($tagihan);
        return view('admin.tagihan.list', compact('tagihan', 'user'));
    }

    public function addTagihan(Request $request){
        $jual = DB::table('transaksis')->join('users', 'users.id', '=', 'transaksis.users_id')
                ->where('transaksis.users_id', $request->users_id)
                ->select('transaksis.*', 'users.*')
                ->first();

        $sisa = $jual->tenor - $request->pembayaran;

        $tagihan = new Tagihan;
        $tagihan->transaksi_id = $request->transaksi;
        $tagihan->users_id = $request->users_id;
        $tagihan->pembayaran_ke = $request->pembayaran;
        $tagihan->tanggal_pembayaran = Carbon::now();
        $tagihan->status = 1;
        $tagihan->sisa_tenor = $sisa;
        $tagihan->save();

        $message = [
            'status' => '200',
            'message' => 'Sukses Bayar Tagihan'
        ];

        return response()->json($message);

    }

    public function listBlog()
    {
        $blog = Blog::all();
        return view('admin.blog.list', compact('blog'));
    }

    public function addBlog()
    {
        return view('admin.blog.add');

    }

    public function AddPostBlog(Request $request)
    {
        if ($request->file('cover')->isValid()) {
            // dd($request);
                //
                $validated = Validator::make($request->all(), [
                    'judul' => 'required|string',
                    'cover' => 'mimes:jpeg,png|max:2048',
                    'blog' => 'required'
                ]);
                if ($validated->fails()) {
                    return redirect('admin/blog/add')
                                ->withErrors($validated)
                                ->withInput();
                } else {
                    $resorce       = $request->file('cover');
                    $name   = "blogs/" . $resorce->getClientOriginalName();
                    $resorce->move(\base_path() . "/public/storage/blogs/", $name);
                    $file = Blog::create([
                    'judul' => $request->judul,
                    'cover' => $name,
                    'isi_post' => $request->blog
                    ]);
                    
                    return redirect('admin/blog/list')->with('message', 'sukses nambah data');
                    
                }
                
            }

    }

    public function getData(Request $request){
        
        $kavling = Kavling::find($request->id);
        return response()->json($kavling);
    }
    public function getTransaksi(Request $request){
        // $user = User::find($request->id);
        $jual = DB::table('transaksis')->where('users_id', $request->id)
                ->first();
        return response()->json($jual);
    }
}
