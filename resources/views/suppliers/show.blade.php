@extends('admin.layouts.master')

@section('content')
<h1 class="h3 mb-2 text-gray-800">Details</h1>

<div class="card shadow mb-4">
    
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Detail Supplier</h6>
    </div>
    <div class="card-body">
        <h3>{{ $supplier->supplier_name }}</h3>
        <hr>
        <p>Nama Negara Supplier : {{ $supplier->nama_negara_supp }}</p>
        <hr>
        <p>Nama Provinsi Supplier : {{ $supplier->nama_provinsi_supp }}</p>
        <hr>
        <p>Nama Kota Supplier : {{ $supplier->nama_kota_supp }}</p>
        <hr>
        <p>Kode Pos : {{ $supplier->kode_pos }}</p>
        <hr>
        <p>Phone Supplier : {{ $supplier->phone_supp }}</p>
        <hr>
        <p>Nama PIC : {{ $supplier->pic_name }}</p>
        <hr>
        <p>Phone : {{ $supplier->phone_pic }}</p>
    </div>
</div>
@endsection