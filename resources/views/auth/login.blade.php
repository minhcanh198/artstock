<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>{{ trans('auth.login').' - ' }}@section('title')@show @if( isset( $settings->title ) ){{$settings->title}}@endif</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<link rel="shortcut icon" href="{{ asset('public/img/favicon.png') }}" />
<meta name="viewport" content="width=device-width, initial-scale=1.0,user-scalable=no">
<link rel="stylesheet" href="{{ asset('public/custom-css/css/bootstrap.min.css') }}" />
<link rel="stylesheet" href="{{ asset('public/custom-css/fontawesome/css/all.min.css') }}">
<link rel="stylesheet" href="{{ asset('public/custom-css/css/owl.carousel.min.css') }}">
<link rel="stylesheet" href="{{ asset('public/custom-css/slick/slick.css') }}">
<link rel="stylesheet" href="{{ asset('public/custom-css/slick/slick-theme.css') }}">
<link rel="stylesheet" href="{{ asset('public/custom-css/css/style.css') }}" />
<link rel="stylesheet" href="{{ asset('public/custom-css/css/responsive.css') }}" />
<link rel="stylesheet" href="{{ asset('public/custom-css/css/baguetteBox.min.css') }}" />
<link rel="stylesheet" href="{{ asset('public/custom-css/css/aos.css') }}"/>
@section('css')
  <link href="{{ asset('public/plugins/iCheck/all.css')}}" rel="stylesheet" type="text/css" />
  @endsection

</head>

<body>
<section class="login-section">
	<div class="container">
		<div class="row">
			<div class="col-md-10 offset-md-1">
				<div class="login-logo text-center">
					<a href="{{ url('/') }}"><img src="{{ asset('public/custom-css/images/logo-footer.png') }}" alt="" class="img-fluid"></a>
				</div>
				<h1 class="login-title text-center mt-4">Welcome To Art Stock</h1>
				
	
				@if( $settings->facebook_login == 'on' )
					<div class="text-center mt-4  joinfb facebook-login auth-social d-flex justify-content-center" id="twitter-btn">
						<a href="{{url('oauth/facebook')}}" class="btn btn-block btn-lg facebook custom-rounded btn-joinfb"><i class="fab fa-facebook-f"></i> Facebook</a>
					</div>
				@endif
	
			  	@if( $settings->twitter_login == 'on')
					<div class="col-12 text-center mt-4 joinfb facebook-login auth-social d-flex justify-content-center" id="twitter-btn">
						<a href="{{url('oauth/twitter')}}" class="btn btn-block btn-lg twitter custom-rounded btn-jointwitter"><i class="fab fa-twitter"></i> Twitter</a>
					</div>
				@endif
				{{-- <div class="text-center mt-4 joinfb">
					<button type="" class="btn-joinfb"><i class="fab fa-facebook-f"></i>Join With Facebook</button>
				</div>
				<div class="text-center mt-4 joinapple">
					<button type="" class="btn-joinapple"><i class="fab fa-apple"></i>Join With Apple</button>
				</div>
				<p class="text-center or-txt mt-3">or</p>
				</div> --}}
				@if( $settings->facebook_login == 'on' || $settings->twitter_login == 'on' )
					<div class="text-center mt-4 joinfb">
						<p class="text-center or-txt mt-3">or</p>
						{{-- <span class="login-link auth-social" id="twitter-btn-text">{{ trans('auth.or_sign_in_with') }}</span> --}}
					</div>
				@endif
			</div>
		</div>
		<div class="row">
			<div class="col-12 col-md-6 offset-md-3">

				@include('errors.errors-forms')

				@if (session('login_required'))
					<div class="alert alert-danger" id="dangerAlert">
						<i class="glyphicon glyphicon-alert myicon-right"></i> {{ session('login_required') }}
					</div>
            	@endif
				<form action="{{ url('login') }}" method="post" name="form" id="signup_form">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<input type="hidden" name="_url" value="{{ url()->previous() }}">
					  
					@if($settings->captcha == 'on')
						@captcha
					@endif
				  <div class="row mt-4">
				   
				    <div class="mb-3 col-12">
						{{-- <div class="form-group has-feedback"> --}}
						<input type="text" class="form-control login-field custom-rounded" value="{{ old('email') }}" name="email" id="email" placeholder="{{ trans('auth.username_or_email') }}" title="{{ trans('auth.username_or_email') }}" autocomplete="off">
						{{-- <span class="glyphicon glyphicon-user form-control-feedback"></span>
						</div> --}}
				    </div>
				    <div class="mb-3 col-12">
						{{-- <div class="form-group has-feedback"> --}}
						<input type="password" class="form-control login-field custom-rounded" name="password" id="password" placeholder="{{ trans('auth.password') }}" title="{{ trans('auth.password') }}" autocomplete="off">
						{{-- <span class="glyphicon glyphicon-user form-control-feedback"></span>
						</div> --}}
				    </div>
				    <div class="col-12">
						{{-- <button type="submit" class="btn-signup">Log In</button> --}}
						<button type="submit" id="buttonSubmit" class="btn btn-signup btn-block btn-lg btn-main custom-rounded">{{ trans('auth.sign_in') }}</button>
				    </div>
				    <div class="col-6">
						<a href="{{ url('/').'/forget_password' }}">Forgot Password ?</a>
					</div>
				  </div>
				</form>
				<!-- <p class="mt-3">By joining, you agree to our <strong>Terms of Service</strong> and <strong>Privacy Policy</strong></p> -->
			</div>
		</div>
				</div>
</section>
<script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js"></script>
<script src="{{ asset('public/custom-css/js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('public/custom-css/js/popper-min.js') }}"></script>
<script src="{{ asset('public/custom-css/js/bootstrap.min.js') }}"></script> 
<script src="{{ asset('public/custom-css/slick/slick.min.js') }}"></script>
<!-- <script src="audiojs/audio.min.js"></script> -->
<script src="{{ asset('public/custom-css/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('public/custom-css/js/custom.js') }}"></script> 
<script src="{{ asset('public/custom-css/js/baguetteBox.min.js') }}"></script>
<script src="{{ asset('public/custom-css/js/aos.js') }}"></script>
<script>
  AOS.init();
</script>
</body>
</html>



