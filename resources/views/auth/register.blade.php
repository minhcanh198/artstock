<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>{{ trans('auth.sign_up').' - ' }}@section('title')@show @if( isset( $settings->title ) ){{$settings->title}}@endif</title>
@section('css')
  <link href="{{ asset('plugins/iCheck/all.css')}}" rel="stylesheet" type="text/css" />
  @endsection
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<link rel="shortcut icon" href="{{ asset('img/favicon.png') }}" />
<meta name="viewport" content="width=device-width, initial-scale=1.0,user-scalable=no">
<link rel="stylesheet" href="{{ asset('custom-css/css/bootstrap.min.css') }}" />
<link rel="stylesheet" href="{{ asset('custom-css/fontawesome/css/all.min.css') }}">
<link rel="stylesheet" href="{{ asset('custom-css/css/owl.carousel.min.css') }}">
<link rel="stylesheet" href="{{ asset('custom-css/slick/slick.css') }}">
<link rel="stylesheet" href="{{ asset('custom-css/slick/slick-theme.css') }}">
<link rel="stylesheet" href="{{ asset('custom-css/css/style.css') }}" />
<link rel="stylesheet" href="{{ asset('custom-css/css/responsive.css') }}" />
<link rel="stylesheet" href="{{ asset('custom-css/css/baguetteBox.min.css') }}" />
<link rel="stylesheet" href="{{ asset('custom-css/css/aos.css') }}"/>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />

<style>
    .myselect2css {
        width: 560px;
        height: calc(1.5em + .75rem + 2px);
    }
    #divCountry > span > span > span {
    box-sizing: border-box;
    cursor: pointer;
    display: block;
    user-select: none;
    -webkit-user-select: none;
    width: 560px;
    height: calc(1.5em + .75rem + 2px);
}

#divCountry > span > span > span > span.select2-selection__arrow {
    height: 26px;
    position: absolute;
    top: 7px;
    right: 1px;
    width: 20px;
}
#divCountry > span > span > span > span.select2-selection__rendered{
    color: #444;
    line-height: 38px;
}

#divCity > span > span > span {
    box-sizing: border-box;
    cursor: pointer;
    display: block;
    user-select: none;
    -webkit-user-select: none;
    width: 560px;
    height: calc(1.5em + .75rem + 2px);
}

#divCity > span > span > span > span.select2-selection__arrow {
    height: 26px;
    position: absolute;
    top: 7px;
    right: 1px;
    width: 20px;
}
#divCity > span > span > span > span.select2-selection__rendered{
    color: #444;
    line-height: 38px;
}
#divRoute > span {
    width: 100%!important;
}
</style>
</head>

