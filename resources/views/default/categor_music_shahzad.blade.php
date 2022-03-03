{{-- @extends('app') --}}
@extends('new_template.layouts.app')

@section('title'){{ $category->name.' - ' }}@endsection

@section('content')
<style>
.color-black {
    color: #000;
}
</style>
    <div class="jumbotron md index-header jumbotron_set jumbotron-cover" style="height:50%;">
		<div class="container wrap-jumbotron position-relative">
			<h1 class="title-site title-sm">{{ $category->name }}</h1>
			@if( $images->total() != 0 )
				<p class="subtitle-site"><strong>({{number_format($images->total())}}) {{trans_choice('misc.images_available_category',$images->total() )}}</strong></p>
			@else
				<p class="subtitle-site"><strong>{{$settings->title}}</strong></p>
			@endif

			<?php

			$categorySlug = $category->name;
			if($categorySlug == "Music" ){
		?>
				<p class="text-center" style=" color: #fff;">Need content to enhance your prototype, presentation, mockup, website or video? ArtStock is a platform where you can find free music samples to enhance your project and bring out the best.
                </p>
		<?php
			}
		?>

            <div class="row mt-5">
				<div class="col-lg-2">
				</div>
				<div class="col-lg-8">
					<form method="post" action="<?php echo url('/search-by-industry')?>">
					    @csrf
					    <div class="input-group">
                            @php
                                $urlSegment = \Request::segment(1);
                            @endphp
                            <input type="text" class="form-control mt-0 animation-banner-search-input" id="txt_search_industry" name="txt_search_industry" placeholder="Search" value="{{ (isset($q)) ? $q : '' }}">
                            <input type="hidden" class="form-control" id="txt_search_industry_id" name="txt_search_industry_id" value="{{ $category->id }}">
                            <input type="hidden" class="form-control" id="slug" name="slug" value="{{ $category->slug }}">
                            <div class="input-group-append" id="buttonSectionDiv">
                                <!-- <button class="btn btn-secondary" id="btnSubmitTxtIndustrySearch" type="submit"> -->
                                <button class="btn btn-secondary animation-banner-search-btn " type="submit">
                                    <i class="fa fa-search"></i>
                                </button>
                                @if($urlSegment == "search-by-industry")
                                <a class="btn btn-secondary" id="btnClearSearch" href="{{ url('/category/').'/'. $category->slug }}" style="border-left:1px solid;">
                                    Clear Search  <i class="fa fa-refresh"></i>
                                </a>
                                @endif

                            </div>
					    </div>
                    </form>
				</div>
				<div class="col-lg-2">
				</div>
			</div>

		</div>
    </div>

