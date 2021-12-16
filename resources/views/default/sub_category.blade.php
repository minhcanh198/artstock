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

			<div class="row mt-5">
				<div class="col-lg-2">
				</div>
				<div class="col-lg-8">
					<form method="post" action="<?php echo url('/sub-category/search-by-industry')?>">
					@csrf
					<div class="input-group">
					@php
					$urlSegment = \Request::segment(2);
					@endphp
						<input type="text" class="form-control mt-0" id="txt_search_industry" name="txt_search_industry" placeholder="Search" value="{{ (isset($q)) ? $q : '' }}">
						<input type="hidden" class="form-control" id="txt_search_industry_id" name="txt_search_industry_id" value="{{ $category->id }}">
						<div class="input-group-append" id="buttonSectionDiv">
							<!-- <button class="btn btn-secondary" id="btnSubmitTxtIndustrySearch" type="submit"> -->
							<button class="btn btn-secondary" type="submit">
								<i class="fa fa-search"></i>
							</button>
							@if($urlSegment == "search-by-industry")
							<a class="btn btn-secondary" id="btnClearSearch" href="{{ url('/sub-category/').'/'. $category->slug }}" style="border-left:1px solid;">
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
								$getCategoriesList = \DB::table('categories')->where('slug','!=', 'uncategorized')->where('parent_id','=', $getCategoryDetails->parent_id)->where('parent_id','!=', $getCategoryDetails->id)->get();
							@endphp
							@foreach($getCategoriesList as $categor)
							{{-- <!-- <button  id="buttonCategories|{{ $categor->slug }}" data-target="{{ $categor->slug }}">{{ $categor->name }}</button> --> --}}
								<a href="{{ url('/'). '/sub-category/'. $categor->slug }}">{{ $categor->name }}</a>
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
							$categorySlug = $parentCategory->slug;
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
			<userslidercategory categorySlug=<?php echo $parentCategory->slug; ?> sessionUser=<?php echo (\Auth::user()) ? \Auth::user()->id : ''; ?>></userslidercategory>
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
