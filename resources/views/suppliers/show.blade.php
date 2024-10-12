<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Show Products</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background: lightpink">

    <div class="container mt-5 mb-5">
        <div class="row">
            <center><h3>Show Supplier</h3>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm rounded">
                </div>
            </div>
            <div class="col-md-8">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <h3>{{ $supplier->supplier_name }}</h3>
                        <hr>
                        <p>Address Supplier : {{ $supplier->address_supp }}</p>
                        <hr>
                        <p>Number Phone supplier : {{ $supplier->phone_supp }}</p>
                        <hr>
                        <p>PIC Name : {{ $supplier->pic_name }}</p>
                        <hr>
                        <p>Phone : {{ $supplier->phone }}</p>
                        <hr>
                        <p>Address : {{ $supplier->address }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </center>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>