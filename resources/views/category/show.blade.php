@extends('admin.layouts.master')

@section('content')
<h1 class="h3 mb-2 text-gray-800">Details</h1>

@if(Session::has('message'))
    <div class="card mb-4 py-3 border-left-primary">
        <div class="card-body">
            {{Session::get('message')}}
        </div>
    </div>
@endif
<div class="card shadow mb-4">
    
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Detail Category</h6>
    </div>
    <div class="card-body">
        <h3>{{ $category->product_category_name }}</h3>
        <hr/>
        <p>Tanggal Dibuat : {{ $category->created_at }}</p>
        <hr/>
        <p>Tanggal Diubah : {{ $category->updated_at }}</p>
    </div>
</div>
@endsection
