<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;

class Supplier2Controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Supplier::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'supplier_name' => 'required|string|max:255',
            'nama_kota_supp' => 'required|string|max:255',
            'nama_negara_supp' => 'required|string|max:255',
            'nama_provinsi_supp' => 'required|string|max:255',
            'kode_pos' => 'required|string|max:10',
            'phone_supp' => 'required|string|max:15',
            'pic_name' => 'required|string|max:255',
            'phone_pic' => 'required|string|max:15',
        ]);

        $supplier = Supplier::create($validateData);

        return response()->json($supplier, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $supplier = Supplier::find($id);
        if (!$supplier) return response()->json(['message' => 'Supplier not found'], 404);
        return $supplier;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $supplier = Supplier::find($id);
        if (!$supplier) {
            return response()->json(['message' => 'Supplier not found'], 404);
        }

        $validateData = $request->validate([
            'supplier_name' => 'required|string|max:255',
            'nama_kota_supp' => 'required|string|max:255',
            'nama_negara_supp' => 'required|string|max:255',
            'nama_provinsi_supp' => 'required|string|max:255',
            'kode_pos' => 'required|string|max:10',
            'phone_supp' => 'required|string|max:15',
            'pic_name' => 'required|string|max:255',
            'phone_pic' => 'required|string|max:15',
        ]);

        $supplier->update($validateData);

        return response()->json($supplier, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $supplier = Supplier::find($id);
        if (!$supplier) return response()->json(['message' => 'Supplier not found'], 404);

        $supplier->delete();
        return response()->json(null, 204);
    }
}