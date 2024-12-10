@extends('admin.layouts.master')
@if (Auth::user()->role == 'admin')
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
        <form id="transactionForm"action="{{route('transaksis.store')}}" method="post" enctype="multipart/form-data">
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
                <label for="status">Status</label>
                <select name="status" class="form-control @error('status') is-invalid @enderror">
                    <option value="">Choose Status</option>
                    <option value="Done">Done</option>
                    <option value="Proses">Proses</option>
                    <option value="Unpaid">Unpaid</option>
                    

                    @error('status')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </select>
            </div>

            <div class="form-group">
                <button class="btn btn-outline-primary">Create</button>
                <button type="button" id="resetBtn" onclick="resetForm()" class="btn btn-md btn-warning" style>RESET</button>
            </div>
        </form>
    </div>
</div>

@elseif (Auth::user()->role == 'customer')
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
        <form id="transactionForm"action="{{route('transaksis.store')}}" method="post" enctype="multipart/form-data">
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
                <label for="diskon">Input Your Diskon Periode 20% Now!!</label>
                <input type="number" class="form-control form-control-user @error('diskon') is-invalid @enderror" id="diskon"
                placeholder="Masukkan diskon" name="diskon" required autocomplete="diskon" min ="20"max="20" step="0.01">

                @error('diskon')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>


            <div class="form-group">
                <button class="btn btn-outline-primary">Create</button>
                <button type="button" id="resetBtn" onclick="resetForm()" class="btn btn-md btn-warning" style>RESET</button>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace( 'description' );

        function resetForm() {
            document.getElementById("transactionForm").reset(); // Mereset semua nilai dalam form

            // Reset CKEditor content to empty
            for (var instance in CKEDITOR.instances) {
                CKEDITOR.instances[instance].setData('');  // Reset CKEditor content
            }
        }
    </script>

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



@endif
@endsection
