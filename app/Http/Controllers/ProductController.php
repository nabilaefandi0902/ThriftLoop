<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    // Menampilkan daftar produk milik Seller
    public function index()
    {
        $products = Product::where('seller_id', Auth::id())
            ->latest()
            ->get();

        return view('products.index', compact('products'));
    }

    // Menampilkan form tambah produk
    public function create()
    {
        return view('products.create');
    }

    // Menyimpan produk baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'base_price' => 'required|numeric|min:0',
            'min_price' => 'required|numeric|min:0|lte:base_price',
            'condition_percentage' => 'required|integer|min:1|max:100',
            'size_detail' => 'required|string|max:255',
        ]);

        $validated['seller_id'] = Auth::id();

        Product::create($validated);

        return redirect()->route('seller.products.index')
            ->with('success', 'Produk berhasil ditambahkan dan menunggu kurasi Admin.');
    }
}
