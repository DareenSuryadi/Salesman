@extends('admin.layouts.master')

@section('content')
@if (Auth::user()->role == 'admin')
<h1 class="h3 mb-2 text-gray-800">Category Tables</h1>

@if(Session::has('success'))
    <div class="card mb-4 py-3 border-left-primary">
        <div class="card-body">
            {{Session::get('success')}}
        </div>
    </div>
@endif
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">DataTables Category
        <span class="float-right">
            <a href="{{route('category.create')}}">
                <button class="btn btn-outline-secondary">Add Category</button>
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
                        <th scope="col">Nama Category</th>
                        <th scope="col">Tanggal Dibuat</th>
                        <th scope="col">Tanggal Diubah</th>
                        <th scope="col" style="width: 20%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($category)>0)
                    @forelse ($category as $key=>$category)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{ $category->product_category_name }}</td>
                            <td>{{ $category->created_at }}</td>
                            <td>{{ $category->updated_at }}</td>
                            <td class="text-center">
                                <a href="{{route('category.show', [$category->id])}}">
                                    <button class="btn btn-primary">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </a>
                                <a href="{{route('category.edit', [$category->id])}}">
                                    <button class="btn btn-success">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                </a>
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal{{$category->id}}">
                                    <i class="fas fa-trash"></i>
                                </button>

                                <div class="modal fade" id="exampleModal{{$category->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <form action="{{route('category.destroy',[$category->id])}}" method="post">
                                        @csrf
                                        {{method_field('DELETE')}}
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Hapus Category</h5>
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
                    @empty
                    <div class="alert alert-danger">
                        Data category belum Tersedia.
                    </div>
                    @endforelse
                    @endif
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endif
@endsection
