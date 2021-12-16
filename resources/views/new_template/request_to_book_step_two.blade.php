@extends('new_template.layouts.app')
@section('content')
    <section class="form-main-section" style="background: url(<?php echo asset('public/destination_page_new/destination-1.jpg') ?>)">
        <div class="form-area-box">
            <div class="container">
                <div class="row">
                    <div class="col-sm-4 ">
                        <div class="step-count completed request-book-progressbar-bar-after">
                            <a href="">1</a>
                        </div>
                    </div>
                    <div class="col-sm-4 ">
                        <div class="step-count request-book-progressbar-bar-after active">
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

                    <form method="post" id="formStepTwo" action="{{ url('/') }}/request-to-book/step-three">
                        @csrf
                        <!-- comming from before step one Data Start -->
                        <input type="text" id="photoshootId" name="photoshootId" hidden value="{{ $photoshootId }}">
                        <input type="text" id="photographerId" name="photographerId" hidden value="{{ $photographerId }}">
                        <input type="text" id="countryId" name="countryId" hidden value="{{ $countryId }}">
                        <input type="text" id="cityId" name="cityId" hidden value="{{ $cityId }}">
                        <!-- comming from before step one Data End -->
                        
                        <!-- comming from before step two (meaning comming from step one) Data Start -->
                        <input type="text" id="DatePrefered" name="DatePrefered" hidden value="{{ $datePrefered }}">
                        <input type="text" id="timeOfDay" name="timeOfDay" hidden value="{{ $timeDay }}">
                        <!-- comming from before step two (meaning comming from step one) Data End -->
                        
                        <div class="row">
                            <div class="col-sm-12 text-center padding-top-20">
                                @if($getTypeDetails->type_name == "Photographer")
                                    <h2 class="title-form">You are requesting to book a photo shoot with {{ ($getUserData->name != "") ? $getUserData->name : $getUserData->username }} in {{ $getCityAndCountry->name }}, {{ $getCityAndCountry->countryName }}.</h2>
                                @elseif($getTypeDetails->type_name == "Animator")
                                    <h2 class="title-form">You are requesting to book an animation work with {{ ($getUserData->name != "") ? $getUserData->name : $getUserData->username }} in {{ $getCityAndCountry->name }}, {{ $getCityAndCountry->countryName }}.</h2>
                                @elseif($getTypeDetails->type_name == "Videographer")
                                    <h2 class="title-form">You are requesting to book a video shoot with {{ ($getUserData->name != "") ? $getUserData->name : $getUserData->username }} in {{ $getCityAndCountry->name }}, {{ $getCityAndCountry->countryName }}.</h2>
                                @elseif($getTypeDetails->type_name == "Musician")
                                    <h2 class="title-form">You are requesting to book a music work with {{ ($getUserData->name != "") ? $getUserData->name : $getUserData->username }} in {{ $getCityAndCountry->name }}, {{ $getCityAndCountry->countryName }}.</h2>
                                @else
                                @endif
                                
                                <div class="form-disc-one">
                                    <p>We just need a few more details to complete your request so {{ ($getUserData->name != "") ? $getUserData->name : $getUserData->username }} can get back to you within 24 - 48 hours to confirm your booking.</p>
                                </div>
                            </div>
                        </div>
                    

                        <div class="row padding-top-20">
                            @if($getTypeDetails->type_name == "Photographer")
                                <div class="col-sm-12 mb-3">
                                    <div class="form-group" id="scrollDivParticipants">
                                        <h4 class="form-title-two">How many participants will be on the shoot?</h4>
                                        <p class="mb-3">Don't worry – you will be able to re-confirm this later!</p>
                                        <div class="row ">
                                            <div class="col-sm-4">
                                                <div class="row padding-top-20">
                                                    <div class="col-sm-3 align-self-center">
                                                        <label for="adult" class="label-form-photo-shoot mb-4-cutom padding-top-6 mb-0 font-size-20 font-weight-normal">Adults (13+)</label>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <input type="text" placeholder="" id="adultsCounter" name="adultsCounters" class="form-control form-participent-input" style="margin-top: 6px;"> 
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="row padding-top-20">
                                                    <div class="col-sm-7 pr-0 align-self-center">
                                                        <label for="children" class="label-form-photo-shoot mb-4-cutom padding-top-6 mb-0 font-size-20 font-weight-normal">Children (3-12)</label>
                                                    </div>
                                                    <div class="col-sm-4 pl-0">
                                                        <input type="text" placeholder="" id="childrenCounter" name="childrenCounters" class="form-control form-participent-input" style="margin-top: 6px;"> 
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="row padding-top-20">
                                                    <div class="col-sm-6 align-self-center">
                                                        <label for="children" class="label-form-photo-shoot mb-4-cutom padding-top-6 mb-0 font-size-20 font-weight-normal">Infants (0-2)</label>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <input type="text" placeholder="" id="infantsCounter" name="infantsCounters" class="form-control form-participent-input"  style="margin-top: 6px;"> 
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="errorParticipantsDiv"></div>
                                </div>
                            @elseif($getTypeDetails->type_name == "Animator")
                                
                            @elseif($getTypeDetails->type_name == "Videographer")
                                <div class="col-sm-12 mb-3">
                                    <div class="form-group" id="scrollDivParticipants">
                                        <h4 class="form-title-two">How many participants will be on the shoot?</h4>
                                        <p class="mb-3">Don't worry – you will be able to re-confirm this later!</p>
                                        <div class="row ">
                                            <div class="col-sm-4">
                                                <div class="row padding-top-20">
                                                    <div class="col-sm-3 align-self-center">
                                                        <label for="adult" class="label-form-photo-shoot mb-4-cutom padding-top-6 mb-0 font-size-20 font-weight-normal">Adults (13+)</label>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <input type="text" placeholder="" id="adultsCounter" name="adultsCounters" class="form-control form-participent-input" style="margin-top: 6px;"> 
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="row padding-top-20">
                                                    <div class="col-sm-7 pr-0 align-self-center">
                                                        <label for="children" class="label-form-photo-shoot mb-4-cutom padding-top-6 mb-0 font-size-20 font-weight-normal">Children (3-12)</label>
                                                    </div>
                                                    <div class="col-sm-4 pl-0">
                                                        <input type="text" placeholder="" id="childrenCounter" name="childrenCounters" class="form-control form-participent-input" style="margin-top: 6px;"> 
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="row padding-top-20">
                                                    <div class="col-sm-6 align-self-center">
                                                        <label for="children" class="label-form-photo-shoot mb-4-cutom padding-top-6 mb-0 font-size-20 font-weight-normal">Infants (0-2)</label>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <input type="text" placeholder="" id="infantsCounter" name="infantsCounters" class="form-control form-participent-input"  style="margin-top: 6px;"> 
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="errorParticipantsDiv"></div>
                                </div>
                            @elseif($getTypeDetails->type_name == "Musician")
                                
                            @else
                            @endif
                            
                            <div class="col-sm-6">
                                <!--<div class="form-group" id="scrollDivTripReason">-->
                                <!--    <label for="tripReason" class="label-form-photo-shoot mb-14">What is the reason for your trip? <span class="tooltip-span"> <img src="images/Iconly-Bold-Info Square.svg" alt="" data-toggle="tooltip" data-placement="top" title="Once your shoot is booked, the photographer will set the best start time for the photo shoot within your preferred time range, based on the route, season, and other bookings that day."></span></label>-->
                                <!--    <select class="form-control form-height" name="trip_reason" id="trip_reason">-->
                                <!--        <option value="">Select Trip Reason</option>-->
                                <!--       {{-- @foreach($getTripReason as $tp)-->
                                <!--            <option value="{{ $tp->id }}">{{ $tp->trip_reason_name }}</option>-->
                                <!--        @endforeach --}} --> 
                                <!--    </select>-->
                                <!--</div>-->
                                <!--<div id="errorTripReasonDiv"></div>-->

                                <div class="form-group form-disc-one">
                                    <label for="restrictionsPhotographer" class="label-form-photo-shoot mb-14">Do you have any time restrictions your {{ $getTypeDetails->type_name }} needs to know about? <span class="tooltip-span"><img src="images/Iconly-Bold-Info Square.svg" alt="" data-toggle="tooltip" data-placement="top" title="Once your shoot is booked, the photographer will set the best start time for the photo shoot within your preferred time range, based on the route, season, and other bookings that day."></span></label>
                                    <p class="mb-14">(e.g. You request a morning shoot but you have another activity booked at 11am)</p>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" name="time_restrictions_description" rows="6"></textarea>
                                    
                                    @if($getTypeDetails->type_name == "Photographer")
                                        <p class="mt-2">
                                            Why is this important? The start time a photographer has available is dependent on whether they have other shoots already booked in your desired time slot. Letting us know if you have other plans or cannot start early will help them confirm their availability for your shoot.
                                        </p>
                                    @elseif($getTypeDetails->type_name == "Animator")
                                        <p class="mt-2">
                                            Why is this important? The start time a animator has available is dependent on whether they have other work already booked in your desired time slot. Letting us know if you have other plans or cannot start early will help them confirm their availability for your work.
                                        </p>
                                    @elseif($getTypeDetails->type_name == "Videographer")
                                        <p class="mt-2">
                                            Why is this important? The start time a videographer has available is dependent on whether they have other shoots already booked in your desired time slot. Letting us know if you have other plans or cannot start early will help them confirm their availability for your shoot.
                                        </p>
                                    @elseif($getTypeDetails->type_name == "Musician")
                                        <p class="mt-2">
                                            Why is this important? The start time a musician has available is dependent on whether they have other work already booked in your desired time slot. Letting us know if you have other plans or cannot start early will help them confirm their availability for your work.
                                        </p>
                                    @else
                                    @endif
                                    
                                </div>
                                
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group" id="scrollDivPackage">
                                    <label for="tripReason" class="label-form-photo-shoot mb-14">Choose your package<span class="tooltip-span"> <img src="images/Iconly-Bold-Info Square.svg" alt="" data-toggle="tooltip" data-placement="top" title="Once your shoot is booked, the photographer will set the best start time for the photo shoot within your preferred time range, based on the route, season, and other bookings that day."></span></label>
                                    <select class="form-control form-height" name="package" id="package">
                                        <option value="">Select Package</option>
                                        @foreach($getPackage as $p)
                                            @if($p->package_type == "videographer")
                                                <option value="{{ $p->id }}">{{ ($p->videographer_hours != "") ? $p->videographer_hours. ' Hours - ' : $p->videographer_minutes. ' Minutes - '  }} {{ '$'.$p->videographer_price. ' USD - ' }} {{ $p->number_of_videos. ' videos'}}</option>
                                            @elseif($p->package_type == "photographer")
                                                <option value="{{ $p->id }}">{{ ($p->hours != "") ? $p->hours. ' Hours - ' : $p->minutes. ' Minutes - '  }} {{ '$'.$p->price. ' USD - ' }} {{ $p->number_of_photos. ' photos'}}</option>
                                            @else
                                            
                                            @endif
                                            <!-- ================================= Conditions for other types also =============================================-->
                                        @endforeach
                                    </select>
                                </div>
                                <div id="errorPackageDiv"></div>
                            </div>
                            <div class="col-sm-12 mt-4">
                                <div class="text-right">
                                    <button type="button" id="btnSecondStepTwo" class="btn-final-request-book"><i class="fas fa-long-arrow-alt-right"></i>  Final Step</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection