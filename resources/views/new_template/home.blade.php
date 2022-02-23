@extends('new_template.layouts.app')
@section('content')
    {{-- {{ dd(Auth::user()) }} --}}

    <section class="banner"
             style="background-image: url(<?php echo asset('home_page/header_assets/') . '/' . $homePageSettings->header_main_image; ?>) ">
        <div class="container">
            <div class="row">
                <div class="col-md-10 offset-md-1">
                    <div>
                        <div class="text" data-aos="fade-right">
                            <h1>{{ $homePageSettings->header_description }}</h1>
                        <!-- <div class="form-group width">
								<form action="{{ url('/search') }}" method="get">
									<input class="form-control" id="q" name="q" placeholder="Search Here" type="">
									<input type="submit" value="search">
								</form>
								<p>Suggested: love, harmony, r&b, pop, nature</p>
							</div> -->
                        </div>
                        <form action="{{ url('/search') }}" id="formSearch" method="get">
                            <input type="hidden" id="sort-Fresh" class="btn-sort-by-search" name="sort" value="Fresh">
                            <div class="main-search-bar">
                                <div class="row no-gutters">

                                    <div class="col-6 col-md-2">
                                        <select class="select2-icon" name="by" id="by">
                                            <option selected value="by-industry">By Industry</option>
                                            <option value="by-profession">By Profession</option>

                                        </select>
                                    </div>
                                    <div class="col-6 col-md-2 second-search">
                                        <select class="select22-icon" name="type" id="type">
                                            <option value="all">All</option>
                                            <?php
                                            $getCategoriesSearchBar = \App\Models\Categories::where('slug', '!=', 'uncategorized')->where('parent_id', '=', '0')->get();

                                            foreach ($getCategoriesSearchBar as $categSearchBar) {
                                            ?>
                                            <option value="{{ $categSearchBar->id }}"
                                                    data-icon="fas {{$categSearchBar->icon_text }}">{{ $categSearchBar->name }}</option>
                                            <?php
                                            }
                                            ?>
                                        </select>

                                        <select class="select222-icon" id="artist" style="display:none;">
                                            <option value="all" data-icon="far fa-images">All</option>
                                            <?php
                                            $getCategoriesSearchBar = \App\Models\Types::get();

                                            foreach ($getCategoriesSearchBar as $categSearchBar) {
                                            ?>
                                            <option value="{{ $categSearchBar->types_id }}"
                                                    data-icon="fas fa-photo-video">{{ $categSearchBar->type_name }}</option>
                                            <?php
                                            }
                                            ?>
                                            <?php
                                            // $getTypeSearchBar = \App\Models\Types::get();

                                            // foreach($getTypeSearchBar as $typeSearchBar){
                                            ?>
                                            {{-- <!-- <option value="{{ $typeSearchBar->types_id }}" data-icon="fas fa-photo-video">{{ $typeSearchBar->type_name }}</option> -->--}}
                                            <?php
                                            // }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-8 col-12 mt-3 mt-md-0">
                                        <div class="input-group">
                                            <input type="text" class="form-control mt-0" name="txt_search"
                                                   placeholder="Search">
                                            <div class="input-group-append">
                                                <button class="btn btn-secondary" id="btnSubmitSearch" type="button">
                                                    Find Now
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="tabs">
        <div class="container">
            <div class="row">

                <div class="tabs">
                    <div class="tabs__navigation" data-aos="fade-down">
                        <button data-target="first" class="active">Recent</button>

                        {{-- @foreach($categoriesList as $category) --}}
                        {{-- <!--<button id="buttonCategories|{{ $category->slug }}" data-target="{{ $category->slug }}">{{ $category->name }}</button>--> --}}
                        {{-- @endforeach --}}
                        @foreach(  App\Models\Categories::where('mode','on')->where('link_with' , '!=', '0')->where('parent_id','=','0')->orderBy('name')->take(9)->get() as $category )
                            @if($category->name != "Uncategorized")
                                <a href="{{ url('category') }}/{{ $category->slug }}">{{ $category->name }}</a>
                            @endif
                        @endforeach
                    </div>
                    <div id="tabs__content">
                        <div class="single__tab active first">
                            <div class="container">
                                @php
                                    $i = 0;
                                @endphp
                                @if($images->count() > 0)
                                    <section id="photos" class="baguetteBoxOne gallery">

                                        @foreach($images as $image)

                                            @php
                                                $colors = explode(",", $image->colors);
                                                $color = $colors[0];
                                                if($image->extension == 'png' ) {
                                                $background = 'background: url('.url('img/pixel.gif').') repeat center center #e4e4e4;';
                                                } else {
                                                $background = 'background-color: #'.$color.'';
                                                }
                                                if($settings->show_watermark == '1') {
                                                $thumbnail = 'uploads/preview/'.$image->preview;
                                                } else {
                                                $stockImage = App\Models\Stock::whereImagesId($image->id)->whereType('small')->select('name')->first();
                                                $thumbnail = 'uploads/small/'.$stockImage->name;
                                                }

                                                $watermarkedVideoPath = 'uploads/video/water_mark_large/';
                                            @endphp
                                            @if($image->is_type == "video")
                                                @if(File::exists(public_path('uploads/video/water_mark_large/watermark-'.$image->thumbnail)))
                                                    <div class="box">
                                                        <a href="{{ url('video', $image->id ) }}/{{str_slug($image->title)}}">
                                                            <video onmouseover="this.play()" onmouseout="this.pause()"
                                                                   width="320" height="240" muted loop>
                                                                @if($image->extension == "mp4")
                                                                    <source
                                                                        src="{{ asset($watermarkedVideoPath) }}{{ '/watermark-'.$image->thumbnail }}"
                                                                        type="video/mp4">
                                                            @endif
                                                            <!-- <source src="movie.ogg" type="video/ogg"> -->
                                                                Your browser does not support the video tag.
                                                            </video>
                                                        </a>
                                                    </div>
                                                @endif
                                            @elseif($image->is_type == "image")
                                                <div class="box">
                                                    <a href="{{ url('photo', $image->id ) }}/{{str_slug($image->title)}}"><img
                                                            class="img-fluid" src="{{ asset($thumbnail) }}"></a>
                                                </div>
                                            @else
                                            <!-- audio files goes here -->
                                            @endif
                                        @endforeach

                                    </section>
                                @else
                                    <div class="row">
                                        <div class="col-md-12 margin-top-20 margin-bottom-20">
                                            <div class="btn-block text-center">
                                                <i class="icon icon-Picture ico-no-result"></i>
                                            </div>
                                            <h3 class="margin-top-none text-center no-result no-result-mg">
                                                No results have been found
                                            </h3>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>

                        @foreach($categoriesList as $category)
                            <div class="single__tab  {{ $category->slug }}" id="content-{{ $category->slug }}">
                                <div class="container innr-content-{{ $category->slug }} baguetteBoxOne gallery">
                                    <section id="photos"
                                             class="baguetteBoxOne gallery inside-content-{{ $category->slug }}">
                                    </section>
                                </div>
                            </div>
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
                    <div class="col-md-5 aos-init aos-animate  mt-4 mt-md-0" data-aos="zoom-in">
                        <div class="owl-carousel slide owl-theme">
                            <div class="item">
                                <div class="inner-img">
                                    <img
                                        src="{{ url('/') }}/home_page/sections_assets/{{ $homePageSettings->section1_image }}"
                                        class="img-fluid">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7 aos-init aos-animate" data-aos="zoom-in">
                        <div class="inner-text">
                            <h1>{{ $homePageSettings->section1_heading }}</h1>
                            <p>{{ $homePageSettings->section1_description }} </p>
                            <a class="theme-btn"
                               href="{{ $homePageSettings->section1_button_link }}">{{ $homePageSettings->section1_button_text }}</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box-new">
                <div class="row">
                    <div class="col-md-7 aos-init aos-animate" data-aos="zoom-in">
                        <div class="inner-text2">
                            <h1>{{ $homePageSettings->section2_heading }}</h1>
                            <p>{{ $homePageSettings->section2_description }}</p>
                            <a class="theme-btn"
                               href="{{ $homePageSettings->section2_button_link }}">{{ $homePageSettings->section2_button_text }}</a>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="owl-carousel slide owl-theme">
                            <div class="item">
                                <div class="inner-img aos-init aos-animate" data-aos="zoom-in">
                                    <img
                                        src="{{ url('/') }}/home_page/sections_assets/{{ $homePageSettings->section2_image }}"
                                        class="img-fluid">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box-new">
                <div class="row">
                    <div class="col-md-5 aos-init aos-animate  mb-4 mb-md-0 mt-4 mt-md-0" data-aos="zoom-in">
                        <div class="owl-carousel slide owl-theme">
                            <div class="item">
                                <div class="inner-img">
                                    <img
                                        src="{{ url('/') }}/home_page/sections_assets/{{ $homePageSettings->section3_image }}"
                                        class="img-fluid">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7 aos-init aos-animate" data-aos="zoom-in">
                        <div class="inner-text">
                            <h1>{{ $homePageSettings->section3_heading }}</h1>
                            <p>{{ $homePageSettings->section3_description }} </p>
                            <a class="theme-btn"
                               href="{{ $homePageSettings->section3_button_link }}">{{ $homePageSettings->section3_button_text }}</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box-new">
                <div class="row">
                    <div class="col-md-7 aos-init aos-animate" data-aos="zoom-in">
                        <div class="inner-text2">
                            <h1>{{ $homePageSettings->section4_heading }}</h1>
                            <p>{{ $homePageSettings->section4_description }} </p>
                            <a class="theme-btn"
                               href="{{ $homePageSettings->section4_button_link }}">{{ $homePageSettings->section4_button_text }}</a>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="owl-carousel slide owl-theme">
                            <div class="item">
                                <div class="inner-img aos-init aos-animate" data-aos="zoom-in">
                                    <img
                                        src="{{ url('/') }}/home_page/sections_assets/{{ $homePageSettings->section4_image }}"
                                        class="img-fluid">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section-popular mb-5">
        <div class="container">
            <div class="row mb-4">
                <div class="col-12">
                    <div class="d-flex">
                        <div class="">
                            <h1 class="popular-title">Popular Artist</h1>
                        </div>
                        <div class="ml-auto align-self-center">
                            {{-- <a class="btn-see-all" href="">See All</a> --}}
                        </div>
                    </div>
                </div>
            </div>

            <div class="margin-top-destination-location-box">

                <carousel>
                    <div class="owl-carousel owl-theme slider-artist-new">
                        <?php
                        foreach($userArtistListPhotographer as $userPhotographer){
                        ?>
                        <div class="">

                            <div class="choose-photographer-box">
                                <div class="pt-4 pb-4 pl-3 pr-3">
                                    <div class="">
                                        <a href="<?php echo url('/')?>/artist/<?php echo $userPhotographer->id; ?>">
                                            <img
                                                src="<?php echo url('/')?>/avatar/<?php echo $userPhotographer->avatar; ?>"
                                                alt="" class="photographer-thimbnial">
                                        </a>
                                        <h4 class="title-this-photographer">{{ $userPhotographer->username }}</h4>
                                        <p class="tag-one-photographer">{{ $userPhotographer->type_name }}</p>
                                        <p class="tag-one-photographer"
                                           style="    margin-left: 77px;">{{ $userPhotographer->CountryName }}</p>

                                        <div class="mt-4" style="text-align: center;">
                                            <?php
                                            $queryGetDataById = App\Models\Images::where(['is_type' => 'image', 'user_id' => $userPhotographer->id])->limit(4)->get();
                                            if(count($queryGetDataById) > 0){


                                            ?>
                                            @foreach($queryGetDataById as $dataUserImages)
                                                @php
                                                    if($settings->show_watermark == '1') {
                                                        $thumbnail = 'uploads/preview/'.$dataUserImages->preview;
                                                    } else {
                                                        $stockImage = App\Models\Stock::whereImagesId($dataUserImages->id)->whereType('small')->select('name')->first();
                                                        $thumbnail = 'uploads/small/'.$stockImage->name;
                                                    }
                                                @endphp
                                                <a data-fancybox href="{{ asset($thumbnail) }}"
                                                   data-id="{{$dataUserImages->id}}"
                                                   data-title="{{$dataUserImages->title}}"
                                                   data-description="{{$dataUserImages->description}}"
                                                   data-price="{{$dataUserImages->price}}" data-typee="photo">
                                                    <img src="{{ asset($thumbnail) }}" alt="" class="set-img-size">
                                                </a>
                                        @endforeach
                                        <?php
                                        }
                                        ?>
                                        </div>

                                    </div>
                                </div>
                                <div class="bottom"
                                     style="background-image: url(https://projects.hexawebstudio.com/darquise-nantel/uploads/thumbnail/musicWave.png)">
                                    <div class="">
                                        <div class="d-md-flex">
                                            <a href="<?php echo url('/')?>/artist/<?php echo $userPhotographer->id; ?>"
                                               class="btn-portfolio-one w-100 mt-0">Portfolio</a>
                                        <!--&amp;cityId=<?php //echo $userPhotographer->city_id; ?>-->
                                            <a href="<?php echo url('/')?>/request-to-book?photographerId=<?php echo $userPhotographer->id;?>"
                                               class="button-book-one w-100">Book artist</a>

                                        </div>
                                    </div>
                                </div>
                            </div>

                        <?php
                        //if($userPhotographer->type_name == "Photographer"){
                        ?>
                        <!--                <div class="bottom" style="background-image:url({{ url('/') }}/uploads/thumbnail/{{ $userPhotographer->img }})">-->
                            <!--                    <div class="row">-->
                            <!--                        <div class="col-5 offset-7">-->
                        <!--                            <a href="<?php echo url('/')?>/artist/<?php echo $userPhotographer->id; ?>" class="btn-portfolio-one mb-2">Portfolio</a>-->
                        <!--                            <a href="<?php echo url('/')?>/request-to-book?photographerId=<?php echo $userPhotographer->id;?>&cityId=<?php echo $userPhotographer->city_id; ?>" class="button-book-one mb-2">Book artist</a>-->
                            <!--<a href="javascript:;" v-if="suser != ''" @click="addToActiveChat(photoUser)" class="button-chat-two" >Chat</a>-->
                            <!--                        </div>-->
                            <!--                    </div>-->
                            <!--                </div>-->
                        <?php
                        //     }
                        ?>
                        <!--    </div>-->
                            <!--</div>  -->

                        </div>
                        <?php
                        }
                        ?>
                        <?php
                        foreach($userArtistListVideographer as $userVideographer){
                        // dd($userPhotographer);
                        ?>
                        <div class="">

                            <!--<div class="col-md-4">-->
                            <div class="choose-photographer-box">
                                <div class="pt-4 pb-4 pl-3 pr-3">
                                    <div class="">
                                    <!--<img src="<?php //echo url('/')?>/avatar/<?php //echo $userVideographer->avatar; ?>" alt="" class="photographer-thimbnial">-->
                                        <a href="<?php echo url('/')?>/artist/<?php echo $userVideographer->id; ?>">
                                            <img
                                                src="<?php echo url('/')?>/avatar/<?php echo $userVideographer->avatar; ?>"
                                                alt="" class="photographer-thimbnial">
                                        </a>
                                        <h4 class="title-this-photographer">{{ $userVideographer->username }}</h4>
                                        <p class="tag-one-photographer">{{ $userVideographer->type_name }}</p>
                                        <p class="tag-one-photographer"
                                           style="    margin-left: 77px;">{{ $userVideographer->CountryName }}</p>

                                        <div class="mt-4" style="text-align: center;">
                                        <?php
                                        $queryVideosGetDataById = App\Models\Images::where(['is_type' => 'video', 'user_id' => $userVideographer->id])->limit(4)->get();
                                        // var_dump($userVideographer->id);
                                        // dd(count($queryVideosGetDataById));
                                        if(count($queryVideosGetDataById) > 0){


                                        ?>
                                        @foreach($queryVideosGetDataById as $dataUserVideos)
                                            @php
                                                if($settings->show_watermark == '1') {
                                                    $thumbnail = 'uploads/preview/'.$dataUserVideos->preview;
                                                } else {
                                                    $stockImage = App\Models\Stock::whereImagesId($dataUserVideos->id)->whereType('small')->select('name')->first();
                                                    $thumbnail = 'uploads/small/'.$stockImage->name;
                                                }

                                                $watermarkedVideoPathScreenShot = 'uploads/video/screen_shot/';
                                                $watermarkedVideoPath = 'uploads/video/water_mark_large/';

                                                $VideoFileScreenShotName = explode('.', $dataUserVideos->thumbnail)[0];

                                                $realVideoFileName = $dataUserVideos->thumbnail;
                                            @endphp
                                            <!--<a data-fancybox href="{{ asset($watermarkedVideoPath) }}{{ '/screen-shot-'.$VideoFileScreenShotName.'.png' }}">-->
                                                <a data-fancybox
                                                   href="{{ asset($watermarkedVideoPath) }}{{ '/watermark-'.$realVideoFileName }}"
                                                   data-id="{{$dataUserVideos->id}}"
                                                   data-title="{{$dataUserVideos->title}}"
                                                   data-description="{{$dataUserVideos->description}}"
                                                   data-price="{{$dataUserVideos->price}}" data-typee="video">
                                                    <img
                                                        src="{{ asset($watermarkedVideoPathScreenShot) }}{{ '/screen-shot-'.$VideoFileScreenShotName.'.png' }}"
                                                        alt="" class="set-img-size">
                                                </a>
                                        @endforeach
                                        <?php
                                        }
                                        ?>
                                        <!--<img src="<?php //echo url('/')?>/avatar/<?php //echo $userVideographer->avatar; ?>" alt="" class="set-img-size">-->
                                        <!--<img src="<?php //echo url('/')?>/avatar/<?php //echo $userVideographer->avatar; ?>" alt="" class="set-img-size">-->
                                        <!--<img src="<?php //echo url('/')?>/avatar/<?php //echo $userVideographer->avatar; ?>" alt="" class="set-img-size">-->
                                        </div>

                                    </div>
                                </div>
                                <div class="bottom"
                                     style="background-image: url(https://projects.hexawebstudio.com/darquise-nantel/uploads/thumbnail/musicWave.png)">
                                    <div class="">
                                        <div class="d-md-flex">
                                            <a href="<?php echo url('/')?>/artist/<?php echo $userVideographer->id; ?>"
                                               class="btn-portfolio-one w-100 mt-0">Portfolio</a>
                                        <!--&amp;cityId=<?php //echo $userVideographer->city_id; ?>-->
                                            <a href="<?php echo url('/')?>/request-to-book?photographerId=<?php echo $userVideographer->id;?>"
                                               class="button-book-one w-100">Book artist</a>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--</div>-->


                            <!--<div class="mb-4-cutom">-->
                            <!--    <div class="choose-photographer-box" style="margin:10px;">-->
                            <!--        <div class="header-photographer">-->
                            <!--            <div class="row">-->
                            <!--                <div class="col-sm-4">-->
                        <!--                    <img src="<?php //echo url('/')?>/avatar/<?php //echo $userVideographer->avatar; ?>" alt="" class="set-img-size" style="width:100px;">-->
                            <!--                </div>-->
                            <!--                <div class="col-sm-7 offset-md-1">-->
                        <!--                    <h4 class="title-this">{{ $userVideographer->username }}</h4>-->
                        <!--                        <p class="tag-one">{{ $userVideographer->type_name }}</p>-->

                            <!-- <p class="tag-two">Available</p> -->
                            <!--                </div>-->
                            <!--            </div>-->
                            <!--        </div>    -->
                        <?php
                        //if($userVideographer->type_name == "Videographer"){
                        ?>
                        <!--                 <div class="bottom" style="background-image:url({{ url('/') }}/uploads/video/screen_shot/{{ $userVideographer->img }})">-->
                            <!--                    <div class="row">-->
                            <!--                        <div class="col-5 offset-7">-->
                        <!--                            <a href="<?php //echo url('/') ?>/artist/<?php //echo $userVideographer->id; ?>" class="btn-portfolio-one mb-2">Portfolio</a>-->
                        <!--                            <a href="<?php //echo url('/') ?>/request-to-book?photographerId='<?php //echo $userVideographer->id ?>&cityId=<?php //echo $userVideographer->city_id; ?>" class="button-book-one mb-2">Book artist</a>-->
                            <!--<a href="javascript:;" v-if="suser != ''"  @click="addToActiveChat(animatorUser)" class="button-chat-two" >Chat</a>-->
                            <!--                        </div>-->
                            <!--                    </div>-->
                            <!--                </div>-->

                        <?php
                        // }
                        ?>
                        <!--    </div>-->
                            <!--</div>  -->

                        </div>
                        <?php
                        }
                        ?>
                        <?php
                        foreach($userArtistListAnimator as $userAnimator){
                        // dd($userPhotographer);
                        ?>
                        <div class="">

                            <!--<div class="col-md-4">-->
                            <div class="choose-photographer-box">
                                <div class="pt-4 pb-4 pl-3 pr-3">
                                    <div class="">
                                    <!--<img src="<?php //echo url('/')?>/avatar/<?php //echo $userAnimator->avatar; ?>" alt="" class="photographer-thimbnial">-->
                                        <a href="<?php echo url('/')?>/artist/<?php echo $userAnimator->id; ?>">
                                            <img
                                                src="<?php echo url('/')?>/avatar/<?php echo $userAnimator->avatar; ?>"
                                                alt="" class="photographer-thimbnial">
                                        </a>
                                        <h4 class="title-this-photographer">{{ $userAnimator->username }}</h4>
                                        <p class="tag-one-photographer">{{ $userAnimator->type_name }}</p>
                                        <p class="tag-one-photographer"
                                           style="    margin-left: 77px;">{{ $userPhotographer->CountryName }}</p>

                                        <div class="mt-4" style="text-align: center;">
                                            <?php
                                            $queryAnimationsGetDataById = App\Models\Images::where(['is_type' => 'video', 'user_id' => $userAnimator->id])->limit(4)->get();
                                            // var_dump($userAnimator->id);
                                            // dd(count($queryAnimationsGetDataById));
                                            if(count($queryAnimationsGetDataById) > 0){


                                            ?>
                                            @foreach($queryAnimationsGetDataById as $dataUserAnimations)
                                                @php
                                                    if($settings->show_watermark == '1') {
                                                        $thumbnail = 'uploads/preview/'.$dataUserAnimations->preview;
                                                    } else {
                                                        $stockImage = App\Models\Stock::whereImagesId($dataUserAnimations->id)->whereType('small')->select('name')->first();
                                                        $thumbnail = 'uploads/small/'.$stockImage->name;
                                                    }

                                                    $watermarkedVideoPathScreenShot = 'uploads/video/screen_shot/';

                                                    $AnimationFileScreenShotName = explode('.', $dataUserAnimations->thumbnail)[0];

                                                    $watermarkedVideoPath = 'uploads/video/water_mark_large/';

                                                    $realVideoFileName = $dataUserAnimations->thumbnail;
                                                @endphp
                                                <a data-fancybox
                                                   href="{{ asset($watermarkedVideoPath) }}{{ '/watermark-'.$realVideoFileName }}"
                                                   data-id="{{$dataUserAnimations->id}}"
                                                   data-title="{{$dataUserAnimations->title}}"
                                                   data-description="{{$dataUserAnimations->description}}"
                                                   data-price="{{$dataUserAnimations->price}}" data-typee="video">
                                                    <img
                                                        src="{{ asset($watermarkedVideoPathScreenShot) }}{{ '/screen-shot-'.$AnimationFileScreenShotName.'.png' }}"
                                                        alt="" class="set-img-size">
                                                </a>
                                            @endforeach
                                        <!--<img src="<?php echo url('/')?>/avatar/<?php echo $userAnimator->avatar; ?>" alt="" class="set-img-size">-->
                                        <!--<img src="<?php echo url('/')?>/avatar/<?php echo $userAnimator->avatar; ?>" alt="" class="set-img-size">-->
                                        <!--<img src="<?php echo url('/')?>/avatar/<?php echo $userAnimator->avatar; ?>" alt="" class="set-img-size">-->
                                            <?php
                                            }else{
                                            ?>
                                            <p class="dummy-text-when-another-div-empty">
                                                No Animation Available
                                            </p>
                                            <?php
                                            }
                                            ?>
                                        </div>

                                    </div>
                                </div>
                                <div class="bottom"
                                     style="background-image: url(https://projects.hexawebstudio.com/darquise-nantel/uploads/thumbnail/musicWave.png)">
                                    <div class="">
                                        <div class="d-md-flex">
                                            <a href="<?php echo url('/')?>/artist/<?php echo $userAnimator->id; ?>"
                                               class="btn-portfolio-one w-100 mt-0">Portfolio</a>
                                        <!--&amp;cityId=<?php //echo $userAnimator->city_id; ?>-->
                                            <a href="<?php echo url('/')?>/request-to-book?photographerId=<?php echo $userAnimator->id;?>"
                                               class="button-book-one w-100">Book artist</a>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--</div>-->

                            <!--<div class="mb-4-cutom">-->
                            <!--    <div class="choose-photographer-box" style="margin:10px;">-->
                            <!--        <div class="header-photographer">-->
                            <!--            <div class="row">-->
                            <!--                <div class="col-sm-4">-->
                        <!--                    <img src="<?php //echo url('/')?>/avatar/<?php //echo $userAnimator->avatar; ?>" alt="" class="set-img-size" style="width:100px;">-->
                            <!--                </div>-->
                            <!--                <div class="col-sm-7 offset-md-1">-->
                        <!--                    <h4 class="title-this">{{ $userAnimator->username }}</h4>-->
                        <!--                        <p class="tag-one">{{ $userAnimator->type_name }}</p>-->

                            <!-- <p class="tag-two">Available</p> -->
                            <!--                </div>-->
                            <!--            </div>-->
                            <!--        </div>    -->
                        <?php
                        // if($userAnimator->type_name == "Animator"){
                        ?>
                        <!--                <div class="bottom" style="background-image:url(<?php //echo url('/'); ?>/uploads/video/screen_shot/<?php //echo $userAnimator->ScreenShot; ?>)">-->
                            <!--                    <div class="row">-->
                            <!--                        <div class="col-5 offset-7">-->
                        <!--                            <a href="<?php //echo url('/') ?>/artist/<?php //echo $userAnimator->id; ?>" class="btn-portfolio-one mb-2">Portfolio</a>-->
                        <!--                            <a href="<?php //echo url('/') ?>/request-to-book?photographerId=<?php //echo $userAnimator->id ?>&cityId=<?php //echo $userAnimator->city_id; ?>" class="button-book-one mb-2">Book artist</a>-->
                            <!--<a href="javascript:;" v-if="suser != ''"  @click="addToActiveChat(animatorUser)" class="button-chat-two" >Chat</a>-->
                            <!--                        </div>-->
                            <!--                    </div>-->
                            <!--                </div>-->

                        <?php
                        // }
                        ?>


                        <!--    </div>-->
                            <!--</div>  -->

                        </div>
                        <?php
                        }
                        ?>
                        <?php
                        foreach($userArtistListMusician as $userMusician){
                        // dd($userPhotographer);
                        ?>
                        <div class="">

                            <!--<div class="col-md-4">-->
                            <div class="choose-photographer-box">
                                <div class="pt-4 pb-1 pl-3 pr-3">
                                    <div class="">
                                        <img
                                            src="<?php echo url('/')?>/avatar/<?php echo $userMusician->avatar; ?>"
                                            alt="" class="photographer-thimbnial">
                                        <h4 class="title-this-photographer">{{ $userMusician->username }}</h4>
                                        <p class="tag-one-photographer">{{ $userMusician->type_name }}</p>
                                        <p class="tag-one-photographer"
                                           style="    margin-left: 77px;">{{ $userPhotographer->CountryName }}</p>

                                        <div class="mt-4" style="text-align: center;">
                                        <?php
                                        $queryMusiciansGetDataById = App\Models\Images::where(['is_type' => 'audio', 'user_id' => $userMusician->id])->limit(1)->get();
                                        // var_dump($userMusician->id);
                                        // dd(count($queryMusiciansGetDataById));
                                        if(count($queryMusiciansGetDataById) > 0){


                                        ?>
                                        @foreach($queryMusiciansGetDataById as $dataUserMusicians)
                                            {{--  @php --}}
                                            <!--if($settings->show_watermark == '1') {-->
                                                <!-- $thumbnail = 'public/uploads/preview/'.$dataUserMusicians->thumbnail;-->
                                                <!--} else {-->
                                                <!--				$stockImage = App\Models\Stock::whereImagesId($dataUserMusicians->id)->whereType('small')->select('name')->first();-->
                                                <!--				$thumbnail = 'public/uploads/small/'.$stockImage->name;-->
                                                <!--}-->

                                                $watermarkedMusicPath = 'uploads/audio/large/';

                                            {{-- @endphp  --}}
                                            <!--<div class="row">-->
                                                <!--				<div class="col-2 align-self-center">-->
                                                <!--                                <a href="javascript:;" class="btn-music-play" id="playMusic">-->
                                                <!--                                    <i class="fas fa-play"></i>-->
                                                <!--                                </a>-->
                                                <!--                                <a href="javascript:;" class="btn-music-play" id="pauseMusic" style="display: none;">-->
                                                <!--                                    <i class="fas fa-pause"></i>-->
                                                <!--                                </a>-->
                                                <!--                            </div>-->
                                                <!--				<div class="col-10">-->

                                                <!--                              <div id="waveform"></div>-->
                                                <!--<wavesurfer-->
                                                <!--    data-url="http://ia902606.us.archive.org/35/items/shortpoetry_047_librivox/song_cjrg_teasdale_64kb.mp3"-->
                                                <!--    data-plugins="minimap,timeline"-->

                                                <!--    data-minimap-height="30"-->
                                                <!--    data-minimap-wave-color="#ddd"-->
                                                <!--    data-minimap-progress-color="#999"-->
                                                <!--    data-timeline-font-size="13px"-->
                                                <!--    data-timeline-container="#timeline"-->
                                                <!-->
                                                <!--</wavesurfer>-->
                                                <!--<div id="timeline"></div>-->
                                                <!--                            </div>-->
                                                <!--</div>-->
                                                <div class="wave d-flex"
                                                     data-path="{{ asset('uploads/audio/large'). '/'. $dataUserMusicians->thumbnail }}">
                                                    <div class="align-self-center music-col-2">
                                                        <a href="javascript:;" class="btn-music-play"
                                                           id="baton-playMusic#{{ $dataUserMusicians->thumbnail}}">
                                                            <i class="fas fa-play"></i>
                                                        </a>
                                                        <a href="javascript:;" class="btn-music-play"
                                                           id="baton-pauseMusic#{{ $dataUserMusicians->thumbnail }}"
                                                           style="display: none;">
                                                            <i class="fas fa-pause"></i>
                                                        </a>
                                                    </div>

                                                    <div class="wave-container music-col-10"></div>
                                                </div>


                                            @endforeach
                                            <?php
                                            }else{
                                            ?>
                                            <p class="dummy-text-when-another-div-empty">
                                                No Music Available
                                            </p>

                                            <?php
                                            }
                                            ?>
                                        </div>

                                    </div>
                                </div>
                                <div class="bottom"
                                     style="background-image: url(https://projects.hexawebstudio.com/darquise-nantel/uploads/thumbnail/musicWave.png)">
                                    <div class="">
                                        <div class="d-md-flex">
                                            <a href="<?php echo url('/')?>/artist/<?php echo $userMusician->id; ?>"
                                               class="btn-portfolio-one w-100 mt-0">Portfolio</a>
                                        <!--&amp;cityId=<?php //echo $userMusician->city_id; ?>-->
                                            <a href="<?php echo url('/')?>/request-to-book?photographerId=<?php echo $userMusician->id;?>"
                                               class="button-book-one w-100">Book artist</a>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--</div>-->

                            <!--<div class="mb-4-cutom">-->
                            <!--    <div class="choose-photographer-box" style="margin:10px;">-->
                            <!--        <div class="header-photographer">-->
                            <!--            <div class="row">-->
                            <!--                <div class="col-sm-4">-->
                        <!--                    <img src="<?php echo url('/')?>/avatar/<?php //echo $userMusician->avatar; ?>" alt="" class="set-img-size" style="width:100px;">-->
                            <!--                </div>-->
                            <!--                <div class="col-sm-7 offset-md-1">-->
                        <!--                    <h4 class="title-this">{{ $userMusician->username }}</h4>-->
                        <!--                        <p class="tag-one">{{ $userMusician->type_name }}</p>-->

                            <!-- <p class="tag-two">Available</p> -->
                            <!--                </div>-->
                            <!--            </div>-->
                            <!--        </div>    -->
                        <?php
                        // if($userMusician->type_name == "Musician"){
                        ?>
                        <!--                <div class="bottom" style="background-image:url(<?php echo url('/')?>/uploads/video/screen_shot/<?php //echo $userMusician->ScreenShot; ?>)">-->
                            <!--                    <div class="row">-->
                            <!--                        <div class="col-5 offset-7">-->
                        <!--                            <a href="<?php //echo url('/') ?>/artist/<?php //echo $userMusician->id; ?>" class="btn-portfolio-one mb-2">Portfolio</a>-->
                        <!--                            <a href="<?php //echo url('/') ?>/request-to-book?photographerId=<?php //echo $userMusician->id ?>&cityId=<?php //echo $userMusician->city_id; ?>" class="button-book-one mb-2">Book artist</a>-->
                            <!--<a href="javascript:;" v-if="suser != ''"  @click="addToActiveChat(animatorUser)" class="button-chat-two" >Chat</a>-->
                            <!--                        </div>-->
                            <!--                    </div>-->
                            <!--                </div>-->

                        <?php
                        // }
                        ?>


                        <!--    </div>-->
                            <!--</div>  -->

                        </div>
                        <?php
                        }
                        ?>
                    </div>


                </carousel>

            </div>
        </div>
    </section>

@endsection
@section('javascript')
    <script type="text/javascript">
        function formatText(icon) {
            return $('<span><i class="fas ' + $(icon.element).data('icon') + '"></i> ' + icon.text + '</span>');
        };

        $('.select2-icon').select2({
            minimumResultsForSearch: Infinity,
            // width: "50%",
            templateSelection: formatText,
            templateResult: formatText
        });
        // 	$('.select22-icon').select2({
        // 		minimumResultsForSearch: Infinity,
        // 		// width: "50%",
        // 		templateSelection: formatText,
        // 		templateResult: formatText
        // 	});


        $(document).ready(function () {
            $("#btnSubmitSearch").click(function () {
                console.log('here clicked');
                $("#formSearch").find(":input").filter(function () {
                    return !this.value;
                }).attr("disabled", "disabled");
                $("#formSearch").submit();

            });


            $('.select22-icon').select2({
                minimumResultsForSearch: Infinity,
                // width: "50%",
                templateSelection: formatText,
                templateResult: formatText
            });
            // Un-disable form fields when page loads, in case they click back after submission or client side validation
            // $('#formSearch').find(":input").prop("disabled", false);
        });
    </script>
@endsection
