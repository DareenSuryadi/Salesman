@extends('admin.layouts.master')
@if (Auth::user()->role == 'admin')
@section('content')
<h1 class="h3 mb-2 text-gray-800">Edit Form</h1>

@if(Session::has('success'))
    <div class="card mb-4 py-3 border-left-primary">
        <div class="card-body">
            {{Session::get('success')}}
        </div>
    </div>
@endif
<div class="card shadow mb-4">
    
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Edit Transaksi</h6>
    </div>
    <div class="card-body">
        <form id="transactionForm" action="{{ route('transaksis.update',$transaksi->id) }}" method="POST" enctype ="multipart/form-data">
            @csrf
            @method('PUT')

            <div id="productList">
                @foreach ($detailTransaksis as $detail)
                    <div class="form-group mb-3">
                        <label for="id_product">Product</label>
                        <select class="form-control" name="products[{{ $loop->index }}][id_product]" required>
                            @foreach ($products as $product)
                                <option value="{{ $product->id }}" {{ $product->id == $detail->id_product ? 'selected' : '' }}>
                                    {{ $product->title }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label class="font-weight-bold">Jumlah Pembelian</label>
                        <input type="number" class="form-control" name="products[{{ $loop->index }}][jumlah_pembelian]" value="{{ $detail->jumlah_pembelian }}" required>
                    </div>
                @endforeach
            </div>

            <button type="button" class="btn btn-primary" id="addProductBtn">Tambah Produk</button>
            <br><br>        
            <div class="form-group">
                <label for="tanggal_transaksi">Tanggal Transaksi</label>
                <input type="date" class="form-control form-control-user @error('tanggal_transaksi') is-invalid @enderror" id="tanggal_transaksi"
                placeholder="Masukkan tanggal transaksi" value="{{ old('tanggal_transaksi', $transaksi->tanggal_transaksi) }}" name="tanggal_transaksi" required>

                @error('tanggal_transaksi')
                    <span class="invalid-feedback " role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="diskon">Diskon</label>
                <input type="number" class="form-control form-control-user @error('diskon') is-invalid @enderror" id="diskon"
                placeholder="Masukkan diskon" value="{{ old('diskon', $transaksi->diskon) }}" name="diskon" required>

                @error('diskon')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="status">Status</label>
                <select name="status" class="form-control @error('status') is-invalid @enderror">
                    <option value="Done" {{ $transaksi->status == 'Done' ? 'selected' : '' }}>Done</option>
                    <option value="Proses" {{ $transaksi->status == 'Proses' ? 'selected' : '' }}>Proses</option>
                    <option value="Unpaid" {{ $transaksi->status == 'Unpaid' ? 'selected' : '' }}>Unpaid</option>
                </select>
                @error('status')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <button class="btn btn-outline-primary">Update</button>
                <button type="button" id="resetBtn" onclick="resetForm()" class="btn btn-md btn-warning">RESET</button>
            </div>
        </form>
    </div>
</div>

@elseif (Auth::user()->role == 'customer')
@section('content')
<h1 class="h3 mb-2 text-gray-800">Edit Form</h1>

@if(Session::has('success'))
    <div class="card mb-4 py-3 border-left-primary">
        <div class="card-body">
            {{Session::get('success')}}
        </div>
    </div>
@endif
<div class="card shadow mb-4">
    
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Edit Transaksi</h6>
    </div>
    <div class="card-body">
        <form id="transactionForm" action="{{ route('transaksis.update',$transaksi->id) }}" method="POST" enctype ="multipart/form-data">
            @csrf
            @method('PUT')

            <div id="productList">
                @foreach ($detailTransaksis as $detail)
                    <div class="form-group mb-3">
                        <label for="id_product">Product</label>
                        <select class="form-control" name="products[{{ $loop->index }}][id_product]" disabled>
                            @foreach ($products as $product)
                                <option value="{{ $product->id }}" {{ $product->id == $detail->id_product ? 'selected' : '' }}>
                                    {{ $product->title }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label class="font-weight-bold">Jumlah Pembelian</label>
                        <input type="number" class="form-control" name="products[{{ $loop->index }}][jumlah_pembelian]" value="{{ $detail->jumlah_pembelian }}" disabled>
                    </div>
                @endforeach
            </div>

            <!-- <button type="button" class="btn btn-primary" id="addProductBtn">Tambah Produk</button>
            <br><br>         -->
            <div class="form-group">
                <label for="tanggal_transaksi">Tanggal Pembayaran</label>
                <input type="date" class="form-control form-control-user @error('tanggal_transaksi') is-invalid @enderror" id="tanggal_transaksi"
                placeholder="Masukkan tanggal transaksi" value="{{ old('tanggal_transaksi', $transaksi->tanggal_transaksi) }}" name="tanggal_transaksi" required>

                @error('tanggal_transaksi')
                    <span class="invalid-feedback " role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="bukti_transaksi">Bukti Pembayaran</label>
                <input type="file" name="bukti_transaksi" class="form-control" accept="image/*">
                @if($transaksi->bukti_transaksi)
                    <img src="{{ Storage::url($transaksi->bukti_transaksi) }}" alt="Bukti Transaksi" style="max-width: 200px; margin-top: 10px;">
                @endif
            </div>

            <div class="form-group">
                <button class="btn btn-outline-primary">Update</button>
                <button type="button" id="resetBtn" onclick="resetForm()" class="btn btn-md btn-warning">RESET</button>
            </div>
        </form>
    </div>
</div>

<script>
    document.getElementById('addProductBtn').addEventListener('click', function() {
        const productList = document.getElementById('productList');
        const index = productList.children.length;

        const newProductHTML = `
            <div class="form-group mb-3">
                <label for="id_product">Product</label>
                <select class="form-control" name="products[${index}][id_product]" required>
                    @foreach ($products as $product)
                        <option value="{{ $product->id }}">{{ $product->title }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group mb-3">
                <label class="font-weight-bold">Jumlah Pembelian</label>
                <input type="number" class="form-control" name="products[${index}][jumlah_pembelian]" required>
            </div>
        `;

        productList.insertAdjacentHTML('beforeend', newProductHTML);
    });

    function resetForm() {
        document.getElementById("transactionForm").reset();
        document.getElementById('productList').innerHTML = ''; // Reset product list
    }
</script>
@endif
@endsection