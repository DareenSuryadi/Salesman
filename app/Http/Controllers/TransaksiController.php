<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Product;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mendapatkan semua data transaksi beserta informasi produk terkait
        $transaksis = Transaksi::with('product')->paginate(10);
        return view('transaksis.index', compact('transaksis'));
    }
}
//     /**
//      * Show the form for creating a new resource.
//      */
//     public function create()
//     {
//         // Mendapatkan semua produk untuk dropdown di form transaksi
//         $products = Product::all();
//         return view('transaksis.create', compact('products'));
//     }

//     /**
//      * Store a newly created resource in storage.
//      */
//     public function store(Request $request)
//     {
//         // Validasi data yang dikirim
//         $request->validate([
//             'id_product' => 'required|exists:products,id',
//             'jumlah_pembelian' => 'required|integer',
//             'nama_kasir' => 'required|string|max:255',
//             'tanggal_transaksi' => 'required|date',
//             'diskon' => 'nullable|numeric',
//         ]);

//         // Menyimpan data transaksi ke database
//         Transaksi::create($request->all());

//         return redirect()->route('transaksis.index')->with('success', 'Transaksi berhasil dibuat.');
//     }

//     /**
//      * Display the specified resource.
//      */
//     public function show(Transaksi $transaksi)
//     {
//         // Menampilkan detail transaksi beserta produk terkait
//         $transaksi->load('product');
//         return view('transaksis.show', compact('transaksi'));
//     }

//     /**
//      * Show the form for editing the specified resource.
//      */
//     public function edit(Transaksi $transaksi)
//     {
//         // Mendapatkan semua produk untuk dropdown di form edit
//         $products = Product::all();
//         return view('transaksis.edit', compact('transaksi', 'products'));
//     }

//     /**
//      * Update the specified resource in storage.
//      */
//     public function update(Request $request, Transaksi $transaksi)
//     {
//         // Validasi data yang dikirim
//         $request->validate([
//             'id_product' => 'required|exists:products,id',
//             'jumlah_pembelian' => 'required|integer',
//             'nama_kasir' => 'required|string|max:255',
//             'tanggal_transaksi' => 'required|date',
//             'diskon' => 'nullable|numeric',
//         ]);

//         // Mengupdate data transaksi di database
//         $transaksi->update($request->all());

//         return redirect()->route('transaksis.index')->with('success', 'Transaksi berhasil diupdate.');
//     }

//     /**
//      * Remove the specified resource from storage.
//      */
//     public function destroy(Transaksi $transaksi)
//     {
//         // Menghapus transaksi dari database
//         $transaksi->delete();

//         return redirect()->route('transaksis.index')->with('success', 'Transaksi berhasil dihapus.');
//     }
// }
