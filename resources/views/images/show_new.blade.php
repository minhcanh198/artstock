@extends('new_template.layouts.app')
@section('content')
<section class="image-detail-one">
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<div class="d-flex">
					<div class="img-person mr-3">
						<img loading="lazy" src="{{ url('/')}}images/thiago-matos-184.jpeg" alt="" class="img-fluid">
					</div>
					<div class="img-person-txt align-self-center">
						<div class="d-flex">
							<div class="mr-3">
								<h3>Thiago Matos</h3>
								<h4>758 followers</h4>
							</div>
							<div class="img-person-buttons">
								<button type="" class="follow-btn">Follow</button>
								<button type="" class="follow-btn">Donate</button>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-6 ml-md-auto text-md-right mt-md-4">
				<div class="img-likes-collect-download">
					<div class="d-flex justify-content-end">
						<div class="mr-2">
							<button type="button" class="btn-likes"><i class="far fa-heart"></i>47 likes</button>
						</div>
						<div class="mr-2">
							<button type="button" class="btn-collect"><i class="fas fa-plus"></i>Collect</button>
						</div>
						<div class="d-flex">
							<div class="">
								<button type="button" class="btn-download">Download</button>
							</div>
							<div class="dropdown">
							  <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
							  </button>
							  <div class="dropdown-menu">
							    <a class="dropdown-item" href="#">Link 1</a>
							    <a class="dropdown-item" href="#">Link 2</a>
							    <a class="dropdown-item" href="#">Link 3</a>
							  </div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-12 text-center img-info-box">
				<img loading="lazy" src="images/9.png" alt="" class="img-fluid">
				<div class="d-flex justify-content-center mt-3">
					<p class="mr-4"><i class="fas fa-eye"></i>1.43k views</p>
					<p><a href=""><i class="far fa-check-circle"></i>Free to use</a></p>
				</div>
				<div class="share-info-buttons mt-3">
					<button type="" class="share">Share</button>
					<button type="" class="share">Info</button>
				</div>
			</div>
		</div>
	</div>
</section>
<div class="container mt-5">
	<h2 class="mb-4">Similar Photos</h2>
	<section id="photos" class="baguetteBoxOne gallery">

		<div class="box">
			<a href="images/9.png"><img class="img-fluid" src="images/9.png"></a>
		</div>
		<div class="box">
			<a href="images/8.png"><img class="img-fluid" src="images/8.png"></a>
		</div>
		<div class="box">
			<a href="images/7.png"><img class="img-fluid" src="images/7.png"></a>
		</div>
		<div class="box">
			<a href="images/6.png"><img class="img-fluid" src="images/6.png"></a>
		</div>
		<div class="box">
			<a href="images/5.png"><img class="img-fluid" src="images/5.png"></a>
		</div>
		<div class="box">
			<a href="images/4.png"><img class="img-fluid" src="images/4.png"></a>
		</div>
		<div class="box">
			<a href="images/3.png"><img class="img-fluid" src="images/3.png"></a>
		</div>
		<div class="box">
			<a href="images/2.png"><img class="img-fluid" src="images/2.png"></a>
		</div>
		<div class="box">
			<a href="images/9.png"><img class="img-fluid" src="images/9.png"></a>
		</div>
		<div class="box">
			<a href="images/8.png"><img class="img-fluid" src="images/8.png"></a>
		</div>
	</section>
</div>
<section class="section-popular mb-5">
<section class="section-popular mb-5">
		<div class="container">
			<div class="row mb-4">
				<div class="col-12">
					<div class="d-flex">
						<div class="">
							<h1 class="popular-title">Popular Photographers</h1>
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
						<div class="photographer-img"><img alt="" class="img-fluid" src="images/img-1.png"></div>
						<div class="d-flex justify-content-center">
							<div class="photographer-person-img text-center"><img alt="" src="images/img-2.png"></div>
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
				<div class="col-md-4 photographer-box">
					<div class="">
						<div class="photographer-img"><img alt="" class="img-fluid" src="images/img-1.png"></div>
						<div class="d-flex justify-content-center">
							<div class="photographer-person-img text-center"><img alt="" src="images/img-2.png"></div>
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
				<div class="col-md-4 photographer-box">
					<div class="">
						<div class="photographer-img"><img alt="" class="img-fluid" src="images/img-1.png"></div>
						<div class="d-flex justify-content-center">
							<div class="photographer-person-img text-center"><img alt="" src="images/img-2.png"></div>
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
				<div class="col-md-4 photographer-box">
					<div class="">
						<div class="photographer-img"><img alt="" class="img-fluid" src="images/img-1.png"></div>
						<div class="d-flex justify-content-center">
							<div class="photographer-person-img text-center"><img alt="" src="images/img-2.png"></div>
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
				<div class="col-md-4 photographer-box">
					<div class="">
						<div class="photographer-img"><img alt="" class="img-fluid" src="images/img-1.png"></div>
						<div class="d-flex justify-content-center">
							<div class="photographer-person-img text-center"><img alt="" src="images/img-2.png"></div>
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
