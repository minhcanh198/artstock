@extends('new_template.layouts.app')
@section('content')

<section class="destination banner-section" style="background: url(<?php echo asset('destination_page_new/destination-1.jpg') ?>)">
			<div class="container">
				<div class="row">
					<div class="col-12 text-center">
						<h2 class="destination-title add-padding">
							{{ $destinationPageSettings->header_heading }}
						</h2>
						<p>
							{{ $destinationPageSettings->header_description}}
						</p>
						<div class="destination-search-box">
							<form action="">
								<div class="row  justify-content-center">
									<div class="col-md-10 mx-auto">
    								    <div class="row">
    								            	<div class="col-sm-5 p-0 m-0  country-destination-div-1">

    										<!-- <select class="js-example-basic-single" name="state" placeholder="Search your destination">
    											<option value=""></option>
    											@php
    												$getCountryname = \App\Models\Country::orderBy('country_name', 'ASC')->get();
    											@endphp
    											@foreach($getCountryname as $countryName)
    												<optgroup label="{{ $countryName->country_name }}">
    													@php
    														$getCitiesName = \App\Models\Cities::where('country_id','=',$countryName->id)->orderBy('city_name', 'ASC')->get();
    													@endphp
    													@foreach($getCitiesName as $cityName)
    														<option data-tokens="{{ $cityName->city_id }}">{{ $cityName->city_name }}</option>
    													@endforeach
    											@endforeach
    										</select> -->


    										<select class="js-example-basic-single" name="countryDestination" id="countryDestination">
    											<option value=""></option>
    												 <!--$getCountryname = \App\Models\Country::select('country.*','cities.id AS CityId')->join('cities','country.id','=','cities.country_id')->orderBy('country_name', 'ASC')->groupBy('country.id')->get();-->
    												<!-- $getCountryname = \App\Models\Country::select('*')->orderBy('country_name', 'ASC')->get(); -->
    											@php
    												 $getCountryname = \DB::table('new_countries')->select('*')->orderBy('name', 'ASC')->get();

    											@endphp
    											@foreach($getCountryname as $countryName)
    												{{-- <!--<option value="{{ $countryName->id }}">{{ $countryName->country_name }}</option>--> --}}
    												<option value="{{ $countryName->id }}">{{ $countryName->name }}</option>
    											@endforeach
    										</select>

    									</div>
    									<div class="col-sm-5 p-0 m-0 country-destination-div-2">

    										<select class="js-example-basic-single-city" disabled name="cityDestination" id="cityDestination">

    										</select>

    									</div>
    									<div class="col-sm-2 p-0 m-0 country-destination-button custom">
    										<button type="button" class="btn-destination-search" id="btnFindSearchDestination">Find Now</button>
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
		<section class="destination-s1">
			<div class="container">
				<div class="row mb-4">
					<div class="col-12 text-center">
						<h2 class="destination-s1-title">
							{{ $destinationPageSettings->second_section_header }}
						</h2>
						<p>
							{{ $destinationPageSettings->second_section_content }}
						</p>
					</div>
					<!--<div class="col-12">-->
					<!--	<div class="destination-btns">-->
					<!--		<ul>-->
							{{-- @foreach($allContinents as $continents) --}}
								<!--<li>-->
									{{-- <!--<a href="#{{ $continents->continent_name }}">{{ $continents->continent_name}}</a>--> --}}
									{{-- <!--<a href="javascript:;" id="getContinentData#{{}}">{{ $continents->continent_name}}</a>-->--}}
								<!--</li>-->
							{{-- @endforeach --}}
					<!--		</ul>-->
					<!--	</div>-->
					<!--</div>-->
				</div>
				<div class="row margin-top-destination-location-box" id="getRoutesDivDest">
					@foreach($getCities as $cities)
						<div class="col-lg-4 col-md-6 mb-4-cutom">
							<div class="destination-location-box">
								<div class="img">
									<img src="{{ url('/') }}/public/img-city/{{ $cities->city_img }}" alt="" class="img-responsive" style="border-radius: 8px;">
								</div>
								<div class="content row">
									<div class="heading col-sm-6 padding-xs-0">
										<!-- <h4>Istanbul, Turkey</h4> -->
										<h4>{{ $cities->city_name }}</h4>
									</div>
									<div class="action col-sm-6">
										<a href="{{ url('/').'/destinations/'. $cities->city_slug }}">Book Destination</a>
									</div>
								</div>
							</div>
						</div>
					@endforeach
				</div>
			</div>
        </section>

        @foreach($allContinents as $continent)
	<section class="destination-group-city-list city-list--usa " id="{{$continent->continent_name}}">
		<div class="container custom-border-bottom">
			<h2 class="h3">{{ $continent->continent_name }}</h2>
			<ul class="row">


				@php

					$getCountriesByContinentId = \DB::table('new_countries')->where('continent_id','=',$continent->id)->get();

				@endphp
				@foreach($getCountriesByContinentId as $country)
					@php

						$getCities = \DB::table('new_cities')->where('country_id','=',$country->id)->get();
						$countDataCities = count($getCities);
					@endphp
					@if($countDataCities > 0)
						<li class="col-lg-custom col-md-3 col-6">

							<h3 class="h5 location-list-title" style="font-weight: 600;"><a href="javascript:;" id="countryGet#{{ $country->id }}">{{ $country->name }}</a> <small>( 7 )</small> <span class="toggle-cities-icon"></span></h3>
							<!--<ul class="locations-list__cities">-->
								{{-- @php

									$getCitiesByCountryId = \DB::table('new_cities')->where('country_id','=',$country->id)->limit(10)->get();
								@endphp
								@foreach($getCitiesByCountryId as $city) --}}
								<!--<li>-->

							{{--	<!--	<a href="">{{ $city->name }}</a>--> --}}
								<!--</li>-->
								{{-- @endforeach --}}
							<!--</ul>-->
						</li>
					@endif
				@endforeach
			</ul>
		</div>
	</section>
@endforeach

<section class="destination-s4" style="background: url(<?php echo asset('destination_page/assets/'). '/' . $destinationPageSettings->third_section_main_image; ?>); background-size: cover;">
	<div class="container">
		<div class="row">
			<div class="col-md-6 offset-md-3">
				<h2 class="destination-s4-title">
				{{ $destinationPageSettings->third_section_content }}

				</h2>
				<div class="mt-4">
					<a href="{{ url('/').'/destinations/forms/suggest-a-city/' }}" target="_blank" class="request-city">{{ $destinationPageSettings->third_section_button_text }}</a>
				</div>
			</div>
		</div>
	</div>
</section>

		@endsection
