@extends('new_template.layouts.app')
@section('content')
    <style>
        .value-button {
            display: inline-block;
            border: 1px solid #ddd;
            margin: 0px;
            width: 40px;
            height: 39px;
            text-align: center;
            vertical-align: middle;
            padding: 7px 0;
            background: #eee;
            -webkit-touch-callout: none;
            -webkit-user-select: none;
            -khtml-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        .value-button:hover {
            cursor: pointer;
        }

        form #decrease {
            margin-right: -4px;
            border-radius: 8px 0 0 8px;
        }

        form #increase {
            margin-left: -4px;
            border-radius: 0 8px 8px 0;
        }

        form #input-wrap {
            margin: 0px;
            padding: 0px;
        }

        input#adultsCounter {
            text-align: center;
            border: none;
            border-top: 1px solid #ddd;
            border-bottom: 1px solid #ddd;
            margin: 0px;
            width: 40px;
            height: 40px;
        }
        input#childrenCounter {
            text-align: center;
            border: none;
            border-top: 1px solid #ddd;
            border-bottom: 1px solid #ddd;
            margin: 0px;
            width: 40px;
            height: 40px;
        }
        input#infantsCounter {
            text-align: center;
            border: none;
            border-top: 1px solid #ddd;
            border-bottom: 1px solid #ddd;
            margin: 0px;
            width: 40px;
            height: 40px;
        }

        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
    </style>
    <section class="request-book-s1" >
	    <div class="container">
            <div class="row justify-content-center" >
                <div class="col-10 offset-md-1">
                    <div class="row mt-5">
                        <div class="col-md-4 d-flex justify-content-center">
                            <div class="request-book-progressbar-bar active completed request-book-progressbar-bar-after">
                                <i class="fas fa-check"></i>
                            </div>
                        </div>
                        <div class="col-md-4 d-flex justify-content-center">
                            <div class="request-book-progressbar-bar active completed request-book-progressbar-bar-after">
                                <i class="fas fa-check"></i>
                            </div>
                        </div>
                        <div class="col-md-4 d-flex justify-content-center">
                            <div class="request-book-progressbar-bar active">
                                3
                            </div>
                        </div>
                    </div>
                    <form method="post" id="formStepThree" action="{{ url('/') }}/request-to-book/complete">
                        @csrf

                        <!-- comming from before step one Data Start -->
                        <input type="text" id="photoshootId" name="photoshootId" hidden value="{{ $photoshootId }}">
                        <input type="text" id="photographerId" name="photographerId" hidden value="{{ $photographerId }}">
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
                        <input type="text" id="tripReasonId" name="tripReasonId" hidden value="{{ $tripReasonId }}">
                        <input type="text" id="packageId" name="packageId" hidden value="{{ $packageId }}">
                        <input type="text" id="timeRestrictionDescription" name="timeRestrictionDescription" hidden value="{{ $timeRestrictionDescription }}">
                        <!-- comming from before step three (meaning comming from step two) Data End -->

                        <input type="text" hidden id="getRouteId" name="getRouteId" value="">

                        <div class="row mt-5">
                            <div class="col-10 offset-md-1">
                                <div class="border-bottom-request-one pb-4">
                                    <h2 class="destination-s2-title mb-3">You are requesting to book a shoot with {{ ($getUserData->name != "") ? $getUserData->name : $getUserData->username }} in {{ $getCityAndCountry->city_name }}, {{ $getCityAndCountry->countryName }}.</h2>
                                    <p class="">We just need a few more details to complete your request so {{ ($getUserData->name != "") ? $getUserData->name : $getUserData->username }} can get back to you within 24 - 48 hours to confirm your booking.</p>
                                </div>
                            </div>
                        </div>
                        <div class="row request-book-select-row">
                            <div class="col-10 offset-md-1">
                                <div class="mb-2" id="scrollDivRoute">
                                    <label for="" class="mb-4">
                                        Choose your route. <span style="color:red;"> *</span>
                                        <span class="d-block mt-1">
                                            Click on a card to select a Flytographer curated route.
                                        </span>
                                    </label>
                                    <div class="row">
                                        @foreach($getRoutes as $routes)
                                            <div class="col-md-3 mb-4">
                                                <div class="rout-box " id="box-route-custom_{{ $routes->id }}">
                                                    <!-- <p class="flag-two">Iconic Sights</p> -->
                                                    <div class="box-img" id="rout-box-img_{{ $routes->id }}">
                                                        
                                                        @if($routes->route_img != null)
                                                            <img src="./imran_images_dummy/barcelona-solo-adventure-solo-plants_500.jpeg" alt="" class="img-fluid">
                                                        @else
                                                            <img src="{{ url('/') . '/no_image/no_image_found.jpg' }}" alt="" class="img-fluid">
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
                                                    <div class="box-content-hidden" id="box-content-hidden_{{ $routes->id }}" style="display:none;">
                                                        <p>
                                                            {{ $routes->description }}
                                                        </p>
                                                    </div>
                                                    <div class="box-rout-detail" id="box-rout-click_{{ $routes->id }}">
                                                        <i class="fas fa-info-circle"></i> <span>Route Details</span>
                                                    </div>
                                                    <div class="box-rout-detail" id="box-rout-closebtn_{{ $routes->id }}" style="display:none;">
                                                        <i class="fas fa-times"></i> <span>Close Details</span>
                                                    </div>
                                                </div>	
                                            </div>
                                        @endforeach
                                        <div class="col-md-3 mb-4">
                                            <div class="rout-box " id="box-route-custom_Custom">
                                                <!-- <p class="flag-two">Iconic Sights</p> -->
                                                <div class="box-img" id="rout-box-img_Custom">
                                                        <img src="{{ url('/') . '/no_image/no_image_found.jpg' }}" alt="" class="img-fluid">
                                                </div>
                                                <div class="box-content mt-2">
                                                    <h3 class="custom-route-div-specific-location">
                                                        I have a specific location in mind
                                                    </h3>
                                                    <!-- <p>
                                                        Stunning views
                                                    </p> -->
                                                </div>
                                                <div class="box-content-hidden" id="box-content-hidden_Custom" style="display:none;">
                                                    <p >
                                                        If you have a different route in mind, let us know exactly where you would like to shoot.
                                                    </p>
                                                </div>
                                                <div class="box-rout-detail" id="box-rout-click_Custom">
                                                    <i class="fas fa-info-circle"></i> <span>Route Details</span>
                                                </div>
                                                <div class="box-rout-detail" id="box-rout-closebtn_Custom" style="display:none;">
                                                    <i class="fas fa-times"></i> <span>Close Details</span>
                                                </div>
                                            </div>	
                                        </div>
                                    </div>
                                </div>
                                <div id="errorRouteDiv"></div>
                                <div class="" id="describeSpecificLocationRouteDiv" style="display:none;">
                                    <label for="">Please describe your route. <span style="color:red;"> *</span></label>
                                    <textarea class="form-control" id="txtAreaDescribeRoute" name="describe_specific_location_route" rows="6" ></textarea>
                                </div>
                                <div id="errorDescribeRouteDiv"></div>
                                <div class="mt-4" id="addressMeetArtistDiv" style="display:none;">
                                    <label for="">Please enter the address of where you would like to meet your photographer to start your shoot. <span style="color:red;"> *</span></label>
                                    <textarea class="form-control" id="txtAreaMeetArtist" name="address_meet_artist" rows="6" ></textarea>
                                </div>
                                <div id="errorMeetArtistDiv"></div>
                                <div class="mt-4" id="scrollDivImportantInformation">
                                    <label for="">Please tell us any ideas of what you would like to see for your photo shoot or important information that would be helpful for your photographer to know. <span style="color:red;"> *</span></label>
                                    <textarea class="form-control" id="txtAreaImportantInformation" name="important_information_for_artist" rows="6" placeholder="Examples include: 
                                        1) any specific landmarks or location elements you would like in the background 
                                        2) photo style, such as romantic, fun, playful, etc. 
                                        3) must-have shots"></textarea>
                                </div>
                                <div id="errorImportantInformationDiv"></div>
                                <div class="mt-4" id="scrollDivPreferredStylePhoto">
                                    <label for="">Choose your preferred style of photos <span style="color:red"> *</span></label>
                                    <select class="form-control" name="preferred_style_photo" id="preferred_style_photo">
                                        <option value="">Select Preferred Style Of Photo</option>
                                        @foreach($getPreferredStylePhoto as $preStylePhoto)
                                            <option value="{{ $preStylePhoto->id }}">{{ $preStylePhoto->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div id="errorPreferredStylePhotoDiv"></div>
                                <div class="mt-4" id="scrollDivLevelOfDirection">
                                    <label for="">What level of direction would you like from the photographer?<span style="color:red"> *</span></label>
                                    <select class="form-control" name="level_of_direction" id="level_of_direction">
                                        <option value="">Select Level Of Direction</option>
                                        @foreach($getLevelOfDirection as $lvlOfDirection)
                                            <option value="{{ $lvlOfDirection->id }}">{{ $lvlOfDirection->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div id="errorLevelOfDirectionDiv"></div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-10 offset-md-1">
                                <div class="row">
                                    <!-- <div class="">
                                    <a href="" class="btn-pre-request-book"><i class="fas fa-long-arrow-alt-left"></i>	Previous</a>
                                    </div> -->
                                    <div class="ml-auto">
                                        <button type="button" id="btnThirdStepThree" class="btn-final-request-book"><i class="fas fa-long-arrow-alt-right"></i>  Submit My Request</button>
                                    </div>
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

        $(document).ready(function(){
            $("#btnThirdStepThree").click(function(){
                let routeId 	            = $("#getRouteId").val();
                let describeRoute           = $("textarea#txtAreaDescribeRoute").val();
                let meetArtist              = $("textarea#txtAreaMeetArtist").val();
                let importantInformation    = $("textarea#txtAreaImportantInformation").val();
                let preferred_style_photo   = $("#preferred_style_photo").val();
                let level_of_direction      = $("#level_of_direction").val();

                if(routeId == ""){
                    $("#errorRouteDiv").text('This field is required');
                    $("#errorRouteDiv").css('color','red');
                    Scroll('scrollDivRoute');
                    setTimeout(function(){
                        $('#errorRouteDiv').text('');
                    }, 3000);
                    
                }else if(routeId == "Custom" && describeRoute == ""){
                    $("#errorDescribeRouteDiv").text('This field is required');
                    $("#errorDescribeRouteDiv").css('color','red');
                    Scroll('describeSpecificLocationRouteDiv');
                    setTimeout(function(){
                        $('#errorDescribeRouteDiv').text('');
                    }, 3000);
                }else if(routeId == "Custom" && meetArtist == ""){
                    $("#errorMeetArtistDiv").text('This field is required');
                    $("#errorMeetArtistDiv").css('color','red');
                    Scroll('addressMeetArtistDiv');
                    setTimeout(function(){
                        $('#errorMeetArtistDiv').text('');
                    }, 3000);
                }else if(importantInformation == ""){
                    $("#errorImportantInformationDiv").text('This field is required');
                    $("#errorImportantInformationDiv").css('color','red');
                    Scroll('scrollDivImportantInformation');
                    setTimeout(function(){
                        $('#errorImportantInformationDiv').text('');
                    }, 3000);
                }else if(preferred_style_photo == ""){
                    $("#preferred_style_photo").css('border-color','red');
                    $("#errorPreferredStylePhotoDiv").text('This field is required');
                    $("#errorPreferredStylePhotoDiv").css('color','red');
                    Scroll('scrollDivPreferredStylePhoto');
                    setTimeout(function(){
                        $('#preferred_style_photo').css('border-color','#ced4da');
                        $('#errorPreferredStylePhotoDiv').text('');
                    }, 2000);
                }else if(level_of_direction == ""){
                    $("#level_of_direction").css('border-color','red');
                    $("#errorLevelOfDirectionDiv").text('This field is required');
                    $("#errorLevelOfDirectionDiv").css('color','red');
                    Scroll('scrollDivLevelOfDirection');
                    setTimeout(function(){
                        $('#level_of_direction').css('border-color','#ced4da');
                        $('#errorLevelOfDirectionDiv').text('');
                    }, 2000);
                }else{
                    // console.log('submit form');
                    $("#formStepThree").submit();
                }

            });
        });

        function increaseValue1() {
            var value = parseInt(document.getElementById('adultsCounter').value, 10);
            value = isNaN(value) ? 0 : value;
            value++;
            document.getElementById('adultsCounter').value = value;
        }

        function decreaseValue1() {
            var value = parseInt(document.getElementById('adultsCounter').value, 10);
            value = isNaN(value) ? 0 : value;
            value < 1 ? value = 1 : '';
            value--;
            document.getElementById('adultsCounter').value = value;
        }

        function increaseValue2() {
            var value = parseInt(document.getElementById('childrenCounter').value, 10);
            value = isNaN(value) ? 0 : value;
            value++;
            document.getElementById('childrenCounter').value = value;
        }

        function decreaseValue2() {
            var value = parseInt(document.getElementById('childrenCounter').value, 10);
            value = isNaN(value) ? 0 : value;
            value < 1 ? value = 1 : '';
            value--;
            document.getElementById('childrenCounter').value = value;
        }

        function increaseValue3() {
            var value = parseInt(document.getElementById('infantsCounter').value, 10);
            value = isNaN(value) ? 0 : value;
            value++;
            document.getElementById('infantsCounter').value = value;
        }

        function decreaseValue3() {
            var value = parseInt(document.getElementById('number').value, 10);
            value = isNaN(value) ? 0 : value;
            value < 1 ? value = 1 : '';
            value--;
            document.getElementById('number').value = value;
        }
    </script>
@endsection