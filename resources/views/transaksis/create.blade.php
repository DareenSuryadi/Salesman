<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add New Transaction</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-image: url(https://blog-asset.jakmall.com/2023/12/TWICEJKT23_Poster4x5-1448x2048.png);background-size: auto;background-position: center; " >

<div class="container mt-5 mb-5">
    <div class="row">
        <div class="col-md-12">
            <h3 style="color:white; text-align:center;">Add New Transaction</h3>
            <div class="card border-0 shadow-sm rounded">
                <div class="card-body">
                    <form id="transaksisForm" action="{{ route('transaksis.store') }}" method="POST">
                        @csrf
                        <div id="productsContainer">
                            <!-- Produk pertama sudah ada secara default -->
                            <div class="product-row mb-3">
                                <div class="form-group mb-3">
                                    <label for="id_product">Product 1</label>
                                    <select class="form-control" name="products[0][id_product]" required>
                                        <option value="">-- Select Product --</option>
                                        @foreach ($products as $product)
                                            <option value="{{ $product->id }}">{{ $product->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <label>Jumlah Pembelian</label>
                                    <input type="number" class="form-control" name="products[0][jumlah_pembelian]" required>
                                </div>
                            </div>
                        </div>

                        <!-- Tombol untuk menambah produk -->
                        <button type="button" class="btn btn-success mb-3" onclick="addProduct()">Tambah Produk</button>

                        <div class="form-group mb-3">
                            <label>Nama Kasir</label>
                            <input type="text" class="form-control" name="nama_kasir" required>
                        </div>

                        <div class="form-group mb-3">
                            <label>Tanggal Transaksi</label>
                            <input type="date" class="form-control" name="tanggal_transaksi" required>
                        </div>

                        <div class="form-group mb-3">
                            <label>Diskon (%)</label>
                            <input type="number" class="form-control" name="diskon" placeholder="Masukkan Diskon">
                        </div>

                        <button type="submit" class="btn btn-primary">SAVE</button>
                        <button type="button" id="resetBtn" onclick="resetForm()" class="btn btn-md btn-warning">RESET</button>

                    </form> 
                </div>
            </div>
        </div>
    </div>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
    
    <script>
        CKEDITOR.replace( 'description' );

        function resetForm() {
            document.getElementById("transaksisForm").reset(); // Mereset semua nilai dalam form
        }

        let productIndex = 1; // Mulai dari 1 karena produk pertama sudah diatur di form

        // Fungsi untuk menambah produk baru ke form
        function addProduct() {
            productIndex++; // Increment index untuk produk baru

            const productHtml = `
                <div class="product-row mb-3">
                    <div class="form-group mb-3">
                        <label for="id_product">Product ${productIndex}</label>
                        <select class="form-control" name="products[${productIndex}][id_product]" required>
                            <option value="">-- Select Product --</option>
                            @foreach ($products as $product)
                                <option value="{{ $product->id }}">{{ $product->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label>Jumlah Pembelian</label>
                        <input type="number" class="form-control" name="products[${productIndex}][jumlah_pembelian]" required>
                    </div>
                </div>
            `;

            // Tambahkan produk baru ke container
            document.getElementById('productsContainer').insertAdjacentHTML('beforeend', productHtml);
        }
    </script>

</body>
</html>
