<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Periksa Produk - ThriftLoop</title>

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
            max-width: 750px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 12px;
        }

        h1 {
            color: #245c4f;
        }

        .detail {
            padding: 15px;
            background: #f7f9f8;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
        }

        textarea {
            width: 100%;
            min-height: 100px;
            padding: 12px;
            margin-top: 8px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }

        button {
            background: #245c4f;
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 6px;
            cursor: pointer;
            margin-top: 20px;
        }

        .back {
            display: inline-block;
            margin-top: 20px;
            color: #245c4f;
        }

        .error {
            color: red;
        }
    </style>
</head>

<body>
<div class="container">

    <h1>Pemeriksaan Produk</h1>
    <p>Periksa informasi produk sebelum memberikan keputusan.</p>

    <div class="detail">
        <h2>{{ $product->title }}</h2>

        <p><strong>Seller:</strong>
            {{ $product->seller->name ?? '-' }}
        </p>

        <p><strong>Email Seller:</strong>
            {{ $product->seller->email ?? '-' }}
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

        <p><strong>Status:</strong>
            {{ $product->status }}
        </p>
    </div>

    @if($errors->any())
        <div class="error">
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form action="{{ route('admin.curation.verify', $product->id) }}"
          method="POST">

        @csrf

        <label>Hasil Verifikasi</label>

        <p>
            <input type="radio" name="curation_result"
                   value="approved" required>
            Setujui Produk
        </p>

        <p>
            <input type="radio" name="curation_result"
                   value="rejected" required>
            Tolak Produk
        </p>

        <label for="notes">Catatan Admin</label>

        <textarea id="notes" name="notes"
                  placeholder="Masukkan alasan atau catatan hasil pemeriksaan..."
                  required>{{ old('notes') }}</textarea>

        <button type="submit">Simpan Hasil Verifikasi</button>
    </form>

    <a class="back" href="{{ route('admin.curation.index') }}">
        Kembali ke Daftar Produk
    </a>

</div>
</body>
</html>
