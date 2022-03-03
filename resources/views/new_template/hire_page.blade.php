@extends('new_template.layouts.app')
@section('content')
    <div class="bg-new">
        <a href="">View Gellry</a>
    </div>
    <section class="profile">
        <div class="container">
            <div class="row">
                <div class="col-md-8"></div>
            </div>
        </div>
    </section>
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <div class="row mb-5">
                    <div class="col-md-3">
                        <div class="profile-inner">
                            <div class="img">
                                <img loading="lazy" src="<?php echo url('/').'/img/profile.jpeg' ?>" class="img-fluid">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="text2">
                            <h1>Meet Spyros in Santorini</h1>
                            <p>
                                I'm an artist, photographer and image-maker. Ask me about my photography, and I'll tell you about nostalgia, identity, relationship, culture and memory. But that could get boring - all you need to know is that, as a photographer, I infuse these themes into my images to capture the intimate and vulnerable moments that are shared between the both of you.
                            </p>
                            <div class="profile-info-area mt-4">
                                <p class="mb-3"><i class="fas fa-language mr-2"></i> <span class="language">Languages Spoken:</span> Greek and English</p>
                                <p><i class="far fa-heart mr-2"></i> <span class="language">Favourite Place to Shoot:</span> Imerovigli Village</p>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="three-things pt-3 pb-3">
                    <h2 class="title mb-3">Three Things</h2>
                    <ul>
                        <li class="mb-3">
                            <span class="count-one-bold">1.</span> Since I was a child, I have always worked in my family's poultry farms. As soon as I finished my studies in Communication and Mass Media in the university of Athens, I worked as a journalist for a sports website. An empty space in my heart and some riveting pictures my late grandfather had captured of my family encouraged me to study photography and embrace this craft as a way of living.
                        </li>
                        <li class="mb-3">
                            <span class="count-one-bold">2.</span> Since I was a child, I have always worked in my family's poultry farms. As soon as I finished my studies in Communication and Mass Media in the university of Athens, I worked as a journalist for a sports website. An empty space in my heart and some riveting pictures my late grandfather had captured of my family encouraged me to study photography and embrace this craft as a way of living.
                        </li>
                    </ul>
                </div>
                <hr>
                <div class="customer-reviews-area">
                    <div class="d-flex mb-3">.
                        <div class="">
                            <h2 class="title">Customer Reviews</h2>
                        </div>
                        <div class="ml-auto align-self-center">
                            <p class="anchor-tag">Reviews Policy <i class="fas fa-info-circle"></i></p>
                        </div>
                    </div>
                </div>
                <div class="customer-review-write-area mt-5">
                    <div class="row">
                        <div class="col-4">
                            <img loading="lazy" src="<?php echo url('/').'/img/review-img.jpeg' ?>" class="img-fluid">
                        </div>
                        <div class="col-8">
                            <p> Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                Provident odit vel qui similique at alias tempora! Repudiandae nostrum quod
                                ipsum amet saepe assumenda consectetur et perferendis! Sint cumque aspernatur eum!
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                Provident odit vel qui similique at alias tempora! Repudiandae nostrum quod
                                ipsum amet saepe assumenda consectetur et perferendis! Sint cumque aspernatur eum!
                            </p>
                            <div class="d-flex mt-3">
                                <div class="reviews-stars">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                                <div class="ml-3">
                                    <p class="person-name">
                                        Person Name
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-4">
                            <img loading="lazy" src="<?php echo url('/').'/img/review-img.jpeg' ?>" class="img-fluid">
                        </div>
                        <div class="col-8">
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                Provident odit vel qui similique at alias tempora! Repudiandae nostrum quod
                                ipsum amet saepe assumenda consectetur et perferendis! Sint cumque aspernatur eum!
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                Provident odit vel qui similique at alias tempora! Repudiandae nostrum quod
                                ipsum amet saepe assumenda consectetur et perferendis! Sint cumque aspernatur eum!
                            </p>
                            <div class="d-flex mt-3">
                                <div class="reviews-stars">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                                <div class="ml-3">
                                    <p class="person-name">
                                        Person Name
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="border-calendar">
                    <div id="containerCalendar"></div>
                    <div class="calender-btn text-center mt-4">
                        <button href="">Request to book Spyros</button>
                    </div>
                    <hr>
                    <div class="celendar-inner">
                        <h4 class="important-note-txt">Important Note:</h4>
                        <p class="mb-3 disc-calender">
                            Requesting a date does not guarantee photographer availability.
                            The photographer will confirm the date and time within 24 hours once they receive your request.
                        </p>
                        <p class="mb-3 disc-calender">
                            Spiros is available for 30-minute minimum bookings in Emporeio & Pyrgos Village\
                            and for 60-minute minimum bookings in Fira, Imerovigli & Oia.
                        </p>
                        <p class="disc-calender">
                            Pricing starts at $250 USD for a 30-minute vacation shoot
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/container-->
@endsection

