@extends('admin.layouts.master')

@section('content')
@if (Auth::user()->role == 'admin')
<h1 class="h3 mb-2 text-gray-800">Transaksi Tables</h1>

@if(Session::has('success'))
    <div class="card mb-4 py-3 border-left-primary">
        <div class="card-body">
            {{Session::get('success')}}
        </div>
    </div>
@endif
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">DataTables Transaksi
        <span class="float-right">
            <a href="{{route('transaksis.create')}}">
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
                        <th scope="col">Nama Kasir</th>
                        <th scope="col">Tanggal Transaksi</th>
                        <th scope="col">Diskon</th>
                        <th scope="col">Total Harga</th>
                        <th scope="col" style="width: 20%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($transaksis as $transaksi)
                        <tr>
                            <td>{{ $transaksi->title }}</td>
                            <td>{{ $transaksi->jumlah_pembelian }}</td>
                            <td>{{ $transaksi->nama_kasir }}</td>
                            <td>{{ $transaksi->tanggal_transaksi }}</td>
                            <td>{{ $transaksi->diskon }}%</td>
                            <td class="text-center">           
                                @php
                                    // Menghitung total harga sebelum diskon
                                    $totalHarga = $transaksi->price * $transaksi->jumlah_pembelian;
                                    // Menghitung nilai diskon
                                    $diskon = $totalHarga * ($transaksi->diskon / 100);
                                    // Menghitung total setelah diskon
                                    $totalSetelahDiskon = $totalHarga - $diskon;
                                @endphp
                                {{ number_format($totalSetelahDiskon, 2) }}
                            </td>
                            <td class="text-center">
                                <a href="{{route('transaksis.show', [$transaksi->id])}}">
                                    <button class="btn btn-primary">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </a>
                                <a href="{{route('transaksis.edit', [$transaksi->id])}}">
                                    <button class="btn btn-success">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                </a>
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal{{$transaksi->id}}">
                                    <i class="fas fa-trash"></i>
                                </button>

                                <div class="modal fade" id="exampleModal{{$transaksi->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <form action="{{route('transaksis.destroy',[$transaksi->id])}}" method="post">
                                        @csrf
                                        {{method_field('DELETE')}}
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Hapus Transaksi</h5>
                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
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
                        </tr>
                    @empty
                    <div class="alert alert-danger">
                        Data Transaksi belum Tersedia.
                    </div>
                    @endforelse
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endif
@endsection
