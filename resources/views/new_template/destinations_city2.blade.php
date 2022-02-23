@extends('new_template.layouts.app')
@section('content')
<section class="destinations-city-s1">
	<div class="container-fluid">
		<div class="row">
			@if($getCityDetails->city_img != "")
				<div class="col-md-6 pl-0">
					<img src="{{ url('/').'/img-city/'.$getCityDetails->city_img }}" alt="" class="img-fluid img-banner-destinations-city">
				</div>
				<div class="col-md-5 align-self-center">
			@else
				<div class="col-md-8 offset-md-2 pt-4 pb-4">
			@endif
				<h1 class="destinations-city-title mb-4">Welcome to {{ $getCityDetails->city_name }}! </h1>
				<p class="mb-4">
					{{ $getCityDetails->description }}
				</p>
				<a href="#destination-city-link" class="d-block destination-s1-link">
					View our expertly-curated Flytographer routes
				</a>
			</div>
		</div>
	</div>
</section>
<section class="destinations-city-s2">
	<div class="container-fliud pl-5 pr-5">
		<div class="row mb-4">
			<div class="col-12">
				<h2 class="destinations-city-title mb-4">
					Choose Your Photographer in {{ $getCityDetails->city_name }}
				</h2>
			</div>
		</div>
		<div class="row">
			@foreach($getUsersByCity as $usersData)
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
						<div class="box-conten text-center">
							<div class="d-flex flex-column">
								<div class="round-image-box ">
									<img src="{{ asset('avatar').'/'.$usersData->avatar }}" alt="" class="img-fluid">
								</div>
								<div class="">

									<h3 class="title ">{{ ($usersData->name != "") ? $usersData->name : $usersData->username }}</h3>
									<a href="" class="text-decoration-none">Lets Chat</a>
								</div>

								<!-- <div class="round-image-box">
									<img src="{{ asset('avatar').'/'.$usersData->avatar }}" alt="" class="img-fluid">
								</div> -->

							</div>
							<p class="mb-4 mt-3">
									{{ $usersData->bio }}
							</p>
							<div class="box-buttons">
								<a href="{{ url('/') . '/request-to-book?photographerId=' . $usersData->id . '&cityId=' . $getCityDetails->id }}" class="d-block w-100 btn-box-one">Request to Book {{ ($usersData->name != "") ? $usersData->name : $usersData->username }}</a>
								<a href="{{ url('/') . '/artist/' . $usersData->id }}" class="d-block w-100 btn-box-two">View Photos and Reviews</a>

							</div>
						</div>
						<!-- <div class="box-buttons">
							<a href="{{ url('/') . '/request-to-book?photographerId=' . $usersData->id . '&cityId=' . $getCityDetails->id }}" class="d-block w-100 btn-box-one">Request to Book {{ ($usersData->name != "") ? $usersData->name : $usersData->username }}</a>
							<a href="{{ url('/') . '/artist/' . $usersData->id }}" class="d-block w-100 btn-box-two">View Photos and Reviews</a>
						</div> -->
					</div>
				</div>
			@endforeach
		</div>
	</div>
</section>
<section class="destinations-city-s3" id="destination-city-link">
	<div class="container-fluid pl-5 pr-5">
		<div class="row mb-4">
			<div class="col-12">
				<h2 class="destinations-city-title font-size-20">Photography Destinations in {{ $getCityDetails->city_name }}</h2>
			</div>
		</div>
		<div class="row">
			@foreach($getRoutesByCity as $routesData)
				<div class="col-md-3 mb-4">
					<div class="destinations-city-s3-box">
						<!-- <p class="flag">Iconic Sights</p> -->
						<div class="img-box">
							<img src="{{ url('/').'/img-route/'.$routesData->route_img }}" alt="" class="img-fluid">
						</div>
						<div class="content-box">
							<h3 class="title text-center">
								{{ $routesData->route_name }}
							</h3>
							<a href="" class="d-block text-decorations">{{ $routesData->route_tagline }}</a>
							<!-- <div class="city-route__shoot-lengths">
								<img src="../imran_images_dummy/photo-camera.svg" width="20">
								<p>Available Shoot Lengths:<br>
								<span>90 min</span> <span class="pipe">|</span> <span>2 hours</span> <span class="pipe">|</span> <span>3 hours</span></p>
							</div> -->
							<div class="box-button mt-4">
								<a href="{{ url('/').'/destinations/'.$getCityDetails->city_slug.'/route/'.$routesData->route_slug }}" class="btn-route d-block">View Route</a>
							</div>
						</div>
					</div>
				</div>
			@endforeach
		</div>
	</div>
</section>
<div class="msg_box" style="right:50px" rel="skp">
 <div class="msg_head">Sumit Kumar Pradhan
  <div class="close-live-chat">x</div>
  <div class="minimise-chat">-</div>
 </div>
 <div class="msg_wrap">
  <div class="msg_body">
   <div class="msg-left">What is up ? </div>
   <div class="msg-right">Playing video game, you say</div>
   <div class="msg-left">can i join you ? </div>
   <div class="msg_push"></div>
  </div>
  <div class="msg_footer"><textarea class="msg_input" rows="4"></textarea></div>
 </div>
</div>
<div class="msg_box" style="right:310px;" rel="skp1" >
 <div class="msg_head">Amit Kumar Singh
  <div class="close-live-chat">x</div>
  <div class="minimise-chat">-</div>
 </div>
 <div class="msg_wrap">
  <div class="msg_body">
   <div class="msg-left">What is up ? </div>
   <div class="msg-right">Playing video game, you say</div>
   <div class="msg-left">can i join you ? </div>
   <div class="msg_push"></div>
  </div>
  <div class="msg_footer"><textarea class="msg_input" rows="4"></textarea></div>
 </div>
</div>

<div class="msg_box" style="right:570px;" rel="skp2">
 <div class="msg_head">Neeraj Tiwari
  <div class="close-live-chat">x</div>
  <div class="minimise-chat">-</div>
 </div>
 <div class="msg_wrap">
  <div class="msg_body">
   <div class="msg-left">What is up ? </div>
   <div class="msg-right">Playing video game, you say</div>
   <div class="msg-left">can i join you ? </div>
   <div class="msg_push"></div>
  </div>
  <div class="msg_footer"><textarea class="msg_input" rows="4"></textarea></div>
 </div>
</div>


<div class="msg_box" style="right:830px;" rel="skp3">
 <div class="msg_head">Sourav singh
  <div class="close-live-chat">x</div>
  <div class="minimise-chat">-</div>
  </div>
 <div class="msg_wrap">
  <div class="msg_body">
   <div class="msg-left">What is up ? </div>
   <div class="msg-right">Playing video game, you say</div>
   <div class="msg-left">can i join you ? </div>
   <div class="msg_push"></div>
  </div>
  <div class="msg_footer"><textarea class="msg_input" rows="4"></textarea></div>
 </div>
</div>

<div class="msg_box" style="right:1090px;" rel="skp4">
 <div class="msg_head">Albert rod
	 <div class="close-live-chat">x</div>
	 <div class="minimise-chat">-</div>
 </div>
 <div class="msg_wrap">
  <div class="msg_body">
   <div class="msg-left">What is up ? </div>
   <div class="msg-right">Playing video game, you say</div>
   <div class="msg-left">can i join you ? </div>
   <div class="msg_push"></div>
  </div>
  <div class="msg_footer"><textarea class="msg_input" rows="4"></textarea></div>
 </div>
</div>

@endsection
