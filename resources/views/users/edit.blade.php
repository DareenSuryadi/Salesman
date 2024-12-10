@extends('admin.layouts.master')

@section('content')
<h1 class="h3 mb-2 text-gray-800">Edit Form</h1>

@if(Session::has('message'))
    <div class="card mb-4 py-3 border-left-primary">
        <div class="card-body">
            {{Session::get('message')}}
        </div>
    </div>
@endif
<div class="card shadow mb-4">
    
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Edit User</h6>
    </div>
    <div class="card-body">
        <form action="{{route('users.update',[$users->id])}}" method="post">
        @csrf
        {{method_field('PUT')}}
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control form-control-user @error('name') is-invalid @enderror" id="name"
                placeholder="Your Name" name="name" required autocomplete="name" autofocus value="{{$users->name}}">

                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control form-control-user @error('email') is-invalid @enderror" id="email"
                placeholder="Email Address" name="email" required autocomplete="email" value="{{$users->email}}">

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control form-control-user @error('password') is-invalid @enderror"
                id="password" placeholder="Password (Leave blank if not change)" name="password" autocomplete="new-password" readonly>

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="role">Role</label>
                <select name="role" class="form-control @error('role') is-invalid @enderror">
                    <option value="{{$users->role}}">{{$users->role}}</option>
                    <option value="admin">Admin</option>
                    <option value="customer">Customer</option>

                    @error('role')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </select>
            </div>

            <div class="form-group">
                <label for="no_telp">Handphone</label>
                <input type="number" class="form-control form-control-user @error('no_telp') is-invalid @enderror" id="no_telp"
                placeholder="Handphone" name="no_telp" required autocomplete="no_telp" autofocus value="{{$users->no_telp}}">

                @error('no_telp')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="alamat">Address</label>
                <input type="text" class="form-control form-control-user @error('alamat') is-invalid @enderror" id="alamat"
                placeholder="Your Address" name="alamat" required autocomplete="alamat" autofocus value="{{$users->alamat}}">

                @error('alamat')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="nama_provinsi">Provinsi</label>
                <input type="text" class="form-control form-control-user @error('nama_provinsi') is-invalid @enderror" id="nama_provinsi"
                placeholder="Your Province" name="nama_provinsi" required autocomplete="nama_provinsi" autofocus value="{{$users->nama_provinsi}}">

                @error('nama_provinsi')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="nama_kota">Kota</label>
                <input type="text" class="form-control form-control-user @error('nama_kota') is-invalid @enderror" id="nama_kota"
                placeholder="Your City" name="nama_kota" required autocomplete="nama_kota" autofocus value="{{$users->nama_kota}}">

                @error('nama_kota')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="nama_kota">Kode Pos</label>
                <input type="number" class="form-control form-control-user @error('kode_pos') is-invalid @enderror" id="kode_pos"
                placeholder="Pos Code" name="kode_pos" required autocomplete="kode_pos" autofocus value="{{$users->kode_pos}}">

                @error('kode_pos')
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