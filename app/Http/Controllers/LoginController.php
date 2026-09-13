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
        session()->forget('cart');
        return redirect()->route('index');
    }

    public function index()
    {
        $cart = $this->syncCartPrices();
        $totalPrice = 0;

        // Calculate total price
        foreach ($cart as $item) {
            $totalPrice += $item['price'] * $item['jumlah_pembelian'];
        }

        $product = new Product;
        $products = $product->get_product()->latest()->paginate(10);
        $luxuriousProducts = $product->get_product()
            ->orderByDesc('products.price')
            ->take(1)
            ->get();
        $offerProducts = $product->get_product()
            ->where('products.diskon', '>', 0)
            ->latest('products.updated_at')
            ->take(4)
            ->get();

        return view('index', compact('products', 'luxuriousProducts', 'offerProducts', 'cart', 'totalPrice'));
    }

    public function plist()
    {
        $cart = $this->syncCartPrices();
        $totalPrice = 0;

        // Calculate total price
        foreach ($cart as $item) {
            $totalPrice += $item['price'] * $item['jumlah_pembelian'];
        }

        $product = new Product;

        $products = $product->get_product()->latest()->get();
        $suppliers = $product->get_category_product()->orderBy('product_category_name', 'asc')->get();
        
        $productsByCategory = [];
        foreach ($suppliers as $supplier) {
            $productsByCategory[$supplier->product_category_name] = Product::where('product_category_id', $supplier->id)->get();
        }

        return view('plist', compact('products', 'suppliers', 'productsByCategory', 'cart', 'totalPrice'));
    }

    public function home()
    {
        return view('home');
    }

    public function profile()
    {
        return view('profile');
    }
    
    public function cart()
    {
        return view('cart');
    }

    public function addToCart(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        if ((int) $product->stock <= 0) {
            return redirect()->back()->with('error', 'Stok produk sudah habis.');
        }

        // Get existing cart or initialize empty cart
        $cart = $this->syncCartPrices();

        // Check if product exists in the cart
        if (isset($cart[$id])) {
            if ($cart[$id]['jumlah_pembelian'] >= $product->stock) {
                return redirect()->back()->with('error', 'Jumlah pembelian sudah mencapai stok yang tersedia.');
            }

            $cart[$id]['jumlah_pembelian']++;
        } else {
            $cart[$id] = [
                "title" => $product->title,
                "jumlah_pembelian" => 1,
                "price" => $product->discounted_price,
                "image" => $product->image,
            ];
        }

        // Save updated cart in session
        session()->put('cart', $cart);

        return redirect()->route('cart')->with('success', 'Product added to cart!');
    }

    // View the cart
    public function viewCart()
    {
        $cart = $this->syncCartPrices();
        $totalPrice = 0;

        // Calculate total price
        foreach ($cart as $item) {
            $totalPrice += $item['price'] * $item['jumlah_pembelian'];
        }

        return view('cart', compact('cart', 'totalPrice'));
    }

    // Remove item from cart
    public function removeFromCart($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->route('cart')->with('success', 'Product removed from cart!');
    }

    // Update item quantity in cart
    public function updateQuantity(Request $request, $id)
    {
        $cart = session()->get('cart', []);

        // If the product is in the cart, update quantity
        if (isset($cart[$id])) {
            $product = Product::findOrFail($id);
            $newQuantity = (int) $request->jumlah_pembelian;

            if ((int) $product->stock <= 0) {
                return redirect()->route('cart')->with('error', 'Stok produk sudah habis.');
            }

            if ($newQuantity > $product->stock) {
                return redirect()->route('cart')->with('error', 'Jumlah pembelian melebihi stok yang tersedia.');
            }

            $cart[$id]['price'] = $product->discounted_price;

            if ($newQuantity > 0) {
                $cart[$id]['jumlah_pembelian'] = $newQuantity;
            } else {
                // If the quantity is 0 or less, remove the item
                unset($cart[$id]);
            }

            session()->put('cart', $cart);
        }

        return redirect()->route('cart')->with('success', 'Cart updated!');
    }

    private function syncCartPrices(): array
    {
        $cart = session()->get('cart', []);

        foreach ($cart as $id => &$item) {
            $product = Product::find($id);

            if ($product) {
                $item['price'] = $product->discounted_price;
                $item['title'] = $product->title;
                $item['image'] = $product->image;
            }
        }

        unset($item);
        session()->put('cart', $cart);

        return $cart;
    }
}
