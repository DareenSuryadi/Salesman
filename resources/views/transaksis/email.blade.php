<html>
<body style="background-color:#f3f2ec;">
<br>  
<center><h1 style="color:black"> K-LLECTION </h1></center>

<h2 style="color:black; margin-left: 10px; margin-right : 10px;"; >Detail Transaksi : </h2>
<table border="1" cellspacing="0" cellpadding="5" style="width: 100%; border: 1px solid #ccc; ">
    <p style="color:black; "><strong>Transaksi ID:</strong> {{ $transaksi->id }}</p><hr>
    <p style="color:black; "><strong>Tanggal Transaksi:</strong> {{ $transaksi->tanggal_transaksi }}</p><hr>
    <p style="color:black;"><strong>Diskon:</strong> {{ $transaksi->diskon }}%</p><hr>
    <p style="color:black; "><strong>Status:</strong> {{ $transaksi->status }}</p>
</table>
    <h2 style="color:black; margin-left: 10px; margin-right : 10px; ">Detail Produk : </h2>
    <table border="1" cellspacing="0" cellpadding="5" style="width: 100%; border: 1px solid #ccc; ">
        <thead>
            <tr style="color:black">
                <th>Nama Produk</th>
                <th>Jumlah Pembelian</th>
                <th>Harga</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody style="color:black">
            @foreach ($detailTransaksis as $detail)
                <tr>
                    <td>{{ $detail->title }}</td>
                    <td>{{ $detail->jumlah_pembelian }}</td>
                    <td>Rp {{ number_format($detail->price * $detail->jumlah_pembelian - $detail->price * $detail->jumlah_pembelian * $transaksi->diskon / 100, 2) }}</td>
                    <td>{{ $transaksi->status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <br>
    <center>
    <img src="https://www.shutterstock.com/image-vector/3d-editable-text-effect-kpop-260nw-2254665185.jpg">
    </center>
</body>
</html>