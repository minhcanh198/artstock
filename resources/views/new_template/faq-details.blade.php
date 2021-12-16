@extends('new_template.layouts.app')

@section('title'){{ $faqQuestions->faq_question.' - ' }}@endsection

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
                    <div class="col-md-3">
                        <div>
                        <h3 style="font-weight: bold;">Articles in this section</h3>
                        </div>
                        <div>
                            <ul class="custom-ul-questionlist">
                                @foreach($faqAllQuestions as $allQuestion)
                                    @if($allQuestion->id == $faqQuestions->id)
                                        <li class="custom-li-questionlist mb-4" >
                                            <a href="" style="color: rgba(35, 42, 52, 1);text-decoration: none;opacity: 0.7;"> {{ $allQuestion->faq_question }} </a>
                                        </li>
                                    @else
                                        <li class="custom-li-questionlist mb-4">
                                            <a href="{{ url('/')}}/faq-details/{{ $allQuestion->id }}"> {{ $allQuestion->faq_question }} </a>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <h2 style="font-weight: 700;" >{{ $faqQuestions->faq_question }}</h2>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                              <p><?php echo $faqQuestions->faq_answer; ?></p>

                            </div>
                        </div>
                    </div>
                </div>
                
            </section>
        
        

        </div><!-- /COL MD -->
 
    </div><!-- container wrap-ui -->
@endsection
