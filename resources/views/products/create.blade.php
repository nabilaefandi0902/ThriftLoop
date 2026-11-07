<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk - ThriftLoop</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f7f5;
            margin: 0;
            padding: 30px;
        }

        .container {
            max-width: 650px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 3px 12px rgba(0,0,0,0.08);
        }

        h2 {
            color: #245c45;
            text-align: center;
        }

        label {
            display: block;
            margin-top: 16px;
            font-weight: bold;
        }

        input, textarea {
            width: 100%;
            padding: 11px;
            margin-top: 7px;
            border: 1px solid #ccc;
            border-radius: 6px;
            box-sizing: border-box;
        }

        textarea {
            min-height: 100px;
            resize: vertical;
        }

        button {
            width: 100%;
            margin-top: 25px;
            padding: 13px;
            background: #245c45;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
        }

        .error {
            color: red;
            font-size: 13px;
        }

        .back {
            display: block;
            margin-top: 18px;
            text-align: center;
            color: #245c45;
            text-decoration: none;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Tambah Produk ThriftLoop</h2>

    <form action="{{ route('seller.products.store') }}" method="POST">
        @csrf

        <label>Nama Produk</label>
        <input type="text" name="title" value="{{ old('title') }}" required>
        @error('title')
            <div class="error">{{ $message }}</div>
        @enderror

        <label>Deskripsi Produk</label>
        <textarea name="description" required>{{ old('description') }}</textarea>
        @error('description')
            <div class="error">{{ $message }}</div>
        @enderror

        <label>Harga Awal (Rp)</label>
        <input type="number" name="base_price" min="0" step="0.01" value="{{ old('base_price') }}" required>
        @error('base_price')
            <div class="error">{{ $message }}</div>
        @enderror

        <label>Harga Minimum (Rp)</label>
        <input type="number" name="min_price" min="0" step="0.01" value="{{ old('min_price') }}" required>
        @error('min_price')
            <div class="error">{{ $message }}</div>
        @enderror

        <label>Kondisi Barang (1–100%)</label>
        <input type="number" name="condition_percentage" min="1" max="100" value="{{ old('condition_percentage') }}" required>
        @error('condition_percentage')
            <div class="error">{{ $message }}</div>
        @enderror

        <label>Detail Ukuran</label>
        <input type="text" name="size_detail" value="{{ old('size_detail') }}" placeholder="Contoh: L, LD 100 cm" required>
        @error('size_detail')
            <div class="error">{{ $message }}</div>
        @enderror

        <button type="submit">Simpan Produk</button>
    </form>

    <a href="{{ route('seller.products.index') }}" class="back">Kembali ke Daftar Produk</a>
</div>

</body>
</html>
