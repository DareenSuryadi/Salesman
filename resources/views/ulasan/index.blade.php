@extends('admin.layouts.master')

@section('content')
<h1 class="h3 mb-2 text-gray-800">Ulasan Tables</h1>

@if(Session::has('success'))
    <div class="card mb-4 py-3 border-left-primary">
        <div class="card-body">
            {{ Session::get('success') }}
        </div>
    </div>
@endif

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">DataTables Ulasan

        </h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th scope="col">Nama Produk</th>
                        <th scope="col">Jumlah Pembelian</th>
                        <th scope="col">Tanggal Transaksi</th>
                        <th scope="col">Diskon</th>
                        <th scope="col">Total Harga</th>
                        <th scope="col" style="width: 20%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($transaksis as $transaksi)
                        @php
                            // Menghitung total harga untuk semua detail produk dalam transaksi
                            $totalHargaTransaksi = 0;
                            foreach ($transaksi->details as $detail) {
                                $totalHarga = $detail->price * $detail->jumlah_pembelian;
                                $diskon = $totalHarga * ($transaksi->diskon / 100);
                                $totalSetelahDiskon = $totalHarga - $diskon;
                                $totalHargaTransaksi += $totalSetelahDiskon;
                            }
                        @endphp

                        @foreach ($transaksi->details as $index => $detail)
                            <tr style="text-align : center; ">
                                @if ($index === 0) <!-- Hanya tampilkan informasi transaksi untuk detail pertama -->
                                    <td >{{ $detail->title }}</td>
                                    <td>{{ $detail->jumlah_pembelian }}</td>
                                    <td rowspan="{{ count($transaksi->details) }}">{{ $transaksi->tanggal_transaksi }}</td>
                                    <td rowspan="{{ count($transaksi->details) }}">{{ $transaksi->diskon }}%</td>
                                    <td rowspan="{{ count($transaksi->details) }}"class="text-center">{{ number_format($totalHargaTransaksi, 2) }}</td>
                                    <td rowspan="{{ count($transaksi->details) }}" class="text-center">
										<a href="{{ $transaksi->ulasan ? route('ulasan.show', [$transaksi->id]) : route('ulasan.create', [$transaksi->id]) }}">
											<!-- Periksa apakah transaksi sudah diulas -->
											<button class="btn {{ $transaksi->ulasan ? 'btn-success' : 'btn-secondary' }}">
												<p>{{ $transaksi->ulasan ? 'Ulasan Sudah Ada' : 'Beri Ulasan' }}</p>
											</button>
										</a>
                                    </td>
                                @else
                                    <td>{{ $detail->title }}</td>
                                    <td>{{ $detail->jumlah_pembelian }}</td>
                                     <!-- Kosongkan kolom untuk detail lainnya -->
                                @endif
                            </tr>
                        @endforeach
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">
                                <div class="alert alert-danger">
                                    Data Transaksi belum Tersedia.
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection