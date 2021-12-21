@extends('new_template.layouts.app')
@section('content')
    <section class="form-main-section" style="background: url(<?php echo asset('destination_page_new/destination-1.jpg') ?>)">
        <div class="form-area-box">
            <div class="container">
                <div class="row">
                    <div class="col-sm-4 ">
                        <div class="step-count active request-book-progressbar-bar-after">
                            <a href="">1</a>
                        </div>
                    </div>
                    <div class="col-sm-4 ">
                        <div class="step-count request-book-progressbar-bar-after">
                            <a href="">2</a>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="step-count">
                            <a href="">3</a>
                        </div>
                    </div>
                </div>
                <div class="set-padding-form-disc">
                    <form method="post" id="formStepOne" action="{{ url('/') }}/request-to-book/step-two">
                        @csrf
                        <input type="text" id="photoshootId" name="photoshootId" hidden value="{{ $photoshootId }}">

                        <div class="row">
                            <div class="col-sm-12 text-center padding-top-20">
                                @if($getUserData != null && $cityId != null)
                                    @if($getTypeDetails != null)
                                        @if($getTypeDetails->type_name == "Photographer")
                                            {{-- <!--<h1 id="changingHeading" class="title-form">You are requesting to book a photo shoot with {{ ($getUserData->name != "") ? $getUserData->name : $getUserData->username }} in {{ $getCityAndCountry->city_name }}, {{ $getCityAndCountry->countryName }}. </h1>--> --}}
                                            <h1 id="changingHeading" class="title-form">You are requesting to book a photo shoot with {{ ($getUserData->name != "") ? $getUserData->name : $getUserData->username }} from {{ $getCityAndCountry->name }}, {{ $getCityAndCountry->countryName }}. </h1>
                                        @elseif($getTypeDetails->type_name == "Animator")
                                            {{-- <!--<h1 id="changingHeading" class="title-form">You are requesting to book a animation with {{ ($getUserData->name != "") ? $getUserData->name : $getUserData->username }} in {{ $getCityAndCountry->city_name }}, {{ $getCityAndCountry->countryName }}. </h1>--> --}}
                                            <h1 id="changingHeading" class="title-form">You are requesting to book a animation with {{ ($getUserData->name != "") ? $getUserData->name : $getUserData->username }} from {{ $getCityAndCountry->name }}, {{ $getCityAndCountry->countryName }}. </h1>
                                        @elseif($getTypeDetails->type_name == "Videographer")
                                            {{-- <!--<h1 id="changingHeading" class="title-form">You are requesting to book a video shoot with {{ ($getUserData->name != "") ? $getUserData->name : $getUserData->username }} in {{ $getCityAndCountry->city_name }}, {{ $getCityAndCountry->countryName }}. </h1>--> --}}
                                            <h1 id="changingHeading" class="title-form">You are requesting to book a video shoot with {{ ($getUserData->name != "") ? $getUserData->name : $getUserData->username }} from {{ $getCityAndCountry->name }}, {{ $getCityAndCountry->countryName }}. </h1>
                                        @elseif($getTypeDetails->type_name == "Musician")
                                            {{-- <!--<h1 id="changingHeading" class="title-form">You are requesting to book a music with {{ ($getUserData->name != "") ? $getUserData->name : $getUserData->username }} in {{ $getCityAndCountry->city_name }}, {{ $getCityAndCountry->countryName }}. </h1>--> --}}
                                            <h1 id="changingHeading" class="title-form">You are requesting to book a music with {{ ($getUserData->name != "") ? $getUserData->name : $getUserData->username }} from {{ $getCityAndCountry->name }}, {{ $getCityAndCountry->countryName }}. </h1>
                                        @else
                                        @endif

                                    @endif
                                @else
                                    <h1 id="changingHeading" class="title-form">You're requesting to book.</h1>
                                @endif
                                <h1 class="title-form" style="opacity: 0; margin-bottom: 0;">You're requesting to book. You're requesting to book.You're requesting to book. You're requesting to book.</h1>
                                <div class="form-disc-one">
                                    <p>
                                        Please choose date and preferred time of day that you would like for your request booking.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="row padding-top-20">
                            <div class="col-sm-6">
                                <div class="form-group">
                                        <label for="photoShoot" class="label-form-photo-shoot mb-4-cutom">Which country would you like to book?</label>
                                        <select class="form-control form-height" id="countryIdbooking" name="countryId">
                                            <option value="">Select Country</option>
                                            @foreach($getCountry as $countrye)
                                                @if($countrye->id == $getUserData->country_id)
                                                <option selected value="{{ $countrye->id }}">{{ $countrye->name }}</option>
                                                @else
                                                <option value="{{ $countrye->id }}">{{ $countrye->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                @if($cityId == "" && $photographerId == "")
                                    <div class="form-group">
                                        <label for="photoShoot" class="label-form-photo-shoot mb-4-cutom">Where would you like to book?</label>
                                        <select class="form-control form-height" id="cityId" name="cityId">
                                            <option value="">Select City</option>
                                            @foreach($getCityAndCountry as $getCitiess)
                                                <option value="{{ $getCitiess->id }}">{{ $getCitiess->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div id="errorCityIdDiv"></div>
                                    <div class="form-group" id="photographerIdDivv" style="display:none;">
                                        <label for="choosePhotographer" class="label-form-photo-shoot mb-4-cutom">Choose an Artist</label>
                                        <select class="form-control form-height" id="photographerId" name="photographerId">
                                        </select>
                                    </div>
                                    <div id="errorPhotographerIdDiv"></div>
                                @elseif($cityId == "")
                                    <div class="form-group">
                                        <label for="photoShootTwo" class="label-form-photo-shoot mb-4-cutom">Where would you like to book?</label>
                                        <select class="form-control form-height" id="cityId" name="cityId">
                                            <option value="">Select City</option>
                                                @foreach($getCityAndCountry as $getCitiess)
                                                    <option value="{{ $getCitiess->id }}">{{ $getCitiess->name }}</option>
                                                @endforeach
                                        </select>
                                    </div>
                                    <div id="errorCityIdDiv"></div>
                                    <input type="text" hidden id="photographerId" name="photographerId"  value="{{ $photographerId }}">
                                @else
                                    <input type="text" id="cityId" name="cityId" hidden value="{{ $cityId }}">
                                    <input type="text" id="photographerId" name="photographerId" hidden value="{{ $photographerId }}">
                                @endif

                                @if($datePrefered == null)
                                    <div class="form-group">
                                        <label for="photoShootTwo" class="label-form-photo-shoot mb-4-cutom">What day would you like to book?</label>
                                        <input type="text" class="form-control DatePrefered" readonly name="DatePrefered" id="DatePrefered">

                                    </div>
                                    <div id="errorDatePreferedDiv"></div>
                                @else
                                    <input type="text" hidden name="DatePrefered" id="DatePrefered" value="{{ $datePrefered }}">
                                @endif

                                @if($timeOfDay == null)
                                    <div class="form-group">
                                        <label for="photoShootTwo" class="label-form-photo-shoot mb-4-cutom">What time of day would you like to book?</label>
                                        <p class="mb-3">Once your booking is done, Artist will set the best start time for you within your preferred time range, based on the route, season, and other bookings that day.</p>
                                        <select class="form-control" name="timeOfDay" id="timeOfDay">
                                            <option value="">Select Time of Day</option>
                                            @foreach($getTimeOfDay as $timeDay)
                                                <option value="{{ $timeDay->id }}">{{ $timeDay->time_of_day }} {{ $timeDay->short_description }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div id="errorTimeOfDayDiv"></div>
                                @else
                                    <input type="text" hidden name="timeOfDay" id="timeOfDay" value="{{ $timeOfDay }}">
                                @endif
                            </div>
                            <div class="col-sm-6">
                                <!-- Calender Should Place Here -->
                                <div class="border-calendar border-calendar2" id="Calender2" style="display:none">
                                    <input type="hidden" id="urlBase" value="<?php echo url('/') ?>">
                                    <div id="containerCalendar2"></div>
                                    <div class="calender-btn text-center mt-4"></div>
                                    <hr>
                                    <div class="celendar-inner">
                                        <h4 class="important-note-txt">Important Note:</h4>
                                        <p class="mb-3 disc-calender">{{ $getCalendarData->calendar_last_minute_header }} {{ $getCalendarData->calendar_last_minute_content }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 mt-4">
                                <div class="text-right">
                                    <button type="button" id="btnfirstStepOne" class="next-step">Next Step</button>

                                    <!-- <a  href="form-2.php" class="next-step">
                                        Next Step
                                    </a> -->
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
