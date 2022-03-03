@extends('new_template.layouts.app')
@section('content')
@php
    $homePageSettings = App\Models\HomePageSettings::first();

@endphp
<section class="banner" style="background: url(http://localhost/gostock/home_page/header_assets/{{ $homePageSettings->header_main_image }}) fixed;">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div>
                    <div class="text" data-aos="fade-right">

                        <h1>{{ $homePageSettings->header_heading }}</h1>
                        <!-- <p>Choose a photographer you love<br>
                        — we’ll take care of the rest</p> -->
                        <p>{{ $homePageSettings->header_description }}</p>
                        <div class="form-group">
                            <input class="form-control" id="" name="" placeholder="Search Here" type="">
                        </div><a class="theme-btn" href="#">Get Started</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6" data-aos="fade-left">
                <!-- <div class="banner-img"><img class="img-fluid" src="{{{ asset('new_template/images/banner-img2.png') }}}"></div> -->
                <div class="banner-img"><img class="img-fluid" src="{{ url('/') }}/home_page/header_assets/{{ $homePageSettings->header_image }}"></div>
            </div>
        </div>
    </div>
</section>
<section class="tabs">
    <div class="container">
        <div class="row">
            <div class="tabs">
                <div class="tabs__navigation" data-aos="fade-down">
                    <button data-target="recent" class="active">Recent</button>
                    @foreach($categoriesList as $category)
                        {{-- <button  data-target="{{ $category->slug }}">{{ $category->name }}</button> --}}
                        <button  id="buttonCategories|{{ $category->slug }}" data-target="{{ $category->slug }}">{{ $category->name }}</button>
                    @endforeach
                </div>
                <div id="tabs__content">
                    <div class="single__tab active recent">
                        <div class="container">

                            <div class="row baguetteBoxOne gallery">
                                {{-- @foreach($items->chunk(5) as $chunk) --}}
                                {{-- {{ dd($images->chunk(4)) }} --}}


                                {{-- @foreach($Chunkrecentimage as $item1) --}}
                                {{-- {{ dd($item1) }} --}}
                                @php
                                    $i = 0;
                                @endphp
                                @foreach($images as $image)

                                @php
                                    $colors = explode(",", $image->colors);
                                    $color = $colors[0];
                                    if($image->extension == 'png' ) {
                                        $background = 'background: url('.url('img/pixel.gif').') repeat center center #e4e4e4;';
                                    }  else {
                                        $background = 'background-color: #'.$color.'';
                                    }
                                    if($settings->show_watermark == '1') {
                                        $thumbnail = 'uploads/preview/'.$image->preview;
                                    } else {
                                        $stockImage = App\Models\Stock::whereImagesId($image->id)->whereType('small')->select('name')->first();
                                        $thumbnail = 'uploads/small/'.$stockImage->name;
                                    }
                                @endphp
                                    @if($i == 0)
                                        <div class="col-md-4" data-aos="fade-right">
                                            {{-- <div class="box"><a href="{{{ asset('new_template/images/img1.jpg') }}}"><img class="img-fluid" src="{{ asset($thumbnail) }}"></a></div> --}}
                                            <div class="box"><a href="{{ url('photo', $image->id ) }}/{{str_slug($image->title)}}"><img class="img-fluid" src="{{ asset($thumbnail) }}"></a></div>
                                        {{-- <div class="box"><a href="{{{ asset('new_template/images/img1.jpg') }}}">{{ $item1->id }}</a></div> --}}
                                        </div>
                                    @endif

                                    @if($i==1 || $i == 2)
                                        @if($i == 1)
                                           <div class="col-md-4">
                                               {{-- <div class="box2" data-aos="fade-down"><a href="{{{ asset('new_template/images/img2.jpg') }}}"><img class="img-fluid" src="{{ asset($thumbnail) }}"></a></div> --}}
                                               <div class="box2" data-aos="fade-down"><a href="{{ url('photo', $image->id ) }}/{{str_slug($image->title)}}"><img class="img-fluid" src="{{ asset($thumbnail) }}"></a></div>
                                        @endif
                                        @if($i == 2)
                                                {{-- <div class="box2" data-aos="fade-up"><a href="{{{ asset('new_template/images/img3.jpg') }}}"><img class="img-fluid" src="{{ asset($thumbnail) }}"></a></div> --}}
                                                <div class="box2" data-aos="fade-up"><a href="{{ url('photo', $image->id ) }}/{{str_slug($image->title)}}"><img class="img-fluid" src="{{ asset($thumbnail) }}"></a></div>
                                            </div>
                                        @endif
                                    @endif

                                    @if($i == 3)
                                        <div class="col-md-4" data-aos="fade-left">
                                            {{-- <div class="box"><a href="{{{ asset('new_template/images/img4.jpg') }}}"><img class="img-fluid" src="{{ asset($thumbnail) }}"></a></div> --}}
                                            <div class="box"><a href="{{ url('photo', $image->id ) }}/{{str_slug($image->title)}}"><img class="img-fluid" src="{{ asset($thumbnail) }}"></a></div>
                                        </div><br>
                                    @endif
                                <?php $i++; ?>
                                @if($i == 4)
                                <?php $i = 0; ?>
                                @endif
                                @endforeach


                                {{-- <div class="col-md-4" data-aos="fade-right">
                                    <div class="box"><a href="{{{ asset('new_template/images/img5.jpg') }}}"><img class="img-fluid" src="{{{ asset('new_template/images/img5.jpg') }}}"></a></div>
                                </div>
                                <div class="col-md-4">
                                    <div class="box2" data-aos="fade-down"><a href="{{{ asset('new_template/images/img6.jpg') }}}"><img class="img-fluid" src="{{{ asset('new_template/images/img6.jpg') }}}"></a></div>
                                    <div class="box2" data-aos="fade-up"><a href="{{{ asset('new_template/images/img7.jpg') }}}"><img class="img-fluid" src="{{{ asset('new_template/images/img7.jpg') }}}"></a></div>
                                </div>
                                <div class="col-md-4" data-aos="fade-left">
                                    <div class="box"><a href="{{{ asset('new_template/images/img8.jpg') }}}"><img class="img-fluid" src="{{{ asset('new_template/images/img8.jpg') }}}"></a></div>
                                </div> --}}
                            </div>
                            {{-- @endforeach --}}
                        </div>
                    </div>
                    @foreach($categoriesList as $category)
                        <div class="single__tab  {{ $category->slug }}" id="content-{{ $category->slug }}">
                        {{-- <div class="single__tab  {{ $category->slug }}"> --}}
                            <div class="container">
                                <div class="row baguetteBoxOne gallery" id="inside-content-{{ $category->slug }}">


                                    {{-- <div class="col-md-4" data-aos="fade-right">
                                        <div class="box"><a href="{{{ asset('new_template/images/img1.jpg') }}}"><img class="img-fluid" src="{{{ asset('new_template/images/img1.jpg') }}}"></a></div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="box2" data-aos="fade-down"><a href="{{{ asset('new_template/images/img2.jpg') }}}"><img class="img-fluid" src="{{{ asset('new_template/images/img2.jpg') }}}"></a></div>
                                        <div class="box2" data-aos="fade-up"><a href="{{{ asset('new_template/images/img3.jpg') }}}"><img class="img-fluid" src="{{{ asset('new_template/images/img3.jpg') }}}"></a></div>
                                    </div>
                                    <div class="col-md-4" data-aos="fade-left">
                                        <div class="box"><a href="{{{ asset('new_template/images/img4.jpg') }}}"><img class="img-fluid" src="{{{ asset('new_template/images/img4.jpg') }}}"></a></div>
                                    </div><br>
                                    <div class="col-md-4" data-aos="fade-right">
                                        <div class="box"><a href="{{{ asset('new_template/images/img5.jpg') }}}"><img class="img-fluid" src="{{{ asset('new_template/images/img5.jpg') }}}"></a></div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="box2" data-aos="fade-down"><a href="{{{ asset('new_template/images/img6.jpg') }}} "><img class="img-fluid" src="{{{ asset('new_template/images/img6.jpg') }}} "></a></div>
                                        <div class="box2" data-aos="fade-up"><a href="{{{ asset('new_template/images/img7.jpg') }}}"><img class="img-fluid" src="{{{ asset('new_template/images/img7.jpg') }}}"></a></div>
                                    </div>
                                    <div class="col-md-4" data-aos="fade-left">
                                        <div class="box"><a href="{{{ asset('new_template/images/img8.jpg') }}}"><img class="img-fluid" src="{{{ asset('new_template/images/img8.jpg') }}}"></a></div>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                        {{-- <div class="single__tab  third">
                            <div class="container">
                                <div class="row baguetteBoxOne gallery">

                                    <div class="col-md-4" data-aos="fade-right">
                                        <div class="box"><a href="{{{ asset('new_template/images/img1.jpg') }}}"><img class="img-fluid" src="{{{ asset('new_template/images/img1.jpg') }}}"></a></div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="box2" data-aos="fade-down"><a href="{{{ asset('new_template/images/img2.jpg') }}}"><img class="img-fluid" src="{{{ asset('new_template/images/img2.jpg') }}}"></a></div>
                                        <div class="box2" data-aos="fade-up"><a href="{{{ asset('new_template/images/img3.jpg') }}}"><img class="img-fluid" src="{{{ asset('new_template/images/img3.jpg') }}}"></a></div>
                                    </div>
                                    <div class="col-md-4" data-aos="fade-left">
                                        <div class="box"><a href="{{{ asset('new_template/images/img4.jpg') }}}"><img class="img-fluid" src="{{{ asset('new_template/images/img4.jpg') }}}"></a></div>
                                    </div><br>
                                    <div class="col-md-4" data-aos="fade-right">
                                        <div class="box"><a href="{{{ asset('new_template/images/img5.jpg') }}}"><img class="img-fluid" src="{{{ asset('new_template/images/img5.jpg') }}}"></a></div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="box2" data-aos="fade-down"><a href="{{{ asset('new_template/images/img6.jpg') }}}"><img class="img-fluid" src="{{{ asset('new_template/images/img6.jpg') }}}"></a></div>
                                        <div class="box2" data-aos="fade-up"><a href="{{{ asset('new_template/images/img7.jpg') }}}"><img class="img-fluid" src="{{{ asset('new_template/images/img7.jpg') }}}"></a></div>
                                    </div>
                                    <div class="col-md-4" data-aos="fade-left">
                                        <div class="box"><a href="{{{ asset('new_template/images/img8.jpg') }}}"><img class="img-fluid" src="{{{ asset('new_template/images/img8.jpg') }}}"></a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="single__tab  fourth">
                            <div class="container">
                                <div class="row baguetteBoxOne gallery">

                                    <div class="col-md-4" data-aos="fade-right">
                                        <div class="box"><a href="{{{ asset('new_template/images/img1.jpg') }}}"><img class="img-fluid" src="{{{ asset('new_template/images/img1.jpg') }}}"></a></div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="box2" data-aos="fade-down"><a href="{{{ asset('new_template/images/img2.jpg') }}}"><img class="img-fluid" src="{{{ asset('new_template/images/img2.jpg') }}}"></a></div>
                                        <div class="box2" data-aos="fade-up"><a href="{{{ asset('new_template/images/img3.jpg') }}}"><img class="img-fluid" src="{{{ asset('new_template/images/img3.jpg') }}}"></a></div>
                                    </div>
                                    <div class="col-md-4" data-aos="fade-left">
                                        <div class="box"><a href="{{{ asset('new_template/images/img4.jpg') }}}"><img class="img-fluid" src="{{{ asset('new_template/images/img4.jpg') }}}"></a></div>
                                    </div><br>
                                    <div class="col-md-4" data-aos="fade-right">
                                        <div class="box"><a href="{{{ asset('new_template/images/img5.jpg') }}}"><img class="img-fluid" src="{{{ asset('new_template/images/img5.jpg') }}}"></a></div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="box2" data-aos="fade-down"><a href="{{{ asset('new_template/images/img6.jpg') }}}"><img class="img-fluid" src="{{{ asset('new_template/images/img6.jpg') }}}"></a></div>
                                        <div class="box2" data-aos="fade-up"><a href="{{{ asset('new_template/images/img7.jpg') }}}"><img class="img-fluid" src="{{{ asset('new_template/images/img7.jpg') }}}"></a></div>
                                    </div>
                                    <div class="col-md-4" data-aos="fade-left">
                                        <div class="box"><a href="{{{ asset('new_template/images/img8.jpg') }}}"><img class="img-fluid" src="{{{ asset('new_template/images/img8.jpg') }}}"></a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="single__tab  fifth">
                            <div class="container">
                                <div class="row baguetteBoxOne gallery">

                                    <div class="col-md-4" data-aos="fade-right">
                                        <div class="box"><a href="{{{ asset('new_template/images/img1.jpg') }}}"><img class="img-fluid" src="{{{ asset('new_template/images/img1.jpg') }}}"></a></div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="box2" data-aos="fade-down"><a href="{{{ asset('new_template/images/img2.jpg') }}}"><img class="img-fluid" src="{{{ asset('new_template/images/img2.jpg') }}}"></a></div>
                                        <div class="box2" data-aos="fade-up"><a href="{{{ asset('new_template/images/img3.jpg') }}}"><img class="img-fluid" src="{{{ asset('new_template/images/img3.jpg') }}}"></a></div>
                                    </div>
                                    <div class="col-md-4" data-aos="fade-left">
                                        <div class="box"><a href="{{{ asset('new_template/images/img4.jpg') }}}"><img class="img-fluid" src="{{{ asset('new_template/images/img4.jpg') }}}"></a></div>
                                    </div><br>
                                    <div class="col-md-4" data-aos="fade-right">
                                        <div class="box"><a href="{{{ asset('new_template/images/img5.jpg') }}}"><img class="img-fluid" src="{{{ asset('new_template/images/img5.jpg') }}}"></a></div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="box2" data-aos="fade-down"><a href="{{{ asset('new_template/images/img6.jpg') }}}"><img class="img-fluid" src="{{{ asset('new_template/images/img6.jpg') }}}"></a></div>
                                        <div class="box2" data-aos="fade-up"><a href="{{{ asset('new_template/images/img7.jpg') }}}"><img class="img-fluid" src="{{{ asset('new_template/images/img7.jpg') }}}"></a></div>
                                    </div>
                                    <div class="col-md-4" data-aos="fade-left">
                                        <div class="box"><a href="{{{ asset('new_template/images/img8.jpg') }}}"><img class="img-fluid" src="{{{ asset('new_template/images/img8.jpg') }}}"></a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="single__tab  six">
                            <div class="container">
                                <div class="row baguetteBoxOne gallery">

                                    <div class="col-md-4" data-aos="fade-right">
                                        <div class="box"><a href="{{{ asset('new_template/images/img1.jpg') }}}"><img class="img-fluid" src="{{{ asset('new_template/images/img1.jpg') }}}"></a></div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="box2" data-aos="fade-down"><a href="{{{ asset('new_template/images/img2.jpg') }}}"><img class="img-fluid" src="{{{ asset('new_template/images/img2.jpg') }}}"></a></div>
                                        <div class="box2" data-aos="fade-up"><a href="{{{ asset('new_template/images/img3.jpg') }}}"><img class="img-fluid" src="{{{ asset('new_template/images/img3.jpg') }}}"></a></div>
                                    </div>
                                    <div class="col-md-4" data-aos="fade-left">
                                        <div class="box"><a href="{{{ asset('new_template/images/img4.jpg') }}}"><img class="img-fluid" src="{{{ asset('new_template/images/img4.jpg') }}}"></a></div>
                                    </div><br>
                                    <div class="col-md-4" data-aos="fade-right">
                                        <div class="box"><a href="{{{ asset('new_template/images/img5.jpg') }}}"><img class="img-fluid" src="{{{ asset('new_template/images/img5.jpg') }}}"></a></div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="box2" data-aos="fade-down"><a href="{{{ asset('new_template/images/img6.jpg') }}} "><img class="img-fluid" src="{{{ asset('new_template/images/img6.jpg') }}}"></a></div>
                                        <div class="box2" data-aos="fade-up"><a href="{{{ asset('new_template/images/img7.jpg') }}}"><img class="img-fluid" src="{{{ asset('new_template/images/img7.jpg') }}}"></a></div>
                                    </div>
                                    <div class="col-md-4" data-aos="fade-left">
                                        <div class="box"><a href="{{{ asset('new_template/images/img8.jpg') }}}"><img class="img-fluid" src="{{{ asset('new_template/images/img8.jpg') }}}"></a></div>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>


<section class="third">
    <div class="container">

<div class="box-new">
<div class="row">
    <div class="col-md-5" data-aos="zoom-in">

    <div class="inner-img">

        <!-- <img loading="lazy" src="{{{ asset('new_template/images/p-1.png') }}}" class="img-fluid"> -->
        <img loading="lazy" src="{{ url('/') }}/home_page/sections_assets/{{ $homePageSettings->section1_image }}" class="img-fluid">
    </div>
    </div>
<div class="col-md-7" data-aos="fade-left">

    <div class="inner-text" >
        <!-- <h1>Best photography</h1>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus lacinia odio vitae vestibulum vestibulum. </p>
        <a class="theme-btn" href="#">Get Started</a> -->
        <h1>{{ $homePageSettings->section1_heading }}</h1>
        <p>{{ $homePageSettings->section1_description }}</p>
        <a class="theme-btn" href="{{ $homePageSettings->section1_button_link }}">{{ $homePageSettings->section1_button_text }}</a>

    </div>
    </div>
</div>
</div>

<div class="box-new">
<div class="row">

<div class="col-md-7" data-aos="fade-right">

    <div class="inner-text2">
        <!-- <h1>Best audio</h1>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus lacinia odio vitae vestibulum vestibulum. </p>
        <a class="theme-btn" href="#">Get Started</a> -->
        <h1>{{ $homePageSettings->section2_heading }}</h1>
        <p>{{ $homePageSettings->section2_description }}</p>
        <a class="theme-btn" href="{{ $homePageSettings->section2_button_link }}">{{ $homePageSettings->section2_button_text }}</a>
    </div>
    </div>
    <div class="col-md-5">

    <div class="inner-img" data-aos="zoom-in">
    <!-- <img loading="lazy" src="{{{ asset('new_template/images/p-2.png') }}}" class="img-fluid"> -->
        <img loading="lazy" src="{{ url('/') }}/home_page/sections_assets/{{ $homePageSettings->section2_image }}" class="img-fluid">
    </div>
    </div>
</div>
</div>
<div class="box-new">
<div class="row">
    <div class="col-md-5" data-aos="zoom-in">

    <div class="inner-img">
    <!-- <img loading="lazy" src="{{{ asset('new_template/images/p-3.png') }}}" class="img-fluid"> -->
        <img loading="lazy" src="{{ url('/') }}/home_page/sections_assets/{{ $homePageSettings->section3_image }}" class="img-fluid">
    </div>
    </div>
<div class="col-md-7" data-aos="fade-left">

    <div class="inner-text" >
        <!-- <h1>Best videos</h1>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus lacinia odio vitae vestibulum vestibulum. </p>
        <a class="theme-btn" href="#">Get Started</a> -->
        <h1>{{ $homePageSettings->section3_heading }}</h1>
        <p>{{ $homePageSettings->section3_description }} </p>
        <a class="theme-btn" href="{{ $homePageSettings->section3_button_link }}">{{ $homePageSettings->section3_button_text }}</a>
    </div>
    </div>
</div>
</div>

<div class="box-new">
<div class="row">

<div class="col-md-7 aos-init aos-animate" data-aos="fade-right">

    <div class="inner-text2">
        <!-- <h1>Best Animation</h1>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus lacinia odio vitae vestibulum vestibulum. </p>
        <a class="theme-btn" href="#">Get Started</a> -->
        <h1>{{ $homePageSettings->section4_heading }}</h1>
        <p>{{ $homePageSettings->section4_description }} </p>
        <a class="theme-btn" href="{{ $homePageSettings->section4_button_link }}">{{ $homePageSettings->section4_button_text }}</a>
    </div>
    </div>
    <div class="col-md-5">

    <div class="inner-img aos-init aos-animate" data-aos="zoom-in">
        <!-- <img loading="lazy" src="{{{ asset('new_template/images/p-4.png') }}}" class="img-fluid"> -->
        <img loading="lazy" src="{{ url('/') }}/home_page/sections_assets/{{ $homePageSettings->section4_image }}" class="img-fluid">
    </div>
    </div>
</div>
</div>
    </div>
</section>
<section class="fouth" style="background: url(http://localhost/gostock/home_page/footer_assets/{{ $homePageSettings->footer1_image }}) fixed #121c1d;">
<div class="container">
<div class="row">
<div class="col-md-6 float-right">


</div>
<div class="col-md-6 float-right" data-aos="fade-down">

    <div class="fourth-box">


        <h1>{{ $homePageSettings->footer1_heading }}</h1>
        <p>{{ $homePageSettings->footer1_description }} </p>
        <a class="theme-btn" href="{{ $homePageSettings->footer1_button_link }}">{{ $homePageSettings->footer1_button_text }}</a>

    </div>
</div>
</div>
</div>

</section>



<section class="contact" data-aos="zoom-in" style="background: url(http://localhost/gostock/home_page/footer_assets/{{ $homePageSettings->footer2_image }}) fixed #000;">
    <div class="container">
        <div class="row">
            <div class="col-12">
            <div class="contact-banner-text">

                <h1>{{ $homePageSettings->footer2_heading }}</h1>
                <p>{{ $homePageSettings->footer2_description }}</p>
<div class='search-container'>
<i id="search" class="fas fa-search fa-3x hide"></i>
<input id="text" type='text' placeholder='Your Email' class='search-input'>
<span id="btn">
{{ $homePageSettings->footer2_button_text }}  </span>
</div>
            </div>
            </div>
        </div>
    </div>


</section>
@endsection
