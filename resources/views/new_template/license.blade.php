@extends('new_template.layouts.app')

@section('title'){{ $licensePageSettings->title.' - ' }}@endsection

@section('content')
<!-- <div class="jumbotron md  jumbotron_set jumbotron-cover" style="background-image: {{ url('/') }}/about_page/header_assets/{{ $licensePageSettings->header_main_image }} !important"> -->
<div class="bg-license" style="background-image:url(<?php echo url('license_page/header_assets/').'/'.$licensePageSettings->header_main_image; ?>);">
  <div class="container wrap-jumbotron position-relative">
    <h1 class="title-site">{{ $licensePageSettings->header_heading }}</h1>
    <p>{{ $licensePageSettings->header_description }}</p>
  </div>
</div>

<div class="container margin-bottom-40">

<!-- Col MD -->
<div class="col-md-12">

	<!-- <ol class="breadcrumb bg-none">
          	<li><a href="{{ url('/') }}"><i class="fa fa-home myicon-right"></i></a></li> /
          	<li class="active">License</li>
          </ol> -->
          <ul class="d-flex justify-content-center mt-4">
            <li><a href="{{ url('/') }}/license"  class="mr-4" style="font-weight: 700;font-size: 18px;">License</a></li>
            <li><a href="{{ url('/') }}/faq" style="font-weight: 700;font-size: 18px; color:#5e5e5e">FAQ</a></li>
          </ul>
	<hr />

    <div class="row justify-content-center ">
      <div class="col-md-10">
        <div class="box-div text-center custom-tabs-box">

          <h4 ><b>{{ $licensePageSettings->section_1_heading }}</b></h4>
          <p style="color: #5e5e5e; font-size: 16px;">{{ $licensePageSettings->section_1_description }} </p>
          <div><?php echo $licensePageSettings->section_1_content;?> </div>

        </div>

      </div>
      </div>
      <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="box-div text-center custom-tabs-box">

              <h4><b>{{ $licensePageSettings->section_3_heading }}</b></h4>
              <p style="color: #5e5e5e; font-size: 16px;">{{ $licensePageSettings->section_3_description}} </p>
              {{-- <!-- <p>{{ $licensePageSettings->section_3_content }} </p> --> --}}
              <div><?php echo $licensePageSettings->section_3_content;?> </div>

            </div>
          </div>
        </div>
    <div class="box-div text-center">

      <h4><b>{{ $licensePageSettings->section_2_heading }}</b></h4>
      <p style="color: #5e5e5e; font-size: 16px;">{{ $licensePageSettings->section_2_description}} </p>

    </div>
  </div>
  <div>
    <div class="row form-group">
        <div class="col-12 mt-4">
            <img class="license-img-new" src="<?php echo url('license_page/section_2_content/').'/'.$licensePageSettings->section_2_content_1_image; ?>">
            <div class="box-div box-div-2">

                <h4><b>{{ $licensePageSettings->section_2_content_1_header }}</b></h4>
                <p>{{ $licensePageSettings->section_2_content_1_description}} </p>

            </div>
        </div>
        <div class="col-12 mt-4">
            <img class="license-img-new" src="<?php echo url('license_page/section_2_content/').'/'.$licensePageSettings->section_2_content_2_image; ?>">
            <div class="box-div box-div-2">

                <h4><b>{{ $licensePageSettings->section_2_content_2_header }}</b></h4>
                <p>{{ $licensePageSettings->section_2_content_2_description}} </p>

            </div>
        </div>
        <div class="col-12 mt-4">
            <img class="license-img-new" src="<?php echo url('license_page/section_2_content/').'/'.$licensePageSettings->section_2_content_3_image; ?>">
            <div class="box-div box-div-2">

                <h4><b>{{ $licensePageSettings->section_2_content_3_header }}</b></h4>
                <p>{{ $licensePageSettings->section_2_content_3_description}} </p>

            </div>
        </div>
        <div class="col-12 mt-4">
            <img class="license-img-new" src="<?php echo url('license_page/section_2_content/').'/'.$licensePageSettings->section_2_content_4_image; ?>">
            <div class="box-div box-div-2">
                <h4><b>{{ $licensePageSettings->section_2_content_4_header }}</b></h4>
                <p>{{ $licensePageSettings->section_2_content_4_description}} </p>
            </div>
        </div>
    </div>
    <!--<div class="row">-->

    <!--</div>-->

    <!--</div>-->
    <!--<div class="row">-->

    <!--</div>-->
    <!--<div class="row">-->

    <!--</div>-->
  </div>



 </div><!-- /COL MD -->

 </div><!-- container wrap-ui -->
@endsection

