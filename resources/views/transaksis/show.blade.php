@extends('admin.layouts.master')

@section('content')
<h1 class="h3 mb-2 text-gray-800">Details</h1>

<div class="card shadow mb-4">
    
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Detail Transaksi</h6>
    </div>
    <div class="card-body">
        <h3>ID : {{ $transaksis->id }}</h3>
        <hr>
        <p>Nama Produk : {{ $transaksis->title }}</p>
        <hr>
        <p>Nama Kasir : {{ $transaksis->nama_kasir  }}</p>
        <hr>
        <p>Quantity: {{ $transaksis->jumlah_pembelian }}</p>
        <hr>
        <p>Discount: {{ $transaksis->diskon }}%</p>
        <hr>
        <p>Total harga : @if(isset($transaksis->price) && isset($transaksis->jumlah_pembelian) && isset($transaksis->diskon))
            @php
                // Menghitung total harga sebelum diskon
                $totalHarga = $transaksis->price * $transaksis->jumlah_pembelian;
                // Menghitung nilai diskon
                $diskon = $totalHarga * ($transaksis->diskon / 100);
                // Menghitung total setelah diskon
                $totalSetelahDiskon = $totalHarga - $diskon;
            @endphp
            {{ number_format($totalSetelahDiskon, 2) }}
        @else
            Data tidak lengkap
        @endif
        <hr>
        <p>Transaction Date: {{ $transaksis->tanggal_transaksi }}</p>
    </div>
</div>
@endsection