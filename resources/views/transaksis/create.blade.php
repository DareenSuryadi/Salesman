@extends('admin.layouts.master')

@section('content')
<h1 class="h3 mb-2 text-gray-800">Add Form</h1>

@if(Session::has('success'))
    <div class="card mb-4 py-3 border-left-primary">
        <div class="card-body">
            {{Session::get('success')}}
        </div>
    </div>
@endif
<div class="card shadow mb-4">
    
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Add Transaksi</h6>
    </div>
    <div class="card-body">
        <form action="{{route('transaksis.store')}}" method="post" enctype="multipart/form-data">
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

            <div class="form-group">
                <label for="nama_kasir">Nama Kasir</label>
                <input type="text" class="form-control form-control-user @error('nama_kasir') is-invalid @enderror" id="nama_kasir"
                placeholder="Masukkan nama kasir" name="nama_kasir" required autocomplete="nama_kasir">

                @error('nama_kasir')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="tanggal_transaksi">Tanggal Transaksi</label>
                <input type="date" class="form-control form-control-user @error('tanggal_transaksi') is-invalid @enderror" id="tanggal_transaksi"
                placeholder="Masukkan tanggal transaksi" name="tanggal_transaksi" required autocomplete="tanggal_transaksi">

                @error('tanggal_transaksi')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="diskon">Diskon</label>
                <input type="number" class="form-control form-control-user @error('diskon') is-invalid @enderror" id="diskon"
                placeholder="Masukkan diskon" name="diskon" required autocomplete="diskon">

                @error('diskon')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <button class="btn btn-outline-primary">Create</button>
            </div>
        </form>
    </div>
</div>

<script>
    let productIndex = 1;
    
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
@endsection
