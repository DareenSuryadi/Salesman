<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add New Supplier</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background: lightgray">
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-12">
                <h3>Add New Supplier</h3>
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <form id="productForm" action="{{ route('suppliers.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group mb-3">
                            <label class="font-weight-bold">Supplier Name</label>
                            <input type="text" class="form-control @error('supplier_name') is-invalid @enderror" name="supplier_name" placeholder="Masukkan Supplier Name">
                        </div>
                        
                        <div class="form-group mb-3">
                            <label class="font-weight-bold">Address Supplier</label>
                            <input type="text" class="form-control @error('address_supp') is-invalid @enderror" name="address_supp" placeholder="Masukkan Address Supplier">
                        </div>

                        <div class="form-group mb-3">
                            <label class="font-weight-bold">PIC Name</label>
                            <textarea class="form-control @error('pic_name') is-invalid @enderror" name="pic_name" rows="5" placeholder="Masukkan PIC Name"></textarea>
                        </div>
                        
                        <div class="form-group mb-3">
                            <label class="font-weight-bold">Phone</label>
                            <textarea class="form-control @error('phone') is-invalid @enderror" name="phone" rows="5" placeholder="Masukkan Phone"></textarea>
                        </div>
                        
                        <div class="form-group mb-3">
                            <label class="font-weight-bold">Address</label>
                            <textarea class="form-control @error('address') is-invalid @enderror" name="address" rows="5" placeholder="Masukkan Address"></textarea>
                        </div>

                        <div class="form-group mb-3">
                            <label class="font-weight-bold">Phone Supplier</label>
                            <textarea class="form-control @error('phone_supp') is-invalid @enderror" name="phone_supp" rows="5" placeholder="Masukkan Phone Supplier"></textarea>
                        </div>

                        <button type="submit" class="btn btn-md btn-primary me-3">SAVE</button>
                        <button type="button" id="resetBtn" onclick="resetForm()" class="btn btn-md btn-warning">RESET</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('description');

        function resetForm() {
            document.getElementById("productForm").reset(); // Mereset semua nilai dalam form

            // Reset CKEditor content to empty
            for (var instance in CKEDITOR.instances) {
                CKEDITOR.instances[instance].setData(''); // Reset CKEditor content
            }
        }
    </script>
</body>
</html>
