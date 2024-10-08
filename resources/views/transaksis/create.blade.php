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
                        <div class="product-row mb-3">
                            <div class="form-group mb-3">
                                <label for="id_product">Product 1</label>
                                <select class="form-control" name="products[0][id_product]">
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

                        <div class="product-row mb-3">
                            <div class="form-group mb-3">
                                <label for="id_product">Product 2</label>
                                <select class="form-control" name="products[1][id_product]">
                                    <option value="">-- Select Product --</option>
                                    @foreach ($products as $product)
                                        <option value="{{ $product->id }}">{{ $product->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label>Jumlah Pembelian</label>
                                <input type="number" class="form-control" name="products[1][jumlah_pembelian]" required>
                            </div>
                        </div>

                        <div class="product-row mb-3">
                            <div class="form-group mb-3">
                                <label for="id_product">Product 3</label>
                                <select class="form-control" name="products[2][id_product]">
                                    <option value="">-- Select Product --</option>
                                    @foreach ($products as $product)
                                        <option value="{{ $product->id }}">{{ $product->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label>Jumlah Pembelian</label>
                                <input type="number" class="form-control" name="products[2][jumlah_pembelian]" required>
                            </div>
                        </div>

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

            // Reset CKEditor content to empty
            for (var instance in CKEDITOR.instances) {
                CKEDITOR.instances[instance].setData('');  // Reset CKEditor content
            }
        }
    </script>
    <script>
        function updatePrice() {
            const selectedProduct = document.getElementById("id_product");
            const hargaSatuan = selectedProduct.options[selectedProduct.selectedIndex].getAttribute('data-price');
            document.getElementById("harga_satuan").value = hargaSatuan ? hargaSatuan : 0;
            calculateTotal();
        }

        function calculateTotal() {
            const hargaSatuan = parseFloat(document.getElementById("harga_satuan").value);
            const jumlahPembelian = parseInt(document.getElementById("jumlah_pembelian").value);
            const diskon = parseFloat(document.getElementById("diskon").value) || 0;

            if (!isNaN(hargaSatuan) && !isNaN(jumlahPembelian)) {
                let totalHarga = hargaSatuan * jumlahPembelian;
                let nilaiDiskon = totalHarga * (diskon / 100);
                let totalSetelahDiskon = totalHarga - nilaiDiskon;
                document.getElementById("total_harga").value = totalSetelahDiskon.toFixed(2);
            }
        }
        
    </script>
    
</body>
</html>
