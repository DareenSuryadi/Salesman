@extends('admin.layouts.master')

@section('content')
@if (Auth::user()->role == 'admin')
<h1 class="h3 mb-2 text-gray-800">User Tables</h1>

@if(Session::has('message'))
    <div class="card mb-4 py-3 border-left-primary">
        <div class="card-body">
            {{Session::get('message')}}
        </div>
    </div>
@endif
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">DataTables User
        <span class="float-right">
            <a href="{{route('users.create')}}">
                <button class="btn btn-outline-secondary">Add User</button>
            </a>
        </span>
        </h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Email</th>
                    <th scope="col">Role</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                    @if(count($users)>0)
                    @foreach($users as $key=>$user)
                    <tr>
                        <th scope="row">{{$key+1}}</th>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->role}}</td>
                        <td>
                            <a href="{{route('users.edit', [$user->id])}}">
                                <button class="btn btn-success">
                                    <i class="fas fa-edit"></i>
                                </button>
                            </a>
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal{{$user->id}}">
                                <i class="fas fa-trash"></i>
                            </button>
                            <div class="modal fade" id="exampleModal{{$user->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <form action="{{route('users.destroy',[$user->id])}}" method="post">
                                    @csrf
                                    {{method_field('DELETE')}}
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Hapus User</h5>
                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Apakah Anda Yakin ?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-outline-danger">Delete</button>
                                </div>
                                </div>
                                </form>
                            </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endif
@endsection
