<?php

namespace App\Http\Controllers;

use App\Models\Category;

use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function index() : View
    {
        $category = new Category;
        $category = $category->get_category()->latest()->get();

        return view('category.index', compact('category'));
    }

    public function create() : View
    {
        return view('category.create');
    }

    public function store(Request $request) : RedirectResponse
    {
        $validateData = $request->validate([
            'product_category_name' => 'required|min:3',
        ]);

        Category::create([
            'product_category_name' => $request->product_category_name,
        ]);

        return redirect()->route('category.index')->with(['success' => 'Data berhasil disimpan!']);
    }
    
    public function show(string $id) : View
    {
        $category_model = new Category;
        $category = $category_model->get_category()->where("category_product.id", $id)->firstOrFail();

        return view('category.show', compact('category'));
    }
    
    public function edit(string $id) : View
    {
        $category_model = new Category;
        $data['category'] = $category_model->get_category()->where("category_product.id", $id)->firstOrFail();
        
        return view('category.edit', compact('data'));
    }
    
    public function update(Request $request, $id) : RedirectResponse
    {
        $request->validate([
            'product_category_name' => 'required|min:3',
        ]);

        $category_model = new Category;
        $category = $category_model->get_category()->where("category_product.id", $id)->firstOrFail();

        $category->update([
            'product_category_name' => $request->product_category_name,
        ]);

        return redirect()->route('category.index')->with(['success' => 'Data berhasil diubah!']);
    }
    
    public function destroy($id) : RedirectResponse
    {
        $category_model = new Category;
        $category = $category_model->get_category()->where("category_product.id", $id)->firstOrFail();

        $category->delete();

        return redirect()->route('category.index')->with(['success' => 'Data berhasil dihapus!']);
    }
}
