@extends('new_template.layouts.app')
@section('content')
    <style>


        .img-overlay-price {
            background-color: #00000052;
            position: absolute;
            width: 83%;
            height: 100%;
            top: 0;
            border-radius: 12px;
            opacity: 0;
            transition: 0.4s;
        }
        .img-overlay-price a {
            color: #fff;
            display: flex;
            justify-content: center;
            align-self: center;
            width: 100%;
            height: 100%;
            align-items: center;
            font-size: 18px;
            font-weight: bold;
        }

        .portfolio-list-one li:hover .img-overlay-price {
            opacity: 1;
        }

    </style>

    <!--<h1 class="text-center artist-title mt-4 mb-4">portfolio</h1>-->
    <div class="">
        <div class="item">
            <img loading="lazy" src="{{ url('').'/cover/'. $artistDetails->cover }}" class="img-fluid img" style="display: block;
    width: 100%;">
        </div>
        <!--<div class="item">-->
        <!--    <img loading="lazy" src="{{ url('').'/img/bg-new.jpeg' }}" class="img-fluid img">-->
        <!--</div>-->
        <!--<div class="item">-->
        <!--    <img loading="lazy" src="{{ url('').'/img/bg-new.jpeg' }}" class="img-fluid img">-->
        <!--</div>-->
        <!--<div class="item">-->
        <!--    <img loading="lazy" src="{{ url('').'/img/bg-new.jpeg' }}" class="img-fluid img">-->
        <!--</div>-->
        <!--<div class="item">-->
        <!--    <img loading="lazy" src="{{ url('').'/img/bg-new.jpeg' }}" class="img-fluid img">-->
        <!--</div>-->
        <!--<div class="item">-->
        <!--    <img loading="lazy" src="{{ url('').'/img/bg-new.jpeg' }}" class="img-fluid img">-->
        <!--</div>-->
        <!--<div class="item">-->
        <!--    <img loading="lazy" src="{{ url('').'/img/bg-new.jpeg' }}" class="img-fluid img">-->
        <!--</div>-->
        <!--<div class="item">-->
        <!--    <img loading="lazy" src="{{ url('').'/img/bg-new.jpeg' }}" class="img-fluid img">-->
        <!--</div>-->
        <!--<div class="item">-->
        <!--    <img loading="lazy" src="{{ url('').'/img/bg-new.jpeg' }}" class="img-fluid img">-->
        <!--</div>-->
    </div>
    <section class="profile">
        <div class="container">
            <div class="row">
                <div class="col-md-8"></div>
            </div>
        </div>
    </section>

    <div class="container">
        <div class="row">

            <div class="col-md-7">
                <div class="row mb-5">
                    <div class="col-md-3">
                        <div class="profile-inner">
                            <div class="img">
                                <img loading="lazy" src="<?php echo url('/').'/avatar/'. $artistDetails->avatar; ?>" class="img-fluid">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="text2 text-person-photographer">
                            <h1 class="text-capitalize">

                                @php
                                    $getArtistType = \DB::table('types')->where('types_id','=', $artistDetails->user_type_id)->first();

                                @endphp
                                @if($artistDetails->name != "")
                                    {{ $artistDetails->name }}
                                @else
                                    {{ $artistDetails->username }}
                                @endif
                            </h1>
                            @if(!empty($artistDetails->personal_website))
		  <small style="display:block;"><a href="{{ $artistDetails->personal_website }}">{{  $artistDetails->personal_website }}</a></small>
		  @endif
                            <p class="one">
                                {{ $getArtistType->type_name }}
                            </p>
                            <p>
                                {{ $artistDetails->bio }}
                            </p>
                            <input type="hidden" id="latlngValue" name="latlngValue" value="<?php echo $artistDetails->lat.','.$artistDetails->lng;?>">
                            @if($artistDetails->langauges_speak != "" || $artistDetails->fvt_place_to_shoot != "")
                                <div class="profile-info-area mt-4">
                                    @if($artistDetails->langauges_speak != "")
                                        <p class="mb-3"><i class="fas fa-language mr-2"></i> <span class="language">Languages Spoken:</span> {{ $artistDetails->langauges_speak }}</p>
                                    @endif
                                    @if($artistDetails->fvt_place_to_shoot != "")
                                        <p><i class="far fa-heart mr-2"></i> <span class="language">Favourite Place to Shoot:</span> {{ $artistDetails->fvt_place_to_shoot }}</p>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                @if($artistDetails->first_thing != "" && $artistDetails->second_thing != "" && $artistDetails->third_thing != "")
                    <!-- <hr> -->
                    <!-- <div class="three-things pt-3 pb-3">
                        <h2 class="title mb-3">Three Things</h2>
                        <ul>
                            @if($artistDetails->first_thing != "")
                                <li class="mb-3">
                                    <span class="count-one-bold"><i class="fa fa-circle"></i></span> {{ $artistDetails->first_thing }}
                                </li>
                            @endif
                            @if($artistDetails->second_thing != "")
                                <li class="mb-3">
                                    <span class="count-one-bold"><i class="fa fa-circle"></i></span> {{ $artistDetails->second_thing }}
                                </li>
                            @endif
                            @if($artistDetails->third_thing != "")
                                <li class="mb-3">
                                    <span class="count-one-bold"><i class="fa fa-circle"></i></span> {{ $artistDetails->third_thing }}
                                </li>
                            @endif
                        </ul>
                    </div> -->
                @endif
                <hr>
                <div class="customer-reviews-area">
                    <div class="d-flex mb-3">.
                        <div class="">
                            <h2 class="title">Portfolio</h2>
                        </div>
                    </div>
                    <?php
                        if($artistDetails->user_type_id == '1'){
                            // $queryGetImageDataById = App\Models\Images::where(['is_type' => 'image', 'user_id' => $artistDetails->id])->limit(4)->get();
                            $queryGetImageDataById = App\Models\Images::where(['is_type' => 'image', 'user_id' => $artistDetails->id])->get();
                    ?>
                            <ul class="row portfolio-list-one">
                                <?php
                                    foreach($queryGetImageDataById as $ImageData){
                                ?>
                                @php
                			        if($settings->show_watermark == '1') {
    								    $thumbnail = 'uploads/preview/'.$ImageData->preview;
    								} else {
        								$stockImage = App\Models\Stock::whereImagesId($ImageData->id)->whereType('small')->select('name')->first();
        								$thumbnail = 'uploads/small/'.$stockImage->name;
    								}
								@endphp
                                <li class="col-md-3 mb-3 col-6 position-relative">
                                    <a data-fancybox href="{{ asset($thumbnail) }}">
                                        <img loading="lazy" src="{{ asset($thumbnail) }}" class="img-fluid img">
                                    </a>
                                    <div class="img-overlay-price">
                                        <a data-fancybox data-price="{{ $ImageData->price }}" data-id="{{ $ImageData->id }}" data-title="{{ $ImageData->title }}" data-slug="{{ str_slug($ImageData->title) }}" data-description="{{ $ImageData->description }}" data-typee="{{ $ImageData->is_type }}" href="{{ asset($thumbnail) }}">{{$settings->currency_symbol.$ImageData->price}}</a>
                                    </div>
                                </li>
                                <?php
                                    }
                                ?>
                            </ul>
                    <?php
                        }elseif($artistDetails->user_type_id == '2'){
                            $queryGetAnimationDataById = App\Models\Images::where(['is_type' => 'video', 'user_id' => $artistDetails->id])->limit(4)->get();
                    ?>
                            <ul class="row portfolio-list-one">
                                <?php
                                    foreach($queryGetAnimationDataById as $AnimationData){
                                ?>
                                        @php
                        			        if($settings->show_watermark == '1') {
            								    $thumbnail = 'uploads/preview/'.$AnimationData->preview;
            								} else {
                								$stockImage = App\Models\Stock::whereImagesId($AnimationData->id)->whereType('small')->select('name')->first();
                								$thumbnail = 'uploads/small/'.$stockImage->name;
            								}

            								$watermarkedVideoPath = 'uploads/video/screen_shot/';

            								$AnimationFileScreenShotName = explode('.', $AnimationData->thumbnail)[0];
        								@endphp
                                        <li class="col-md-3 mb-3 col-6">
                                            <a data-fancybox href="{{ asset($watermarkedVideoPath) }}{{ '/screen-shot-'.$AnimationFileScreenShotName.'.png' }}">
                                                <img loading="lazy" src="{{ asset($watermarkedVideoPath) }}{{ '/screen-shot-'.$AnimationFileScreenShotName.'.png' }}" class="img-fluid img">
                					        </a>
                                        </li>
                                <?php
                                    }
                                ?>
                            </ul>
                    <?php
                        }elseif($artistDetails->user_type_id == '3'){
                            $queryGetVideoDataById = App\Models\Images::where(['is_type' => 'video', 'user_id' => $artistDetails->id])->limit(4)->get();
                    ?>
                            <ul class="row portfolio-list-one">
                                <?php
                                    foreach($queryGetVideoDataById as $VideoData){
                                ?>
                                        @php
                        			        if($settings->show_watermark == '1') {
            								    $thumbnail = 'uploads/preview/'.$VideoData->preview;
            								} else {
                								$stockImage = App\Models\Stock::whereImagesId($VideoData->id)->whereType('small')->select('name')->first();
                								$thumbnail = 'uploads/small/'.$stockImage->name;
            								}

            								$watermarkedVideoPath = 'uploads/video/screen_shot/';

            								$VideoFileScreenShotName = explode('.', $VideoData->thumbnail)[0];
        								@endphp

                                        <li class="col-md-3 mb-3 col-6">
                                            <a data-fancybox href="{{ asset($watermarkedVideoPath) }}{{ '/screen-shot-'.$VideoFileScreenShotName.'.png' }}">
                                                <img loading="lazy" src="{{ asset($watermarkedVideoPath) }}{{ '/screen-shot-'.$VideoFileScreenShotName.'.png' }}" class="img-fluid img">
                                            </a>
                                        </li>
                                <?php
                                    }
                                ?>

                            </ul>
                    <?php
                        }else{


                            $queryGetAudioDataById = App\Models\Images::where(['is_type' => 'audio', 'user_id' => $artistDetails->id])->limit(4)->get();
                            foreach($queryGetAudioDataById as $AudKey => $AudioData){
                    ?>



                            <!-- Audio start -->
                            <div class="audio-song-box Bigwave" data-path="<?php echo url('/uploads/audio/large/').'/' . $AudioData->thumbnail; ?>">
                                <!--<button type="button">Play / Pause</button>-->
                        	    <div class="row music-main-page-home">
                            	    <div class="align-self-center col-md-2 text-center">
                                        <a href="javascript:;" class="btn-music-play" id="Bigbaton-playMusic#{{$AudKey}}">
                                            <i class="fas fa-play"></i>
                                        </a>
                                        <a href="javascript:;" class="btn-music-play" id="Bigbaton-pauseMusic#{{$AudKey}}" style="display: none;">
                                            <i class="fas fa-pause"></i>
                                        </a>
                                    </div>
                        	        <div class="wave-container col-md-9 p-0"></div>
                        	    </div>
                            </div>
                            <!-- Audio end -->

                            <?php }
                        }
                    ?>
                </div>
                <hr>
                <div class="customer-reviews-area">
                    <div class="d-flex mb-3">.
                        <div class="">
                            <h2 class="title">Reviews</h2>
                        </div>
                        <div class="ml-auto align-self-center">
                            <p class="anchor-tag">Review Policy</p>
                        </div>
                    </div>
                </div>
                <div class="customer-review-write-area mt-5">
                    @if(count($getReviewOfUserById) > 0)
                        @foreach($getReviewOfUserById as $reviewResult)
                        <div class="row customer-review-box">
                            <div class="col-3 pr-0">
                                <img loading="lazy" src="<?php echo url('/').'/review_images/'. $reviewResult->review_image; ?>" class="img-fluid  unique-viewartist-img">
                            </div>
                            <div class="col-9">
                            <div class="d-flex mt-3">
                                    <div class="">
                                        <p class="person-name">{{ $reviewResult->userCustomerUsername }}</p>
                                    </div>
                                    <div class="reviews-stars ml-auto">
                                    @if($reviewResult->review_rate >= "1")
                                        <i class="fas fa-star"></i>
                                        @else
                                        <i class="fas fa-star" style="color:grey;"></i>
                                        @endif
                                        @if($reviewResult->review_rate >= "2")
                                        <i class="fas fa-star"></i>
                                        @else
                                        <i class="fas fa-star" style="color:grey;"></i>
                                        @endif
                                        @if($reviewResult->review_rate >= "3")
                                        <i class="fas fa-star"></i>
                                        @else
                                        <i class="fas fa-star" style="color:grey;"></i>
                                        @endif
                                        @if($reviewResult->review_rate >= "4")
                                        <i class="fas fa-star"></i>
                                        @else
                                        <i class="fas fa-star" style="color:grey;"></i>
                                        @endif
                                        @if($reviewResult->review_rate >= "5")
                                        <i class="fas fa-star"></i>
                                        @else
                                        <i class="fas fa-star" style="color:grey;"></i>
                                        @endif
                                        <!-- <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i> -->
                                    </div>
                                </div>
                                <p class="unique-viewartist-para" style="word-break: break-all; font-size: 14px;">{{ $reviewResult->review_description }}</p>
                            </div>
                        </div>
                        @endforeach
                    @else

                    <div class="row customer-review-box bg-not-reviews">
                        <div class="col-12 text-center">No Reviews Yet.</div>
                    </div>

                    @endif



                </div>

            </div>
            <div class="col-md-5">
                <div class="border-calendar">
                    <input type="hidden" id="urlBase" value="<?php echo url('/') ?>">
                    <div id="containerCalendar"></div>
                    <div class="calender-btn text-center mt-4">
                        <form id="formReqForm" method="get" action="<?php echo url('/').'/request-to-book/' ?>">
                            <input type="text" hidden id="DatePrefered" name="DatePrefered" value="">
                            <input type="text" hidden id="timeOfDay" name="timeOfDay" value="">
                            <input type="text" hidden id="photographerId" name="photographerId" value="{{ $artistDetails->id }}" >
                            <button id="btnReq" disabled>Request to book {{ ($artistDetails->name != "") ? $artistDetails->name : $artistDetails->username }}</button>
                        </form>
                    </div>
                    <hr>
                    <div class="celendar-inner">
                        <h4 class="important-note-txt">Important Note:</h4>
                        <p class="mb-3 disc-calender">
                            The availability of artists can vary from the dates you have requested. Within 24 hours of receiving your request, the artist will confirm the date and time.
                        </p>
                        <p class="mb-3 disc-calender">
