<!DOCTYPE html>
<html lang="en">

<head>
	<title>Apa aja</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="format-detection" content="telephone=no">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="author" content="">
	<meta name="keywords" content="">
	<meta name="description" content="">

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

	<link rel="stylesheet" type="text/css" href="{{asset('frontend/css/normalize.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('frontend/icomoon/icomoon.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('frontend/css/vendor.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('frontend/style.css')}}">


	<style>
		/* Styling untuk tabel produk dengan border yang jelas */
table.table {
    width: 100%;
    border-collapse: collapse;  /* Menggabungkan border antar sel */
    margin-top: 30px;  /* Memberi jarak pada bagian atas tabel */
}

table.table th, table.table td {
    padding: 12px 15px;
    text-align: left;
    border: 1px solid #ddd;  /* Menambahkan border yang lebih terlihat */
}

table.table th {
    background-color: #f8f9fa;  /* Warna latar belakang pada header */
    font-weight: bold;
}

table.table tr:nth-child(even) {
    background-color: #f2f2f2;  /* Warna latar belakang baris genap */
}

table.table tr:hover {
    background-color: #e9ecef;  /* Warna latar belakang ketika mouse hover */
}

table.table td {
    background-color: #fff;  /* Memberi latar belakang putih pada setiap data */
}
/* Styling untuk form */
form {
    background-color: #fff;
    padding: 30px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    border: 1px solid #ddd;  /* Memberikan border pada form */
    margin-top: 30px;
}

.form-select, .form-control {
    border: 1px solid #ccc;  /* Border pada input dan textarea */
    border-radius: 5px;
    padding: 10px;
    width: 100%;  /* Membuat input lebar penuh */
    font-size: 16px;
}

/* Styling untuk rating select */
.form-select {
    margin-bottom: 15px;
}

/* Styling untuk textarea */
textarea.form-control {
    resize: vertical;
    margin-bottom: 20px;
}

