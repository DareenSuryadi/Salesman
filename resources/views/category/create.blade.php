@extends('admin.layouts.master')

@section('content')
<h1 class="h3 mb-2 text-gray-800">Add Form</h1>

@if(Session::has('success'))
    <div class="card mb-4 py-3 border-left-primary">
        <div class="card-body">
            {{Session::get('success')}}
        </div>
    </div>
@endif
<div class="card shadow mb-4">
    
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Add Category</h6>
    </div>
    <div class="card-body">
        <form action="{{route('category.store')}}" method="post" enctype="multipart/form-data">
        @csrf
            <div class="form-group">
                <label for="product_category_name">Nama Category</label>
                <input type="text" class="form-control form-control-user @error('product_category_name') is-invalid @enderror" id="product_category_name"
                placeholder="Masukkan nama category product" name="product_category_name" required autocomplete="product_category_name">

                @error('product_category_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <button class="btn btn-outline-primary">Create</button>
            </div>
        </form>
    </div>
</div>
@endsection
