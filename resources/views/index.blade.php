<!DOCTYPE html>
<html lang="en">

<head>
	<title>K-llection</title>
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
							<a href="{{ route('home') }}" style="font-size: 24px; font-weight: bold; color: #000000;">K-llection</a>
						</div>
					</div>

					<div class="col-md-10">

						<nav id="navbar">
							<div class="main-menu stellarnav">
								<ul class="menu-list">
									<li class="menu-item active"><a href="{{ route('index') }}">Home</a></li>
									<li class="menu-item"><a href="{{ route('plist') }}" class="nav-link">Products</a></li>
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
									<!-- <li class="menu-item"><a href="#" class="cart for-buy"><i class="icon icon-clipboard"></i><span>Cart:(0$)</span></a></li> -->
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

	<section id="billboard">

		<div class="container">
			<div class="row">
				<div class="col-md-12">

					<button class="prev slick-arrow">
						<i class="icon icon-arrow-left"></i>
					</button>

					<div class="main-slider pattern-overlay">
						@foreach ($products->take(5) as $product)
						<div class="slider-item">
							<div class="banner-content">
								<h2 class="banner-title">{{ $product->title }}</h2>
								<p>{{ $product->description }}.</p>
								<div class="btn-wrap">
									<a href="{{ route('plist') }}" class="btn btn-outline-accent btn-accent-arrow">More<i class="icon icon-ns-arrow-right"></i></a>
								</div>
							</div>
							<img src="{{ asset('/storage/images/'.$product->image) }}" alt="banner" style="width:40%" class="">
						</div>
						@endforeach
					</div>
					<button class="next slick-arrow">
						<i class="icon icon-arrow-right"></i>
					</button>

				</div>
			</div>
		</div>

	</section>

	<section id="featured-books" class="py-5 my-5">
		<div class="container">
			<div class="row">
				<div class="col-md-12">

					<div class="section-header align-center">
						<div class="title">
							<span>Some quality items</span>
						</div>
						<h2 class="section-title">Featured Products</h2>
					</div>

					<div class="product-list" data-aos="fade-up">
						<div class="row">

							@foreach ($products->take(4) as $product)
							<div class="col-md-3">
								<div class="product-item">
									<figure class="product-style">
										<img src="{{ asset('/storage/images/'.$product->image) }}" alt="Books" class="product-item">
										<button type="button" class="add-to-cart" data-product-tile="add-to-cart">Add to
											Cart</button>
									</figure>
									<figcaption>
										<h3>{{ $product->title }}</h3>
										<span>{{ $product->description }}</span>
										<div class="item-price">{{ "Rp " . number_format($product->price,2,',','.') }}</div>
									</figcaption>
								</div>
							</div>
							@endforeach
						</div>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-md-12">

					<div class="btn-wrap align-right">
						<a href="{{ route('plist') }}" class="btn-accent-arrow">View all products <i class="icon icon-ns-arrow-right"></i></a>
					</div>

				</div>
			</div>
		</div>
	</section>

	<section id="best-selling" class="leaf-pattern-overlay">
		<div class="corner-pattern-overlay"></div>
		<div class="container">
			<div class="row justify-content-center">

				<div class="col-md-8">

					<div class="row">
						<h2 class="section-title divider">Best Selling Products</h2>
						@foreach ($products->take(1) as $product)
						<div class="col-md-6">
							<figure class="products-thumb">
								<img src="{{ asset('/storage/images/'.$product->image) }}" alt="book" class="single-image">
							</figure>
						</div>

						<div class="col-md-6">
							<div class="product-entry">

								<div class="products-content">
									<div class="author-name">{{ $product->category_product_name }}</div>
									<h3 class="item-title">{{ $product->title }}</h3>
									<p>{{ $product->description }}.</p>
									<div class="item-price">{{ "Rp " . number_format($product->price,2,',','.') }}</div>
									<div class="btn-wrap">
										<a href="#" class="btn-accent-arrow">shop it now <i class="icon icon-ns-arrow-right"></i></a>
									</div>
								</div>
								
							</div>
						</div>
						@endforeach
					</div>
				</div>
			</div>
		</div>
	</section>

	<section id="special-offer" class="bookshelf pb-5 mb-5">

		<div class="section-header align-center">
			<div class="title">
				<span>Grab your opportunity</span>
			</div>
			<h2 class="section-title">Products with offer</h2>
		</div>

		<div class="container">
			<div class="row">
				<div class="inner-content">
					<div class="product-list" data-aos="fade-up">
						<div class="grid product-grid">
							@foreach ($products->take(4) as $product)
							<div class="product-item">
								<figure class="product-style">
									<img src="{{ asset('/storage/images/'.$product->image) }}" alt="Books" class="product-item">
									<button type="button" class="add-to-cart" data-product-tile="add-to-cart">Add to
										Cart</button>
								</figure>
								<figcaption>
									<h3>{{ $product->title }}</h3>
									<span>{{ $product->description }}</span>
									<div class="item-price">
										<span class="prev-price">{{ "Rp " . number_format($product->price,2,',','.') }}</span>{{ "Rp " . number_format($product->price*0.8,2,',','.') }}
									</div>
								</figcaption>
							</div>
							@endforeach
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section id="subscribe">
		<div class="container">
			<div class="row justify-content-center">

				<div class="col-md-8">
					<div class="row">

						<div class="col-md-6">

							<div class="title-element">
								<h2 class="section-title divider">Subscribe to our newsletter</h2>
							</div>

						</div>
						<div class="col-md-6">

							<div class="subscribe-content" data-aos="fade-up">
								<p>Sed eu feugiat amet, libero ipsum enim pharetra hac dolor sit amet, consectetur. Elit
									adipiscing enim pharetra hac.</p>
								<form id="form">
									<input type="text" name="email" placeholder="Enter your email addresss here">
									<button class="btn-subscribe">
										<span>send</span>
										<i class="icon icon-send"></i>
									</button>
								</form>
							</div>

						</div>

					</div>
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
							<img src="{{asset('frontend/images/main-logo.png')}}" alt="logo" class="footer-logo">
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
								<a href="{{ route('index') }}">Home</a>
							</li>
							<li class="menu-item">
								<a href="{{ route('plist') }}">Products</a>
							</li>
						</ul>
					</div>

				</div>
				<div class="col-md-2">

					<div class="footer-menu">
						<h5>My account</h5>
						<ul class="menu-list">
							<li class="menu-item">
								<a href="{{ route('login') }}">Log In</a>
							</li>
							<li class="menu-item">
								<a href="{{ route('register') }}">Register</a>
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