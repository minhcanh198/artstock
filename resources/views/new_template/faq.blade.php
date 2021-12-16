@extends('new_template.layouts.app')

@section('title'){{ $faqPageSettings->title.' - ' }}@endsection

@section('content') 

<!-- <div class="jumbotron md  jumbotron_set jumbotron-cover" style="background-image: {{ url('/') }}/public/about_page/header_assets/{{ $faqPageSettings->header_main_image }} !important"> -->
<div class="bg-license" style="background-image:url(<?php echo url('public/faq_page/header_assets/').'/'.$faqPageSettings->header_main_image; ?>); background-size: cover;">
      <div class="container wrap-jumbotron position-relative">
        <h1 class="title-site">{{ $faqPageSettings->header_heading }}</h1>
        <p>{{ $faqPageSettings->header_description }}</p>
      </div>
    </div>

<div class="container margin-bottom-40">
	
<!-- Col MD -->
<div class="col-md-12">	
  <div class="tab-custom">
    @php
      $i = 0;
    @endphp

    @foreach($faqCategoriesParents as $parentCategories)
      @if($i == 0)
        <button class="tablinks-custom active" onclick="openCity(event, '{{ $parentCategories->name  }}')" style="font-weight:600">{{ $parentCategories->name  }}</button>
      @else
        <button class="tablinks-custom " onclick="openCity(event, '{{ $parentCategories->name  }}')" style="font-weight:600">{{-- $parentCategories->name  --}} Artists</button>
      @endif
      <?php $i++; ?>
    @endforeach
            <!-- <button class="tablinks-custom" onclick="openCity(event, 'Photographers')" style="font-weight:600">Photographers</button> -->
          </div>
	<!-- <ol class="breadcrumb bg-none">
          	<li><a href="{{ url('/') }}"><i class="fa fa-home myicon-right"></i></a></li> / 
          	<li class="active">FAQ</li>
          </ol> -->
	<hr />
     	
  <div class="div-container" style="text-align:center;">     
    
  </div>
  
  <section class="section knowledge-base">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <!-- <div class="tab-custom">
            <button class="tablinks-custom active" onclick="openCity(event, 'London')">London</button>
            <button class="tablinks-custom" onclick="openCity(event, 'Paris')">Paris</button>
          </div> -->
        </div>
      </div>
      @php
        $l = 0;
      @endphp
      @foreach($faqCategoriesParents as $pCategories)
      @if($l == '0')
        <div class="tabcontent-custom" id="{{ $pCategories->name }}" style="display:block;">
          <div class="row">
            @php
              $faqData = \App\Models\FaqCategories::where('parent_id','=', $pCategories->id)->get();
            @endphp
            @foreach($faqData as $data)
            <div class="col-md-4"> 
              <div class="custom-tabs-box">
                <h3 style="margin-bottom: 0; font-weight: bold;">
                 {{ $data->name }}
                </h3>
                @php
                  $faqQuestions = \App\Models\Faq::where('faq_category_id','=', $data->id)->limit('3')->get();
                @endphp
                @foreach($faqQuestions as $question)
                <p>
                  <a href="{{ url('/') }}/faq-details/{{ $question->id }}">
                    {{ $question->faq_question }}
                  </a>
                </p>
                @endforeach
                <!--<p >
                  <a href="{{ url('/')}}/faq-list/{{ $data->id }}" style="font-weight:800;">
                  See All Articles
                  </a>
                </p>-->
              </div>
            </div>
            @endforeach
            
          </div>
        </div>
      @else
        <div class="tabcontent-custom" id="{{ $parentCategories->name }}" >
          <div class="row">
            @php
              $faqData = \App\Models\FaqCategories::where('parent_id','=', $pCategories->id)->get();
            @endphp
            @foreach($faqData as $data)
            <div class="col-md-4"> 
              <div class="custom-tabs-box">
                <h3 style="margin-bottom: 0; font-weight: bold;">
                 {{ $data->name }}
                </h3>
                @php
                  $faqQuestions = \App\Models\Faq::where('faq_category_id','=', $data->id)->limit('3')->get();
                @endphp
                @foreach($faqQuestions as $question)
                <p>
                  <a href="{{ url('/') }}/faq-details/{{ $question->id }}">
                    {{ $question->faq_question }}
                  </a>
                </p>
                @endforeach
                <!--<p >
                  <a href="{{ url('/')}}/faq-list/{{ $data->id }}" style="font-weight:800;">
                  See All Articles
                  </a>
                </p>-->
              </div>
            </div>
            @endforeach
            
          </div>
        </div>
      @endif
      <?php $l++; ?>
      @endforeach

      <!-- <div class="tabcontent-custom" id="Photographers" style="display:block;">
        <div class="row">
          <div class="col-md-4"> 
            <div class="custom-tabs-box">
              <h2>
                New to ?
              </h2>
              <p>
                <a href="">
                  Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nulla optio 
                </a>
              </p>
              <p>
                <a href="">
                  Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nulla optio 
                </a>
              </p>
              <p>
                <a href="">
                  Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nulla optio 
                </a>
              </p>
            </div>
          </div>
          <div class="col-md-4"> 
            <div class="custom-tabs-box">
              <h2>
                New to Pexels?
              </h2>
              <p>
                <a href="">
                  Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nulla optio 
                </a>
              </p>
              <p>
                <a href="">
                  Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nulla optio 
                </a>
              </p>
              <p>
                <a href="">
                  Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nulla optio 
                </a>
              </p>
            </div>
          </div>
          <div class="col-md-4"> 
            <div class="custom-tabs-box">
              <h2>
                New to Pexels?
              </h2>
              <p>
                <a href="">
                  Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nulla optio 
                </a>
              </p>
              <p>
                <a href="">
                  Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nulla optio 
                </a>
              </p>
              <p>
                <a href="">
                  Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nulla optio 
                </a>
              </p>
            </div>
          </div>
          <div class="col-md-4"> 
            <div class="custom-tabs-box">
              <h2>
                New to Pexels?
              </h2>
              <p>
                <a href="">
                  Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nulla optio 
                </a>
              </p>
              <p>
                <a href="">
                  Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nulla optio 
                </a>
              </p>
              <p>
                <a href="">
                  Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nulla optio 
                </a>
              </p>
            </div>
          </div>
        </div>
      </div> -->
      
      <!-- <div id="London" class="tabcontent-custom">
        <h3>London</h3>
        <p>London is the capital city of England.</p>
      </div> -->

      <div id="Paris" class="tabcontent-custom">
        <h3>Paris</h3>
        <p>Paris is the capital of France.</p> 
      </div>
    </div>
    
    </div>
  </section>

 </div><!-- /COL MD -->
 
 </div><!-- container wrap-ui -->

 <script>
function openCity(evt, cityName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent-custom");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks-custom");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}
</script>
@endsection
