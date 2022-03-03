@extends('new_template.layouts.app')

@section('title'){{ $aboutPageSettings->title.' - ' }}@endsection

@section('content')
<!-- <div class="jumbotron md  jumbotron_set jumbotron-cover" style="background-image: {{ url('/') }}/about_page/header_assets/{{ $aboutPageSettings->header_main_image }} !important"> -->
<div class="bg-license" style="background-image:url(<?php echo url('about_page/header_assets/').'/'.$aboutPageSettings->header_main_image; ?>);">
      <div class="container wrap-jumbotron position-relative">
        <h1 class="title-site">{{ $aboutPageSettings->header_heading }}</h1>
        <p>{{ $aboutPageSettings->header_description }}</p>
      </div>
    </div>

<div class="container margin-bottom-40">
    <!--<div class="row">-->
    <!--    <div class="col-md-4">-->
    <!--    	<div class="choose-photographer-box">-->
    <!--    		<div class="pt-4 pb-4 pl-3 pr-3">-->
    <!--    			<div class="">-->
    <!--					<img loading="lazy" src="https://projects.hexawebstudio.com/darquise-nantel/avatar/noah-161600214940dqr9ufqug8.jpg" alt="" class="photographer-thimbnial">-->
    <!--    			    <h4 class="title-this-photographer">qwioeu</h4>-->
    <!--                    <p class="tag-one-photographer">Photographer</p>-->
    <!--    			    <div class="mt-4" style="text-align: center;">-->
    <!--    					<img loading="lazy" src="https://projects.hexawebstudio.com/darquise-nantel/avatar/noah-161600214940dqr9ufqug8.jpg" alt="" class="set-img-size">-->
    <!--    					<img loading="lazy" src="https://projects.hexawebstudio.com/darquise-nantel/avatar/noah-161600214940dqr9ufqug8.jpg" alt="" class="set-img-size">-->
    <!--    					<img loading="lazy" src="https://projects.hexawebstudio.com/darquise-nantel/avatar/noah-161600214940dqr9ufqug8.jpg" alt="" class="set-img-size">-->
    <!--    					<img loading="lazy" src="https://projects.hexawebstudio.com/darquise-nantel/avatar/noah-161600214940dqr9ufqug8.jpg" alt="" class="set-img-size">-->
    <!--					</div>-->
    <!--			    </div>-->
    <!--		    </div>    -->
    <!--			<div class="bottom" style="background-image: url(https://projects.hexawebstudio.com/darquise-nantel/uploads/thumbnail/musicWave.png)">-->
    <!--				<div class="">-->
    <!--					<div class="d-md-flex">-->
    <!--						<a href="https://projects.hexawebstudio.com/darquise-nantel/artist/16" class="btn-portfolio-one w-100 mt-0">Portfolio</a>-->
    <!--						<a href="https://projects.hexawebstudio.com/darquise-nantel/request-to-book?photographerId=16&amp;cityId=4 " class="button-book-one w-100">Book artist</a>-->

    <!--					</div>-->
    <!--				</div>-->
    <!--			</div>-->
    <!--    	</div>-->
    <!--    </div>-->
    <!--</div>-->
<!-- Col MD -->
<div class="col-md-12">



<div class="row">
     		<?php //echo html_entity_decode($aboutPageSettings->content) ?>
    <div class="col-12 text-center">
        <div class="box-div about-new-box-1">
          <h4><b>{{ $aboutPageSettings->section_header_1 }}</b></h4>
          <p>{{ $aboutPageSettings->section_description_1}} </p>
        </div>
    </div>
    <div class="col-md-6 text-center mb-3">
        <div class="box-div about-new-box-2 ">
          <div class="box-img">
            <i class="far fa-images"></i>
          </div>
          <h4><b>{{ $aboutPageSettings->section_header_2 }}</b></h4>
          <p>{{ $aboutPageSettings->section_description_2}} </p>
        </div>
    </div>
    <div class="col-md-6 text-center  mb-3">
        <div class="box-div about-new-box-2">
          <div class="box-img">
            <i class="far fa-images"></i>
          </div>
          <h4><b>{{ $aboutPageSettings->section_header_3 }}</b></h4>
          <p>{{ $aboutPageSettings->section_description_3}} </p>
        </div>
    </div>
    <div class="col-md-6 text-center mb-3">
        <div class="box-div about-new-box-2">
          <div class="box-img">
            <i class="far fa-images"></i>
          </div>
          <h4><b>{{ $aboutPageSettings->section_header_4 }}</b></h4>
          <p>{{ $aboutPageSettings->section_description_4}} </p>
        </div>
    </div>
    <div class="col-md-6 text-center mb-3">
        <div class="box-div about-new-box-2">
          <div class="box-img">
            <i class="far fa-images"></i>
          </div>
          <h4><b>{{ $aboutPageSettings->section_header_5 }}</b></h4>
          <p>{{ $aboutPageSettings->section_description_5}} </p>
        </div>
    </div>
</div>
 </div><!-- /COL MD -->

 </div><!-- container wrap-ui -->
@endsection

