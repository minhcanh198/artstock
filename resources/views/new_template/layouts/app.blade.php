<?php

$userAuth = Auth::user();

if (Auth::check()) {

    // Notifications
    $notifications_count = App\Models\Notifications::where('destination', Auth::user()->id)->where('status', '0')->count();

    if ($notifications_count != 0) {
        $totalNotifications = '(' . ($notifications_count) . ') ';
        $totalNotify = ($notifications_count);
    } else {
        $totalNotifications = null;
        $totalNotify = null;
    }
} else {
    $totalNotifications = null;
    $totalNotify = null;
}

?>
    <!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="@yield('description_custom'){{ $settings->description }}">
    <meta name="keywords" content="@yield('keywords_custom'){{ $settings->keywords }}"/>
    <link rel="shortcut icon" href="{{ asset('img/favicon.png') }}"/>
    {{--		<meta http-equiv="X-UA-Compatible" content="IE=edge">--}}
    <meta name="viewport" content="width=device-width, initial-scale=1.0,user-scalable=no">
    <meta name="api-base-url" content="{{ url('/') }}"/>
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <title>{{$totalNotifications}}@section('title')@show @if( isset( $settings->title ) ){{$settings->title}}@endif</title>

    <!--<link rel="stylesheet" href="https://netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" />-->
    @yield('css')
    <link rel="stylesheet" href="{{ asset('custom-css/css/bootstrap.min.css') }}"/>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet"/>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@300;400;500;600;700&display=swap"
          rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/croppie.css')}}">
<!--<script src="{{ asset('js/custom_cropzee.js')}}" defer></script>-->

    <link rel="stylesheet" href="{{ asset('custom-css/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('custom-css/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('custom-css/slick/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('custom-css/slick/slick-theme.css') }}">
    <link rel="stylesheet" href="{{ asset('custom-css/css/style.css') }}"/>
    <link rel="stylesheet" href="{{ asset('custom-css/css/simple-calendar.css') }}">
    <link rel="stylesheet" href="{{ asset('custom-css/css/simple-calendar2.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}"/>
    <link rel="stylesheet" href="{{ asset('custom-css/css/responsive.css') }}"/>
    <link rel="stylesheet" href="{{ asset('custom-css/css/baguetteBox.min.css') }}"/>
<!-- <link rel="stylesheet" href="{{ asset('custom-css/css/aos.css') }}"/> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css"/>

    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" /> -->
    <!-- stroke icons CSS -->
    <link href="{{ asset('css/strokeicons.css') }}" rel="stylesheet">
    <link href="{{ asset('plugins/fleximages/jquery.flex-images.css') }}" rel="stylesheet">
<!-- <link href="{{ asset('bootstrap/css/bootstrap.css')}}" rel="stylesheet" type="text/css" /> -->
    <!-- IcoMoon CSS -->
<!-- <link href="{{ asset('css/icomoon.css') }}" rel="stylesheet"> -->
    <!-- FONT Awesome CSS -->
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">

    <!-- Sweet Alert -->
    <link href="{{ asset('plugins/sweetalert/sweetalert.css')}}" rel="stylesheet" type="text/css"/>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet"/>
    <link href="{{ asset('emojionearea-master/dist/emojionearea.min.css') }}" rel="stylesheet" type="text/css">

    <style>


        .new-music-box > a {
            color: #ef595f;
            margin-right: 10px;
            transition: 0.5s;
        }

        .new-music-box > a:hover {
            text-decoration: underline;
        }

        .new-music-box p a {
            color: #888;
        }

        .new-music-box h3 a {
            color: #000;
            transition: 0.5s;
        }

        .new-music-box h3 a:hover {
            color: #ef595f;
        }

        .new-music-box p {
            margin: 4px 0 10px;
        }

        .btn-music-play {
            color: #ef595f;
            border: 1px solid #ef595f;
            padding: 10px 14px;
            transition: 0.5s;
            /* position: absolute;*/
            /*left: -50px;*/
            /*top: 30%; */
        }

        .btn-music-play:hover {
            border-color: #000;
            color: #000;
        }

        .buttons-music-box a {
            font-size: 20px;
            color: #000;
            transition: 0.5s;
            margin-right: 10px;
        }

        .buttons-music-box a:hover {
            color: #ef595f;
        }

        .dzsap-sticktobottom.dzsap-sticktobottom-for-skin-wave {
            bottom: 0;
            opacity: 1;

        }

        .main-search-bar .btn.btn-secondary {
            font-size: 14px;
        }

        .add-font {
            font-size: 14px;
            margin-left: 6px;
            font-family: 'Lato', sans-serif;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        #messageMainModal .modal-dialog {
            max-width: 600px;
        }

        #messageMainModal2 .modal-dialog {
            max-width: 600px;
        }

        .chat-icon-notification {
            background-color: #ef595f !important;
            border-radius: 50%;
            padding: 2px 7px;
            display: flex;
            justify-content: center;
            align-items: center;
            width: 20px;
            height: 20px;
            font-size: 11px;
            position: absolute;
            top: 18px;
            color: #fff !important;
        }

        /* .chat-icon-notification:hover {
				background-color: #000;
				color: #fff;
			} */

        .modal-backdrop {
            background-color: #0000006b;
        }

        img.img-responsive {
            max-width: 100%;
            height: auto;
        }

        #messageMainModal ::-webkit-scrollbar-thumb {
            background: #ef595f;
        }

        #messageMainModal ::-webkit-scrollbar-track {
            background: transparent;
            /* border-radius: 0; */
        }

        #messageMainModal h5#messageMainModalLabel {
            color: #2c2c2c;
            font-size: 24px;
            font-weight: bold;
            line-height: normal;
            margin: 0;
            flex: 1 1 auto;
            font-family: 'Libre Franklin', sans-serif;
            letter-spacing: -0.3px;
        }

        #messageMainModal .close-this-modal, #messageMainModal2 .close-this-modal {
            /* margin-left: 12px; */
            border-radius: 50%;
            width: 36px;
            height: 36px;
            background-color: rgba(0, 0, 0, .05);
            opacity: 1;
            border: 0;
        }

        #messageMainModal .close-this-modal span, #messageMainModal2 .close-this-modal span {
            color: #1c1e21;
            font-size: 24px;
        }

        #messageMainModal2 .modal-header {
            border-bottom: 0;
        }

        .d-flex-custom {
            display: flex;
        }

        .search_input {
            position: relative;
            margin-top: 18px;
        }

        .search_input i.fa-search {
            position: absolute;
            top: 11px;
            left: 16px;
            font-size: 18px;
        }

        .search_input .form-control {
            height: 40px;
            padding: 6px 44px;
            border-radius: 28px !important;
        }

        .conversation-box-modal p {
            background-color: #ef595f;
            color: #fff;
            padding: 6px 34px;
            border-radius: 30px;
        }

        .justify-content-center-custom {
            justify-content: center;
        }

        .conversation-persons-modal {
            background-color: transparent;
            border-radius: 30px;
            cursor: pointer;
            padding-top: 10px;
            padding-bottom: 10px;
        }

        .conversation-persons-modal:hover {
            background-color: #f4f4f4;
        }

        .emojionearea .emojionearea-button {
            left: 3px;
        }

        .emojionearea.emojionearea-inline > .emojionearea-editor {
            padding: 6px 14px;
        }

        .emojionearea .emojionearea-picker.emojionearea-picker-position-bottom {
            left: 0px;

        }

        .chat-main-area {
            height: 300px;
            display: flex;
            flex-direction: column-reverse;
            overflow-y: auto;
            overflow-x: hidden;
        }

        .image-upload > input {
            display: none;
        }

        .image-upload {
            position: relative;
        }

        .image-upload i {
            position: absolute;
            top: -24px;
            right: 8px;
        }

        .progress {
            background-color: transparent;
            position: absolute;
            left: 0;
            right: 0;
            top: 0;
            bottom: 0;
        }

        .modal-footer {
            border-top-color: #f4f4f4;
            position: relative;
        }

        .progress-bar {
            float: left;
            width: 0;
            height: 20%;
            font-size: 12px;
            line-height: 20px;
            color: #fff;
            text-align: center;
            background-color: #ef595f;
            -webkit-box-shadow: inset 0 -1px 0 rgba(0, 0, 0, .15);
            box-shadow: inset 0 -1px 0 rgba(0, 0, 0, .15);
            -webkit-transition: width .6s ease;
            -o-transition: width .6s ease;
            transition: width .6s ease;
        }

        button.enter-chat {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 34px;
            height: 34px;
            border-radius: 50%;
            border: 0;
        }

        .emojionearea.emojionearea-inline {
            height: 34px;
            border-radius: 30px;
        }

        .loader {
            width: 100%;
            /* margin: 150px auto 70px;  */
            position: relative;
        }

        .loader .loading_1 {
            position: relative;
            width: 100%;
            height: 10px;
            /* border: 1px solid yellowgreen;  */
            border-radius: 10px;
            animation: turn 4s linear 1.75s infinite;
        }

        .loader .loading_1:before {
            content: "";
            display: block;
            position: absolute;
            width: 0;
            height: 2px;
            background-color: #ef595f;
            /* box-shadow: 10px 0px 15px 0px yellowgreen; */
            animation: load 3s linear infinite;
        }

        .loader .loading_2 {
            position: absolute;
            width: 100%;
            top: 10px;
            color: green;
            font-size: 22px;
            text-align: center;
            animation: bounce 3s linear infinite;
        }

        @keyframes load {
            0% {
                width: 0%;
            }

            87.5% {
                width: 100%;
            }
        }

        .download-btn {
            position: absolute;
            width: 89%;
            z-index: 999;
            top: 0;
            background: #00000061;
            height: 95%;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #fff;
            opacity: 0;
            transition: 0.4s;
            border-radius: 14px;
        }

        .hover-show-download {
            /* width: 50%;  */
        }

        .hover-show-download:hover .download-btn {
            opacity: 1;
        }

        .chat-checkbox, .radio {
            margin-top: 28px;
            margin-bottom: 0;
            cursor: pointer;
        }

        .btn-delete {
            background-color: #ef595f;
            color: #fff;
            border-radius: 30px;
            border: 0;
            text-transform: capitalize;
            padding: 3px 14px;
        }

        .btn-cencel {
            background-color: #000;
            color: #fff;
            border-radius: 30px;
            border: 0;
            text-transform: capitalize;
            padding: 3px 14px;
        }

        .chat-col-md-1 {
            width: 8.33333333%;
            transition: .5s;
        }

        .chat-col-md-3 {
            width: 25%;
            transition: .5s;
        }

        .chat-col-md-9 {
            width: 75%;
            transition: .5s
        }

        .chat-col-md-11 {
            width: 91.66666667%;
            transition: .5s;
        }


        a:hover {
            text-decoration: none;
        }


        .dropbtn-one-one {
            background-color: #3498DB;
            color: #fff;
            padding: 7px 25px;
            font-size: 16px;
            border: none;
            cursor: pointer;
            background: #ef595f;
            font-weight: 700;
            border-radius: 4px;
            transition: 0.5s;
        }

        .dropbtn-one-one:hover, .dropbtn-one-one:focus {
            background-color: #ef595f;
        }

        .dropdown-one-one {
            position: relative;
            display: inline-block;
            margin: 22px 0;
            font-weight: 700;
            float: right;
        }

        .dropdown-content-one-one {
            display: none;
            position: absolute;
            background-color: #f1f1f1;
            min-width: 124px;
            overflow: auto;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 1;
            left: -22px;
            top: 39px;
        }

        .dropdown-content-one-one a {
            padding: 10px 0 10px 10px;
            text-decoration: none;
            display: block;
            background: #fff;
            color: #000;
            transition: 0.5s;
            font-size: 14px;

        }

        .dropdown-content-one-one a:hover {
            color: #f54336;
        }

        .show-one-one {
            display: block;
        }
    </style>
    <script>
        window.auth_user = {!! json_encode(Auth::user());  !!};
    </script>
    <script></script>

</head>

