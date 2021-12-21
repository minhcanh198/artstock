{{-- @extends('app') --}}
@extends('new_template.layouts.app')

@section('title'){{ $category->name.' - ' }}@endsection

@section('content')
	<div class="jumbotron md index-header jumbotron_set jumbotron-cover" style="height:50%;">
		<div class="container wrap-jumbotron position-relative">
			<h1 class="title-site title-sm">{{ $category->name }}</h1>
			@if( $images->total() != 0 )
				<p class="subtitle-site"><strong>({{number_format($images->total())}}) {{trans_choice('misc.images_available_category',$images->total() )}}</strong></p>
			@else
				<p class="subtitle-site"><strong>{{$settings->title}}</strong></p>
			@endif

			<div class="row mt-5">
				<div class="col-lg-12">
					<div class="form-group width">
						<input class="form-control" id="" name="" placeholder="Search Here" type="">
						<p style="color:#fff">Suggested: love, harmony, r&b, pop, nature</p>
					</div>
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
								$getCategoriesList = \DB::table('categories')->where('slug','!=', 'uncategorized')->where('parent_id','=', $getCategoryDetails->id)->get();
							@endphp
							@foreach($getCategoriesList as $categor)
								<button  id="buttonCategories|{{ $categor->slug }}" data-target="{{ $categor->slug }}">{{ $categor->name }}</button>
							@endforeach
						</div>
					</div>
				</div>
<!-- Col MD -->
<div class="col-md-12 margin-top-20 margin-bottom-20">

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

			<div class="row slider-home <?php echo (count($allUsersCount) < 3 ) ? 'new12' : '' ?>">
				<?php
					$categorySlug = $category->slug;
					if($categorySlug == "animation"){
						$cateSlug = "animator";
						$allUsers = App\Models\User::join('types','types.types_id','=', 'users.user_type_id')->where('user_type_id','!=', '')->where('types.type_name','=',$cateSlug)->get();
						// dd($allUsers[0]->id);
						// var_dump($allUsers[0]->id);
						if(count($allUsers) > 0){
							for($UA = 0; $UA < count($allUsers); $UA++){
								$users = App\Models\User::find($allUsers[$UA]->id);
								// dd($users->types()->type_name);

								$categorySlug = $category->slug;
				?>

								<div class="col-md-4 photographer-box">
									<div class="">
										<div class="photographer-img"><img alt="" class="img-fluid" style="height: 260px" src="{{ asset('cover/').'/'.$users->cover }}"></div>
										<div class="d-flex justify-content-center">
											<div class="photographer-person-img text-center"><img style="border-radius: 50%;width: 140px;" alt="" src="{{ asset('avatar').'/'.$users->avatar }}"></div>
											<div class="icon-photo">
												<i class="far fa-images"></i> <small class="photos-count">{{ App\Helper::formatNumber($users->images()->count()) }}</small>
											</div>
										</div>
										<div class="d-flex photographer-info">
											<div class="">
											<h2 class="photographer-name">@if($users->name != "") {{ $users->name}} @else {{ $users->username }} @endif</h2><small>{{ $users->types()->type_name }}</small>
											</div>
											<div class="ml-auto mt-4">
												<a class="btn-hire-me" href="">hire me</a>
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
								$users = App\Models\User::find($allUsers[$UA]->id);
								// dd($users->types()->type_name);

								$categorySlug = $category->slug;
				?>
								<div class="col-md-4 photographer-box">
									<div class="">
										<div class="photographer-img"><img alt="" class="img-fluid" style="height: 260px" src="{{ asset('cover/').'/'.$users->cover }}"></div>
										<div class="d-flex justify-content-center">
											<div class="photographer-person-img text-center"><img style="border-radius: 50%;width: 140px;" alt="" src="{{ asset('avatar').'/'.$users->avatar }}"></div>
											<div class="icon-photo">
												<i class="far fa-images"></i> <small class="photos-count">{{ App\Helper::formatNumber($users->images()->count()) }}</small>
											</div>
										</div>
										<div class="d-flex photographer-info">
											<div class="">
											<h2 class="photographer-name">@if($users->name != "") {{ $users->name}} @else {{ $users->username }} @endif</h2><small>{{ $users->types()->type_name }}</small>
											</div>
											<div class="ml-auto mt-4">
												<a class="btn-hire-me" href="">hire me</a>
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
								$users = App\Models\User::find($allUsers[$UA]->id);
								// dd($users->types()->type_name);

								$categorySlug = $category->slug;
				?>
								<div class="col-md-4 photographer-box">
									<div class="">
										<div class="photographer-img"><img alt="" class="img-fluid" style="height: 260px" src="{{ asset('cover/').'/'.$users->cover }}"></div>
										<div class="d-flex justify-content-center">
											<div class="photographer-person-img text-center"><img style="border-radius: 50%;width: 140px;" alt="" src="{{ asset('avatar').'/'.$users->avatar }}"></div>
											<div class="icon-photo">
												<i class="far fa-images"></i> <small class="photos-count">{{ App\Helper::formatNumber($users->images()->count()) }}</small>
											</div>
										</div>
										<div class="d-flex photographer-info">
											<div class="">
											<h2 class="photographer-name">@if($users->name != "") {{ $users->name}} @else {{ $users->username }} @endif</h2><small>{{ $users->types()->type_name }}</small>
											</div>
											<div class="ml-auto mt-4">
												<a class="btn-hire-me" href="">hire me</a>
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
								$users = App\Models\User::find($allUsers[$UA]->id);
								// dd($users->types()->type_name);

								$categorySlug = $category->slug;
				?>
								<div class="col-md-4 photographer-box">
									<div class="">
										<div class="photographer-img"><img alt="" class="img-fluid" style="height: 260px" src="{{ asset('cover/').'/'.$users->cover }}"></div>
										<div class="d-flex justify-content-center">
											<div class="photographer-person-img text-center"><img style="border-radius: 50%;width: 140px;" alt="" src="{{ asset('avatar').'/'.$users->avatar }}"></div>
											<div class="icon-photo">
												<i class="far fa-images"></i> <small class="photos-count">{{ App\Helper::formatNumber($users->images()->count()) }}</small>
											</div>
										</div>
										<div class="d-flex photographer-info">
											<div class="">
											<h2 class="photographer-name">@if($users->name != "") {{ $users->name}} @else {{ $users->username }} @endif</h2><small>{{ $users->types()->type_name }}</small>
											</div>
											<div class="ml-auto mt-4">
												<a class="btn-hire-me" href="">hire me</a>
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

			</div>
		</div>
	</section>

@endsection

@section('javascript')

<script type="text/javascript">

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
