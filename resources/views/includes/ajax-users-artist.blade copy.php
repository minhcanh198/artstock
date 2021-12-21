@php
$i = 0;
@endphp
@if(count($images) > 0)
    <div class="row">
        @foreach($images as $image)
            <div class="col-md-4 mb-4">
				<div class="destinations-city-s2-box">
					<div class="destinations-city-s2-slider">
                    	@if($image->user_type_id == "1")
							@php
								$ImagesData = \DB::table('images')->where('is_type','=','image')->where('user_id','=',$image->id)->where('status','=','active')->orderBy('id','DESC')->limit(1)->get();
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
						@elseif($image->user_type_id == "3")
							@php
								$VideosData = \DB::table('images')->where('is_type','=','video')->where('user_id','=',$image->id)->where('status','=','active')->orderBy('id','DESC')->limit(1)->get();
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
						@elseif($image->user_type_id == "2")
							@php
								$VideosData = \DB::table('images')->where('is_type','=','video')->where('user_id','=',$image->id)->where('status','=','active')->orderBy('id','DESC')->limit(1)->get();
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
						@elseif($image->user_type_id == "4")
							@php
								$VideosData = \DB::table('images')->where('is_type','=','video')->where('user_id','=',$image->id)->where('status','=','active')->orderBy('id','DESC')->limit(1)->get();
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
						<h3 class="title mt-4 mb-4">{{ ($image->name != "") ? $image->name : $image->username }}</h3>
						<div class="round-image-box">
							<img src="{{ asset('avatar').'/'.$image->avatar }}" alt="" class="img-fluid">
						</div>
						<p class="mb-4">
							{{ $image->bio }}
						</p>
					</div>
					<div class="box-buttons">
						<a href="{{ url('/') . '/request-to-book?photographerId=' . $image->id }}" class="d-block w-100 btn-box-one">Request to Book {{ ($image->name != "") ? $image->name : $image->username }}</a>
						<a href="{{ url('/') . '/artist/' . $image->id }}" class="d-block w-100 btn-box-two">View Photos and Reviews</a>
					</div>
				</div>
			</div>
        @endforeach
    </div>
@else
    <div class="row">
        <div class="col-md-12 margin-top-20 margin-bottom-20">
            <div class="btn-block text-center">
                <i class="icon icon-Picture ico-no-result"></i>
            </div>
            <h3 class="margin-top-none text-center no-result no-result-mg">
            No results have been found
            </h3>
        </div>
    </div>
@endif
