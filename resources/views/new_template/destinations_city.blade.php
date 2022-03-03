
@extends('new_template.layouts.app')
@section('content')
<section class="choose-photographer banner-section">
			<div class="container-fluid">
				<div class="row">
                @if($getCityDetails->city_img != "")
                    <div class="col-md-6 padding-left-0">
                        <img loading="lazy" src="{{ url('/').'/img-city/'.$getCityDetails->city_img }}" alt="" class="img-responsive set-height-450">
                    </div>
					<div class="col-md-5 align-self-center">
                @else
                    <div class="col-md-8 offset-md-2 pt-4 pb-4">
                @endif
                        <div class="">
                            <h2 class="choose-photographer-title">
                                Welcome to {{ $getCityDetails->city_name }}!
                            </h2>
                            <p>
                                {{ $getCityDetails->description }}
                            </p>
                            <!-- <div class="">
                                <a href="" class="btn-destination-search">Book Now</a>
                            </div> -->
                        </div>
					</div>
				</div>
			</div>
		</section>
		<section class="destination-s1">
			<div class="container container-destination-s1">
				<div class="row mb-4">
					<div class="col-md-6 offset-md-3 text-center">
                        <h2 class="destination-s1-title">
                            Choose The Best Artist In {{ $getCityDetails->city_name }}
                        </h2>
                        <!-- <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                        </p> -->
					</div>
				</div>
				<!-- <div class="row margin-top-destination-location-box"> -->

                <artistcard citySlug=<?php echo $getCityDetails->city_slug ?> cityRoute=<?php echo 'city'; ?> sessionUser=<?php echo (\Auth::user()) ? \Auth::user()->id : ''; ?>></artistcard>



                    <!-- <div class="col-sm-12 text-center mt-4-custom">
                        <a href="" class="load-more-one">
                            Load More
                        </a>
                    </div> -->
				<!-- </div> -->
			</div>
        </section>
        <section class="last-section-photographer" style="background: url(<?php echo asset('destination_page_new/destination-1.jpg') ?>)">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6 set-padding-col">
                        <h2 class="last-section-photographer-title">
                            Explore Popular Destinations in {{ $getCityDetails->city_name }}.
                        </h2>
                        <!-- <p>
                            Lorem ipsum dolor sit, amet consectetur adipisicing elit. Eaque, autem? Maiores, porro quo laudantium voluptatibus officia repellendus excepturi enim praesentium aperiam vel distinctio quam eius, nostrum asperiores facilis impedit omnis.
                        </p> -->
                        <!-- <div class="">
                            <a href="" class="btn-destination-search">Book Now</a>
                        </div>   -->
                    </div>
                    <div class="col-md-6">
                        <div class="owl-carousel owl-carousel-photographer owl-theme">
                			@foreach($getRoutesByCity as $routesData)

                                <div class="item">
                                    <div class="popular-destination-box">
                                        <div class="img">
                                            @if($routesData->route_img != "")
                                            <img loading="lazy" src="{{ url('/').'/img-route/'.$routesData->route_img }}" alt="" class="img-responsive">
                                            @else
                                            <img loading="lazy" src="{{ url('/').'/destination_page_new/greece.jpg' }}" alt="" class="img-responsive">
                                            @endif
                                            <div class="img-content">
                                                <h3>
                                                    {{ $routesData->route_name }}
                                                    <span class="d-block-custom">{{ $routesData->route_tagline }}</span>
                                                </h3>
                                        </div>
                                        </div>
                                        <div class="content">
                                            <div class="flex-wrap-carousel">
                                                <div class="">
                                                    <h3>{{ $routesData->route_name }}</h3>
                                                    <!-- <p>4.6 miles <span>4.8 Ratings</span></p> -->
                                                </div>
                                                <div class="ml-auto-custom margin-top-10">
                                                    <a href="{{ url('/').'/destinations/'.$getCityDetails->city_slug.'/route/'.$routesData->route_slug }}" class="btn-destination-search">View Route</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>


        @endsection
