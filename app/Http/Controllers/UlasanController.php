<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Ulasan;
use Illuminate\Http\Request;

class UlasanController extends Controller
{
    // Method untuk mendapatkan semua ulasan
    public function index()
    {
        $ulasan = Ulasan::all();
        return response()->json($ulasan);
    }

    // Method untuk membuat ulasan baru
    public function store(Request $request, $id_transaksi)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'ulasan' => 'required|string|max:255',
        ]);
    
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
    
        return response()->json($ulasan, 201);
    }
    
    // Method untuk mendapatkan detail ulasan berdasarkan ID
    public function show($id)
    {
        $ulasan = Ulasan::find($id);

        if (!$ulasan) {
            return response()->json(['message' => 'Ulasan not found'], 404);
        }

        return response()->json($ulasan);
    }

    // Method untuk mengupdate ulasan
    public function update(Request $request, $id)
    {
        $ulasan = Ulasan::find($id);

        if (!$ulasan) {
            return response()->json(['message' => 'Ulasan not found'], 404);
        }

        $request->validate([
            'ulasan' => 'string',
            'rating' => 'string', // ENUM value di database
        ]);

        $ulasan->update($request->all());

        return response()->json($ulasan);
    }

    // Method untuk menghapus ulasan
    public function destroy($id)
    {
        $ulasan = Ulasan::find($id);

        if (!$ulasan) {
            return response()->json(['message' => 'Ulasan not found'], 404);
        }

        $ulasan->delete();

        return response()->json(['message' => 'Ulasan deleted successfully']);
    }
}
