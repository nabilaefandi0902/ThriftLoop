<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Produk - ThriftLoop</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f7f5;
            margin: 0;
            padding: 30px;
        }

        .container {
            max-width: 900px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 12px;
        }

        h2 {
            color: #245c45;
        }

        .add-button {
            display: inline-block;
            background: #245c45;
            color: white;
            padding: 12px 18px;
            border-radius: 6px;
            text-decoration: none;
            margin: 15px 0;
        }

        .success {
            background: #d4edda;
            color: #155724;
            padding: 12px;
            border-radius: 6px;
            margin-bottom: 15px;
        }

        .product {
            border: 1px solid #ddd;
            padding: 18px;
            border-radius: 8px;
            margin-top: 15px;
        }

        .status {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 5px;
            background: #fff3cd;
            color: #856404;
            font-size: 13px;
        }

        .empty {
            color: #777;
            padding: 20px 0;
        }
    </style>
</head>
<body>

<div class="container">

    <h2>Daftar Produk Saya</h2>
    <p>Kelola produk thrift yang kamu jual di ThriftLoop.</p>

    @if (session('success'))
        <div class="success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('seller.products.create') }}" class="add-button">
        + Tambah Produk
    </a>

    @forelse ($products as $product)

        <div class="product">
            <h3>{{ $product->title }}</h3>

            <p>{{ $product->description }}</p>

            <p>
                Harga Awal:
                Rp {{ number_format($product->base_price, 0, ',', '.') }}
            </p>

            <p>
                Harga Minimum:
                Rp {{ number_format($product->min_price, 0, ',', '.') }}
            </p>

            <p>Kondisi: {{ $product->condition_percentage }}%</p>

            <p>Ukuran: {{ $product->size_detail }}</p>

            <span class="status">
                Status:
                {{ str_replace('_', ' ', ucfirst($product->status)) }}
            </span>
        </div>

    @empty

        <p class="empty">
            Belum ada produk. Silakan tambahkan produk pertamamu!
        </p>

    @endforelse

</div>

</body>
</html>
