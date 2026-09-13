@extends('admin.layouts.master')

@section('content')
@if (Auth::user()->role == 'admin')
<h1 class="h3 mb-2 text-gray-800">Transaksi Tables</h1>

@if(Session::has('success'))
    <div class="card mb-4 py-3 border-left-primary">
        <div class="card-body">
            {{ Session::get('success') }}
        </div>
    </div>
@endif

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">DataTables Transaksi
        <span class="float-right">
            <a href="{{ route('transaksis.create') }}">
                <button class="btn btn-outline-secondary">Add Transaksi</button>
            </a>
        </span>
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
                        <th scope="col">Status Transaksi</th>
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
                                $diskon = $totalHarga * ($detail->diskon / 100);
                                $totalSetelahDiskon = $totalHarga - $diskon;
                                $totalHargaTransaksi += $totalSetelahDiskon;
                            }

                            $statusText = match ($transaksi->status) {
                                'Unpaid' => 'Belum Bayar',
                                'Proses' => 'Menunggu Approval Admin',
                                'Done' => 'Selesai',
                                default => $transaksi->status,
                            };
                        @endphp

                        @foreach ($transaksi->details as $index => $detail)
                            <tr style="text-align : center; ">
                                @if ($index === 0) <!-- Hanya tampilkan informasi transaksi untuk detail pertama -->
                                    <td >{{ $detail->title }}</td>
                                    <td>{{ $detail->jumlah_pembelian }}</td>
                                    <td rowspan="{{ count($transaksi->details) }}">{{ $transaksi->tanggal_transaksi }}</td>
                                    <td rowspan="{{ count($transaksi->details) }}">{{ $transaksi->diskon }}%</td>
                                    <td rowspan="{{ count($transaksi->details) }}"class="text-center">{{ number_format($totalHargaTransaksi, 2) }}</td>
                                    <td rowspan="{{ count($transaksi->details) }}">{{ $statusText }}</td>
                                    <td rowspan="{{ count($transaksi->details) }}" class="text-center">
                                        <a href="{{ route('transaksis.show', [$transaksi->id]) }}">
                                            <button class="btn btn-primary">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </a>
                                        <a href="{{ route('transaksis.edit', [$transaksi->id]) }}">
                                            <button class="btn btn-success">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                        </a>
                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal{{$transaksi->id}}">
                                            <i class="fas fa-trash"></i>
                                        </button>

                                        <div class="modal fade" id="exampleModal{{$transaksi->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <form action="{{ route('transaksis.destroy', [$transaksi->id]) }}" method="post">
                                                    @csrf
                                                    {{ method_field('DELETE') }}
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Hapus Transaksi</h5>
                                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">x</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Apakah Anda Yakin ?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-outline-danger">Delete</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
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

@elseif (Auth::user()->role == 'customer')
<h1 class="h3 mb-2 text-gray-800">Transaksi Tables</h1>

@if(Session::has('success'))
    <div class="card mb-4 py-3 border-left-primary">
        <div class="card-body">
            {{ Session::get('success') }}
        </div>
    </div>
@endif

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">DataTables Transaksi</h6>
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
                        <th scope="col"> Status</th>
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

                            $statusText = match ($transaksi->status) {
                                'Unpaid' => 'Belum Bayar',
                                'Proses' => 'Menunggu Approval Admin',
                                'Done' => 'Selesai',
                                default => $transaksi->status,
                            };
                        @endphp

                        @foreach ($transaksi->details as $index => $detail)
                            <tr style="text-align : center; ">
                                @if ($index === 0) <!-- Hanya tampilkan informasi transaksi untuk detail pertama -->
                                    <td >{{ $detail->title }}</td>
                                    <td>{{ $detail->jumlah_pembelian }}</td>
                                    <td rowspan="{{ count($transaksi->details) }}">{{ $transaksi->tanggal_transaksi }}</td>
                                    <td rowspan="{{ count($transaksi->details) }}">{{ $transaksi->diskon }}%</td>
                                    <td rowspan="{{ count($transaksi->details) }}"class="text-center">{{ number_format($totalHargaTransaksi, 2) }}</td>
                                    <td rowspan="{{ count($transaksi->details) }}">{{ $statusText }}</td>
                                    <td rowspan="{{ count($transaksi->details) }}" class="text-center">
                                        <a href="{{ route('transaksis.show', [$transaksi->id]) }}">
                                            <button class="btn btn-primary">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </a>
                                        @if ($transaksi->status == 'Done')
                                            @if ($transaksi->ulasan)
                                                <a href="{{ route('ulasan.show', [$transaksi->id]) }}">
                                                    <button class="btn btn-info">
                                                        Lihat Review
                                                    </button>
                                                </a>
                                            @else
                                                <a href="{{ route('ulasan.create', [$transaksi->id]) }}">
                                                    <button class="btn btn-warning">
                                                        Review
                                                    </button>
                                                </a>
                                            @endif
                                        @endif
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

@endif
@endsection