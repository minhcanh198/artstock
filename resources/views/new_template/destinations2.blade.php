@extends('new_template.layouts.app')
<style>
	.select2-selection__rendered {
	line-height: 50px!important;
	}

	.select2-selection {
	height: 50px!important;
	}

	.select2-selection__arrow b{
		display:none !important;
	}
</style>
@section('content')
<section class="destination-banner" style="background: url(<?php echo asset('destination_page/assets/'). '/' . $destinationPageSettings->header_main_image; ?>); background-size: cover; background-position: bottom;">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div>
					<div class="text" data-aos="fade-right">
						<h1>{{ $destinationPageSettings->header_heading }}</h1>
						<p>{{ $destinationPageSettings->header_description}}</p>
						<div class="width destinations-head-form">
							<select class="js-example-basic-single" name="state" placeholder="Search your destination">
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
							</select>
						</div>
					</div>
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
					{{ $destinationPageSettings->first_section_header }}
					<span class="d-block destination-s1-title-span">
						Jump to...
					</span>
				</h2>
			</div>
		</div>
		<div class="d-flex flex-wrap justify-content-center">
			@foreach($allContinents as $continents)
				<div class="mb-4 mr-2">
					<a href="#{{ $continents->continent_name }}" class="btn-destinations-one">
						{{ $continents->continent_name}}
					</a>
				</div>
			@endforeach
		</div>
	</div>
</section>
<section class="destination-s2">
	<div class="container">
		<div class="row mb-4">
			<div class="col-12">
				<h2 class="destination-s2-title">
					{{ $destinationPageSettings->second_section_header }}
				</h2>
				<p class="destination-s2-title-disc">
					{{ $destinationPageSettings->second_section_content }}
				</p>
			</div>
		</div>
		<ul class="row">
			@foreach($getCities as $cities)
				<div class="mb-4 col-md-3">
					<a href="{{ url('/').'/destinations/'. $cities->city_slug }}" style="text-decoration: none; ">
						<div class="destination-s2-box box-shadow-custom-hover" >
							<div class="img-destinaion on-hover-wrapper" >
								<img src="{{ url('/') }}/public/img-city/{{ $cities->city_img }}" alt="" class="img-fluid on-hover">
							</div>
							<div class="content">
								<h3 class="title">{{ $cities->city_name }}</h3>
								<div class="text-center">
									<a href="{{ url('/').'/destinations/'. $cities->city_slug }}" class="content-btn">Explore Photographers</a>
								</div>
							</div>
						</div>
					</a>
				</div>
			@endforeach
		</div>
	</div>
</section>

@foreach($allContinents as $continent)
	<section class="destination-group-city-list city-list--usa " id="{{$continent->continent_name}}">
		<div class="container custom-border-bottom">
			<h2 class="h3">{{ $continent->continent_name }}</h2>
			<ul class="locations-list">

				@php

					$getCountriesByContinentId = \App\Models\Country::where('continent_id','=',$continent->id)->get();

				@endphp
				@foreach($getCountriesByContinentId as $country)
					@php
						$getCities = \App\Models\Cities::where('country_id','=',$country->id)->get();
						$countDataCities = count($getCities);
					@endphp
					@if($countDataCities > 0)
						<li class="locations-list__countries">
							<h3 class="h5 location-list-title">{{ $country->country_name }} <small>( 7 )</small> <span class="toggle-cities-icon"></span></h3>
							<ul class="locations-list__cities">
								@php
									$getCitiesByCountryId = \App\Models\Cities::where('country_id','=',$country->id)->get();
								@endphp
								@foreach($getCitiesByCountryId as $city)
								<li>
									<a href="{{ url('/').'/destinations/'. $city->city_slug }}">{{ $city->city_name }}</a>
								</li>
								@endforeach
							</ul>
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
