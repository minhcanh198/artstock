@extends('new_template.layouts.app')
@section('content')

	<section class="banner" style="background-image: url(<?php echo asset('home_page/header_assets/').'/' .$homePageSettings->header_main_image; ?>) ">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div>
						<div class="text" data-aos="fade-right">
							<h1>{{ $homePageSettings->header_description }}</h1>
							<!-- <div class="icon-play"><img src="{{ asset('custom-css/images/play-icon.png') }}"></div> -->
							<div class="form-group width">
								<input class="form-control" id="" name="" placeholder="Search Here" type="">
								<p>Suggested: love, harmony, r&b, pop, nature</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<section class="tabs">
			<div class="container">
				<div class="row">
					<div class="tabs">
						<div class="tabs__navigation" data-aos="fade-down">
						<button data-target="first" class="active">Recent</button>
						@foreach($categoriesList as $category)
							<button  id="buttonCategories|{{ $category->slug }}" data-target="{{ $category->slug }}">{{ $category->name }}</button>
						@endforeach
						</div>
						<div id="tabs__content">
							<div class="single__tab active first">
								<div class="container">
									<div class="row mb-4">
										<div class="col-12">
											<div class="d-flex">
												<div class="">
													<h1 class="popular-title">
														Popular Musics
													</h1>
												</div>
												<div class="ml-auto align-self-center">
													<a href="" class="btn-see-all">See All</a>
												</div>
											</div>
										</div>
									</div>
									<div class="row">

									<div class="col-12">
					<div class="audio-song-box">
						<div class="audio-head d-flex">
							<h1 class="align-self-end">1 . Lorem ipsum dolor</h1>
							<div class="audio-icons ml-auto d-flex align-self-center">
								<a href="" class="icon-one"><i class="fas fa-download"></i></a>
								<a href="" class="icon-one"><i class="fas fa-heart"></i></a>
								<a href="" class="buy-track"><i class="fas fa-shopping-cart"></i> Buy Track</a>
							</div>
						</div>
						<audio controls class="audio-one">
							<source src="https://ia800905.us.archive.org/19/items/FREE_background_music_dhalius/backsound.mp3"  type="audio/mp3">
						</audio>

					</div>

						<div class="audio-song-box">
						<div class="audio-head d-flex">
							<h1 class="align-self-end">1 . Lorem ipsum dolor</h1>
							<div class="audio-icons ml-auto d-flex align-self-center">
								<a href="" class="icon-one"><i class="fas fa-download"></i></a>
								<a href="" class="icon-one"><i class="fas fa-heart"></i></a>
								<a href="" class="buy-track"><i class="fas fa-shopping-cart"></i> Buy Track</a>
							</div>
						</div>
						<audio controls class="audio-one">
							<source src="https://ia800905.us.archive.org/19/items/FREE_background_music_dhalius/backsound.mp3"  type="audio/mp3">
						</audio>
					</div>

						<div class="audio-song-box">
						<div class="audio-head d-flex">
							<h1 class="align-self-end">1 . Lorem ipsum dolor</h1>
							<div class="audio-icons ml-auto d-flex align-self-center">
								<a href="" class="icon-one"><i class="fas fa-download"></i></a>
								<a href="" class="icon-one"><i class="fas fa-heart"></i></a>
								<a href="" class="buy-track"><i class="fas fa-shopping-cart"></i> Buy Track</a>
							</div>
						</div>
						<audio controls class="audio-one">
							<source src="https://ia800905.us.archive.org/19/items/FREE_background_music_dhalius/backsound.mp3"  type="audio/mp3">
						</audio>
					</div>

						<div class="audio-song-box">
						<div class="audio-head d-flex">
							<h1 class="align-self-end">1 . Lorem ipsum dolor</h1>
							<div class="audio-icons ml-auto d-flex align-self-center">
								<a href="" class="icon-one"><i class="fas fa-download"></i></a>
								<a href="" class="icon-one"><i class="fas fa-heart"></i></a>
								<a href="" class="buy-track"><i class="fas fa-shopping-cart"></i> Buy Track</a>
							</div>
						</div>
						<audio controls class="audio-one">
							<source src="https://ia800905.us.archive.org/19/items/FREE_background_music_dhalius/backsound.mp3"  type="audio/mp3">
						</audio>
					</div>
				</div>

									</div>
								</div>
							</div>
							<div class="single__tab  second">
								<div class="container">
									<div class="row mb-4">
										<div class="col-12">
											<h1 class="discover">
												Discover
											</h1>
											<div class="d-flex">
												<div class="">
													<h1 class="popular-title">
														Popular Images
													</h1>
												</div>
												<div class="ml-auto align-self-center">
													<a href="" class="btn-see-all">See All</a>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-4 popular-images-box">
											<div class="">
												<div class="rounded-img">
													<img src="images/pexels-photo-4066291.jpeg" alt="" class="img-fluid">
												</div>
												<div class="row no-gutters rounded-img">
													<div class="col-3">
														<img src="images/1.jpeg" alt="" class="img-fluid">
													</div>
													<div class="col-3">
														<img src="images/2.jpeg" alt="" class="img-fluid">
													</div>
													<div class="col-3">
														<img src="images/3.jpg" alt="" class="img-fluid">
													</div>
													<div class="col-3">
														<img src="images/pexels-photo-4066291.jpeg" alt="" class="img-fluid">
													</div>
												</div>
												<div class="d-flex popular-content-hover mt-3">
													<div class="popular-content-text">
														<a href="">lorem ispum</a>
													</div>
											    <div class="icon-photo-one ml-auto">
				                    <i class="far fa-images"></i> <small class="photos-count">1.5k</small>
				                  </div>
												</div>
											</div>
										</div>
										<div class="col-md-4 popular-images-box">
											<div class="">
												<div class="rounded-img">
													<img src="images/1.jpeg" alt="" class="img-fluid">
												</div>
												<div class="row no-gutters rounded-img">
													<div class="col-3">
														<img src="images/1.jpeg" alt="" class="img-fluid">
													</div>
													<div class="col-3">
														<img src="images/2.jpeg" alt="" class="img-fluid">
													</div>
													<div class="col-3">
														<img src="images/3.jpg" alt="" class="img-fluid">
													</div>
													<div class="col-3">
														<img src="images/pexels-photo-4066291.jpeg" alt="" class="img-fluid">
													</div>
												</div>
												<div class="d-flex popular-content-hover mt-3">
													<div class="popular-content-text">
														<a href="">lorem ispum</a>
													</div>
											    <div class="icon-photo-one ml-auto">
				                    <i class="far fa-images"></i> <small class="photos-count">1.5k</small>
				                  </div>
												</div>
											</div>
										</div>
										<div class="col-md-4 popular-images-box">
											<div class="">
												<div class="rounded-img">
													<img src="images/3.jpg" alt="" class="img-fluid">
												</div>
												<div class="row no-gutters rounded-img">
													<div class="col-3">
														<img src="images/1.jpeg" alt="" class="img-fluid">
													</div>
													<div class="col-3">
														<img src="images/2.jpeg" alt="" class="img-fluid">
													</div>
													<div class="col-3">
														<img src="images/3.jpg" alt="" class="img-fluid">
													</div>
													<div class="col-3">
														<img src="images/pexels-photo-4066291.jpeg" alt="" class="img-fluid">
													</div>
												</div>
												<div class="d-flex popular-content-hover mt-3">
													<div class="popular-content-text">
														<a href="">lorem ispum</a>
													</div>
											    <div class="icon-photo-one ml-auto">
				                    <i class="far fa-images"></i> <small class="photos-count">1.5k</small>
				                  </div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="container">
									<div class="row mb-4 mt-4">
										<div class="col-12">
											<div class="d-flex">
												<div class="">
													<h1 class="popular-title">
														Popular Images
													</h1>
												</div>
												<div class="ml-auto align-self-center">
													<a href="" class="btn-see-all">See All</a>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-4 popular-images-box">
											<div class="">
												<div class="rounded-img">
													<img src="images/pexels-photo-4066291.jpeg" alt="" class="img-fluid">
												</div>
												<div class="row no-gutters rounded-img">
													<div class="col-3">
														<img src="images/1.jpeg" alt="" class="img-fluid">
													</div>
													<div class="col-3">
														<img src="images/2.jpeg" alt="" class="img-fluid">
													</div>
													<div class="col-3">
														<img src="images/3.jpg" alt="" class="img-fluid">
													</div>
													<div class="col-3">
														<img src="images/pexels-photo-4066291.jpeg" alt="" class="img-fluid">
													</div>
												</div>
												<div class="d-flex popular-content-hover mt-3">
													<div class="popular-content-text">
														<a href="">lorem ispum</a>
													</div>
											    <div class="icon-photo-one ml-auto">
				                    <i class="far fa-images"></i> <small class="photos-count">1.5k</small>
				                  </div>
												</div>
											</div>
										</div>
										<div class="col-md-4 popular-images-box">
											<div class="">
												<div class="rounded-img">
													<img src="images/1.jpeg" alt="" class="img-fluid">
												</div>
												<div class="row no-gutters rounded-img">
													<div class="col-3">
														<img src="images/1.jpeg" alt="" class="img-fluid">
													</div>
													<div class="col-3">
														<img src="images/2.jpeg" alt="" class="img-fluid">
													</div>
													<div class="col-3">
														<img src="images/3.jpg" alt="" class="img-fluid">
													</div>
													<div class="col-3">
														<img src="images/pexels-photo-4066291.jpeg" alt="" class="img-fluid">
													</div>
												</div>
												<div class="d-flex popular-content-hover mt-3">
													<div class="popular-content-text">
														<a href="">lorem ispum</a>
													</div>
											    <div class="icon-photo-one ml-auto">
				                    <i class="far fa-images"></i> <small class="photos-count">1.5k</small>
				                  </div>
												</div>
											</div>
										</div>
										<div class="col-md-4 popular-images-box">
											<div class="">
												<div class="rounded-img">
													<img src="images/3.jpg" alt="" class="img-fluid">
												</div>
												<div class="row no-gutters rounded-img">
													<div class="col-3">
														<img src="images/1.jpeg" alt="" class="img-fluid">
													</div>
													<div class="col-3">
														<img src="images/2.jpeg" alt="" class="img-fluid">
													</div>
													<div class="col-3">
														<img src="images/3.jpg" alt="" class="img-fluid">
													</div>
													<div class="col-3">
														<img src="images/pexels-photo-4066291.jpeg" alt="" class="img-fluid">
													</div>
												</div>
												<div class="d-flex popular-content-hover mt-3">
													<div class="popular-content-text">
														<a href="">lorem ispum</a>
													</div>
											    <div class="icon-photo-one ml-auto">
				                    <i class="far fa-images"></i> <small class="photos-count">1.5k</small>
				                  </div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="single__tab  third">
								<div class="container">
									<div class="row mb-4">
										<div class="col-12">
											<h1 class="discover">
												Discover
											</h1>
											<div class="d-flex">
												<div class="">
													<h1 class="popular-title">
														Popular Images
													</h1>
												</div>
												<div class="ml-auto align-self-center">
													<a href="" class="btn-see-all">See All</a>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-4 popular-images-box">
											<div class="">
												<div class="rounded-img">
													<img src="images/pexels-photo-4066291.jpeg" alt="" class="img-fluid">
												</div>
												<div class="row no-gutters rounded-img">
													<div class="col-3">
														<img src="images/1.jpeg" alt="" class="img-fluid">
													</div>
													<div class="col-3">
														<img src="images/2.jpeg" alt="" class="img-fluid">
													</div>
													<div class="col-3">
														<img src="images/3.jpg" alt="" class="img-fluid">
													</div>
													<div class="col-3">
														<img src="images/pexels-photo-4066291.jpeg" alt="" class="img-fluid">
													</div>
												</div>
												<div class="d-flex popular-content-hover mt-3">
													<div class="popular-content-text">
														<a href="">lorem ispum</a>
													</div>
											    <div class="icon-photo-one ml-auto">
				                    <i class="far fa-images"></i> <small class="photos-count">1.5k</small>
				                  </div>
												</div>
											</div>
										</div>
										<div class="col-md-4 popular-images-box">
											<div class="">
												<div class="rounded-img">
													<img src="images/1.jpeg" alt="" class="img-fluid">
												</div>
												<div class="row no-gutters rounded-img">
													<div class="col-3">
														<img src="images/1.jpeg" alt="" class="img-fluid">
													</div>
													<div class="col-3">
														<img src="images/2.jpeg" alt="" class="img-fluid">
													</div>
													<div class="col-3">
														<img src="images/3.jpg" alt="" class="img-fluid">
													</div>
													<div class="col-3">
														<img src="images/pexels-photo-4066291.jpeg" alt="" class="img-fluid">
													</div>
												</div>
												<div class="d-flex popular-content-hover mt-3">
													<div class="popular-content-text">
														<a href="">lorem ispum</a>
													</div>
											    <div class="icon-photo-one ml-auto">
				                    <i class="far fa-images"></i> <small class="photos-count">1.5k</small>
				                  </div>
												</div>
											</div>
										</div>
										<div class="col-md-4 popular-images-box">
											<div class="">
												<div class="rounded-img">
													<img src="images/3.jpg" alt="" class="img-fluid">
												</div>
												<div class="row no-gutters rounded-img">
													<div class="col-3">
														<img src="images/1.jpeg" alt="" class="img-fluid">
													</div>
													<div class="col-3">
														<img src="images/2.jpeg" alt="" class="img-fluid">
													</div>
													<div class="col-3">
														<img src="images/3.jpg" alt="" class="img-fluid">
													</div>
													<div class="col-3">
														<img src="images/pexels-photo-4066291.jpeg" alt="" class="img-fluid">
													</div>
												</div>
												<div class="d-flex popular-content-hover mt-3">
													<div class="popular-content-text">
														<a href="">lorem ispum</a>
													</div>
											    <div class="icon-photo-one ml-auto">
				                    <i class="far fa-images"></i> <small class="photos-count">1.5k</small>
				                  </div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="container">
									<div class="row mb-4 mt-4">
										<div class="col-12">
											<div class="d-flex">
												<div class="">
													<h1 class="popular-title">
														Popular Images
													</h1>
												</div>
												<div class="ml-auto align-self-center">
													<a href="" class="btn-see-all">See All</a>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-4 popular-images-box">
											<div class="">
												<div class="rounded-img">
													<img src="images/pexels-photo-4066291.jpeg" alt="" class="img-fluid">
												</div>
												<div class="row no-gutters rounded-img">
													<div class="col-3">
														<img src="images/1.jpeg" alt="" class="img-fluid">
													</div>
													<div class="col-3">
														<img src="images/2.jpeg" alt="" class="img-fluid">
													</div>
													<div class="col-3">
														<img src="images/3.jpg" alt="" class="img-fluid">
													</div>
													<div class="col-3">
														<img src="images/pexels-photo-4066291.jpeg" alt="" class="img-fluid">
													</div>
												</div>
												<div class="d-flex popular-content-hover mt-3">
													<div class="popular-content-text">
														<a href="">lorem ispum</a>
													</div>
											    <div class="icon-photo-one ml-auto">
				                    <i class="far fa-images"></i> <small class="photos-count">1.5k</small>
				                  </div>
												</div>
											</div>
										</div>
										<div class="col-md-4 popular-images-box">
											<div class="">
												<div class="rounded-img">
													<img src="images/1.jpeg" alt="" class="img-fluid">
												</div>
												<div class="row no-gutters rounded-img">
													<div class="col-3">
														<img src="images/1.jpeg" alt="" class="img-fluid">
													</div>
													<div class="col-3">
														<img src="images/2.jpeg" alt="" class="img-fluid">
													</div>
													<div class="col-3">
														<img src="images/3.jpg" alt="" class="img-fluid">
													</div>
													<div class="col-3">
														<img src="images/pexels-photo-4066291.jpeg" alt="" class="img-fluid">
													</div>
												</div>
												<div class="d-flex popular-content-hover mt-3">
													<div class="popular-content-text">
														<a href="">lorem ispum</a>
													</div>
											    <div class="icon-photo-one ml-auto">
				                    <i class="far fa-images"></i> <small class="photos-count">1.5k</small>
				                  </div>
												</div>
											</div>
										</div>
										<div class="col-md-4 popular-images-box">
											<div class="">
												<div class="rounded-img">
													<img src="images/3.jpg" alt="" class="img-fluid">
												</div>
												<div class="row no-gutters rounded-img">
													<div class="col-3">
														<img src="images/1.jpeg" alt="" class="img-fluid">
													</div>
													<div class="col-3">
														<img src="images/2.jpeg" alt="" class="img-fluid">
													</div>
													<div class="col-3">
														<img src="images/3.jpg" alt="" class="img-fluid">
													</div>
													<div class="col-3">
														<img src="images/pexels-photo-4066291.jpeg" alt="" class="img-fluid">
													</div>
												</div>
												<div class="d-flex popular-content-hover mt-3">
													<div class="popular-content-text">
														<a href="">lorem ispum</a>
													</div>
											    <div class="icon-photo-one ml-auto">
				                    <i class="far fa-images"></i> <small class="photos-count">1.5k</small>
				                  </div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="single__tab  fourth">
								<div class="container">
									<div class="row mb-4">
										<div class="col-12">
											<h1 class="discover">
												Discover
											</h1>
											<div class="d-flex">
												<div class="">
													<h1 class="popular-title">
														Popular Images
													</h1>
												</div>
												<div class="ml-auto align-self-center">
													<a href="" class="btn-see-all">See All</a>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-4 popular-images-box">
											<div class="">
												<div class="rounded-img">
													<img src="images/pexels-photo-4066291.jpeg" alt="" class="img-fluid">
												</div>
												<div class="row no-gutters rounded-img">
													<div class="col-3">
														<img src="images/1.jpeg" alt="" class="img-fluid">
													</div>
													<div class="col-3">
														<img src="images/2.jpeg" alt="" class="img-fluid">
													</div>
													<div class="col-3">
														<img src="images/3.jpg" alt="" class="img-fluid">
													</div>
													<div class="col-3">
														<img src="images/pexels-photo-4066291.jpeg" alt="" class="img-fluid">
													</div>
												</div>
												<div class="d-flex popular-content-hover mt-3">
													<div class="popular-content-text">
														<a href="">lorem ispum</a>
													</div>
											    <div class="icon-photo-one ml-auto">
				                    <i class="far fa-images"></i> <small class="photos-count">1.5k</small>
				                  </div>
												</div>
											</div>
										</div>
										<div class="col-md-4 popular-images-box">
											<div class="">
												<div class="rounded-img">
													<img src="images/1.jpeg" alt="" class="img-fluid">
												</div>
												<div class="row no-gutters rounded-img">
													<div class="col-3">
														<img src="images/1.jpeg" alt="" class="img-fluid">
													</div>
													<div class="col-3">
														<img src="images/2.jpeg" alt="" class="img-fluid">
													</div>
													<div class="col-3">
														<img src="images/3.jpg" alt="" class="img-fluid">
													</div>
													<div class="col-3">
														<img src="images/pexels-photo-4066291.jpeg" alt="" class="img-fluid">
													</div>
												</div>
												<div class="d-flex popular-content-hover mt-3">
													<div class="popular-content-text">
														<a href="">lorem ispum</a>
													</div>
											    <div class="icon-photo-one ml-auto">
				                    <i class="far fa-images"></i> <small class="photos-count">1.5k</small>
				                  </div>
												</div>
											</div>
										</div>
										<div class="col-md-4 popular-images-box">
											<div class="">
												<div class="rounded-img">
													<img src="images/3.jpg" alt="" class="img-fluid">
												</div>
												<div class="row no-gutters rounded-img">
													<div class="col-3">
														<img src="images/1.jpeg" alt="" class="img-fluid">
													</div>
													<div class="col-3">
														<img src="images/2.jpeg" alt="" class="img-fluid">
													</div>
													<div class="col-3">
														<img src="images/3.jpg" alt="" class="img-fluid">
													</div>
													<div class="col-3">
														<img src="images/pexels-photo-4066291.jpeg" alt="" class="img-fluid">
													</div>
												</div>
												<div class="d-flex popular-content-hover mt-3">
													<div class="popular-content-text">
														<a href="">lorem ispum</a>
													</div>
											    <div class="icon-photo-one ml-auto">
				                    <i class="far fa-images"></i> <small class="photos-count">1.5k</small>
				                  </div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="container">
									<div class="row mb-4 mt-4">
										<div class="col-12">
											<div class="d-flex">
												<div class="">
													<h1 class="popular-title">
														Popular Images
													</h1>
												</div>
												<div class="ml-auto align-self-center">
													<a href="" class="btn-see-all">See All</a>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-4 popular-images-box">
											<div class="">
												<div class="rounded-img">
													<img src="images/pexels-photo-4066291.jpeg" alt="" class="img-fluid">
												</div>
												<div class="row no-gutters rounded-img">
													<div class="col-3">
														<img src="images/1.jpeg" alt="" class="img-fluid">
													</div>
													<div class="col-3">
														<img src="images/2.jpeg" alt="" class="img-fluid">
													</div>
													<div class="col-3">
														<img src="images/3.jpg" alt="" class="img-fluid">
													</div>
													<div class="col-3">
														<img src="images/pexels-photo-4066291.jpeg" alt="" class="img-fluid">
													</div>
												</div>
												<div class="d-flex popular-content-hover mt-3">
													<div class="popular-content-text">
														<a href="">lorem ispum</a>
													</div>
											    <div class="icon-photo-one ml-auto">
				                    <i class="far fa-images"></i> <small class="photos-count">1.5k</small>
				                  </div>
												</div>
											</div>
										</div>
										<div class="col-md-4 popular-images-box">
											<div class="">
												<div class="rounded-img">
													<img src="images/1.jpeg" alt="" class="img-fluid">
												</div>
												<div class="row no-gutters rounded-img">
													<div class="col-3">
														<img src="images/1.jpeg" alt="" class="img-fluid">
													</div>
													<div class="col-3">
														<img src="images/2.jpeg" alt="" class="img-fluid">
													</div>
													<div class="col-3">
														<img src="images/3.jpg" alt="" class="img-fluid">
													</div>
													<div class="col-3">
														<img src="images/pexels-photo-4066291.jpeg" alt="" class="img-fluid">
													</div>
												</div>
												<div class="d-flex popular-content-hover mt-3">
													<div class="popular-content-text">
														<a href="">lorem ispum</a>
													</div>
											    <div class="icon-photo-one ml-auto">
				                    <i class="far fa-images"></i> <small class="photos-count">1.5k</small>
				                  </div>
												</div>
											</div>
										</div>
										<div class="col-md-4 popular-images-box">
											<div class="">
												<div class="rounded-img">
													<img src="images/3.jpg" alt="" class="img-fluid">
												</div>
												<div class="row no-gutters rounded-img">
													<div class="col-3">
														<img src="images/1.jpeg" alt="" class="img-fluid">
													</div>
													<div class="col-3">
														<img src="images/2.jpeg" alt="" class="img-fluid">
													</div>
													<div class="col-3">
														<img src="images/3.jpg" alt="" class="img-fluid">
													</div>
													<div class="col-3">
														<img src="images/pexels-photo-4066291.jpeg" alt="" class="img-fluid">
													</div>
												</div>
												<div class="d-flex popular-content-hover mt-3">
													<div class="popular-content-text">
														<a href="">lorem ispum</a>
													</div>
											    <div class="icon-photo-one ml-auto">
				                    <i class="far fa-images"></i> <small class="photos-count">1.5k</small>
				                  </div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="single__tab  fifth">
								<div class="container">
									<div class="row mb-4">
										<div class="col-12">
											<h1 class="discover">
												Discover
											</h1>
											<div class="d-flex">
												<div class="">
													<h1 class="popular-title">
														Popular Images
													</h1>
												</div>
												<div class="ml-auto align-self-center">
													<a href="" class="btn-see-all">See All</a>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-4 popular-images-box">
											<div class="">
												<div class="rounded-img">
													<img src="images/pexels-photo-4066291.jpeg" alt="" class="img-fluid">
												</div>
												<div class="row no-gutters rounded-img">
													<div class="col-3">
														<img src="images/1.jpeg" alt="" class="img-fluid">
													</div>
													<div class="col-3">
														<img src="images/2.jpeg" alt="" class="img-fluid">
													</div>
													<div class="col-3">
														<img src="images/3.jpg" alt="" class="img-fluid">
													</div>
													<div class="col-3">
														<img src="images/pexels-photo-4066291.jpeg" alt="" class="img-fluid">
													</div>
												</div>
												<div class="d-flex popular-content-hover mt-3">
													<div class="popular-content-text">
														<a href="">lorem ispum</a>
													</div>
											    <div class="icon-photo-one ml-auto">
				                    <i class="far fa-images"></i> <small class="photos-count">1.5k</small>
				                  </div>
												</div>
											</div>
										</div>
										<div class="col-md-4 popular-images-box">
											<div class="">
												<div class="rounded-img">
													<img src="images/1.jpeg" alt="" class="img-fluid">
												</div>
												<div class="row no-gutters rounded-img">
													<div class="col-3">
														<img src="images/1.jpeg" alt="" class="img-fluid">
													</div>
													<div class="col-3">
														<img src="images/2.jpeg" alt="" class="img-fluid">
													</div>
													<div class="col-3">
														<img src="images/3.jpg" alt="" class="img-fluid">
													</div>
													<div class="col-3">
														<img src="images/pexels-photo-4066291.jpeg" alt="" class="img-fluid">
													</div>
												</div>
												<div class="d-flex popular-content-hover mt-3">
													<div class="popular-content-text">
														<a href="">lorem ispum</a>
													</div>
											    <div class="icon-photo-one ml-auto">
				                    <i class="far fa-images"></i> <small class="photos-count">1.5k</small>
				                  </div>
												</div>
											</div>
										</div>
										<div class="col-md-4 popular-images-box">
											<div class="">
												<div class="rounded-img">
													<img src="images/3.jpg" alt="" class="img-fluid">
												</div>
												<div class="row no-gutters rounded-img">
													<div class="col-3">
														<img src="images/1.jpeg" alt="" class="img-fluid">
													</div>
													<div class="col-3">
														<img src="images/2.jpeg" alt="" class="img-fluid">
													</div>
													<div class="col-3">
														<img src="images/3.jpg" alt="" class="img-fluid">
													</div>
													<div class="col-3">
														<img src="images/pexels-photo-4066291.jpeg" alt="" class="img-fluid">
													</div>
												</div>
												<div class="d-flex popular-content-hover mt-3">
													<div class="popular-content-text">
														<a href="">lorem ispum</a>
													</div>
											    <div class="icon-photo-one ml-auto">
				                    <i class="far fa-images"></i> <small class="photos-count">1.5k</small>
				                  </div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="container">
									<div class="row mb-4 mt-4">
										<div class="col-12">
											<div class="d-flex">
												<div class="">
													<h1 class="popular-title">
														Popular Images
													</h1>
												</div>
												<div class="ml-auto align-self-center">
													<a href="" class="btn-see-all">See All</a>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-4 popular-images-box">
											<div class="">
												<div class="rounded-img">
													<img src="images/pexels-photo-4066291.jpeg" alt="" class="img-fluid">
												</div>
												<div class="row no-gutters rounded-img">
													<div class="col-3">
														<img src="images/1.jpeg" alt="" class="img-fluid">
													</div>
													<div class="col-3">
														<img src="images/2.jpeg" alt="" class="img-fluid">
													</div>
													<div class="col-3">
														<img src="images/3.jpg" alt="" class="img-fluid">
													</div>
													<div class="col-3">
														<img src="images/pexels-photo-4066291.jpeg" alt="" class="img-fluid">
													</div>
												</div>
												<div class="d-flex popular-content-hover mt-3">
													<div class="popular-content-text">
														<a href="">lorem ispum</a>
													</div>
											    <div class="icon-photo-one ml-auto">
				                    <i class="far fa-images"></i> <small class="photos-count">1.5k</small>
				                  </div>
												</div>
											</div>
										</div>
										<div class="col-md-4 popular-images-box">
											<div class="">
												<div class="rounded-img">
													<img src="images/1.jpeg" alt="" class="img-fluid">
												</div>
												<div class="row no-gutters rounded-img">
													<div class="col-3">
														<img src="images/1.jpeg" alt="" class="img-fluid">
													</div>
													<div class="col-3">
														<img src="images/2.jpeg" alt="" class="img-fluid">
													</div>
													<div class="col-3">
														<img src="images/3.jpg" alt="" class="img-fluid">
													</div>
													<div class="col-3">
														<img src="images/pexels-photo-4066291.jpeg" alt="" class="img-fluid">
													</div>
												</div>
												<div class="d-flex popular-content-hover mt-3">
													<div class="popular-content-text">
														<a href="">lorem ispum</a>
													</div>
											    <div class="icon-photo-one ml-auto">
				                    <i class="far fa-images"></i> <small class="photos-count">1.5k</small>
				                  </div>
												</div>
											</div>
										</div>
										<div class="col-md-4 popular-images-box">
											<div class="">
												<div class="rounded-img">
													<img src="images/3.jpg" alt="" class="img-fluid">
												</div>
												<div class="row no-gutters rounded-img">
													<div class="col-3">
														<img src="images/1.jpeg" alt="" class="img-fluid">
													</div>
													<div class="col-3">
														<img src="images/2.jpeg" alt="" class="img-fluid">
													</div>
													<div class="col-3">
														<img src="images/3.jpg" alt="" class="img-fluid">
													</div>
													<div class="col-3">
														<img src="images/pexels-photo-4066291.jpeg" alt="" class="img-fluid">
													</div>
												</div>
												<div class="d-flex popular-content-hover mt-3">
													<div class="popular-content-text">
														<a href="">lorem ispum</a>
													</div>
											    <div class="icon-photo-one ml-auto">
				                    <i class="far fa-images"></i> <small class="photos-count">1.5k</small>
				                  </div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="single__tab  six">
								<div class="container">
									<div class="row mb-4">
										<div class="col-12">
											<h1 class="discover">
												Discover
											</h1>
											<div class="d-flex">
												<div class="">
													<h1 class="popular-title">
														Popular Images
													</h1>
												</div>
												<div class="ml-auto align-self-center">
													<a href="" class="btn-see-all">See All</a>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-4 popular-images-box">
											<div class="">
												<div class="rounded-img">
													<img src="images/pexels-photo-4066291.jpeg" alt="" class="img-fluid">
												</div>
												<div class="row no-gutters rounded-img">
													<div class="col-3">
														<img src="images/1.jpeg" alt="" class="img-fluid">
													</div>
													<div class="col-3">
														<img src="images/2.jpeg" alt="" class="img-fluid">
													</div>
													<div class="col-3">
														<img src="images/3.jpg" alt="" class="img-fluid">
													</div>
													<div class="col-3">
														<img src="images/pexels-photo-4066291.jpeg" alt="" class="img-fluid">
													</div>
												</div>
												<div class="d-flex popular-content-hover mt-3">
													<div class="popular-content-text">
														<a href="">lorem ispum</a>
													</div>
											    <div class="icon-photo-one ml-auto">
				                    <i class="far fa-images"></i> <small class="photos-count">1.5k</small>
				                  </div>
												</div>
											</div>
										</div>
										<div class="col-md-4 popular-images-box">
											<div class="">
												<div class="rounded-img">
													<img src="images/1.jpeg" alt="" class="img-fluid">
												</div>
												<div class="row no-gutters rounded-img">
													<div class="col-3">
														<img src="images/1.jpeg" alt="" class="img-fluid">
													</div>
													<div class="col-3">
														<img src="images/2.jpeg" alt="" class="img-fluid">
													</div>
													<div class="col-3">
														<img src="images/3.jpg" alt="" class="img-fluid">
													</div>
													<div class="col-3">
														<img src="images/pexels-photo-4066291.jpeg" alt="" class="img-fluid">
													</div>
												</div>
												<div class="d-flex popular-content-hover mt-3">
													<div class="popular-content-text">
														<a href="">lorem ispum</a>
													</div>
											    <div class="icon-photo-one ml-auto">
				                    <i class="far fa-images"></i> <small class="photos-count">1.5k</small>
				                  </div>
												</div>
											</div>
										</div>
										<div class="col-md-4 popular-images-box">
											<div class="">
												<div class="rounded-img">
													<img src="images/3.jpg" alt="" class="img-fluid">
												</div>
												<div class="row no-gutters rounded-img">
													<div class="col-3">
														<img src="images/1.jpeg" alt="" class="img-fluid">
													</div>
													<div class="col-3">
														<img src="images/2.jpeg" alt="" class="img-fluid">
													</div>
													<div class="col-3">
														<img src="images/3.jpg" alt="" class="img-fluid">
													</div>
													<div class="col-3">
														<img src="images/pexels-photo-4066291.jpeg" alt="" class="img-fluid">
													</div>
												</div>
												<div class="d-flex popular-content-hover mt-3">
													<div class="popular-content-text">
														<a href="">lorem ispum</a>
													</div>
											    <div class="icon-photo-one ml-auto">
				                    <i class="far fa-images"></i> <small class="photos-count">1.5k</small>
				                  </div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="container">
									<div class="row mb-4 mt-4">
										<div class="col-12">
											<div class="d-flex">
												<div class="">
													<h1 class="popular-title">
														Popular Images
													</h1>
												</div>
												<div class="ml-auto align-self-center">
													<a href="" class="btn-see-all">See All</a>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-4 popular-images-box">
											<div class="">
												<div class="rounded-img">
													<img src="images/pexels-photo-4066291.jpeg" alt="" class="img-fluid">
												</div>
												<div class="row no-gutters rounded-img">
													<div class="col-3">
														<img src="images/1.jpeg" alt="" class="img-fluid">
													</div>
													<div class="col-3">
														<img src="images/2.jpeg" alt="" class="img-fluid">
													</div>
													<div class="col-3">
														<img src="images/3.jpg" alt="" class="img-fluid">
													</div>
													<div class="col-3">
														<img src="images/pexels-photo-4066291.jpeg" alt="" class="img-fluid">
													</div>
												</div>
												<div class="d-flex popular-content-hover mt-3">
													<div class="popular-content-text">
														<a href="">lorem ispum</a>
													</div>
											    <div class="icon-photo-one ml-auto">
				                    <i class="far fa-images"></i> <small class="photos-count">1.5k</small>
				                  </div>
												</div>
											</div>
										</div>
										<div class="col-md-4 popular-images-box">
											<div class="">
												<div class="rounded-img">
													<img src="images/1.jpeg" alt="" class="img-fluid">
												</div>
												<div class="row no-gutters rounded-img">
													<div class="col-3">
														<img src="images/1.jpeg" alt="" class="img-fluid">
													</div>
													<div class="col-3">
														<img src="images/2.jpeg" alt="" class="img-fluid">
													</div>
													<div class="col-3">
														<img src="images/3.jpg" alt="" class="img-fluid">
													</div>
													<div class="col-3">
														<img src="images/pexels-photo-4066291.jpeg" alt="" class="img-fluid">
													</div>
												</div>
												<div class="d-flex popular-content-hover mt-3">
													<div class="popular-content-text">
														<a href="">lorem ispum</a>
													</div>
											    <div class="icon-photo-one ml-auto">
				                    <i class="far fa-images"></i> <small class="photos-count">1.5k</small>
				                  </div>
												</div>
											</div>
										</div>
										<div class="col-md-4 popular-images-box">
											<div class="">
												<div class="rounded-img">
													<img src="images/3.jpg" alt="" class="img-fluid">
												</div>
												<div class="row no-gutters rounded-img">
													<div class="col-3">
														<img src="images/1.jpeg" alt="" class="img-fluid">
													</div>
													<div class="col-3">
														<img src="images/2.jpeg" alt="" class="img-fluid">
													</div>
													<div class="col-3">
														<img src="images/3.jpg" alt="" class="img-fluid">
													</div>
													<div class="col-3">
														<img src="images/pexels-photo-4066291.jpeg" alt="" class="img-fluid">
													</div>
												</div>
												<div class="d-flex popular-content-hover mt-3">
													<div class="popular-content-text">
														<a href="">lorem ispum</a>
													</div>
											    <div class="icon-photo-one ml-auto">
				                    <i class="far fa-images"></i> <small class="photos-count">1.5k</small>
				                  </div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	<!-- <section class="popular-musics">
		<div class="container">
			<div class="row mb-4">
				<div class="col-12">
					<div class="d-flex">
						<div class="">
							<h1 class="popular-title">
								Popular Musics
							</h1>
						</div>
						<div class="ml-auto align-self-center">
							<a href="" class="btn-see-all">See All</a>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-12">
					<div class="audio-song-box">
						<div class="audio-head d-flex">
							<h1 class="align-self-end">1 . Lorem ipsum dolor</h1>
							<div class="audio-icons ml-auto d-flex align-self-center">
								<a href="" class="icon-one"><i class="fas fa-download"></i></a>
								<a href="" class="icon-one"><i class="fas fa-heart"></i></a>
								<a href="" class="buy-track"><i class="fas fa-shopping-cart"></i> Buy Track</a>
							</div>
						</div>
						<audio controls class="audio-one">
							<source src="https://ia800905.us.archive.org/19/items/FREE_background_music_dhalius/backsound.mp3"  type="audio/mp3">
						</audio>
					</div>

						<div class="audio-song-box">
						<div class="audio-head d-flex">
							<h1 class="align-self-end">1 . Lorem ipsum dolor</h1>
							<div class="audio-icons ml-auto d-flex align-self-center">
								<a href="" class="icon-one"><i class="fas fa-download"></i></a>
								<a href="" class="icon-one"><i class="fas fa-heart"></i></a>
								<a href="" class="buy-track"><i class="fas fa-shopping-cart"></i> Buy Track</a>
							</div>
						</div>
						<audio controls class="audio-one">
							<source src="https://ia800905.us.archive.org/19/items/FREE_background_music_dhalius/backsound.mp3"  type="audio/mp3">
						</audio>
					</div>

						<div class="audio-song-box">
						<div class="audio-head d-flex">
							<h1 class="align-self-end">1 . Lorem ipsum dolor</h1>
							<div class="audio-icons ml-auto d-flex align-self-center">
								<a href="" class="icon-one"><i class="fas fa-download"></i></a>
								<a href="" class="icon-one"><i class="fas fa-heart"></i></a>
								<a href="" class="buy-track"><i class="fas fa-shopping-cart"></i> Buy Track</a>
							</div>
						</div>
						<audio controls class="audio-one">
							<source src="https://ia800905.us.archive.org/19/items/FREE_background_music_dhalius/backsound.mp3"  type="audio/mp3">
						</audio>
					</div>

						<div class="audio-song-box">
						<div class="audio-head d-flex">
							<h1 class="align-self-end">1 . Lorem ipsum dolor</h1>
							<div class="audio-icons ml-auto d-flex align-self-center">
								<a href="" class="icon-one"><i class="fas fa-download"></i></a>
								<a href="" class="icon-one"><i class="fas fa-heart"></i></a>
								<a href="" class="buy-track"><i class="fas fa-shopping-cart"></i> Buy Track</a>
							</div>
						</div>
						<audio controls class="audio-one">
							<source src="https://ia800905.us.archive.org/19/items/FREE_background_music_dhalius/backsound.mp3"  type="audio/mp3">
						</audio>
					</div>
				</div>
			</div>
		</div>
	</section> -->

	<section class="third">
		<div class="container">
			<div class="box-new">
				<div class="row">
					<div class="col-md-5 aos-init" >
		    			<div class="owl-carousel slide owl-theme">
    						<div class="item">
								<div class="inner-img">
									<!-- <img src="{{ asset('custom-css/images/p-3.png') }}" class="img-fluid"> -->
									<img src="{{ url('/') }}/public/home_page/sections_assets/{{ $homePageSettings->section1_image }}" class="img-fluid">
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-7 aos-init" >
						<div class="inner-text">
							<h1>{{ $homePageSettings->section1_heading }}</h1>
							<p>{{ $homePageSettings->section1_description }} </p>
							<a class="theme-btn" href="{{ $homePageSettings->section1_button_link }}">{{ $homePageSettings->section1_button_text }}</a>
						</div>
					</div>
				</div>
			</div>
			<div class="box-new">
				<div class="row">
					<div class="col-md-7 aos-init" >
						<div class="inner-text2">
							<h1>{{ $homePageSettings->section2_heading }}</h1>
							<p>{{ $homePageSettings->section2_description }}</p>
							<a class="theme-btn" href="{{ $homePageSettings->section2_button_text }}">{{ $homePageSettings->section2_button_text }}</a>
						</div>
					</div>
					<div class="col-md-5">

		    			<div class="owl-carousel slide owl-theme">
							<div class="item">
								<div class="inner-img aos-init" >
									<!-- <img src="{{ asset('custom-css/images/p-2.png') }}" class="img-fluid"> -->
									<img src="{{ url('/') }}/public/home_page/sections_assets/{{ $homePageSettings->section2_image }}" class="img-fluid">
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="box-new">
				<div class="row">
					<div class="col-md-5 aos-init" >
		    			<div class="owl-carousel slide owl-theme">
    						<div class="item">
								<div class="inner-img">
									<!-- <img src="{{ asset('custom-css/images/p-3.png') }}" class="img-fluid"> -->
									<img src="{{ url('/') }}/public/home_page/sections_assets/{{ $homePageSettings->section3_image }}" class="img-fluid">
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-7 aos-init" >
						<div class="inner-text">
							<h1>{{ $homePageSettings->section3_heading }}</h1>
							<p>{{ $homePageSettings->section3_description }} </p>
							<a class="theme-btn" href="{{ $homePageSettings->section3_button_link }}">{{ $homePageSettings->section3_button_text }}</a>
						</div>
					</div>
				</div>
			</div>
			<div class="box-new">
				<div class="row">
					<div class="col-md-7 aos-init" >
						<div class="inner-text2">
							<h1>{{ $homePageSettings->section4_heading }}</h1>
							<p>{{ $homePageSettings->section4_description }} </p>
							<a class="theme-btn" href="{{ $homePageSettings->section4_button_link }}">{{ $homePageSettings->section4_button_text }}</a>
						</div>
					</div>
					<div class="col-md-5">
		    			<div class="owl-carousel slide owl-theme">
    						<div class="item">
								<div class="inner-img aos-init">
									<!-- <img src="{{ asset('custom-css/images/p-4.png') }}" class="img-fluid"> -->
									<img src="{{ url('/') }}/public/home_page/sections_assets/{{ $homePageSettings->section4_image }}" class="img-fluid">
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="section-popular mb-5">
		<div class="container">
			<div class="row mb-4">
				<div class="col-12">
					<div class="d-flex">
						<div class="">
							<h1 class="popular-title">Popular Artist</h1>
						</div>
						<div class="ml-auto align-self-center">
							<a class="btn-see-all" href="">See All</a>
						</div>
					</div>
				</div>
			</div>
			<div class="row slider-home">
				<div class="col-md-4 photographer-box">
					<div class="">
						<div class="photographer-img"><img alt="" class="img-fluid" src="{{ asset('custom-css/images/img-1.png') }}"></div>
						<div class="d-flex justify-content-center">
							<div class="photographer-person-img text-center"><img alt="" src="{{ asset('custom-css/images/img-2.png') }}"></div>
							<div class="icon-photo">
								<i class="far fa-images"></i> <small class="photos-count">1.5k</small>
							</div>
						</div>
						<div class="d-flex photographer-info">
							<div class="">
								<h2 class="photographer-name">Daniel Chriss</h2><small>Photographer</small>
							</div>
							<div class="ml-auto mt-4">
								<a class="btn-hire-me" href="">hire me</a>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-4 photographer-box">
					<div class="">
						<div class="photographer-img"><img alt="" class="img-fluid" src="{{ asset('custom-css/images/img-1.png') }}"></div>
						<div class="d-flex justify-content-center">
							<div class="photographer-person-img text-center"><img alt="" src="{{ asset('custom-css/images/img-2.png') }}"></div>
							<div class="icon-photo">
								<i class="far fa-images"></i> <small class="photos-count">1.5k</small>
							</div>
						</div>
						<div class="d-flex photographer-info">
							<div class="">
								<h2 class="photographer-name">Daniel Chriss</h2><small>Musician</small>
							</div>
							<div class="ml-auto mt-4">
								<a class="btn-hire-me" href="">hire me</a>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-4 photographer-box">
					<div class="">
						<div class="photographer-img"><img alt="" class="img-fluid" src="{{ asset('custom-css/images/img-1.png') }}"></div>
						<div class="d-flex justify-content-center">
							<div class="photographer-person-img text-center"><img alt="" src="{{ asset('custom-css/images/img-2.png') }}"></div>
							<div class="icon-photo">
								<i class="far fa-images"></i> <small class="photos-count">1.5k</small>
							</div>
						</div>
						<div class="d-flex photographer-info">
							<div class="">
								<h2 class="photographer-name">Daniel Chriss</h2><small>Videographer</small>
							</div>
							<div class="ml-auto mt-4">
								<a class="btn-hire-me" href="">hire me</a>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-4 photographer-box">
					<div class="">
						<div class="photographer-img"><img alt="" class="img-fluid" src="{{ asset('custom-css/images/img-1.png') }}"></div>
						<div class="d-flex justify-content-center">
							<div class="photographer-person-img text-center"><img alt="" src="{{ asset('custom-css/images/img-2.png') }}"></div>
							<div class="icon-photo">
								<i class="far fa-images"></i> <small class="photos-count">1.5k</small>
							</div>
						</div>
						<div class="d-flex photographer-info">
							<div class="">
								<h2 class="photographer-name">Daniel Chriss</h2><small>Animator</small>
							</div>
							<div class="ml-auto mt-4">
								<a class="btn-hire-me" href="">hire me</a>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-4 photographer-box">
					<div class="">
						<div class="photographer-img"><img alt="" class="img-fluid" src="{{ asset('custom-css/images/img-1.png') }}"></div>
						<div class="d-flex justify-content-center">
							<div class="photographer-person-img text-center"><img alt="" src="{{ asset('custom-css/images/img-2.png') }}"></div>
							<div class="icon-photo">
								<i class="far fa-images"></i> <small class="photos-count">1.5k</small>
							</div>
						</div>
						<div class="d-flex photographer-info">
							<div class="">
								<h2 class="photographer-name">Daniel Chriss</h2><small>Photographers</small>
							</div>
							<div class="ml-auto mt-4">
								<a class="btn-hire-me" href="">hire me</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

    @endsection