<body>
<div id="app">
    <div class="popout font-default"></div>
    <header>
        <div class="mobile-menu">
            <div class="container">
                <div class="row">
                    <div class="col-6">
                        <a href="{{ url('/') }}"> <img loading="lazy" src="{{ asset('img/logo.svg') }}"
                                                       class="img-fluid"></a>
                    </div>
                    <div class="col-6 align-self-center text-right">
                        <div class="circle" id="navbar">
                            <i class="fa fa-bars" aria-hidden="true"></i>
                        </div>
                        <div class="nveMenu text-left overflow-auto">
                            <ul class="navlinks p-0 mt-4">
                                <div class="mobile-cross close-btn-nav" id="navbar"><i class="fas fa-times"
                                                                                       aria-hidden="true"></i></div>
                                <li><a href="{{ url('/') }}">Home</a></li>
                                <li>
                                    <a href="javascript:void(0);">Categories</a>

                                    <h3>By Profession</h3>
                                    <ul class="mobile-nav-cate-ul">
                                        @foreach(  App\Models\Types::where('mode','on')->orderBy('type_name')->get() as $type )
                                            <li>
                                                <a href="{{ url('category') }}/artist-{{ $type->type_name }}">{{ $type->type_name }}</a>
                                            </li>
                                        @endforeach

                                    </ul>
                                    <h3>By Industry </h3>
                                    <ul class="mobile-nav-cate-ul">
                                        @foreach(  App\Models\Categories::where('mode','on')->where('link_with' , '!=', '0')->where('parent_id','=','0')->orderBy('name')->take(9)->get() as $category )
                                            @if($category->name != "Uncategorized")
                                                <li>
                                                    <a href="{{ url('category') }}/{{ $category->slug }}">{{ $category->name }}</a>
                                                </li>
                                            @endif
                                        @endforeach

                                    </ul>
                                </li>

                                <li><a href="{{ url('/destinations') }}">Locations</a></li>
                                <li><a href="{{ url('/license') }}">License</a></li>
                                <li><a href="{{ url('/about')}}">About</a></li>
                            </ul>

                            @if(!Auth::check())
                                <ul class="mt-3">
                                    <li class="mb-3">
                                        <a href="{{ url('register') }}" class="btn btn-h-mobile">JOIN</a>
                                    </li>
                                    <li>
                                        <a href="{{ url('login') }}" class="btn btn-h-two-mobile mr-2">LOGIN</a>
                                    </li>
                                </ul>
                            @else
                                <div class="mobile-nav-cate-ul"></div>
                                <div id="stream-chat">
                                    <chat-panel
                                        :user="{{ (Auth::user() != null) ? Auth::user() : '' }}">
                                    </chat-panel>
                                </div>
                            @endif
                        </div>
                        <div class="overlay"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="home-menu">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-2">
                        <div class="logo">
                            <a href="{{ url('/') }}"><img loading="lazy" src="{{ asset('img/logo.svg') }}"
                                                          style="width: 200px;"></a>
                        </div>
                    </div>
                    <div class="col-md-6 d-flex justify-content-center m-auto">
                        <div class="home">
                            <ul>
                                <li><a href="{{ url('/') }}">Home</a></li>
                                <li class="dropdown new new2 dropdown-one-header ">
                                    <a href="javascript:void(0);" data-toggle="dropdown" class=" " style="    color: #fff;
											letter-spacing: 2px;
											text-transform: uppercase;
											font-weight: 700;
											font-size: 14px;">
                                        Categories
                                    </a>
                                    <!-- DROPDOWN MENU -->
                                    <ul class="dropdown-menu new-drop dd-close arrow-up nav-session" dir="RTL"
                                        role="menu" aria-labelledby="dropdownMenu4">
                                        <div class="row">

                                            <div class="col-6">
                                                <h2 class="dropdown-heading-catogaries mb-2">By Profession</h2>
                                                @foreach(  App\Models\Types::where('mode','on')->orderBy('type_name')->get() as $type )
                                                    <li class="pb-2"><a
                                                            href="{{ url('category') }}/artist-{{ $type->type_name }}">{{ $type->type_name }}</a>
                                                    </li>
                                                @endforeach
                                            </div>
                                            <div class="col-6">
                                                <h2 class="dropdown-heading-catogaries mb-2">By Industry</h2>
                                                @foreach(  App\Models\Categories::where('mode','on')->where('link_with' , '!=', '0')->where('parent_id','=','0')->orderBy('name')->take(9)->get() as $category )
                                                    @if($category->name != "Uncategorized")
                                                        <li class="pb-2"><a
                                                                href="{{ url('category') }}/{{ $category->slug }}">{{ $category->name }}</a>
                                                        </li>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    </ul><!-- DROPDOWN MENU -->
                                </li>
                                {{-- <!-- <li><a href="{{ url('/destinations') }}">Destinations</a></li> --> --}}
                                <li><a href="{{ url('/destinations') }}">Locations</a></li>
                                <li><a href="{{ url('/license') }}">License</a></li>
                                <li><a href="{{ url('/about')}}">About</a></li>
                                <li><a href="{{ url('/use-guide')}}">User Guide</a></li>
                                <!-- <li class="dropdown new dropdown-one-header" style="    margin-top: 5px;">  -->
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-3 m-auto">
                        <div class="d-flex justify-content-end align-items-center">
                            @if( Auth::check())
                                <li class="dropdown">
                                    <div class="dropdown-toggle"
                                         id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                         aria-expanded="false">
                                        <i class="fab fa-facebook-messenger fa-2x text-white"></i>
                                    </div>
                                    <div class="dropdown-menu chat-panel" aria-labelledby="dropdownMenuButton">
                                        <div id="stream-chat">
                                            <chat-panel
                                                :user="{{ (Auth::user() != null) ? Auth::user() : '' }}">
                                            </chat-panel>
                                        </div>
                                    </div>
                                </li>
                                <li class="dropdown new mx-4">
                                    <a href="javascript:void(0);" data-toggle="dropdown"
                                       class="userAvatar myprofile dropdown-toggle font-default text-uppercase">
                                        <img loading="lazy" src="{{ asset('avatar').'/'.$userAuth->avatar }}" alt="User"
                                             class="img-circle avatarUser" width="25" height="25">
                                        <span class="title-dropdown">My Profile</span>
                                        <i class="ion-chevron-down margin-lft5"></i>
                                    </a>

                                    <!-- DROPDOWN MENU -->
                                    <ul class="dropdown-menu new-drop dd-close arrow-up nav-session" role="menu"
                                        aria-labelledby="dropdownMenu4">

                                        @if( $userAuth->role == 'admin' )
                                            <li>
                                                <a href="{{ url('panel/admin') }}" class="text-overflow">
                                                    <i class="icon icon-Speedometter myicon-right"></i> Panel Admin</a>
                                            </li>
                                            <li role="separator" class="divider"></li>
                                        @endif
                                        @if($settings->sell_option == 'on')
                                            <li>
													<span class="balance text-overflow">
														<i class="fa fa-dollar myicon-right"></i> Balance <strong>{{\App\Helper::amountFormatDecimal(Auth::user()->balance)}}</strong>
													</span>
                                            </li>

                                            <li>
													<span class="balance text-overflow">
														<i class="icon icon-Dollars myicon-right"></i> Funds <strong>{{\App\Helper::amountFormatDecimal(Auth::user()->funds)}}</strong>
													</span>
                                            </li>

                                            <li role="separator" class="divider"></li>

                                            <li>
                                                <a href="{{ url('user/dashboard') }}" class="text-overflow">
                                                    <i class="icon icon-Speedometter myicon-right"></i> {{ trans('admin.dashboard') }}
                                                </a>
                                            </li>

                                            <li>
                                                <a href="{{ url('user/dashboard/add/funds') }}" class="text-overflow">
                                                    <i class="icon icon-Dollars myicon-right"></i>{{ trans('misc.add_funds') }}
                                                </a>
                                            </li>

                                            <li>
                                                <a href="{{ url('user/dashboard/withdrawals') }}" class="text-overflow">
                                                    <i class="icon icon-Bag myicon-right"></i> {{ trans('misc.withdraw_balance') }}
                                                </a>
                                            </li>

                                            <li role="separator" class="divider"></li>
                                        @endif
                                        <li>
                                            <a href="{{ url($userAuth->username) }}" class="myprofile text-overflow">
                                                <i class="icon icon-User myicon-right"></i> {{ trans('users.my_profile') }}
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ url($userAuth->username,'collections') }}">
                                                <i class="fa fa-folder-open-o myicon-right"></i> {{ trans('misc.collections') }}
                                            </a>
                                        </li>

                                        <li>
                                            <a href="{{ url('likes') }}" class="text-overflow">
                                                <i class="icon icon-Heart myicon-right"></i> {{ trans('users.likes') }}
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ url('account') }}" class="text-overflow">
                                                <i class="icon icon-Settings myicon-right"></i> {{ trans('users.account_settings') }}
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ url('logout') }}" class="logout text-overflow">
                                                <i class="icon icon-Exit myicon-right"></i> {{ trans('users.logout') }}
                                            </a>
                                        </li>
                                    </ul><!-- DROPDOWN MENU -->
                                </li>


                                @if(\Request::segment(1) != "destinations")

                                    @if( Auth::user()->authorized_to_upload == 'yes' )
                                    <!-- <a href="{{ url('upload') }}" class="btn btn-h-two mr-2">UPLOAD</a> -->
                                        <div class="dropdown-one-one">
                                            <button onclick="myFunction()" class="dropbtn-one-one">
                                                <i class="fa fa-upload"></i>
                                            </button>
                                            <div id="myDropdown-one-one" class="dropdown-content-one-one">
                                                <a href="{{ url('upload/image') }}">Image Upload</a>
                                                <a href="{{ url('upload/video') }}">Video Upload</a>
                                                <a href="{{ url('upload/audio') }}">Audio Upload</a>
                                            </div>
                                        </div>
                                    @endif
                                @else
                                    @if( Auth::user()->authorized_to_upload == 'yes' )
                                    <!-- <a href="{{ url('upload') }}" class="btn btn-h-two mr-2">UPLOAD</a> -->
                                        <div class="dropdown-one-one" style="opacity:0">
                                            <button onclick="myFunction()" class="dropbtn-one-one"
                                                    style="padding: 12px 20px 12px 20px;"><i class="fa fa-upload"></i>
                                                Upload
                                            </button>
                                            <div id="myDropdown-one-one" class="dropdown-content-one-one">
                                                <a href="{{ url('upload/image') }}">Image Upload</a>
                                                <a href="{{ url('upload/video') }}">Video Upload</a>
                                                <a href="{{ url('upload/audio') }}">Audio Upload</a>
                                            </div>
                                        </div>
                                    @endif
                                @endif
                            @else
                                @if( $settings->registration_active == '1' )
                                    <a href="{{ url('register') }}" class="btn btn-h">JOIN</a>
                                @endif
                                <a href="{{ url('login') }}" class="btn btn-h-two mx-3">LOGIN</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!--Modal All chat messenger -->
    <div class="modal" id="messageMainModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content" style="height: 470px;overflow: scroll;overflow-x: hidden;">
                <div class="modal-header" style="display: block;">
                    <div class="d-flex-custom">
                        <div class="">
                            <h5 class="modal-title" id="messageMainModalLabel">Messenger</h5>
                        </div>
                        <div class="" style="margin-left: auto; margin-right: 10px;">
                        <!-- <div class="dropdown">
                  <button class="dropdown-toggle" type="button" data-toggle="dropdown" style="background-color: transparent; border: 0;     background-color: transparent; border: 0; border-radius: 50%; width: 36px; height: 36px; background-color: rgba(0, 0, 0, .05);
                  opacity: 1; border: 0; display: flex; justify-content: center; align-items: center;"><img loading="lazy" src="{{ url('/')}}/img/icons8-menu-vertical-30.png" alt="">
                  <span class="caret"></span></button>
                  <ul class="dropdown-menu dropdown-modal-messenger">
                    <li><a href="#">HTML</a></li>
                    <li><a href="#">CSS</a></li>
                    <li><a href="#">JavaScript</a></li>
                  </ul>
                </div> -->
                        </div>
                        <div>
                            <button type="button" class="close-this-modal" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                    <div class="search-bar-messenger-header">
                        <div class="m_search">
                            <div class="search_input">
                                <input type="search" class="form-control" id="chat_search" name="search"
                                       placeholder="Search for conversations">
                                <i class="fa fa-search" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="d-flex-custom conversation-box-modal justify-content-center-custom">
                        <div class="mb-3">
                            <p id="pConversations">All Conversations</p>
                        </div>
                    </div>
                    <div id="chatListDiv">
                        <!-- <a href="" type="button" class="" data-toggle="modal" data-target="#messageMainModal2"  style="display: block; color: #000;">
                <div class="row conversation-persons-modal" style="margin-bottom: 14px;">
                  <div class="col-md-2" style="padding-left: 0; padding-right: 0; text-align: center;">
                    <img loading="lazy" src="../img/dummy-avatar.jpg" alt="" style="width: 60px; border-radius: 50%; height: 60px; margin: 0 auto;">
                  </div>
                  <div class="col-md-8" style="padding-left: 0; padding-right: 0;">
                      <p>User Name</p>
                      <p>Lorem ipsum dolor sit amet consectetur...</p>
                  </div>
                  <div class="col-md-3" style="margin-top: 17px;">
                    <span>4</span> hour ago
                  </div>
                </div>
              </a> -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--Modal single chat  -->
    <div class="modal" id="messageMainModal2" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header" style="display: block;">
                    <div class="d-flex-custom">
                        <input type="text" id="textChatId" name="textChatId" hidden>
                        <input type="text" id="textUserId" name="textUserId" hidden>
                        <input type="text" id="textCurrentUserId" name="textCurrentUserId" hidden>

                        <div class="" id="messageMainModal2DivUserNameHeading">

                        </div>
                        <div class="" style="margin-left: auto; margin-right: 10px;">
                        <!-- <div class="dropdown">
                  <button class="dropdown-toggle" type="button" data-toggle="dropdown" style="background-color: transparent; border: 0;     background-color: transparent; border: 0; border-radius: 50%; width: 36px; height: 36px; background-color: rgba(0, 0, 0, .05);
                  opacity: 1; border: 0; display: flex; justify-content: center; align-items: center;"><img loading="lazy" src="{{ url('/') }}/img/icons8-menu-vertical-30.png" alt="">

                  <ul class="dropdown-menu dropdown-modal-messenger">
                    <li><a href="#">HTML</a></li>
                    <li><a href="#">CSS</a></li>
                    <li><a href="#">JavaScript</a></li>
                  </ul>
                </div> -->
                        </div>
                        <div>
                            <button type="button" class="close-this-modal" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="chat-main-area">
                        <div class="row" id="singleChatUserDiv">


                        </div>
                    </div>
                </div>
                <div class="modal-footer" style="text-align: left; position: relative; padding: 0;">
                    <div class="" id="msgSendLoader"
                         style="position: absolute; width:95%; top: 0; left: 0; display:none;">
                        <div class="loader">
                            <div class="loading_1"></div>
                            <!-- <div class="loading_2">Loading GfG...</div>  -->
                        </div>
                    </div>
                </div>
                <div class="error-chat" id="errorChat" style="display:none">
                    <p id="errorChatP" style="color: #ef595f; font-weight:900;">Something went wrong</p>
                </div>

                <div class="row" style="margin-top: 20px;">
                    <div class="col-md-1"></div>

                    <div class="col-md-9" style="padding-left: 0;padding-right: 0;">
                        <div class="span6">
                            <input type="text" id="emojionearea4" name="textboc" value=""/>
                        </div>
                        <div class="image-upload">
                            <label for="file-input">
                                <i class="fa fa-file-image-o" aria-hidden="true"></i>
                            </label>
                            <input id="file-input" name="chat_file-input" type="file"/>
                        </div>
                    </div>

                    <div class="col-md-1" style="">
                        <button id="sendMsgChat" class="enter-chat"><img loading="lazy"
                                                                         src="{{ url('/') }}/img/email.png" alt=""
                                                                         class="img-responsive" style="width: 17px;">
                        </button>
                    </div>
                    <div class="col-md-1"></div>
                </div>
            </div>
        </div>
    </div>
    <chat-box v-if="$store.state.showChatBox"></chat-box>
    @yield('content')
</div>


<footer>
    <div class="footer-new">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="logo">
                        <img loading="lazy" src="{{ asset('img/footer_logo.png') }}" alt="" class="img-fluid">
                        <p class="mt-4">{{ $settings->description }}</p>
                        <div class="social-icons">
                            <ul>
                                @php
                                    $socialMedia = App\Models\AdminSettings::select('twitter', 'facebook', 'linkedin', 'instagram', 'youtube', 'pinterest')->get();
                                @endphp
                                @if($socialMedia[0]->twitter != "")
                                    <li><a href="{{ $socialMedia[0]->twitter }}"><i class="fab fa-twitter"></i></a></li>
                                @endif
                                @if($socialMedia[0]->instagram != "")
                                    <li><a href="{{ $socialMedia[0]->instagram }}"><i class="fab fa-instagram"></i></a>
                                    </li>
                                @endif
                                @if($socialMedia[0]->facebook != "")
                                    <li><a href="{{ $socialMedia[0]->facebook }}"><i class="fab fa-facebook"></i></a>
                                    </li>
                                @endif
                                @if($socialMedia[0]->pinterest != "")
                                    <li><a href="{{ $socialMedia[0]->pinterest }}"><i class="fab fa-pinterest"></i></a>
                                    </li>
                                @endif
                                @if($socialMedia[0]->youtube != "")
                                    <li><a href="{{ $socialMedia[0]->youtube }}"><i class="fab fa-youtube"></i></a></li>
                                @endif
                                @if($socialMedia[0]->linkedin != "")
                                    <li><a href="{{ $socialMedia[0]->linkedin }}"><i class="fab fa-linkedin"></i></a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <!--<div class="col-md-4"></div>-->
                        <div class="col-md-6">
                            <div class="about">
                                <h1>Categories</h1>
                                <ul>
                                    @foreach(  App\Models\Categories::where('mode','on')->orderBy('name')->where('slug','!=','uncategorized')->where('parent_id','=','0')->take(5)->get() as $category )
                                        <li>
                                            <a href="{{ url('category') }}/{{ $category->slug }}">{{ $category->name }}</a>
                                        </li>
                                    @endforeach
                                    <li><a href="{{ url('categories') }}">View All</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="about">
                                <h1>About</h1>
                                <ul>
                                    <li><a href="{{ url('/') }}/terms-of-service">Terms of Use</a></li>
                                    <li><a href="{{ url('/') }}/privacy-policy">Privacy Policy</a></li>
                                    <li><a href="{{ url('/') }}/imprint">Imprint</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<div class="bootom-bar">
    <div class="container">
        <div class="row">
            <div class="footer">
                <h1>2020 All Rights Reserved</h1>
            </div>
        </div>
    </div>
</div>
</div>
@include('includes.javascript_general')
@yield('javascript')
<script src="{{ asset('custom-css/slick/slick.min.js') }}"></script>
<!-- <script src="audiojs/audio.min.js"></script> -->

<script src="{{ asset('custom-css/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('custom-css/js/custom.js') }}"></script>
<script src="{{ asset('custom-css/js/baguetteBox.min.js') }}"></script>
<script src="{{ asset('custom-css/js/jquery.simple-calendar.js') }}"></script>
<script src="{{ asset('custom-css/js/jquery.simple-calendar2.js') }}"></script>
<script src="{{ asset('custom-css/js/sun.js') }}"></script>
<script src="{{ asset('js/moment.min.js')}}" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script src="{{ asset('emojionearea-master/dist/emojionearea.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
<script src="https://unpkg.com/wavesurfer.js"></script>
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/wavesurfer.js/1.1.1/wavesurfer.min.js"></script>-->
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/wavesurfer.js/1.1.1/plugin/wavesurfer.timeline.min.js"></script>-->
<!--<script src="https://cdn.jsdelivr.net/gh/BossBele/cropzee@latest/dist/cropzee.js" defer></script>-->

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
<!-- Bootstrap JavaScript -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>

<!--<script src="{{ asset('js/custom_cropzee.js')}}" defer></script>-->
<script src="{{asset('js/croppie.min.js')}}"></script>

<!--<script src="{{asset('js/imguploader.minify.js')}}"></script>-->

<!-- For Bootstrap Project -->

<script src="{{asset('js/imguploader.bs.js')}}"></script>


<!--<script src="https://cdn.jsdelivr.net/gh/BossBele/cropzee@v2.0/dist/cropzee.js" defer></script>-->
<script src="https://cdn.jsdelivr.net/gh/cowboy/jquery-throttle-debounce/jquery.ba-throttle-debounce.js" defer></script>


<script>

    $(document).ready(function () {
        //  $("#filePhoto").cropzee({

        //// custom aspect radio
        //           aspectRatio:null,
        //           // min/max sizes
        //           maxSize: { width:null, height:null },
        //           minSize: { width:null, height:null },
        //           // start size of crop region
        //           startSize: { width: 100, height: 100, unit:'%' }


        //  });
        $.each($("input[name='enable']"), function () {
            if ($(this).is(":checked")) {
                $(this).closest("div.uk-position-relative").find("textarea").removeAttr("disabled");
            } else {
                $(this).closest("div.uk-position-relative").find("textarea").attr("disabled", "disabled");
            }
        });
        $("input, select, textarea").on("keyup change", $.debounce(300, function () {
            destroyPlugin($("#input"));
            $.each($("input[name='enable']"), function () {
                if ($(this).is(":checked")) {
                    $(this).closest("div.uk-position-relative").find("textarea").removeAttr("disabled");
                } else {
                    $(this).closest("div.uk-position-relative").find("textarea").attr("disabled", "disabled");
                }
            });
            var aspectRatio = "";
            $.each($("input[name='aspectRatio']"), function () {
                aspectRatio += $(this).val();
            });
            var maxSize = [];
            $.each($("input[name='maxSize'], select[name='maxSize']"), function () {
                maxSize.push($(this).val());
            });
            var minSize = [];
            $.each($("input[name='minSize'], select[name='minSize']"), function () {
                minSize.push($(this).val());
            });
            var startSize = [];
            $.each($("input[name='startSize'], select[name='startSize']"), function () {
                startSize.push($(this).val());
            });
            var allowedInputs = [];
            $.each($("input[name='allowedInputs']:checked"), function () {
                allowedInputs.push($(this).val());
            });
            var imageExtension = "";
            $.each($("input[name='imageExtension']:checked"), function () {
                imageExtension += $(this).val();
            });
            var returnImageMode = "";
            $.each($("input[name='returnImageMode']:checked"), function () {
                returnImageMode += $(this).val();
            });
            var modalAnimation = "";
            $.each($("select[name='modalAnimation']"), function () {
                modalAnimation += $(this).val();
            });
            var onCropStart = null;
            $.each($("textarea[name='onCropStart']"), function () {
                if (!$(this).is(":disabled")) {
                    onCropStart = $(this).val();
                }
            });
            var onCropMove = null;
            $.each($("textarea[name='onCropMove']"), function () {
                if (!$(this).is(":disabled")) {
                    onCropMove = $(this).val();
                }
            });
            var onCropEnd = null;
            $.each($("textarea[name='onCropEnd']"), function () {
                if (!$(this).is(":disabled")) {
                    onCropEnd = $(this).val();
                }
            });
            var onInitialize = null;
            $.each($("textarea[name='onInitialize']"), function () {
                if (!$(this).is(":disabled")) {
                    onInitialize = $(this).val();
                }
            });
            window.options = {
                aspectRatio: aspectRatio,
                maxSize: maxSize,
                minSize: minSize,
                startSize: startSize,
                onCropStart: onCropStart,
                onCropMove: onCropMove,
                onCropEnd: onCropEnd,
                onInitialize: onInitialize,
                modalAnimation: modalAnimation,
                allowedInputs: allowedInputs,
                imageExtension: imageExtension,
                returnImageMode: returnImageMode,
            }
            // alert(JSON.stringify(options));

            console.log('qweqweqwe');
            console.log(options);
            // $("#filePhoto").cropzee(options);
        }));
    });
    var destroyPlugin = function ($elem, eventNamespace) {
        console.log("$elem")
        console.log($elem)
        var isInstantiated = !!$.data($elem.get(0));
        if (isInstantiated) {
            $.removeData($elem.get(0));
            $elem.off(eventNamespace);
            $elem.unbind('.' + eventNamespace);
        }
    };
