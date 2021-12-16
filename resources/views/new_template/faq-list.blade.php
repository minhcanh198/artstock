@extends('new_template.layouts.app')

@section('title'){{ $faqCategories->name.' - ' }}@endsection

@section('content') 

<style>
.article-list-item{
    border-bottom: 1px solid #ddd;
    font-size: 16px;
    padding: 15px 0;
}
</style>

    <!-- <div class="jumbotron md  jumbotron_set jumbotron-cover" style="background-image: {{ url('/') }}/public/about_page/header_assets/{{ $faqPageSettings->header_main_image }} !important"> -->
   <!-- <div class="bg " style="background-image:url(<?php echo url('public/faq_page/header_assets/').'/'.$faqPageSettings->header_main_image; ?>); background-size: cover;">
      <div class="container wrap-jumbotron position-relative">
        <h1 class="title-site">{{ $faqPageSettings->header_heading }}</h1>
        <p>{{ $faqPageSettings->header_description }}</p>
      </div>
    </div> --> 

    <div class="container margin-bottom-40">
	
        <!-- Col MD -->
        <div class="col-md-12">	
            <ol class="breadcrumb bg-none">
                    <li><a href="{{ url('/') }}"><i class="fa fa-home myicon-right"></i></a></li> / 
                    <li class="">Faq List</li> /
                    <li class="active">{{ $faqCategories->name }}</li>
                </ol>
            <hr/>
                
            <section>
                   
                <div class="row">
                    <div class="col-md-12">
                        <h1 >{{ $faqCategories->name }}</h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <ul style="list-style: none;margin: 0;padding: 0;">
                        @foreach($faqQuestions as $question)
                        <li class="article-list-item ">
                            <a href="{{url('faq-details', $question->id)}}" class="article-list-link">{{ $question->faq_question }}</a>
                        </li>
                        @endforeach
                       
                        </ul>
                    </div>
                </div>
                
            </section>
        
        

        </div><!-- /COL MD -->
 
    </div><!-- container wrap-ui -->
@endsection
