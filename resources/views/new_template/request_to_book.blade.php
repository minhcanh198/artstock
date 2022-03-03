@extends('new_template.layouts.app')



@section('content')
<section class="hire-more-section">
    <div class="container">
        <div class="row mt-4 mb-5">
            <div class="col-12 text-center">
                @if($getTypeDetails != null)
                    @if($getTypeDetails->type_name == "Photographer")
                        <h1>What type of photo shoot would you like to book?</h1>
                    @elseif($getTypeDetails->type_name == "Animator")
                        <h1>What type of animation work would you like to book?</h1>
                    @elseif($getTypeDetails->type_name == "Videographer")
                        <h1>What type of video shoot would you like to book?</h1>
                    @elseif($getTypeDetails->type_name == "Musician")
                        <h1>What type of music would you like to book?</h1>
                    @else
                    @endif
                @else
                <h1>Select anyone type you like to book!</h1>
                @endif
            </div>
        </div>
        @if($getTypeDetails != null)
        <div class="row pt-4">
        @endif
            @if($getTypeDetails != null)
                @foreach($photoshootTypes as $photoShoot)
                <div class="col-md-4 mb-5 ">
                <!-- hire-more-active -->
                    <div class="hire-more-box  " id="box_photoshoot_type-{{ $photoShoot->id }}">
                        <div class="img">
                            <img loading="lazy" src="<?php echo url('/').'/img-photoshoot_type/'.$photoShoot->photoshoot_icon_img; ?>" alt="" class="img-fluid">
                        </div>
                        <div class="txt">
                        <!-- <i class="fas fa-check"></i> -->
                            <p class="disc">
                                {{ $photoShoot->photoshoot_name }}
                            </p>
                        </div>
                    </div>
                </div>
                @endforeach
            @else
                <div class="row mb-4">
                    <div class="col-12 text-center">
                        <h1>Photography Types </h1>
                    </div>
                </div>

                <div class="row">
                @foreach($photoshootTypes as $photoShoot)
                    @if($photoShoot->types_id == "1")
                        <div class="col-md-4 mb-5 ">
                            <!-- hire-more-active -->
                            <div class="hire-more-box  " id="box_photoshoot_type-{{ $photoShoot->id }}">
                                <div class="img">
                                    <img loading="lazy" src="<?php echo url('/').'/img-photoshoot_type/'.$photoShoot->photoshoot_icon_img; ?>" alt="" class="img-fluid">
                                </div>
                                <div class="txt">
                                <!-- <i class="fas fa-check"></i> -->
                                    <p class="disc">
                                        {{ $photoShoot->photoshoot_name }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
                </div>
                <div class="row mb-4">
                    <div class="col-12 text-center">
                        <h1>Animation Types </h1>
                    </div>
                </div>

                <div class="row">
                @foreach($photoshootTypes as $photoShoot)
                    @if($photoShoot->types_id == "2")
                        <div class="col-md-4 mb-5 ">
                            <!-- hire-more-active -->
                            <div class="hire-more-box  " id="box_photoshoot_type-{{ $photoShoot->id }}">
                                <div class="img">
                                    <img loading="lazy" src="<?php echo url('/').'/img-photoshoot_type/'.$photoShoot->photoshoot_icon_img; ?>" alt="" class="img-fluid">
                                </div>
                                <div class="txt">
                                <!-- <i class="fas fa-check"></i> -->
                                    <p class="disc">
                                        {{ $photoShoot->photoshoot_name }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
                </div>

                <div class="row mb-4">
                    <div class="col-12 text-center">
                        <h1>Videography Types </h1>
                    </div>
                </div>
                <div class="row">
                @foreach($photoshootTypes as $photoShoot)
                    @if($photoShoot->types_id == "3")
                        <div class="col-md-4 mb-5 ">
                            <!-- hire-more-active -->
                            <div class="hire-more-box  " id="box_photoshoot_type-{{ $photoShoot->id }}">
                                <div class="img">
                                    <img loading="lazy" src="<?php echo url('/').'/img-photoshoot_type/'.$photoShoot->photoshoot_icon_img; ?>" alt="" class="img-fluid">
                                </div>
                                <div class="txt">
                                <!-- <i class="fas fa-check"></i> -->
                                    <p class="disc">
                                        {{ $photoShoot->photoshoot_name }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
                </div>

                <div class="row mb-4">
                    <div class="col-12 text-center">
                        <h1>Music Types </h1>
                    </div>
                </div>
                <div class="row">
                @foreach($photoshootTypes as $photoShoot)
                    @if($photoShoot->types_id == "4")
                        <div class="col-md-4 mb-5 ">
                            <!-- hire-more-active -->
                            <div class="hire-more-box  " id="box_photoshoot_type-{{ $photoShoot->id }}">
                                <div class="img">
                                    <img loading="lazy" src="<?php echo url('/').'/img-photoshoot_type/'.$photoShoot->photoshoot_icon_img; ?>" alt="" class="img-fluid">
                                </div>
                                <div class="txt">
                                <!-- <i class="fas fa-check"></i> -->
                                    <p class="disc">
                                        {{ $photoShoot->photoshoot_name }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
                </div>
            @endif
            <div class="col-12 text-center">
                <div class="popup-hire-more">
                    <form method="post" action="<?php echo url('/').'/request-to-book/step-one'?>" id="formRequestToBook">
                        @csrf
                        <input type="text" hidden id="photoshootId" name="photoshootId" value="">
                        <input type="text" hidden id="photographerId" name="photographerId" value="<?php echo Request::get('photographerId')?>">
                        <input type="text" hidden id="DatePrefered" name="DatePrefered" value="<?php echo Request::get('DatePrefered')?>">
                        <input type="text" hidden id="timeOfDay" name="timeOfDay" value="<?php echo Request::get('timeOfDay')?>">
                        <input type="text" hidden id="cityId" name="cityId" value="<?php echo Request::get('cityId')?>">
                        <!-- <button type="button" class="button button-disabled-custom btn btn-default btn-rounded my-3" id="btnGetStarted" data-toggle="modal" data-target="#myLoginModal"> -->
                        <button type="submit" class="button button-disabled-custom btn btn-default btn-rounded my-3" id="btnGetStarted" >
                            Get Started
                        </button>
                    </form>
                </div>
            </div>
        @if($getTypeDetails != null)
        </div>
        @endif
    </div>
</section>


<!--Modal: Login / Register Form-->
<div class="modal fade show" id="myLoginModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog cascading-modal" role="document">
    <!--Content-->
    <div class="modal-content">
        <div class="logo-modal">
            <img loading="lazy" src="<?php echo url('/').'/img/commercial-1.svg' ?>" alt="" class="img-fluid">
        </div>
      <!--Modal cascading tabs-->
        <div class="d-flex justify-content-center mt-4 mb-4">
            <div class="">
                <button id="modalLoginReg-createAccount" class="reglog-right-border-radius btn-login-register-unactive" href="">
                Create Account</button>
            </div>
            <div class="">
                <button id="modalLoginReg-login" class="reglog-left-border-radius btn-login-register-active" href="">
                Login</button>
            </div>
        </div>
        <!-- <div class="modal-c-tabs"> -->

            <!-- Tab panels -->
            <div class="tab-content">
                <!--Panel 7-->
                <div class="tab-pane fade in show active" id="LoginPanel" role="tabpanel">
                    <!--Body-->
                    <div class="modal-body mb-1">
                    <!-- <h4 class="text-center mb-4 mt-4">Personal Information</h4> -->
                    <div class="md-form form-sm mb-4">
                        <!-- <i class="fas fa-envelope prefix"></i> -->
                        <label data-error="wrong" data-success="right" for="signin-email">Email</label>
                        <input type="email" id="signin-email" name="signin_email" class="form-control form-control-login-tab validate">
                    </div>
                    <div class="md-form form-sm mb-4">
                        <!-- <i class="fas fa-lock prefix"></i> -->
                        <label data-error="wrong" data-success="right" for="signin-password">Password</label>
                        <input type="password" id="signin-password" name="signin_password" class="form-control form-control-login-tab validate">
                    </div>
                    <div class="md-form form-sm mb-4 ml-4">
                        <input class="form-check-input" type="checkbox" value="" id="defaultCheckOne">
                        <label class="form-check-label" for="defaultCheckOne">
                            Show password?
                        </label>
                    </div>
                    <div class="text-center mt-2">
                        <button class="btn btn-info modal-login-button">Log in</button>
                    </div>
                    <div class="text-center mt-2">
                        <a class="">Oh no! I've forgotten my password!</a>
                    </div>
                    <div class="text-center mt-2">
                        <p class="">OR</p>
                    </div>
                    <div class="text-center mt-2">
                        <button class="btn btn-info modal-login-button">Connect With Facebook</button>
                    </div>
                    <div class="text-center mt-2">
                        <p class="">By clicking Log In or Create Account,</p>
                        <p>I agree to Flytographer's Privacy Policy</p>
                    </div>
                    </div>
                    <!--Footer-->
                </div>
                <!--/.Panel 7-->

                <!--Panel 8-->
                <div class="tab-pane fade show" id="CreateAccountPanel" role="tabpanel">

                    <!--Body-->
                    <div class="modal-body">
                        <div class="md-form form-sm mb-5">
                            <label data-error="wrong" data-success="right" for="signup-username">Username</label>
                            <input type="text" id="signup-username" name="signup_username" class="form-control form-control-login-tab validate">
                        </div>
                        <div class="md-form form-sm mb-5">
                            <label data-error="wrong" data-success="right" for="signup-email">Email</label>
                            <input type="email" id="signup-email" name="signup-email" class="form-control form-control-login-tab validate">
                        </div>
                        <div class="md-form form-sm mb-4">
                            <label data-error="wrong" data-success="right" for="signup-password">Password</label>
                            <input type="password" id="signup-password" name="signup_password" class="form-control form-control-login-tab validate">
                        </div>
                        <div class="md-form form-sm mb-4">
                            <label data-error="wrong" data-success="right" for="signup-confirmpassword">Confirm Password</label>
                            <input type="password" id="signup-confirmpassword" name="signup_confirmpassword" class="form-control form-control-login-tab validate">
                        </div>
                        <div class="md-form form-sm mb-4">
                            <label data-error="wrong" data-success="right" for="signup-user_type">Type (Optional)</label>
                            <select name="signup_user_type" id="signup-user_type">
                                <option value="">Select Type</option>
                                <option value="">Select Type</option>
                                <option value="">Vide</option>
                                <option value="">Animator</option>
                            </select>
                        </div>
                        <div class="md-form form-sm mb-4 ml-4">
                            <input class="form-check-input" type="checkbox" value="" id="defaultCheckOne">
                            <label class="form-check-label" for="defaultCheckOne">
                                Show password?
                            </label>
                        </div>
                        <div class="text-center mt-2">
                            <button class="btn btn-info modal-login-button">Create Account</button>
                        </div>
                        <div class="text-center mt-2">
                            <p class="">OR</p>
                        </div>
                        <div class="text-center mt-2">
                            <button class="btn btn-info modal-login-button">Connect With Facebook</button>
                        </div>
                        <div class="text-center mt-2">
                            <p class="">By clicking Log In or Create Account,</p>
                            <p>I agree to Flytographer's Privacy Policy</p>
                        </div>
                    </div>
                    <!--Footer-->
                    <!-- <div class="modal-footer">
                        <div class="options text-right">
                            <p class="pt-1">Already have an account? <a href="#" class="blue-text">Log In</a></p>
                        </div>
                        <button type="button" class="btn btn-outline-info waves-effect ml-auto" data-dismiss="modal">Close</button>
                    </div> -->
                </div>
                <!--/.Panel 8-->
            </div>

        <!-- </div> -->
    </div>
    <!--/.Content-->
  </div>
</div>
<!--Modal: Login / Register Form-->
@endsection

