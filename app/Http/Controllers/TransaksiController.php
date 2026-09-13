<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;


class TransaksiController extends Controller
{
    public function index()
    {
        if (Auth::user()->role == 'admin') {
            // Ambil semua transaksi jika pengguna adalah admin
            $transaksis = Transaksi::all();
        } else {
            // Ambil transaksi berdasarkan ID pengguna jika pengguna adalah customer
            $transaksis = Transaksi::where('id_user', Auth::id())->get();
    
        }
        // Ambil detail transaksi untuk setiap transaksi
        foreach ($transaksis as $transaksi) {
            $transaksi->details = DB::table('detail_transaksi')
                ->where('id_transaksi', $transaksi->id)
                ->join('products', 'products.id', '=', 'detail_transaksi.id_product')
                ->select('detail_transaksi.jumlah_pembelian', 'products.title', 'products.price', 'products.diskon')
                ->get();
        }

        return view('transaksis.index', compact('transaksis'));
    }
    
    
        public function indexUlasan()
        {
            if (Auth::user()->role == 'admin') {
                $transaksis = Transaksi::all();
            } else {
                $transaksis = Transaksi::where('id_user', Auth::id())  // Filter berdasarkan ID pengguna
                ->where('status', 'Done')       // Status transaksi yang 'Done'
                ->with('details')               // Load relasi 'details'
                ->get();
            }
            // Ambil detail transaksi untuk setiap transaksi
            foreach ($transaksis as $transaksi) {
                $transaksi->details = DB::table('detail_transaksi')
                    ->where('id_transaksi', $transaksi->id)
                    ->join('products', 'products.id', '=', 'detail_transaksi.id_product')
                    ->select('detail_transaksi.jumlah_pembelian', 'products.title', 'products.price', 'products.diskon')
                    ->get();
            }
    
        return view('ulasan.index', compact('transaksis'));
    }

    public function create()
    {
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('transaksis.index');
        }

        $products = Product::where('stock', '>', 0)->get();
        $customers = User::where('role', 'customer')->get();