</script>
<style>
    * {
        font-family: sans-serif;
    }

    .previewPhoto {
        height: 750px;
        width: 750px;
        display: flex;
        border-radius: 10px;
        border: 1px solid lightgrey;
    }

    li {
        font-size: 11px;
    }

    .dependencies {
        font-family: 'Reenie Beanie', cursive;
        font-size: 28px;
        text-decoration: none;
    }

    textarea {
        resize: none;
        min-height: 50px;
    }

    pre, code {
        user-select: all;
    }
</style>
<script>


    /* Commented by shahzad start */
    $(document).ready(function () {

        $('.Bigwave').each(function () {
            //Generate unic ud
            var id = '_' + Math.random().toString(36).substr(2, 9);
            var path = $(this).attr('data-path');

            //Set id to container
            $(this).find(".wave-container").attr("id", id);


            //Initialize WaveSurfer
            var wavesurfer = WaveSurfer.create({
                container: '#' + id,
                //   waveColor: 'violet',
                waveColor: '#ef595f',
                progressColor: '#3A3A3A',
                backgroundColor: 'transparent',

                cursorWidth: 2,
                height: 70
            });


            //Load audio file
            wavesurfer.load(path);
            //   console.log(wavesurfer.load(path));
            //Add button event
            //   $(this).find("button").click(function(){
            //   	wavesurfer.playPause();
            //   });


            $(this).data('wavesurfer', wavesurfer);


            var BigMainWaveData = '';
            $(document).on('click', 'a[id^="Bigbaton-playMusic#"]', function () {
                var dataGet = $(this).attr('id').split('#')[1]; //console.log(dataGet);
                BigMainWaveData = dataGet;
                //wavesurfer.play();
                $(this).closest('.Bigwave').data('wavesurfer').play();
                $(this).hide();
                // $("#pauseMusic").show();
                // $("#baton-pauseMusic#"+ dataGet).css('display','block');
                $('a[id^="Bigbaton-pauseMusic#' + dataGet + '"]').css('display', 'inline');
            });
            // $('a[id^="baton-pauseMusic#"]').click(function() {
            $(document).on('click', 'a[id^="Bigbaton-pauseMusic#"]', function () {
                var dataGet = $(this).attr('id').split('#')[1];
                BigMainWaveData = dataGet;
                //wavesurfer.pause();
                $(this).closest('.Bigwave').data('wavesurfer').pause();
                $(this).hide();
                $('a[id^="Bigbaton-playMusic#' + dataGet + '"]').css('display', 'inline');
            });

            wavesurfer.on('finish', function () {
                $('a[id^="Bigbaton-pauseMusic#' + BigMainWaveData + '"]').css('display', 'none');
                $('a[id^="Bigbaton-playMusic#' + BigMainWaveData + '"]').css('display', 'inline');
            });
        });


        $('.wave').each(function () {
            //Generate unic ud
            var id = '_' + Math.random().toString(36).substr(2, 9);
            var path = $(this).attr('data-path');

            //Set id to container
            $(this).find(".wave-container").attr("id", id);

            //Initialize WaveSurfer
            var wavesurfer = WaveSurfer.create({
                container: '#' + id,
                //   waveColor: 'violet',
                waveColor: '#ef595f',
                progressColor: '#3A3A3A',
                backgroundColor: 'transparent',

                cursorWidth: 2,
                height: 70
            });


            //Load audio file
            wavesurfer.load(path);

            //Add button event
            //   $(this).find("button").click(function(){
            //   	wavesurfer.playPause();
            //   });
            var MainWaveData = '';
            $(document).on('click', 'a[id^="baton-playMusic#"]', function () {
                var dataGet = $(this).attr('id').split('#')[1];
                MainWaveData = dataGet;
                wavesurfer.play();
                $(this).hide();
                // $("#pauseMusic").show();
                // $("#baton-pauseMusic#"+ dataGet).css('display','block');
                $('a[id^="baton-pauseMusic#' + dataGet + '"]').css('display', 'inline');
            });
            // $('a[id^="baton-pauseMusic#"]').click(function() {
            $(document).on('click', 'a[id^="baton-pauseMusic#"]', function () {
                var dataGet = $(this).attr('id').split('#')[1];
                MainWaveData = dataGet;
                wavesurfer.pause();
                $(this).hide();
                $('a[id^="baton-playMusic#' + dataGet + '"]').css('display', 'inline');
            });

            wavesurfer.on('finish', function () {
                $('a[id^="baton-pauseMusic#' + MainWaveData + '"]').css('display', 'none');
                $('a[id^="baton-playMusic#' + MainWaveData + '"]').css('display', 'inline');
            });
        });

    });
    /* Commented by shahzad end */


    // var wavesurfer = WaveSurfer.create({
    //     container: '#waveform',
    //     waveColor: 'red',
    //     progressColor: 'purple',
    //     backgroundColor: 'transparent',
    //     barHeight: 2,
    //     barWidth: 5,
    //     cursorWidth: 5,
    //     height: 100
    // });
    // wavesurfer.load('http://ia902606.us.archive.org/35/items/shortpoetry_047_librivox/song_cjrg_teasdale_64kb.mp3');

    // var onMusic = wavesurfer.on('ready', function() {
    // wavesurfer.play();
    // });
    // $(document).ready(function() {
    //     $("#playMusic").click(function() {
    //         wavesurfer.play();
    //         $(this).hide();
    //         $("#pauseMusic").show();
    //     });
    //     $("#pauseMusic").click(function() {
    //         wavesurfer.pause();
    //         $(this).hide();
    //         $("#playMusic").show();
    //     });
    // });


    /*--- [ER] mod-preset ---*/


</script>
<script>
    $(document).on('onInit.fb', function (e, instance) {
        if ($('.fancybox-toolbar').find('#rotate_button').length === 0) {
            // var price = $(this).parents('a').attr('data-price');
            // var price = 'hamza';
            // $(".fancybox-stage").prepend('<button id="buy_button" class="btn btn-success btn-buy">Buy Now </button>')
            /*$(".fancybox-toolbar").prepend('<form action="{{url('instant_buy')}}" method="post"><button id="buy_button" class="btn btn-success btn-buy">$100 Buy</button></form>');
                    $('.fancybox-toolbar').prepend('<button id="rotate_button" class="fancybox-button" title="Rotate Image"><i class="fa fa-repeat"></i></button>');*/
        }
        var click = 1;
        $('.fancybox-toolbar').on('click', '#rotate_button', function () {
            var n = 90 * ++click;
            $('.fancybox-content img').css('webkitTransform', 'rotate(-' + n + 'deg)');
            $('.fancybox-content img').css('mozTransform', 'rotate(-' + n + 'deg)');
        });


    });
</script>
<script src="https://checkout.stripe.com/v2/checkout.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('[data-fancybox]').each(function () {
            var that = this;
            $(this).fancybox({
                beforeLoad: function () {
                    var fileId = $(that).attr('data-id');
                    var fileTitle = $(that).attr('data-title');
                    var fileDesc = $(that).attr('data-description');
                    var filePrice = $(that).attr('data-price');
                    var fileType = $(that).attr('data-type');
                    var slug = $(that).attr('data-slug');
                    if (fileType == "image") {
                        fileType = "photo";
                    }
                    if (fileType == "video") {
                        fileType = "video";
                    }
                    if (fileType == "audio") {
                        fileType = "audio";
                    }
                    var fileUrl = '{{ url("/")  }}/' + fileType + '/' + fileId + '/' + slug;

                    console.log("Price of element clicked is: " + filePrice);

                    $(".fancybox-toolbar").prepend('<a href="' + fileUrl + '" id="buy_button" class="btn btn-success btn-buy instantBuyBtn">$' + filePrice + ' Buy</a>');
                    $('.fancybox-toolbar').prepend('<button id="rotate_button" class="fancybox-button" title="Rotate Image"><i class="fa fa-repeat"></i></button>');

                }
            });
        });

        /*<!-- Stripe Checkout Added by Shahzad -->*/
        var handler = StripeCheckout.configure({
            key: '{{env("STRIPE_KEY")}}',
            image: 'https://projects.hexawebstudio.com/darquise-nantel/img/favicon.png',
            locale: 'auto',
            token: function (token) {
                // You can access the token ID with `token.id`.
                // Get the token ID to your server-side code for use.
                console.log("Token created: " + token.id);
                $('.instantBuyBtn').parents('form').append($('<input>').attr({
                    type: 'hidden',
                    name: 'stripeToken',
                    value: token.id
                })).submit();
            },
            opened: function () {
                console.log("Form opened");
                $(".instantBuyBtn").prop("disabled", false);
            },
            closed: function () {
                console.log("Form closed");
                $(".instantBuyBtn").prop("disabled", false);
            }
        });

        $(document).on("click", ".instantBuyBtnn", function () {
            //e.preventDefault();
            $(this).prop("disabled", true);
            // Open Checkout with further options:
            handler.open({
                name: $('.instantBuyBtn').parents('form').find($('input[name=fileTitle]')).val(),
                description: $('.instantBuyBtn').parents('form').find($('input[name=fileDesc]')).val(),
                amount: $('.instantBuyBtn').parents('form').find($('input[name=filePrice]')).val() * 100
            });
            e.preventDefault();
        });

        // Close Checkout on page navigation:
        $(window).on('popstate', function () {
            handler.close();
        });

        /*<!-- Stripe Checkout addedd by shahzad -->*/


        $("#emojionearea4").emojioneArea({
            pickerPosition: "bottom",
            filtersPosition: "bottom",
            tonesStyle: "checkbox",
            events: {
                keyup: function (editor, event) {
                    var keycode = (event.keyCode ? event.keyCode : event.which);
                    if (keycode == '13') {
                        $("#sendMsgChat").click();
                    }
                }
            }
        });

        // $("#delete-icon-btn").click(function() {
        $(document).on('click', '#delete-icon-btn', function () {

            myStopFunction();
            $(this).parent().parent().hide();
            $(this).parent().parent().siblings(".conform-delete-div").show();
            $(this).parent().parent().parent().addClass("chat-col-md-3");
            $(this).parent().parent().parent().removeClass("chat-col-md-1");
            $(this).parent().parent().parent().siblings().children().children().children("#hide-for-gab").hide();
            $(this).parent().parent().parent().siblings("#change-col-class").addClass("chat-col-md-9");
            $(this).parent().parent().parent().siblings("#change-col-class").removeClass("chat-col-md-11");
        });

        // $("#conform-delete").click(function() {
        $(document).on('click', 'button[id^="conform-delete_"]', function () {
            var chatId = $(this).attr('id').split('_')[1];
            var sessionUserId = $(this).attr('id').split('_')[2];
            console.log(chatId);
            console.log(sessionUserId);

            const baseUrl = '<?php echo url('/') ?>';

            $.ajax({
                url: baseUrl + '/delete-chat/' + chatId + '/' + sessionUserId,
                type: 'get',
                dataType: 'json',
                success: function (respo) {
                    if (respo) {
                        // console.log(respo);
                        $(this).parent().parent().parent().parent().hide("slide", {direction: "right"}, 1000);
                        myStartFunction();
                    } else {
                        myStartFunction();
                        $(this).parent().parent().siblings(".chat-checkbox").show();
                        $(this).parent().parent(".conform-delete-div").hide();
                        $(this).parent().parent().parent().removeClass("chat-col-md-3");
                        $(this).parent().parent().parent().addClass("chat-col-md-1");
                        $(this).parent().parent().parent().siblings().children().children().children("#hide-for-gab").show();
                        $(this).parent().parent().parent().siblings("#change-col-class").removeClass("chat-col-md-9");
                        $(this).parent().parent().parent().siblings("#change-col-class").addClass("chat-col-md-11");
                    }
                },
                error: function () {
                    console.log('error while deleting chat ');
                }
            });
            // $(this).parent().parent().parent().parent().parent('row').animate({'line-height':0},1000).hide(1);
            // myStartFunction();
            $(this).parent().parent().parent().parent().hide("slide", {direction: "right"}, 1000);
        });

        // $("#cencel-delete").click(function() {
        $(document).on('click', '#cencel-delete', function () {
            myStartFunction();
            $(this).parent().parent().siblings(".chat-checkbox").show();
            $(this).parent().parent(".conform-delete-div").hide();
            $(this).parent().parent().parent().removeClass("chat-col-md-3");
            $(this).parent().parent().parent().addClass("chat-col-md-1");
            $(this).parent().parent().parent().siblings().children().children().children("#hide-for-gab").show();
            $(this).parent().parent().parent().siblings("#change-col-class").removeClass("chat-col-md-9");
            $(this).parent().parent().parent().siblings("#change-col-class").addClass("chat-col-md-11");
        });

    });

