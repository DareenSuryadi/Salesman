<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\DetailTransaksi;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;



class TransaksiController extends Controller
{
    public function index()
    {
        
        // $transaksis = Transaksi::with(['detailTransaksi', 'product'])->paginate(10);
        $transaksismodel = new Transaksi;
        $transaksis = $transaksismodel->get_transaksi()->paginate(10);
        return view('transaksis.index', compact('transaksis'));
    }

    public function create()
    {
        $product = new Product;
        $products = $product->get_product()->paginate(10);
        return view('transaksis.create', compact('products'));
    }

    public function store(Request $request)
{
    // Validasi input untuk banyak produk
    $request->validate([
        'products' => 'required|array',
        'products.*.id_product' => 'required|exists:products,id',
        'products.*.jumlah_pembelian' => 'required|integer|min:1',
        'nama_kasir' => 'required|string|max:255',
        'tanggal_transaksi' => 'required|date',
        'diskon' => 'nullable|numeric|min:0|max:100',
    ]);

    $lastTransaksi = Transaksi::orderBy('id', 'DESC')->first();
    $newId = $lastTransaksi ? $lastTransaksi->id + 1 : 1;

    $totalHarga = 0;

    // Hitung total harga berdasarkan setiap produk yang dipilih
    foreach ($request->products as $productData) {
        $product = Product::find($productData['id_product']);
        $hargaSatuan = $product->price;
        $jumlahPembelian = $productData['jumlah_pembelian'];
        $totalHarga += $hargaSatuan * $jumlahPembelian;
    }

    // Hitung diskon jika ada
    $diskon = $request->diskon ?? 0;
    $totalSetelahDiskon = $totalHarga - ($totalHarga * ($diskon / 100));

    // Buat transaksi baru
    $newTransaksi = Transaksi::create([
        'id' => $newId,
        'nama_kasir' => $request->nama_kasir,
        'tanggal_transaksi' => $request->tanggal_transaksi,
        'diskon' => $diskon,
        'total_harga' => $totalSetelahDiskon, // total harga setelah diskon
    ]);

    // Simpan detail transaksi untuk setiap produk
    foreach ($request->products as $productData) {
        DB::table('detail_transaksi')->insert([
            'id_product' => $productData['id_product'],
            'id_transaksi' => $newTransaksi->id,
            'jumlah_pembelian' => $productData['jumlah_pembelian'],
        ]);
    }

    return redirect()->route('transaksis.index')->with('success', 'Transaksi berhasil ditambahkan!');
}


    public function show($id)
    {
        $transaksi = Transaksi::with(['detailTransaksi', 'product'])->findOrFail($id);
        return view('transaksis.show', compact('transaksi'));
    }

    public function edit($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $products = Product::all();
        return view('transaksis.edit', compact('transaksi', 'products'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_product' => 'required',
            'jumlah_pembelian' => 'required|integer',
            'diskon' => 'nullable|numeric',
            'tanggal_transaksi' => 'required|date',
            'nama_kasir' => 'required|string',
        ]);

        $transaksi = Transaksi::findOrFail($id);
        $transaksi->update($request->all());

        return redirect()->route('transaksis.index')->with('success', 'Transaksi berhasil diperbarui');
    }

    public function destroy($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->delete();

        return redirect()->route('transaksis.index')->with('success', 'Transaksi berhasil dihapus');
    }
}
