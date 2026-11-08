<?php

namespace App\Http\Controllers;

use App\Models\Negotiation;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NegotiationController extends Controller
{
    // Mengajukan penawaran harga
    public function store(Request $request, $productId)
    {
        $request->validate([
            'offered_price' => 'required|numeric|min:1',
        ]);

        $product = Product::findOrFail($productId);

        // Memeriksa batas harga minimum
        if ($request->offered_price < $product->min_price) {
            return back()->with(
                'error',
                'Penawaran ditolak karena harga di bawah batas minimum.'
            );
        }

        // Menyimpan penawaran
        Negotiation::create([
            'product_id' => $product->id,
            'buyer_id' => Auth::id(),
            'offered_price' => $request->offered_price,
            'status' => 'pending',
        ]);

        return back()->with(
            'success',
            'Penawaran berhasil diajukan dan menunggu tanggapan penjual.'
        );
    }

    // Menerima penawaran
    public function accept($id)
    {
        $negotiation = Negotiation::findOrFail($id);

        $negotiation->update([
            'status' => 'accepted',
        ]);

        return back()->with(
            'success',
            'Penawaran berhasil diterima.'
        );
    }

    // Menolak penawaran
    public function reject($id)
    {
        $negotiation = Negotiation::findOrFail($id);

        $negotiation->update([
            'status' => 'rejected',
        ]);

        return back()->with(
            'success',
            'Penawaran berhasil ditolak.'
        );
    }
}
