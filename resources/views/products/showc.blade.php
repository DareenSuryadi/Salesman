<!DOCTYPE html>
<html lang="en">

<head>
	<title>Salesman</title>
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

</head>

<body data-bs-spy="scroll" data-bs-target="#header" tabindex="0">

	<div id="header-wrap">
		<header id="header">
			<div class="container-fluid">
				<div class="row">

					<div class="col-md-2">
						<div class="main-logo">
							<a href="{{ route('home') }}" style="font-size: 24px; font-weight: bold; color: #000000;">Salesman</a>
						</div>
					</div>

					<div class="col-md-10">

						<nav id="navbar">
							<div class="main-menu stellarnav">
								<ul class="menu-list">
									<li class="menu-item"><a href="{{ route('index') }}">Home</a></li>
									<li class="menu-item active"><a href="{{ route('plist') }}" class="nav-link">Products</a></li>										@auth
											<li class="menu-item"><a href="{{ route('transaksis.index') }}" class="nav-link">Transaksi</a></li>
										@endauth									@guest
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

	<section class="product-details">
		<div class="container">
			<div class="row">
				<div class="col-md-6">
					<!-- Gambar produk -->
					<img src="{{ asset('/storage/images/'.$product->image) }}" alt="{{ $product->title }}" class="img-fluid" style="{{ $product->stock <= 0 ? 'filter: brightness(65%);' : '' }}">
				</div>
				<div class="col-md-6">
					<!-- Detail produk -->
					<h2 id="title-0">{{ $product->title }}</h2>
					<p><strong>Alamat:</strong> {{ $product->alamat ?: 'Alamat belum tersedia.' }}</p>
					<p><strong>Phone PIC:</strong> {{ $product->supplier->phone_pic ?? 'Nomor telepon belum tersedia.' }}</p>
					<div class="rating">
						<!-- Komponen untuk menampilkan rating rata-rata -->
						@include('components.rating', ['rating' => $averageRating])
					</div>
					@if ($product->stock <= 0)
						<p id="stock-0" style="color: #dc3545; font-weight: bold;">Sold Out</p>
					@else
						<p id="stock-0">Stock: {{ $product->stock }}</p>
					@endif
					<p id="price-0">Harga: {{ "Rp " . number_format($product->discounted_price, 0, ',', '.') }}</p>
					@if ($product->stock > 0)
						@php
							$waPhone = preg_replace('/[^0-9]/', '', $product->supplier->phone_pic ?? '');
						@endphp
						@if ($waPhone)
							<a href="https://wa.me/{{ $waPhone }}?text={{ urlencode('Halo, saya tertarik dengan produk ' . $product->title) }}" target="_blank" rel="noopener noreferrer" style="text-decoration: none; color: white;">
								<button type="button" class="add-to-cart">Contact</button>
							</a>
						@else
							<button type="button" class="add-to-cart out-of-stock" disabled>Contact Unavailable</button>
						@endif
					@endif
				</div>
			</div>
			<div class="row mt-4">
				<div class="col-md-12">
					<p>{{ $product->description }}</p>
				</div>
			</div>
			<div class="row">
				<div class="fasilitas-gallery">
    <h3>Fasilitas</h3>
    <div class="row">
        @foreach($product->fasilitas as $f)
            <div class="col-md-2">
                <img src="{{ asset('storage/fasilitas/' . $f->foto) }}" alt="Fasilitas {{ $loop->iteration }}" class="img-fluid">
            </div>
        @endforeach
    </div>
</div>

@if ($product->video_link)
    <div class="mb-3">
        <h4>Video</h4>
        <div class="ratio ratio-16x9">
            <iframe 
                src="{{ $product->embed_video_link }}" 
                title="Video Produk" 
                allowfullscreen 
                style="width:100%; height:450px; border:none;">
            </iframe>
        </div>
    </div>
@endif


    <div class="col-md-12">
        <h3>Reviews</h3>
        @forelse ($product->ulasans as $ulasan)
            <div class="review">
                <!-- Tampilkan nama pengguna atau fallback ke "Anonymous" -->
                <p id="ulasan-0"><strong>{{ $ulasan->user->name ?? 'Anonymous' }}</strong> - {{ $ulasan->created_at->format('d M Y') }}</p>
                <!-- Tampilkan rating -->
                <div class="rating">
                    @include('components.rating', ['rating' => $ulasan->rating])
                </div>
				<!-- Tampilkan isi ulasan -->
                <p>{{ $ulasan->ulasan }}</p>
            </div>
        @empty
            <p>Belum ada ulasan untuk produk ini.</p>
        @endforelse
    </div>
</div>

		</div>
	</section>

	<footer id="footer">
		<div class="container">
			<div class="row">

				<div class="col-md-4">

					<div class="footer-item">
						<div class="company-brand">
						<p style="font-size:24px;"><b>Salesman</b></p>
							<!-- <img src="{{asset('frontend/images/main-logo.png')}}" alt="logo" class="footer-logo"> -->
							<p><strong>Salesman</strong> adalah platform properti praktis, aman, dan transparan untuk membantu proses jual beli properti.</p>
							<details>
								<summary>View More</summary>
								<p>Kami menghubungkan <strong>pemilik properti, penjual, pembeli, dan pencari properti</strong> dalam satu platform. Mulai dari menemukan rumah, apartemen, tanah, hingga properti komersial, Salesman membantu pengguna menemukan pilihan yang sesuai dengan kebutuhan mereka.</p>
								<p>Kami percaya bahwa proses transaksi properti tidak harus rumit. Karena itu, Salesman menyediakan pengalaman yang sederhana dengan informasi properti yang jelas, pencarian yang mudah, serta proses transaksi yang lebih terorganisir.</p>
							</details>
						</div>
					</div>

				</div>

				<div class="col-md-2">

					<div class="footer-menu">
						<h5>About Us</h5>
						<ul class="menu-list">
							<li class="menu-item">
								<a href="#">Vision</a>
							</li>
							<li class="menu-item">
								<a href="#">Articles</a>
							</li>
							<li class="menu-item">
								<a href="#">Careers</a>
							</li>
							<li class="menu-item">
								<a href="#">Service Terms</a>
							</li>
							<li class="menu-item">
								<a href="#">Donate</a>
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