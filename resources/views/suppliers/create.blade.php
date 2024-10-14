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
        <h6 class="m-0 font-weight-bold text-primary">Add Supplier</h6>
    </div>
    <div class="card-body">
        <form action="{{route('suppliers.store')}}" method="post" enctype="multipart/form-data">
        @csrf
            <div class="form-group">
                <label for="supplier_name">Nama Supplier</label>
                <input type="text" class="form-control form-control-user @error('supplier_name') is-invalid @enderror" id="supplier_name"
                placeholder="Masukkan nama supplier" name="supplier_name" required autocomplete="supplier_name">

                @error('supplier_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="address_supp">Address Supplier</label>
                <textarea class="form-control @error('address_supp') is-invalid @enderror" name="address_supp" rows="5" placeholder="Masukkan address supplier"></textarea>

                @error('address_supp')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="phone_supp">Phone Supplier</label>
                <input type="number" class="form-control form-control-user @error('phone_supp') is-invalid @enderror" id="phone_supp"
                placeholder="Masukkan phone supplier" name="phone_supp" required autocomplete="phone_supp">

                @error('phone_supp')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="pic_name">Nama PIC</label>
                <input type="text" class="form-control form-control-user @error('pic_name') is-invalid @enderror" id="pic_name"
                placeholder="Masukkan nama pic" name="pic_name" required autocomplete="pic_name">

                @error('pic_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="address">Address</label>
                <textarea class="form-control @error('address') is-invalid @enderror" name="address" rows="5" placeholder="Masukkan address"></textarea>

                @error('address')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="number" class="form-control form-control-user @error('phone') is-invalid @enderror" id="phone"
                placeholder="Masukkan phone" name="phone" required autocomplete="phone">

                @error('phone')
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
