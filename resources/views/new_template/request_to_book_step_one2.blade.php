@extends('new_template.layouts.app')
@section('content')
    <section class="request-book-s1">
    	<div class="container">
            <div class="row justify-content-center">
                <div class="col-10 offset-md-1">
                    <div class="row">
                        <div class="col-md-4 d-flex justify-content-center">
                            <div class="request-book-progressbar-bar active request-book-progressbar-bar-after">1</div>
                        </div>
                        <div class="col-md-4 d-flex justify-content-center">
                            <div class="request-book-progressbar-bar request-book-progressbar-bar-after">2</div>
                        </div>
                        <div class="col-md-4 d-flex justify-content-center">
                            <div class="request-book-progressbar-bar">3</div>
                        </div>
                    </div>
                    <form method="post" id="formStepOne" action="{{ url('/') }}/request-to-book/step-two">
                        @csrf
                        <input type="text" id="photoshootId" name="photoshootId" hidden value="{{ $photoshootId }}">
                    
                        <div class="row mt-5">
                            <div class="col-10 offset-md-1">
                                <div class="border-bottom-request-one pb-4">
                                    @if($getUserData != null && $cityId != null)
                                        <h2 id="changingHeading" class="destination-s2-title mb-3">You are requesting to book a shoot with {{ ($getUserData->name != "") ? $getUserData->name : $getUserData->username }} in {{ $getCityAndCountry->city_name }}, {{ $getCityAndCountry->countryName }}. </h2>
                                    @else
                                        <h2 id="changingHeading" class="destination-s2-title mb-3">You are requesting to book a shoot.</h2>
                                    @endif
                                    <p class="">Please choose a date and preferred time of day that you would like for your photo shoot.</p>
                                </div>
                            </div>
                        </div>
                        <div class="row request-book-select-row">
                            <div class="col-10 offset-md-1">
                                @if($cityId == "" && $photographerId == "")
                                    <div class="">
                                        <label for="">Where would you like to book the photo shoot?<span style="color:red;"> *</span></label>
                                        <select class="form-control" id="cityId" name="cityId">
                                            <option value="">Select City</option>
                                            @foreach($getCityAndCountry as $getCitiess)
                                                <option value="{{ $getCitiess->id }}">{{ $getCitiess->city_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div id="errorCityIdDiv"></div>
                                    <div class="mt-4" id="photographerIdDivv" style="display:none;">
                                        <label for="">Choose a preferred photographer<span style="color:red;"> *</span></label>
                                        <select class="form-control" id="photographerId" name="photographerId">
                                        </select>
                                    </div>
                                    <div id="errorPhotographerIdDiv"></div>
                                @elseif($cityId == "")
                                    <div class="">
                                        <label for="">Where would you like to book the photo shoot?<span style="color:red;"> *</span></label>
                                        <select class="form-control" id="cityId" name="cityId">
                                            <option value="">Select City</option>
                                            @foreach($getCityAndCountry as $getCitiess)
                                                <option value="{{ $getCitiess->id }}">{{ $getCitiess->city_name }}</option>
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
                                    <div class="mt-4">
                                        <label for="">What day would you like to book your photo shoot?<span style="color:red;"> *</span></label>
                                        <input type="text" class="form-control DatePrefered" readonly name="DatePrefered" id="DatePrefered"> 
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
                                    <div id="errorDatePreferedDiv"></div>
                                @else
                                    <input type="text" hidden name="DatePrefered" id="DatePrefered" value="{{ $datePrefered }}">
                                @endif
                                @if($timeOfDay == null)
                                    <div class="mt-4">
                                        <label for="">What time of day would you like to have your photo shoot?<span style="color: red;"> *</span></label>
                                        <p class="mb-3">Once your shoot is booked, the photographer will set the best start time for the photo shoot within your preferred time range, based on the route, season, and other bookings that day.</p>
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
                        </div>
                        <div class="col-md-10 offset-md-1 mt-4">
                            <div class="row">
                                <div class="ml-auto">
                                    <button type="button" id="btnfirstStepOne" class="btn-final-request-book"><i class="fas fa-long-arrow-alt-right"></i>  Next Step</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
	    </div>
    </section>
    @include('includes.javascript_general')
    <script>
        const base_url = "<?php echo url('/')?>";
        $(document).ready(function(){
            $("#cityId").change(function(){
                console.log('city Id ====> ' + $(this).val());
                let getCityId = $(this).val();
                $.ajax({
                    url:base_url+'/get-artist-by-city/'+ getCityId,
                    type:'get',
                    dataType:'json',
                    success:function(res){
                        $("#photographerId").empty();
                        var optionPhotographer = '';
                        if(res != "not artist found"){
                            optionPhotographer +='<option value="">Select...</option>';
                            $.each(res, function( key, value ) {
                            optionPhotographer +='<option value="'+ value.id +'">'+ value.username +'</option>';
                            });
                            $("#photographerId").append(optionPhotographer);
                            $("#photographerIdDivv").show();
                        }else{

                        }
                    },
                    error:function(){
                        console.log('error while getting artist by city ID');
                    }
                });
            });

            $("#btnfirstStepOne").click(function(){
                let cityId 		 	= $("#cityId").val();
                let photographerId 	= $("#photographerId").val();
                let datePrefered 	= $("#DatePrefered").val();
                let timeOfDay    	= $("#timeOfDay").val();

                if(cityId == ""){
                    $("#cityId").css('border-color','red');
                    $("#errorCityIdDiv").text('This field is required');
                    $("#errorCityIdDiv").css('color','red');
                    setTimeout(function(){
                        $('#cityId').css('border-color','#ced4da');
                        $('#errorCityIdDiv').text('');
                    }, 2000);
                    
                }else if(photographerId == ""){
                    $("#photographerId").css('border-color','red');
                    $("#errorPhotographerIdDiv").text('This field is required');
                    $("#errorPhotographerIdDiv").css('color','red');
                    setTimeout(function(){
                        $('#photographerId').css('border-color','#ced4da');
                        $('#errorPhotographerIdDiv').text('');
                    }, 2000);
                }else if(datePrefered == ""){
                    $("#DatePrefered").css('border-color','red');
                    $("#errorDatePreferedDiv").text('This field is required');
                    $("#errorDatePreferedDiv").css('color','red');
                    setTimeout(function() {
                        $('#DatePrefered').css('border-color','#ced4da');
                        $('#errorDatePreferedDiv').text('');
                    }, 2000);
                }else if(timeOfDay == ""){
                    $("#timeOfDay").css('border-color','red');
                    $("#errorTimeOfDayDiv").text('This field is required');
                    $("#errorTimeOfDayDiv").css('color','red');
                    setTimeout(function() {
                        $('#timeOfDay').css('border-color','#ced4da');
                        $('#errorTimeOfDayDiv').text('');
                    }, 2000);
                }else{
                    $("#formStepOne").submit();
                }

            });
        });
    </script>
@endsection