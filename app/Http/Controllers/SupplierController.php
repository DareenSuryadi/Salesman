<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class SupplierController extends Controller
{
    public function index(): View
    {
        $suppliers = Supplier::latest()->get();
        return view('suppliers.index', compact('suppliers'));
    }

    public function create(): View
    {
        return view('suppliers.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'supplier_name'      => 'required|string|min:3|max:100',
            'nama_kota_supp'     => 'required|string|min:3|max:100',
            'nama_negara_supp'   => 'required|string|min:5|max:255',
            'nama_provinsi_supp' => 'required|string|min:5|max:255',
            'kode_pos'           => 'required|digits:5',
            'phone_supp'         => 'required|digits_between:10,15',
            'pic_name'           => 'required|string|min:3|max:255',
            'phone_pic'          => 'required|digits_between:10,15',
        ]);

        Supplier::create($validatedData);

        return redirect()->route('suppliers.index')->with('success', 'Data berhasil disimpan!');
    }

    public function edit(string $id): View
    {
        $supplier = Supplier::findOrFail($id);
        return view('suppliers.edit', compact('supplier'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $validatedData = $request->validate([
            'supplier_name'      => 'required|string|min:3|max:100',
            'nama_kota_supp'     => 'required|string|min:3|max:100',
            'nama_negara_supp'   => 'required|string|min:5|max:255',
            'nama_provinsi_supp' => 'required|string|min:5|max:255',
            'kode_pos'           => 'required|digits:5',
            'phone_supp'         => 'required|digits_between:10,15',
            'pic_name'           => 'required|string|min:3|max:255',
            'phone_pic'          => 'required|digits_between:10,15',
        ]);

        $supplier = Supplier::findOrFail($id);
        $supplier->update($validatedData);

        return redirect()->route('suppliers.index')->with('success', 'Data berhasil diperbarui!');
    }

    public function destroy($id): RedirectResponse
    {
        $supplier = Supplier::findOrFail($id);
        $supplier->delete();

        return redirect()->route('suppliers.index')->with('success', 'Data berhasil dihapus!');
    }
}