<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show Transaction</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>

<body style="background: lightgray">

<div class="container mt-5 mb-5">
    <div class="row">
        <h3>Show Transaction</h3>
        
        

        <div class="col-md-8">
            <div class="card border-0 shadow-sm rounded">
                <div class="card-body">
                
                    <h3>{{ $transaksis->title }}</h3>
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
                   
                    <hr>
                    <!-- Stock Info -->
                    <p>Stock : {{ $transaksis->stock }}</p>
                    
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
</body>
</html>