</script>
<script>


    $("#openModalMessageChat").click(function () {
        // var checkSession = "<?php //echo (\Auth::user() != null) ? \Auth::user()->id : '';?>";

        // console.log(checkSession);
        const baseUrl = '<?php echo url("/")?>';

        var sessionUserId = '<?php echo (\Auth::user() != null) ? \Auth::user()->id : '';?>';
        $.ajax({
            url: baseUrl + '/get-chat-list/' + sessionUserId,
            type: 'GET',
            dataType: 'json',
            success: function (respo) {

                $("#chatListDiv").empty();
                var htmlChatList = '';
                if (respo == "empty") {
                    $("#messageMainModal modal-body #chatListDiv").append(htmlChatList);
                    $("#pConversations").text('No chat with anyone yet.');
                    $("#messageMainModal").modal();
                } else {
                    $.each(respo, function (index, value) {
                        var relative_time = moment(value.LatestMessageDate).fromNow();
                        if (value.sender_id == sessionUserId && value.sender_delete != "1") {
                            htmlChatList += '<div class="row" id="delete-click-hide-this" style="margin-right: 0; margin-left: 0;">' +
                                '<div class="chat-col-md-1" style="padding-left: 0; padding-right: 0; text-align: center;">' +
                                '<div class="chat-checkbox">' +
                                '<div id="delete-btn-icon" style="z-index: 999;">' +
                                '<i class="fa fa-trash" aria-hidden="true" id="delete-icon-btn"></i>' +
                                '</div>' +
                                '</div>' +
                                '<div class="conform-delete-div" style="display: none;">' +
                                '<div class="">' +
                                '<button id="conform-delete_' + value.chat_id + '_' + sessionUserId + '" class="btn-delete">' +
                                'delete' +
                                '</button>' +
                                '</div>' +
                                '<div class="" style="margin-top: 14px;"> ' +
                                '<button id="cencel-delete" class="btn-cencel">' +
                                'cencel' +
                                '</button>' +
                                '</div>' +
                                '</div>' +
                                '</div>';
                            htmlChatList += '<div class="chat-col-md-11" style="" id="change-col-class">' +
                                '<a href="javascript:;" type="button" class="" id="singleUserChat-' + value.chat_id + '" style="display: block; color: #000;">' +
                                '<div class="row conversation-persons-modal" style="margin-bottom: 14px;">' +
                                '<div class="col-md-2" style="padding-left: 0; padding-right: 0; text-align: center;">';
                            if (value.senderId == sessionUserId) {
                                htmlChatList += '<img loading="lazy" src="' + baseUrl + '/avatar/' + value.receiverAvatar + '" alt="" style="width: 60px; border-radius: 50%; height: 60px; margin: 0 auto;">';
                            } else {
                                htmlChatList += '<img loading="lazy" src="' + baseUrl + '/avatar/' + value.senderAvatar + '" alt="" style="width: 60px; border-radius: 50%; height: 60px; margin: 0 auto;">';
                            }
                            htmlChatList += '</div>' +
                                '<div class="col-md-7" style="padding-left: 0; padding-right: 0;">';
                            if (value.senderId == sessionUserId) {
                                if (value.receiverName != "") {
                                    htmlChatList += '<p style="font-weight: bolder;letter-spacing: 1px;">' + value.receiverName + '</p>';
                                } else {
                                    htmlChatList += '<p style="font-weight: bolder;letter-spacing: 1px;">' + value.receiverUserName + '</p>';
                                }

                            } else {
                                if (value.senderName != "") {
                                    htmlChatList += '<p style="font-weight: bolder;letter-spacing: 1px;">' + value.senderName + '</p>';
                                } else {
                                    htmlChatList += '<p style="font-weight: bolder;letter-spacing: 1px;">' + value.senderUserName + '</p>';
                                }
                            }
                            if (value.LatestMessage != null) {

                                htmlChatList += '<p style="font-style: italic;">' + value.LatestMessage + '</p>';
                            } else {

                                if (value.MessageType == "image") {
                                    htmlChatList += '<p style="font-style: italic;"><img loading="lazy" src="' + baseUrl + '/img/photo.png" alt="" style="width: 20px;">Photo</p>';

                                } else {
                                    htmlChatList += '<p style="font-style: italic;"><img loading="lazy" src="' + baseUrl + '/img/file.png" alt="" style="width: 20px;">' + value.LatestMessageFile + '</p>';
                                }
                            }
                            htmlChatList += '</div>' +
                                '<div class="col-md-3" style="margin-top: 17px;">' +
                                '<span style="font-size:12px;">' + relative_time + '</span>' +
                                '</div>' +
                                '</div>' +
                                '</a>' +
                                '</div>';
                        } else if (value.receiver_id == sessionUserId && value.receiver_delete != "1") {
                            htmlChatList += '<div class="row" id="delete-click-hide-this" style="margin-right: 0; margin-left: 0;">' +
                                '<div class="chat-col-md-1" style="padding-left: 0; padding-right: 0; text-align: center;">' +
                                '<div class="chat-checkbox">' +
                                '<div id="delete-btn-icon" style="z-index: 999;">' +
                                '<i class="fa fa-trash" aria-hidden="true" id="delete-icon-btn"></i>' +
                                '</div>' +
                                '</div>' +
                                '<div class="conform-delete-div" style="display: none;">' +
                                '<div class="">' +
                                '<button id="conform-delete_' + value.chat_id + '_' + sessionUserId + '" class="btn-delete">' +
                                'delete' +
                                '</button>' +
                                '</div>' +
                                '<div class="" style="margin-top: 14px;"> ' +
                                '<button id="cencel-delete" class="btn-cencel">' +
                                'Cancel' +
                                '</button>' +
                                '</div>' +
                                '</div>' +
                                '</div>';
                            htmlChatList += '<div class="chat-col-md-11" style="" id="change-col-class">' +
                                '<a href="javascript:;" type="button" class="" id="singleUserChat-' + value.chat_id + '" style="display: block; color: #000;">' +
                                '<div class="row conversation-persons-modal" style="margin-bottom: 14px;">' +
                                '<div class="col-md-2" style="padding-left: 0; padding-right: 0; text-align: center;">';
                            if (value.senderId == sessionUserId) {
                                htmlChatList += '<img loading="lazy" src="' + baseUrl + '/avatar/' + value.receiverAvatar + '" alt="" style="width: 60px; border-radius: 50%; height: 60px; margin: 0 auto;">';
                            } else {
                                htmlChatList += '<img loading="lazy" src="' + baseUrl + '/avatar/' + value.senderAvatar + '" alt="" style="width: 60px; border-radius: 50%; height: 60px; margin: 0 auto;">';
                            }
                            htmlChatList += '</div>' +
                                '<div class="col-md-7" style="padding-left: 0; padding-right: 0;">';
                            if (value.senderId == sessionUserId) {
                                if (value.receiverName != "") {
                                    htmlChatList += '<p style="font-weight: bolder;letter-spacing: 1px;">' + value.receiverName + '</p>';
                                } else {
                                    htmlChatList += '<p style="font-weight: bolder;letter-spacing: 1px;">' + value.receiverUserName + '</p>';
                                }

                            } else {
                                if (value.senderName != "") {
                                    htmlChatList += '<p style="font-weight: bolder;letter-spacing: 1px;">' + value.senderName + '</p>';
                                } else {
                                    htmlChatList += '<p style="font-weight: bolder;letter-spacing: 1px;">' + value.senderUserName + '</p>';
                                }
                            }
                            if (value.LatestMessage != null) {

                                htmlChatList += '<p style="font-style: italic;">' + value.LatestMessage + '</p>';
                            } else {

                                if (value.MessageType == "image") {
                                    htmlChatList += '<p style="font-style: italic;"><img loading="lazy" src="' + baseUrl + '/img/photo.png" alt="" style="width: 20px;">Photo</p>';

                                } else {
                                    htmlChatList += '<p style="font-style: italic;"><img loading="lazy" src="' + baseUrl + '/img/file.png" alt="" style="width: 20px;">' + value.LatestMessageFile + '</p>';
                                }
                            }
                            htmlChatList += '</div>' +
                                '<div class="col-md-3" style="margin-top: 17px;">' +
                                '<span style="font-size:12px;">' + relative_time + '</span>' +
                                '</div>' +
                                '</div>' +
                                '</a>' +
                                '</div>';
                        }
                    });
                    $("#chatListDiv").append(htmlChatList);
                    $("#messageMainModal").modal();
                }
            },
            error: function () {
                console.log('error while getting chat list when clicked on messager button');
            }
        });
    });

    var globalChatID = "";// for calling function getMessageDetail for every 5 seconds.
    $(document).on('click', 'a[id^="singleUserChat-"]', function () {
        var sessionUserId2 = '<?php echo (\Auth::user() != null) ? \Auth::user()->id : '';?>';
        var name = '<?php echo (\Auth::user() != null) ? \Auth::user()->username : '';?>';
        var getAttrId = $(this).attr('id').split('-')[1];
        globalChatID = getAttrId;
        const baseUrl = '<?php echo url("/")?>';
        $.ajax({
            url: baseUrl + '/get-single-chat-details/' + getAttrId,
            type: 'GET',
            'dataType': 'json',
            success: function (resp) {
                $("#textChatId").val('');
                $("#textChatId").val(resp[0].chat_id);
                $("#textUserId").val('');
                if (resp[0].senderId == sessionUserId2) {
                    htmlHeadhingUserName = '<h5 class="modal-title" id="messageMainModal-2Label"><img loading="lazy" src="" alt=""><img loading="lazy" src="' + baseUrl + '/avatar/' + resp[0].receiverAvatar + '" alt="" style="width: 30px; border-radius: 50%; height: 30px;"> ';
                    if (resp[0].receiverName !== "") {

                        htmlHeadhingUserName += '<span style="font-size: 16px;">' + resp[0].receiverName + '</span>';
                    } else {

                        htmlHeadhingUserName += '<span style="font-size: 16px;">' + resp[0].receiverUserName + '</span>';
                    }
                    htmlHeadhingUserName += '</h5>';
                    $("#textUserId").val(resp[0].receiverId);
                } else {
                    htmlHeadhingUserName = '<h5 class="modal-title" id="messageMainModal-2Label"><img loading="lazy" src="" alt=""><img loading="lazy" src="' + baseUrl + '/avatar/' + resp[0].senderAvatar + '" alt="" style="width: 30px; border-radius: 50%; height: 30px;"> ';
                    if (resp[0].senderName !== "") {
                        htmlHeadhingUserName += '<span style="font-size: 16px;">' + resp[0].senderName + '</span>';
                    } else {
                        htmlHeadhingUserName += '<span style="font-size: 16px;">' + resp[0].senderUserName + '</span>';
                    }
                    htmlHeadhingUserName += '</h5>';
                    $("#textUserId").val(resp[0].senderId);
                }

                $("#textCurrentUserId").val('');
                $("#textCurrentUserId").val(sessionUserId2);

                $("#messageMainModal2DivUserNameHeading").empty();
                $("#messageMainModal2DivUserNameHeading").append(htmlHeadhingUserName);
                $("#singleChatUserDiv").empty();
                var htmlSingleChatList = '';
                if (resp == "empty") {
                    $("#messageMainModal2 modal-body #singleChatUserDiv").append(htmlSingleChatList);
                } else {
                    var sessionUserId = '<?php echo (\Auth::user() != null) ? \Auth::user()->id : '';?>';
                    $.each(resp, function (index, value) {
                        var msgTime = moment(value.created_at).format('LT');
                        // console.log(msgTime);
                        if (value.message_text != null) {
                            if (value.sender_id != sessionUserId) {
                                htmlSingleChatList += '<div class="col-md-12" >' +
                                    '<p style="position: relative;background-color: #ef595f;color: #fff;border-radius: 30px;padding: 6px 16px; width: 50%; margin-bottom: 14px;">' + value.message_text + '<span style="display: block; text-align: right;font-size: 11px;">' + msgTime + '</span></p>' +
                                    '</div>';
                            } else {
                                htmlSingleChatList += '<div class="col-md-12" >' +
                                    '<p style="position: relative;background-color: #999;color: #fff;border-radius: 8px;padding: 6px 16px;width: 50%;margin-left: auto;margin-bottom: 14px;">' + value.message_text + '<span style="display: block; text-align: right;font-size: 11px;">' + msgTime + '</span></p>' +
                                    '</div>';
                            }
                        } else if (value.message_file != null) {
                            if (value.file_type == "image") {
                                if (value.sender_id != sessionUserId) {
                                    htmlSingleChatList += '<div class="col-md-6 hover-show-download " style="border-radius:10px; margin-right: 1px;">' +
                                        '<img loading="lazy" src="' + baseUrl + '/chats_images/' + value.message_file + '" alt="" class="img-responsive" style="margin-bottom: 10px; padding:10px; background-color: #ef595f; border-radius: 12px;">' +
                                        '<span class="download-btn" id="spanDownloadHover">' +
                                        '<a download="' + value.message_file + '" href="' + baseUrl + '/chats_images/' + value.message_file + '" style="color: #fff;"> <i class="fa fa-download" aria-hidden="true"></i></a>' +
                                        '</span>' +
                                        '<span style="display: block;text-align: right;font-size: 11px;color: #fff;position: absolute;bottom: 10px;right: 31px;">' + msgTime + '</span>' +
                                        '</div>';
                                } else {
                                    htmlSingleChatList += '<div class="col-md-6 hover-show-download offset-md-6" style="border-radius:10px;" >' +
                                        '<img loading="lazy" src="' + baseUrl + '/chats_images/' + value.message_file + '" alt="" class="img-responsive" style="margin-bottom: 10px; margin-left: auto; padding:10px; background-color: #000; border-radius: 12px;">' +
                                        '<span class="download-btn" id="spanDownloadHover">' +
                                        '<a download="' + value.message_file + '" href="' + baseUrl + '/chats_images/' + value.message_file + '" style="color: #fff;"> <i class="fa fa-download" aria-hidden="true"></i></a>' +
                                        '</span>' +
                                        '<span style="display: block;text-align: right;font-size: 11px;color: #fff;position: absolute;bottom: 10px;right: 31px;">' + msgTime + '</span>' +
                                        '</div>';
                                }
                            } else if (value.file_type == "file") {
                                if (value.sender_id != sessionUserId) {
                                    htmlSingleChatList += '<div class="col-md-12" >';
                                    if (value.message_file.split('.')[1] == "pdf") {
                                        htmlSingleChatList += '<p style="background-color: #ef595f;color: #fff;border-radius: 30px;padding: 6px 16px; width: 50%;"><span><img loading="lazy" src="' + baseUrl + '/img/pdf.png' + '" alt="" style="width: 20px; height: 20px; margin-right: 6px;"></span>';
                                    } else {
                                        htmlSingleChatList += '<p style="background-color: #ef595f;color: #fff;border-radius: 30px;padding: 6px 16px; width: 50%;"><span><img loading="lazy" src="' + baseUrl + '/img/doc2.png' + '" alt="" style="width: 20px; height: 20px; margin-right: 6px;"></span>';
                                    }
                                    htmlSingleChatList += value.message_file +
                                        '<span><a download="' + value.message_file + '" href="' + baseUrl + '/chats_images/' + value.message_file + '" style="color: #fff;"><i class="fa fa-download" aria-hidden="true"></i></a>' +
                                        '</span>' +
                                        '<span style="display: block; text-align: right;font-size: 11px;">22:38</span></p>' +
                                        '</div>';
                                } else {
                                    htmlSingleChatList += '<div class="col-md-12" >';
                                    if (value.message_file.split('.')[1] == "pdf") {
                                        htmlSingleChatList += '<p style="background-color: #000;color: #fff;border-radius: 30px;padding: 6px 16px; width: 50%;margin-left: auto; margin-bottom: 14px;"><span><img loading="lazy" src="' + baseUrl + '/img/pdf.png' + '" alt="" style="width: 20px; height: 20px; margin-right: 6px;"></span>';
                                    } else {
                                        htmlSingleChatList += '<p style="background-color: #000;color: #fff;border-radius: 30px;padding: 6px 16px; width: 50%;margin-left: auto; margin-bottom: 14px"><span><img loading="lazy" src="' + baseUrl + '/img/doc2.png' + '" alt="" style="width: 20px; height: 20px; margin-right: 6px;"></span>';
                                    }
                                    htmlSingleChatList += value.message_file +
                                        '<span><a download="' + value.message_file + '" href="' + baseUrl + '/chats_images/' + value.message_file + '" style="color: #fff;"><i class="fa fa-download" aria-hidden="true"></i></a>' +
                                        '</span>' +
                                        '<span style="display: block; text-align: right;font-size: 11px;">22:38</span></p>' +
                                        '</div>';
                                }
                            } else {
                            }
                        }
                    });
                    $("#singleChatUserDiv").append(htmlSingleChatList);
                    $("#messageMainModal").modal('toggle');
                    $("#messageMainModal2").modal();
                    // console.log('here');
                }


            }, error: function () {
                console.log('error while getting single user chat details');
            }
        });
    });

    $('#messageMainModal2').on('hidden.bs.modal', function () {
        $(document.body).css({'padding-right': '0'});
        var sessionUserId = '<?php echo (\Auth::user() != null) ? \Auth::user()->id : '';?>';
        const baseUrl = '<?php echo url("/")?>';
        $.ajax({
            url: baseUrl + '/get-chat-list/' + sessionUserId,
            type: 'GET',
            dataType: 'json',
            success: function (respo) {

                $("#chatListDiv").empty();
                var htmlChatList = '';
                if (respo == "empty") {
                    $("#messageMainModal modal-body #chatListDiv").append(htmlChatList);
                } else {
                    $.each(respo, function (index, value) {
                        var relative_time = moment(value.LatestMessageDate).fromNow();
                        if (value.sender_id == sessionUserId && value.sender_delete != "1") {
                            htmlChatList += '<div class="row" id="delete-click-hide-this" style="margin-right: 0; margin-left: 0;">' +
                                '<div class="chat-col-md-1" style="padding-left: 0; padding-right: 0; text-align: center;">' +
                                '<div class="chat-checkbox">' +
                                '<div id="delete-btn-icon" style="z-index: 999;">' +
                                '<i class="fa fa-trash" aria-hidden="true" id="delete-icon-btn"></i>' +
                                '</div>' +
                                '</div>' +
                                '<div class="conform-delete-div" style="display: none;">' +
                                '<div class="">' +
                                '<button id="conform-delete_' + value.chat_id + '_' + sessionUserId + '" class="btn-delete">' +
                                'delete' +
                                '</button>' +
                                '</div>' +
                                '<div class="" style="margin-top: 14px;"> ' +
                                '<button id="cencel-delete" class="btn-cencel">' +
                                'cencel' +
                                '</button>' +
                                '</div>' +
                                '</div>' +
                                '</div>';
                            htmlChatList += '<div class="chat-col-md-11" style="" id="change-col-class">' +
                                '<a href="javascript:;" type="button" class="" id="singleUserChat-' + value.chat_id + '" style="display: block; color: #000;">' +
                                '<div class="row conversation-persons-modal" style="margin-bottom: 14px;">' +
                                '<div class="col-md-2" style="padding-left: 0; padding-right: 0; text-align: center;">';
                            if (value.senderId == sessionUserId) {
                                htmlChatList += '<img loading="lazy" src="' + baseUrl + '/avatar/' + value.receiverAvatar + '" alt="" style="width: 60px; border-radius: 50%; height: 60px; margin: 0 auto;">';
                            } else {
                                htmlChatList += '<img loading="lazy" src="' + baseUrl + '/avatar/' + value.senderAvatar + '" alt="" style="width: 60px; border-radius: 50%; height: 60px; margin: 0 auto;">';
                            }
                            htmlChatList += '</div>' +
                                '<div class="col-md-7" style="padding-left: 0; padding-right: 0;">';
                            if (value.senderId == sessionUserId) {
                                if (value.receiverName != "") {
                                    htmlChatList += '<p style="font-weight: bolder;letter-spacing: 1px;">' + value.receiverName + '</p>';
                                } else {
                                    htmlChatList += '<p style="font-weight: bolder;letter-spacing: 1px;">' + value.receiverUserName + '</p>';
                                }

                            } else {
                                if (value.senderName != "") {
                                    htmlChatList += '<p style="font-weight: bolder;letter-spacing: 1px;">' + value.senderName + '</p>';
                                } else {
                                    htmlChatList += '<p style="font-weight: bolder;letter-spacing: 1px;">' + value.senderUserName + '</p>';
                                }
                            }
                            if (value.LatestMessage != null) {

                                htmlChatList += '<p style="font-style: italic;">' + value.LatestMessage + '</p>';
                            } else {
                                if (value.MessageType == "image") {


                                    htmlChatList += '<p style="font-style: italic;"><img loading="lazy" src="' + baseUrl + '/img/photo.png" alt="" style="width: 20px;">Photo</p>';

                                } else {

                                    htmlChatList += '<p style="font-style: italic;"><img loading="lazy" src="' + baseUrl + '/img/file.png" alt="" style="width: 20px;">' + value.LatestMessageFile + '</p>';
                                }
                            }
                            htmlChatList += '</div>' +
                                '<div class="col-md-3" style="margin-top: 17px;">' +
                                '<span style="font-size:12px;">' + relative_time + '</span>' +
                                '</div>' +
                                '</div>' +
                                '</a>' +
                                '</div>';
                        } else if (value.receiver_id == sessionUserId && value.receiver_id != "1") {
                            htmlChatList += '<div class="row" id="delete-click-hide-this" style="margin-right: 0; margin-left: 0;">' +
                                '<div class="chat-col-md-1" style="padding-left: 0; padding-right: 0; text-align: center;">' +
                                '<div class="chat-checkbox">' +
                                '<div id="delete-btn-icon" style="z-index: 999;">' +
                                '<i class="fa fa-trash" aria-hidden="true" id="delete-icon-btn"></i>' +
                                '</div>' +
                                '</div>' +
                                '<div class="conform-delete-div" style="display: none;">' +
                                '<div class="">' +
                                '<button id="conform-delete_' + value.chat_id + '_' + sessionUserId + '" class="btn-delete">' +
                                'delete' +
                                '</button>' +
                                '</div>' +
                                '<div class="" style="margin-top: 14px;"> ' +
                                '<button id="cencel-delete" class="btn-cencel">' +
                                'cencel' +
                                '</button>' +
                                '</div>' +
                                '</div>' +
                                '</div>';
                            htmlChatList += '<div class="chat-col-md-11" style="" id="change-col-class">' +
                                '<a href="javascript:;" type="button" class="" id="singleUserChat-' + value.chat_id + '" style="display: block; color: #000;">' +
                                '<div class="row conversation-persons-modal" style="margin-bottom: 14px;">' +
                                '<div class="col-md-2" style="padding-left: 0; padding-right: 0; text-align: center;">';
                            if (value.senderId == sessionUserId) {
                                htmlChatList += '<img loading="lazy" src="' + baseUrl + '/avatar/' + value.receiverAvatar + '" alt="" style="width: 60px; border-radius: 50%; height: 60px; margin: 0 auto;">';
                            } else {
                                htmlChatList += '<img loading="lazy" src="' + baseUrl + '/avatar/' + value.senderAvatar + '" alt="" style="width: 60px; border-radius: 50%; height: 60px; margin: 0 auto;">';
                            }
                            htmlChatList += '</div>' +
                                '<div class="col-md-7" style="padding-left: 0; padding-right: 0;">';
                            if (value.senderId == sessionUserId) {
                                if (value.receiverName != "") {
                                    htmlChatList += '<p style="font-weight: bolder;letter-spacing: 1px;">' + value.receiverName + '</p>';
                                } else {
                                    htmlChatList += '<p style="font-weight: bolder;letter-spacing: 1px;">' + value.receiverUserName + '</p>';
                                }

                            } else {
                                if (value.senderName != "") {
                                    htmlChatList += '<p style="font-weight: bolder;letter-spacing: 1px;">' + value.senderName + '</p>';
                                } else {
                                    htmlChatList += '<p style="font-weight: bolder;letter-spacing: 1px;">' + value.senderUserName + '</p>';
                                }
                            }
                            if (value.LatestMessage != null) {

                                htmlChatList += '<p style="font-style: italic;">' + value.LatestMessage + '</p>';
                            } else {
                                if (value.MessageType == "image") {


                                    htmlChatList += '<p style="font-style: italic;"><img loading="lazy" src="' + baseUrl + '/img/photo.png" alt="" style="width: 20px;">Photo</p>';

                                } else {

                                    htmlChatList += '<p style="font-style: italic;"><img loading="lazy" src="' + baseUrl + '/img/file.png" alt="" style="width: 20px;">' + value.LatestMessageFile + '</p>';
                                }
                            }
                            htmlChatList += '</div>' +
                                '<div class="col-md-3" style="margin-top: 17px;">' +
                                '<span style="font-size:12px;">' + relative_time + '</span>' +
                                '</div>' +
                                '</div>' +
                                '</a>' +
                                '</div>';
                        }
                    });
                    $("#chatListDiv").append(htmlChatList);
                    $("#messageMainModal").modal();
                }
            },
            error: function () {
                console.log('error while getting chat list when clicked on messager button');
            }
        });
    });

    $('#sendMsgChat').click(function () {
        const baseUrl = '<?php echo url("/") ?>';
        // var textValue = $("#emojionearea4").val();
        var textValue = $('#emojionearea4').data("emojioneArea").getText().trim();
        var txtChatId = $("#textChatId").val();
        var txtCurrentUserId = $("#textCurrentUserId").val();
        var txtUserId = $("#textUserId").val();
        if (textValue == "" || textValue == null) {

        } else {
            $.ajax({
                url: baseUrl + '/send-text-msg',
                type: 'POST',
                dataType: 'json',
                data: {
                    "_token": "{{ csrf_token() }}",
                    'textMsgValue': textValue,
                    'textChatId': txtChatId,
                    'textCurrentUserId': txtCurrentUserId,
                    'textUserId': txtUserId
                },
                beforeSend: function () {
                    // Handle the beforeSend event
                    $("#msgSendLoader").css('display', 'block');
                    $("#sendMsgChat").attr('disabled', true);
                },
                success: function (respon) {
                    if (respon) {
                        const baseUrl = '<?php echo url("/")?>';
                        $.ajax({
                            url: baseUrl + '/get-single-chat-details/' + txtChatId,
                            type: 'GET',
                            'dataType': 'json',
                            success: function (resp) {
                                $("#singleChatUserDiv").empty();
                                var htmlSingleChatList = '';
                                if (resp == "empty") {
                                    $("#singleChatUserDiv").append(htmlSingleChatList);
                                } else {
                                    var sessionUserId = '<?php echo (\Auth::user() != null) ? \Auth::user()->id : '';?>';
                                    $.each(resp, function (index, value) {
                                        var msgTime = moment(value.created_at).format('LT');
                                        // console.log(msgTime);
                                        if (value.message_text != null) {
                                            if (value.sender_id != sessionUserId) {
                                                htmlSingleChatList += '<div class="col-md-12" >' +
                                                    '<p style="position: relative;background-color: #ef595f;color: #fff;border-radius: 30px;padding: 6px 16px; width: 50%; margin-bottom: 14px;">' + value.message_text + '<span style="display: block; text-align: right;font-size: 11px;">' + msgTime + '</span></p>' +
                                                    '</div>';
                                            } else {
                                                htmlSingleChatList += '<div class="col-md-12" >' +
                                                    '<p style="position: relative;background-color: #999;color: #fff;border-radius: 8px;padding: 6px 16px;width: 50%;margin-left: auto;margin-bottom: 14px;">' + value.message_text + '<span style="display: block; text-align: right;font-size: 11px;">' + msgTime + '</span></p>' +
                                                    '</div>';
                                            }
                                        } else if (value.message_file != null) {
                                            if (value.file_type == "image") {
                                                if (value.sender_id != sessionUserId) {
                                                    htmlSingleChatList += '<div class="col-md-6 hover-show-download " style="border-radius:10px; margin-right: 1px;">' +
                                                        '<img loading="lazy" src="' + baseUrl + '/chats_images/' + value.message_file + '" alt="" class="img-responsive" style="margin-bottom: 10px; padding:10px; background-color: #ef595f; border-radius: 12px;">' +
                                                        '<span class="download-btn" id="spanDownloadHover">' +
                                                        '<a download="' + value.message_file + '" href="' + baseUrl + '/chats_images/' + value.message_file + '" style="color: #fff;"> <i class="fa fa-download" aria-hidden="true"></i></a>' +
                                                        '</span>' +
                                                        '<span style="display: block;text-align: right;font-size: 11px;color: #fff;position: absolute;bottom: 10px;right: 31px;">' + msgTime + '</span>' +
                                                        '</div>';
                                                } else {
                                                    htmlSingleChatList += '<div class="col-md-6 hover-show-download offset-md-6" style="border-radius:10px;" >' +
                                                        '<img loading="lazy" src="' + baseUrl + '/chats_images/' + value.message_file + '" alt="" class="img-responsive" style="margin-bottom: 10px; margin-left: auto; padding:10px; background-color: #000; border-radius: 12px;">' +
                                                        '<span class="download-btn" id="spanDownloadHover">' +
                                                        '<a download="' + value.message_file + '" href="' + baseUrl + '/chats_images/' + value.message_file + '" style="color: #fff;"> <i class="fa fa-download" aria-hidden="true"></i></a>' +
                                                        '</span>' +
                                                        '<span style="display: block;text-align: right;font-size: 11px;color: #fff;position: absolute;bottom: 10px;right: 31px;">' + msgTime + '</span>' +
                                                        '</div>';
                                                }
                                            } else if (value.file_type == "file") {
                                                if (value.sender_id != sessionUserId) {
                                                    htmlSingleChatList += '<div class="col-md-12" >';
                                                    if (value.message_file.split('.')[1] == "pdf") {
                                                        htmlSingleChatList += '<p style="background-color: #ef595f;color: #fff;border-radius: 30px;padding: 6px 16px; width: 50%;"><span><img loading="lazy" src="' + baseUrl + '/img/pdf.png' + '" alt="" style="width: 20px; height: 20px; margin-right: 6px;"></span>';
                                                    } else {
                                                        htmlSingleChatList += '<p style="background-color: #ef595f;color: #fff;border-radius: 30px;padding: 6px 16px; width: 50%;"><span><img loading="lazy" src="' + baseUrl + '/img/doc2.png' + '" alt="" style="width: 20px; height: 20px; margin-right: 6px;"></span>';
                                                    }
                                                    htmlSingleChatList += value.message_file +
                                                        '<span><a download="' + value.message_file + '" href="' + baseUrl + '/chats_images/' + value.message_file + '" style="color: #fff;"><i class="fa fa-download" aria-hidden="true"></i></a>' +
                                                        '</span>' +
                                                        '<span style="display: block; text-align: right;font-size: 11px;">22:38</span></p>' +
                                                        '</div>';
                                                } else {
                                                    htmlSingleChatList += '<div class="col-md-12" >';
                                                    if (value.message_file.split('.')[1] == "pdf") {
                                                        htmlSingleChatList += '<p style="background-color: #000;color: #fff;border-radius: 30px;padding: 6px 16px; width: 50%;margin-left: auto;  margin-bottom: 14px"><span><img loading="lazy" src="' + baseUrl + '/img/pdf.png' + '" alt="" style="width: 20px; height: 20px; margin-right: 6px;"></span>';
                                                    } else {
                                                        htmlSingleChatList += '<p style="background-color: #000;color: #fff;border-radius: 30px;padding: 6px 16px; width: 50%;margin-left: auto;  margin-bottom: 14px"><span><img loading="lazy" src="' + baseUrl + '/img/doc2.png' + '" alt="" style="width: 20px; height: 20px; margin-right: 6px;"></span>';
                                                    }
                                                    htmlSingleChatList += value.message_file +
                                                        '<span><a download="' + value.message_file + '" href="' + baseUrl + '/chats_images/' + value.message_file + '" style="color: #fff;"><i class="fa fa-download" aria-hidden="true"></i></a>' +
                                                        '</span>' +
                                                        '<span style="display: block; text-align: right;font-size: 11px;">22:38</span></p>' +
                                                        '</div>';
                                                }
                                            } else {
                                            }
                                        }
                                    });
                                    $("#singleChatUserDiv").append(htmlSingleChatList);
                                    var textValue = $('#emojionearea4').data("emojioneArea").setText('');
                                }
                            }, error: function () {
                                console.log('error while getting single user chat details');
                            }
                        });
                    } else {

                    }
                }, error: function () {
                    console.log('error while sending text msg on chat.');
                },
                complete: function () {
                    $("#msgSendLoader").css('display', 'none');
                    $("#sendMsgChat").attr('disabled', false);
                }
            });
        }
    });


    function getAllMessageList() {
        if ($('#messageMainModal').is(':visible')) {
            var sessionUserId = '<?php echo (\Auth::user() != null) ? \Auth::user()->id : '';?>';
            // console.log(sessionUserId);
            const baseUrl = '<?php echo url("/")?>';
            $.ajax({
                url: baseUrl + '/get-chat-list/' + sessionUserId,
                type: 'GET',
                dataType: 'json',
                success: function (respo) {

                    $("#chatListDiv").empty();
                    var htmlChatList = '';
                    if (respo == "empty") {
                        $("#messageMainModal modal-body #chatListDiv").append(htmlChatList);
                    } else {
                        $.each(respo, function (index, value) {
                            console.log(value);
                            var relative_time = moment(value.LatestMessageDate).fromNow();
                            if (value.sender_id == sessionUserId && value.sender_delete != "1") {
                                htmlChatList += '<div class="row" id="delete-click-hide-this" style="margin-right: 0; margin-left: 0;">' +
                                    '<div class="chat-col-md-1" style="padding-left: 0; padding-right: 0; text-align: center;">' +
                                    '<div class="chat-checkbox">' +
                                    '<div id="delete-btn-icon" style="z-index: 999;">' +
                                    '<i class="fa fa-trash" aria-hidden="true" id="delete-icon-btn"></i>' +
                                    '</div>' +
                                    '</div>' +
                                    '<div class="conform-delete-div" style="display: none;">' +
                                    '<div class="">' +
                                    '<button id="conform-delete_' + value.chat_id + '_' + sessionUserId + '" class="btn-delete">' +
                                    'delete' +
                                    '</button>' +
                                    '</div>' +
                                    '<div class="" style="margin-top: 14px;"> ' +
                                    '<button id="cencel-delete" class="btn-cencel">' +
                                    'cencel' +
                                    '</button>' +
                                    '</div>' +
                                    '</div>' +
                                    '</div>';
                                htmlChatList += '<div class="chat-col-md-11" style="" id="change-col-class">' +
                                    '<a href="javascript:;" type="button" class="" id="singleUserChat-' + value.chat_id + '" style="display: block; color: #000;">' +
                                    '<div class="row conversation-persons-modal" style="margin-bottom: 14px;">' +
                                    '<div class="col-md-2" style="padding-left: 0; padding-right: 0; text-align: center;">';
                                if (value.senderId == sessionUserId) {
                                    htmlChatList += '<img loading="lazy" src="' + baseUrl + '/avatar/' + value.receiverAvatar + '" alt="" style="width: 60px; border-radius: 50%; height: 60px; margin: 0 auto;">';
                                } else {
                                    htmlChatList += '<img loading="lazy" src="' + baseUrl + '/avatar/' + value.senderAvatar + '" alt="" style="width: 60px; border-radius: 50%; height: 60px; margin: 0 auto;">';
                                }
                                htmlChatList += '</div>' +
                                    '<div class="col-md-7" style="padding-left: 0; padding-right: 0;">';
                                if (value.senderId == sessionUserId) {
                                    if (value.receiverName != "") {
                                        htmlChatList += '<p style="font-weight: bolder;letter-spacing: 1px;">' + value.receiverName + '</p>';
                                    } else {
                                        htmlChatList += '<p style="font-weight: bolder;letter-spacing: 1px;">' + value.receiverUserName + '</p>';
                                    }

                                } else {
                                    if (value.senderName != "") {
                                        htmlChatList += '<p style="font-weight: bolder;letter-spacing: 1px;">' + value.senderName + '</p>';
                                    } else {
                                        htmlChatList += '<p style="font-weight: bolder;letter-spacing: 1px;">' + value.senderUserName + '</p>';
                                    }
                                }
                                if (value.LatestMessage != null) {

                                    htmlChatList += '<p style="font-style: italic;">' + value.LatestMessage + '</p>';
                                } else {
                                    if (value.MessageType == "image") {


                                        htmlChatList += '<p style="font-style: italic;"><img loading="lazy" src="' + baseUrl + '/img/photo.png" alt="" style="width: 20px;">Photo</p>';

                                    } else {

                                        htmlChatList += '<p style="font-style: italic;"><img loading="lazy" src="' + baseUrl + '/img/file.png" alt="" style="width: 20px;">' + value.LatestMessageFile + '</p>';
                                    }
                                }
                                htmlChatList += '</div>' +
                                    '<div class="col-md-3" style="margin-top: 17px;">' +
                                    '<span style="font-size:12px;">' + relative_time + '</span>' +
                                    '</div>' +
                                    '</div>' +
                                    '</a>' +
                                    '</div>';
                            } else if (value.receiver_id == sessionUserId && value.receiver_delete != "1") {
                                htmlChatList += '<div class="row" id="delete-click-hide-this" style="margin-right: 0; margin-left: 0;">' +
                                    '<div class="chat-col-md-1" style="padding-left: 0; padding-right: 0; text-align: center;">' +
                                    '<div class="chat-checkbox">' +
                                    '<div id="delete-btn-icon" style="z-index: 999;">' +
                                    '<i class="fa fa-trash" aria-hidden="true" id="delete-icon-btn"></i>' +
                                    '</div>' +
                                    '</div>' +
                                    '<div class="conform-delete-div" style="display: none;">' +
                                    '<div class="">' +
                                    '<button id="conform-delete_' + value.chat_id + '_' + sessionUserId + '" class="btn-delete">' +
                                    'delete' +
                                    '</button>' +
                                    '</div>' +
                                    '<div class="" style="margin-top: 14px;"> ' +
                                    '<button id="cencel-delete" class="btn-cencel">' +
                                    'cencel' +
                                    '</button>' +
                                    '</div>' +
                                    '</div>' +
                                    '</div>';
                                htmlChatList += '<div class="chat-col-md-11" style="" id="change-col-class">' +
                                    '<a href="javascript:;" type="button" class="" id="singleUserChat-' + value.chat_id + '" style="display: block; color: #000;">' +
                                    '<div class="row conversation-persons-modal" style="margin-bottom: 14px;">' +
                                    '<div class="col-md-2" style="padding-left: 0; padding-right: 0; text-align: center;">';
                                if (value.senderId == sessionUserId) {
                                    htmlChatList += '<img loading="lazy" src="' + baseUrl + '/avatar/' + value.receiverAvatar + '" alt="" style="width: 60px; border-radius: 50%; height: 60px; margin: 0 auto;">';
                                } else {
                                    htmlChatList += '<img loading="lazy" src="' + baseUrl + '/avatar/' + value.senderAvatar + '" alt="" style="width: 60px; border-radius: 50%; height: 60px; margin: 0 auto;">';
                                }
                                htmlChatList += '</div>' +
                                    '<div class="col-md-7" style="padding-left: 0; padding-right: 0;">';
                                if (value.senderId == sessionUserId) {
                                    if (value.receiverName != "") {
                                        htmlChatList += '<p style="font-weight: bolder;letter-spacing: 1px;">' + value.receiverName + '</p>';
                                    } else {
                                        htmlChatList += '<p style="font-weight: bolder;letter-spacing: 1px;">' + value.receiverUserName + '</p>';
                                    }

                                } else {
                                    if (value.senderName != "") {
                                        htmlChatList += '<p style="font-weight: bolder;letter-spacing: 1px;">' + value.senderName + '</p>';
                                    } else {
                                        htmlChatList += '<p style="font-weight: bolder;letter-spacing: 1px;">' + value.senderUserName + '</p>';
                                    }
                                }
                                if (value.LatestMessage != null) {

                                    htmlChatList += '<p style="font-style: italic;">' + value.LatestMessage + '</p>';
                                } else {
                                    if (value.MessageType == "image") {


                                        htmlChatList += '<p style="font-style: italic;"><img loading="lazy" src="' + baseUrl + '/img/photo.png" alt="" style="width: 20px;">Photo</p>';

                                    } else {

                                        htmlChatList += '<p style="font-style: italic;"><img loading="lazy" src="' + baseUrl + '/img/file.png" alt="" style="width: 20px;">' + value.LatestMessageFile + '</p>';
                                    }
                                }
                                htmlChatList += '</div>' +
                                    '<div class="col-md-3" style="margin-top: 17px;">' +
                                    '<span style="font-size:12px;">' + relative_time + '</span>' +
                                    '</div>' +
                                    '</div>' +
                                    '</a>' +
                                    '</div>';
                            }
                        });
                        $("#chatListDiv").append(htmlChatList);
                        // $("#messageMainModal").modal();

                    }
                },
                error: function () {
                    console.log('error while getting chat list when clicked on messager button');
                }
            });
        }
    }

    function getMessageDetails() {
        if ($('#messageMainModal2').is(':visible')) {
            var sessionUserId2 = '<?php echo (\Auth::user() != null) ? \Auth::user()->id : '';?>';
            var name = '<?php echo (\Auth::user() != null) ? \Auth::user()->username : '';?>';
            // var getAttrId = $(this).attr('id').split('-')[1];
            var getAttrId = globalChatID;
            const baseUrl = '<?php echo url("/")?>';
            $.ajax({
                url: baseUrl + '/get-single-chat-details/' + getAttrId,
                type: 'GET',
                'dataType': 'json',
                success: function (resp) {
                    $("#textChatId").val('');
                    $("#textChatId").val(resp[0].chat_id);
                    $("#textUserId").val('');
                    if (resp[0].senderId == sessionUserId2) {
                        htmlHeadhingUserName = '<h5 class="modal-title" id="messageMainModal-2Label"><img loading="lazy" src="" alt=""><img loading="lazy" src="' + baseUrl + '/avatar/' + resp[0].receiverAvatar + '" alt="" style="width: 30px; border-radius: 50%; height: 30px;"> ';
                        if (resp[0].receiverName !== "") {

                            htmlHeadhingUserName += '<span style="font-size: 16px;">' + resp[0].receiverName + '</span>';
                        } else {

                            htmlHeadhingUserName += '<span style="font-size: 16px;">' + resp[0].receiverUserName + '</span>';
                        }
                        htmlHeadhingUserName += '</h5>';
                        $("#textUserId").val(resp[0].receiverId);
                    } else {
                        htmlHeadhingUserName = '<h5 class="modal-title" id="messageMainModal-2Label"><img loading="lazy" src="" alt=""><img loading="lazy" src="' + baseUrl + '/avatar/' + resp[0].senderAvatar + '" alt="" style="width: 30px; border-radius: 50%; height: 30px;"> ';
                        if (resp[0].senderName !== "") {
                            htmlHeadhingUserName += '<span style="font-size: 16px;">' + resp[0].senderName + '</span>';
                        } else {
                            htmlHeadhingUserName += '<span style="font-size: 16px;">' + resp[0].senderUserName + '</span>';
                        }
                        htmlHeadhingUserName += '</h5>';
                        $("#textUserId").val(resp[0].senderId);
                    }

                    $("#textCurrentUserId").val('');
                    $("#textCurrentUserId").val(sessionUserId2);

                    $("#messageMainModal2DivUserNameHeading").empty();
                    $("#messageMainModal2DivUserNameHeading").append(htmlHeadhingUserName);
                    $("#singleChatUserDiv").empty();
                    var htmlSingleChatList = '';
                    if (resp == "empty") {
                        $("#messageMainModal2 modal-body #singleChatUserDiv").append(htmlSingleChatList);
                    } else {
                        var sessionUserId = '<?php echo (\Auth::user() != null) ? \Auth::user()->id : '';?>';

                        $.each(resp, function (index, value) {
                            var msgTime = moment(value.created_at).format('LT');
                            // console.log(value.message_file);
                            // isFileImage(value.message_file);
                            if (value.message_text != null) {
                                if (value.sender_id != sessionUserId) {
                                    htmlSingleChatList += '<div class="col-md-12" >' +
                                        '<p style="position: relative;background-color: #ef595f;color: #fff;border-radius: 30px;padding: 6px 16px; width: 50%; margin-bottom: 14px;">' + value.message_text + '<span style="display: block; text-align: right;font-size: 11px;">' + msgTime + '</span></p>' +
                                        '</div>';
                                } else {
                                    htmlSingleChatList += '<div class="col-md-12" >' +
                                        '<p style="position: relative;background-color: #999;color: #fff;border-radius: 8px;padding: 6px 16px;width: 50%;margin-left: auto;margin-bottom: 14px;">' + value.message_text + '<span style="display: block; text-align: right;font-size: 11px;">' + msgTime + '</span></p>' +
                                        '</div>';
                                }
                            } else if (value.message_file != null) {
                                if (value.file_type == "image") {
                                    if (value.sender_id != sessionUserId) {
                                        htmlSingleChatList += '<div class="col-md-6 hover-show-download " style="border-radius:10px; margin-right: 1px;">' +
                                            '<img loading="lazy" src="' + baseUrl + '/chats_images/' + value.message_file + '" alt="" class="img-responsive" style="margin-bottom: 10px; padding:10px; background-color: #ef595f; border-radius: 12px;">' +
                                            '<span class="download-btn" id="spanDownloadHover">' +
                                            '<a download="' + value.message_file + '" href="' + baseUrl + '/chats_images/' + value.message_file + '" style="color: #fff;"> <i class="fa fa-download" aria-hidden="true"></i></a>' +
                                            '</span>' +
                                            '<span style="display: block;text-align: right;font-size: 11px;color: #fff;position: absolute;bottom: 10px;right: 31px;">' + msgTime + '</span>' +
                                            '</div>';
                                    } else {
                                        htmlSingleChatList += '<div class="col-md-6 hover-show-download offset-md-6" style="border-radius:10px; " >' +
                                            '<img loading="lazy" src="' + baseUrl + '/chats_images/' + value.message_file + '" alt="" class="img-responsive" style="margin-bottom: 10px; margin-left: auto; padding:10px; background-color: #000; border-radius: 12px;">' +
                                            '<span class="download-btn" id="spanDownloadHover">' +
                                            '<a download="' + value.message_file + '" href="' + baseUrl + '/chats_images/' + value.message_file + '" style="color: #fff;"> <i class="fa fa-download" aria-hidden="true"></i></a>' +
                                            '</span>' +
                                            '<span style="display: block;text-align: right;font-size: 11px;color: #fff;position: absolute;bottom: 10px;right: 31px;">' + msgTime + '</span>' +
                                            '</div>';
                                    }
                                } else if (value.file_type == "file") {
                                    if (value.sender_id != sessionUserId) {
                                        htmlSingleChatList += '<div class="col-md-12" >';
                                        if (value.message_file.split('.')[1] == "pdf") {
                                            htmlSingleChatList += '<p style="background-color: #ef595f;color: #fff;border-radius: 30px;padding: 6px 16px; width: 50%;"><span><img loading="lazy" src="' + baseUrl + '/img/pdf.png' + '" alt="" style="width: 20px; height: 20px; margin-right: 6px;"></span>';
                                        } else {
                                            htmlSingleChatList += '<p style="background-color: #ef595f;color: #fff;border-radius: 30px;padding: 6px 16px; width: 50%;"><span><img loading="lazy" src="' + baseUrl + '/img/doc2.png' + '" alt="" style="width: 20px; height: 20px; margin-right: 6px;"></span>';
                                        }
                                        htmlSingleChatList += value.message_file +
                                            '<span><a download="' + value.message_file + '" href="' + baseUrl + '/chats_images/' + value.message_file + '" style="color: #fff;"><i class="fa fa-download" aria-hidden="true"></i></a>' +
                                            '</span>' +
                                            '<span style="display: block; text-align: right;font-size: 11px;">' + msgTime + '</span></p>' +
                                            '</div>';
                                    } else {
                                        htmlSingleChatList += '<div class="col-md-12" >';
                                        if (value.message_file.split('.')[1] == "pdf") {
                                            htmlSingleChatList += '<p style="background-color: #000;color: #fff;border-radius: 30px;padding: 6px 16px; width: 50%;margin-left: auto;  margin-bottom: 14px"><span><img loading="lazy" src="' + baseUrl + '/img/pdf.png' + '" alt="" style="width: 20px; height: 20px; margin-right: 6px;"></span>';
                                        } else {
                                            htmlSingleChatList += '<p style="background-color: #000;color: #fff;border-radius: 30px;padding: 6px 16px; width: 50%;margin-left: auto;  margin-bottom: 14px"><span><img loading="lazy" src="' + baseUrl + '/img/doc2.png' + '" alt="" style="width: 20px; height: 20px; margin-right: 6px;"></span>';
                                        }
                                        htmlSingleChatList += value.message_file +
                                            '<span><a download="' + value.message_file + '" href="' + baseUrl + '/chats_images/' + value.message_file + '" style="color: #fff;"><i class="fa fa-download" aria-hidden="true"></i></a>' +
                                            '</span>' +
                                            '<span style="display: block; text-align: right;font-size: 11px;">' + msgTime + '</span></p>' +
                                            '</div>';
                                    }
                                } else {
                                }
                            }
                        });
                        $("#singleChatUserDiv").append(htmlSingleChatList);
                        // $("#messageMainModal").modal('toggle');
                        // $("#messageMainModal2").modal();
                    }


                }, error: function () {
                    console.log('error while getting single user chat details');
                }
            });
        }
    }

    function getMessageCounters() {
        const baseUrl = '<?php echo url('/') ?>';
        var sessionUId = '<?php echo (\Auth::user() != null) ? \Auth::user()->id : '';?>';
        // console.log(sessionUId);

    }

    window.myVar = setInterval(getAllMessageList, 5000);
    setInterval(getMessageDetails, 5000);
    setInterval(getMessageCounters, 5000);


    function myStopFunction() {
        clearInterval(myVar);
    }

    function myStartFunction() {
        myVar = setInterval(getAllMessageList, 5000);
    }

    $("#file-input").change(function () {
        const baseUrl = '<?php echo url('/'); ?>';
        event.preventDefault();

        var txtChatId = $("#textChatId").val();
        var txtCurrentUserId = $("#textCurrentUserId").val();
        var txtUserId = $("#textUserId").val();

        var fd = new FormData();
        var files = $('#file-input')[0].files;

        // Check file selected or not
        if (files.length > 0) {
            var token = '<?php echo csrf_token() ?>';

            fd.append('file', files[0]);
            fd.append('_token', token);
            fd.append('txtChatId', txtChatId);
            fd.append('txtCurrentUserId', txtCurrentUserId);
            fd.append('txtUserId', txtUserId);

            $.ajax({
                url: baseUrl + '/send-image-file-msg',
                type: 'post',
                data: fd,
                contentType: false,
                processData: false,
                dataType: 'json',
                beforeSend: function () {
                    // Handle the beforeSend event
                    $("#msgSendLoader").css('display', 'block');
                    $("#sendMsgChat").attr('disabled', true);
                },
                success: function (response) {
                    if (response == "true") {
                        const baseUrl = '<?php echo url("/")?>';
                        $.ajax({
                            url: baseUrl + '/get-single-chat-details/' + txtChatId,
                            type: 'GET',
                            'dataType': 'json',
                            success: function (resp) {
                                $("#singleChatUserDiv").empty();
                                var htmlSingleChatList = '';
                                if (resp == "empty") {
                                    $("#singleChatUserDiv").append(htmlSingleChatList);
                                } else {
                                    var sessionUserId = '<?php echo (\Auth::user() != null) ? \Auth::user()->id : '';?>';
                                    $.each(resp, function (index, value) {
                                        var msgTime = moment(value.created_at).format('LT');
                                        // console.log(msgTime);
                                        if (value.message_text != null) {
                                            if (value.sender_id != sessionUserId) {
                                                htmlSingleChatList += '<div class="col-md-12" >' +
                                                    '<p style="position: relative;background-color: #ef595f;color: #fff;border-radius: 30px;padding: 6px 16px; width: 50%; margin-bottom: 14px;">' + value.message_text + '<span>' +
                                                    '</span><span style="display: block; text-align: right;font-size: 11px;">' + msgTime + '</span></p>' +
                                                    '</div>';
                                            } else {
                                                htmlSingleChatList += '<div class="col-md-12" >' +
                                                    '<p style="position: relative;background-color: #999;color: #fff;border-radius: 8px;padding: 6px 16px;width: 50%;margin-left: auto;margin-bottom: 14px;">' + value.message_text + '<span>' +
                                                    '</span><span style="display: block; text-align: right;font-size: 11px;">' + msgTime + '</span></p>' +
                                                    '</div>';
                                            }
                                        } else if (value.message_file != null) {
                                            if (value.file_type == "image") {
                                                if (value.sender_id != sessionUserId) {
                                                    htmlSingleChatList += '<div class="col-md-6 hover-show-download " style="border-radius:10px;">' +
                                                        '<img loading="lazy" src="' + baseUrl + '/chats_images/' + value.message_file + '" alt="" class="img-responsive" style="margin-bottom: 10px; padding:10px; background-color: #000; border-radius: 12px;">' +
                                                        '<span class="download-btn" id="spanDownloadHover">' +
                                                        '<a download="' + value.message_file + '" href="' + baseUrl + '/chats_images/' + value.message_file + '" style="color: #fff;"> <i class="fa fa-download" aria-hidden="true"></i></a>' +
                                                        '</span>' +
                                                        '<span style="display: block;text-align: right;font-size: 11px;color: #fff;position: absolute;bottom: 10px;right: 31px;">' + msgTime + '</span>' +
                                                        '</div>';
                                                } else {
                                                    htmlSingleChatList += '<div class="col-md-6 hover-show-download offset-md-6" style="border-radius:10px;" >' +
                                                        '<img loading="lazy" src="' + baseUrl + '/chats_images/' + value.message_file + '" alt="" class="img-responsive" style="margin-bottom: 10px; margin-left: auto; padding:10px; background-color: #000; border-radius: 12px;">' +
                                                        '<span class="download-btn" id="spanDownloadHover">' +
                                                        '<a download="' + value.message_file + '" href="' + baseUrl + '/chats_images/' + value.message_file + '" style="color: #fff;"> <i class="fa fa-download" aria-hidden="true"></i></a>' +
                                                        '</span>' +
                                                        '<span style="display: block;text-align: right;font-size: 11px;color: #fff;position: absolute;bottom: 10px;right: 31px;">' + msgTime + '</span>' +
                                                        '</div>';
                                                }
                                            } else if (value.file_type == "file") {
                                                if (value.sender_id != sessionUserId) {
                                                    htmlSingleChatList += '<div class="col-md-12" >';
                                                    if (value.message_file.split('.')[1] == "pdf") {
                                                        htmlSingleChatList += '<p style="background-color: #ef595f;color: #fff;border-radius: 30px;padding: 6px 16px; width: 50%;"><span><img loading="lazy" src="' + baseUrl + '/img/pdf.png' + '" alt="" style="width: 20px; height: 20px; margin-right: 6px;"></span>';
                                                    } else {
                                                        htmlSingleChatList += '<p style="background-color: #ef595f;color: #fff;border-radius: 30px;padding: 6px 16px; width: 50%;"><span><img loading="lazy" src="' + baseUrl + '/img/doc2.png' + '" alt="" style="width: 20px; height: 20px; margin-right: 6px;"></span>';
                                                    }
                                                    htmlSingleChatList += value.message_file +
                                                        '<span><a download="' + value.message_file + '" href="' + baseUrl + '/chats_images/' + value.message_file + '" style="color: #fff;"><i class="fa fa-download" aria-hidden="true"></i></a>' +
                                                        '</span>' +
                                                        '<span style="display: block; text-align: right;font-size: 11px;">22:38</span></p>' +
                                                        '</div>';
                                                } else {
                                                    htmlSingleChatList += '<div class="col-md-12" >';
                                                    if (value.message_file.split('.')[1] == "pdf") {
                                                        htmlSingleChatList += '<p style="background-color: #000;color: #fff;border-radius: 30px;padding: 6px 16px; width: 50%;margin-left: auto; margin-bottom: 14px"><span><img loading="lazy" src="' + baseUrl + '/img/pdf.png' + '" alt="" style="width: 20px; height: 20px; margin-right: 6px;"></span>';
                                                    } else {
                                                        htmlSingleChatList += '<p style="background-color: #000;color: #fff;border-radius: 30px;padding: 6px 16px; width: 50%;margin-left: auto;  margin-bottom: 14px"><span><img loading="lazy" src="' + baseUrl + '/img/doc2.png' + '" alt="" style="width: 20px; height: 20px; margin-right: 6px;"></span>';
                                                    }
                                                    htmlSingleChatList += value.message_file +
                                                        '<span><a download="' + value.message_file + '" href="' + baseUrl + '/chats_images/' + value.message_file + '" style="color: #fff;"><i class="fa fa-download" aria-hidden="true"></i></a>' +
                                                        '</span>' +
                                                        '<span style="display: block; text-align: right;font-size: 11px;">22:38</span></p>' +
                                                        '</div>';
                                                }
                                            } else {
                                            }
                                        }
                                    });
                                    $("#singleChatUserDiv").append(htmlSingleChatList);
                                    var textValue = $('#emojionearea4').data("emojioneArea").setText('');
                                }
                            }, error: function () {
                                console.log('error while getting single user chat details');
                            }
                        });
                    } else if (response == "filesize invalid") {
                        $("#errorChatP").text('File size is invalid. Must be less than 5 MB');
                        $("#errorChat").css('display', 'block');
                    }
                }, error: function () {
                    console.log('failed to send file ');
                },
                complete: function () {
                    $("#msgSendLoader").css('display', 'none');
                    $("#sendMsgChat").attr('disabled', false);
                }
            });
        } else {
            alert("Please select a file.");
        }
    });


