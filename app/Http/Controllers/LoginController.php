<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Supplier;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function loginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {

            $user = Auth::user();
            
            if ($user->role === 'admin') {
                return redirect()->route('home')->with('success', 'Login successful as Admin');
            } elseif ($user->role === 'customer') {
                return redirect()->route('index')->with('success', 'Login successful as Customer');
            } else {
                return redirect()->route('home')->with('success', 'Login successful');
            }
        } else {
            return back()->withErrors(['email' => 'Invalid credentials.']);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('index');
    }

    public function index()
    {
        $product = new Product;
        $products = $product->get_product()->latest()->get();

        return view('index', compact('products'));
    }

    public function plist()
    {
        $product = new Product;
        // $supplier = new Supplier;

        $products = $product->get_product()->latest()->get();
        $suppliers = $product->get_category_product()->orderBy('product_category_name', 'asc')->get();
        
        $productsByCategory = [];
        foreach ($suppliers as $supplier) {
            $productsByCategory[$supplier->product_category_name] = Product::where('product_category_id', $supplier->id)->get();
        }

        return view('plist', compact('products', 'suppliers', 'productsByCategory'));
    }

    public function home()
    {
        return view('home');
    }

    public function profile()
    {
        return view('profile');
    }
}
