<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Ulasan;
use App\Models\Product;
use Illuminate\Http\Request;

class UlasanController extends Controller
{
    // Method untuk mendapatkan semua ulasan
    public function index()
    {
        $ulasan = Ulasan::all();
        return response()->json($ulasan);
    }

    public function create($id_transaksi)
    {
        // Cek apakah transaksi ada
        $transaksi = Transaksi::findOrFail($id_transaksi);
        
        // Ambil detail transaksi yang berisi produk dan jumlah pembelian
        $details = $transaksi->details; // Relasi yang menghubungkan transaksi dengan detail_transaksi
    
        // Ambil produk terkait dengan detail transaksi
        $products = $details->map(function ($detail) {
            return [
                'name' => $detail->product->title, // Pastikan relasi antara DetailTransaksi dan Product benar
                'quantity' => $detail->jumlah_pembelian
            ];
        });
    
        // Kirimkan data ke tampilan
        return view('ulasan.create', compact('transaksi', 'products', 'id_transaksi'));
    }
    
    // Method untuk membuat ulasan baru
    public function store(Request $request, $id_transaksi)
    {
        // Validasi data
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'ulasan' => 'required|string|max:255',
        ]);
    
        // Temukan transaksi berdasarkan ID
        $transaksi = Transaksi::findOrFail($id_transaksi);
    
        // Periksa apakah ulasan sudah ada
        if ($transaksi->ulasan) {
            return response()->json(['message' => 'Ulasan untuk transaksi ini sudah ada'], 400);
        }
    
        // Simpan ulasan baru
        $ulasan = Ulasan::create([
            'id_transaksi' => $transaksi->id,
            'rating' => $request->rating,
            'ulasan' => $request->ulasan,
        ]);
    
        // Redirect atau respon sukses
        return redirect()->back()->with('success', 'Review submitted successfully!');
    }
        
    public function show($id)
    {
        // Ambil produk berdasarkan ID produk
        $product = Product::findOrFail($id);

        // Mendapatkan ID transaksi dari URL atau request
        $transaksiId = $id; // Atau Anda bisa mendapatkan ID transaksi dari parameter lain yang sesuai

        // Ambil ulasan berdasarkan ID transaksi dan produk
        $ulasan = Ulasan::join('detail_transaksi', 'detail_transaksi.id_transaksi', '=', 'ulasan.id_transaksi')
                        ->where('detail_transaksi.id_product', $product->id)  // Pastikan ini mengarah ke ID produk yang benar
                        ->where('ulasan.id_transaksi', $transaksiId)  // Gunakan $transaksiId yang didefinisikan
                        ->first();

        // Jika ulasan tidak ditemukan, tampilkan pesan error
        if (!$ulasan) {
            return response()->json(['message' => 'Ulasan tidak ditemukan untuk transaksi ini'], 404);
        }

        // Kirimkan data produk dan ulasan ke view
        return view('ulasan.show', compact('ulasan', 'product'));
    }
}