</script>

<script>

    $(document).ready(function () {


        $("#countryIdbooking").change(function () {
            console.log('ello');
            console.log($(this).val());
            var getCountry = $(this).val();
            //   console.log(getCountry);
            const baseUrl = '<?php echo url("/") ?>';
            $.ajax({
                url: baseUrl + '/get-cities-by-country-id/' + getCountry,
                type: 'get',
                dataType: 'json',
                success: function (resp) {
                    console.log(resp);
                    $("#cityId").empty();
                    var optionCity = '';
                    // cityId
                    optionCity += '<option value="">Select City</option>';
                    $.each(resp, function (key, value) {
                        optionCity += '<option value="' + value.id + '">' + value.name + '</option>';
                    });
                    $("#cityId").append(optionCity);
                    // $("#photographerIdDivv").show();
                },
                error: function () {
                    console.log('error in updating booking status');
                }
            });
        });


        const baseUrl = "<?php echo url('/') ?>";
        $("#cityId").change(function () {
            console.log('city Id ====> ' + $(this).val());
            let getCityId = $(this).val();
            let getPhotoShootId = $("#photoshootId").val();
            $.ajax({
                // url:baseUrl+'/get-artist-by-city/'+ getCityId,
                url: baseUrl + '/get-artist-by-city-photo-shoot/' + getCityId + '/' + getPhotoShootId,
                type: 'get',
                dataType: 'json',
                success: function (res) {
                    $("#photographerId").empty();
                    var optionPhotographer = '';
                    if (res != "not artist found") {
                        optionPhotographer += '<option value="">Select...</option>';
                        $.each(res, function (key, value) {
                            optionPhotographer += '<option value="' + value.id + '">' + value.username + ' ( ' + value.type_name + ' ) ' + '</option>';
                        });
                        $("#photographerId").append(optionPhotographer);
                        $("#photographerIdDivv").show();
                    } else {
                        optionPhotographer += '<option value="">Select...</option>';
                        $("#photographerId").append(optionPhotographer);
                        $("#photographerIdDivv").show();
                    }
                },
                error: function () {
                    console.log('error while getting artist by city ID');
                }
            });
        });

        $("#btnfirstStepOne").click(function () {
            let cityId = $("#cityId").val();
            let photographerId = $("#photographerId").val();
            let datePrefered = $("#DatePrefered").val();
            let timeOfDay = $("#timeOfDay").val();

            if (cityId == "") {
                $("#cityId").css('border-color', 'red');
                $("#errorCityIdDiv").text('This field is required');
                $("#errorCityIdDiv").css('color', 'red');
                setTimeout(function () {
                    $('#cityId').css('border-color', '#ced4da');
                    $('#errorCityIdDiv').text('');
                }, 2000);

            } else if (photographerId == "") {
                $("#photographerId").css('border-color', 'red');
                $("#errorPhotographerIdDiv").text('This field is required');
                $("#errorPhotographerIdDiv").css('color', 'red');
                setTimeout(function () {
                    $('#photographerId').css('border-color', '#ced4da');
                    $('#errorPhotographerIdDiv').text('');
                }, 2000);
            } else if (datePrefered == "") {
                $("#DatePrefered").css('border-color', 'red');
                $("#errorDatePreferedDiv").text('This field is required');
                $("#errorDatePreferedDiv").css('color', 'red');
                setTimeout(function () {
                    $('#DatePrefered').css('border-color', '#ced4da');
                    $('#errorDatePreferedDiv').text('');
                }, 2000);
            } else if (timeOfDay == "") {
                $("#timeOfDay").css('border-color', 'red');
                $("#errorTimeOfDayDiv").text('This field is required');
                $("#errorTimeOfDayDiv").css('color', 'red');
                setTimeout(function () {
                    $('#timeOfDay').css('border-color', '#ced4da');
                    $('#errorTimeOfDayDiv').text('');
                }, 2000);
            } else {
                $("#formStepOne").submit();
            }

        });

        $("#btnSecondStepTwo").click(function () {
            let adultsCount = $("#adultsCounter").val();
            let childrenCount = $("#childrenCounter").val();
            let infantsCount = $("#infantsCounter").val();
            let tripReason = $("#trip_reason").val();
            let package = $("#package").val();

            totalCount = adultsCount + childrenCount + infantsCount;

            if (totalCount <= 0) {
                $("#adultsCounter").css('border-color', 'red');
                $("#childrenCounter").css('border-color', 'red');
                $("#infantsCounter").css('border-color', 'red');
                $("#errorParticipantsDiv").text('Please choose at least one participant');
                $("#errorParticipantsDiv").css('color', 'red');
                Scroll('scrollDivParticipants');
                setTimeout(function () {
                    $('#adultsCounter').css('border-color', '#ced4da');
                    $('#childrenCounter').css('border-color', '#ced4da');
                    $('#infantsCounter').css('border-color', '#ced4da');
                    $('#errorParticipantsDiv').text('');
                }, 3000);

            } else if (tripReason == "") {

                $("#trip_reason").css('border-color', 'red');
                $("#errorTripReasonDiv").text('This field is required');
                $("#errorTripReasonDiv").css('color', 'red');
                Scroll('scrollDivTripReason');
                setTimeout(function () {
                    $('#trip_reason').css('border-color', '#ced4da');
                    $('#errorTripReasonDiv').text('');
                }, 3000);

            } else if (package == "") {

                $("#package").css('border-color', 'red');
                $("#errorPackageDiv").text('This field is required');
                $("#errorPackageDiv").css('color', 'red');
                Scroll('scrollDivPackage');
                setTimeout(function () {
                    $('#package').css('border-color', '#ced4da');
                    $('#errorPackageDiv').text('');
                }, 3000);

            } else {
                $("#formStepTwo").submit();
            }
        });

        $("#btnThirdStepThree").click(function () {
            let routeId = $("#getRouteId").val();
            let describeRoute = $("textarea#txtAreaDescribeRoute").val();
            let meetArtist = $("textarea#txtAreaMeetArtist").val();
            let importantInformation = $("textarea#txtAreaImportantInformation").val();
            let preferred_style_photo = $("#preferred_style_photo").val();
            let level_of_direction = $("#level_of_direction").val();
            var checkRouteDiv = $('div[id^="box-route-custom_"]').length;
            var preferred_style_photoField = $("#preferred_style_photo").length;
            console.log(checkRouteDiv);
            if (checkRouteDiv != 0 && routeId == "") {
                $("#errorRouteDiv").text('This field is required');
                $("#errorRouteDiv").css('color', 'red');
                Scroll('scrollDivRoute');
                setTimeout(function () {
                    $('#errorRouteDiv').text('');
                }, 3000);

            } else if (checkRouteDiv != 0 && routeId == "Custom" && describeRoute == "") {
                $("#errorDescribeRouteDiv").text('This field is required');
                $("#errorDescribeRouteDiv").css('color', 'red');
                Scroll('describeSpecificLocationRouteDiv');
                setTimeout(function () {
                    $('#errorDescribeRouteDiv').text('');
                }, 3000);
            } else if (checkRouteDiv != 0 && routeId == "Custom" && meetArtist == "") {
                $("#errorMeetArtistDiv").text('This field is required');
                $("#errorMeetArtistDiv").css('color', 'red');
                Scroll('addressMeetArtistDiv');
                setTimeout(function () {
                    $('#errorMeetArtistDiv').text('');
                }, 3000);
            } else if (importantInformation == "") {
                $("#errorImportantInformationDiv").text('This field is required');
                $("#errorImportantInformationDiv").css('color', 'red');
                Scroll('scrollDivImportantInformation');
                setTimeout(function () {
                    $('#errorImportantInformationDiv').text('');
                }, 3000);
            } else if (preferred_style_photoField != 0 && preferred_style_photo == "") {
                $("#preferred_style_photo").css('border-color', 'red');
                $("#errorPreferredStylePhotoDiv").text('This field is required');
                $("#errorPreferredStylePhotoDiv").css('color', 'red');
                Scroll('scrollDivPreferredStylePhoto');
                setTimeout(function () {
                    $('#preferred_style_photo').css('border-color', '#ced4da');
                    $('#errorPreferredStylePhotoDiv').text('');
                }, 2000);
            }
                // else if(level_of_direction == ""){
                //     $("#level_of_direction").css('border-color','red');
                //     $("#errorLevelOfDirectionDiv").text('This field is required');
                //     $("#errorLevelOfDirectionDiv").css('color','red');
                //     Scroll('scrollDivLevelOfDirection');
                //     setTimeout(function(){
                //         $('#level_of_direction').css('border-color','#ced4da');
                //         $('#errorLevelOfDirectionDiv').text('');
                //     }, 2000);
            // }
            else {
                // console.log('submit form');
                $("#formStepThree").submit();
            }

        });


        $('.destination-search-multiple').select2();
        $('.js-example-basic-single').select2({
            placeholder: "Select country",
            allowClear: true
        });

        $('.js-example-basic-single-city').select2({
            placeholder: "Select city",
            allowClear: true
        });

        $('.js-example-basic-single-audio-music-type').select2({
            placeholder: "Select Music Type",
            allowClear: true
        });

        $("#containerCalendar").simpleCalendar({

            // called after init
            onInit: function (calendar) {
            },

            // called on month change
            onMonthChange: function (month, year) {
            },

            // called on date selection
            // onDateSelect: function (date, events) {}

        });
        $("#containerCalendar2").simpleCalendar2({

            // called after init
            onInit: function (calendar) {
            },

            // called on month change
            onMonthChange: function (month, year) {
            },

            // called on date selection
            // onDateSelect: function (date, events) {}

        });

        $("#btnPrevBtn").hide();

        $('button[id^="modalLoginReg-"]').click(function () {
            console.log('clicked Modal buttons');
            var value = $(this).attr('id').split('-')[1];
            console.log(value);
            if (value == "createAccount") {
                $("#modalLoginReg-" + value).removeClass('btn-login-register-unactive');
                $("#modalLoginReg-" + value).addClass('btn-login-register-active');
                $("#modalLoginReg-login").removeClass('btn-login-register-active');
                $("#modalLoginReg-login").addClass('btn-login-register-unactive');
                $("#LoginPanel").hide();
                $("#CreateAccountPanel").show();
            } else {
                $("#modalLoginReg-" + value).removeClass('btn-login-register-unactive');
                $("#modalLoginReg-" + value).addClass('btn-login-register-active');
                $("#modalLoginReg-createAccount").removeClass('btn-login-register-active');
                $("#modalLoginReg-createAccount").addClass('btn-login-register-unactive');
                $("#CreateAccountPanel").hide();
                $("#LoginPanel").show();
            }
        });

        $('div[id^="box_photoshoot_type-"]').click(function () {
            $('div[id^="box_photoshoot_type-"]').removeClass("hire-more-active");
            $("#photoshootId").val("");
            let valueDiv = $(this).attr('id').split('-')[1];
            console.log(valueDiv);
            $("#box_photoshoot_type-" + valueDiv).addClass("hire-more-active");
            $("#btnGetStarted").removeClass("button-disabled-custom");

            $("#photoshootId").val(valueDiv);
        });

        $("#btnGetStarted").click(function () {
            let checkSession = "<?php echo \Session::get('user_id'); ?>";
            console.log(checkSession);
        });
    });


    $('.owl-carousel-photographer').owlCarousel({
        loop: false,
        margin: 10,
        nav: false,
        autoplay: true,
        dots: false,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 2
            },
            1000: {
                items: 1.8
            }
        }
    });


    $("#DatePrefered").click(function () {
        $("#Calender2").show();
    });

    $("#DatePrefered").change(function () {
        console.log('cahnge');
    });

    $(document).on('click', 'div[id^="timeDay-"]', function () {
        $('div[id^="timeDay-"]').removeClass('active');
        let getTimeDayId = $(this).attr('id').split('-')[1];
        // console.log(getTimeDayId);
        $("#timeOfDay").val(getTimeDayId);
        $("#timeDay-" + getTimeDayId).addClass('active');
        $("#btnReq").addClass('active-calendar-request-btn');
        $("#btnReq").prop("disabled", false); // Element(s) are now enabled.
    });

    function goBack() {
        window.history.back();
    }

    function Scroll(id) {
        $('html, body').animate({
            scrollTop: $("#" + id).offset().top
        }, 1000);
    }

    // request to book step three page functionality start
    //click event of route detail button click start
    $('div[id^="box-rout-click_"]').click(function () {
        let getId = $(this).attr('id').split('_')[1];
        $(this).hide();
        $("#rout-box-img_" + getId).hide();
        $("#box-content-hidden_" + getId).show();
        $("#box-rout-closebtn_" + getId).show();
    });
    //click event of route detail button click end

    //click event of close route detail button click start
    $('div[id^="box-rout-closebtn_"]').click(function () {
        let getIdCloseBtn = $(this).attr('id').split('_')[1];

        $(this).hide();
        $("#rout-box-img_" + getIdCloseBtn).show();
        $("#box-content-hidden_" + getIdCloseBtn).hide();
        $("#box-rout-click_" + getIdCloseBtn).show();
    });
    //click event of close route detail button click end

    //selecting route on click start
    $('div[id^="box-route-custom_"]').click(function () {
        let valueDiv = $(this).attr('id').split('_')[1];
        if (valueDiv == "Custom") {
            $("#describeSpecificLocationRouteDiv").show();
            $("#addressMeetArtistDiv").show();
        } else {
            $("#describeSpecificLocationRouteDiv").hide();
            $("#addressMeetArtistDiv").hide();
        }

        $('div[id^="box-route-custom_"]').removeClass("hire-more-active-one");
        $("#getRouteId").val("");
        $("#box-route-custom_" + valueDiv).addClass("hire-more-active-one");
        $("#getRouteId").val(valueDiv);
    });
    //selecting route on click end

    // request to book step three page functionality end

    // AOS.init();
    const baseUrl = "<?php echo url('/') ?>";
    $(document).ready(function () {

        $('.js-example-basic-multiple-route').select2();


        $('button[id^="buttonCategories|"]').click(function () {
            var getAttrId = $(this).attr('id');
            var CategorySlug = getAttrId.split('|')[1];
            $(".inside-content-" + CategorySlug).empty();
            $.ajax({
                url: baseUrl + '/get-image-by-category/' + CategorySlug,
                type: 'get',
                beforeSend: function () {
                    var html = '<div class="col-md-4"></div>' +
                        '<div class="col-md-4"><div id="loaderDiv">' +
                        '<img loading="lazy" src="{{{ asset('loader/loader.gif')}}}">' +
                        '</div></div>' +
                        '<div class="col-md-4"></div>';
                    $(".innr-content-" + CategorySlug).html(html);
                },
                success: function (response) {
                    $(".innr-content-" + CategorySlug).html(response);
                },
                complete: function () {
                    // Statement
                    $("#loaderDiv").hide();
                }
            });
        });

        function checkFirstVisit() {
            if (document.cookie.indexOf('mycookie') == -1) {
                // cookie doesn't exist, create it now
                document.cookie = 'mycookie=1';
            } else {
                // not first visit, so alert
                alert('You refreshed!');
            }
        }


        $("#by").change(function () {
            console.log($(this).val());
            var getByValue = $(this).val();

            if (getByValue == "by-industry") {
                $("#artist").hide();
                $("#type").show();
                $("#type").attr("name", "type");
                $("#artist").removeAttr("name");

                $(".select222-icon").select2('destroy');

                $('.select22-icon').select2({
                    minimumResultsForSearch: Infinity,
                    // width: "50%",
                    templateSelection: formatText,
                    templateResult: formatText
                });

                $("#faq33Artist").hide();
                $("#faq22Type").show();
            } else {
                $("#artist").show();
                $("#artist").attr("name", "artist");
                $("#type").removeAttr("name");
                $("#type").hide();

                $(".select22-icon").select2('destroy');
                $('.select222-icon').select2({
                    minimumResultsForSearch: Infinity,
                    // width: "50%",
                    templateSelection: formatText,
                    templateResult: formatText
                });

                $("#faq33Artist").show();
                $("#faq22Type").hide();
                // $.ajax({
                // 	url: baseUrl+'/get-type',
                // 	type: 'get',
                // 	success: function(response){
                // 		console.log(response);
                // 	}
                // });
            }
        });
    });
