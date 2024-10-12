<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title> Transaksi Penjualan Data Product</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body style="background-image: url(https://blog-asset.jakmall.com/2023/12/TWICEJKT23_Poster4x5-1448x2048.png)">
    
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-12">
                    <div>
                        <h3 class="text-center my-4" style="color: #FEE6A8"> Katherin Fanpage Database</h3>
                        <hr>
                    </div>
                    <div class="card border-0 shadow-sm rounded">
                        <div class="card-body">
                            <a href="{{ route('transaksis.create')}}" class="btn btn-md btn-success mb-3">ADD TRANSACTION</a>
                        </div>
          
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">ID PRODUK</th>
                        <th scope="col">JUMLAH PEMBELIAN</th>
                        <th scope="col">NAMA KASIR</th>
                        <th scope="col">NAMA PRODUK</th>
                        <th scope="col">KATEGORI PRODUK</th>
                        <th scope="col">TANGGAL TRANSAKSI</th>
                        <th scope="col">DISKON</th>
                        <th scope="col">HARGA</th>
                        <th scope="col">TOTAL HARGA</th>
                        <th scope="col" style="width: 20%">ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($transaksis as $transaksi)
                        <tr>
                            <td class="text-center">{{ $transaksi->id_product }}</td>
                            <td class="text-center">{{ $transaksi->jumlah_pembelian }}</td>
                            <td class="text-center">{{ $transaksi->nama_kasir }}</td>
                            <td class="text-center">
                                {{ $transaksi->product ? $transaksi->product->title : 'Produk tidak ditemukan' }}
                            </td>
                            <td class="text-center">
                                {{ $transaksi->product ? $transaksi->product->category : 'Kategori tidak ditemukan' }}
                            </td>
                            <td class="text-center">{{ $transaksi->tanggal_transaksi }}</td>
                            <td class="text-center">{{ $transaksi->diskon }}%</td>
                            <td class="text-center">
                                {{ $transaksi->product ? $transaksi->product->price: 'Harga tidak tersedia' }}
                            </td>
                            <td class="text-center">
                                @if($transaksi->product)
                                    @php
                                        // Menghitung total harga sebelum diskon
                                        $totalHarga = $transaksi->product->price * $transaksi->jumlah_pembelian;
                                        // Menghitung nilai diskon
                                        $diskon = $totalHarga * ($transaksi->diskon / 100);
                                        // Menghitung total setelah diskon
                                        $totalSetelahDiskon = $totalHarga - $diskon;
                                    @endphp
                                    {{ number_format($totalSetelahDiskon, 2) }}
                                @else
                                    Harga tidak tersedia
                                @endif
                            </td>
                            <td class="text-center">
                                <form onsubmit="return confirm('Yakin ingin menghapus transaksi ini?');" action="{{ route('transaksis.destroy', $transaksi->id) }}" method="POST">
                                    <a href="{{ route('transaksis.show', $transaksi->id)}}" class="btn btn-outline-primary">SHOW</a>
                                    <a href="{{ route('transaksis.edit', $transaksi->id)}}" class="btn btn-outline-primary">EDIT</a>
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-outline-danger">HAPUS</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">Data transaksi belum tersedia.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            {{-- Pagination --}}
            {{ $transaksis->links() }}
                    </div>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
        <script>
            // message with sweetalert
            @if(session('success'))
                swal.fire({
                    icon:"success",
                    title:"CONGRATS ANDA BERHASIL",
                    text:"{{session('success')}}",
                    showConfirmButton: false,
                    timer: 2000
                });
            @elseif(session('error'))
                swal.fire({
                    icon:"error",
                    title:"MAAF ANDA GAGAL",
                    text:"{{session('error')}}",
                    showConfirmButton: false,
                    timer: 2000
                });
            @endif
        </script>
    </body>
</html>
