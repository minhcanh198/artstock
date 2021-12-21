@extends('app')

@section('title'){{ 'FAQ Categories'.' - ' }}@endsection

@section('content')
<div class="jumbotron md index-header jumbotron_set jumbotron-cover">
      <div class="container wrap-jumbotron position-relative">
        <h1 class="title-site title-sm">{{ FAQ Categories }}</h1>
        <!-- <p class="subtitle-site"><strong>{{trans('misc.browse_by_category')}}</strong></p> -->
      </div>
    </div>

<div class="container margin-bottom-40">

<!-- Col MD -->
<div class="col-md-12 margin-top-20 margin-bottom-20">

     @foreach(  $data as $faqcategory )

<?php
 if( $faqcategory->thumbnail == '' ) {
$_image = 'default.jpg';
 } else {
 	$_image = $faqcategory->thumbnail;
 }
 ?>
<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 row-margin-20">

<a href="{{ url('category',$faqcategory->slug) }}">
  <img class="img-responsive btn-block custom-rounded" src="{{asset('img-category')}}/{{ $_image }}" alt="{{ $faqcategory->name }}">
</a>

<h1 class="title-services">
	<a href="{{ url('category',$faqcategory->slug) }}">
		{{ $faqcategory->name }} ({{$faqcategory->images()->count()}})
	</a>
	</h1>
  </div><!-- col-md-3 row-margin-20 -->

	        	@endforeach
 </div><!-- /COL MD -->

 </div><!-- container wrap-ui -->

@endsection

