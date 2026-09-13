@extends('admin.layouts.master')

@section('content')
<h1 class="h3 mb-2 text-gray-800">Edit Form</h1>

@if(Session::has('success'))
    <div class="card mb-4 py-3 border-left-primary">
        <div class="card-body">
            {{ Session::get('success') }}
        </div>
    </div>
@endif

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Edit Supplier</h6>
    </div>
    <div class="card-body">
        <form action="{{ route('suppliers.update', $supplier->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="supplier_name">Nama Supplier</label>
                <input type="text" class="form-control form-control-user @error('supplier_name') is-invalid @enderror" 
                       id="supplier_name" placeholder="Masukkan nama supplier" 
                       value="{{ old('supplier_name', $supplier->supplier_name) }}" 
                       name="supplier_name" required autocomplete="supplier_name">

                @error('supplier_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group row">
                <div class="col-md-6">
                    <label for="nama_negara_supp">Nama Negara Supplier</label>
                    <input type="text" class="form-control @error('nama_negara_supp') is-invalid @enderror" 
                           name="nama_negara_supp" placeholder="Masukkan negara supplier" 
                           value="{{ old('nama_negara_supp', $supplier->nama_negara_supp) }}">

                    @error('nama_negara_supp')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="nama_provinsi_supp">Nama Provinsi Supplier</label>
                    <input type="text" class="form-control @error('nama_provinsi_supp') is-invalid @enderror" 
                           name="nama_provinsi_supp" placeholder="Masukkan provinsi supplier" 
                           value="{{ old('nama_provinsi_supp', $supplier->nama_provinsi_supp) }}">

                    @error('nama_provinsi_supp')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="nama_kota_supp">Nama Kota Supplier</label>
                <input type="text" class="form-control @error('nama_kota_supp') is-invalid @enderror" 
                       name="nama_kota_supp" placeholder="Masukkan kota supplier" 
                       value="{{ old('nama_kota_supp', $supplier->nama_kota_supp) }}">

                @error('nama_kota_supp')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="kode_pos">Kode Pos</label>
                <input type="number" class="form-control @error('kode_pos') is-invalid @enderror" 
                       name="kode_pos" placeholder="Masukkan kode pos" 
                       value="{{ old('kode_pos', $supplier->kode_pos) }}">

                @error('kode_pos')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="phone_supp">Phone Supplier</label>
                <input type="number" class="form-control form-control-user @error('phone_supp') is-invalid @enderror" 
                       id="phone_supp" placeholder="Masukkan phone supplier" 
                       name="phone_supp" required autocomplete="phone_supp" 
                       value="{{ old('phone_supp', $supplier->phone_supp) }}">

                @error('phone_supp')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="pic_name">Nama PIC</label>
                <input type="text" class="form-control form-control-user @error('pic_name') is-invalid @enderror" 
                       id="pic_name" placeholder="Masukkan nama PIC" 
                       name="pic_name" required autocomplete="pic_name" 
                       value="{{ old('pic_name', $supplier->pic_name) }}">

                @error('pic_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="phone_pic">Phone PIC</label>
                <input type="number" class="form-control form-control-user @error('phone_pic') is-invalid @enderror" 
                       id="phone_pic" placeholder="Masukkan phone PIC"
                       name="phone_pic" required autocomplete="phone_pic" 
                       value="{{ old('phone_pic', $supplier->phone_pic) }}">

                @error('phone_pic')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <button class="btn btn-outline-primary">Update</button>
            </div>
        </form>
    </div>
</div>
@endsection