<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\DetailTransaksi;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\view\view;
use Illuminate\Http\RedirectResponse;



class TransaksiController extends Controller
{
    public function index()
    {
        
        // $transaksis = Transaksi::with(['detailTransaksi', 'product'])->paginate(10);
        $transaksismodel = new Transaksi;
        $transaksis = $transaksismodel->get_transaksi()->get();
        return view('transaksis.index', compact('transaksis'));
    }

    public function create()
    {
        $product = new Product;
        $products = $product->get_product()->get();
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


  /**
     * show
     * 
     * @param mixed $id
     * @return View
     */
    public function show(string $id): View
    {
        //get product by ID
        $transaksi_model = new Transaksi;
        $transaksis = $transaksi_model->get_transaksi()->where("transaksis.id", $id)->firstOrFail();

        //render view with product
        return view('transaksis.show', compact('transaksis'));
    }

/**
 * edit
 * 
 * @param string $id
 * @return View
 */
public function edit(string $id): View
{
    //get transaction by ID
    $transaksi_model = new Transaksi;
    $transaksis['transaksi'] = $transaksi_model->get_transaksi()->where("transaksis.id", $id)->firstOrFail();
    $products = Product::all();

    //render view with transaction and products
    return view('transaksis.edit', compact('transaksis'));
}

/**
 * update
 * 
 * @param Request $request
 * @param string $id
 * @return RedirectResponse
 */
public function update(Request $request, $id): RedirectResponse
{
    //validate form
    $request->validate([
        'jumlah_pembelian'    => 'required|numeric| min:1',
        'nama_kasir'          => 'required|string|min:3',
        'tanggal_transaksi'   => 'required|date',
        'diskon'              => 'nullable|numeric|between:0,100',
    ]);

    //get transaction by ID
    $transaksi_model = new Transaksi;
    $transaksi = $transaksi_model->get_transaksi()->where("transaksis.id", $id)->firstOrFail();

    //update transaction
    $transaksi->update([
        'jumlah_pembelian'  => $request->jumlah_pembelian,
        'nama_kasir'        => $request->nama_kasir,
        'tanggal_transaksi' => $request->tanggal_transaksi,
        'diskon'            => $request->diskon,
    ]);
    DB::table('detail_transaksi')
    ->where('id_transaksi', $transaksi->id)
    ->update([  
        'jumlah_pembelian' => $request->jumlah_pembelian,
    ]);

    //redirect to index with success message
    return redirect()->route('transaksis.index')->with(['success' => 'Transaction updated successfully!']);
}


    public function destroy($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->delete();

        return redirect()->route('transaksis.index')->with('success', 'Transaksi berhasil dihapus');
    }
}
