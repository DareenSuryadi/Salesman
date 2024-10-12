<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Products</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background: lightpink">

    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-12">
                <h4>Edit Supplier</h4>
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <form action="{{ route('suppliers.update', $data['supplier']->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')


                    <div class="form-group mb-3">
                    <label class="font-weight-bold">SUPPLIER NAME</label>
                    <input type="text" class="form-control @error('supplier_name') is-invalid @enderror" name="supplier_name" value="{{ old('supplier_name', $data['supplier']->supplier_name) }}" placeholder="Masukkan Nama Supplier">
                    <!-- error message untuk supplier name -->
                    @error('supplier_name')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label class="font-weight-bold">ADDRESS SUPPLIER</label>
                    <input type="text" class="form-control @error('address_supp') is-invalid @enderror" name="address_supp" value="{{ old('address_supp', $data['supplier']->address_supp) }}" placeholder="Masukkan Alamat Supplier">
                    <!-- error message untuk address supplier -->
                    @error('address_supp')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="font-weight-bold">PHONE SUPPLIER</label>
                            <input type="number" class="form-control @error('phone_supp') is-invalid @enderror" name="phone_supp" value="{{ old('phone_supp', $data['supplier']->phone_supp) }}" placeholder="Masukkan Nmor HP Supplier">
                            <!-- error message untuk phone supplier -->
                            @error('phone_supp')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    

                <div class="form-group mb-3">
                    <label class="font-weight-bold">PIC NAME</label>
                    <input type="text" class="form-control @error('pic_name') is-invalid @enderror" name="pic_name" value="{{ old('pic_name', $data['supplier']->pic_name) }}" placeholder="Masukkan Nama PIC">
                    <!-- error message untuk pic name -->
                    @error('pic_name')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="font-weight-bold">PHONE</label>
                            <input type="number" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone', $data['supplier']->phone) }}" placeholder="Masukkan Nmor HP PIC">
                            <!-- error message untuk phon -->
                            @error('phone')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
              
                </div>

                <div class="form-group mb-3">
                    <label class="font-weight-bold">ADDRESS</label>
                    <textarea class="form-control @error('address') is-invalid @enderror" name="address" rows="5" placeholder="Masukkan Alamat">{{ old('address', strip_tags($data['supplier']->address)) }}</textarea>
                    <!-- error message untuk address -->
                    @error('address')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                </div>
                </div>

               

                <div class="form-group">
                    <button type="submit" class="btn btn-md btn-primary mr-3">UPDATE</button>
                    <button type="reset" class="btn btn-md btn-warning">RESET</button>
                </div>
                </form>

                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
                <script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
                <script>
                    CKEDITOR.replace('address');
                </script>
                </body>
                </html>