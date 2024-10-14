@extends('admin.layouts.master')

@section('content')
<h1 class="h3 mb-2 text-gray-800">Details</h1>

<div class="card shadow mb-4">
    
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Detail Product</h6>
    </div>
    <div class="card-body">
        <img src="{{ asset('/storage/images/'.$product->image) }}" class="rounded" style="width: 200px">
        <h3>{{ $product->title }}</h3>
        <code>
            <p>{!! $product->description !!}</p>
        </code>
        <hr/>
        <p>Category : {{ $product->product_category_name }}</p>
        <hr/>
        <p>Supplier : {{ $product->supplier_name }}</p>
        <hr/>
        <p>Harga : {{ "Rp " . number_format($product->price,2,',','.') }}</p>
        
        <hr/>
        <p>Stock : {{ $product->stock }}</p>
    </div>
</div>
@endsection
