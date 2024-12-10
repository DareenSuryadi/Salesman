@extends('admin.layouts.master')

@section('content')
<h1 class="h3 mb-2 text-gray-800">Edit Form</h1>

@if(Session::has('success'))
    <div class="card mb-4 py-3 border-left-primary">
        <div class="card-body">
            {{Session::get('success')}}
        </div>
    </div>
@endif
<div class="card shadow mb-4">
    
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Edit Product</h6>
    </div>
    <div class="card-body">
        <form id="productForm" action="{{route('products.update', $data['product']->id)}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" class="form-control form-control-user @error('image') is-invalid @enderror" id="image" name="image">

                @error('image')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="product_category_id">Category</label>
                <select name="product_category_id" class="form-control @error('product_category_id') is-invalid @enderror">
                    <option value="">-- Select Category Product --</option>
                    @foreach ($data['categories'] as $category)
                        <option value="{{ $category->id }}" @if(old("product_category_id", $data['product']->product_category_id) == $category->id) selected @endif>{{ $category->product_category_name }}</option>
                    @endforeach
                </select>

                @error('product_category_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="id_supplier">Supplier</label>
                <select name="id_supplier" class="form-control @error('id_supplier') is-invalid @enderror">
                    <option value="">-- Select Supplier --</option>
                    @foreach ($data['suppliers_'] as $supplier)
                        <option value="{{ $supplier->id }}" @if(old("id_supplier", $data['product']->id_supplier) == $supplier->id) selected @endif>{{ $supplier->supplier_name }}</option>
                    @endforeach
                </select>

                @error('id_supplier')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control form-control-user @error('title') is-invalid @enderror" id="title"
                placeholder="Masukkan title product" value="{{ old('title', $data['product']->title) }}" name="title" required autocomplete="title">

                @error('title')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control @error('description') is-invalid @enderror" name="description" rows="5" placeholder="Masukkan description product">{{ old('description', $data['product']->description) }}</textarea>

                @error('description')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="price">Price</label>
                <input type="number" class="form-control form-control-user @error('price') is-invalid @enderror" id="price"
                placeholder="Masukkan price" value="{{ old('price', $data['product']->price) }}" name="price" required autocomplete="price">

                @error('price')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="stock">Stock</label>
                <input type="number" class="form-control form-control-user @error('stock') is-invalid @enderror" id="stock"
                placeholder="Masukkan stock" value="{{ old('stock', $data['product']->stock) }}" name="stock" required autocomplete="stock">

                @error('stock')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <button class="btn btn-outline-primary">Create</button>
                <button type="button" id="resetBtn" onclick="resetForm()" class="btn btn-md btn-warning" style>RESET</button>
            </div>
        </form>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace( 'description' );

        function resetForm() {
            document.getElementById("productForm").reset(); // Mereset semua nilai dalam form

            // Reset CKEditor content to empty
            for (var instance in CKEDITOR.instances) {
                CKEDITOR.instances[instance].setData('');  // Reset CKEditor content
            }
        }
    </script>
@endsection