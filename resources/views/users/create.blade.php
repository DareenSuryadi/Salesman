@extends('admin.layouts.master')

@section('content')
<h1 class="h3 mb-2 text-gray-800">Add Form</h1>

@if(Session::has('message'))
    <div class="card mb-4 py-3 border-left-primary">
        <div class="card-body">
            {{Session::get('message')}}
        </div>
    </div>
@endif
<div class="card shadow mb-4">
    
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Add User</h6>
    </div>
    <div class="card-body">
        <form action="{{route('users.store')}}" method="post">
        @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control form-control-user @error('name') is-invalid @enderror" id="name"
                placeholder="Your Name" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control form-control-user @error('email') is-invalid @enderror" id="email"
                placeholder="Email Address" name="email" value="{{ old('email') }}" required autocomplete="email">

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control form-control-user @error('password') is-invalid @enderror"
                id="password" placeholder="Password" name="password" required autocomplete="new-password">

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="role">Role</label>
                <select name="role" class="form-control @error('role') is-invalid @enderror">
                    <option value="">Choose Role</option>
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
                <button class="btn btn-outline-primary">Create</button>
            </div>
        </form>
    </div>
</div>
@endsection