        return view('transaksis.create', compact('products', 'customers'));
    }

    public function store(Request $request)
    {
        // Validasi input untuk banyak produk
        $request->validate([
            'products' => 'required|array',
            'products.*.id_product' => 'required|exists:products,id',
            'products.*.jumlah_pembelian' => 'required|integer|min:1',
            'id_user' => ['nullable', 'exists:users,id'],
            'tanggal_transaksi' => 'nullable|date',
            'diskon' => 'nullable|numeric|min:0|max:100',
            'status' => 'nullable|in:Unpaid,Proses,Done',
        ]);

        $targetUserId = Auth::user()->role === 'admin' && $request->filled('id_user')
            ? $request->id_user
            : Auth::id();

        // Hitung total harga berdasarkan setiap produk yang dipilih
        $totalHarga = 0;
        foreach ($request->products as $productData) {
            $product = Product::find($productData['id_product']);
            $totalHarga += $product->discounted_price * $productData['jumlah_pembelian'];
            $jumlahPembelian = $productData['jumlah_pembelian'];
            $hargaSatuan = $product->price;
            // Kurangi stok produk sesuai jumlah pembelian
            $product->stock -= $jumlahPembelian;
            $product->save(); // Simpan perubahan stok

        }

        $diskon = $request->diskon ?? 0;
        $totalSetelahDiskon = $totalHarga;

        // Buat transaksi baru
        $newTransaksi = Transaksi::create([
            'diskon' => $diskon,
            'status' => $request->filled('status') ? $request->status : 'Done',
            'total_harga' => $totalSetelahDiskon,
            'id_user' => $targetUserId,
        ]);

        // Simpan detail transaksi untuk setiap produk
        foreach ($request->products as $productData) {
            DB::table('detail_transaksi')->insert([
                'id_product' => $productData['id_product'],
                'id_transaksi' => $newTransaksi->id,
                'jumlah_pembelian' => $productData['jumlah_pembelian'],
            ]);
        }
        
        session()->forget('cart');
                        
        return redirect()->route('transaksis.index')->with('success', 'Transaksi berhasil ditambahkan!');
    }

    public function show(string $id): View
    {
        // Ambil transaksi berdasarkan ID
        $transaksi = Transaksi::findOrFail($id);

        // Ambil detail transaksi
        $detailTransaksis = DB::table('detail_transaksi')
            ->where('id_transaksi', $transaksi->id)
            ->join('products', 'products.id', '=', 'detail_transaksi.id_product')
            ->select('detail_transaksi.jumlah_pembelian', 'products.id as id_product', 'products.title', 'products.price', 'products.diskon')
            ->get();

        // Render view dengan transaksi dan detail transaksi
        return view('transaksis.show', compact('transaksi', 'detailTransaksis'));
    }

    public function edit(string $id)
    {
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('transaksis.show', $id);
        }

        // Ambil transaksi berdasarkan ID
        $transaksi = Transaksi::findOrFail($id);

        // Ambil detail transaksi
        $detailTransaksis = DB::table('detail_transaksi')
            ->where('id_transaksi', $transaksi->id)
            ->join('products', 'products.id', '=', 'detail_transaksi.id_product')
            ->select('detail_transaksi.jumlah_pembelian', 'products.id as id_product', 'products.title', 'products.price', 'products.diskon')
            ->get();

        // Ambil semua produk
        $products = Product::all();

        // Render view dengan transaksi, detail transaksi, dan produk
        return view('transaksis.edit', compact('transaksi', 'detailTransaksis', 'products'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('transaksis.show', $id);
        }

 // Validasi input
        $request->validate([
            // 'products' => 'required|array',
            'products.*.id_product' => 'required|exists:products,id',
            'products.*.jumlah_pembelian' => 'required|integer|min:1',
            'tanggal_transaksi' => 'required|date',
            'diskon' => 'nullable|numeric|between:0,100',
            'status' => 'nullable|in:Unpaid,Proses,Done',
            'bukti_transaksi' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
        ]);

        // Ambil transaksi berdasarkan ID
        $transaksi = Transaksi::findOrFail($id);

        // Status hanya bisa diubah oleh admin; customer cukup upload bukti pembayaran
        $status = $transaksi->status;
        if (Auth::user()->role === 'admin' && $request->filled('status')) {
            $status = $request->status;
        }

        // Perbarui transaksi
        $transaksi->update([
            'tanggal_transaksi' => $request->tanggal_transaksi,
            'diskon' => 0,
            'status' => $status,
            'bukti_transaksi' => $request->hasFile('bukti_transaksi') ? $request->file('bukti_transaksi')->store('public/images') : $transaksi->bukti_transaksi,
        ]);
        if (Auth::user()->role !== 'customer'){
        // Hapus detail transaksi yang ada
        DB::table('detail_transaksi')->where('id_transaksi', $transaksi->id)->delete();

        // Tambahkan detail transaksi baru
        foreach ($request->products as $productData) {
            DB::table('detail_transaksi')->insert([
                'id_product' => $productData['id_product'],
                'id_transaksi' => $transaksi->id,
                'jumlah_pembelian' => $productData['jumlah_pembelian'],
            ]);
        }
        }

        // Kirim email hanya saat transaksi benar-benar di-approve menjadi Done
        if ($transaksi->status == 'Done' && $transaksi->wasChanged('status')) {
            $user = $transaksi->user;
            if ($user) {
                $detailTransaksis = DB::table('detail_transaksi')
                    ->where('id_transaksi', $transaksi->id)
                    ->join('products', 'products.id', '=', 'detail_transaksi.id_product')
                    ->select('detail_transaksi.jumlah_pembelian', 'products.title', 'products.price', 'products.diskon')
                    ->get();

                Mail::send('transaksis.email', ['transaksi' => $transaksi, 'detailTransaksis' => $detailTransaksis], function ($message) use ($user) {
                    $message->to($user->email)
                            ->subject('This is The Receipt From Your Purchases at Our Salesman Store');
                });
            } else {
                Log::error('User tidak ditemukan untuk transaksi ID: ' . $transaksi->id);
            }
        }
        return redirect()->route('transaksis.index')->with('success', 'Transaksi berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->delete();

         // Ambil detail transaksi yang terkait dengan transaksi ini
    $details = DB::table('detail_transaksi')
    ->where('id_transaksi', $transaksi->id)
    ->get();

// Kembalikan stok produk sesuai jumlah pembelian yang ada di detail transaksi
foreach ($details as $detail) {
    $product = Product::find($detail->id_product);

    // Pastikan produk ditemukan
    if ($product) {
        $product->stock += $detail->jumlah_pembelian;
        $product->save(); // Simpan perubahan stok
    }
}

// Hapus detail transaksi dan transaksi utama
DB::table('detail_transaksi')->where('id_transaksi', $transaksi->id)->delete();
$transaksi->delete();



        return redirect()->route('transaksis.index')->with('success', 'Transaksi berhasil dihapus');
    }
    
}