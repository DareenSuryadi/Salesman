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
        <p>Address Supplier : {{ $supplier->address_supp }}</p>
        <hr>
        <p>Phone Supplier : {{ $supplier->phone_supp }}</p>
        <hr>
        <p>Nama PIC : {{ $supplier->pic_name }}</p>
        <hr>
        <p>Address : {{ $supplier->address }}</p>
        <hr>
        <p>Phone : {{ $supplier->phone }}</p>
    </div>
</div>
@endsection