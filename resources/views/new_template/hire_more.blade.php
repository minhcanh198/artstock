@extends('new_template.layouts.app')
@section('content')
    <section class="hire-more-section">
        <div class="container">
            <div class="row mt-4 mb-5">
                <div class="col-12 text-center">
                    <h1>What type of photo shoot would you like to book?</h1>
                </div>
            </div>
            <div class="row pt-4">
                <div class="col-md-4 mb-5">
                    <div class="hire-more-box hire-more-active">
                        <div class="img">
                            <img loading="lazy" src="<?php echo url('/').'/img/vacation-1.svg' ?>" alt="" class="img-fluid">
                        </div>
                        <div class="txt">
                        <!-- <i class="fas fa-check"></i> -->
                            <p class="disc">
                                I want a photo shoot to capture my vacation
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-5">
                    <div class="hire-more-box hire-more-active">
                        <div class="img">
                            <img loading="lazy" src="<?php echo url('/').'/img/hometown-1.svg' ?>" alt="" class="img-fluid">
                        </div>
                        <div class="txt">
                        <!-- <i class="fas fa-check"></i> -->
                            <p class="disc">
                                I want a photo shoot to capture my vacation
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-5">
                    <div class="hire-more-box hire-more-active">
                        <div class="img">
                            <img loading="lazy" src="<?php echo url('/').'/img/proposal-1.svg' ?>" alt="" class="img-fluid">
                        </div>
                        <div class="txt">
                        <!-- <i class="fas fa-check"></i> -->
                            <p class="disc">
                                I want a photo shoot to capture my vacation
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-5 offset-md-2">
                    <div class="hire-more-box hire-more-active">
                        <div class="img">
                            <img loading="lazy" src="<?php echo url('/').'/img/coordinated-1.svg' ?>" alt="" class="img-fluid">
                        </div>
                        <div class="txt">
                        <!-- <i class="fas fa-check"></i> -->
                            <p class="disc">
                                I want a photo shoot to capture my vacation
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-5">
                    <div class="hire-more-box hire-more-active">
                        <div class="img">
                            <img loading="lazy" src="<?php echo url('/').'/img/commercial-1.svg' ?>" alt="" class="img-fluid">
                        </div>
                        <div class="txt">
                        <!-- <i class="fas fa-check"></i> -->
                            <p class="disc">
                                I want a photo shoot to capture my vacation
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-12 text-center">
                    <div class="popup-hire-more">
                        <button class="button btn btn-default btn-rounded my-3" data-toggle="modal" data-target="#myLoginModal">
                            Get Started
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- <div class="text-center"> -->
    <!-- <a href="" class="btn btn-default btn-rounded my-3" data-toggle="modal" data-target="#myLoginModal">Launch
        Modal LogIn/Register</a> -->
    <!-- </div> -->
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
                        <!-- <div class="md-form form-sm mb-4 ml-4">
                            <input class="form-check-input" type="checkbox" value="" id="defaultCheckTwo">
                            <label class="form-check-label" for="defaultCheckTwo">
                                Remember me for 30 days
                            </label>
                        </div> -->
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
                        <!-- <div class="modal-footer">
                        <div class="options text-center text-md-right mt-1">
                            <p>Not a member? <a href="#" class="blue-text">Sign Up</a></p>
                            <p>Forgot <a href="#" class="blue-text">Password?</a></p>
                        </div>
                        <button type="button" class="btn btn-outline-info waves-effect ml-auto" data-dismiss="modal">Close</button>
                        </div> -->

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
    @include('includes.javascript_general')
    <script>
        $(document).ready(function(){
            $('button[id^="modalLoginReg-"]').click(function(){
                console.log('clicked Modal buttons');
                var value = $(this).attr('id').split('-')[1];
                console.log(value);
                if(value == "createAccount"){
                    $("#modalLoginReg-"+value).removeClass('btn-login-register-unactive');
                    $("#modalLoginReg-"+value).addClass('btn-login-register-active');
                    $("#modalLoginReg-login").removeClass('btn-login-register-active');
                    $("#modalLoginReg-login").addClass('btn-login-register-unactive');
                    $("#LoginPanel").hide();
                    $("#CreateAccountPanel").show();
                }else{
                    $("#modalLoginReg-"+value).removeClass('btn-login-register-unactive');
                    $("#modalLoginReg-"+value).addClass('btn-login-register-active');
                    $("#modalLoginReg-createAccount").removeClass('btn-login-register-active');
                    $("#modalLoginReg-createAccount").addClass('btn-login-register-unactive');
                    $("#CreateAccountPanel").hide();
                    $("#LoginPanel").show();
                }
            });
        });
    </script>
@endsection

