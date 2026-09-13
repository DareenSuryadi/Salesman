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
        <h4>Foto Fasilitas</h4>
        <div class="row">
            @foreach ($product->fasilitas as $fasilitas)
                <div class="col-md-3 mb-3">
                    <img src="{{ asset('storage/fasilitas/' . $fasilitas->foto) }}" alt="Fasilitas" class="img-fluid rounded" style="max-height: 150px;">
                </div>
            @endforeach
            @if ($product->fasilitas->isEmpty())
                <p>Tidak ada foto fasilitas.</p>
            @endif
        </div>
        @if ($product->video_link)
    <div class="mb-3">
        <h4>Video</h4>
        <div class="ratio ratio-16x9">
            <iframe src="{{ $product->embed_video_link }}" title="Video Produk" allowfullscreen></iframe>
        </div>
    </div>
@endif


    </div>
</div>
@endsection
