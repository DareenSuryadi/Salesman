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
            <!-- <a href="{{ route('transaksis.create') }}">
                <button class="btn btn-outline-secondary">Add Transaksi</button>
            </a> -->
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
                                    <td rowspan="{{ count($transaksi->details) }}">{{ $transaksi->status }}</td>
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
        <h6 class="m-0 font-weight-bold text-primary">DataTables Transaksi
        <span class="float-right">
            <a href="{{ route('transaksis.create') }}">
                <!-- <button class="btn btn-outline-secondary">Add Transaksi</button> -->
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
                                        <a href="{{ route('transaksis.show', [$transaksi->id]) }}">
                                            <button class="btn btn-primary">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </a>
                                        <a href="{{ route('transaksis.edit', [$transaksi->id]) }}">
                                            <button class="btn btn-success">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cash-coin" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M11 15a4 4 0 1 0 0-8 4 4 0 0 0 0 8m5-4a5 5 0 1 1-10 0 5 5 0 0 1 10 0"/>
                                            <path d="M9.438 11.944c.047.596.518 1.06 1.363 1.116v.44h.375v-.443c.875-.061 1.386-.529 1.386-1.207 0-.618-.39-.936-1.09-1.1l-.296-.07v-1.2c.376.043.614.248.671.532h.658c-.047-.575-.54-1.024-1.329-1.073V8.5h-.375v.45c-.747.073-1.255.522-1.255 1.158 0 .562.378.92 1.007 1.066l.248.061v1.272c-.384-.058-.639-.27-.696-.563h-.668zm1.36-1.354c-.369-.085-.569-.26-.569-.522 0-.294.216-.514.572-.578v1.1zm.432.746c.449.104.655.272.655.569 0 .339-.257.571-.709.614v-1.195z"/>
                                            <path d="M1 0a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h4.083q.088-.517.258-1H3a2 2 0 0 0-2-2V3a2 2 0 0 0 2-2h10a2 2 0 0 0 2 2v3.528c.38.34.717.728 1 1.154V1a1 1 0 0 0-1-1z"/>
                                            <path d="M9.998 5.083 10 5a2 2 0 1 0-3.132 1.65 6 6 0 0 1 3.13-1.567"/>
                                            </svg> Pay</i>
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

@endif
@endsection