@extends('admin.layouts.master')

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
        <form id="editForm" action="{{ route('transaksis.update',$transaksis['transaksi']->id) }}" method="POST" enctype ="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group mb-3">
                <label for="id_product">Product</label>
                <select class="form-control" name="id_product" id="id_product" required>
                    <option value="">-- Select Product --</option>
                    @foreach ($transaksis as $transaksi)
                        <option value="{{ $transaksi->id_product }}"
                            @if(old('id_product', $transaksi->id_product) == $transaksi->id_product) selected @endif>
                            {{ $transaksi->title }}
                        </option>
                    @endforeach
                </select>
                @error('id_product')
                    <div class="alert alert-danger mt-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Total Produk-->
            <div class="form-group mb-3">
                <label class="font-weight-bold">Jumlah Pembelian</label>
                <input type="number" class="form-control @error('jumlah_pembelian') is-invalid @enderror" name="jumlah_pembelian" value="{{ old('jumlah_pembelian', $transaksi->jumlah_pembelian) }}" required>
                @error('jumlah_pembelian')
                    <div class="alert alert-danger mt-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="nama_kasir">Nama Kasir</label>
                <input type="text" class="form-control form-control-user @error('nama_kasir') is-invalid @enderror" id="nama_kasir"
                placeholder="Masukkan nama kasir" value="{{ old('nama_kasir', $transaksi->nama_kasir) }}" name="nama_kasir" required autocomplete="nama_kasir">

                @error('nama_kasir')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="tanggal_transaksi">Tanggal Transaksi</label>
                <input type="date" class="form-control form-control-user @error('tanggal_transaksi') is-invalid @enderror" id="tanggal_transaksi"
                placeholder="Masukkan tanggal transaksi" value="{{ old('tanggal_transaksi', $transaksi->tanggal_transaksi) }}" name="tanggal_transaksi" required autocomplete="tanggal_transaksi">

                @error('tanggal_transaksi')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="diskon">Diskon</label>
                <input type="number" class="form-control form-control-user @error('diskon') is-invalid @enderror" id="diskon"
                placeholder="Masukkan diskon" value="{{ old('diskon', $transaksi->diskon) }}" name="diskon" required autocomplete="diskon">

                @error('diskon')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <button class="btn btn-outline-primary">Update</button>
            </div>
        </form>
    </div>
</div>
@endsection
