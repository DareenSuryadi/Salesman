<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class SupplierController extends Controller
{
    /**
     * 
     * 
     * @return View
     */
    public function index() : View
    {
   
        $supplier = new Supplier;
        
   
        $suppliers = $supplier->get_supplier()
                            ->latest()
                            ->paginate(10);
        
        
        return view('suppliers.index', compact('suppliers'));
    }

       /**
         * 
         * show
         * 
         * @param mixed $id
         * @return View
         */

         public function show(string $id): View
         {
            $supplier_model = new Supplier;
            $supplier = $supplier_model->get_supplier()->where("suppliers.id" , $id)->FirstOrFail();
            
            return view('suppliers.show', compact('supplier')); 
         } 

     /**
         * 
         * edit
         * 
         * @param mixed $id
         * @return View
         */

         public function edit(string $id): View
         {
            $supplier_model = new Supplier;
            $data['supplier'] = $supplier_model->get_supplier()->where("suppliers.id" , $id)->FirstOrFail();
            
            $supplier_model = new Supplier;
            $data['suppliers_'] = $supplier_model->get_supplier()->get();
            return view('suppliers.edit', compact('data')); 
         } 
    /**
         * 
         * update
         * 
         * @param mixed $request
         * @param mixed $id
         * @return View
         */

         public function update(Request $request, $id): RedirectResponse
         {
             // Validasi input
             $request->validate([
                 'supplier_name' => 'required|min:5',
                 'address_supp' => 'required|min:5',
                 'phone_supp' => 'required|numeric',
                 'pic_name' => 'required|min:5',
                 'phone' => 'required|numeric',
                 'address' => 'required|min:5',
             ]);
             
             // Temukan supplier berdasarkan ID
             $supplier = Supplier::where("suppliers.id", $id)->firstOrFail();
         
             // Update data supplier
             $supplier->update([
                 'supplier_name' => $request->supplier_name,
                 'address_supp' => $request->address_supp,
                 'phone_supp' => $request->phone_supp,
                 'pic_name' => $request->pic_name,
                 'phone' => $request->phone,
                 'address' => $request->address,
             ]);
         
             // Redirect dengan pesan sukses
             return redirect()->route('suppliers.index')->with(['success' => 'Data Berhasil Diubah!']);
         }
         
         /**
         * 
         * destroy
         * 
         * @param mixed $id
         * @return RedirectResponse
         */

         public function destroy($id): RedirectResponse
         {
             // Mencari supplier berdasarkan ID
             $supplier = Supplier::where("id", $id)->firstOrFail();
            
             $supplier->delete();
         
             // Mengalihkan kembali ke index dengan pesan sukses
             return redirect()->route('suppliers.index')->with(['success' => 'Data Berhasil Dihapus!']); 
         }
         
}