Artists are available for booking for a minimum 30 & 60 minutes session at your requested place.
                        </p>

                    </div>
                </div>
            </div>
            <!-- <div class="col-md-5">
                <div class="border-calendar">
                    <input type="hidden" id="urlBase" value="<?php echo url('/') ?>">
                    <div id="containerCalendar"></div>
                    <div class="calender-btn text-center mt-4">
                        <form id="formReqForm" method="get" action="<?php echo url('/').'/request-to-book/' ?>">
                            <input type="text" hidden id="DatePrefered" name="DatePrefered" value="">
                            <input type="text" hidden id="timeOfDay" name="timeOfDay" value="">
                            <input type="text" hidden id="photographerId" name="photographerId" value="{{ $artistDetails->id }}" >
                            <button id="btnReq" disabled>Request to book {{ ($artistDetails->name != "") ? $artistDetails->name : $artistDetails->username }}</button>
                        </form>
                    </div>
                    <hr>
                    <div class="celendar-inner">
                        <h4 class="important-note-txt">Important Note:</h4>
                        <p class="mb-3 disc-calender">Requesting a date does not guarantee photographer availability.The photographer will confirm the date and time within 24 hours once they receive your request.</p>
                        <p class="mb-3 disc-calender">
                            Spiros is available for 30-minute minimum bookings in Emporeio & Pyrgos Village\
                            and for 60-minute minimum bookings in Fira, Imerovigli & Oia.
                        </p>
                        <p class="disc-calender">
                            Pricing starts at $250 USD for a 30-minute vacation shoot
                        </p>
                    </div>
                </div>
            </div> -->
        </div>
    </div><!--/container-->
@endsection

