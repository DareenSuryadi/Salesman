@extends('admin.layouts.master')

@section('content')
<div class="container">
    <h2>Detail Transaksi</h2>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Transaksi ID: {{ $transaksi->id }}</h5>            
            <p><strong>Tanggal Transaksi:</strong> {{ $transaksi->tanggal_transaksi }}</p>
            <p><strong>Diskon:</strong> {{ $transaksi->diskon }}%</p>
            <p><strong>Status:</strong> {{ $transaksi->status }}</p>
        </div>
    </div>
    <br><br>
    <h3>Detail Produk</h3>
    <div class="card">
        
    <table class="table">
        <thead>
            <tr>
                <th>Nama Produk</th>
                <th>Jumlah Pembelian</th>
                <th>Harga</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($detailTransaksis as $detail)
                <tr>
                    <td>{{ $detail->title }}</td>
                    <td>{{ $detail->jumlah_pembelian }}</td>
                    <td>{{ "Rp " . number_format($detail->price * $detail->jumlah_pembelian - $detail->price * $detail->jumlah_pembelian * $detail->diskon / 100, 0, ',', '.') }}</td>
                    <td>{{ $transaksi->status}}</td>

                </tr>
            @endforeach
            </div>
    
        </tbody>
    </table>
</div>
@endsection