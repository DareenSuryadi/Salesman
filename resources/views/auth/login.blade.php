<title>Login</title>
@extends('layouts.frontend.master')

@section('content')
<div class="container" style="margin-top:50px;">
    <div class="row justify-content-center">
        <div class="col-xl-5 col-lg-12 col-md-9">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0" style="background-image: url(https://i.pinimg.com/736x/42/20/0a/42200aac44c406f9e6e75260498c34fe.jpg); background-size: cover;   ">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="p-5">
                                <div class="btn-wrap">
									<a href="{{ route('index') }}" class="btn btn-outline-accent btn-accent-arrow" style="color: black;">Back</a>
								</div>
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                </div>
                                <form class="user"method="POST" action="{{ route('login') }}">
                                @csrf
                                    <div class="form-group" >
                                        <input type="email" class="form-control form-control-user @error('email') is-invalid @enderror"
                                            id="email" aria-describedby="emailHelp"
                                            placeholder="Enter Email Address..." name="email" value="{{ old('email') }}" required autocomplete="email" autofocus >
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user @error('password') is-invalid @enderror"
                                            id="password" placeholder="Password" name="password" required autocomplete="current-password">
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox small">
                                            <input type="checkbox" class="custom-control-input" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="remember" style="color: black;">{{ __('Remember Me') }}</label>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-outline-danger btn-user btn-block"  >
                                        {{ __('Login') }}
                                    </button>
                                </form>
                                <hr>
                                
                                <div class="text-center">
                                    <a class="small" href="{{ route('register') }}">Create an Account!</a>
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