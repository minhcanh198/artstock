{{-- @extends('app') --}}
@extends('new_template.layouts.app')

@section('title'){{ $category->name.' - ' }}@endsection

@section('content')
<style>
    .flex-images.margin-bottom-40.dataResult video {
    height: 200px;
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
					$categorySlug = $category->slug;
					if($categorySlug == "animation" ){
				?>
						<p class="text-center" style=" color: #fff;">Choose from the best animations created by our talented designers. You can hire a designer to get yourself a customized animation. </p>
				<?php
					}else if($categorySlug == "photo"){
				?>
						<p class="text-center" style=" color: #fff;">Find from thousands of photos from our expert photographers and use them under the ArtStock License. </p>
				<?php
					}else if($categorySlug == "video"){
				?>
						<p class="text-center" style=" color: #fff;">Need a video to put into your new project? You can find the best videos on ArtStock. Start your search and get what you want!</p>
				<?php
					}else if($categorySlug == "music"){
				?>
						<p class="text-center" style=" color: #fff;">Need content to enhance your prototype, presentation, mockup, website or video? ArtStock is a platform where you can find music samples from our musicians to enhance your project and bring out the best. </p>
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
				</div>
				<div class="col-lg-2">
				</div>
			</div>
		</div>
    </div>

	<div class="container-fluid margin-bottom-40">
		<div class="row" >
			<div class="tabs">
				<div class="tabs__navigation" data-aos="fade-down">
					@php
						$getCategoryDetails = \DB::table('categories')->where('name','=', $category->name)->first();
						$getCategoriesList = \DB::table('categories')->where('slug','!=', 'uncategorized')->where('parent_id','=', $getCategoryDetails->id)->orderBy('name', 'asc')->take(12)->get();
					@endphp
					@foreach($getCategoriesList as $categor)
						{{-- <!-- <button  id="buttonCategories|{{ $categor->slug }}" data-target="{{ $categor->slug }}">{{ $categor->name }}</button> --> --}}
						<a href="{{ url('/'). '/sub-category/'. $categor->slug }}">{{ $categor->name }}</a>

					@endforeach
				</div>
			</div>
		</div>
<!-- Col MD -->
<div class="col-md-12 margin-top-20 margin-bottom-20" id="DivImageFlex">

	@if( $images->total() != 0 )

	<div id="imagesFlex" class="flex-images btn-block margin-bottom-40 dataResult">
	     @include('includes.images')


	      @if( $images->count() != 0  )
			    <div class="container-paginator">
			    	{{ $images->links() }}
			    	</div>
			    	@endif

	  </div><!-- Image Flex -->



	  @else
	  <div class="btn-block text-center">
	    			<i class="icon icon-Picture ico-no-result"></i>
	    		</div>

	    		<h3 class="margin-top-none text-center no-result no-result-mg">
	    		{{ trans('misc.no_results_found') }}
	    	</h3>
	  @endif


 </div><!-- /COL MD -->

 </div><!-- container wrap-ui -->
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
				// 		dd($allUsers[0]);
						// var_dump($allUsers[0]->id);
						if(count($allUsers) > 0){
							for($UA = 0; $UA < count($allUsers); $UA++){
								$users = App\Models\User::select('users.*','types.type_name','new_countries.name AS CountryName')->join('types', 'types.types_id','=','users.user_type_id')->join('new_countries','new_countries.id','=', 'users.country_id')->find($allUsers[$UA]->id);

								// dd($users->types()->type_name);

								$categorySlug = $category->slug;
								// dd($categorySlug);
				?>

								<div class="">

                                    <div class="mb-4-cutom">
                                        <!--<div class="choose-photographer-box" style="margin:10px;">-->
                                        <!--    <div class="header-photographer">-->
                                        <!--        <div class="row">-->
                                        <!--            <div class="col-sm-4">-->
                                        <!--                <img src="<?php //echo url('/')?>/public/avatar/<?php //echo $users->avatar; ?>" alt="" class="set-img-size" style="width:100px;">-->
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
                                        // <!--        if($users->type_name == "Animator"){-->
                                        ?>
                                        <!--            <div class="bottom" style="background-image:url({{ url('/') }}/public/uploads/thumbnail/{{ $users->img }})">-->
                                        <!--                <div class="row">-->
                                        <!--                    <div class="col-5 offset-7">-->
                                        <!--                        <a href="<?php echo url('/')?>/artist/<?php echo $users->id; ?>" class="btn-portfolio-one mb-2">Portfolio</a>-->
                                        <!--                        <a href="<?php echo url('/')?>/request-to-book?photographerId=<?php echo $users->id ;?>&cityId=<?php echo $users->city_id; ?>" class="button-book-one mb-2">Book artist</a>-->
                                                                <!--<a href="javascript:;" v-if="suser != ''" @click="addToActiveChat(photoUser)" class="button-chat-two" >Chat</a>-->
                                        <!--                    </div>-->
                                        <!--                </div>-->
                                        <!--            </div>-->
                                            <?php
                                        // <!--        }-->
                                            ?>
                                        <!--</div>-->
                                        <div class="choose-photographer-box">
                                    		<div class="pt-4 pb-4 pl-3 pr-3">
                                    			<div class="">
                                    			    <a href="<?php echo url('/')?>/artist/<?php echo $users->id; ?>">
                                					<img src="<?php echo url('/')?>/avatar/<?php echo $users->avatar; ?>" alt="" class="photographer-thimbnial">
                                					</a>
                                    			    <h4 class="title-this-photographer">{{ $users->username }}</h4>
                                                    <p class="tag-one-photographer">{{ $users->type_name }}</p>
                                                    <p class="tag-one-photographer" style="    margin-left: 77px;">{{ $users->CountryName }}</p>
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
                                        					    {{-- <!--<img src="{{ asset($watermarkedVideoPath) }}{{ '/screen-shot-'.$AnimationFileScreenShotName.'.png' }}" alt="" class="set-img-size">--> --}}
                                        					    <a data-fancybox href="{{ asset($watermarkedVideoPath) }}{{ '/watermark-'.$realVideoFileName }}" data-id="{{$dataUserAnimations->id}}" data-title="{{$dataUserAnimations->title}}" data-description="{{$dataUserAnimations->description}}" data-price="{{$dataUserAnimations->price}}" data-typee="video">
                                					        <img src="{{ asset($watermarkedVideoPathScreenShot) }}{{ '/screen-shot-'.$AnimationFileScreenShotName.'.png' }}" alt="" class="set-img-size">
                            					        </a>
                                        					@endforeach
                                        					<!--<img src="<?php echo url('/')?>/public/avatar/<?php //echo $userAnimator->avatar; ?>" alt="" class="set-img-size">-->
                                        					<!--<img src="<?php echo url('/')?>/public/avatar/<?php //echo $userAnimator->avatar; ?>" alt="" class="set-img-size">-->
                                        					<!--<img src="<?php echo url('/')?>/public/avatar/<?php //echo $userAnimator->avatar; ?>" alt="" class="set-img-size">-->
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
								$users = App\Models\User::select('users.*','types.type_name','new_countries.name AS CountryName')->join('types', 'types.types_id','=','users.user_type_id')->join('new_countries','new_countries.id','=', 'users.country_id')->find($allUsers[$UA]->id);
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
                                        <!--                <img src="<?php //echo url('/')?>/public/avatar/<?php //echo $users->avatar; ?>" alt="" class="set-img-size" style="width:100px;">-->
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
                                        <!--            <div class="bottom" style="background-image:url({{ url('/') }}/public/uploads/thumbnail/{{ $users->img }})">-->
                                        <!--                <div class="row">-->
                                        <!--                    <div class="col-5 offset-7">-->
                                        <!--                        <a href="<?php echo url('/')?>/artist/<?php echo $users->id; ?>" class="btn-portfolio-one mb-2">Portfolio</a>-->
                                        <!--                        <a href="<?php echo url('/')?>/request-to-book?photographerId=<?php //echo $users->id ;?>&cityId=<?php //echo $users->city_id; ?>" class="button-book-one mb-2">Book artist</a>-->
                                                                <!--<a href="javascript:;" v-if="suser != ''" @click="addToActiveChat(photoUser)" class="button-chat-two" >Chat</a>-->
                                        <!--                    </div>-->
                                        <!--                </div>-->
                                        <!--            </div>-->
                                        <?php
                                            // }
                                        ?>
                                        <!--</div>-->
                                        <div class="choose-photographer-box">
                                    		<div class="pt-4 pb-4 pl-3 pr-3">
                                    			<div class="">
                                    			    <a href="<?php echo url('/')?>/artist/<?php echo $users->id; ?>">
                                					<img src="<?php echo url('/')?>/avatar/<?php echo $users->avatar; ?>" alt="" class="photographer-thimbnial">
                                					</a>
                                    			    <h4 class="title-this-photographer">{{ $users->username }}</h4>
                                                    <p class="tag-one-photographer">{{ $users->type_name }}</p>
                                                    <p class="tag-one-photographer" style="    margin-left: 77px;">{{ $users->CountryName }}</p>
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
                                    								    $thumbnail = 'public/uploads/preview/'.$dataUserImages->preview;
                                    								} else {
                                        								$stockImage = App\Models\Stock::whereImagesId($dataUserImages->id)->whereType('small')->select('name')->first();
                                        								$thumbnail = 'public/uploads/small/'.$stockImage->name;
                                    								}
                                								@endphp
                                        					    {{-- <!--<img src="{{ asset($thumbnail) }}" alt="" class="set-img-size">--> --}}
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
						//dd($allUsers[0]->id);
						// var_dump($allUsers[0]->id);

						//dd($allUsers->count());

						if(count($allUsers) > 0){
							for($UA = 0; $UA < count($allUsers); $UA++){
								$users = App\Models\User::select('users.*','types.type_name','new_countries.name AS CountryName')->join('types', 'types.types_id','=','users.user_type_id')->join('new_countries','new_countries.id','=', 'users.country_id')->find($allUsers[$UA]->id);
								// dd($users->types()->type_name);
								//dd($users);

								$categorySlug = $category->slug;


				                if($users){     // Created by shahzad
				?>
								<div class="">

                                    <div class="mb-4-cutom">
                                        <?php /* ?>  <!-- Big Comment By Shahzad -->
                                        <!--<div class="choose-photographer-box" style="margin:10px;">-->
                                        <!--    <div class="header-photographer">-->
                                        <!--        <div class="row">-->
                                        <!--            <div class="col-sm-4">-->
                                        <!--                <img src="<?php //echo url('/')?>/public/avatar/<?php //echo $users->avatar; ?>" alt="" class="set-img-size" style="width:100px;">-->
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
                                        // <!--        if($users->type_name == "Videographer"){-->
                                        ?>
                                        <!--            <div class="bottom" style="background-image:url({{ url('/') }}/public/uploads/thumbnail/{{ $users->img }})">-->
                                        <!--                <div class="row">-->
                                        <!--                    <div class="col-5 offset-7">-->
                                        <!--                        <a href="<?php echo url('/')?>/artist/<?php echo $users->id; ?>" class="btn-portfolio-one mb-2">Portfolio</a>-->
                                        <!--                        <a href="<?php echo url('/')?>/request-to-book?photographerId=<?php //echo $users->id ;?>&cityId=<?php //echo $users->city_id; ?>" class="button-book-one mb-2">Book artist</a>-->
                                                                <!--<a href="javascript:;" v-if="suser != ''" @click="addToActiveChat(photoUser)" class="button-chat-two" >Chat</a>-->
                                        <!--                    </div>-->
                                        <!--                </div>-->
                                        <!--            </div>-->
                                          <?php
                                                // }
                                            ?>
                                        <!--</div>-->

                                        <?php */ ?>

                                        <?php //dd($users); ?>

                                        <div class="choose-photographer-box">
                                    		<div class="pt-4 pb-4 pl-3 pr-3">
                                    			<div class="">
                                    			    <a href="<?php echo url('/')?>/artist/<?php echo $users->id; ?>">
                                					<img src="<?php echo url('/')?>/avatar/<?php echo $users->avatar; ?>" alt="" class="photographer-thimbnial">
                                					</a>
                                    			    <h4 class="title-this-photographer">{{ $users->username }}</h4>
                                                    <p class="tag-one-photographer">{{ $users->type_name }}</p>
                                                    <p class="tag-one-photographer" style="    margin-left: 77px;">{{ $users->CountryName }}</p>
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
                                        					    {{-- <!--<img src="{{ asset($watermarkedVideoPath) }}{{ '/screen-shot-'.$VideoFileScreenShotName.'.png' }}" alt="" class="set-img-size">--> --}}

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
					} elseif($categorySlug == "music"){
						$cateSlug = "musician";
						$allUsers = App\Models\User::join('types','types.types_id','=', 'users.user_type_id')->where('user_type_id','!=', '')->where('types.type_name','=',$cateSlug)->get();
						if(count($allUsers) > 0){
							for($UA = 0; $UA < count($allUsers); $UA++){
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
                                        <!--                <img src="<?php //echo url('/')?>/public/avatar/<?php //echo $users->avatar; ?>" alt="" class="set-img-size" style="width:100px;">-->
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
                                        // <!--        if($users->type_name == "Musician"){-->
                                            ?>
                                        <!--            <div class="bottom" style="background-image:url({{ url('/') }}/public/uploads/thumbnail/{{ $users->img }})">-->
                                        <!--                <div class="row">-->
                                        <!--                    <div class="col-5 offset-7">-->
                                        <!--                        <a href="<?php echo url('/')?>/artist/<?php //echo $users->id; ?>" class="btn-portfolio-one mb-2">Portfolio</a>-->
                                        <!--                        <a href="<?php echo url('/')?>/request-to-book?photographerId=<?php //echo $users->id ;?>&cityId=<?php //echo $users->city_id; ?>" class="button-book-one mb-2">Book artist</a>-->
                                                                <!--<a href="javascript:;" v-if="suser != ''" @click="addToActiveChat(photoUser)" class="button-chat-two" >Chat</a>-->
                                        <!--                    </div>-->
                                        <!--                </div>-->
                                        <!--            </div>-->
                                        <?php
                                        // <!--        }-->
                                            ?>
                                        <!--</div>-->
                                        <div class="choose-photographer-box">
                                    		<div class="pt-4 pb-4 pl-3 pr-3">
                                    			<div class="">
                                    			    <a href="<?php echo url('/')?>/artist/<?php echo $users->id; ?>">
                                					<img src="<?php echo url('/')?>/avatar/<?php echo $users->avatar; ?>" alt="" class="photographer-thimbnial">
                                					</a>
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

<script type="text/javascript">

$("#btnSubmitTxtIndustrySearch").click(function(){
			var searchIndustryValue = $("#txt_search_industry").val();
			var searchIndustryId = $("#txt_search_industry_id").val();
			console.log(baseUrl);
			$.ajax({
				url: baseUrl + '/search-by-industry',
				type: 'POST',
				data: {"_token": "{{ csrf_token() }}", "searchIndustryValue" : searchIndustryValue, "searchIndustryId": searchIndustryId},
				dataType: 'json',
				success: function(res){
					console.log(res);
					// console.log(res.images.length);
					$("#buttonSectionDiv #btnClearSearch").remove();
					const baseUrl = '<?php echo url("/")?>';
					if(res.images.length > 0){
						var html = '';

						html += '<div id="imagesFlex" class="flex-images btn-block margin-bottom-40 dataResult">';
						$.each(res.images , function( index, value ) {

							var imgColor = value.colors;
							var color = imgColor.split(",")[0];

							if(value.extension == "png"){
								var background = 'background : url('+ baseUrl + 'public/img/pixel.gif' + ') repeat center center #e4e4e4;';
							}else{
								var background = 'background-color : #'+ color ;
							}

							if(res.settings.show_watermark == '1'){
								var thumbnail = 'public/uploads/preview/'+ value.preview;
							}else{

								var imageId = value.id;
								$.ajax({
									url: baseUrl + '/get-stockdata/' + imageId,
									type:'GET',
									dataType: 'json',
									success:function(response){
										console.log(response);
										if(response != null){
											var thumbnail = 'public/uploads/small/'+ response.name;
										}else{
											var thumbnail = '';
										}

									},
									error:function(){
										console.log('fail to get stockdata');
									}
								})

							}

							var watermarkedVideoPath = 'public/uploads/video/water_mark_large/';

							if(value.is_type == "video"){

								html +='<a href="' + baseUrl + '/video/'+ value.id +'/'+ value.title.toLowerCase().replace(/[^\w ]+/g,'').replace(/ +/g,'-') +'"  class="item hovercard img-video-fix-width">'+
									'<video onmouseover="this.play()" onmouseout="this.pause()"  width="100%" height="100%" muted loop>';
										if(value.extension == "mp4"){
											html += '<source src="' + baseUrl + '/' + watermarkedVideoPath + 'watermark-'+ value.thumbnail + '" type="video/mp4">';
										}
									html += '</video>'+
								'</a>';

							}else{
								var $thumbnail  = thumbnail;
								html += '<a href="' + baseUrl + '/photo/' + value.id + '/' + value.title.toLowerCase().replace(/[^\w ]+/g,'').replace(/ +/g,'-') + '" class="item hovercard"  style="'+ background +';     width: 397px; height: 254px;">'+
									'<img src="'+ baseUrl +'/'+ thumbnail +'" class="previewImage" />'+
								'</a>';
							}


						});
							html += '</div>';
							$("#DivImageFlex").empty();
							$("#DivImageFlex").append(html);

							//Clearing Banner Text And Change Count of users start
							$("#strongBannerText").empty();
							var txt = '<?php echo trans('misc.profile_images_available_category2') ?>';
							var txtbanner = '(' + res.length + ') ' + txt;
							$("#strongBannerText").append(txtbanner);
							//Clearing Banner Text And Change Count of users end


							//Adding Clear Search Button start
							var buttonSec = '<button class="btn btn-secondary" id="btnClearSearch" type="button" style="border-left:1px solid;">'+
							'Clear Search  <i class="fa fa-refresh"></i>'+
							'</button>';
							$("#buttonSectionDiv").append(buttonSec);
							//Adding Clear Search Button end

					}else{
						var icon = '<?php echo trans('misc.no_results_found'); ?>';
						var html ='<div class="btn-block text-center">'+
										'<i class="icon icon-Picture ico-no-result"></i>'+
									'</div>'+

									'<h3 class="margin-top-none text-center no-result no-result-mg">'+
										icon
									'</h3>';
									$("#DivImageFlex").empty();
									$("#DivImageFlex").append(html);


									//Clearing Banner Text And Change Count of users start
									$("#strongBannerText").empty();
									var txt = '<?php echo trans('misc.profile_images_available_category2') ?>';
									var txtbanner = '(' + res.length + ') ' + txt;
									$("#strongBannerText").append(txtbanner);
									//Clearing Banner Text And Change Count of users end


									//Adding Clear Search Button start
									var buttonSec = '<button class="btn btn-secondary" id="btnClearSearch" type="button" style="border-left:1px solid;">'+
													'Clear Search  <i class="fa fa-refresh"></i>'+
												'</button>';
												$("#buttonSectionDiv").append(buttonSec);
									//Adding Clear Search Button end
					}

				},
				error: function(){
					console.log('error while getting search result of user industry');
				}
			});
		});

		$(document).on('click', '#btnClearSearch', function(){
			var searchIndustryId = $("#txt_search_industry_id").val();
			$.ajax({
				url: baseUrl + '/search-by-industry',
				type: 'POST',
				data: {"_token": "{{ csrf_token() }}","searchIndustryId": searchIndustryId},
				dataType: 'json',
				success: function(res){
					console.log(res);
					$("#buttonSectionDiv #btnClearSearch").remove();
					$("#txt_search_industry").val('');
					const baseUrl = '<?php echo url("/")?>';
					if(res.images.length > 0){
						var html = '';

						html += '<div id="imagesFlex" class="flex-images btn-block margin-bottom-40 dataResult">';
						$.each(res.images , function( index, value ) {

							var imgColor = value.colors;
							var color = imgColor.split(",")[0];

							if(value.extension == "png"){
								var background = 'background : url('+ baseUrl + 'public/img/pixel.gif' + ') repeat center center #e4e4e4;';
							}else{
								var background = 'background-color : #'+ color ;
							}

							if(res.settings.show_watermark == '1'){
								var thumbnail = 'public/uploads/preview/'+ value.preview;
							}else{

								var imageId = value.id;
								$.ajax({
									url: baseUrl + '/get-stockdata/' + imageId,
									type:'GET',
									dataType: 'json',
									success:function(response){
										console.log(response);
										if(response != null){
											var thumbnail = 'public/uploads/small/'+ response.name;
										}else{
											var thumbnail = '';
										}

									},
									error:function(){
										console.log('fail to get stockdata');
									}
								})

							}

							var watermarkedVideoPath = 'public/uploads/video/water_mark_large/';

							if(value.is_type == "video"){

								html +='<a href="' + baseUrl + '/video/'+ value.id +'/'+ value.title.toLowerCase().replace(/[^\w ]+/g,'').replace(/ +/g,'-') +'"  class="item hovercard img-video-fix-width">'+
									'<video onmouseover="this.play()" onmouseout="this.pause()"  width="100%" height="100%" muted loop>';
										if(value.extension == "mp4"){
											html += '<source src="' + baseUrl + '/' + watermarkedVideoPath + 'watermark-'+ value.thumbnail + '" type="video/mp4">';
										}
									html += '</video>'+
								'</a>';

							}else{
								html += '<a href="' + baseUrl + '/photo/' + value.id + '/' + value.title.toLowerCase().replace(/[^\w ]+/g,'').replace(/ +/g,'-') + '" class="item hovercard" style="'+ background +'; ">'+
									'<img src="'+ baseUrl +'/'+ thumbnail +'" class="previewImage" />'+
								'</a>';
							}


						});
							html += '</div>';
							$("#DivImageFlex").empty();
							$("#DivImageFlex").append(html);

							//Clearing Banner Text And Change Count of users start
							$("#strongBannerText").empty();
							var txt = '<?php echo trans('misc.profile_images_available_category2') ?>';
							var txtbanner = '(' + res.length + ') ' + txt;
							$("#strongBannerText").append(txtbanner);
							//Clearing Banner Text And Change Count of users end


							//Adding Clear Search Button start
							var buttonSec = '<button class="btn btn-secondary" id="btnClearSearch" type="button" style="border-left:1px solid;">'+
							'Clear Search  <i class="fa fa-refresh"></i>'+
							'</button>';
							$("#buttonSectionDiv").append(buttonSec);
							//Adding Clear Search Button end

					}else{
						var icon = '<?php echo trans('misc.no_results_found'); ?>';
						var html ='<div class="btn-block text-center">'+
										'<i class="icon icon-Picture ico-no-result"></i>'+
									'</div>'+

									'<h3 class="margin-top-none text-center no-result no-result-mg">'+
										icon
									'</h3>';
									$("#DivImageFlex").empty();
									$("#DivImageFlex").append(html);


									//Clearing Banner Text And Change Count of users start
									$("#strongBannerText").empty();
									var txt = '<?php echo trans('misc.profile_images_available_category2') ?>';
									var txtbanner = '(' + res.length + ') ' + txt;
									$("#strongBannerText").append(txtbanner);
									//Clearing Banner Text And Change Count of users end


									//Adding Clear Search Button start
									var buttonSec = '<button class="btn btn-secondary" id="btnClearSearch" type="button" style="border-left:1px solid;">'+
													'Clear Search  <i class="fa fa-refresh"></i>'+
												'</button>';
												$("#buttonSectionDiv").append(buttonSec);
									//Adding Clear Search Button end
					}

				},
				error: function(){
					console.log('error while getting search result of user type');
				}
			});
		});

 $('#imagesFlex').flexImages({ rowHeight: 320 });

//<<---- PAGINATION AJAX
        $(document).on('click','.pagination a', function(e){
			e.preventDefault();
			var page = $(this).attr('href').split('page=')[1];
			$.ajax({
				headers: {
        	'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    		},
					url: '{{ url("/") }}/ajax/category?slug={{$category->slug}}&page=' + page


			}).done(function(data){
				if( data ) {

					scrollElement('#imagesFlex');

					$('.dataResult').html(data);

					$('.hovercard').hover(
		               function () {
		                  $(this).find('.hover-content').fadeIn();
		               },
		               function () {
		                  $(this).find('.hover-content').fadeOut();
		               }
		            );

					$('#imagesFlex').flexImages({ rowHeight: 320 });
					jQuery(".timeAgo").timeago();

					$('[data-toggle="tooltip"]').tooltip();
				} else {
					sweetAlert("{{trans('misc.error_oops')}}", "{{trans('misc.error')}}", "error");
				}
				//<**** - Tooltip
			});

		});//<<---- PAGINATION AJAX
</script>


@endsection
