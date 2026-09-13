<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fasilitas;
use Illuminate\Support\Facades\Storage;

class FasilitasController extends Controller
{
    public function destroy($id)
    {
        $fasilitas = Fasilitas::findOrFail($id);

        // Hapus file dari storage
        if (Storage::exists('public/fasilitas/' . $fasilitas->foto)) {
            Storage::delete('public/fasilitas/' . $fasilitas->foto);
        }

        // Hapus data dari database
        $fasilitas->delete();

        return back()->with('success', 'Fasilitas berhasil dihapus.');
    }
}
