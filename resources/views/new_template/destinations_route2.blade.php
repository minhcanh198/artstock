@extends('new_template.layouts.app')
@section('content')
<section class="destinations-city-s1">
	<div class="container-fluid">
		<div class="row">
			@if($getRouteDetails != "")
				@if($getRouteDetails->route_img != "")
					<div class="col-md-6 pl-0">
						<img src="{{ url('/').'/img-route/'.$getRouteDetails->route_img }}" alt="" class="img-fluid img-banner-destinations-city">
					</div>
					<div class="col-md-5 align-self-center">
				@else
					<div class="col-md-8 offset-md-2 pt-4 pb-4">
				@endif
			@else
				<div class="col-md-8 offset-md-2 pt-4 pb-4">
			@endif
				<h1 class="destinations-city-title mb-4">Welcome to {{ $getRouteDetails->route_name }}! </h1>
				<p class="mb-4">
					{{ $getRouteDetails->description }}
				</p>
				<a href="" class="d-block destination-s1-link">
					View our expertly-curated Flytographer routes
				</a>
			</div>
		</div>
	</div>
</section>
<section class="destinations-rout-s2">
	<div class="container-fluid pl-5 pr-5">
		<div class="row">
			@if($getUsers != "")
				@foreach($getUsers as $usersData)
					<div class="col-md-4 mb-4">
						<div class="destinations-city-s2-box">
							<div class="destinations-city-s2-slider">
								@if($usersData->user_type_id == "1")
									@php
										$ImagesData = \DB::table('images')->where('is_type','=','image')->where('user_id','=',$usersData->id)->where('status','=','active')->orderBy('id','DESC')->limit(4)->get();
									@endphp
									@foreach($ImagesData as $imgData)
										@php
											$colors = explode(",", $imgData->colors);
											$color = $colors[0];
											if($imgData->extension == 'png' ) {
												$background = 'background: url('.url('public/img/pixel.gif').') repeat center center #e4e4e4;';
											}  else {
												$background = 'background-color: #'.$color.'';
											}
											if($settings->show_watermark == '1') {
												$thumbnail = 'public/uploads/preview/'.$imgData->preview;
											} else {
												$stockImage = App\Models\Stock::whereImagesId($imgData->id)->whereType('small')->select('name')->first();
												$thumbnail = 'public/uploads/small/'.$stockImage->name;
											}

											$watermarkedVideoPath = 'public/uploads/video/water_mark_large/';
										@endphp
										<div>
											<img src="{{ asset($thumbnail) }}" alt="" class="img-fluid destinations-city-s2-slider-img">
										</div>
									@endforeach
								@elseif($usersData->user_type_id == "3")
									@php
										$VideosData = \DB::table('images')->where('is_type','=','video')->where('user_id','=',$usersData->id)->where('status','=','active')->orderBy('id','DESC')->limit(4)->get();
									@endphp
									@foreach($VideosData as $vidData)
										@php

											$getFileName = explode(".",$vidData->thumbnail);
											$screenShotVideoPath = 'public/uploads/video/screen_shot/'. 'screen-shot-'.$getFileName[0].'.png';
										@endphp

										<div>
											<img src="{{ asset($screenShotVideoPath) }}" alt="" class="img-fluid destinations-city-s2-slider-img">
										</div>
									@endforeach
								@elseif($usersData->user_type_id == "2")
									@php
										$VideosData = \DB::table('images')->where('is_type','=','video')->where('user_id','=',$usersData->id)->where('status','=','active')->orderBy('id','DESC')->limit(4)->get();
									@endphp
									@foreach($VideosData as $vidData)
										@php

											$getFileName = explode(".",$vidData->thumbnail);
											$screenShotVideoPath = 'public/uploads/video/screen_shot/'. 'screen-shot-'.$getFileName[0].'.png';
										@endphp

										<div>
											<img src="{{ asset($screenShotVideoPath) }}" alt="" class="img-fluid destinations-city-s2-slider-img">
										</div>
									@endforeach
								@elseif($usersData->user_type_id == "4")
									@php
										$VideosData = \DB::table('images')->where('is_type','=','video')->where('user_id','=',$usersData->id)->where('status','=','active')->orderBy('id','DESC')->limit(4)->get();
									@endphp
									@foreach($VideosData as $vidData)
										@php

											$getFileName = explode(".",$vidData->thumbnail);
											$screenShotVideoPath = 'public/uploads/video/screen_shot/'. 'screen-shot-'.$getFileName[0].'.png';
										@endphp

										<div>
											<audio controls class="audio-one">
												<source src="https://ia800905.us.archive.org/19/items/FREE_background_music_dhalius/backsound.mp3"  type="audio/mp3">
											</audio>
										</div>
									@endforeach
								@else
								@endif
							</div>
							<div class="box-conten">
								<h3 class="title mt-4 mb-4">{{ ($usersData->name != "") ? $usersData->name : $usersData->username }}</h3>
								<div class="round-image-box">
									<img src="{{ asset('avatar').'/'.$usersData->avatar }}" alt="" class="img-fluid">
								</div>
								<p class="mb-4">
								{{ $usersData->bio }}
								</p>
							</div>
							<div class="box-buttons">
								<a href="{{ url('/') . '/request-to-book?photographerId=' . $usersData->id }}" class="d-block w-100 btn-box-one">Request to Book {{ ($usersData->name != "") ? $usersData->name : $usersData->username }}</a>
								<a href="{{ url('/') . '/artist/' . $usersData->id }}" class="d-block w-100 btn-box-two">View Photos and Reviews</a>
							</div>
						</div>
					</div>
				@endforeach
			@endif
		</div>
	</div>
</section>
<section class="destinations-rout-s3">
	<div class="container">
		<div class="row">
			<div class="col-md-10 offset-md-1 text-center">
				<h2 class="mb-3">
					Want to book an amazing vacation photographer for this route?
				</h2>
				<p>
					Choose one of our world-class photographers to capture your memories in Buckingham Palace & Mayfair, London. Vacation packages start at $250. Proposal packages start at $350.
				</p>
				<div class="mt-5">
					<a href="" class="btn-view-photographers">View Photographers in London</a>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection
