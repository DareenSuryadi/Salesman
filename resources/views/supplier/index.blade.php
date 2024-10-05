<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data Supplier</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-image: url(https://blog-asset.jakmall.com/2023/12/TWICEJKT23_Poster4x5-1448x2048.png)">

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div>
                <h3 class="text-center my-4" style="color: #FEE6A8">Katherin Supplier Database</h3>
                <hr>
            </div>
            <div class="card border-0 shadow-sm rounded">
                <div class="card-body">
                    <a href="{{ route('suppliers.create') }}" class="btn btn-md btn-success mb-3">ADD SUPPLIER</a>
                </div>

                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th scope="col">SUPPLIER NAME</th>
                        <th scope="col">PHONE_SUPP</th>
                        <th scope="col">ADDRESS_SUPP</th>
                        <th scope="col">PIC_NAME</th>
                        <th scope="col">PHONE</th>
                        <th scope="col">ADDRESS</th>
                        <th scope="col" style="width: 20%">ACTIONS</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse ($suppliers as $supplier)
                        <tr>
                            <td class="text-center">{{ $supplier->supplier_name }}</td>
                            <td>{{ $supplier->phone_supp }}</td>
                            <td>{{ $supplier->address_supp }}</td>
                            <td>{{ $supplier->pic_name }}</td>
                            <td>{{ $supplier->phone }}</td>
                            <td>{{ $supplier->address }}</td>
                            <td class="text-center">
                                <form onsubmit="return confirm('Are you sure?');"
                                      action="{{ route('suppliers.destroy', $supplier->id) }}" method="POST">
                                    <a href="{{ route('suppliers.show', $supplier->id) }}"
                                       class="btn btn-outline-primary">SHOW</a>
                                    <a href="{{ route('suppliers.edit', $supplier->id) }}"
                                       class="btn btn-outline-primary">EDIT</a>
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger">DELETE</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">
                                <div class="alert alert-danger">
                                    Data Supplier Belum tersedia, cobalah beberapa saat lagi...
                                </div>
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
                {{ $suppliers->links() }}
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // message with sweetalert
    @if(session('success'))
    swal.fire({
        icon: "success",
        title: "Success",
        text: "{{ session('success') }}",
        showConfirmButton: false,
        timer: 2000
    });
    @elseif(session('error'))
    swal.fire({
        icon: "error",
        title: "Error",
        text: "{{ session('error') }}",
        showConfirmButton: false,
        timer: 2000
    });
    @endif
</script>
</body>
</html>
