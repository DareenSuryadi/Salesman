@extends('admin.layouts.master')

@section('content')
@if (Auth::user()->role == 'admin')
<h1 class="h3 mb-2 text-gray-800">Supplier Tables</h1>

@if(Session::has('success'))
    <div class="card mb-4 py-3 border-left-primary">
        <div class="card-body">
            {{Session::get('success')}}
        </div>
    </div>
@endif
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">DataTables supplier
        <span class="float-right">
            <a href="{{route('suppliers.create')}}">
                <button class="btn btn-outline-secondary">Add Supplier</button>
            </a>
        </span>
        </h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th scope="col">Nama Supplier</th>
                        <th scope="col">Nama Kota Supplier</th>
                        <th scope="col">Nama Negara Supplier</th>
                        <th scope="col">Nama Provinsi Supplier</th>
                        <th scope="col">Kode Pos</th>
                        <th scope="col">Phone Supplier</th>
                        <th scope="col">Nama PIC</th>
                        <th scope="col">Phone PIC</th>
                        <th scope="col" style="width: 20%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($suppliers as $supplier)
                        <tr>
                            <td>{{ $supplier->supplier_name }}</td>
                            <td>{{ $supplier->nama_kota_supp }}</td>
                            <td>{{ $supplier->nama_negara_supp }}</td>
                            <td>{{ $supplier->nama_provinsi_supp }}</td>
                            <td>{{ $supplier->kode_pos }}</td>
                            <td>{{ $supplier->phone_supp }}</td>
                            <td>{{ $supplier->pic_name }}</td>
                            <td>{{ $supplier->phone_pic }}</td>
                            <td class="text-center">
                                <a href="{{route('suppliers.show', [$supplier->id])}}">
                                    <button class="btn btn-primary">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </a>
                                <a href="{{route('suppliers.edit', [$supplier->id])}}">
                                    <button class="btn btn-success">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                </a>
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal{{$supplier->id}}">
                                    <i class="fas fa-trash"></i>
                                </button>

                                <div class="modal fade" id="exampleModal{{$supplier->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <form action="{{route('suppliers.destroy',[$supplier->id])}}" method="post">
                                        @csrf
                                        {{method_field('DELETE')}}
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Hapus Supplier</h5>
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
                        Data supplier belum Tersedia.
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