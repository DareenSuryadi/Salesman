<title>Register</title>
@extends('layouts.frontend.master')

@section('content')
<div class="container">

<div class="row justify-content-center">
    <div class="col-xl-5 col-lg-12 col-md-9">
        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0" style="background-image: url(https://i.pinimg.com/736x/42/20/0a/42200aac44c406f9e6e75260498c34fe.jpg); background-size: cover; ">
                <div class="row">
                    <div class="col-lg-14">
                        <div class="p-5">
                            <div class="btn-wrap">
                                <a href="{{ route('index') }}" class="btn btn-outline-accent btn-accent-arrow" style="color: black;">Back</a>
                            </div>
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                            </div>
                            <form class="user" method="POST" action="{{ route('register') }}">
                            @csrf
                                <div class="form-group" >
                                    <input  type="text" class="form-control form-control-user @error('name') is-invalid @enderror" id="name"
                                        placeholder="Your Name" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-user @error('email') is-invalid @enderror" id="email"
                                        placeholder="Email Address" name="email" value="{{ old('email') }}" required autocomplete="email">
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user @error('alamat') is-invalid @enderror"
                                            id="alamat" placeholder="Your Address" name="alamat" required autocomplete="new-password">
                                            @error('alamat')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-user @error('nama_provinsi') is-invalid @enderror"
                                            id="nama_provinsi" placeholder="Your Province" name="nama_provinsi" required autocomplete="new-password">
                                            @error('nama_provinsi')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror</div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user @error('nama_kota') is-invalid @enderror"
                                            id="password" placeholder="Your City" name="nama_kota" required autocomplete="new-password">
                                            @error('nama_kota')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="number" class="form-control form-control-user @error('kode_pos') is-invalid @enderror"
                                            id="kode_pos" placeholder="Your Pascal Code" name="kode_pos" required autocomplete="new-password" >
                                            @error('kode_pos')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror</div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" class="form-control form-control-user @error('password') is-invalid @enderror"
                                            id="password" placeholder="Password" name="password" required autocomplete="new-password">
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" class="form-control form-control-user"
                                            id="password-confirm" placeholder="Confirm Password" name="password_confirmation" required autocomplete="new-password">
                                    </div>
                                </div>
                                
                                <button type="submit" class="btn btn-outline-danger btn-user btn-block">
                                    {{ __('Register') }}
                                </button>
                                <hr>
                            <div class="text-center">
                                <a class="small" href="{{route('login')}}">Already have an account? Login!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection