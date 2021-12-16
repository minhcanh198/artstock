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
    <section class="request-book-s1">
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
                            <div class="request-book-progressbar-bar request-book-progressbar-bar-after active">2</div>
                        </div>
                        <div class="col-md-4 d-flex justify-content-center">
                            <div class="request-book-progressbar-bar">3</div>
                        </div>
                    </div>
                    <form method="post" id="formStepTwo" action="{{ url('/') }}/request-to-book/step-three">
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
                                <div class="plus-minus-request-book mb-5" id="scrollDivParticipants">
                                    <label for="">How many participants will be on the shoot?<span style="color:red;"> *</span></label>
                                    <p class="mb-3">Don't worry – you will be able to re-confirm this later!</p>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="d-flex">
                                                <div class="number-request-book mr-2">
                                                    <label>Adults (13+)</label>
                                                    <div class="value-button" id="decrease" onclick="decreaseValue1()" value="Decrease Value">-</div>
                                                    <input type="number" id="adultsCounter" name="adultsCounters" value="0" />
                                                    <div class="value-button" id="increase" onclick="increaseValue1()" value="Increase Value">+</div>
                                                </div>
                                                <div class="number-request-book mr-2">
                                                    <label>Children (3-12)</label>
                                                    <div class="value-button" id="decrease" onclick="decreaseValue2()" value="Decrease Value">-</div>
                                                    <input type="number" id="childrenCounter" name="childrenCounters" value="0" />
                                                    <div class="value-button" id="increase" onclick="increaseValue2()" value="Increase Value">+</div>
                                                </div>
                                                <div class="number-request-book	">
                                                    <label>Infants (0-2)</label>
                                                    <div class="value-button" id="decrease" onclick="decreaseValue3()" value="Decrease Value">-</div>
                                                    <input type="number" id="infantsCounter" name="infantsCounters" value="0" />
                                                    <div class="value-button" id="increase" onclick="increaseValue3()" value="Increase Value">+</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="errorParticipantsDiv"></div>
                                </div>
                                <div class="" id="scrollDivTripReason">
                                    <label for="">What is the reason for your trip?<span style="color:red;"> *</span></label>
                                    <select class="form-control" name="trip_reason" id="trip_reason">
                                        <option value="">Select Trip Reason</option>
                                        @foreach($getTripReason as $tp)
                                            <option value="{{ $tp->id }}">{{ $tp->trip_reason_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div id="errorTripReasonDiv"></div>
                                <div class="mt-4" id="scrollDivPackage">
                                    <label for="">Choose your package<span style="color:red;"> *</span></label>
                                    <select class="form-control" name="package" id="package">
                                        <option value="">Select Package</option>
                                        @foreach($getPackage as $p)
                                            <option value="{{ $p->id }}">{{ ($p->hours != "") ? $p->hours. ' Hours - ' : $p->minutes. ' Minutes - '  }} {{ '$'.$p->price. ' USD - ' }} {{ $p->number_of_photos. ' photos'}}</option>
                                        @endforeach
                                    </select>
                                    <p class="mt-2">For groups of more than 6 we require a shoot length minimum of 60 minutes, for groups of more than 10 we require a shoot length minimum of 90 minutes, and for groups of more than 15 we require a shoot length minimum of 2 hours.</p>
                                </div>
                                <div id="errorPackageDiv"></div>
                                <div class="mt-4">
                                    <label for="">Do you have any time restrictions your photographer needs to know about?</label>
                                    <p class="mb-3">(e.g. You request a morning shoot but you have another activity booked at 11am)</p>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" name="time_restrictions_description" rows="6"></textarea>
                                    <p class="mt-2">
                                        Why is this important? The start time a photographer has available is dependent on whether they have other shoots already booked in your desired time slot. Letting us know if you have other plans or cannot start early will help them confirm their availability for your shoot.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-10 offset-md-1">
                                <div class="row">
                                    <div class="ml-auto">
                                        <button type="button" id="btnSecondStepTwo" class="btn-final-request-book"><i class="fas fa-long-arrow-alt-right"></i>  Final Step</button>
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
            $("#btnSecondStepTwo").click(function(){
                let adultsCount 	= $("#adultsCounter").val();
                let childrenCount 	= $("#childrenCounter").val();
                let infantsCount 	= $("#infantsCounter").val();
                let tripReason      = $("#trip_reason").val();
                let package      = $("#package").val();

                totalCount = adultsCount + childrenCount + infantsCount;

                if(totalCount <= 0){
                    $("#adultsCounter").css('border-color','red');
                    $("#childrenCounter").css('border-color','red');
                    $("#infantsCounter").css('border-color','red');
                    $("#errorParticipantsDiv").text('Please choose at least one participant');
                    $("#errorParticipantsDiv").css('color','red');
                    Scroll('scrollDivParticipants');
                    setTimeout(function(){
                        $('#adultsCounter').css('border-color','#ced4da');
                        $('#childrenCounter').css('border-color','#ced4da');
                        $('#infantsCounter').css('border-color','#ced4da');
                        $('#errorParticipantsDiv').text('');
                    }, 3000);
                    
                }else if(tripReason == ""){

                    $("#trip_reason").css('border-color','red');
                    $("#errorTripReasonDiv").text('This field is required');
                    $("#errorTripReasonDiv").css('color','red');
                    Scroll('scrollDivTripReason');
                    setTimeout(function(){
                        $('#trip_reason').css('border-color','#ced4da');
                        $('#errorTripReasonDiv').text('');
                    }, 3000);

                }else if(package == ""){

                    $("#package").css('border-color','red');
                    $("#errorPackageDiv").text('This field is required');
                    $("#errorPackageDiv").css('color','red');
                    Scroll('scrollDivPackage');
                    setTimeout(function(){
                        $('#package').css('border-color','#ced4da');
                        $('#errorPackageDiv').text('');
                    }, 3000);

                }else{
                    $("#formStepTwo").submit();
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