</script>
<script>
    /* When the user clicks on the button,
			toggle between hiding and showing the dropdown content */
    function myFunction() {
        document.getElementById("myDropdown-one-one").classList.toggle("show-one-one");
    }

    // Close the dropdown if the user clicks outside of it
    window.onclick = function (event) {
        if (!event.target.matches('.dropbtn-one-one')) {
            var dropdowns = document.getElementsByClassName("dropdown-content-one-one");
            var i;
            for (i = 0; i < dropdowns.length; i++) {
                var openDropdown = dropdowns[i];
                if (openDropdown.classList.contains('show-one-one')) {
                    openDropdown.classList.remove('show-one-one');
                }
            }
        }
    }

    $("#countryDestination").change(function () {
        var countryId = $(this).val();
        const baseUrl = "<?php echo url('/') ?>";
        if (countryId !== "") {
            $.ajax({
                url: baseUrl + '/get-cities-by-country-id/' + countryId,
                type: 'get',
                dataType: 'json',
                success: function (res) {
                    $("#cityDestination").empty();
                    console.log(res);
                    var option = "";
                    option += '<option value="">Select City</option>';
                    $.each(res, function (index, value) {
                        // option +='<option value="'+ value.id +'">'+ value.city_name +'</option>';
                        option += '<option value="' + value.id + '">' + value.name + '</option>';
                    });
                    $("#cityDestination").append(option);
                    $("#cityDestination").prop("disabled", false);
                }, error: function () {
                    console.log('in error while getting city by country id destination page search bar ');
                }
            });
        } else {
            $("#cityDestination").empty();
            $("#cityDestination").prop("disabled", true);
        }
    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $("#btnFindSearchDestination").click(function () {
        var countryDest = $("#countryDestination").val();
        var cityDest = $("#cityDestination").val();

        const baseUrl = "<?php echo url('/') ?>";

        $.ajax({
            url: baseUrl + '/search-destinations',
            type: 'POST',
            data: {countryDes: countryDest, cityDes: cityDest},
            dataType: 'json',
            success: function (resp) {
                console.log(resp);
                $("#getRoutesDivDest").empty();
                var htmlDiv = "";
                if (resp.length > 0) {

                    $.each(resp, function (index, value) {
                        //   console.log('ider hu =====> ' +value);
                        htmlDiv += '<div class="col-lg-4 col-md-6 mb-4-cutom">' +
                            '<div class="choose-photographer-box">' +
                            '<div class="pt-4 pb-4 pl-3 pr-3">' +
                            '<div class="">' +
                            '<a data-fancybox href="' + baseUrl + '/avatar/' + value[0].avatar + '">' +
                            '<img loading="lazy" src="' + baseUrl + '/avatar/' + value[0].avatar + '" alt="" class="photographer-thimbnial">' +
                            '</a>' +
                            '<h4 class="title-this-photographer">' + value[0].username + '</h4>' +
                            '<p class="tag-one-photographer">' + value[0].type_name + '</p>' +
                            '<p class="tag-one-photographer" style="    margin-left: 77px;">' + value[0].CountryName + '</p>';

                        if (value[0].user_type_id == "1") {//1 user type photographer
                            htmlDiv += '<div class="mt-4" style="text-align: center;">';
                            if (value[0].img != null) {
                                var splitImgs = value[0].img.split(',');
                                //   for(var i=0; i < splitImgs.length; i++){
                                for (var i = 0; i < 4; i++) {
                                    if (splitImgs[i] != undefined) {
                                        htmlDiv += '<a data-fancybox href="' + baseUrl + '/uploads/preview/' + splitImgs[i] + '">' +
                                            '<img loading="lazy" src="' + baseUrl + '/uploads/preview/' + splitImgs[i] + '" alt="" class="set-img-size">' +
                                            '</a>';
                                    }
                                }
                            }
                            htmlDiv += '</div>';
                        } else if (value[0].user_type_id == "3") {//3 user type videographer
                            htmlDiv += '<div class="mt-4" style="text-align: center;">';
                            if (value[0].vid != null) {
                                var splitVids = value[0].vid.split(',');
                                //   for(var i=0; i < splitImgs.length; i++){
                                for (var i = 0; i < 4; i++) {
                                    if (splitVids[i] != undefined) {
                                        var realFileName = splitVids[i];
                                        //   console.log(realFileName);
                                        var getFileNameScreenShot = splitVids[i].split('.')[0] + '.png';
                                        //   console.log('asd ==>'+ getFileNameScreenShot);
                                        htmlDiv += '<a data-fancybox href="' + baseUrl + '/uploads/video/water_mark_large/watermark-' + realFileName + '">' +
                                            '<img loading="lazy" src="' + baseUrl + '/uploads/video/screen_shot/screen-shot-' + getFileNameScreenShot + '" alt="" class="set-img-size">' +
                                            '</a>';
                                    }
                                }
                            }
                            htmlDiv += '</div>';
                        } else if (value[0].user_type_id == "2") {//2 user type animation
                            htmlDiv += '<div class="mt-4" style="text-align: center;">';
                            if (value[0].ani != null) {
                                var splitAnis = value[0].ani.split(',');
                                //   for(var i=0; i < splitImgs.length; i++){
                                for (var i = 0; i < 4; i++) {
                                    if (splitAnis[i] != undefined) {

                                        var realFileNameAni = splitAnis[i];
                                        //   console.log(realFileNameAni);
                                        var getFileNameScreenShotAni = splitAnis[i].split('.')[0] + '.png';
                                        //   console.log('asd ==>'+ getFileNameScreenShotAni);
                                        htmlDiv += '<a data-fancybox href="' + baseUrl + '/uploads/video/water_mark_large/watermark-' + realFileNameAni + '">' +
                                            '<img loading="lazy" src="' + baseUrl + '/uploads/video/screen_shot/screen-shot-' + getFileNameScreenShotAni + '" alt="" class="set-img-size">' +
                                            '</a>';
                                    }
                                }
                            }
                            htmlDiv += '</div>';
                        } else if (value[0].user_type_id == "4") {//4 user type musician
                            htmlDiv += '<div class="mt-4" style="text-align: center;">';
                            if (value[0].mus != null) {
                                var splitMus = value[0].mus.split(',');
                                //   for(var i=0; i < splitImgs.length; i++){
                                for (var i = 0; i < 1; i++) {
                                    if (splitMus[i] != undefined) {
                                        // htmlDiv +='<div class="qwewave" data-path="' + baseUrl + '/uploads/audio/large/' + splitMus[i] +'">'+
                                        // '<button type="button" id="baton#'+ splitMus[i] + '">Play / Pause</button>'+
                                        //     					   // '<img loading="lazy" src="' + baseUrl + '/uploads/audio/large/' + splitMus[i] +'" alt="" class="set-img-size">'+
                                        //     					    '<div class="wave-container"></div>'+
                                        //         			    '</div>';

                                        htmlDiv += '<div class="qwewave d-flex" data-path="' + baseUrl + '/uploads/audio/large/' + splitMus[i] + '">' +
                                            '<div class="align-self-center music-col-2">' +
                                            '<a href="javascript:;" class="btn-music-play" id="baton-playMusic#' + splitMus[i] + '">' +
                                            '<i class="fas fa-play"></i>' +
                                            '</a>' +
                                            '<a href="javascript:;" class="btn-music-play" id="baton-pauseMusic#' + splitMus[i] + '" style="display: none;">' +
                                            '<i class="fas fa-pause"></i>' +
                                            '</a>' +
                                            '</div>' +

                                            '<div class="wave-container music-col-10"></div>' +
                                            '</div>';
                                    }
                                }
                            } else {
                                htmlDiv += '<p class="dummy-text-when-another-div-empty">No Music Available</p>';
                            }
                            htmlDiv += '</div>';
                        }
                        htmlDiv += '</div>' +
                            '</div>' +
                            '<div class="bottom" style="background-image: url(https://projects.hexawebstudio.com/darquise-nantel/uploads/thumbnail/musicWave.png)">' +
                            '<div class="">' +
                            '<div class="d-md-flex justify-content-center">' +
                            '<a href="' + baseUrl + '/artist/' + value[0].id + '" class="btn-portfolio-one mt-0">Portfolio</a>' +
                            '<a href="' + baseUrl + '/request-to-book?photographerId=' + value[0].id + '&cityId=' + value[0].city_id + '" class="button-book-one">Book artist</a>' +
                            '</div>' +
                            '</div>' +
                            '</div>' +
                            '</div>' +
                            '</div>';


                        // 			htmlDiv += '<div class="col-md-4 mb-4-cutom">'+
                        // 						'<div class="choose-photographer-box">'+
                        // 							'<div class="header-photographer">'+
                        // 								'<div class="row">'+
                        // 									'<div class="col-md-4">'+
                        // 										'<img loading="lazy" src="' + baseUrl + '/avatar/' + value[0].avatar +'" alt="" class="set-img-size">'+
                        // 									'</div>'+
                        // 									'<div class="col-md-7 offset-md-1">'+
                        // 										'<h4 class="title-this">' + value[0].username + '</h4>'+
                        // 											'<p class="tag-one">' + value[0].type_name + '</p>'+
                        // 									'</div>'+
                        // 								'</div>'+
                        // 							'</div>';

                        // 							if(value[0].user_type_id == "1"){
                        // 								htmlDiv +='<div class="bottom" style="background-image: url(' + baseUrl + '/uploads/thumbnail/' + value[0].img + ')">'+
                        // 									'<div class="row">'+
                        // 										'<div class="col-5 offset-7">'+
                        // 											'<a href="' + baseUrl + '/artist/' + value[0].id + '" class="btn-portfolio-one mb-2">Portfolio</a>'+
                        // 											'<a href="' + baseUrl + '/request-to-book?photographerId=' + value[0].id + '&cityId=' + value[0].city_id + '" class="button-book-one mb-2">Book artist</a>'+
                        // 											'<a href="javascript:;" class="button-chat-two" >Chat</a>'+
                        // 										'</div>'+
                        // 									'</div>'+
                        // 								'</div>';
                        // 							}else if(value[0].user_type_id == "3"){
                        // 								htmlDiv +='<div class="bottom" style="background-image: url(' + baseUrl + '/uploads/video/screen_shot/' + value[0].ScreenShot + ')">'+
                        // 									'<div class="row">'+
                        // 										'<div class="col-5 offset-7">'+
                        // 											'<a href="' + baseUrl + '/artist/' + value[0].id + '" class="btn-portfolio-one mb-2">Portfolio</a>'+
                        // 											'<a href="' + baseUrl + '/request-to-book?photographerId=' + value[0].id + '&cityId=' + value[0].city_id+ '" class="button-book-one mb-2">Book artist</a>'+
                        // 											'<a href="javascript:;" class="button-chat-two" >Chat</a>'+
                        // 										'</div>'+
                        // 									'</div>'+
                        // 								'</div>';
                        // 							}else if(value[0].user_type_id == "2"){
                        // 							htmlDiv +='<div class="bottom" style="background-image: url(' + baseUrl + '/uploads/video/screen_shot/' + value[0].ScreenShot + ')">'+
                        // 									'<div class="row">'+
                        // 										'<div class="col-5 offset-7">'+
                        // 											'<a href="' + baseUrl + '/artist/' + value[0].id + '" class="btn-portfolio-one mb-2">Portfolio</a>'+
                        // 											'<a href="' + baseUrl + '/request-to-book?photographerId=' + value[0].id + '&cityId=' + value[0].city_id+ '" class="button-book-one mb-2">Book artist</a>'+
                        // 											'<a href="javascript:;" class="button-chat-two" >Chat</a>'+
                        // 										'</div>'+
                        // 									'</div>'+
                        // 								'</div>';
                        // 							}else if(value[0].user_type_id == "4"){
                        // 							htmlDiv +='<div class="bottom" style="background-image: url(' + baseUrl + '/uploads/thumbnail/musicWave.png'+ ')" >'+
                        // 									'<div class="row">'+
                        // 										'<div class="col-5 offset-7">'+
                        // 											'<a href="' + baseUrl + '/artist/' + value[0].id + '" class="btn-portfolio-one mb-2">Portfolio</a>'+
                        // 											'<a href="' + baseUrl + '/request-to-book?photographerId=' + value[0].id + '&cityId=' + value[0].city_id+ '" class="button-book-one mb-2">Book artist</a>'+
                        // 											'<a href="javascript:;" class="button-chat-two" >Chat</a>'+
                        // 										'</div>'+
                        // 									'</div>'+
                        // 								'</div>';
                        // 							}else{

                        // 							}
                        // 						htmlDiv += '</div>'+
                        // 					'</div>';

                        // '</div>';
                    });
                    $("#getRoutesDivDest").append(htmlDiv);
                    $('html, body').animate({
                        scrollTop: $("#getRoutesDivDest").offset().top
                    }, 1000);

                    $('.qwewave').each(function () {
                        //Generate unic ud
                        var id = '_' + Math.random().toString(36).substr(2, 9);
                        var path = $(this).attr('data-path');
                        console.log($(this).find(".wave-container"));

                        //Set id to container
                        $(this).find(".wave-container").attr("id", id);

                        //Initialize WaveSurfer
                        var wavesurfer = WaveSurfer.create({
                            container: '#' + id,
                            //   waveColor: 'violet',
                            waveColor: '#ef595f',
                            progressColor: '#3A3A3A',
                            backgroundColor: 'transparent',

                            cursorWidth: 2,
                            height: 70
                            //   waveColor: '#ef595f',
                            //   progressColor: '#333333',
                            //   waveColor: 'red',
                            //   backgroundColor: 'transparent',
                            //   barHeight: 2,
                            //   barWidth: 5,
                            //   cursorWidth: 5
                        });

                        //Load audio file
                        wavesurfer.load(path);

                        //Add button event
                        //   $(this).find("button").click(function(){
                        //   	wavesurfer.playPause();
                        //   });

                        // $('button[id^="baton#"]').click(function(){
                        //     wavesurfer.playPause();
                        // });
                        // $('a[id^="baton-playMusic#"]').click(function() {
                        //     wavesurfer.play();
                        //     $(this).hide();
                        //     // $("#pauseMusic").show();
                        //     $("#baton-pauseMusic#"+ dataGet).show();
                        // });
                        // $('a[id^="baton-playMusic#"]').click(function() {
                        var mainDataGet = '';
                        $(document).on('click', 'a[id^="baton-playMusic#"]', function () {
                            var dataGet = $(this).attr('id').split('#')[1];
                            mainDataGet = dataGet;
                            wavesurfer.play();
                            $(this).hide();
                            // $("#pauseMusic").show();
                            // $("#baton-pauseMusic#"+ dataGet).css('display','block');
                            $('a[id^="baton-pauseMusic#' + dataGet + '"]').css('display', 'inline');
                        });
                        // $('a[id^="baton-pauseMusic#"]').click(function() {
                        $(document).on('click', 'a[id^="baton-pauseMusic#"]', function () {
                            var dataGet = $(this).attr('id').split('#')[1];
                            mainDataGet = dataGet;
                            wavesurfer.pause();
                            $(this).hide();
                            $('a[id^="baton-playMusic#' + dataGet + '"]').css('display', 'inline');
                        });

                        wavesurfer.on('finish', function () {
                            $('a[id^="baton-pauseMusic#' + mainDataGet + '"]').css('display', 'none');
                            $('a[id^="baton-playMusic#' + mainDataGet + '"]').css('display', 'inline');
                        });
                    });
                } else {
                    htmlDiv += '<div class="col-md-12" style="padding: 30px;font-size: 25px;text-align: center;border-radius: 12px;color: #ef595f;font-weight: 800;text-transform: uppercase;">Search result not found.</div>';
                    $("#getRoutesDivDest").append(htmlDiv);
                    $('html, body').animate({
                        scrollTop: $("#getRoutesDivDest").offset().top
                    }, 1000);
                }
            },
            error: function () {
                console.log('error while search destination ');
            }
        });
    });


    $("#account_country_id").change(function () {
        var countryId = $(this).val();
        const baseUrl = "<?php echo url('/') ?>";
        if (countryId !== "") {
            $.ajax({
                url: baseUrl + '/get-cities-by-country-id/' + countryId,
                type: 'get',
                dataType: 'json',
                success: function (res) {
                    $("#account_city_id").empty();
                    console.log(res);
                    var option = "";
                    option += '<option value="">Select City</option>';
                    $.each(res, function (index, value) {
                        // option +='<option value="'+ value.id +'">'+ value.city_name +'</option>';
                        option += '<option value="' + value.id + '">' + value.name + '</option>';
                    });
                    $("#account_city_id").append(option);
                    $("#account_city_id").prop("disabled", false);
                }, error: function () {
                    console.log('in error while getting city by country id account setting page ');
                }
            });
        } else {
            $("#account_city_id").empty();
            $("#account_city_id").prop("disabled", true);
        }
    });

    // 		$("#account_city_id").change(function(){
    // 			var cityId = $(this).val();
    // 			console.log(cityId);
    // 			const baseUrl = "<?php echo url('/') ?>";
    // 			if(cityId !== ""){
    // 				$.ajax({
    // 					url: baseUrl + '/get-route-by-city/'+ cityId,
    // 					type: 'get',
    // 					dataType: 'json',
    // 					success:function(res){
    // 						$("#account_route_id").empty();
    // 						console.log(res);
    // 						var option = "";
    // 							option +='<option value="">Select Route</option>';
    // 						$.each(res, function(index, value){
    // 							// option +='<option value="'+ value.id +'">'+ value.city_name +'</option>';
    // 							option +='<option value="'+ value.id +'">'+ value.route_name +'</option>';
    // 						});
    // 						$("#account_route_id").append(option);
    // 						$("#account_route_id").prop("disabled", false);
    // 					},error:function(){
    // 						console.log('in error while getting city by country id account setting page ');
    // 					}
    // 				});
    // 			}else{
    // 				$("#account_route_id").empty();
    // 				$("#account_route_id").prop("disabled", true);
    // 			}
    // 		});

    $('a[id^="countryGet#"]').click(function () {
        var getIdCountry = $(this).attr('id').split('#')[1];
        //   console.log(getIdCountry);
        var text1 = getIdCountry;
        $("#countryDestination option").filter(function () {
            //may want to use $.trim in here
            return $(this).val() == text1;
        }).prop('selected', true);
        $("#btnFindSearchDestination").trigger("click");
    });

</script>

</body>
</html>
