@php
$i = 0;
@endphp
@if(count($images) > 0)
    <div class="row">
		@foreach($images as $image)

			<div class="col-md-4 mb-4-cutom">
				<!--<div class="choose-photographer-box">-->
				<!--	<div class="header-photographer">-->
				<!--		<div class="row">-->
				<!--			<div class="col-sm-4">-->
				<!--				<img src="<?php //echo url('/'). '/public/avatar/'. $image[0]->avatar; ?>" alt="" class="set-img-size">-->
				<!--			</div>-->
				<!--			<div class="col-sm-7 offset-md-1">-->
				<!--				<h4 class="title-this">{{ $image[0]->username }}</h4>-->
				<!--					<p class="tag-one">{{ $image[0]->type_name }}</p>-->

								<!-- <p class="tag-two">Available</p> -->
				<!--			</div>-->
				<!--		</div>-->
				<!--	</div>    -->

				<!--	@if($image[0]->user_type_id == "1")-->
				<!--		<div class="bottom" style="background-image: url(<?php //echo url('/'). '/public/uploads/thumbnail/'. $image[0]->img; ?>)">-->
				<!--			<div class="row">-->
				<!--				<div class="col-5 offset-7">-->
				<!--					<a href="<?php //echo url('/'). '/artist/'. $image[0]->id; ?>" class="btn-portfolio-one mb-2">Portfolio</a>-->
				<!--					<a href="<?php //echo url('/'). '/request-to-book?photographerId='. $image[0]->id . '&cityId='. $image[0]->city_id; ?>" class="button-book-one mb-2">Book artist</a>-->
				<!--					<a href="javascript:;" class="button-chat-two" >Chat</a>-->
				<!--				</div>-->
				<!--			</div>-->
				<!--		</div>-->
				<!--	@elseif($image[0]->user_type_id == "3")-->
				<!--		<div class="bottom" style="background-image: url(<?php //echo url('/'). '/public/uploads/video/screen_shot/'. $image[0]->ScreenShot; ?>)">-->
				<!--			<div class="row">-->
				<!--				<div class="col-5 offset-7">-->
				<!--					<a href="<?php //echo url('/'). '/artist/'. $image[0]->id; ?>" class="btn-portfolio-one mb-2">Portfolio</a>-->
				<!--					<a href="<?php //echo url('/'). '/request-to-book?photographerId='. $image[0]->id . '&cityId='. $image[0]->city_id; ?>" class="button-book-one mb-2">Book artist</a>-->
				<!--					<a href="javascript:;" class="button-chat-two" >Chat</a>-->
				<!--				</div>-->
				<!--			</div>-->
				<!--		</div>-->
				<!--	@elseif($image[0]->user_type_id == "2")-->
				<!--		<div class="bottom" style="background-image: url(<?php //echo url('/'). '/public/uploads/video/screen_shot/'. $image[0]->ScreenShot; ?>)">-->
				<!--			<div class="row">-->
				<!--				<div class="col-5 offset-7">-->
				<!--					<a href="<?php //echo url('/'). '/artist/'. $image[0]->id; ?>" class="btn-portfolio-one mb-2">Portfolio</a>-->
				<!--					<a href="<?php //echo url('/'). '/request-to-book?photographerId='. $image[0]->id . '&cityId='. $image[0]->city_id; ?>" class="button-book-one mb-2">Book artist</a>-->
				<!--					<a href="javascript:;" class="button-chat-two" >Chat</a>-->
				<!--				</div>-->
				<!--			</div>-->
				<!--		</div>-->
				<!--	@elseif($image[0]->user_type_id == "4")-->
				<!--		<div class="bottom" style="background-image: url(<?php //echo url('/'). '/public/uploads/thumbnail/musicWave.png'; ?>)" >-->
				<!--			<div class="row">-->
				<!--				<div class="col-5 offset-7">-->
				<!--					<a href="<?php //echo url('/'). '/artist/'. $image[0]->id; ?>" class="btn-portfolio-one mb-2">Portfolio</a>-->
				<!--					<a href="<?php //echo url('/'). '/request-to-book?photographerId='. $image[0]->id . '&cityId='. $image[0]->city_id; ?>" class="button-book-one mb-2">Book artist</a>-->
				<!--					<a href="javascript:;" class="button-chat-two" >Chat</a>-->
				<!--				</div>-->
				<!--			</div>-->
				<!--		</div>-->
				<!--	@else-->
				<!--	@endif-->

				<!--</div>-->


				<div class="choose-photographer-box">
            		<div class="pt-4 pb-4 pl-3 pr-3">
            			<div class="">
            			    <a href="<?php echo url('/'). '/artist/'. $image[0]->id; ?>">
        					<img src="<?php echo url('/'). '/public/avatar/'. $image[0]->avatar; ?>" alt="" class="photographer-thimbnial">
        					</a>
            			    <h4 class="title-this-photographer">{{ $image[0]->username }}</h4>
                            <p class="tag-one-photographer">{{ $image[0]->type_name }}</p>
                            <p class="tag-one-photographer" style="    margin-left: 77px;">{{ $image[0]->CountryName }}</p>
                        	@if($image[0]->user_type_id == "1")
                			    <div class="mt-4" style="text-align: center;">
                			         <?php
                                        $queryGetDataById = App\Models\Images::where(['is_type' => 'image', 'user_id' => $image[0]->id])->limit(4)->get();
                                        // var_dump($userPhotographer->id);
                                        // dd(count($queryGetDataById));
                                        if(count($queryGetDataById) > 0){


                                    ?>
                    			        @foreach($queryGetDataById as $dataUserImages)
                        			        @php
                            			        if($settings->show_watermark == '1') {
                								    $thumbnail = 'public/uploads/preview/'.$dataUserImages->preview;
                								} else {
                    								$stockImage = App\Models\Stock::whereImagesId($dataUserImages->id)->whereType('small')->select('name')->first();
                    								$thumbnail = 'public/uploads/small/'.$stockImage->name;
                								}
            								@endphp

                    					    <a data-fancybox href="{{ asset($thumbnail) }}" data-id="{{$dataUserImages->id}}" data-title="{{$dataUserImages->title}}" data-description="{{$dataUserImages->description}}" data-price="{{$dataUserImages->price}}" data-typee="photo">

                                    		    <img src="{{ asset($thumbnail) }}" alt="" class="set-img-size">
                            			    </a>
                    					@endforeach
                    				<?php
                                        }else{
                                    ?>
                                    <p class="dummy-text-when-another-div-empty">
                                                No Photo Available
                                            </p>
                                    <?php
                                        }
                					?>
            					</div>
        					@elseif($image[0]->user_type_id == "3")
        					    <div class="mt-4" style="text-align: center;">
            			            <?php
                                        $queryVideosGetDataById = App\Models\Images::where(['is_type' => 'video', 'user_id' => $image[0]->id])->limit(4)->get();
                                        // var_dump($userVideographer->id);
                                        // dd(count($queryVideosGetDataById));
                                        if(count($queryVideosGetDataById) > 0){


                                    ?>
                    			        @foreach($queryVideosGetDataById as $dataUserVideos)
                        			        @php
                            			        if($settings->show_watermark == '1') {
                								    $thumbnail = 'public/uploads/preview/'.$dataUserVideos->preview;
                								} else {
                    								$stockImage = App\Models\Stock::whereImagesId($dataUserVideos->id)->whereType('small')->select('name')->first();
                    								$thumbnail = 'public/uploads/small/'.$stockImage->name;
                								}

                								$watermarkedVideoPathScreenShot = 'public/uploads/video/screen_shot/';
                								$watermarkedVideoPath = 'public/uploads/video/water_mark_large/';

                								$VideoFileScreenShotName = explode('.', $dataUserVideos->thumbnail)[0];

                								$realVideoFileName = $dataUserVideos->thumbnail;
            								@endphp

                    					    <a data-fancybox href="{{ asset($watermarkedVideoPath) }}{{ '/watermark-'.$realVideoFileName }}" data-id="{{$dataUserVideos->id}}" data-title="{{$dataUserVideos->title}}" data-description="{{$dataUserVideos->description}}" data-price="{{$dataUserVideos->price}}" data-typee="video">
                    					        <img src="{{ asset($watermarkedVideoPathScreenShot) }}{{ '/screen-shot-'.$VideoFileScreenShotName.'.png' }}" alt="" class="set-img-size">
                					        </a>
                    					@endforeach
                				    <?php
                                        }else{
                                    ?>
                                        <p class="dummy-text-when-another-div-empty">
                                            No Video Available
                                        </p>
                                    <?php
                                        }
                					?>
            					</div>
        					@elseif($image[0]->user_type_id == "2")
        					    <div class="mt-4" style="text-align: center;">
                			        <?php
                                        $queryAnimationsGetDataById = App\Models\Images::where(['is_type' => 'video', 'user_id' => $image[0]->id])->limit(4)->get();
                                        // var_dump($userAnimator->id);
                                        // dd(count($queryAnimationsGetDataById));
                                        if(count($queryAnimationsGetDataById) > 0){


                                    ?>
                    			        @foreach($queryAnimationsGetDataById as $dataUserAnimations)
                        			        @php
                            			        if($settings->show_watermark == '1') {
                								    $thumbnail = 'public/uploads/preview/'.$dataUserAnimations->preview;
                								} else {
                    								$stockImage = App\Models\Stock::whereImagesId($dataUserAnimations->id)->whereType('small')->select('name')->first();
                    								$thumbnail = 'public/uploads/small/'.$stockImage->name;
                								}

                								$watermarkedVideoPathScreenShot = 'public/uploads/video/screen_shot/';

                								$AnimationFileScreenShotName = explode('.', $dataUserAnimations->thumbnail)[0];

                								$watermarkedVideoPath = 'public/uploads/video/water_mark_large/';

                								$realVideoFileName = $dataUserAnimations->thumbnail;
            								@endphp
                    					    <a data-fancybox href="{{ asset($watermarkedVideoPath) }}{{ '/watermark-'.$realVideoFileName }}" data-id="{{$dataUserAnimations->id}}" data-title="{{$dataUserAnimations->title}}" data-description="{{$dataUserAnimations->description}}" data-price="{{$dataUserAnimations->price}}" data-typee="video">
                    					        <img src="{{ asset($watermarkedVideoPathScreenShot) }}{{ '/screen-shot-'.$AnimationFileScreenShotName.'.png' }}" alt="" class="set-img-size">
                					        </a>
                    					@endforeach
                    					<!--<img src="<?php //echo url('/')?>/public/avatar/<?php //echo $userAnimator->avatar; ?>" alt="" class="set-img-size">-->
                    					<!--<img src="<?php //echo url('/')?>/public/avatar/<?php //echo $userAnimator->avatar; ?>" alt="" class="set-img-size">-->
                    					<!--<img src="<?php //echo url('/')?>/public/avatar/<?php //echo $userAnimator->avatar; ?>" alt="" class="set-img-size">-->
                    					<?php
                                        }else{
                                    ?>
                                    <p class="dummy-text-when-another-div-empty">
                                                No Animation Available
                                            </p>
                                    <?php
                                        }
                					?>
            					</div>
        					@elseif($image[0]->user_type_id == "4")
        					    <div class="mt-4" style="text-align: center;">
            			            <?php
                                            $queryMusiciansGetDataById = App\Models\Images::where(['is_type' => 'audio', 'user_id' => $image[0]->id])->limit(1)->get();
                                            // var_dump($userMusician->id);
                                            // dd(count($queryMusiciansGetDataById));
                                            if(count($queryMusiciansGetDataById) > 0){


                                        ?>
                                			        @foreach($queryMusiciansGetDataById as $dataUserMusicians)
                                    			        @php
                                        			        if($settings->show_watermark == '1') {
                            								    $thumbnail = 'public/uploads/preview/'.$dataUserMusicians->preview;
                            								} else {
                                								$stockImage = App\Models\Stock::whereImagesId($dataUserMusicians->id)->whereType('small')->select('name')->first();
                                								$thumbnail = 'public/uploads/small/'.$stockImage->name;
                            								}

                            								$watermarkedMusicPath = 'public/uploads/audio/large/';

                        								@endphp
                                					    <!--<audio controls class="audio-one" controlsList="nodownload" oncontextmenu="return false;">-->
                                         {{-- <!--                   <source src="{{ asset($watermarkedMusicPath).'/'. $dataUserMusicians->thumbnail }}"  type="audio/mp3">--> --}}
                                         <!--               </audio> -->
                                                        <div class="wave d-flex" data-path="{{ asset('uploads/audio/large'). '/'. $dataUserMusicians->thumbnail }}">
                                                                                <div class="align-self-center music-col-2">
                                                                                    <a href="javascript:;" class="btn-music-play" id="baton-playMusic#{{ $dataUserMusicians->thumbnail}}">
                                                                                        <i class="fas fa-play"></i>
                                                                                    </a>
                                                                                    <a href="javascript:;" class="btn-music-play" id="baton-pauseMusic#{{ $dataUserMusicians->thumbnail }}" style="display: none;">
                                                                                        <i class="fas fa-pause"></i>
                                                                                    </a>
                                                                                </div>

                                                                                <div class="wave-container music-col-10"></div>
                                                                            </div>
                                					@endforeach
                                					<?php
                                            }else{
                                                ?>
                                                <p class="dummy-text-when-another-div-empty">
                                                    No Music Available
                                                </p>

                                                <?php
                                            }
                    					?>
            					</div>
        					@else
        					@endif

        			    </div>
        		    </div>
        			<div class="bottom" style="background-image: url(https://projects.hexawebstudio.com/darquise-nantel/public/uploads/thumbnail/musicWave.png)">
        				<div class="">
        					<div class="d-md-flex">
        						<!--<a href="<?php //echo url('/')?>/artist/<?php //echo $users->id; ?>" class="btn-portfolio-one w-100 mt-0">Portfolio</a>-->
        						<!--<a href="<?php //echo url('/')?>/request-to-book?photographerId=<?php //echo $users->id ;?>&cityId=<?php //echo $users->city_id; ?>" class="button-book-one w-100">Book artist</a>-->
        						<a href="<?php echo url('/'). '/artist/'. $image[0]->id; ?>" class="btn-portfolio-one w-100 mt-0">Portfolio</a>
								<!--<a href="<?php //echo url('/'). '/request-to-book?photographerId='. $image[0]->id . '&cityId='. $image[0]->city_id; ?>" class="button-book-one w-100">Book artist</a>-->
								<a href="<?php echo url('/'). '/request-to-book?photographerId='. $image[0]->id; ?>" class="button-book-one w-100">Book artist</a>
								<!--<a href="javascript:;" class="button-chat-two" >Chat</a>-->
        					</div>
        				</div>
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
