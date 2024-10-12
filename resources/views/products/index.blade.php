<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title> Data Product</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <body style="background-image: url(https://blog-asset.jakmall.com/2023/12/TWICEJKT23_Poster4x5-1448x2048.png);background-size: auto;background-position: center; margin: 60px;" >

    <div class="container mt-5">
        <div class="row" >
            <div class="col-md-12" >
                <div>
                    <h3 class="text-center my-4" style="color: #FEE6A8"> TWICE Fanpage Database</h3>
                    <hr>
                </div>
                <div class="card border-0 shadow-sm rounded" style="padding-top: 0px;padding-bottom: 30px;">
                    <div class="card-body">
                        <a href="{{ route('products.create')}}" class="btn btn-md btn-success mb-3">ADD PRODUCT</a>
                    </div>
      
    <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">IMAGE</th>
                <th scope="col">NAMA SUPPLIER</th>
                <th scope="col">CATEGORY</th>
                <th scope="col">TITLE</th>
                <th scope="col">PRICE</th>
                <th scope="col">STOCK</th>
                <th scope="col" style="width: 20%">ACTIONS</th>
</tr>
</thead>
<tbody>
    @forelse ($products as $product)
        <tr>
            <td class="text-center">
                <img src="{{asset('/storage/images/'.$product->image)}}" class="rounded" style="width:150px; height: 230px;">
            </td>
            <td class="text-center">{{ $product->supplier_name}}</td>
            <td class="text-center">{{ $product->product_category_name}}</td>
            <td class="text-center" >{{ $product->title}}</td>
            <td class="text-center">{{"Rp " . number_format($product->price,2,'.')}}</td>
            <td class="text-center">{{ $product->stock }}</td>
            <td class="text-center">
                <form onsubmit="return confirm('Yakin ga lu?');" action="{{ route('products.destroy', $product->id) }}" method="POST">
                    <a href="{{ route('products.show', $product->id)}}" class="btn btn-outline-primary">SHOW</a>
                    <a href="{{ route('products.edit', $product->id)}}" class="btn btn-outline-primary">EDIT</a>
                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-outline-danger">HAPUS</button>
                </form>
            </td>
        </tr>
        @empty
            <div class="alert alert-danger">
                Data Products Belum tersedia brow cobalah beberapa saat lagi..
            </div>
        @endforelse
        </tbody>
        </table>
        
        {{ $products->links()}}

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
                icon:"success",
                title:"CONGRATS ANDA BERHASIL",
                text:"{{session('success')}}",
                showConfirmButton: false,
                timer: 2000
            });
        @elseif(session('error'))
            swal.fire({
                icon:"error",
                title:"MAAF ANDA GAGAL UEWK WEK WEK",
                text:"{{session('error')}}",
                showConfirmButton: false,
                timer: 2000
            });
        @endif
    </script>
</body>
</html>

