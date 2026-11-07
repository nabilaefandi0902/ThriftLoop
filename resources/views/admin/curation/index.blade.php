<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Curation - ThriftLoop</title>

    <style>
        * {
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            margin: 0;
            padding: 30px;
            background: #f4f6f5;
            color: #263238;
        }

        .container {
            max-width: 1000px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 12px;
        }

        h1 {
            color: #245c4f;
        }

        .product {
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 20px;
            margin-top: 20px;
        }

        .status {
            color: #a66b00;
            font-weight: bold;
        }

        .btn {
            display: inline-block;
            background: #245c4f;
            color: white;
            padding: 10px 16px;
            border-radius: 6px;
            text-decoration: none;
            margin-top: 10px;
        }

        .success {
            padding: 12px;
            background: #d9f3e4;
            color: #17643b;
            border-radius: 6px;
        }

        .error {
            color: red;
        }
    </style>
</head>

<body>
<div class="container">

    <h1>Admin Curation ThriftLoop</h1>
    <p>Daftar produk yang menunggu proses kurasi Admin.</p>

    @if(session('success'))
        <div class="success">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="error">
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    @forelse($products as $product)
        <div class="product">
            <h2>{{ $product->title }}</h2>

            <p><strong>Seller:</strong>
                {{ $product->seller->name ?? '-' }}
            </p>

            <p><strong>Deskripsi:</strong>
                {{ $product->description }}
            </p>

            <p><strong>Harga Awal:</strong>
                Rp {{ number_format($product->base_price, 0, ',', '.') }}
            </p>

            <p><strong>Harga Minimum:</strong>
                Rp {{ number_format($product->min_price, 0, ',', '.') }}
            </p>

            <p><strong>Kondisi:</strong>
                {{ $product->condition_percentage }}%
            </p>

            <p><strong>Ukuran:</strong>
                {{ $product->size_detail }}
            </p>

            <p class="status">
                Status: {{ $product->status }}
            </p>

            <a class="btn"
               href="{{ route('admin.curation.show', $product->id) }}">
                Periksa Produk
            </a>
        </div>
    @empty
        <p>Belum ada produk yang menunggu kurasi.</p>
    @endforelse

</div>
</body>
</html>
