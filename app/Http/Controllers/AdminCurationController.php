<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\VerificationLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class AdminCurationController extends Controller
{
    // Menampilkan daftar produk yang menunggu kurasi
    public function index()
    {
        $products = Product::with('seller')
            ->where('status', 'pending_curation')
            ->latest()
            ->get();

        return view('admin.curation.index', compact('products'));
    }

    // Menampilkan detail produk
    public function show(Product $product)
    {
        return view('admin.curation.show', compact('product'));
    }

    // Memproses persetujuan atau penolakan produk
    public function verify(Request $request, Product $product)
    {
        if ($product->status !== 'pending_curation') {
            return back()->withErrors([
                'curation' => 'Produk ini sudah diproses sebelumnya.',
            ]);
        }

        $validated = $request->validate([
            'curation_result' => [
                'required',
                Rule::in(['approved', 'rejected']),
            ],
            'notes' => 'required|string|max:2000',
        ]);

        DB::transaction(function () use ($product, $validated) {
            VerificationLog::create([
                'product_id' => $product->id,
                'admin_id' => Auth::id(),
                'curation_result' => $validated['curation_result'],
                'notes' => $validated['notes'],
            ]);

            $product->status = $validated['curation_result'] === 'approved'
                ? 'verified'
                : 'rejected';

            $product->save();
        });

        return redirect()->route('admin.curation.index')
            ->with('success', 'Hasil kurasi produk berhasil disimpan.');
    }
}
