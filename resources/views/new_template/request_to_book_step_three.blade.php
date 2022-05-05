@extends('new_template.layouts.app')
@section('content')
    <section class="form-main-section"
             style="background: url(<?php echo asset('destination_page_new/destination-1.jpg') ?>)">
        <div class="form-area-box">
            <div class="container">
                <div class="row">
                    <div class="col-sm-4 ">
                        <div class="step-count request-book-progressbar-bar-after completed">
                            <a href="">1</a>
                        </div>
                    </div>
                    <div class="col-sm-4 ">
                        <div class="step-count request-book-progressbar-bar-after completed">
                            <a href="">2</a>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="step-count active">
                            <a href="">3</a>
                        </div>
                    </div>
                </div>
                <div class="set-padding-form-disc">
                    <form method="post" id="formStepThree" action="{{ url('/') }}/request-to-book/complete">
                    @csrf

                    <!-- comming from before step one Data Start -->
                        <input type="text" id="photoshootId" name="photoshootId" hidden value="{{ $photoshootId }}">
                        <input type="text" id="photographerId" name="photographerId" hidden
                               value="{{ $photographerId }}">
                        <input type="text" id="countryId" name="countryId" hidden value="{{ $countryId }}">
                        <input type="text" id="cityId" name="cityId" hidden value="{{ $cityId }}">
                        <!-- comming from before step one Data End -->

                        <!-- comming from before step two (meaning comming from step one) Data Start -->
                        <input type="text" id="DatePrefered" name="DatePrefered" hidden value="{{ $datePrefered }}">
                        <input type="text" id="timeOfDay" name="timeOfDay" hidden value="{{ $timeDay }}">
                        <!-- comming from before step two (meaning comming from step one) Data End -->

                        <!-- comming from before step three (meaning comming from step two) Data Start -->
                        <input type="text" id="adultsCount" name="adultsCount" hidden value="{{ $adultsCount }}">
                        <input type="text" id="childrenCount" name="childrenCount" hidden value="{{ $childrenCount }}">
                        <input type="text" id="infantsCount" name="infantsCount" hidden value="{{ $infantsCount }}">
                    <!-- {{-- <input type="text" id="tripReasonId" name="tripReasonId" hidden value="{{ $tripReasonId }}"> --}} -->
                        <input type="text" id="packageId" name="packageId" hidden value="{{ $packageId }}">
                        <input type="text" id="timeRestrictionDescription" name="timeRestrictionDescription" hidden
                               value="{{ $timeRestrictionDescription }}">
                        <!-- comming from before step three (meaning comming from step two) Data End -->

                        <input type="text" hidden id="getRouteId" name="getRouteId" value="">
                        <div class="row">
                            <div class="col-sm-12 text-center padding-top-20">
                                @if($getTypeDetails->type_name == "Photographer")
                                    <h2 class="title-form">You are requesting to book a photo shoot
                                        with {{ ($getUserData->name != "") ? $getUserData->name : $getUserData->username }}
                                        in {{ $getCityAndCountry->name }}, {{ $getCityAndCountry->countryName }}.</h2>
                                @elseif($getTypeDetails->type_name == "Animator")
                                    <h2 class="title-form">You are requesting to book an animation work
                                        with {{ ($getUserData->name != "") ? $getUserData->name : $getUserData->username }}
                                        in {{ $getCityAndCountry->name }}, {{ $getCityAndCountry->countryName }}.</h2>
                                @elseif($getTypeDetails->type_name == "Videographer")
                                    <h2 class="title-form">You are requesting to book a video shoot
                                        with {{ ($getUserData->name != "") ? $getUserData->name : $getUserData->username }}
                                        in {{ $getCityAndCountry->name }}, {{ $getCityAndCountry->countryName }}.</h2>
                                @elseif($getTypeDetails->type_name == "Musician")
                                    <h2 class="title-form">You are requesting to book a music work
                                        with {{ ($getUserData->name != "") ? $getUserData->name : $getUserData->username }}
                                        in {{ $getCityAndCountry->name }}, {{ $getCityAndCountry->countryName }}.</h2>
                                @else
                                @endif

                                <div class="form-disc-one">
                                    <p>We just need a few more details to complete your request
                                        so {{ ($getUserData->name != "") ? $getUserData->name : $getUserData->username }}
                                        can get back to you within 24 - 48 hours to confirm your booking.</p>
                                </div>
                            </div>
                        </div>

                        <div class="row padding-top-20">
                            <div class="col-sm-12">

                                @if($getTypeDetails->type_name == "Photographer")
                                    <div class="row justify-content-center" id="scrollDivRoute">
                                        @foreach($getRoutes as $routes)
                                            <div class="col-md-3 mb-4">
                                                <div class="rout-box " id="box-route-custom_{{ $routes->id }}">
                                                    <!-- <p class="flag-two">Iconic Sights</p> -->
                                                    <div class="box-img" id="rout-box-img_{{ $routes->id }}">

                                                        @if($routes->route_img != null)
                                                            <img loading="lazy"
                                                                 src="./imran_images_dummy/barcelona-solo-adventure-solo-plants_500.jpeg"
                                                                 alt="" class="img-fluid">
                                                        @else
                                                            <img loading="lazy"
                                                                 src="{{ url('/') . '/no_image/no_image_found.jpg' }}"
                                                                 alt="" class="img-fluid">
                                                        @endif
                                                    </div>
                                                    <div class="box-content mt-2">
                                                        <h3>
                                                            {{ $routes->route_name }}
                                                        </h3>
                                                        <!-- <p>
                                                            Stunning views
                                                        </p> -->
                                                    </div>
                                                    <div class="box-content-hidden"
                                                         id="box-content-hidden_{{ $routes->id }}"
                                                         style="display:none;">
                                                        <p>
                                                            {{ $routes->description }}
                                                        </p>
                                                    </div>
                                                    <div class="box-rout-detail" id="box-rout-click_{{ $routes->id }}">
                                                        <i class="fas fa-info-circle"></i> <span>Route Details</span>
                                                    </div>
                                                    <div class="box-rout-detail"
                                                         id="box-rout-closebtn_{{ $routes->id }}" style="display:none;">
                                                        <i class="fas fa-times"></i> <span>Close Details</span>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                        <div class="col-md-3 mb-4">
                                            <div class="rout-box " id="box-route-custom_Custom">
                                                <!-- <p class="flag-two">Iconic Sights</p> -->
                                                <div class="box-img" id="rout-box-img_Custom">
                                                    <img loading="lazy"
                                                         src="{{ url('/') . '/no_image/no_image_found.jpg' }}" alt=""
                                                         class="img-fluid">
                                                </div>
                                                <div class="box-content mt-2">
                                                    <h3 class="custom-route-div-specific-location">
                                                        I have a specific location in mind
                                                    </h3>
                                                    <!-- <p>
                                                        Stunning views
                                                    </p> -->
                                                </div>
                                                <div class="box-content-hidden" id="box-content-hidden_Custom"
                                                     style="display:none;">
                                                    <p>
                                                        If you have a different route in mind, let us know exactly where
                                                        you would like to shoot.
                                                    </p>
                                                </div>
                                                <div class="box-rout-detail" id="box-rout-click_Custom">
                                                    <i class="fas fa-info-circle"></i> <span>Route Details</span>
                                                </div>
                                                <div class="box-rout-detail" id="box-rout-closebtn_Custom"
                                                     style="display:none;">
                                                    <i class="fas fa-times"></i> <span>Close Details</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="errorRouteDiv"></div>
                                    <div class="row">
                                        <div class="col-md-8 offset-md-2" id="describeSpecificLocationRouteDiv"
                                             style="display:none;">
                                            <div class="form-group">
                                                <label for="tripReason" class="label-form-photo-shoot mb-14">Please
                                                    describe your route. </label>
                                                <textarea id="txtAreaDescribeRoute"
                                                          name="describe_specific_location_route" class="form-control"
                                                          rows="6" placeholder="" style="height: 110px;"></textarea>
                                            </div>
                                        </div>
                                        <div id="errorDescribeRouteDiv"></div>
                                        <div class="col-md-8 offset-md-2">
                                            <div class="form-group" id="addressMeetArtistDiv" style="display:none;">
                                                <label for="yourPreferredStyle" class="label-form-photo-shoot mb-14">Please
                                                    enter the address of where you would like to meet your photographer
                                                    to start your shoot.</label>
                                                <textarea class="form-control" id="txtAreaMeetArtist"
                                                          name="address_meet_artist" rows="6"></textarea>
                                            </div>
                                            <div id="errorMeetArtistDiv"></div>
                                        </div>
                                    </div>
                                @elseif($getTypeDetails->type_name == "Animator")

                                @elseif($getTypeDetails->type_name == "Videographer")
                                    <div class="row justify-content-center" id="scrollDivRoute">
                                        @foreach($getRoutes as $routes)
                                            <div class="col-md-3 mb-4">
                                                <div class="rout-box " id="box-route-custom_{{ $routes->id }}">
                                                    <!-- <p class="flag-two">Iconic Sights</p> -->
                                                    <div class="box-img" id="rout-box-img_{{ $routes->id }}">

                                                        @if($routes->route_img != null)
                                                            <img loading="lazy"
                                                                 src="./imran_images_dummy/barcelona-solo-adventure-solo-plants_500.jpeg"
                                                                 alt="" class="img-fluid">
                                                        @else
                                                            <img loading="lazy"
                                                                 src="{{ url('/') . '/no_image/no_image_found.jpg' }}"
                                                                 alt="" class="img-fluid">
                                                        @endif
                                                    </div>
                                                    <div class="box-content mt-2">
                                                        <h3>
                                                            {{ $routes->route_name }}
                                                        </h3>
                                                        <!-- <p>
                                                            Stunning views
                                                        </p> -->
                                                    </div>
                                                    <div class="box-content-hidden"
                                                         id="box-content-hidden_{{ $routes->id }}"
                                                         style="display:none;">
                                                        <p>
                                                            {{ $routes->description }}
                                                        </p>
                                                    </div>
                                                    <div class="box-rout-detail" id="box-rout-click_{{ $routes->id }}">
                                                        <i class="fas fa-info-circle"></i> <span>Route Details</span>
                                                    </div>
                                                    <div class="box-rout-detail"
                                                         id="box-rout-closebtn_{{ $routes->id }}" style="display:none;">
                                                        <i class="fas fa-times"></i> <span>Close Details</span>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                        <div class="col-md-3 mb-4">
                                            <div class="rout-box " id="box-route-custom_Custom">
                                                <!-- <p class="flag-two">Iconic Sights</p> -->
                                                <div class="box-img" id="rout-box-img_Custom">
                                                    <img loading="lazy"
                                                         src="{{ url('/') . '/no_image/no_image_found.jpg' }}" alt=""
                                                         class="img-fluid">
                                                </div>
                                                <div class="box-content mt-2">
                                                    <h3 class="custom-route-div-specific-location">
                                                        I have a specific location in mind
                                                    </h3>
                                                </div>
                                                <div class="box-content-hidden" id="box-content-hidden_Custom"
                                                     style="display:none;">
                                                    <p>
                                                        If you have a different route in mind, let us know exactly where
                                                        you would like to shoot.
                                                    </p>
                                                </div>
                                                <div class="box-rout-detail" id="box-rout-click_Custom">
                                                    <i class="fas fa-info-circle"></i> <span>Route Details</span>
                                                </div>
                                                <div class="box-rout-detail" id="box-rout-closebtn_Custom"
                                                     style="display:none;">
                                                    <i class="fas fa-times"></i> <span>Close Details</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="errorRouteDiv"></div>
                                    <div class="row">
                                        <div class="col-md-8 offset-md-2" id="describeSpecificLocationRouteDiv"
                                             style="display:none;">
                                            <div class="form-group">
                                                <label for="tripReason" class="label-form-photo-shoot mb-14">Please
                                                    describe your route. </label>
                                                <textarea id="txtAreaDescribeRoute"
                                                          name="describe_specific_location_route" class="form-control"
                                                          rows="6" placeholder="" style="height: 110px;"></textarea>
                                            </div>
                                        </div>
                                        <div id="errorDescribeRouteDiv"></div>
                                        <div class="col-md-8 offset-md-2">
                                            <div class="form-group" id="addressMeetArtistDiv" style="display:none;">
                                                <label for="yourPreferredStyle" class="label-form-photo-shoot mb-14">Please
                                                    enter the address of where you would like to meet your videographer
                                                    to start your shoot.</label>
                                                <textarea class="form-control" id="txtAreaMeetArtist"
                                                          name="address_meet_artist" rows="6"></textarea>
                                            </div>
                                            <div id="errorMeetArtistDiv"></div>
                                        </div>
                                    </div>
                                @endif
                                <div class="row">
                                    @if($getTypeDetails->type_name == "Photographer")
                                        <div class="col-md-8 offset-md-2">
                                            <div class="form-group" id="scrollDivImportantInformation">
                                                <label for="txtAreaImportantInformation"
                                                       class="label-form-photo-shoot mb-14">Please tell us any ideas of
                                                    what you would like to see for your photo shoot or important
                                                    information that would be helpful for your photographer to
                                                    know.</label>
                                                <textarea class="form-control" id="txtAreaImportantInformation"
                                                          name="important_information_for_artist" rows="6" placeholder="Examples include:
                                                1) any specific landmarks or location elements you would like in the background
                                                2) photo style, such as romantic, fun, playful, etc.
                                                3) must-have shots"></textarea>
                                            </div>
                                            <div id="errorImportantInformationDiv"></div>
                                        </div>
                                    @elseif($getTypeDetails->type_name == "Animator")
                                        <div class="col-md-8 offset-md-2">
                                            <div class="form-group" id="scrollDivImportantInformation">
                                                <label for="txtAreaImportantInformation"
                                                       class="label-form-photo-shoot mb-14">Please tell us any ideas of
                                                    what you would like to see for your work or important information
                                                    that would be helpful for your animator to know.</label>
                                                <textarea class="form-control" id="txtAreaImportantInformation"
                                                          name="important_information_for_artist" rows="6" placeholder="Examples include:
                                                1) any specific landmarks or location elements you would like in the background
                                                2) photo style, such as romantic, fun, playful, etc.
                                                3) must-have shots"></textarea>
                                            </div>
                                            <div id="errorImportantInformationDiv"></div>
                                        </div>
                                    @elseif($getTypeDetails->type_name == "Videographer")
                                        <div class="col-md-8 offset-md-2">
                                            <div class="form-group" id="scrollDivImportantInformation">
                                                <label for="txtAreaImportantInformation"
                                                       class="label-form-photo-shoot mb-14">Please tell us any ideas of
                                                    what you would like to see for your video shoot or important
                                                    information that would be helpful for your videographer to
                                                    know.</label>
                                                <textarea class="form-control" id="txtAreaImportantInformation"
                                                          name="important_information_for_artist" rows="6" placeholder="Examples include:
                                                1) any specific landmarks or location elements you would like in the background
                                                2) photo style, such as romantic, fun, playful, etc.
                                                3) must-have shots"></textarea>
                                            </div>
                                            <div id="errorImportantInformationDiv"></div>
                                        </div>
                                    @elseif($getTypeDetails->type_name == "Musician")
                                        <div class="col-md-8 offset-md-2">
                                            <div class="form-group" id="scrollDivImportantInformation">
                                                <label for="txtAreaImportantInformation"
                                                       class="label-form-photo-shoot mb-14">Please tell us any ideas of
                                                    what you would like to see for your work or important information
                                                    that would be helpful for your musician to know.</label>
                                                <textarea class="form-control" id="txtAreaImportantInformation"
                                                          name="important_information_for_artist" rows="6" placeholder="Examples include:
                                                1) any specific landmarks or location elements you would like in the background
                                                2) photo style, such as romantic, fun, playful, etc.
                                                3) must-have shots"></textarea>
                                            </div>
                                            <div id="errorImportantInformationDiv"></div>
                                        </div>
                                    @endif

                                    @if($getTypeDetails->type_name == "Photographer")

                                        <div class="col-md-8 offset-md-2">
                                            <div class="form-group" id="scrollDivPreferredStylePhoto">
                                                <label for="tripReason" class="label-form-photo-shoot mb-14">Choose your
                                                    preferred style of photos </label>
                                                <select class="form-control" name="preferred_style_photo"
                                                        id="preferred_style_photo">
                                                    <option value="">Select Preferred Style Of Photo</option>
                                                    @foreach($getPreferredStylePhoto as $preStylePhoto)
                                                        <option
                                                            value="{{ $preStylePhoto->id }}">{{ $preStylePhoto->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div id="errorPreferredStylePhotoDiv"></div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-12 mt-4-custom">
                                <div class="text-right">
                                    <button type="button" id="btnThirdStepThree" class="btn-final-request-book"><i
                                            class="fas fa-long-arrow-alt-right"></i> Submit My Request
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
