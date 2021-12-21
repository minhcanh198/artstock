<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
  <head>
    <meta charset="UTF-8">
    <meta name="_token" content="{!! csrf_token() !!}"/>
    <title>{{ trans('admin.dashboard') }}</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link href="{{ asset('bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="{{ asset('css/font-awesome.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="{{ asset('fonts/ionicons/css/ionicons.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- App css -->
    <link href="{{ asset('admin/css/app.css')}}" rel="stylesheet" type="text/css" />
    <!-- IcoMoon CSS -->
    <link href="{{ asset('css/icomoon.css') }}" rel="stylesheet">
    <!-- Stroke  CSS -->
    <link href="{{ asset('css/strokeicons.css') }}" rel="stylesheet">

     <!-- Theme style -->
    <link href="{{ asset('admin/css/AdminLTE.min.css')}}" rel="stylesheet" type="text/css" />

    <!-- AdminLTE Skins. Choose a skin from the css/skins
        folder instead of downloading all of them to reduce the load. -->
    <link href="{{ asset('admin/css/skins/skin-blue.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/css/skins/skin-black.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/css/skins/skin-purple.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/css/skins/skin-yellow.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/css/skins/skin-red.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/css/skins/skin-green.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('emojionearea-master/dist/emojionearea.min.css') }}" rel="stylesheet" type="text/css">

    <link rel="shortcut icon" href="{{ URL::asset('img/favicon.png') }}" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />

    <link href='//fonts.googleapis.com/css?family=Montserrat:700' rel='stylesheet' type='text/css'>

    <link href="{{ asset('plugins/sweetalert/sweetalert.css')}}" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    @yield('css')


    <script type="text/javascript">

    // URL BASE
    var URL_BASE = "{{ url('/') }}";

 </script>
  <style>
  .align-self-center {
    align-self: center !important;
}
  .BigwaveCustomer.d-flex {
    display: flex;
    flex-wrap: wrap;
}


  .btn-music-play {
    color: #ef595f;
    border: 1px solid #ef595f;
    padding: 10px 14px;
    transition: 0.5s;
    /* position: absolute; */
    /* left: -50px; */
    /* top: 30%; */
}

.btn-music-play:hover {
    border-color: #000;
    color: #000;
}

.music-col-2 {
    flex: 0 0 10%;
    max-width: 10%;
}

.music-col-10 {
    background: transparent;
    flex: 0 0 83.3333333333%;
    max-width: 83.3333333333%;
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
  #messageMainModal .close-this-modal, #messageMainModal2 .close-this-modal{
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
      border-radius: 28px!important;
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
  .emojionearea.emojionearea-inline>.emojionearea-editor {
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
  .image-upload>input {
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
    -webkit-box-shadow: inset 0 -1px 0 rgba(0,0,0,.15);
    box-shadow: inset 0 -1px 0 rgba(0,0,0,.15);
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
         align-items: center;color: #fff;
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

.chat-col-sm-1 {
  width: 8.33333333%;
  transition: .5s;
}

.chat-col-sm-3{
  width: 25%;
  transition: .5s;
}

.chat-col-sm-9{
  width: 75%;
  transition: .5s
}

.chat-col-sm-11{
  width: 91.66666667%;
  transition: .5s;
}

  /* .emojionearea-editor:not(.inline) {
    min-height: 8em!important;
  } */
  </style>
  </head>
  <!--
  BODY TAG OPTIONS:
  =================
  Apply one or more of the following classes to get the
  desired effect
  |---------------------------------------------------------|
  | SKINS         | skin-blue                               |
  |               | skin-black                              |
  |               | skin-purple                             |
  |               | skin-yellow                             |
  |               | skin-red                                |
  |               | skin-green                              |
  |---------------------------------------------------------|
  |LAYOUT OPTIONS | fixed                                   |
  |               | layout-boxed                            |
  |               | layout-top-nav                          |
  |               | sidebar-collapse                        |
  |               | sidebar-mini                            |
  |---------------------------------------------------------|
  -->
  <body class="skin-green sidebar-mini">
    <div class="wrapper">

      <!-- Main Header -->
      <header class="main-header">

        <!-- Logo -->
        <a href="{{ url('user/dashboard') }}" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b><i class="ion ion-ios-bolt"></i></b></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b><i class="ion ion-ios-bolt"></i> {{ trans('admin.dashboard') }}</b></span>
        </a>

        <!-- Header Navbar -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">

                <?php /* Commented by shahzad?>
            	<li>
            		<!-- <a href="{{ url('/') }}"><i class="glyphicon glyphicon-home myicon-right"></i> {{ trans('misc.go_back_site') }}</a> -->
                <!-- <a href="" type="button" class="" data-toggle="modal" data-target="#messageMainModal">Messenger</a> -->
                <a href="javascript:;" type="button" class="" id="openModalMessageChat">Messenger  <span style="background-color: red;
    border-radius: 50%;
    padding: 2px 7px 2px 7px;" id="spanMessageCounter">0</span></a>
            	</li> <?php */?>
            	<li>
            		<a href="{{ url('/') }}"><i class="glyphicon glyphicon-home myicon-right"></i> {{ trans('misc.go_back_site') }}</a>
            	</li>

              <!-- User Account Menu -->
              <li class="dropdown user user-menu">
                <!-- Menu Toggle Button -->
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <!-- The user image in the navbar-->
                  <img src="{{ asset('avatar').'/'.Auth::user()->avatar }}" class="user-image" alt="User Image" />
                  <!-- hidden-xs hides the username on small devices so only the image appears. -->
                  <span class="hidden-xs">{{ Auth::user()->username }}</span>
                </a>
                <ul class="dropdown-menu">
                  <!-- The user image in the menu -->
                  <li class="user-header">
                    <img src="{{ asset('avatar').'/'.Auth::user()->avatar }}" class="img-circle" alt="User Image" />
                    <p>
                      <small>{{ Auth::user()->username }}</small>
                    </p>
                  </li>

                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="{{ url('account') }}" class="btn btn-default btn-flat">{{ trans('users.account_settings') }}</a>
                    </div>
                    <div class="pull-right">
                      <a href="{{ url('logout') }}" class="btn btn-default btn-flat">{{ trans('users.logout') }}</a>
                    </div>
                  </li>
                </ul>
              </li>

            </ul>
          </div>
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">

        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">

          <!-- Sidebar user panel (optional) -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="{{ asset('avatar').'/'.Auth::user()->avatar }}" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
              <p class="text-overflow">{{ Auth::user()->username }}</p>
              <small class="btn-block text-overflow"><a href="javascript:void(0);"><i class="fa fa-circle text-success"></i> {{ trans('misc.online') }}</a></small>
            </div>
          </div>


          <!-- Sidebar Menu -->
          <ul class="sidebar-menu">

            <li class="header">{{ trans('admin.main_menu') }}</li>

            <!-- Links -->
            <li @if(Request::is('user/dashboard')) class="active" @endif>
            	<a href="{{ url('user/dashboard') }}"><i class="fa fa-dashboard"></i> <span>{{ trans('admin.dashboard') }}</span></a>
            </li><!-- ./Links -->

             <!-- Links -->
           <li @if(Request::is('user/dashboard/my-shoots')) class="active" @endif>
            <a href="{{ url('user/dashboard/my-shoots') }}"><i class="fa fa-list"></i> <span>{{ trans_choice('misc.my_requests',0) }}</span></a>
           </li><!-- ./Links -->

           <!-- Links -->
           <li @if(Request::is('user/dashboard/my-bookings')) class="active" @endif>
            <a href="{{ url('user/dashboard/my-bookings') }}"><i class="fa fa-list"></i> <span>{{ trans_choice('misc.my_clients_requests',0) }}</span></a>
           </li><!-- ./Links -->

           <!-- Links -->
           {{-- <!--<li @if(Request::is('user/dashboard/package')) class="active" @endif>--> --}}
           {{-- <!--    <a href="{{ url('user/dashboard/package') }}"><i class="fa fa-circle-o"></i>My Packages</a>--> --}}
           <!--</li>-->
           <!-- ./Links -->
            @if(Auth::user()->role == "admin" || Auth::user()->user_type_id != "0")
            <!-- Links -->
            <li class="treeview @if( Request::is('user/dashboard/packages') || Request::is('user/dashboard/packages/limits') ) active @endif">
            	<a href="javascript:;"><i class="fa fa-cogs"></i> <span>Packages</span> <i class="fa fa-angle-left pull-right"></i></a>

           		<ul class="treeview-menu">
       		    @if(Auth::user()->role == "admin")
                <li @if(Request::is('user/dashboard/packages/photographer-package')) class="active" @endif><a href="{{ url('user/dashboard/packages/photographer-package') }}"><i class="fa fa-circle-o"></i> Photographer Package</a></li>
                <li @if(Request::is('user/dashboard/packages/videographer-package')) class="active" @endif><a href="{{ url('user/dashboard/packages/videographer-package') }}"><i class="fa fa-circle-o"></i> Videographer Package</a></li>
                <li @if(Request::is('user/dashboard/packages/animator-package')) class="active" @endif><a href="{{ url('user/dashboard/packages/animator-package') }}"><i class="fa fa-circle-o"></i> Animator Package</a></li>
                <li @if(Request::is('user/dashboard/packages/musician-package')) class="active" @endif><a href="{{ url('user/dashboard/packages/musician-package') }}"><i class="fa fa-circle-o"></i> Musician Package</a></li>
                @else
                    <!-- Photographer Type id 1-->
                    @if(Auth::user()->user_type_id == "1")
                    <li @if(Request::is('user/dashboard/packages/photographer-package')) class="active" @endif><a href="{{ url('user/dashboard/packages/photographer-package') }}"><i class="fa fa-circle-o"></i> Photographer Package</a></li>
                    @endif
                    <!-- Animator Type id 2-->
                    @if(Auth::user()->user_type_id == "2")
                    <li @if(Request::is('user/dashboard/packages/animator-package')) class="active" @endif><a href="{{ url('user/dashboard/packages/animator-package') }}"><i class="fa fa-circle-o"></i> Animator Package</a></li>
                    @endif
                    <!-- Videographer Type id 3-->
                    @if(Auth::user()->user_type_id == "3")
                    <li @if(Request::is('user/dashboard/packages/videographer-package')) class="active" @endif><a href="{{ url('user/dashboard/packages/videographer-package') }}"><i class="fa fa-circle-o"></i> Videographer Package</a></li>
                    @endif
                    <!-- Musician Type id 4-->
                    @if(Auth::user()->user_type_id == "4")
                    <li @if(Request::is('user/dashboard/packages/musician-package')) class="active" @endif><a href="{{ url('user/dashboard/packages/musician-package') }}"><i class="fa fa-circle-o"></i> Musician Package</a></li>
                    @endif
                @endif
                <!--<li @if(Request::is('panel/admin/about-page-settings')) class="active" @endif><a href="{{ url('panel/admin/about-page-settings') }}"><i class="fa fa-circle-o"></i> About Us Page</a></li>-->
                <!--<li @if(Request::is('panel/admin/license-page-settings')) class="active" @endif><a href="{{ url('panel/admin/license-page-settings') }}"><i class="fa fa-circle-o"></i> License Page</a></li>-->
                <!--<li @if(Request::is('panel/admin/faq-page-settings')) class="active" @endif><a href="{{ url('panel/admin/faq-page-settings') }}"><i class="fa fa-circle-o"></i> FAQ Page</a></li>-->
                <!--<li @if(Request::is('panel/admin/imprint-page-settings')) class="active" @endif><a href="{{ url('panel/admin/imprint-page-settings') }}"><i class="fa fa-circle-o"></i> Imprint Page</a></li>-->
                <!--<li @if(Request::is('panel/admin/privacy-policy-page-settings')) class="active" @endif><a href="{{ url('panel/admin/privacy-policy-page-settings') }}"><i class="fa fa-circle-o"></i> Privacy Policy Page</a></li>-->
                <!--<li @if(Request::is('panel/admin/terms-page-settings')) class="active" @endif><a href="{{ url('panel/admin/terms-page-settings') }}"><i class="fa fa-circle-o"></i> Terms & Conditions Page</a></li>-->
                <!--<li @if(Request::is('panel/admin/destination-page-settings')) class="active" @endif><a href="{{ url('panel/admin/destination-page-settings') }}"><i class="fa fa-circle-o"></i> Destination Page</a></li>-->
                <!--<li @if(Request::is('panel/admin/destination-page-settings')) class="active" @endif><a href="{{ url('panel/admin/suggest-city-page-settings') }}"><i class="fa fa-circle-o"></i> Request Suggest City Page</a></li>-->
                <!-- <li @if(Request::is('panel/admin/settings/limits')) class="active" @endif><a href="{{ url('panel/admin/settings/limits') }}"><i class="fa fa-circle-o"></i> {{ trans('admin.limits') }}</a></li> -->
              </ul>

            </li><!-- ./Links -->
            @endif


            <!-- Links -->
           <li @if(Request::is('user/dashboard/photos')) class="active" @endif>
            <a href="{{ url('user/dashboard/photos') }}"><i class="fa fa-picture-o"></i> <span>{{ trans_choice('misc.images_plural',0) }}</span></a>
           </li><!-- ./Links -->

           <!-- Links -->
          <li @if(Request::is('user/dashboard/sales')) class="active" @endif>
            <a href="{{ url('user/dashboard/sales') }}"><i class="fa fa-cart-plus"></i> <span>{{ trans('misc.sales') }}</span></a>
          </li><!-- ./Links -->

          <!-- Links -->
         <li @if(Request::is('user/dashboard/purchases')) class="active" @endif>
           <a href="{{ url('user/dashboard/purchases') }}"><i class="icon icon-FullShoppingCart myicon-right"></i> <span>{{ trans('misc.my_purchases') }}</span></a>
         </li><!-- ./Links -->

          <!-- Links -->
         <li @if(Request::is('user/dashboard/deposits')) class="active" @endif>
           <a href="{{ url('user/dashboard/deposits') }}"><i class="ion ion-cash"></i> <span>{{ trans('misc.deposits_history') }}</span></a>
         </li><!-- ./Links -->

         <!-- Links -->
         <li @if(Request::is('user/dashboard/withdrawals')) class="active" @endif>
           <a href="{{ url('user/dashboard/withdrawals') }}"><i class="fa fa-university"></i> <span>{{ trans('misc.withdrawals') }}</span></a>
         </li><!-- ./Links -->

          </ul><!-- /.sidebar-menu -->
        </section>
        <!-- /.sidebar -->
      </aside>

      @yield('content')

      <!-- Main Footer -->
      <footer class="main-footer">
        <!-- Default to the left -->
       &copy; <strong>{{ $settings->title }}</strong> - <?php echo date('Y'); ?>
      </footer>

    </div><!-- ./wrapper -->
    <div class="modal fade" id="flipFlop" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
           <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title" id="modalLabel">Modal Title</h4>
        </div>
        <div class="modal-body">
        Modal content...
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
      </div>
      </div>
    <!--Modal All chat messenger -->
    <div class="modal fade" id="messageMainModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="messageMainModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="height: 470px;overflow: scroll;overflow-x: hidden;">
          <div class="modal-header">
            <div class="d-flex-custom">
              <div class="">
                <h5 class="modal-title" id="messageMainModalLabel">Messenger</h5>
              </div>
              <div class="" style="margin-left: auto; margin-right: 10px;">
                <!-- <div class="dropdown">
                  <button class="dropdown-toggle" type="button" data-toggle="dropdown" style="background-color: transparent; border: 0;     background-color: transparent; border: 0; border-radius: 50%; width: 36px; height: 36px; background-color: rgba(0, 0, 0, .05);
                  opacity: 1; border: 0; display: flex; justify-content: center; align-items: center;"><img src="{{ url('/')}}/public/img/icons8-menu-vertical-30.png" alt="">
                  <span class="caret"></span></button>
                  <ul class="dropdown-menu dropdown-modal-messenger">
                    <li><a href="#">HTML</a></li>
                    <li><a href="#">CSS</a></li>
                    <li><a href="#">JavaScript</a></li>
                  </ul>
                </div> -->
              </div>
              <div >
                <button type="button" class="close-this-modal" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            </div>
            <div class="search-bar-messenger-header">
              <div class="m_search">
                <div class="search_input">
                    <input type="search" class="form-control" id="chat_search" name="search" placeholder="Search for conversations">
                    <i class="fa fa-search" aria-hidden="true"></i>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-body">
            <div class="d-flex-custom conversation-box-modal justify-content-center-custom">
              <div class="">
                <p id="pConversations">All Conversations</p>
              </div>
            </div>
            <div id="chatListDiv">
              <!-- <a href="" type="button" class="" data-toggle="modal" data-target="#messageMainModal2"  style="display: block; color: #000;">
                <div class="row conversation-persons-modal" style="margin-bottom: 14px;">
                  <div class="col-md-2" style="padding-left: 0; padding-right: 0; text-align: center;">
                    <img src="../public/img/dummy-avatar.jpg" alt="" style="width: 60px; border-radius: 50%; height: 60px; margin: 0 auto;">
                  </div>
                  <div class="col-md-8" style="padding-left: 0; padding-right: 0;">
                      <p>User Name</p>
                      <p>Lorem ipsum dolor sit amet consectetur...</p>
                  </div>
                  <div class="col-md-2" style="margin-top: 17px;">
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
    <div class="modal fade" id="messageMainModal2" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="messageMainModal2Label" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="">
          <div class="modal-header">
            <div class="d-flex-custom">
              <input type="text" id="textChatId" name="textChatId" hidden >
              <input type="text" id="textUserId" name="textUserId" hidden >
              <input type="text" id="textCurrentUserId" name="textCurrentUserId" hidden >

              <div class="" id="messageMainModal2DivUserNameHeading">

              </div>
              <div class="" style="margin-left: auto; margin-right: 10px;">
                <!-- <div class="dropdown">
                  <button class="dropdown-toggle" type="button" data-toggle="dropdown" style="background-color: transparent; border: 0;     background-color: transparent; border: 0; border-radius: 50%; width: 36px; height: 36px; background-color: rgba(0, 0, 0, .05);
                  opacity: 1; border: 0; display: flex; justify-content: center; align-items: center;"><img src="{{ url('/') }}/public/img/icons8-menu-vertical-30.png" alt="">

                  <ul class="dropdown-menu dropdown-modal-messenger">
                    <li><a href="#">HTML</a></li>
                    <li><a href="#">CSS</a></li>
                    <li><a href="#">JavaScript</a></li>
                  </ul>
                </div> -->
              </div>
              <div >
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
            <div class="" id="msgSendLoader" style="position: absolute; width:95%; top: 0; left: 0; display:none;">
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
              <div class="col-sm-1"></div>

              <div class="col-sm-9" style="padding-left: 0;padding-right: 0;">
                <div class="span6">
                  <input type="text" id="emojionearea4" name="textboc" value=""/>
                </div>
                <div class="image-upload">
                  <label for="file-input">
                    <i class="fa fa-file-image-o" aria-hidden="true"></i>
                  </label>
                  <input id="file-input" name="chat_file-input" type="file" />
                </div>
              </div>

              <div class="col-sm-1" style="">
                <button id="sendMsgChat" class="enter-chat"><img src="{{ url('/') }}/public/img/email.png" alt="" class="img-responsive" style="width: 17px;"></button>
              </div>
              <div class="col-sm-1"></div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- REQUIRED JS SCRIPTS -->
    @include('includes.javascript_general')


    <!-- FastClick -->
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script> -->
    <script src="{{ asset('emojionearea-master/dist/emojionearea.min.js') }}"></script>
    <script type="text/javascript">
      $(document).ready(function() {
        $("#emojionearea4").emojioneArea({
          pickerPosition: "bottom",
          filtersPosition: "bottom",
          tonesStyle: "checkbox",
          events: {
            keyup: function (editor, event) {
              var keycode = (event.keyCode ? event.keyCode : event.which);
              if(keycode == '13'){
                  $("#sendMsgChat").click();
              }
            }
          }
        });

        // $("#delete-icon-btn").click(function() {
        $(document).on('click', '#delete-icon-btn', function(){

              myStopFunction();
              $(this).parent().parent().hide();
              $(this).parent().parent().siblings(".conform-delete-div").show();
              $(this).parent().parent().parent().addClass("chat-col-sm-3");
              $(this).parent().parent().parent().removeClass("chat-col-sm-1");
              $(this).parent().parent().parent().siblings().children().children().children("#hide-for-gab").hide();
              $(this).parent().parent().parent().siblings("#change-col-class").addClass("chat-col-sm-9");
              $(this).parent().parent().parent().siblings("#change-col-class").removeClass("chat-col-sm-11");
            });

          // $("#conform-delete").click(function() {
          $(document).on('click', 'button[id^="conform-delete_"]', function(){
            var chatId = $(this).attr('id').split('_')[1];
            var sessionUserId = $(this).attr('id').split('_')[2];
            console.log(chatId);
            console.log(sessionUserId);

            const baseUrl = '<?php echo url('/') ?>';

            $.ajax({
              url: baseUrl + '/delete-chat/' + chatId + '/' + sessionUserId,
              type: 'get',
              dataType: 'json',
              success:function(respo){
                if(respo){
                  // console.log(respo);
                  $(this).parent().parent().parent().parent().hide("slide", { direction: "right" }, 1000);
                  myStartFunction();
                }else{
                  myStartFunction();
                  $(this).parent().parent().siblings(".chat-checkbox").show();
                  $(this).parent().parent(".conform-delete-div").hide();
                  $(this).parent().parent().parent().removeClass("chat-col-sm-3");
                  $(this).parent().parent().parent().addClass("chat-col-sm-1");
                  $(this).parent().parent().parent().siblings().children().children().children("#hide-for-gab").show();
                  $(this).parent().parent().parent().siblings("#change-col-class").removeClass("chat-col-sm-9");
                  $(this).parent().parent().parent().siblings("#change-col-class").addClass("chat-col-sm-11");
                }
              },
              error:function(){
                console.log('error while deleting chat ');
              }
            });
            // $(this).parent().parent().parent().parent().parent('row').animate({'line-height':0},1000).hide(1);
            // myStartFunction();
            $(this).parent().parent().parent().parent().hide("slide", { direction: "right" }, 1000);
          });

          // $("#cencel-delete").click(function() {
          $(document).on('click', '#cencel-delete', function(){
            myStartFunction();
            $(this).parent().parent().siblings(".chat-checkbox").show();
            $(this).parent().parent(".conform-delete-div").hide();
            $(this).parent().parent().parent().removeClass("chat-col-sm-3");
            $(this).parent().parent().parent().addClass("chat-col-sm-1");
            $(this).parent().parent().parent().siblings().children().children().children("#hide-for-gab").show();
            $(this).parent().parent().parent().siblings("#change-col-class").removeClass("chat-col-sm-9");
            $(this).parent().parent().parent().siblings("#change-col-class").addClass("chat-col-sm-11");
          });




      });


    </script>
    <script type="text/javascript" src="http://mervick.github.io/lib/google-code-prettify/prettify.js"></script>
    <script src="{{ asset('plugins/fastclick/fastclick.min.js')}}" type="text/javascript"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('admin/js/app.min.js')}}" type="text/javascript"></script>
    <script src="{{ asset('admin/js/functions.js')}}" type="text/javascript"></script>
    <script src="{{ asset('js/moment.min.js')}}" type="text/javascript"></script>

    @yield('javascript')
<script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
<script src="https://unpkg.com/wavesurfer.js"></script>
<script>
            $(document).on('onInit.fb', function (e, instance) {
                if ($('.fancybox-toolbar').find('#rotate_button').length === 0) {
                    $('.fancybox-toolbar').prepend('<button id="rotate_button" class="fancybox-button" title="Rotate Image"><i class="fa fa-repeat"></i></button>');
                }
                var click = 1;
                $('.fancybox-toolbar').on('click', '#rotate_button', function () {
                        var n = 90 * ++click;
                        $('.fancybox-content img').css('webkitTransform', 'rotate(-' + n + 'deg)');
                        $('.fancybox-content img').css('mozTransform', 'rotate(-' + n + 'deg)');
                    });
            });


        </script>
    <script>

        $(document).ready(function(){
            $('.BigwaveCustomer').each(function(){
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
                        var BigMainWaveCustomerData = '';
                        $(document).on('click', 'a[id^="BigbatonCustomer-playMusic#"]', function(){
                            var dataGet = $(this).attr('id').split('#')[1];
                            BigMainWaveCustomerData = dataGet;
                            wavesurfer.play();
                            $(this).hide();
                            // $("#pauseMusic").show();
                            // $("#baton-pauseMusic#"+ dataGet).css('display','block');
                            $('a[id^="BigbatonCustomer-pauseMusic#'+ dataGet +'"]').css('display','inline');
                        });
                        // $('a[id^="baton-pauseMusic#"]').click(function() {
                        $(document).on('click', 'a[id^="BigbatonCustomer-pauseMusic#"]', function(){
                            var dataGet = $(this).attr('id').split('#')[1];
                            BigMainWaveCustomerData = dataGet;
                            wavesurfer.pause();
                            $(this).hide();
                            $('a[id^="BigbatonCustomer-playMusic#'+ dataGet +'"]').css('display','inline');
                        });

                        wavesurfer.on('finish', function () {
                            $('a[id^="BigbatonCustomer-pauseMusic#'+ BigMainWaveCustomerData +'"]').css('display','none');
                            $('a[id^="BigbatonCustomer-playMusic#'+ BigMainWaveCustomerData +'"]').css('display','inline');
                        });
                    });
        });

      $("#openModalMessageChat").click(function(){
          var sessionUserId = '<?php echo \Auth::user()->id;?>';
          // console.log(sessionUserId);
          const baseUrl = '<?php echo url("/")?>';
          $.ajax({
            url: baseUrl + '/get-chat-list/' + sessionUserId,
            type:'GET',
            dataType: 'json',
            success: function(respo){

              $("#chatListDiv").empty();
              var htmlChatList = '';
              if(respo == "empty"){
                $("#messageMainModal modal-body #chatListDiv").append(htmlChatList);
                $("#pConversations").text('No chat with anyone yet.');
                $("#messageMainModal").modal();
              }else{
                $.each(respo, function( index, value ) {
                    var relative_time = moment(value.LatestMessageDate).fromNow();
                    if(value.sender_id == sessionUserId && value.sender_delete != "1"){
                    htmlChatList += '<div class="row" id="delete-click-hide-this" style="margin-right: 0; margin-left: 0;">'+
              '<div class="col-sm-1" style="padding-left: 0; padding-right: 0; text-align: center;">'+
                '<div class="chat-checkbox">'+
                  '<div id="delete-btn-icon" style="z-index: 999;">'+
                    '<i class="fa fa-trash" aria-hidden="true" id="delete-icon-btn"></i>'+
                  '</div>'+
                '</div>'+
                '<div class="conform-delete-div" style="display: none;">'+
                    '<div class="">'+
                      '<button id="conform-delete_'+ value.chat_id +'_'+ sessionUserId +'" class="btn-delete">'+
                      'delete'+
                      '</button>'+
                    '</div>'+
                    '<div class="" style="margin-top: 14px;"> '+
                      '<button id="cencel-delete" class="btn-cencel">'+
                        'cencel'+
                      '</button>'+
                    '</div>'+
                '</div>'+
              '</div>';
              htmlChatList += '<div class="col-sm-11" style="padding-left: 0; padding-right: 0;" id="change-col-class">'+
                    '<a href="javascript:;" type="button" class="" id="singleUserChat-'+ value.chat_id +'" style="display: block; color: #000;">'+
                    '<div class="row conversation-persons-modal" style="margin-bottom: 14px;">'+
                      '<div class="col-md-2" style="padding-left: 0; padding-right: 0; text-align: center;">';
                      if(value.senderId == sessionUserId){
                        htmlChatList +='<img src="'+ baseUrl + '/public/avatar/' + value.receiverAvatar +'" alt="" style="width: 60px; border-radius: 50%; height: 60px; margin: 0 auto;">';
                      }else{
                        htmlChatList +='<img src="'+ baseUrl + '/public/avatar/' + value.senderAvatar +'" alt="" style="width: 60px; border-radius: 50%; height: 60px; margin: 0 auto;">';
                      }
                      htmlChatList +='</div>'+
                      '<div class="col-md-8" style="padding-left: 0; padding-right: 0;">';
                        if(value.senderId == sessionUserId){
                          if(value.receiverName != ""){
                            htmlChatList += '<p style="font-weight: bolder;letter-spacing: 1px;">'+ value.receiverName +'</p>';
                          }else{
                            htmlChatList += '<p style="font-weight: bolder;letter-spacing: 1px;">'+ value.receiverUserName +'</p>';
                          }

                        }else{
                          if(value.senderName != ""){
                            htmlChatList += '<p style="font-weight: bolder;letter-spacing: 1px;">'+ value.senderName +'</p>';
                          }else{
                            htmlChatList += '<p style="font-weight: bolder;letter-spacing: 1px;">'+ value.senderUserName +'</p>';
                          }
                        }
                        if(value.LatestMessage != null){

                          htmlChatList +='<p style="font-style: italic;">' + value.LatestMessage + '</p>';
                        }else{

                          if(value.MessageType == "image"){
                            htmlChatList +='<p style="font-style: italic;"><img src="' + baseUrl + '/public/img/photo.png" alt="" style="width: 20px;">Photo</p>';

                          }else{
                            htmlChatList +='<p style="font-style: italic;"><img src="' + baseUrl + '/public/img/file.png" alt="" style="width: 20px;">'+ value.LatestMessageFile +'</p>';
                          }
                        }
                        htmlChatList += '</div>'+
                      '<div class="col-md-2" style="margin-top: 17px;">'+
                        '<span style="font-size:12px;">'+ relative_time +'</span>'+
                       '</div>'+
                    '</div>'+
                  '</a>'+
                  '</div>';
                      }else if(value.receiver_id == sessionUserId && value.receiver_delete != "1"){
                        htmlChatList += '<div class="row" id="delete-click-hide-this" style="margin-right: 0; margin-left: 0;">'+
              '<div class="col-sm-1" style="padding-left: 0; padding-right: 0; text-align: center;">'+
                '<div class="chat-checkbox">'+
                  '<div id="delete-btn-icon" style="z-index: 999;">'+
                    '<i class="fa fa-trash" aria-hidden="true" id="delete-icon-btn"></i>'+
                  '</div>'+
                '</div>'+
                '<div class="conform-delete-div" style="display: none;">'+
                    '<div class="">'+
                      '<button id="conform-delete_'+ value.chat_id +'_'+ sessionUserId +'" class="btn-delete">'+
                      'delete'+
                      '</button>'+
                    '</div>'+
                    '<div class="" style="margin-top: 14px;"> '+
                      '<button id="cencel-delete" class="btn-cencel">'+
                        'Cancel'+
                      '</button>'+
                    '</div>'+
                '</div>'+
              '</div>';
              htmlChatList += '<div class="col-sm-11" style="padding-left: 0; padding-right: 0;" id="change-col-class">'+
                    '<a href="javascript:;" type="button" class="" id="singleUserChat-'+ value.chat_id +'" style="display: block; color: #000;">'+
                    '<div class="row conversation-persons-modal" style="margin-bottom: 14px;">'+
                      '<div class="col-md-2" style="padding-left: 0; padding-right: 0; text-align: center;">';
                      if(value.senderId == sessionUserId){
                        htmlChatList +='<img src="'+ baseUrl + '/public/avatar/' + value.receiverAvatar +'" alt="" style="width: 60px; border-radius: 50%; height: 60px; margin: 0 auto;">';
                      }else{
                        htmlChatList +='<img src="'+ baseUrl + '/public/avatar/' + value.senderAvatar +'" alt="" style="width: 60px; border-radius: 50%; height: 60px; margin: 0 auto;">';
                      }
                      htmlChatList +='</div>'+
                      '<div class="col-md-8" style="padding-left: 0; padding-right: 0;">';
                        if(value.senderId == sessionUserId){
                          if(value.receiverName != ""){
                            htmlChatList += '<p style="font-weight: bolder;letter-spacing: 1px;">'+ value.receiverName +'</p>';
                          }else{
                            htmlChatList += '<p style="font-weight: bolder;letter-spacing: 1px;">'+ value.receiverUserName +'</p>';
                          }

                        }else{
                          if(value.senderName != ""){
                            htmlChatList += '<p style="font-weight: bolder;letter-spacing: 1px;">'+ value.senderName +'</p>';
                          }else{
                            htmlChatList += '<p style="font-weight: bolder;letter-spacing: 1px;">'+ value.senderUserName +'</p>';
                          }
                        }
                        if(value.LatestMessage != null){

                          htmlChatList +='<p style="font-style: italic;">' + value.LatestMessage + '</p>';
                        }else{

                          if(value.MessageType == "image"){
                            htmlChatList +='<p style="font-style: italic;"><img src="' + baseUrl + '/public/img/photo.png" alt="" style="width: 20px;">Photo</p>';

                          }else{
                            htmlChatList +='<p style="font-style: italic;"><img src="' + baseUrl + '/public/img/file.png" alt="" style="width: 20px;">'+ value.LatestMessageFile +'</p>';
                          }
                        }
                        htmlChatList += '</div>'+
                      '<div class="col-md-2" style="margin-top: 17px;">'+
                        '<span style="font-size:12px;">'+ relative_time +'</span>'+
                       '</div>'+
                    '</div>'+
                  '</a>'+
                  '</div>';
                      }
                });
                $("#chatListDiv").append(htmlChatList);
                $("#messageMainModal").modal();
              }
            },
            error:function(){
              console.log('error while getting chat list when clicked on messager button');
            }
          });
      });

      var globalChatID = "";// for calling function getMessageDetail for every 5 seconds.
      $(document).on('click', 'a[id^="singleUserChat-"]', function(){
        var sessionUserId2 = '<?php echo \Auth::user()->id;?>';
        var name = '<?php echo \Auth::user()->username;?>';
        var getAttrId = $(this).attr('id').split('-')[1];
        globalChatID = getAttrId;
        const baseUrl = '<?php echo url("/")?>';
        $.ajax({
          url: baseUrl +'/get-single-chat-details/'+ getAttrId,
          type:'GET',
          'dataType': 'json',
          success:function(resp){
            $("#textChatId").val('');
            $("#textChatId").val(resp[0].chat_id);
            $("#textUserId").val('');
            if(resp[0].senderId == sessionUserId2){
                htmlHeadhingUserName ='<h5 class="modal-title" id="messageMainModal-2Label"><img src="" alt=""><img src="'+ baseUrl + '/public/avatar/' + resp[0].receiverAvatar +'" alt="" style="width: 30px; border-radius: 50%; height: 30px;"> ';
                if(resp[0].receiverName !== ""){

                  htmlHeadhingUserName +='<span style="font-size: 16px;">'+ resp[0].receiverName +'</span>';
                }else{

                  htmlHeadhingUserName +='<span style="font-size: 16px;">'+ resp[0].receiverUserName +'</span>';
                }
              htmlHeadhingUserName +='</h5>';
              $("#textUserId").val(resp[0].receiverId);
            }else{
              htmlHeadhingUserName ='<h5 class="modal-title" id="messageMainModal-2Label"><img src="" alt=""><img src="'+ baseUrl + '/public/avatar/' + resp[0].senderAvatar +'" alt="" style="width: 30px; border-radius: 50%; height: 30px;"> ';
              if(resp[0].senderName !== ""){
                htmlHeadhingUserName +='<span style="font-size: 16px;">'+ resp[0].senderName +'</span>';
              }else{
                htmlHeadhingUserName +='<span style="font-size: 16px;">'+ resp[0].senderUserName +'</span>';
              }
              htmlHeadhingUserName +='</h5>';
              $("#textUserId").val(resp[0].senderId);
            }

            $("#textCurrentUserId").val('');
            $("#textCurrentUserId").val(sessionUserId2);

            $("#messageMainModal2DivUserNameHeading").empty();
            $("#messageMainModal2DivUserNameHeading").append(htmlHeadhingUserName);
            $("#singleChatUserDiv").empty();
            var htmlSingleChatList = '';
              if(resp == "empty"){
                $("#messageMainModal2 modal-body #singleChatUserDiv").append(htmlSingleChatList);
              }else{
                var sessionUserId = '<?php echo \Auth::user()->id;?>';
                $.each(resp, function( index, value ) {
                  var msgTime = moment(value.created_at).format('LT');
                  // console.log(msgTime);
                  if(value.message_text != null){
                    if(value.sender_id != sessionUserId){
                      htmlSingleChatList += '<div class="col-sm-12" >'+
                                              '<p style="position: relative;background-color: #ef595f;color: #fff;border-radius: 30px;padding: 6px 16px; width: 50%;">'+ value.message_text +'<span style="display: block; text-align: right;font-size: 11px;">'+ msgTime +'</span></p>'+
                                            '</div>';
                    }else{
                      htmlSingleChatList +='<div class="col-sm-12" >'+
                                              '<p style="position: relative;background-color: #999;color: #fff;border-radius: 8px;padding: 6px 16px;width: 50%;margin-left: auto;margin-bottom: 14px;">'+ value.message_text +'<span style="display: block; text-align: right;font-size: 11px;">'+ msgTime +'</span></p>'+
                                            '</div>';
                    }
                  }else if(value.message_file != null){
                    if(value.file_type == "image"){
                      if(value.sender_id != sessionUserId){
                        htmlSingleChatList += '<div class="col-sm-6 hover-show-download " style="border-radius:10px; margin-right: 1px;">'+
                                              '<img src="'+ baseUrl +'/public/chats_images/' + value.message_file + '" alt="" class="img-responsive" style="margin-bottom: 10px; padding:10px; background-color: #ef595f; border-radius: 12px;">'+
                                              '<span class="download-btn" id="spanDownloadHover">'+
                                              '<a download="'+ value.message_file +'" href="' + baseUrl +'/public/chats_images/'+ value.message_file +'" style="color: #fff;"> <i class="fa fa-download" aria-hidden="true"></i></a>'+
                                              '</span>'+
                                              '<span style="display: block;text-align: right;font-size: 11px;color: #fff;position: absolute;bottom: 10px;right: 31px;">'+ msgTime +'</span>'+
                                              '</div>';
                      }else{
                        htmlSingleChatList += '<div class="col-sm-6 hover-show-download col-sm-offset-6" style="border-radius:10px;" >'+
                                              '<img src="'+ baseUrl +'/public/chats_images/' + value.message_file + '" alt="" class="img-responsive" style="margin-bottom: 10px; margin-left: auto; padding:10px; background-color: #000; border-radius: 12px;">'+
                                              '<span class="download-btn" id="spanDownloadHover">'+
                                              '<a download="'+ value.message_file +'" href="' + baseUrl +'/public/chats_images/'+ value.message_file +'" style="color: #fff;"> <i class="fa fa-download" aria-hidden="true"></i></a>'+
                                              '</span>'+
                                              '<span style="display: block;text-align: right;font-size: 11px;color: #fff;position: absolute;bottom: 10px;right: 31px;">'+ msgTime +'</span>'+
                                              '</div>';
                      }
                    }else if(value.file_type == "file"){
                      if(value.sender_id != sessionUserId){
                        htmlSingleChatList += '<div class="col-sm-12" >';
                        if(value.message_file.split('.')[1] == "pdf"){
                          htmlSingleChatList += '<p style="background-color: #ef595f;color: #fff;border-radius: 30px;padding: 6px 16px; width: 50%;"><span><img src="'+ baseUrl +'/public/img/pdf.png'+'" alt="" style="width: 20px; height: 20px; margin-right: 6px;"></span>';
                        }else{
                          htmlSingleChatList += '<p style="background-color: #ef595f;color: #fff;border-radius: 30px;padding: 6px 16px; width: 50%;"><span><img src="'+ baseUrl +'/public/img/doc2.png'+'" alt="" style="width: 20px; height: 20px; margin-right: 6px;"></span>';
                        }
                        htmlSingleChatList  += value.message_file +
                        '<span><a download="'+ value.message_file +'" href="' + baseUrl +'/public/chats_images/'+ value.message_file +'" style="color: #fff;"><i class="fa fa-download" aria-hidden="true"></i></a>'+
                        '</span>'+
                        '<span style="display: block; text-align: right;font-size: 11px;">22:38</span></p>'+
                        '</div>';
                      }else{
                        htmlSingleChatList += '<div class="col-sm-12" >';
                        if(value.message_file.split('.')[1] == "pdf"){
                          htmlSingleChatList +=   '<p style="background-color: #000;color: #fff;border-radius: 30px;padding: 6px 16px; width: 50%;margin-left: auto;"><span><img src="'+ baseUrl +'/public/img/pdf.png'+'" alt="" style="width: 20px; height: 20px; margin-right: 6px;"></span>';
                        }else{
                          htmlSingleChatList +=   '<p style="background-color: #000;color: #fff;border-radius: 30px;padding: 6px 16px; width: 50%;margin-left: auto;"><span><img src="'+ baseUrl +'/public/img/doc2.png'+'" alt="" style="width: 20px; height: 20px; margin-right: 6px;"></span>';
                        }
                        htmlSingleChatList += value.message_file +
                          '<span><a download="'+ value.message_file +'" href="' + baseUrl +'/public/chats_images/'+ value.message_file +'" style="color: #fff;"><i class="fa fa-download" aria-hidden="true"></i></a>'+
                          '</span>'+
                          '<span style="display: block; text-align: right;font-size: 11px;">22:38</span></p>'+
                        '</div>';
                      }
                    }else{}
                  }
                });
                $("#singleChatUserDiv").append(htmlSingleChatList);
                $("#messageMainModal").modal('toggle');
                $("#messageMainModal2").modal();
                // console.log('here');
                $.ajax({
                  url: baseUrl + '/update-unread-message/'+getAttrId + '/' + sessionUserId,
                  type: 'get',
                  datType: 'json',
                  success:function(response){
                    // console.log(response);
                    const baseUrl = '<?php echo url('/') ?>';
                    var sessionUId = '<?php echo \Auth::user()->id;?>';
                    console.log(sessionUId);
                    $.ajax({
                      url: baseUrl + '/get-unread-messages/' + sessionUId,
                      type: 'GET',
                      dataType: 'json',
                      success:function(response){
                        // console.log(response.length);
                        console.log(response);
                        if(response == "empty"){

                          $("#spanMessageCounter").text('0');
                        }else{
                          $("#spanMessageCounter").text(response.length);

                        }

                      },
                      error:function(){

                      }
                    });
                  },
                  error:function(){

                  }
                });
              }


          },error:function(){
            console.log('error while getting single user chat details');
          }
        });
      });

      $('#messageMainModal2').on('hidden.bs.modal', function () {
        $(document.body).css({'padding-right':'0'});
          var sessionUserId = '<?php echo \Auth::user()->id;?>';
          const baseUrl = '<?php echo url("/")?>';
          $.ajax({
            url: baseUrl + '/get-chat-list/' + sessionUserId,
            type:'GET',
            dataType: 'json',
            success: function(respo){

              $("#chatListDiv").empty();
              var htmlChatList = '';
              if(respo == "empty"){
                $("#messageMainModal modal-body #chatListDiv").append(htmlChatList);
              }else{
                $.each(respo, function( index, value ) {
                    var relative_time = moment(value.LatestMessageDate).fromNow();
                    if(value.sender_id == sessionUserId && value.sender_delete != "1"){
                      htmlChatList += '<div class="row" id="delete-click-hide-this" style="margin-right: 0; margin-left: 0;">'+
                        '<div class="col-sm-1" style="padding-left: 0; padding-right: 0; text-align: center;">'+
                          '<div class="chat-checkbox">'+
                            '<div id="delete-btn-icon" style="z-index: 999;">'+
                              '<i class="fa fa-trash" aria-hidden="true" id="delete-icon-btn"></i>'+
                            '</div>'+
                          '</div>'+
                          '<div class="conform-delete-div" style="display: none;">'+
                              '<div class="">'+
                                '<button id="conform-delete_'+ value.chat_id +'_'+ sessionUserId +'" class="btn-delete">'+
                                'delete'+
                                '</button>'+
                              '</div>'+
                              '<div class="" style="margin-top: 14px;"> '+
                                '<button id="cencel-delete" class="btn-cencel">'+
                                  'cencel'+
                                '</button>'+
                              '</div>'+
                          '</div>'+
                        '</div>';
                        htmlChatList += '<div class="col-sm-11" style="padding-left: 0; padding-right: 0;" id="change-col-class">'+
                              '<a href="javascript:;" type="button" class="" id="singleUserChat-'+ value.chat_id +'" style="display: block; color: #000;">'+
                              '<div class="row conversation-persons-modal" style="margin-bottom: 14px;">'+
                                '<div class="col-md-2" style="padding-left: 0; padding-right: 0; text-align: center;">';
                                if(value.senderId == sessionUserId){
                                  htmlChatList +='<img src="'+ baseUrl + '/public/avatar/' + value.receiverAvatar +'" alt="" style="width: 60px; border-radius: 50%; height: 60px; margin: 0 auto;">';
                                }else{
                                  htmlChatList +='<img src="'+ baseUrl + '/public/avatar/' + value.senderAvatar +'" alt="" style="width: 60px; border-radius: 50%; height: 60px; margin: 0 auto;">';
                                }
                                htmlChatList +='</div>'+
                                '<div class="col-md-8" style="padding-left: 0; padding-right: 0;">';
                                  if(value.senderId == sessionUserId){
                                    if(value.receiverName != ""){
                                      htmlChatList += '<p style="font-weight: bolder;letter-spacing: 1px;">'+ value.receiverName +'</p>';
                                    }else{
                                      htmlChatList += '<p style="font-weight: bolder;letter-spacing: 1px;">'+ value.receiverUserName +'</p>';
                                    }

                                  }else{
                                    if(value.senderName != ""){
                                      htmlChatList += '<p style="font-weight: bolder;letter-spacing: 1px;">'+ value.senderName +'</p>';
                                    }else{
                                      htmlChatList += '<p style="font-weight: bolder;letter-spacing: 1px;">'+ value.senderUserName +'</p>';
                                    }
                                  }
                                  if(value.LatestMessage != null){

                                    htmlChatList +='<p style="font-style: italic;">' + value.LatestMessage + '</p>';
                                  }else{
                                      if(value.MessageType == "image"){


                                        htmlChatList +='<p style="font-style: italic;"><img src="' + baseUrl + '/public/img/photo.png" alt="" style="width: 20px;">Photo</p>';

                                      }else{

                                        htmlChatList +='<p style="font-style: italic;"><img src="' + baseUrl + '/public/img/file.png" alt="" style="width: 20px;">'+ value.LatestMessageFile +'</p>';
                                      }
                                  }
                                    htmlChatList += '</div>'+
                                '<div class="col-md-2" style="margin-top: 17px;">'+
                                  '<span style="font-size:12px;">'+ relative_time +'</span>'+
                                '</div>'+
                              '</div>'+
                            '</a>'+
                            '</div>';
                      }else if(value.receiver_id == sessionUserId && value.receiver_id != "1"){
                        htmlChatList += '<div class="row" id="delete-click-hide-this" style="margin-right: 0; margin-left: 0;">'+
                          '<div class="col-sm-1" style="padding-left: 0; padding-right: 0; text-align: center;">'+
                            '<div class="chat-checkbox">'+
                              '<div id="delete-btn-icon" style="z-index: 999;">'+
                                '<i class="fa fa-trash" aria-hidden="true" id="delete-icon-btn"></i>'+
                              '</div>'+
                            '</div>'+
                            '<div class="conform-delete-div" style="display: none;">'+
                                '<div class="">'+
                                  '<button id="conform-delete_'+ value.chat_id +'_'+ sessionUserId +'" class="btn-delete">'+
                                  'delete'+
                                  '</button>'+
                                '</div>'+
                                '<div class="" style="margin-top: 14px;"> '+
                                  '<button id="cencel-delete" class="btn-cencel">'+
                                    'cencel'+
                                  '</button>'+
                                '</div>'+
                            '</div>'+
                          '</div>';
                          htmlChatList += '<div class="col-sm-11" style="padding-left: 0; padding-right: 0;" id="change-col-class">'+
                                '<a href="javascript:;" type="button" class="" id="singleUserChat-'+ value.chat_id +'" style="display: block; color: #000;">'+
                                '<div class="row conversation-persons-modal" style="margin-bottom: 14px;">'+
                                  '<div class="col-md-2" style="padding-left: 0; padding-right: 0; text-align: center;">';
                                  if(value.senderId == sessionUserId){
                                    htmlChatList +='<img src="'+ baseUrl + '/public/avatar/' + value.receiverAvatar +'" alt="" style="width: 60px; border-radius: 50%; height: 60px; margin: 0 auto;">';
                                  }else{
                                    htmlChatList +='<img src="'+ baseUrl + '/public/avatar/' + value.senderAvatar +'" alt="" style="width: 60px; border-radius: 50%; height: 60px; margin: 0 auto;">';
                                  }
                                  htmlChatList +='</div>'+
                                  '<div class="col-md-8" style="padding-left: 0; padding-right: 0;">';
                                    if(value.senderId == sessionUserId){
                                      if(value.receiverName != ""){
                                        htmlChatList += '<p style="font-weight: bolder;letter-spacing: 1px;">'+ value.receiverName +'</p>';
                                      }else{
                                        htmlChatList += '<p style="font-weight: bolder;letter-spacing: 1px;">'+ value.receiverUserName +'</p>';
                                      }

                                    }else{
                                      if(value.senderName != ""){
                                        htmlChatList += '<p style="font-weight: bolder;letter-spacing: 1px;">'+ value.senderName +'</p>';
                                      }else{
                                        htmlChatList += '<p style="font-weight: bolder;letter-spacing: 1px;">'+ value.senderUserName +'</p>';
                                      }
                                    }
                                    if(value.LatestMessage != null){

                                      htmlChatList +='<p style="font-style: italic;">' + value.LatestMessage + '</p>';
                                    }else{
                                        if(value.MessageType == "image"){


                                          htmlChatList +='<p style="font-style: italic;"><img src="' + baseUrl + '/public/img/photo.png" alt="" style="width: 20px;">Photo</p>';

                                        }else{

                                          htmlChatList +='<p style="font-style: italic;"><img src="' + baseUrl + '/public/img/file.png" alt="" style="width: 20px;">'+ value.LatestMessageFile +'</p>';
                                        }
                                    }
                                      htmlChatList += '</div>'+
                                  '<div class="col-md-2" style="margin-top: 17px;">'+
                                    '<span style="font-size:12px;">'+ relative_time +'</span>'+
                                  '</div>'+
                                '</div>'+
                              '</a>'+
                              '</div>';
                      }
                    });
                $("#chatListDiv").append(htmlChatList);
                $("#messageMainModal").modal();
              }
            },
            error:function(){
              console.log('error while getting chat list when clicked on messager button');
            }
          });
      });

      $('#sendMsgChat').click(function(){
        const baseUrl = '<?php echo url("/") ?>';
        // var textValue = $("#emojionearea4").val();
        var textValue = $('#emojionearea4').data("emojioneArea").getText().trim();
        var txtChatId = $("#textChatId").val();
        var txtCurrentUserId = $("#textCurrentUserId").val();
        var txtUserId = $("#textUserId").val();
        if(textValue == "" || textValue == null){

        }else{
            $.ajax({
          url: baseUrl + '/send-text-msg',
          type:'POST',
          dataType: 'json',
          data:{"_token": "{{ csrf_token() }}",'textMsgValue': textValue, 'textChatId': txtChatId, 'textCurrentUserId': txtCurrentUserId, 'textUserId': txtUserId},
          beforeSend: function(){
            // Handle the beforeSend event
            $("#msgSendLoader").css('display','block');
            $("#sendMsgChat").attr('disabled', true);
          },
          success:function(respon){
            if(respon){
              const baseUrl = '<?php echo url("/")?>';
              $.ajax({
                url: baseUrl +'/get-single-chat-details/'+ txtChatId,
                type:'GET',
                'dataType': 'json',
                success:function(resp){
                  $("#singleChatUserDiv").empty();
                  var htmlSingleChatList = '';
                    if(resp == "empty"){
                      $("#singleChatUserDiv").append(htmlSingleChatList);
                    }else{
                      var sessionUserId = '<?php echo \Auth::user()->id;?>';
                      $.each(resp, function( index, value ) {
                        var msgTime = moment(value.created_at).format('LT');
                        // console.log(msgTime);
                        if(value.message_text != null){
                          if(value.sender_id != sessionUserId){
                            htmlSingleChatList += '<div class="col-sm-12" >'+
                                                    '<p style="position: relative;background-color: #ef595f;color: #fff;border-radius: 30px;padding: 6px 16px; width: 50%;">'+ value.message_text +'<span style="display: block; text-align: right;font-size: 11px;">'+ msgTime +'</span></p>'+
                                                  '</div>';
                          }else{
                            htmlSingleChatList +='<div class="col-sm-12" >'+
                                                    '<p style="position: relative;background-color: #999;color: #fff;border-radius: 8px;padding: 6px 16px;width: 50%;margin-left: auto;margin-bottom: 14px;">'+ value.message_text +'<span style="display: block; text-align: right;font-size: 11px;">'+ msgTime +'</span></p>'+
                                                  '</div>';
                          }
                        }else if(value.message_file != null){
                          if(value.file_type == "image"){
                            if(value.sender_id != sessionUserId){
                              htmlSingleChatList += '<div class="col-sm-6 hover-show-download " style="border-radius:10px; margin-right: 1px;">'+
                                                    '<img src="'+ baseUrl +'/public/chats_images/' + value.message_file + '" alt="" class="img-responsive" style="margin-bottom: 10px; padding:10px; background-color: #ef595f; border-radius: 12px;">'+
                                                    '<span class="download-btn" id="spanDownloadHover">'+
                                                    '<a download="'+ value.message_file +'" href="' + baseUrl +'/public/chats_images/'+ value.message_file +'" style="color: #fff;"> <i class="fa fa-download" aria-hidden="true"></i></a>'+
                                                    '</span>'+
                                                    '<span style="display: block;text-align: right;font-size: 11px;color: #fff;position: absolute;bottom: 10px;right: 31px;">'+ msgTime +'</span>'+
                                                    '</div>';
                            }else{
                              htmlSingleChatList += '<div class="col-sm-6 hover-show-download col-sm-offset-6" style="border-radius:10px;" >'+
                                                    '<img src="'+ baseUrl +'/public/chats_images/' + value.message_file + '" alt="" class="img-responsive" style="margin-bottom: 10px; margin-left: auto; padding:10px; background-color: #000; border-radius: 12px;">'+
                                                    '<span class="download-btn" id="spanDownloadHover">'+
                                                    '<a download="'+ value.message_file +'" href="' + baseUrl +'/public/chats_images/'+ value.message_file +'" style="color: #fff;"> <i class="fa fa-download" aria-hidden="true"></i></a>'+
                                                    '</span>'+
                                                    '<span style="display: block;text-align: right;font-size: 11px;color: #fff;position: absolute;bottom: 10px;right: 31px;">'+ msgTime +'</span>'+
                                                    '</div>';
                            }
                          }else if(value.file_type == "file"){
                            if(value.sender_id != sessionUserId){
                              htmlSingleChatList += '<div class="col-sm-12" >';
                              if(value.message_file.split('.')[1] == "pdf"){
                                htmlSingleChatList += '<p style="background-color: #ef595f;color: #fff;border-radius: 30px;padding: 6px 16px; width: 50%;"><span><img src="'+ baseUrl +'/public/img/pdf.png'+'" alt="" style="width: 20px; height: 20px; margin-right: 6px;"></span>';
                              }else{
                                htmlSingleChatList += '<p style="background-color: #ef595f;color: #fff;border-radius: 30px;padding: 6px 16px; width: 50%;"><span><img src="'+ baseUrl +'/public/img/doc2.png'+'" alt="" style="width: 20px; height: 20px; margin-right: 6px;"></span>';
                              }
                              htmlSingleChatList  += value.message_file +
                              '<span><a download="'+ value.message_file +'" href="' + baseUrl +'/public/chats_images/'+ value.message_file +'" style="color: #fff;"><i class="fa fa-download" aria-hidden="true"></i></a>'+
                              '</span>'+
                              '<span style="display: block; text-align: right;font-size: 11px;">22:38</span></p>'+
                              '</div>';
                            }else{
                              htmlSingleChatList += '<div class="col-sm-12" >';
                              if(value.message_file.split('.')[1] == "pdf"){
                                htmlSingleChatList +=   '<p style="background-color: #000;color: #fff;border-radius: 30px;padding: 6px 16px; width: 50%;margin-left: auto;"><span><img src="'+ baseUrl +'/public/img/pdf.png'+'" alt="" style="width: 20px; height: 20px; margin-right: 6px;"></span>';
                              }else{
                                htmlSingleChatList +=   '<p style="background-color: #000;color: #fff;border-radius: 30px;padding: 6px 16px; width: 50%;margin-left: auto;"><span><img src="'+ baseUrl +'/public/img/doc2.png'+'" alt="" style="width: 20px; height: 20px; margin-right: 6px;"></span>';
                              }
                              htmlSingleChatList += value.message_file +
                                '<span><a download="'+ value.message_file +'" href="' + baseUrl +'/public/chats_images/'+ value.message_file +'" style="color: #fff;"><i class="fa fa-download" aria-hidden="true"></i></a>'+
                                '</span>'+
                                '<span style="display: block; text-align: right;font-size: 11px;">22:38</span></p>'+
                              '</div>';
                            }
                          }else{}
                        }
                      });
                      $("#singleChatUserDiv").append(htmlSingleChatList);
                      var textValue = $('#emojionearea4').data("emojioneArea").setText('');
                    }
                },error:function(){
                  console.log('error while getting single user chat details');
                }
              });
            }else{

            }
          },error:function(){
            console.log('error while sending text msg on chat.');
          },
          complete:function(){
            $("#msgSendLoader").css('display','none');
            $("#sendMsgChat").attr('disabled', false);
          }
        });
        }
      });


      function getAllMessageList() {
        if($('#messageMainModal').is(':visible')){
          var sessionUserId = '<?php echo \Auth::user()->id;?>';
          // console.log(sessionUserId);
          const baseUrl = '<?php echo url("/")?>';
          $.ajax({
            url: baseUrl + '/get-chat-list/' + sessionUserId,
            type:'GET',
            dataType: 'json',
            success: function(respo){

              $("#chatListDiv").empty();
              var htmlChatList = '';
              if(respo == "empty"){
                $("#messageMainModal modal-body #chatListDiv").append(htmlChatList);
              }else{
                $.each(respo, function( index, value ) {
                  console.log(value);
                    var relative_time = moment(value.LatestMessageDate).fromNow();
                    if(value.sender_id == sessionUserId && value.sender_delete != "1"){
                    htmlChatList += '<div class="row" id="delete-click-hide-this" style="margin-right: 0; margin-left: 0;">'+
                    '<div class="col-sm-1" style="padding-left: 0; padding-right: 0; text-align: center;">'+
                      '<div class="chat-checkbox">'+
                        '<div id="delete-btn-icon" style="z-index: 999;">'+
                          '<i class="fa fa-trash" aria-hidden="true" id="delete-icon-btn"></i>'+
                        '</div>'+
                      '</div>'+
                      '<div class="conform-delete-div" style="display: none;">'+
                          '<div class="">'+
                            '<button id="conform-delete_'+ value.chat_id +'_'+ sessionUserId +'" class="btn-delete">'+
                            'delete'+
                            '</button>'+
                          '</div>'+
                          '<div class="" style="margin-top: 14px;"> '+
                            '<button id="cencel-delete" class="btn-cencel">'+
                              'cencel'+
                            '</button>'+
                          '</div>'+
                      '</div>'+
                    '</div>';
                    htmlChatList += '<div class="col-sm-11" style="padding-left: 0; padding-right: 0;" id="change-col-class">'+
                          '<a href="javascript:;" type="button" class="" id="singleUserChat-'+ value.chat_id +'" style="display: block; color: #000;">'+
                          '<div class="row conversation-persons-modal" style="margin-bottom: 14px;">'+
                            '<div class="col-md-2" style="padding-left: 0; padding-right: 0; text-align: center;">';
                            if(value.senderId == sessionUserId){
                              htmlChatList +='<img src="'+ baseUrl + '/public/avatar/' + value.receiverAvatar +'" alt="" style="width: 60px; border-radius: 50%; height: 60px; margin: 0 auto;">';
                            }else{
                              htmlChatList +='<img src="'+ baseUrl + '/public/avatar/' + value.senderAvatar +'" alt="" style="width: 60px; border-radius: 50%; height: 60px; margin: 0 auto;">';
                            }
                            htmlChatList +='</div>'+
                            '<div class="col-md-8" style="padding-left: 0; padding-right: 0;">';
                              if(value.senderId == sessionUserId){
                                if(value.receiverName != ""){
                                  htmlChatList += '<p style="font-weight: bolder;letter-spacing: 1px;">'+ value.receiverName +'</p>';
                                }else{
                                  htmlChatList += '<p style="font-weight: bolder;letter-spacing: 1px;">'+ value.receiverUserName +'</p>';
                                }

                              }else{
                                if(value.senderName != ""){
                                  htmlChatList += '<p style="font-weight: bolder;letter-spacing: 1px;">'+ value.senderName +'</p>';
                                }else{
                                  htmlChatList += '<p style="font-weight: bolder;letter-spacing: 1px;">'+ value.senderUserName +'</p>';
                                }
                              }
                              if(value.LatestMessage != null){

                                htmlChatList +='<p style="font-style: italic;">' + value.LatestMessage + '</p>';
                              }else{
                                if(value.MessageType == "image"){


                                  htmlChatList +='<p style="font-style: italic;"><img src="' + baseUrl + '/public/img/photo.png" alt="" style="width: 20px;">Photo</p>';

                                }else{

                                  htmlChatList +='<p style="font-style: italic;"><img src="' + baseUrl + '/public/img/file.png" alt="" style="width: 20px;">'+ value.LatestMessageFile +'</p>';
                                }
                              }
                            htmlChatList += '</div>'+
                            '<div class="col-md-2" style="margin-top: 17px;">'+
                              '<span style="font-size:12px;">'+ relative_time +'</span>'+
                            '</div>'+
                          '</div>'+
                        '</a>'+
                        '</div>';
                            }else if(value.receiver_id == sessionUserId && value.receiver_delete != "1"){
                              htmlChatList += '<div class="row" id="delete-click-hide-this" style="margin-right: 0; margin-left: 0;">'+
                    '<div class="col-sm-1" style="padding-left: 0; padding-right: 0; text-align: center;">'+
                      '<div class="chat-checkbox">'+
                        '<div id="delete-btn-icon" style="z-index: 999;">'+
                          '<i class="fa fa-trash" aria-hidden="true" id="delete-icon-btn"></i>'+
                        '</div>'+
                      '</div>'+
                      '<div class="conform-delete-div" style="display: none;">'+
                          '<div class="">'+
                            '<button id="conform-delete_'+ value.chat_id +'_'+ sessionUserId +'" class="btn-delete">'+
                            'delete'+
                            '</button>'+
                          '</div>'+
                          '<div class="" style="margin-top: 14px;"> '+
                            '<button id="cencel-delete" class="btn-cencel">'+
                              'cencel'+
                            '</button>'+
                          '</div>'+
                      '</div>'+
                    '</div>';
                    htmlChatList += '<div class="col-sm-11" style="padding-left: 0; padding-right: 0;" id="change-col-class">'+
                          '<a href="javascript:;" type="button" class="" id="singleUserChat-'+ value.chat_id +'" style="display: block; color: #000;">'+
                          '<div class="row conversation-persons-modal" style="margin-bottom: 14px;">'+
                            '<div class="col-md-2" style="padding-left: 0; padding-right: 0; text-align: center;">';
                            if(value.senderId == sessionUserId){
                              htmlChatList +='<img src="'+ baseUrl + '/public/avatar/' + value.receiverAvatar +'" alt="" style="width: 60px; border-radius: 50%; height: 60px; margin: 0 auto;">';
                            }else{
                              htmlChatList +='<img src="'+ baseUrl + '/public/avatar/' + value.senderAvatar +'" alt="" style="width: 60px; border-radius: 50%; height: 60px; margin: 0 auto;">';
                            }
                            htmlChatList +='</div>'+
                            '<div class="col-md-8" style="padding-left: 0; padding-right: 0;">';
                              if(value.senderId == sessionUserId){
                                if(value.receiverName != ""){
                                  htmlChatList += '<p style="font-weight: bolder;letter-spacing: 1px;">'+ value.receiverName +'</p>';
                                }else{
                                  htmlChatList += '<p style="font-weight: bolder;letter-spacing: 1px;">'+ value.receiverUserName +'</p>';
                                }

                              }else{
                                if(value.senderName != ""){
                                  htmlChatList += '<p style="font-weight: bolder;letter-spacing: 1px;">'+ value.senderName +'</p>';
                                }else{
                                  htmlChatList += '<p style="font-weight: bolder;letter-spacing: 1px;">'+ value.senderUserName +'</p>';
                                }
                              }
                              if(value.LatestMessage != null){

                                htmlChatList +='<p style="font-style: italic;">' + value.LatestMessage + '</p>';
                              }else{
                                if(value.MessageType == "image"){


                                  htmlChatList +='<p style="font-style: italic;"><img src="' + baseUrl + '/public/img/photo.png" alt="" style="width: 20px;">Photo</p>';

                                }else{

                                  htmlChatList +='<p style="font-style: italic;"><img src="' + baseUrl + '/public/img/file.png" alt="" style="width: 20px;">'+ value.LatestMessageFile +'</p>';
                                }
                              }
                            htmlChatList += '</div>'+
                            '<div class="col-md-2" style="margin-top: 17px;">'+
                              '<span style="font-size:12px;">'+ relative_time +'</span>'+
                            '</div>'+
                          '</div>'+
                        '</a>'+
                        '</div>';
                      }
                });
                $("#chatListDiv").append(htmlChatList);
                // $("#messageMainModal").modal();

              }
            },
            error:function(){
              console.log('error while getting chat list when clicked on messager button');
            }
          });
        }
      }

      function getMessageDetails() {
        if($('#messageMainModal2').is(':visible')){
          var sessionUserId2 = '<?php echo \Auth::user()->id;?>';
          var name = '<?php echo \Auth::user()->username;?>';
          // var getAttrId = $(this).attr('id').split('-')[1];
          var getAttrId = globalChatID;
          const baseUrl = '<?php echo url("/")?>';
          $.ajax({
            url: baseUrl +'/get-single-chat-details/'+ getAttrId,
            type:'GET',
            'dataType': 'json',
            success:function(resp){
              $("#textChatId").val('');
              $("#textChatId").val(resp[0].chat_id);
              $("#textUserId").val('');
              if(resp[0].senderId == sessionUserId2){
                  htmlHeadhingUserName ='<h5 class="modal-title" id="messageMainModal-2Label"><img src="" alt=""><img src="'+ baseUrl + '/public/avatar/' + resp[0].receiverAvatar +'" alt="" style="width: 30px; border-radius: 50%; height: 30px;"> ';
                  if(resp[0].receiverName !== ""){

                    htmlHeadhingUserName +='<span style="font-size: 16px;">'+ resp[0].receiverName +'</span>';
                  }else{

                    htmlHeadhingUserName +='<span style="font-size: 16px;">'+ resp[0].receiverUserName +'</span>';
                  }
                htmlHeadhingUserName +='</h5>';
                $("#textUserId").val(resp[0].receiverId);
              }else{
                htmlHeadhingUserName ='<h5 class="modal-title" id="messageMainModal-2Label"><img src="" alt=""><img src="'+ baseUrl + '/public/avatar/' + resp[0].senderAvatar +'" alt="" style="width: 30px; border-radius: 50%; height: 30px;"> ';
                if(resp[0].senderName !== ""){
                  htmlHeadhingUserName +='<span style="font-size: 16px;">'+ resp[0].senderName +'</span>';
                }else{
                  htmlHeadhingUserName +='<span style="font-size: 16px;">'+ resp[0].senderUserName +'</span>';
                }
                htmlHeadhingUserName +='</h5>';
                $("#textUserId").val(resp[0].senderId);
              }

              $("#textCurrentUserId").val('');
              $("#textCurrentUserId").val(sessionUserId2);

              $("#messageMainModal2DivUserNameHeading").empty();
              $("#messageMainModal2DivUserNameHeading").append(htmlHeadhingUserName);
              $("#singleChatUserDiv").empty();
              var htmlSingleChatList = '';
                if(resp == "empty"){
                  $("#messageMainModal2 modal-body #singleChatUserDiv").append(htmlSingleChatList);
                }else{
                  var sessionUserId = '<?php echo \Auth::user()->id;?>';

                  $.each(resp, function( index, value ) {
                    var msgTime = moment(value.created_at).format('LT');
                    // console.log(value.message_file);
                    // isFileImage(value.message_file);
                    if(value.message_text != null){
                      if(value.sender_id != sessionUserId){
                        htmlSingleChatList += '<div class="col-sm-12" >'+
                                                '<p style="position: relative;background-color: #ef595f;color: #fff;border-radius: 30px;padding: 6px 16px; width: 50%;">'+ value.message_text +'<span style="display: block; text-align: right;font-size: 11px;">'+ msgTime +'</span></p>'+
                                              '</div>';
                      }else{
                        htmlSingleChatList +='<div class="col-sm-12" >'+
                                                '<p style="position: relative;background-color: #999;color: #fff;border-radius: 8px;padding: 6px 16px;width: 50%;margin-left: auto;margin-bottom: 14px;">'+ value.message_text +'<span style="display: block; text-align: right;font-size: 11px;">'+ msgTime +'</span></p>'+
                                              '</div>';
                      }
                    }else if(value.message_file != null){
                      if(value.file_type == "image"){
                        if(value.sender_id != sessionUserId){
                          htmlSingleChatList += '<div class="col-sm-6 hover-show-download " style="border-radius:10px; margin-right: 1px;">'+
                                                '<img src="'+ baseUrl +'/public/chats_images/' + value.message_file + '" alt="" class="img-responsive" style="margin-bottom: 10px; padding:10px; background-color: #ef595f; border-radius: 12px;">'+
                                                '<span class="download-btn" id="spanDownloadHover">'+
                                                '<a download="'+ value.message_file +'" href="' + baseUrl +'/public/chats_images/'+ value.message_file +'" style="color: #fff;"> <i class="fa fa-download" aria-hidden="true"></i></a>'+
                                                '</span>'+
                                                '<span style="display: block;text-align: right;font-size: 11px;color: #fff;position: absolute;bottom: 10px;right: 31px;">'+ msgTime +'</span>'+
                                                '</div>';
                        }else{
                          htmlSingleChatList += '<div class="col-sm-6 hover-show-download col-sm-offset-6" style="border-radius:10px; " >'+
                                                '<img src="'+ baseUrl +'/public/chats_images/' + value.message_file + '" alt="" class="img-responsive" style="margin-bottom: 10px; margin-left: auto; padding:10px; background-color: #000; border-radius: 12px;">'+
                                                '<span class="download-btn" id="spanDownloadHover">'+
                                                '<a download="'+ value.message_file +'" href="' + baseUrl +'/public/chats_images/'+ value.message_file +'" style="color: #fff;"> <i class="fa fa-download" aria-hidden="true"></i></a>'+
                                                '</span>'+
                                                '<span style="display: block;text-align: right;font-size: 11px;color: #fff;position: absolute;bottom: 10px;right: 31px;">'+ msgTime +'</span>'+
                                                '</div>';
                        }
                      }else if(value.file_type == "file"){
                        if(value.sender_id != sessionUserId){
                          htmlSingleChatList += '<div class="col-sm-12" >';
                          if(value.message_file.split('.')[1] == "pdf"){
                            htmlSingleChatList += '<p style="background-color: #ef595f;color: #fff;border-radius: 30px;padding: 6px 16px; width: 50%;"><span><img src="'+ baseUrl +'/public/img/pdf.png'+'" alt="" style="width: 20px; height: 20px; margin-right: 6px;"></span>';
                          }else{
                            htmlSingleChatList += '<p style="background-color: #ef595f;color: #fff;border-radius: 30px;padding: 6px 16px; width: 50%;"><span><img src="'+ baseUrl +'/public/img/doc2.png'+'" alt="" style="width: 20px; height: 20px; margin-right: 6px;"></span>';
                          }
                          htmlSingleChatList  += value.message_file +
                          '<span><a download="'+ value.message_file +'" href="' + baseUrl +'/public/chats_images/'+ value.message_file +'" style="color: #fff;"><i class="fa fa-download" aria-hidden="true"></i></a>'+
                          '</span>'+
                          '<span style="display: block; text-align: right;font-size: 11px;">'+ msgTime +'</span></p>'+
                          '</div>';
                        }else{
                          htmlSingleChatList += '<div class="col-sm-12" >';
                          if(value.message_file.split('.')[1] == "pdf"){
                            htmlSingleChatList +=   '<p style="background-color: #000;color: #fff;border-radius: 30px;padding: 6px 16px; width: 50%;margin-left: auto;"><span><img src="'+ baseUrl +'/public/img/pdf.png'+'" alt="" style="width: 20px; height: 20px; margin-right: 6px;"></span>';
                          }else{
                            htmlSingleChatList +=   '<p style="background-color: #000;color: #fff;border-radius: 30px;padding: 6px 16px; width: 50%;margin-left: auto;"><span><img src="'+ baseUrl +'/public/img/doc2.png'+'" alt="" style="width: 20px; height: 20px; margin-right: 6px;"></span>';
                          }
                          htmlSingleChatList += value.message_file +
                            '<span><a download="'+ value.message_file +'" href="' + baseUrl +'/public/chats_images/'+ value.message_file +'" style="color: #fff;"><i class="fa fa-download" aria-hidden="true"></i></a>'+
                            '</span>'+
                            '<span style="display: block; text-align: right;font-size: 11px;">'+ msgTime +'</span></p>'+
                          '</div>';
                        }
                      }else{}
                    }
                  });
                  $("#singleChatUserDiv").append(htmlSingleChatList);
                  // $("#messageMainModal").modal('toggle');
                  // $("#messageMainModal2").modal();

                  $.ajax({
                  url: baseUrl + '/update-unread-message/'+getAttrId + '/' + sessionUserId,
                  type: 'get',
                  datType: 'json',
                  success:function(response){
                    // console.log(response);
                    const baseUrl = '<?php echo url('/') ?>';
                    var sessionUId = '<?php echo \Auth::user()->id;?>';
                    console.log(sessionUId);
                    $.ajax({
                      url: baseUrl + '/get-unread-messages/' + sessionUId,
                      type: 'GET',
                      dataType: 'json',
                      success:function(response){
                        // console.log(response.length);
                        if(response == "empty"){

                          $("#spanMessageCounter").text('0');
                        }else{
                          $("#spanMessageCounter").text(response.length);

                        }

                      },
                      error:function(){

                      }
                    });
                  },
                  error:function(){

                  }
                });

                }


            },error:function(){
              console.log('error while getting single user chat details');
            }
          });
        }
      }

      function getMessageCounters(){
        const baseUrl = '<?php echo url('/') ?>';
        var sessionUId = '<?php echo \Auth::user()->id;?>';
        // console.log(sessionUId);
        $.ajax({
          url: baseUrl + '/get-unread-messages/' + sessionUId,
          type: 'GET',
          dataType: 'json',
          success:function(response){
            // console.log(response.length);
            if(response == "empty"){

              $("#spanMessageCounter").text('0');
            }else{
              $("#spanMessageCounter").text(response.length);

            }

          },
          error:function(){

          }
        });
      }

      window.myVar = setInterval(getAllMessageList, 5000);
      setInterval(getMessageDetails, 5000);
      setInterval(getMessageCounters, 5000);


      function myStopFunction() {
        clearInterval(myVar);
      }

      function myStartFunction(){
        myVar = setInterval(getAllMessageList, 5000);
      }


      $("#file-input").change(function(){
        const baseUrl = '<?php echo url('/'); ?>';
        event.preventDefault();

        var txtChatId = $("#textChatId").val();
        var txtCurrentUserId = $("#textCurrentUserId").val();
        var txtUserId = $("#textUserId").val();

        var fd = new FormData();
        var files = $('#file-input')[0].files;

        // Check file selected or not
        if(files.length > 0 ){
          var token = '<?php echo csrf_token() ?>';

           fd.append('file',files[0]);
           fd.append('_token',token);
           fd.append('txtChatId',txtChatId);
           fd.append('txtCurrentUserId',txtCurrentUserId);
           fd.append('txtUserId',txtUserId);

           $.ajax({
              url: baseUrl +'/send-image-file-msg',
              type: 'post',
              data: fd,
              contentType: false,
              processData: false,
              dataType:'json',
              beforeSend: function(){
                // Handle the beforeSend event
                $("#msgSendLoader").css('display','block');
                $("#sendMsgChat").attr('disabled', true);
              },
              success: function(response){
                if(response == "true"){
                  const baseUrl = '<?php echo url("/")?>';
                  $.ajax({
                    url: baseUrl +'/get-single-chat-details/'+ txtChatId,
                    type:'GET',
                    'dataType': 'json',
                    success:function(resp){
                      $("#singleChatUserDiv").empty();
                      var htmlSingleChatList = '';
                        if(resp == "empty"){
                          $("#singleChatUserDiv").append(htmlSingleChatList);
                        }else{
                          var sessionUserId = '<?php echo \Auth::user()->id;?>';
                          $.each(resp, function( index, value ) {
                            var msgTime = moment(value.created_at).format('LT');
                            // console.log(msgTime);
                            if(value.message_text != null){
                              if(value.sender_id != sessionUserId){
                                htmlSingleChatList += '<div class="col-sm-12" >'+
                                                        '<p style="position: relative;background-color: #ef595f;color: #fff;border-radius: 30px;padding: 6px 16px; width: 50%;">'+ value.message_text +'<span>'+
                                                        '</span><span style="display: block; text-align: right;font-size: 11px;">'+ msgTime +'</span></p>'+
                                                      '</div>';
                              }else{
                                htmlSingleChatList +='<div class="col-sm-12" >'+
                                                        '<p style="position: relative;background-color: #999;color: #fff;border-radius: 8px;padding: 6px 16px;width: 50%;margin-left: auto;margin-bottom: 14px;">'+ value.message_text +'<span>'+
                                                        '</span><span style="display: block; text-align: right;font-size: 11px;">'+ msgTime +'</span></p>'+
                                                      '</div>';
                              }
                            }else if(value.message_file != null){
                              if(value.file_type == "image"){
                                if(value.sender_id != sessionUserId){
                                  htmlSingleChatList += '<div class="col-sm-6 hover-show-download " style="border-radius:10px;">'+
                                                        '<img src="'+ baseUrl +'/public/chats_images/' + value.message_file + '" alt="" class="img-responsive" style="margin-bottom: 10px; padding:10px; background-color: #000; border-radius: 12px;">'+
                                                        '<span class="download-btn" id="spanDownloadHover">'+
                                                        '<a download="'+ value.message_file +'" href="' + baseUrl +'/public/chats_images/'+ value.message_file +'" style="color: #fff;"> <i class="fa fa-download" aria-hidden="true"></i></a>'+
                                                        '</span>'+
                                                        '<span style="display: block;text-align: right;font-size: 11px;color: #fff;position: absolute;bottom: 10px;right: 31px;">'+ msgTime +'</span>'+
                                                        '</div>';
                                }else{
                                  htmlSingleChatList += '<div class="col-sm-6 hover-show-download col-sm-offset-6" style="border-radius:10px;" >'+
                                                        '<img src="'+ baseUrl +'/public/chats_images/' + value.message_file + '" alt="" class="img-responsive" style="margin-bottom: 10px; margin-left: auto; padding:10px; background-color: #000; border-radius: 12px;">'+
                                                        '<span class="download-btn" id="spanDownloadHover">'+
                                                        '<a download="'+ value.message_file +'" href="' + baseUrl +'/public/chats_images/'+ value.message_file +'" style="color: #fff;"> <i class="fa fa-download" aria-hidden="true"></i></a>'+
                                                        '</span>'+
                                                        '<span style="display: block;text-align: right;font-size: 11px;color: #fff;position: absolute;bottom: 10px;right: 31px;">'+ msgTime +'</span>'+
                                                        '</div>';
                                }
                              }else if(value.file_type == "file"){
                                if(value.sender_id != sessionUserId){
                                  htmlSingleChatList += '<div class="col-sm-12" >';
                                  if(value.message_file.split('.')[1] == "pdf"){
                                    htmlSingleChatList += '<p style="background-color: #ef595f;color: #fff;border-radius: 30px;padding: 6px 16px; width: 50%;"><span><img src="'+ baseUrl +'/public/img/pdf.png'+'" alt="" style="width: 20px; height: 20px; margin-right: 6px;"></span>';
                                  }else{
                                    htmlSingleChatList += '<p style="background-color: #ef595f;color: #fff;border-radius: 30px;padding: 6px 16px; width: 50%;"><span><img src="'+ baseUrl +'/public/img/doc2.png'+'" alt="" style="width: 20px; height: 20px; margin-right: 6px;"></span>';
                                  }
                                  htmlSingleChatList  += value.message_file +
                                  '<span><a download="'+ value.message_file +'" href="' + baseUrl +'/public/chats_images/'+ value.message_file +'" style="color: #fff;"><i class="fa fa-download" aria-hidden="true"></i></a>'+
                                  '</span>'+
                                  '<span style="display: block; text-align: right;font-size: 11px;">22:38</span></p>'+
                                  '</div>';
                                }else{
                                  htmlSingleChatList += '<div class="col-sm-12" >';
                                  if(value.message_file.split('.')[1] == "pdf"){
                                    htmlSingleChatList +=   '<p style="background-color: #000;color: #fff;border-radius: 30px;padding: 6px 16px; width: 50%;margin-left: auto;"><span><img src="'+ baseUrl +'/public/img/pdf.png'+'" alt="" style="width: 20px; height: 20px; margin-right: 6px;"></span>';
                                  }else{
                                    htmlSingleChatList +=   '<p style="background-color: #000;color: #fff;border-radius: 30px;padding: 6px 16px; width: 50%;margin-left: auto;"><span><img src="'+ baseUrl +'/public/img/doc2.png'+'" alt="" style="width: 20px; height: 20px; margin-right: 6px;"></span>';
                                  }
                                  htmlSingleChatList += value.message_file +
                                    '<span><a download="'+ value.message_file +'" href="' + baseUrl +'/public/chats_images/'+ value.message_file +'" style="color: #fff;"><i class="fa fa-download" aria-hidden="true"></i></a>'+
                                    '</span>'+
                                    '<span style="display: block; text-align: right;font-size: 11px;">22:38</span></p>'+
                                  '</div>';
                                }
                              }else{}
                            }
                          });
                          $("#singleChatUserDiv").append(htmlSingleChatList);
                          var textValue = $('#emojionearea4').data("emojioneArea").setText('');
                        }
                    },error:function(){
                      console.log('error while getting single user chat details');
                    }
                  });
                }else if(response == "filesize invalid"){
                  $("#errorChatP").text('File size is invalid. Must be less than 5 MB');
                  $("#errorChat").css('display','block');
                }
              },error:function(){
                console.log('failed to send file ');
              },
              complete:function(){
                $("#msgSendLoader").css('display','none');
                $("#sendMsgChat").attr('disabled', false);
              }
           });
        }else{
           alert("Please select a file.");
        }
      });

      // function isFileImage(file) {
      //   console.log(file['type']);
      //   // return file && file['type'].split('/')[0] === 'image';
      // }

    </script>

  <div id="bodyContainer"></div>


  </body>
</html>
