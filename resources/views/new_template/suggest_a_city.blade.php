@extends('new_template.layouts.app')
@section('content')
<!-- <section class="suggest-city-s1" style="background-image: url(https://dl.dropboxusercontent.com/s/mfxce4736aopmbi/flytographer.wallpaper.png?dl=0);"> -->
<section class="suggest-city-s1" style="background-image: url(<?php echo url('/').'/public/suggest_a_city/assets/'.$suggestCityPageSettings->request_background_img; ?>);">
	<div class="container">
		<div class="row">
			<div class="col-md-6 offset-md-3 bg-suggest-city-form">
					<div class="suggest-city-logo mb-5 text-center">
						<img src="{{ asset('public/img/footer_logo.png') }}" alt="" class="img-fluid"> 
					</div>
					<form method="post" action="{{ url('/') }}/destinations/request-suggest-city" id="suggestCityForm">
					@csrf
						<div class="form-group">
							<label for="country">Country</label>
							<input type="text" class="form-control" id="country" name="country" placeholder="Country">
						</div>
						<div class="form-group">
							<label for="city">City</label>
							<input type="text" class="form-control" id="city" name="city" placeholder="City">
						</div>
						<div class="form-group">
							<label for="emailAddress">Your Email</label>
							<input type="email" class="form-control" id="emailAddress" name="emailAddress" aria-describedby="emailHelp" placeholder="">
						</div>
						<div class="form-group">
							<label for="firstName">First Name</label>
							<input type="text" class="form-control" id="firstName" name="firstName" placeholder="First Name">
						</div>
						<div class="form-group">
							<label for="lastName">Last Name</label>
							<input type="text" class="form-control" id="lastName" name="lastName" placeholder="Last Name">
						</div>
						<div class="form-group">
							<label for="planned_date">Do you have any travel dates planned for this region?</label>
							<input type="date" class="form-control" id="planned_date" name="planned_date">
						</div>
						<button type="submit" class="btn-suggest-city">Submit</button>
					</form>
			</div>
		</div>
	</div>
</section>
@endsection