<body>
<section class="login-section">
	<div class="container">
		<div class="row">
			<div class="col-md-10 offset-md-1">
				<div class="login-logo text-center">
					<a href="{{ url('/') }}"><img src="{{ asset('custom-css/images/logosvg.svg') }}" width="500" height="100" alt="" class="img-fluid"></a>
				</div>
				<h1 class="login-title text-center mt-4">Welcome To ArtStock United</h1>
				{{-- <div class="text-center mt-4 joinfb">
					<button type="" class="btn-joinfb"><i class="fab fa-facebook-f"></i>Join With Facebook</button>
				</div>
				<div class="text-center mt-4 joinapple">
					<button type="" class="btn-joinapple"><i class="fab fa-apple"></i>Join With Apple</button>
				</div>
				<p class="text-center or-txt mt-3">or</p> --}}
				</div>
		</div>
		<div class="row">
			<div class="col-12 col-md-6 offset-md-3">

                @if (session('notification'))
						<div class="alert alert-success text-center">

							<div class="btn-block text-center margin-bottom-10">
								<i class="glyphicon glyphicon-ok ico_success_cicle"></i>
								</div>

							{{{ session('notification') }}}
						</div>
					@endif

		@include('errors.errors-forms')
                <form action="{{{ url('register') }}}" method="post" name="form" id="signup_form">
                    <input type="hidden" name="_token" value="{{{ csrf_token() }}}">

                    @if($settings->captcha == 'on')
                        @captcha
                    @endif

				    <div class="row mt-4">
                        <div class="mb-3 col" id="usernameDivv">
                            <input type="text" class="form-control login-field custom-rounded" value="{{{ old('username') }}}" id="username" name="username" placeholder="{{{ trans('auth.username') }}}" title="{{{ trans('auth.username') }}}" autocomplete="off">
                            <div id="errorUsernameDiv"></div>
                        </div>

                        <div class="mb-3 col" id="emailDivv">
                            <input type="text" class="form-control login-field custom-rounded" value="{{{ old('email') }}}" id="email" name="email" placeholder="{{{ trans('auth.email') }}}" title="{{{ trans('auth.email') }}}" autocomplete="off">
                            <div id="errorEmailDiv"></div>
                        </div>
                        <div class="mb-3 col-12" id="passwordDivv">
                            <input type="password" class="form-control login-field custom-rounded" id="password" name="password" placeholder="{{{ trans('auth.password') }}}" title="{{{ trans('auth.password') }}}" autocomplete="off">
                            <div id="errorPasswordDiv"></div>
                        </div>
                        <div class="mb-3 col-12" id="passwordConfirmationDivv">
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="{{{ trans('auth.confirm_password') }}}" title="{{{ trans('auth.confirm_password') }}}" autocomplete="off">
                            <div id="errorPasswordConfirmationDiv"></div>
                        </div>
                        <div class="mb-3 col-12" id="userTypeDivv">
                            <select name="user_type" id="user_type" class="form-control">
                                <option value="">Select Type (Optional)</option>
                                @foreach($types as $type)
                                    <option value="{{ $type->types_id }}">{{ $type->type_name }}</option>
                                @endforeach
                            </select>
                            <div id="errorUserTypeDiv"></div>
                        </div>
                        <div class="mb-3 col-12" id="divPerHour" style="display:none;">
                            <input type="text" id="perHour" name="perHour" class="form-control" placeholder="{{ 'Per Hour' }}">
                        </div>

                        <div class="mb-3 col-12" id="divCountry" style="display:none;">
                            <select name="country_id" id="country_id" class="js-example-basic-single-country col-12 myselect2css">
                                <option value="">Select Country</option>
                                @foreach($getCountries as $country)
                                    {{-- <!--<option value="{{ $country->id }}">{{ $country->country_name }}</option>--> --}}
                                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                                @endforeach
                            </select>
                            <div id="errorCountryIdDiv"></div>
                        </div>

                        <div class="mb-3 col-12" id="divCity" style="display:none;">
                            <select name="city_id" id="city_id" class="js-example-basic-single-city form-control" required>
                                <option value="">Select City</option>
                                {{-- @foreach($getCities as $city)
                                    <option value="{{ $city->id }}">{{ $city->city_name }}</option>
                                @endforeach --}}
                            </select>
                            <div id="errorCityIdDiv"></div>
                        </div>

                        <!--<div class="mb-3 col-12" id="divRoute" style="display:none;">-->
                        <!--    <select name="route_id[]" id="route_id" class="js-example-basic-multiple-route form-control" multiple="multiple" data-placeholder="Select Route" required>-->
                        <!--        {{-- @foreach(\App\Models\Routes::where('is_active','=','1')->get() as $route)-->
                        <!--            <option value="{{ $route->id }}">{{ $route->route_name }}</option>-->
                        <!--        @endforeach --}}-->
                        <!--    </select>-->
                        <!--    <div id="errorRouteIdDiv"></div>-->
                        <!--</div>-->
                    </div>
                    <div class="row margin-bottom-15">
                        <div class="col-lg-11">
                            <div class="checkbox icheck margin-zero">
                                <label class="margin-zero">
                                    <input @if( old('agree_gdpr') ) checked="checked" @endif class="no-show" name="agree_gdpr" type="checkbox" value="1"><p class="keep-login-title">{{ trans('admin.i_agree_gdpr') }}</p>
                                    @if($settings->link_privacy != '')
                                        <a href="{{$settings->link_privacy}}" target="_blank">{{ trans('admin.privacy_policy') }}</a>
                                    @endif
                                </label>
                            </div>
                        </div>
                    </div><!-- row -->
                    <div class="row">
                        <div class="col-12">
                            {{-- <button type="submit" class="btn-signup">Sign Up</button> --}}
                            <button type="button" id="buttonSubmitRegister" class="btn btn-signup btn-block btn-lg btn-main custom-rounded">{{{ trans('auth.sign_up') }}}</button>
                        </div>
                    </div>
                    @if( $settings->facebook_login == 'on' || $settings->twitter_login == 'on' )
                            <p class="text-center mt-4 login-link auth-social " id="twitter-btn-text">{{ trans('auth.or_sign_in_with') }}</p>
                    @endif

                    @if( $settings->facebook_login == 'on' )
     					<div class="text-center mt-4 facebook-login auth-social d-flex justify-content-center" id="twitter-btn">
     						<a href="{{url('oauth/facebook')}}" class="btn btn-block btn-lg facebook custom-rounded btn-joinfb" style="width:100%;"><i class="fab fa-facebook"></i> Facebook</a>
     					</div>
                    @endif

                    <!--@if( $settings->twitter_login == 'on')-->
                    <!--    <div class="text-center mt-4 facebook-login auth-social d-flex justify-content-center" id="twitter-btn">-->
                    <!--        <a href="{{url('oauth/twitter')}}" class="btn btn-block btn-lg twitter custom-rounded btn-jointwitter" style="width:100%;"><i class="fab fa-twitter"></i> Twitter</a>-->
                    <!--    </div>-->
                    <!--@endif-->
				</form>
				{{-- <p class="mt-3">By joining, you agree to our <strong>Terms of Service</strong> and <strong>Privacy Policy</strong></p> --}}
			</div>
		</div>
    </div>
