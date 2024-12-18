<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Ulasan;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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
        return redirect()->route('ulasan.index')->with('success', 'Review submitted successfully!');
    }

    public function show($id_transaksi)
    {
        // Ambil transaksi berdasarkan ID transaksi
        $transaksi = Transaksi::findOrFail($id_transaksi);
    
        $details = $transaksi->details; // Relasi yang menghubungkan transaksi dengan detail_transaksi
        // Ambil produk terkait dengan transaksi dan memuat relasi 'ulasans'
        $products = $details->map(function ($detail) {
            return [
                'name' => $detail->product->title, // Pastikan relasi antara DetailTransaksi dan Product benar
                'quantity' => $detail->jumlah_pembelian
            ];
        });    
        // Ambil ulasan terkait transaksi (hanya satu ulasan per transaksi)
        $ulasan = Ulasan::where('id_transaksi', $id_transaksi)->first();  // Ambil satu ulasan berdasarkan ID transaksi
    
        // Kirimkan data ke view
        return view('ulasan.show', compact('products', 'transaksi', 'ulasan'));
    }  
    
}