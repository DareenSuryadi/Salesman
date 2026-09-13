<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Supplier;
use App\Models\Fasilitas;

use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index(): View
    {
        $product = new Product;
        $products = $product->get_product()->latest()->get();
        return view('products.index', compact('products'));
    }

    public function indexc(): View
    {
        $product = new Product;
        $products = $product->get_product()->latest()->get();
        return view('indexc', compact('products'));
    }

    public function create(): View
    {
        $product = new Product;
        $supplier = new Supplier;

        $data['categories'] = $product->get_category_product()->get();
        $data['suppliers_'] = $supplier->get_supplier()->get();

        return view('products.create', compact('data'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'image'                 => 'required|image|mimes:jpeg,jpg,png|max:2048',
            'title'                 => 'required|min:3',
            'product_category_id'   => 'required|integer',
            'id_supplier'           => 'required|integer',
            'description'           => 'required|min:10',
            'alamat'                => 'required|string|max:1000',
            'price'                 => 'required|numeric',
            'diskon'                => 'required|integer|min:0|max:100',
            'stock'                 => 'required|numeric',
            'fasilitas1' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'fasilitas2' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'fasilitas3' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'fasilitas4' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'fasilitas5' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'video_link' => 'nullable|url'
        ]);


        
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image->store('public/images');

            $product = Product::create([
                'image'                 => $image->hashName(),
                'title'                 => $request->title,
                'product_category_id'   => $request->product_category_id,
                'id_supplier'           => $request->id_supplier,
                'description'           => $request->description,
                'alamat'                => $request->alamat,
                'price'                 => $request->price,
                'diskon'                => $request->diskon,
                'video_link'            => $request->video_link,
                'stock'                 => $request->stock
            ]);

            

            // Simpan gambar fasilitas jika ada
            for ($i = 1; $i <= 5; $i++) {
                $field = 'fasilitas' . $i;

                if ($request->hasFile($field)) {
                    $file = $request->file($field);
                    $filename = time() . '_' . $file->getClientOriginalName();
                    $file->storeAs('public/fasilitas', $filename);

                    Fasilitas::create([
                        'product_id' => $product->id,
                        'foto' => $filename,
                    ]);
                }
            }

            return redirect()->route('products.index')->with(['success' => 'Data Berhasil Disimpan!']);
        }

        return redirect()->route('products.index')->with(['error' => 'Failed to upload image.']);
    }

    public function show(string $id): View
    {
        $product_model = new Product;
        $product = $product_model->get_product()->where("products.id", $id)->firstOrFail();

        return view('products.show', compact('product'));
    }

    public function showc(string $id): View
    {
        $cart = session()->get('cart', []);
        $totalPrice = 0;

        foreach ($cart as $item) {
            $totalPrice += $item['price'] * $item['jumlah_pembelian'];
        }

        $product = Product::with('supplier')->findOrFail($id);
        $averageRating = $product->ulasans->avg('rating');

        $ulasan = DB::table('ulasan')
            ->join('transaksis', 'transaksis.id', '=', 'ulasan.id_transaksi')
            ->join('detail_transaksi', 'detail_transaksi.id_transaksi', '=', 'transaksis.id')
            ->join('products', 'products.id', '=', 'detail_transaksi.id_product')
            ->where('products.id', $id)
            ->select('ulasan.*', 'transaksis.id as transaksi_id')
            ->get();

        return view('products.showc', compact('product', 'ulasan', 'averageRating', 'cart', 'totalPrice'));
    }

    public function edit(string $id): View
    {
        $product_model = new Product;
        $data['product'] = $product_model->get_product()->where("products.id", $id)->firstOrFail();

        $supplier_model = new Supplier;
        $data['categories'] = $product_model->get_category_product()->get();
        $data['suppliers_'] = $supplier_model->get_supplier()->get();

        return view('products.edit', compact('data'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'image'                 => 'image|mimes:jpeg,jpg,png|max:2048',
            'title'                 => 'required|min:3',
            'description'           => 'required|min:10',
            'alamat'                => 'required|string|max:1000',
            'price'                 => 'required|numeric',
            'diskon'                => 'required|integer|min:0|max:100',
            'fasilitas_new.*' => 'nullable|image|max:2048',
        'fasilitas_edit.*' => 'nullable|image|max:2048',
        'delete_fasilitas.*' => 'nullable|integer|exists:fasilitas,id',
        'video_link' => 'nullable|url',
            'stock'                 => 'required|numeric'
        ]);

        $product_model = new Product;
        $product = $product_model->get_product()->where("products.id", $id)->firstOrFail();

        if ($request->has('delete_video')) {
    $product->video_link = null;
} else {
    $product->video_link = $request->input('video_link');
}

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image->storeAs('public/images/', $image->hashName());

            Storage::delete('public/images/' . $product->image);

            $product->update([
                'image'                 => $image->hashName(),
                'title'                 => $request->title,
                'product_category_id'   => $request->product_category_id,
                'id_supplier'           => $request->id_supplier,
                'description'           => $request->description,
                'alamat'                => $request->alamat,
                'price'                 => $request->price,
                'diskon'                => $request->diskon,
                'stock'                 => $request->stock
            ]);
        } else {
            $product->update([
                'title'                 => $request->title,
                'product_category_id'   => $request->product_category_id,
                'id_supplier'           => $request->id_supplier,
                'description'           => $request->description,
                'alamat'                => $request->alamat,
                'price'                 => $request->price,
                'diskon'                => $request->diskon,
                'stock'                 => $request->stock
            ]);
        }

        if ($request->has('delete_fasilitas')) {
        foreach ($request->delete_fasilitas as $idFasilitas) {
            $fasilitas = Fasilitas::find($idFasilitas);
            if ($fasilitas) {
                Storage::delete('public/fasilitas/' . $fasilitas->foto);
                $fasilitas->delete();
            }
        }
    }

    if ($request->hasFile('fasilitas_edit')) {
        foreach ($request->file('fasilitas_edit') as $idFasilitas => $file) {
            $fasilitas = Fasilitas::find($idFasilitas);
            if ($fasilitas && $file) {
                Storage::delete('public/fasilitas/' . $fasilitas->foto);
                $filename = uniqid() . '.' . $file->getClientOriginalExtension();
                $file->storeAs('public/fasilitas', $filename);
                $fasilitas->foto = $filename;
                $fasilitas->save();
            }
        }
    }

    if ($request->hasFile('fasilitas_new')) {
        foreach ($request->file('fasilitas_new') as $file) {
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/fasilitas', $filename);
            Fasilitas::create([
                'product_id' => $product->id,
                'foto' => $filename,
            ]);
        }
    }

        if ($request->hasFile('fasilitas')) {
    foreach ($request->file('fasilitas') as $file) {
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->storeAs('public/fasilitas', $filename);

        Fasilitas::create([
            'product_id' => $product->id,
            'foto' => $filename
        ]);
    }
}


        return redirect()->route('products.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    public function destroy($id): RedirectResponse
    {
        $product_model = new Product;
        $product = $product_model->get_product()->where("products.id", $id)->firstOrFail();

        Storage::delete('public/images/' . $product->image);

        // Hapus foto fasilitas juga
        $fasilitas = Fasilitas::where('product_id', $product->id)->get();
        foreach ($fasilitas as $item) {
            Storage::delete('public/fasilitas/' . $item->foto);
            $item->delete();
        }

        $product->delete();

        return redirect()->route('products.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
