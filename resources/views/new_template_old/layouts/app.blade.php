<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Title</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<link rel="icon" href="{{{ asset('public/new_template/images/favicon.png') }}}" />
<meta name="viewport" content="width=device-width, initial-scale=1.0,user-scalable=no">
<link rel="stylesheet" href="{{{ asset('public/new_template/css/bootstrap.min.css') }}}" />
<link rel="stylesheet" href="{{{ asset('public/new_template/css/font-awesome.css') }}}">
<link rel="stylesheet" href="{{{ asset('public/new_template/css/owl.carousel.min.css') }}}">
<link rel="stylesheet" href="{{{ asset('public/new_template/css/style.css') }}}" />
<link rel="stylesheet" href="{{{ asset('public/new_template/css/responsive.css') }}}" />
<link rel="stylesheet" href="{{{ asset('public/new_template/css/baguetteBox.min.css') }}}" />
<link rel="stylesheet" href="{{{ asset('public/new_template/css/aos.css') }}}" />
</head>
<body>
	<header>
		<div class="mobile-menu">
			<div class="circle" id="navbar"><i class="fa fa-bars" aria-hidden="true"></i></div>
			<div class="nveMenu text-left">
				<div>
					<img src="{{{ asset('public/new_template/images/logo.png') }}}" class="img-fluid">
				</div>
				<ul class="navlinks p-0 mt-4">
					<li><a href="#">Get In Touch</a></li>
					<li><a href="#">Blog</a></li>
					<li><a href="#">Case Studies</a></li>
					<li><a href="#">Gallery</a></li>
				</ul>
			</div>
			<div class="overlay"></div>
		</div>
	<div class="home-menu">
		<div class="col-md-12">
			<div class="row">
				<div class="col-md-4">
					<div class="logo"></div>
				</div>
				<div class="col-md-6">
				<div class="home">
					<ul>
						<li><a href="">Home</a></li>
						<li><a href="">Premium</a> </li>
						<li><a href="">Explore</a> </li>
						<li><a href="">Categories</a> </li>
						{{-- <li><a href="">About</a></li> --}}
						{{-- <li><a href="">Contact</a></li> --}}
					</ul>
</div>
</div>

		<div class="col-md-2">
			<div class="social-icons">
				<ul>
					<li><img src="{{{ asset('public/new_template/images/insta.png') }}}"></li>
					<li><img src="{{{ asset('public/new_template/images/fb.png') }}}"></li>
					<li><img src="{{{ asset('public/new_template/images/twitter.png') }}}"></li>
					<li><img src="{{{ asset('public/new_template/images/whats-app.png') }}}"></li>


				</ul>

			</div>

		</div>
			</div>
		</div>
	</div>
	</header>
    @yield('content')
	<footer>
        <div class="footer-new">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="logo">
                            <h1>LOGO</h1>
                            <p>
        Lorem ipsum dolor sit amet, consectetur 
        adipiscing elit. Nunc felis libero, 
        feugiat ac pulvinar in</p>
        <div class="social-icons">
                        <ul>
                            <li><a href="#"><img src="{{{ asset('public/new_template/images/insta.png') }}}"></a></li>
                            <li><a href="#"><img src="{{{ asset('public/new_template/images/fb.png') }}}"></a></li>
                            <li><a href="#"><img src="{{{ asset('public/new_template/images/twitter.png') }}}"></a></li>
                            <li><a href="#"><img src="{{{ asset('public/new_template/images/whats-app.png') }}}"></a></li>
        
        
                        </ul>
        
                    </div>
                        </div>
        
                    </div>
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-4">
                <div class="about">
                    <h1>About</h1>
                    <ul><li><a href="#">Team</a></li>
                    <li><a href="#">Join us</a></li>
                <li><a href="#">Ethic</a></li>
            <li><a href="#">Goals</a></li>
        </ul>
        
            </div></div>
            <div class="col-md-4">
                <div class="about">
                    <h1>About</h1>
                    <ul><li><a href="#">Team</a></li>
                    <li><a href="#">Join us</a></li>
                <li><a href="#">Ethic</a></li>
            <li><a href="#">Goals</a></li>
        </ul>
        
            </div></div>
            <div class="col-md-4">
                <div class="about">
                    <h1>About</h1>
                    <ul><li><a href="#">Team</a></li>
                    <li><a href="#">Join us</a></li>
                <li><a href="#">Ethic</a></li>
            <li><a href="#">Goals</a></li>
        </ul>
        
            </div></div>
        </div>
                </div>
            </div>
        </div>
        
        
            </footer>
        <div class="bootom-bar">
            <div class="container">
                <div class="row">
                    <div class="footer">
                        <h1>2020  All Rights Reserved</h1>
                    </div>
        
                </div>
            </div>
        </div>
        
        
        
        
        <script src="{{{ asset('public/new_template/js/jquery-3.3.1.min.js') }}}"></script>
        <script src="{{{ asset('public/new_template/js/popper-min.js') }}}"></script>
        <script src="{{{ asset('public/new_template/js/bootstrap.min.js') }}}"></script> 
        <script src="{{{ asset('public/new_template/js/owl.carousel.min.js') }}}"></script>
        <script src="{{{ asset('public/new_template/js/custom.js') }}}"></script> 
        <script src="{{{ asset('public/new_template/js/baguetteBox.min.js') }}}"></script>
        <script src="{{{ asset('public/new_template/js/aos.js') }}}"></script>
        <script>
          AOS.init();
            const baseUrl = "<?php echo url('/') ?>";
            // $(document).ready(function(){
                $('button[id^="buttonCategories|"]').click(function(){
                    var getAttrId = $(this).attr('id');
                    var CategorySlug = getAttrId.split('|')[1];
                    $("#inside-content-"+CategorySlug).empty();
                    $.ajax({
                        url: baseUrl+'/get-image-by-category/'+CategorySlug,
                        type: 'get',
                        beforeSend: function(){
                            // $("#loaderDiv").show();
                            var html ='<div class="col-md-4"></div>'+
                                    '<div class="col-md-4"><div id="loaderDiv">'+
                                        '<img src="{{{ asset('public/loader/loader.gif')}}}">'+
                                        '</div></div>'+
                                    '<div class="col-md-4"></div>';
                                    $("#inside-content-"+CategorySlug).html(html);
                        },
                        success: function(response){
                            
                            // console.log(response);
                            $("#inside-content-"+CategorySlug).html(response);
                        },
                        complete: function(){
                        // Statement
                        $("#loaderDiv").hide();
                        }
                    });
                });
            // });
        </script>
        </body>
        </html>
        