<div class="container">
    <div class="row" >
        <div class="tabs">
            <div class="tabs__navigation" data-aos="fade-down">
                @php
                    $getCategoryDetails = \DB::table('categories')->where('name','=', $category->name)->first();
                    $getCategoriesList = \DB::table('categories')->where('slug','!=', 'uncategorized')->where('parent_id','=', $getCategoryDetails->id)->take(12)->get();
                @endphp
                @foreach($getCategoriesList as $categor)
                    {{-- <!-- <button  id="buttonCategories|{{ $categor->slug }}" data-target="{{ $categor->slug }}">{{ $categor->name }}</button> --> --}}
                    <a href="{{ url('/'). '/sub-category-music/'. $categor->slug }}">{{ $categor->name }}</a>

                @endforeach
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">

            <?php

                if($images->total() != 0){
                    foreach($images as $imge){
                        $userDetails = App\Models\User::where('id','=', $imge->user_id)->first();
            ?>
                        <div class="audio-song-box Bigwave" data-path="<?php echo url('/uploads/audio/large/').'/' . $imge->thumbnail; ?>">

                            <div class="row">
                                <div class="col-md-6">
                                    <span class="d-block">
                            			<h5 class="text-overflow author-label mg-bottom-xs" title="{{ $userDetails->username }}">
                            				<img src="{{ url('/') .'/avatar/'. $userDetails->avatar }}" alt="User" class="img-circle img-circle-2">
                            				<span class="color-black">{{ $userDetails->username }}</span>
                        				</h5>
                            				<span class="timeAgo btn-block date-color text-overflow" data="{{ $imge->date }}"></span>
                            	    </span>
                                </div>
                                <div class="col-md-6">
                                    <div class="audio-icons ml-auto d-flex align-self-center justify-content-end">
                                        <!-- <a href="" class="icon-one"><i class="fas fa-download"></i></a>
                                        <a href="" class="icon-one"><i class="fas fa-heart"></i></a> -->
                                        <a href="<?php echo url('/uploads/audio/large/'). '/'. $imge->thumbnail; ?>" download="<?php echo $imge->thumbnail; ?>" class="buy-track"><span>$80</span> Buy</a>
                                        <span class="align-self-center ml-2 p-0">
            								<span class="myicon-right"><i class="fa fa-heart-o myicon-right"></i> 1</span>
                            				<span class="myicon-right"><i class="icon icon-Download myicon-right"></i> 1</span>
                            			</span><!-- Span Out -->
                                    </div>
                                </div>
                            </div>
                    	    <!--<button type="button">Play / Pause</button>-->

                    	    <div class="row music-main-page-home">

                    	        <!--<div class="col-md-12">
                        	        <audio controls>
                                      <source src="horse.ogg" type="audio/ogg">
                                      <source src="<?php echo url('/uploads/audio/large/'). '/'. $imge->thumbnail; ?>" type="audio/mpeg">
                                      Your browser does not support the audio element.
                                    </audio>
                                </div>-->

                        	    <div class="align-self-center col-md-1 text-center">
                                    <a href="javascript:;" class="btn-music-play" id="Bigbaton-playMusic#{{ $userDetails->thumbnail}}">
                                        <i class="fas fa-play"></i>
                                    </a>
                                    <a href="javascript:;" class="btn-music-play" id="Bigbaton-pauseMusic#{{ $userDetails->thumbnail }}" style="display: none;">
                                        <i class="fas fa-pause"></i>
                                    </a>
                                </div>
                    	        <div class="wave-container col-md-10 p-0"></div>

                	        </div>


                        </div>
            <?php
                    }
                }else{
            ?>
                    <div class="btn-block text-center">
	    				<i class="icon icon-Picture ico-no-result"></i>
	    			</div>

					<h3 class="margin-top-none text-center no-result no-result-mg">
						{{ trans('misc.no_results_found') }}
					</h3>
            <?php
                }
            ?>
            <?php
                if($images->total() != 0){
            ?>
                    <form method="get" action="<?php echo url('/'). '/search'; ?>">
                        <input type="hidden" name="type" value="4">
                        <input type="hidden" id="sort-Fresh" class="btn-sort-by-search" name="sort" value="Fresh">
                        <div class="music-btn text-center">
                            <button type="submit" class="theme-btn">Browse All</button>
                        </div>
                    </form>
            <?php
                }
            ?>
        </div>
    </div>

