@extends('new_template.layouts.app')

@section('title'){{ $imprintPageSettings->title.' - ' }}@endsection

@section('content') 
<!-- <div class="jumbotron md  jumbotron_set jumbotron-cover" style="background-image: {{ url('/') }}/public/about_page/header_assets/{{ $imprintPageSettings->header_main_image }} !important"> -->
<!-- <div class="bg " style="background-image:url(<?php //echo url('public/license_page/header_assets/').'/'.$imprintPageSettings->header_main_image; ?>);">
      <div class="container wrap-jumbotron position-relative">
        <h1 class="title-site">{{ $imprintPageSettings->header_heading }}</h1>
        <p>{{ $imprintPageSettings->header_description }}</p>
      </div>
    </div> -->

<div class="container margin-bottom-40">
	
<!-- Col MD -->
<div class="col-md-12">	
		
	<!-- <ol class="breadcrumb bg-none">
          	<li><a href="{{ url('/') }}"><i class="fa fa-home myicon-right"></i></a></li> / 
          	<li class="active">Imprint</li>
          </ol> -->
          <ul class="d-flex justify-content-center mt-4">
            <li><a href="{{ url('/') }}/imprint" class="mr-4" style="font-weight: 700;font-size: 18px; ">Imprint</a></li>
            <li><a href="{{ url('/') }}/terms-of-service"  class="mr-4" style="font-weight: 700;font-size: 18px; color:#5e5e5e;">Terms of Service</a></li>
            <li><a href="{{ url('/') }}/privacy-policy" style="font-weight: 700;font-size: 18px; color:#5e5e5e">Privacy Policy</a></li>
          </ul>
	<hr />
     	
  <div class="div-container imprint-container-box" style="">     
    <div class="box-div">
      
      <div><?php echo $imprintPageSettings->content;?> </div>

    </div>
   
  </div>
  
  

 </div><!-- /COL MD -->
 
 </div><!-- container wrap-ui -->
@endsection

