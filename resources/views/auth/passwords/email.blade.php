@extends('app')

@section('title')
{{{ trans('auth.password_recover') }}} -
@stop

@section('content')

<div class="jumbotron md index-header jumbotron_set jumbotron-cover">
      <div class="container wrap-jumbotron position-relative">
        <h1 class="title-site title-sm">{{{ trans('auth.password_recover') }}}</h1>
        <p class="subtitle-site"><strong>{{{$settings->title}}}</strong></p>
      </div>
    </div>
    
<div class="container-fluid margin-bottom-40">
	<div class="row">
		<div class="col-md-12">
			
			<h2 class="text-center line position-relative">{{{ trans('auth.password_recover') }}}</h2>
	
	<div class="login-form">
		
		@if (session('status'))
						<div class="alert alert-danger">
							{{{ session('status') }}}
						</div>
					@endif

					<div class="alert alert-danger" style="display:none;" id="ErrorDiv">
							
						</div>
						<div class="alert alert-success" style="display:none;" id="SuccessDiv">
							
						</div>
		@include('errors.errors-forms')
	            	
          	<form action="{{{ url('/password/emails') }}}" method="post" name="form" id="signup_form">
            {{ csrf_field() }}
            <div class="form-group has-feedback">
            	
              <input type="text" class="form-control login-field custom-rounded" name="email" id="email" placeholder="{{{ trans('auth.email') }}}" title="{{{ trans('auth.email') }}}" autocomplete="off">
              <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
             </div>
         
           <!--<button type="submit" id="buttonSubmit" class="btn btn-block btn-lg btn-main custom-rounded">{{{ trans('auth.send') }}}</button>-->
           <button type="submit" id="buttonSubmist" class="btn btn-block btn-lg btn-main custom-rounded">{{{ trans('auth.send') }}}</button>
				<a href="{{{ url('login') }}}" class="text-center btn-block margin-top-10 back_btn"><i class="fa fa-long-arrow-left"></i> {{{ trans('auth.back') }}}</a>
          </form>
     </div><!-- Login Form -->
	
		</div><!-- col-md-12 -->
	</div><!-- row -->
</div><!-- container -->
@endsection

@section('javascript')
	<script src="{{ asset('public/plugins/iCheck/icheck.min.js') }}"></script>
	
	<script type="text/javascript">
	
	$('#email').focus();
	
	$('#email').keypress(function (e) {
		var key = e.which;
		if(key == 13)  // the enter key code
		{
			$("#buttonSubmist").click();
			return false;  
		}
	});  
	
	 $('#buttonSubmist').click(function(){
    	$(this).css('display','none');
    	$('.back_btn').css('display','none');
    // 	$('<div class="btn-block text-center"><i class="fa fa-cog fa-spin fa-3x fa-fw fa-loader"></i></div>').insertAfter('#signup_form');
        var emailAddress = $("#email").val();
        
        if(emailAddress == ""){
            $(this).css('display','block');
            $('.back_btn').css('display','block');
          console.log('email add ress is empty') ;
            $("div#ErrorDiv").html('Email is required');
            $("div#ErrorDiv").show();
            return false;
        }else if(checkEmail(emailAddress) == false){
           $(this).css('display','block');
           $('.back_btn').css('display','block');
           $("div#ErrorDiv").html('Email not exist');
           $("div#ErrorDiv").show();
           return false;
        }else{
            $("#SuccessDiv").html('Check your mail for reset password link');
            $("#SuccessDiv").show();
    	   // $('<div class="btn-block text-center"><i class="fa fa-cog fa-spin fa-3x fa-fw fa-loader"></i></div>').submit('#signup_form');
        }
    });
    
    // function checkEmail(email)
    // {
    //     const baseUrl = '<?php echo url("/") ?>';
    //     $.ajax({
    //         url: baseUrl + '/check-email-address/'+ email,
    //         type: 'get',
    //         dataType: 'json',
    //         success:function(res){
    //             console.log(res);
    //             if(res == false){
    //                 return false;
    //             }else{
    //                 return true;
    //             }
    //         },error:function(){
    //             console.log('error while check email address at forget password form');
    //         }
    //     });
    // }
    
    @if (count($errors) > 0)
    	scrollElement('#dangerAlert');
    @endif

</script>
@endsection