</section>



@section('javascript')

  <script src="{{ asset('plugins/iCheck/icheck.min.js') }}"></script>

	<script type="text/javascript">

    @if (count($errors) > 0)
    	scrollElement('#dangerAlert');
    @endif

    @if (session('notification'))
    	$('#signup_form, #dangerAlert').remove();
    @endif

    $(document).ready(function(){
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-red',
        });
    });


</script>


@endsection

<script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js"></script>
<script src="{{ asset('custom-css/js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('custom-css/js/popper-min.js') }}"></script>
<script src="{{ asset('custom-css/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('custom-css/slick/slick.min.js') }}"></script>
<!-- <script src="audiojs/audio.min.js"></script> -->
<script src="{{ asset('custom-css/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('custom-css/js/custom.js') }}"></script>
<script src="{{ asset('custom-css/js/baguetteBox.min.js') }}"></script>
<script src="{{ asset('custom-css/js/aos.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script>
  AOS.init();

    $(document).ready(function() {
        $('.js-example-basic-single-country').select2();
        $('.js-example-basic-single-city').select2();
        $('.js-example-basic-multiple-route').select2();

    });

    function emailIsValid (email) {
       return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)
    }


    $("#buttonSubmitRegister").click(function(){
        let userName = $("#username").val();
        let email = $("#email").val();
        let password = $("#password").val();
        let passwordConfirmation = $("#password_confirmation").val();
        let userType = $("#user_type").val();
        let countryId = $("#country_id").val();
        let cityId = $("#city_id").val();
        let routeId = $("#route_id").val();

        var re = /^(([^<>()[]\.,;:s@"]+(.[^<>()[]\.,;:s@"]+)*)|(".+"))@(([[0-9]{1,3}.[0-9]{1,3}.[0-9]{1,3}.[0-9]{1,3}])|(([a-zA-Z-0-9]+.)+[a-zA-Z]{2,}))$/igm;

        // console.log(userName);
        // console.log(email);
        // console.log(password);
        // console.log(passwordConfirmation);
        // console.log(userType);
        // console.log(countryId);
        // console.log(cityId);
        // console.log(routeId);

        if(userName == ""){
            $("#username").css('border-color','red');
            $("#errorUsernameDiv").text('This field is required');
            $("#errorUsernameDiv").css('color','red');
            setTimeout(function(){
                $('#username').css('border-color','#ced4da');
                $('#errorUsernameDiv').text('');
            }, 2000);

        }else if(email == ""){
            $("#email").css('border-color','red');
            $("#errorEmailDiv").text('This field is required');
            $("#errorEmailDiv").css('color','red');
            setTimeout(function(){
                $('#email').css('border-color','#ced4da');
                $('#errorEmailDiv').text('');
            }, 2000);
        }else if(password == ""){
            $("#password").css('border-color','red');
            $("#errorPasswordDiv").text('This field is required');
            $("#errorPasswordDiv").css('color','red');
            setTimeout(function(){
                $('#password').css('border-color','#ced4da');
                $('#errorPasswordDiv').text('');
            }, 2000);
        }else if(passwordConfirmation == ""){
            $("#password_confirmation").css('border-color','red');
            $("#errorPasswordConfirmationDiv").text('This field is required');
            $("#errorPasswordConfirmationDiv").css('color','red');
            setTimeout(function(){
                $('#password_confirmation').css('border-color','#ced4da');
                $('#errorPasswordConfirmationDiv').text('');
            }, 2000);
        }else if(password != passwordConfirmation){
            $("#password_confirmation").css('border-color','red');
            $("#errorPasswordConfirmationDiv").text('Password not match');
            $("#errorPasswordConfirmationDiv").css('color','red');
            setTimeout(function(){
                $('#password_confirmation').css('border-color','#ced4da');
                $('#errorPasswordConfirmationDiv').text('');
            }, 2000);
        }
        // else if(userType == ""){
        //     $("#user_type").css('border-color','red');
        //     $("#errorUserTypeDiv").text('This field is required');
        //     $("#errorUserTypeDiv").css('color','red');
        //     setTimeout(function(){
        //         $('#user_type').css('border-color','#ced4da');
        //         $('#errorUserTypeDiv').text('');
        //     }, 2000);
        // }
        else if(userType != "" && countryId == ""){
            $("#country_id").css('border-color','red');
            $("#errorCountryIdDiv").text('This field is required');
            $("#errorCountryIdDiv").css('color','red');
            setTimeout(function(){
                $('#country_id').css('border-color','#ced4da');
                $('#errorCountryIdDiv').text('');
            }, 2000);
        }else if(userType != "" && cityId == ""){
            $("#city_id").css('border-color','red');
            $("#errorCityIdDiv").text('This field is required');
            $("#errorCityIdDiv").css('color','red');
            setTimeout(function(){
                $('#city_id').css('border-color','#ced4da');
                $('#errorCityIdDiv').text('');
            }, 2000);
        }else if(userType != "" && routeId == ""){
            $("#route_id").css('border-color','red');
            $("#errorRouteIdDiv").text('This field is required');
            $("#errorRouteIdDiv").css('color','red');
            setTimeout(function(){
                $('#route_id').css('border-color','#ced4da');
                $('#errorRouteIdDiv').text('');
            }, 2000);
        }else{
            $("#signup_form").submit();
        }
    });



    $("#user_type").change(function(){
        let getVal = $(this).val();

        if(getVal != "")
        {
            if(getVal == "2"){

                $("#divPerHour").show();
            }else{
                $("#divPerHour").hide();
            }
            $("#divCountry").show();
            // $("#divCity").show();
        }else{
            $("#divCountry").hide();
            // $("#divCity").hide();
        }
    });
    $("#country_id").change(function(){
        const base_url = "<?php echo url('/')?>";
        let countryId = $(this).val();

        if(countryId != ""){

            $.ajax({
                url: base_url + '/get-cities-by-country/'+ countryId,
                type:'GET',
                dataType:'json',
                success:function(resp)
                {
                    console.log(resp);
                    $("#city_id").empty();
                    var cityOption = "";
                    cityOption += "<option value=''>Select City</option>";
                    $.each( resp, function( key, value ) {
                        // cityOption +='<option value="'+ value.id +'">'+ value.city_name + '</option>';
                        cityOption +='<option value="'+ value.id +'">'+ value.name + '</option>';
                    });
                    $("#city_id").append(cityOption);

                },
                error:function()
                {
                    alert('error in registration form while getting cities by country id');
                }
            });
            $("#divCity").show();
        }else{
            $("#divCity").hide();
            $("#city_id").empty();
            var cityOption = "";
            cityOption += "<option value=''>Select City</option>";
            $("#city_id").append(cityOption);
        }
    });

    // $("#city_id").change(function(){
    //     const base_url = "<?php echo url('/')?>";
    //     let cityId = $(this).val();

    //     if(cityId != ""){

    //         $.ajax({
    //             url: base_url + '/get-route-by-city/'+ cityId,
    //             type:'GET',
    //             dataType:'json',
    //             success:function(resp)
    //             {
    //                 // console.log(resp);
    //                 // $("#route_id").empty();
    //                 // var routeOption = "";
    //                 // $.each( resp, function( key, value ) {
    //                 //     routeOption +='<option value="'+ value.id +'">'+ value.route_name + '</option>';
    //                 // });
    //                 // $("#route_id").append(routeOption);

    //             },
    //             error:function()
    //             {
    //                 alert('error in registration form while getting cities by country id');
    //             }
    //         });
    //         $("#divRoute").show();
    //     }else{
    //         $("#divRoute").hide();
    //         $("#route_id").empty();
    //         var routeOption = "";
    //         $("#route_id").append(routeOption);
    //     }
    // });
</script>
</body>
</html>



