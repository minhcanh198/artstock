@extends('new_template.layouts.app')
@section('content')
<!-- <section class="suggest-city-s1" style="background-image: url(https://dl.dropboxusercontent.com/s/mfxce4736aopmbi/flytographer.wallpaper.png?dl=0);"> -->
<section class="suggest-city-s1" style="background-image: url(<?php echo url('/').'/public/suggest_a_city/assets/'.$suggestCityPageSettings->request_thankyou_background_img; ?>);">
	<div class="container">
		<div class="row">
			<div class="col-md-6 offset-md-3 bg-suggest-city-form">
				<div class="suggest-city-logo mb-5 text-center">
					<img src="{{ asset('img/footer_logo.png') }}" alt="" class="img-fluid">
				</div>
				<div class="">
					<h2>
						<?php echo $suggestCityPageSettings->request_heading; ?>
					</h2>
					<p>
						<?php echo $suggestCityPageSettings->request_message; ?>
					</p>
				</div>
			    <div class="text-center mt-4">
			   		<a href="{{ url('/') }}" class="btn-suggest-city gohome">Go To Home</a>
			    </div>
			</div>
		</div>
	</div>
</section>
@endsection