/* Styling untuk tombol submit */
button[type="submit"] {
    background-color: #007bff;
    border: none;
    color: white;
    font-size: 16px;
    padding: 12px 30px;
    border-radius: 50px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

button[type="submit"]:hover {
    background-color: #0056b3;
}

	</style>
</head>

<body data-bs-spy="scroll" data-bs-target="#header" tabindex="0">

	<div id="header-wrap">
		<header id="header">
			<div class="container-fluid">
				<div class="row">

                    <div class="col-md-2">
						<div class="main-logo">
							<a href="{{ route('home') }}" style="font-size: 24px; font-weight: bold; color: #000000;">K-llection</a>
						</div>
					</div>

					<div class="col-md-10">

						<nav id="navbar">
							<div class="main-menu stellarnav">
								<ul class="menu-list">
									<li class="menu-item"><a href="{{ route('index') }}">Home</a></li>
									<li class="menu-item"><a href="{{ route('plist') }}" class="nav-link">Products</a></li>
									</a></li>
									@guest
										@if (Route::has('login'))
											<li class="menu-item">
												<a class="nav-link user-account for-buy" href="{{ route('login') }}">
													<i class="icon icon-user"></i><span>{{ __('Login') }}</span>
												</a>
											</li>
										@endif

									@else
										<li class="menu-item has-sub">
											<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button">
												{{ Auth::user()->name }} <i class="icon icon-user"></i>
											</a>
											<ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
												<li>
													<a class="nav-link user-account for-buy" href="{{ route('profile') }}">
														<i class="icon icon-user"></i><span>Profile</span>
													</a>
												</li>
												<li>
													<a class="dropdown-item" href="{{ route('logout') }}"
														onclick="event.preventDefault();
														document.getElementById('logout-form').submit();">
														{{ __('Logout') }}
													</a>
												</li>

												<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
													@csrf
												</form>
											</ul>
										</li>
									@endguest
									<li class="menu-item">
                                        <div class="action-menu">
                                            <div class="search-bar">
                                                <a href="#" class="search-button search-toggle" data-selector="#header-wrap">
                                                    <i class="icon icon-search"></i>
                                                </a>
                                                <form role="search" method="get" class="search-box">
                                                    <input class="search-field text search-input" placeholder="Search"
                                                        type="search">
                                                </form>
                                            </div>
                                        </div>
                                    </li>
								</ul>

								<div class="hamburger">
									<span class="bar"></span>
									<span class="bar"></span>
									<span class="bar"></span>
								</div>

							</div>
						</nav>

					</div>

				</div>
			</div>
		</header>

	</div>

	<section id="transaction-details" class="py-1 my-2">
		<div class="container">
			<h2 class="mb-4">Transaction #{{ $transaksi->id }}</h2>

			<!-- Product List -->
			<div class="col-md-12">
				<table class="table">
					<thead>
						<tr>
							<th>Name</th>
							<th>Quantity</th>
						</tr>
					</thead>
					<tbody>
						@foreach($products as $product)
							<tr>
								<td>{{ $product['name'] }}</td>
								<td>{{ $product['quantity'] }}</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>

			<!-- Review Form -->
			<h3 class="mt-5">Berikan Ulasanmu</h3>
			<form action="{{ route('ulasan.store', $transaksi->id) }}" method="POST">
				@csrf
				<input type="hidden" name="id_transaksi" value="{{ $transaksi->id }}">

				<div class="mb-3">
					<label for="rating" class="form-label">Rating</label>
					<select class="form-select" id="rating" name="rating" required>
						<option value="1">1 - Poor</option>
						<option value="2">2 - Fair</option>
						<option value="3">3 - Good</option>
						<option value="4">4 - Very Good</option>
						<option value="5">5 - Excellent</option>
					</select>
				</div>

				<div class="mb-3">
					<label for="review" class="form-label">Ulasan</label>
					<textarea class="form-control" id="review" name="ulasan" rows="4" required></textarea>
				</div>

				<button type="submit" class="btn btn-primary">Submit</button>
			</form>
		</div>
	</section>

	<footer id="footer">
		<div class="container">
			<div class="row">

				<div class="col-md-4">

					<div class="footer-item">
						<div class="company-brand">
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sagittis sed ptibus liberolectus
								nonet psryroin. Amet sed lorem posuere sit iaculis amet, ac urna. Adipiscing fames
								semper erat ac in suspendisse iaculis.</p>
						</div>
					</div>

				</div>

				<div class="col-md-2">

					<div class="footer-menu">
						<h5>About Us</h5>
						<ul class="menu-list">
							<li class="menu-item">
								<a href="#">vision</a>
							</li>
							<li class="menu-item">
								<a href="#">articles </a>
							</li>
							<li class="menu-item">
								<a href="#">careers</a>
							</li>
							<li class="menu-item">
								<a href="#">service terms</a>
							</li>
							<li class="menu-item">
								<a href="#">donate</a>
							</li>
						</ul>
					</div>

				</div>
				<div class="col-md-2">

					<div class="footer-menu">
						<h5>Discover</h5>
						<ul class="menu-list">
							<li class="menu-item">
								<a href="#">Home</a>
							</li>
							<li class="menu-item">
								<a href="#">Books</a>
							</li>
							<li class="menu-item">
								<a href="#">Authors</a>
							</li>
							<li class="menu-item">
								<a href="#">Subjects</a>
							</li>
							<li class="menu-item">
								<a href="#">Advanced Search</a>
							</li>
						</ul>
					</div>

				</div>
				<div class="col-md-2">

					<div class="footer-menu">
						<h5>My account</h5>
						<ul class="menu-list">
							<li class="menu-item">
								<a href="#">Sign In</a>
							</li>
							<li class="menu-item">
								<a href="#">View Cart</a>
							</li>
							<li class="menu-item">
								<a href="#">My Wishtlist</a>
							</li>
							<li class="menu-item">
								<a href="#">Track My Order</a>
							</li>
						</ul>
					</div>

				</div>
				<div class="col-md-2">

					<div class="footer-menu">
						<h5>Help</h5>
						<ul class="menu-list">
							<li class="menu-item">
								<a href="#">Help center</a>
							</li>
							<li class="menu-item">
								<a href="#">Report a problem</a>
							</li>
							<li class="menu-item">
								<a href="#">Suggesting edits</a>
							</li>
							<li class="menu-item">
								<a href="#">Contact us</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</footer>

	<div id="footer-bottom">
		<div class="container">
			<div class="row">
				<div class="col-md-12">

					<div class="copyright">
						<div class="row">

							<div class="col-md-6">
								<p>© 2022 All rights reserved.</p>
							</div>

							<div class="col-md-6">
								<div class="social-links align-right">
									<ul>
										<li>
											<a href="#"><i class="icon icon-facebook"></i></a>
										</li>
										<li>
											<a href="#"><i class="icon icon-twitter"></i></a>
										</li>
										<li>
											<a href="#"><i class="icon icon-youtube-play"></i></a>
										</li>
										<li>
											<a href="#"><i class="icon icon-behance-square"></i></a>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script src="{{asset('frontend/js/jquery-1.11.0.min.js')}}"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js')}}"
		integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
		crossorigin="anonymous"></script>
	<script src="{{asset('frontend/js/plugins.js')}}"></script>
	<script src="{{asset('frontend/js/script.js')}}"></script>

</body>

</html>