</div>
<section class="section-popular mb-5">
		<div class="container">
			<div class="row mb-4">
				<div class="col-12">
					<div class="d-flex">
						<div class="">
						<?php
							$categorySlug = $category->slug;
							if($categorySlug == "animation" ){
						?>
								<h1 class="popular-title">Popular Animators</h1>
						<?php
							}else if($categorySlug == "photo"){
						?>
								<h1 class="popular-title">Popular Photographers</h1>
						<?php
							}else if($categorySlug == "video"){
						?>
								<h1 class="popular-title">Popular Videographers</h1>
						<?php
							}else if($categorySlug == "music"){
						?>
								<h1 class="popular-title">Popular Musicians</h1>
						<?php
							}
						?>
						</div>
						<div class="ml-auto align-self-center">
							{{-- <a class="btn-see-all" href="">See All</a> --}}
						</div>
					</div>
				</div>
			</div>
			<!--<userslidercategory categorySlug=<?php //echo $category->slug; ?> sessionUser=<?php //echo (\Auth::user()) ? \Auth::user()->id : ''; ?>></userslidercategory>-->
			@php
			$categorySlug = $category->slug;

			if($categorySlug == "animation" ){
				$cateSlug = "animator";
			}else if($categorySlug == "photo" ){
				$cateSlug = "photographer";
			}else if($categorySlug == "video" ){
				$cateSlug = "videographer";
			}else if($categorySlug == "music" ){
				$cateSlug = "musician";
			}
			$allUsersCount = App\Models\User::join('types','types.types_id','=', 'users.user_type_id')->where('user_type_id','!=', '')->where('types.type_name','=',$cateSlug)->get();
			@endphp

			<!--<div class="row slider-home <?php //echo (count($allUsersCount) < 3 ) ? 'new12' : '' ?>">-->

			<carousel >
    		     <div class="owl-carousel owl-theme slider-artist-new">
				<?php
					$categorySlug = $category->slug;
					if($categorySlug == "animation"){
						$cateSlug = "animator";
						$allUsers = App\Models\User::join('types','types.types_id','=', 'users.user_type_id')->where('user_type_id','!=', '')->where('types.type_name','=',$cateSlug)->get();
						// dd($allUsers[0]->id);
						// var_dump($allUsers[0]->id);
						if(count($allUsers) > 0){
							for($UA = 0; $UA < count($allUsers); $UA++){
								$users = App\Models\User::join('types', 'types.types_id','=','users.user_type_id')->find($allUsers[$UA]->id);

								// dd($users->types()->type_name);

								$categorySlug = $category->slug;
				?>

								<div class="">



                                    <div class="mb-4-cutom">
                                        <!--<div class="choose-photographer-box" style="margin:10px;">-->
                                        <!--    <div class="header-photographer">-->
                                        <!--        <div class="row">-->
                                        <!--            <div class="col-sm-4">-->
                                        <!--                <img src="<?php echo url('/')?>/avatar/<?php echo $users->avatar; ?>" alt="" class="set-img-size" style="width:100px;">-->
                                        <!--            </div>-->
                                        <!--            <div class="col-sm-7 offset-md-1">-->
                                        <!--                <h4 class="title-this">{{ $users->username }}</h4>-->
                                        <!--                    <p class="tag-one">{{ $users->type_name }}</p>-->

                                                        <!-- <p class="tag-two">Available</p> -->
                                        <!--            </div>-->
                                        <!--        </div>-->
                                        <!--    </div>    -->
                                          <?php
                                            // dd($users->type_name);
                                            //  if($users->type_name == "Animator"){
                                            ?>
                                        <!--            <div class="bottom" style="background-image:url({{ url('/') }}/uploads/thumbnail/{{ $users->img }})">-->
                                        <!--                <div class="row">-->
                                        <!--                    <div class="col-5 offset-7">-->
                                        <!--                        <a href="<?php echo url('/')?>/artist/<?php echo $users->id; ?>" class="btn-portfolio-one mb-2">Portfolio</a>-->
                                        <!--                        <a href="<?php echo url('/')?>/request-to-book?photographerId=<?php echo $users->id ;?>&cityId=<?php echo $users->city_id; ?>" class="button-book-one mb-2">Book artist</a>-->
                                                                <!--<a href="javascript:;" v-if="suser != ''" @click="addToActiveChat(photoUser)" class="button-chat-two" >Chat</a>-->
                                        <!--                    </div>-->
                                        <!--                </div>-->
                                        <!--            </div>-->
                                            <?php
                                        //       }
                                            ?>
                                        <!--</div>-->

                                        <div class="choose-photographer-box">
                                    		<div class="pt-4 pb-4 pl-3 pr-3">
                                    			<div class="">
                                					<img src="<?php echo url('/')?>/avatar/<?php echo $users->avatar; ?>" alt="" class="photographer-thimbnial">
                                    			    <h4 class="title-this-photographer">{{ $users->username }}</h4>
                                                    <p class="tag-one-photographer">{{ $users->type_name }}</p>
                                    			    <div class="mt-4" style="text-align: center;">
                                    			        <?php
                                                            $queryAnimationsGetDataById = App\Models\Images::where(['is_type' => 'video', 'user_id' => $users->id])->limit(4)->get();
                                                            // var_dump($userAnimator->id);
                                                            // dd(count($queryAnimationsGetDataById));
                                                            if(count($queryAnimationsGetDataById) > 0){


                                                        ?>
                                        			        @foreach($queryAnimationsGetDataById as $dataUserAnimations)
                                            			        @php
                                                			        if($settings->show_watermark == '1') {
                                    								    $thumbnail = 'uploads/preview/'.$dataUserAnimations->preview;
                                    								} else {
                                        								$stockImage = App\Models\Stock::whereImagesId($dataUserAnimations->id)->whereType('small')->select('name')->first();
                                        								$thumbnail = 'uploads/small/'.$stockImage->name;
                                    								}

                                    								$watermarkedVideoPath = 'uploads/video/screen_shot/';

                                    								$AnimationFileScreenShotName = explode('.', $dataUserAnimations->thumbnail)[0];
                                								@endphp
                                        					    <img src="{{ asset($watermarkedVideoPath) }}{{ '/screen-shot-'.$AnimationFileScreenShotName.'.png' }}" alt="" class="set-img-size">
                                        					@endforeach
                                        					<!--<img src="<?php echo url('/')?>/avatar/<?php echo $userAnimator->avatar; ?>" alt="" class="set-img-size">-->
                                        					<!--<img src="<?php echo url('/')?>/avatar/<?php echo $userAnimator->avatar; ?>" alt="" class="set-img-size">-->
                                        					<!--<img src="<?php echo url('/')?>/avatar/<?php echo $userAnimator->avatar; ?>" alt="" class="set-img-size">-->
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
                                			    </div>
                                		    </div>
                                			<div class="bottom" style="background-image: url(https://projects.hexawebstudio.com/darquise-nantel/uploads/thumbnail/musicWave.png)">
                                				<div class="">
                                					<div class="d-md-flex">
                                						<a href="<?php echo url('/')?>/artist/<?php echo $users->id; ?>" class="btn-portfolio-one w-100 mt-0">Portfolio</a>
                                						<a href="<?php echo url('/')?>/request-to-book?photographerId=<?php echo $users->id ;?>&cityId=<?php echo $users->city_id; ?>" class="button-book-one w-100">Book artist</a>

                                					</div>
                                				</div>
                                			</div>
                                	    </div>
                                    </div>

                		         </div>
				<?php
							}
						}else{
				?>
							<div class="col-md-4 ">
								<div class="">

									<span>No {{ $category->name }} Artist Available</span>
								</div>
							</div>
				<?php
						}
					}else if($categorySlug == "photo"){
						$cateSlug = "photographer";
						$allUsers = App\Models\User::join('types','types.types_id','=', 'users.user_type_id')->where('user_type_id','!=', '')->where('types.type_name','=',$cateSlug)->get();
						// dd($allUsers[0]->id);
						// var_dump($allUsers[0]->id);
						if(count($allUsers) > 0){
							for($UA = 0; $UA < count($allUsers); $UA++){
								$users = App\Models\User::join('types', 'types.types_id','=','users.user_type_id')->find($allUsers[$UA]->id);
								// var_dump($category->slug);
								// dd($users);
								// dd($users);
								// dd($users->types()->type_name);

								$categorySlug = $category->slug;
				?>


								<div class="">

                                    <div class="mb-4-cutom">
                                        <!--<div class="choose-photographer-box" style="margin:10px;">-->
                                        <!--    <div class="header-photographer">-->
                                        <!--        <div class="row">-->
                                        <!--            <div class="col-sm-4">-->
                                        <!--                <img src="<?php echo url('/')?>/avatar/<?php echo $users->avatar; ?>" alt="" class="set-img-size" style="width:100px;">-->
                                        <!--            </div>-->
                                        <!--            <div class="col-sm-7 offset-md-1">-->
                                        <!--                <h4 class="title-this">{{ $users->username }}</h4>-->
                                        <!--                    <p class="tag-one">{{ $users->type_name }}</p>-->

                                                        <!-- <p class="tag-two">Available</p> -->
                                        <!--            </div>-->
                                        <!--        </div>-->
                                        <!--    </div>    -->
                                          <?php
                                            // dd($users->type_name);
                                        // <!--        if($users->type_name == "Photographer"){-->
                                            ?>
                                        <!--            <div class="bottom" style="background-image:url({{ url('/') }}/uploads/thumbnail/{{ $users->img }})">-->
                                        <!--                <div class="row">-->
                                        <!--                    <div class="col-5 offset-7">-->
                                        <!--                        <a href="<?php echo url('/')?>/artist/<?php echo $users->id; ?>" class="btn-portfolio-one mb-2">Portfolio</a>-->
                                        <!--                        <a href="<?php echo url('/')?>/request-to-book?photographerId=<?php echo $users->id ;?>&cityId=<?php echo $users->city_id; ?>" class="button-book-one mb-2">Book artist</a>-->
                                                                <!--<a href="javascript:;" v-if="suser != ''" @click="addToActiveChat(photoUser)" class="button-chat-two" >Chat</a>-->
                                        <!--                    </div>-->
                                        <!--                </div>-->
                                        <!--            </div>-->
                                            <?php
                                        //   }
                                            ?>
                                        <!--</div>-->

                                        <div class="choose-photographer-box">
                                    		<div class="pt-4 pb-4 pl-3 pr-3">
                                    			<div class="">
                                					<img src="<?php echo url('/')?>/avatar/<?php echo $users->avatar; ?>" alt="" class="photographer-thimbnial">
                                    			    <h4 class="title-this-photographer">{{ $users->username }}</h4>
                                                    <p class="tag-one-photographer">{{ $users->type_name }}</p>
                                    			    <div class="mt-4" style="text-align: center;">
                                    			         <?php
                                                            $queryGetDataById = App\Models\Images::where(['is_type' => 'image', 'user_id' => $users->id])->limit(4)->get();
                                                            // var_dump($userPhotographer->id);
                                                            // dd(count($queryGetDataById));
                                                            if(count($queryGetDataById) > 0){


                                                        ?>
                                        			        @foreach($queryGetDataById as $dataUserImages)
                                            			        @php
                                                			        if($settings->show_watermark == '1') {
                                    								    $thumbnail = 'uploads/preview/'.$dataUserImages->preview;
                                    								} else {
                                        								$stockImage = App\Models\Stock::whereImagesId($dataUserImages->id)->whereType('small')->select('name')->first();
                                        								$thumbnail = 'uploads/small/'.$stockImage->name;
                                    								}
                                								@endphp
                                        					    <img src="{{ asset($thumbnail) }}" alt="" class="set-img-size">
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
                                			    </div>
                                		    </div>
                                			<div class="bottom" style="background-image: url(https://projects.hexawebstudio.com/darquise-nantel/uploads/thumbnail/musicWave.png)">
                                				<div class="">
                                					<div class="d-md-flex">
                                						<a href="<?php echo url('/')?>/artist/<?php echo $users->id; ?>" class="btn-portfolio-one w-100 mt-0">Portfolio</a>
                                						<a href="<?php echo url('/')?>/request-to-book?photographerId=<?php echo $users->id ;?>&cityId=<?php echo $users->city_id; ?>" class="button-book-one w-100">Book artist</a>

                                					</div>
                                				</div>
                                			</div>
                                	    </div>
                                    </div>

                		         </div>
				<?php
							}
						}else{
				?>
							<div class="col-md-4 ">
								<div class="">

									<span>No {{ $category->name }} Artist Available</span>
								</div>
							</div>
				<?php
						}
					}else if($categorySlug == "video"){
						$cateSlug = "videographer";
						$allUsers = App\Models\User::join('types','types.types_id','=', 'users.user_type_id')->where('user_type_id','!=', '')->where('types.type_name','=',$cateSlug)->get();
						// dd($allUsers[0]->id);
						// var_dump($allUsers[0]->id);
						if(count($allUsers) > 0){
							for($UA = 0; $UA < count($allUsers); $UA++){
								$users = App\Models\User::join('types', 'types.types_id','=','users.user_type_id')->find($allUsers[$UA]->id);
								// dd($users->types()->type_name);

								$categorySlug = $category->slug;
				?>
								<div class="">

                                    <div class="mb-4-cutom">
                                        <!--<div class="choose-photographer-box" style="margin:10px;">-->
                                        <!--    <div class="header-photographer">-->
                                        <!--        <div class="row">-->
                                        <!--            <div class="col-sm-4">-->
                                        <!--                <img src="<?php echo url('/')?>/avatar/<?php echo $users->avatar; ?>" alt="" class="set-img-size" style="width:100px;">-->
                                        <!--            </div>-->
                                        <!--            <div class="col-sm-7 offset-md-1">-->
                                        <!--                <h4 class="title-this">{{ $users->username }}</h4>-->
                                        <!--                    <p class="tag-one">{{ $users->type_name }}</p>-->

                                                        <!-- <p class="tag-two">Available</p> -->
                                        <!--            </div>-->
                                        <!--        </div>-->
                                        <!--    </div>    -->
                                            <?php
                                            // dd($users->type_name);
                                        //   if($users->type_name == "Videographer"){
                                            ?>
                                        <!--            <div class="bottom" style="background-image:url({{ url('/') }}/uploads/thumbnail/{{ $users->img }})">-->
                                        <!--                <div class="row">-->
                                        <!--                    <div class="col-5 offset-7">-->
                                        <!--                        <a href="<?php echo url('/')?>/artist/<?php echo $users->id; ?>" class="btn-portfolio-one mb-2">Portfolio</a>-->
                                        <!--                        <a href="<?php echo url('/')?>/request-to-book?photographerId=<?php echo $users->id ;?>&cityId=<?php echo $users->city_id; ?>" class="button-book-one mb-2">Book artist</a>-->
                                                                <!--<a href="javascript:;" v-if="suser != ''" @click="addToActiveChat(photoUser)" class="button-chat-two" >Chat</a>-->
                                        <!--                    </div>-->
                                        <!--                </div>-->
                                        <!--            </div>-->
                                            <?php
                                        //   }
                                            ?>
                                        <!--</div>-->
                                        <div class="choose-photographer-box">
                                    		<div class="pt-4 pb-4 pl-3 pr-3">
                                    			<div class="">
                                					<img src="<?php echo url('/')?>/avatar/<?php echo $users->avatar; ?>" alt="" class="photographer-thimbnial">
                                    			    <h4 class="title-this-photographer">{{ $users->username }}</h4>
                                                    <p class="tag-one-photographer">{{ $users->type_name }}</p>
                                    			    <div class="mt-4" style="text-align: center;">
                                			            <?php
                                                            $queryVideosGetDataById = App\Models\Images::where(['is_type' => 'video', 'user_id' => $users->id])->limit(4)->get();
                                                            // var_dump($userVideographer->id);
                                                            // dd(count($queryVideosGetDataById));
                                                            if(count($queryVideosGetDataById) > 0){


                                                        ?>
                                        			        @foreach($queryVideosGetDataById as $dataUserVideos)
                                            			        @php
                                                			        if($settings->show_watermark == '1') {
                                    								    $thumbnail = 'uploads/preview/'.$dataUserVideos->preview;
                                    								} else {
                                        								$stockImage = App\Models\Stock::whereImagesId($dataUserVideos->id)->whereType('small')->select('name')->first();
                                        								$thumbnail = 'uploads/small/'.$stockImage->name;
                                    								}

                                    								$watermarkedVideoPath = 'uploads/video/screen_shot/';

                                    								$VideoFileScreenShotName = explode('.', $dataUserVideos->thumbnail)[0];
                                								@endphp
                                        					    <img src="{{ asset($watermarkedVideoPath) }}{{ '/screen-shot-'.$VideoFileScreenShotName.'.png' }}" alt="" class="set-img-size">
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
                                			    </div>
                                		    </div>
                                			<div class="bottom" style="background-image: url(https://projects.hexawebstudio.com/darquise-nantel/uploads/thumbnail/musicWave.png)">
                                				<div class="">
                                					<div class="d-md-flex">
                                						<a href="<?php echo url('/')?>/artist/<?php echo $users->id; ?>" class="btn-portfolio-one w-100 mt-0">Portfolio</a>
                                						<a href="<?php echo url('/')?>/request-to-book?photographerId=<?php echo $users->id ;?>&cityId=<?php echo $users->city_id; ?>" class="button-book-one w-100">Book artist</a>

                                					</div>
                                				</div>
                                			</div>
                                	    </div>
                                    </div>

                		         </div>
				<?php
							}
						}else{
				?>
							<div class="col-md-4 ">
								<div class="">

									<span>No {{ $category->name }} Artist Available</span>
								</div>
							</div>
				<?php
						}
					}else if($categorySlug == "music"){
						$cateSlug = "musician";
						$allUsers = App\Models\User::join('types','types.types_id','=', 'users.user_type_id')->where('user_type_id','!=', '')->where('types.type_name','=',$cateSlug)->get();
						// dd($allUsers[0]->id);
						// var_dump($allUsers[0]->id);
						if(count($allUsers) > 0){
							for($UA = 0; $UA < count($allUsers); $UA++){
								// $users = App\Models\User::join('types', 'types.types_id','=','users.user_type_id')->find($allUsers[$UA]->id);
								$users = App\Models\User::select('users.*','types.type_name','new_countries.name AS CountryName')->join('types', 'types.types_id','=','users.user_type_id')->join('new_countries','new_countries.id','=', 'users.country_id')->find($allUsers[$UA]->id);
								// dd($users->types()->type_name);

								$categorySlug = $category->slug;
				?>
								<div class="">

                                    <div class="mb-4-cutom">
                                        <!--<div class="choose-photographer-box" style="margin:10px;">-->
                                        <!--    <div class="header-photographer">-->
                                        <!--        <div class="row">-->
                                        <!--            <div class="col-sm-4">-->
                                        <!--                <img src="<?php echo url('/')?>/avatar/<?php echo $users->avatar; ?>" alt="" class="set-img-size" style="width:100px;">-->
                                        <!--            </div>-->
                                        <!--            <div class="col-sm-7 offset-md-1">-->
                                        <!--                <h4 class="title-this">{{ $users->username }}</h4>-->
                                        <!--                    <p class="tag-one">{{ $users->type_name }}</p>-->

                                                        <!-- <p class="tag-two">Available</p> -->
                                        <!--            </div>-->
                                        <!--        </div>-->
                                        <!--    </div>    -->
                                           <?php
                                            // dd($users->type_name);
                                            // if($users->type_name == "Musician"){
                                        ?>
                                        <!--            <div class="bottom" style="background-image:url({{ url('/') }}/uploads/thumbnail/{{ $users->img }})">-->
                                        <!--                <div class="row">-->
                                        <!--                    <div class="col-5 offset-7">-->
                                        <!--                        <a href="<?php echo url('/')?>/artist/<?php echo $users->id; ?>" class="btn-portfolio-one mb-2">Portfolio</a>-->
                                        <!--                        <a href="<?php echo url('/')?>/request-to-book?photographerId=<?php echo $users->id ;?>&cityId=<?php echo $users->city_id; ?>" class="button-book-one mb-2">Book artist</a>-->
                                                                <!--<a href="javascript:;" v-if="suser != ''" @click="addToActiveChat(photoUser)" class="button-chat-two" >Chat</a>-->
                                        <!--                    </div>-->
                                        <!--                </div>-->
                                        <!--            </div>-->
                                            <?php
                                        //  }
                                        ?>
                                        <!--</div>-->
                                        <div class="choose-photographer-box">
                                    		<div class="pt-4 pb-4 pl-3 pr-3">
                                    			<div class="">
                                					<img src="<?php echo url('/')?>/avatar/<?php echo $users->avatar; ?>" alt="" class="photographer-thimbnial">
                                    			    <h4 class="title-this-photographer">{{ $users->username }}</h4>
                                                    <p class="tag-one-photographer">{{ $users->type_name }}</p>
                                                    <p class="tag-one-photographer" style="    margin-left: 77px;">{{ $users->CountryName }}</p>
                                    			    <div class="mt-4" style="text-align: center;">
                                			            <?php
                                                                $queryMusiciansGetDataById = App\Models\Images::where(['is_type' => 'audio', 'user_id' => $users->id])->limit(1)->get();
                                                                // var_dump($userMusician->id);
                                                                // dd(count($queryMusiciansGetDataById));
                                                                if(count($queryMusiciansGetDataById) > 0){


                                                            ?>
                                                    			        @foreach($queryMusiciansGetDataById as $dataUserMusicians)
                                                        			        @php
                                                            			        if($settings->show_watermark == '1') {
                                                								    $thumbnail = 'uploads/preview/'.$dataUserMusicians->preview;
                                                								} else {
                                                    								$stockImage = App\Models\Stock::whereImagesId($dataUserMusicians->id)->whereType('small')->select('name')->first();
                                                    								$thumbnail = 'uploads/small/'.$stockImage->name;
                                                								}

                                                								$watermarkedMusicPath = 'uploads/audio/large/';

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
                                			    </div>
                                		    </div>
                                			<div class="bottom" style="background-image: url(https://projects.hexawebstudio.com/darquise-nantel/uploads/thumbnail/musicWave.png)">
                                				<div class="">
                                					<div class="d-md-flex">
                                						<a href="<?php echo url('/')?>/artist/<?php echo $users->id; ?>" class="btn-portfolio-one w-100 mt-0">Portfolio</a>
                                						<a href="<?php echo url('/')?>/request-to-book?photographerId=<?php echo $users->id ;?>&cityId=<?php echo $users->city_id; ?>" class="button-book-one w-100">Book artist</a>

                                					</div>
                                				</div>
                                			</div>
                                	    </div>
                                    </div>

                		         </div>
				<?php
							}
						}else{
				?>
							<div class="col-md-4 ">
								<div class="">

									<span>No {{ $category->name }} Artist Available</span>
								</div>
							</div>
				<?php
						}
					}
				?>

			<!--</div>-->
			    </div>



            </carousel>
		</div>
	</section>


@endsection
@section('javascript')
<script>
$(document).on('click', '#btnClearSearch', function(){
			var searchIndustryId = $("#txt_search_industry_id").val();
            var slug = $("#slug").val();
			$.ajax({
				url: baseUrl + '/search-by-industry',
				type: 'POST',
				data: {"_token": "{{ csrf_token() }}","searchIndustryId": searchIndustryId, "slug": slug},
				dataType: 'json',
				success: function(res){
					console.log(res);

				},
				error: function(){
					console.log('error while getting search result of search Music');
				}
			});
		});
</script>
@endsection
