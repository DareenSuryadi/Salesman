
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Transaction</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background: lightgray">

    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-12">
                <h4>Edit Transaction</h4>
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <form id="editForm" action="{{ route('transaksis.update',$transaksis['transaksi']->id) }}" method="POST" enctype ="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <!-- Produk -->
                            <div class="form-group mb-3">
                                <label for="id_product">Product</label>
                                <select class="form-control" name="id_product" id="id_product" required>
                                    <option value="">-- Select Product --</option>
                                    @foreach ($transaksis as $transaksi)
                                        <option value="{{ $transaksi->id_product }}"
                                            @if(old('id_product', $transaksi->id_product) == $transaksi->id_product) selected @endif>
                                            {{ $transaksi->title }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('id_product')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Total Produk-->
                            <div class="form-group mb-3">
                                <label class="font-weight-bold">Jumlah Pembelian</label>
                                <input type="number" class="form-control @error('jumlah_pembelian') is-invalid @enderror" name="jumlah_pembelian" value="{{ old('jumlah_pembelian', $transaksi->jumlah_pembelian) }}" required>
                                @error('jumlah_pembelian')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Nama Kasir -->
                            <div class="form-group mb-3">
                                <label class="font-weight-bold">Nama Kasir</label>
                                <input type="text" class="form-control @error('nama_kasir') is-invalid @enderror" name="nama_kasir" value="{{ old('nama_kasir', $transaksi->nama_kasir) }}" required>
                                @error('nama_kasir')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Tanggal Transaksi -->
                            <div class="form-group mb-3">
                                <label class="font-weight-bold">Tanggal Transaksi</label>
                                <input type="date" class="form-control @error('tanggal_transaksi') is-invalid @enderror" name="tanggal_transaksi" value="{{ old('tanggal_transaksi', $transaksi->tanggal_transaksi) }}" required>
                                @error('tanggal_transaksi')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Diskon -->
                            <div class="form-group mb-3">
                                <label class="font-weight-bold">Diskon</label>
                                <input type="number" step="0.01" class="form-control @error('diskon') is-invalid @enderror" name="diskon" value="{{ old('diskon', $transaksi->diskon) }}" placeholder="Optional">
                                @error('diskon')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Button -->
                            <div class="form-group">
                                <button type="submit" class="btn btn-md btn-primary mr-3">UPDATE</button>
                                <button type="button" id="resetBtn" onclick="resetForm()" class="btn btn-md btn-warning">RESET</button>
                            </div>
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
    
    <script>
        CKEDITOR.replace( 'description' );

        function resetForm() {
            document.getElementById("editForm").reset(); // Mereset semua nilai dalam form
        }
        </script>
</body>
</html>