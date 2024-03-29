<?php
if (Auth::check()) {
    // FOLLOW ACTIVE
    $followActive = App\Models\Followers::where('follower', Auth::user()->id)
        ->where('following', $response->user()->id)
        ->where('status', '1')
        ->first();

    if ($followActive) {
        $textFollow = trans('users.following');
        $icoFollow = '-ok';
        $activeFollow = 'btnFollowActive';
    } else {
        $textFollow = trans('users.follow');
        $icoFollow = '-plus';
        $activeFollow = '';
    }

    // LIKE ACTIVE
    $likeActive = App\Models\Like::where('user_id', Auth::user()->id)
        ->where('images_id', $response->id)
        ->where('status', '1')
        ->first();

    if ($likeActive) {
        $textLike = trans('misc.unlike');
        $icoLike = 'fa fa-heart';
        $statusLike = 'active';
    } else {
        $textLike = trans('misc.like');
        $icoLike = 'fa fa-heart-o';
        $statusLike = '';
    }

    // ADD TO COLLECTION
    $collections = App\Models\Collections::where('user_id', Auth::user()->id)->orderBy('id', 'asc')->get();

}//<<<<---- *** END AUTH ***

// All Images resolutions
$stockImages = $response->stock;

// Similar Photos
$arrayTags = explode(",", $response->tags);
$countTags = count($arrayTags);

$images = App\Models\Images::where('categories_id', $response->categories_id)
    ->whereStatus('active')
    ->where(function ($query) use ($arrayTags, $countTags) {
        for ($k = 0; $k < $countTags; ++$k) {
            $query->orWhere('tags', 'LIKE', '%' . $arrayTags[$k] . '%');
        }
    })
    ->where('id', '<>', $response->id)
    ->orderByRaw('RAND()')
    ->take(5)
    ->get();



// Comments
$comments_sql = $response->comments()->where('status', '1')->orderBy('date', 'desc')->paginate(10);

?>

@extends('new_template.layouts.app')
{{-- @extends('app') --}}

@section('title'){{ $response->title.' - '.trans_choice('misc.photos_plural', 1 ).' #'.$response->id.' - ' }}@endsection

@section('description_custom'){{ $response->title.' - '.trans_choice('misc.photos_plural', 1 ).' #'.$response->id.' - ' }} @if( $response->description != '' ){{ App\Helper::removeLineBreak( e( $response->description ) ).' - ' }}@endif @endsection

@section('keywords_custom'){{$response->tags .','}}@endsection

@section('css')
    <link href="{{ asset('plugins/iCheck/all.css') }}" rel="stylesheet" type="text/css"/>

    <meta property="og:type" content="website"/>
@endsection

@section('content')

    @if( Auth::check() )
        <div class="modal fade" id="collections" tabindex="-1" role="dialog" aria-labelledby="collectionsLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" style="padding: 22px 0 0px 0;
    margin: 0;" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title text-center" style="margin-bottom: 0;
    line-height: 1.5;
    margin: 16px 34px 0px 0;" id="myModalLabel">
                            <strong>{{ trans('misc.add_collection') }}</strong>
                        </h4>
                    </div><!-- Modal header -->

                    <div class="modal-body listWrap">

                        <div class="collectionsData">
                            @if( $collections->count() != 0 )
                                @foreach ( $collections as $collection )

                                    <?php

                                    $collectionImages = $collection->collection_images->where('images_id', $response->id)->where('collections_id', $collection->id)->first();

                                    if (!empty($collectionImages)) {
                                        $checked = 'checked="checked"';
                                    } else {
                                        $checked = null;
                                    }
                                    ?>
                                    <div class="radio margin-bottom-15">
                                        <label class="checkbox-inline padding-zero addImageCollection text-overflow"
                                               data-image-id="{{$response->id}}"
                                               data-collection-id="{{$collection->id}}">
                                            <input class="no-show" name="checked" {{$checked}} type="checkbox"
                                                   value="true">
                                            <span class="input-sm">{{$collection->title}}</span>
                                        </label>
                                    </div>

                                @endforeach



                            @else
                                <div
                                    class="btn-block text-center no-collections">{{ trans('misc.no_have_collections') }}</div>
                            @endif

                        </div><!-- collection data -->

                        <small
                            class="btn-block note-add @if( $collections->count() == 0 ) display-none @endif">* {{ trans('misc.note_add_collections') }}</small>

                        <span class="label label-success display-none btn-block response-text"></span>

                        <!-- form start -->
                        <form method="POST" action="" enctype="multipart/form-data" id="addCollectionForm">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="image_id" value="{{ $response->id }}">

                            <!-- Start Form Group -->
                            <div class="form-group">
                                <label>{{ trans('admin.title') }}</label>
                                <input type="text" value="" name="title" id="titleCollection" class="form-control"
                                       placeholder="{{ trans('admin.title') }}">
                            </div><!-- /.form-group-->

                            <!-- Start form-group -->
                            <div class="form-group">

                                <div class="radio">
                                    <label class="padding-zero">
                                        <input type="radio" name="type" checked="checked" value="public">
                                        {{ trans('misc.public') }}
                                    </label>
                                </div>

                                <div class="radio">
                                    <label class="padding-zero">
                                        <input type="radio" name="type" value="private">
                                        {{ trans('misc.private') }}
                                    </label>
                                </div>

                            </div><!-- /.form-group -->

                            <!-- Alert -->
                            <div class="alert alert-danger alert-small display-none" id="dangerAlert">
                                <ul class="list-unstyled" id="showErrors"></ul>
                            </div><!-- Alert -->

                            <div class="btn-block text-center">
                                <button type="submit" class="btn btn-sm btn-success"
                                        id="addCollection">{{ trans('misc.create_collection') }} <i
                                        class="fa fa-plus"></i></button>
                            </div>

                        </form>

                    </div><!-- Modal body -->
                </div><!-- Modal content -->
            </div><!-- Modal dialog -->
        </div><!-- Modal -->
    @endif

    <div class="container margin-bottom-40 padding-top-40">
        <div class="row">
            <!-- Col MD -->
            <div class="col-md-9">

                @if( $response->status == 'pending' )
                    <div class="alert alert-warning" role="alert">
                        <i class="glyphicon glyphicon-info-sign myicon-right"></i> {{ trans('misc.pending_approval') }}
                    </div>
                @endif

                @if(session('error_purchase'))
                    <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <i class="glyphicon glyphicon-remove myicon-right"></i> {{ session('error_purchase') }} <a
                            href="{{url('user/dashboard/add/funds')}}" class="btn btn-sm btn-success no-shadow">
                            <i class="glyphicon glyphicon-plus myicon-right"></i> {{trans('misc.add_funds')}}
                        </a>
                    </div>
                @endif

                @if(session('purchase_not_allowed'))
                    <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <i class="glyphicon glyphicon-remove myicon-right"></i> {{ session('purchase_not_allowed') }}
                    </div>
                @endif


                @php
                    $watermarkedVideoPath = 'uploads/video/water_mark_large/';
                @endphp

                <div class="text-center margin-bottom-20">
                    <div style="margin: 0 auto; background: url('{{asset('img/pixel.gif')}}') repeat center center; ">
                        <video width="850" height="510" controls controlsList="nodownload">
                            @if($response->extension == "mp4")
                                <source src="{{ asset($watermarkedVideoPath) }}{{ '/watermark-'.$response->thumbnail }}"
                                        type="video/mp4">
                        @endif
                        <!-- <source src="movie.ogg" type="video/ogg"> -->
                            Your browser does not support the video tag.
                        </video>
                    </div>
                    <style>

                        video {
                            width: 100%;
                            height: 100%;
                        }</style>
                </div>

                <h1 class="class-montserrat title-image none-overflow">
                    {{ $response->title }}
                </h1>

                <hr/>

                @if( $response->description != '' )
                    <p class="description">
                        {{ $response->description }}
                    </p>
            @endif

            <!-- Start Block -->
                <div class="btn-block margin-bottom-20">
                    <h3>{{trans('misc.tags')}}</h3>
                    <?php
                    $tags = explode(',', $response->tags);
                    $count_tags = count($tags);
                    ?>

                    @for( $i = 0; $i < $count_tags; ++$i )
                        <a href="{{url('tags',$tags[$i]) }}" class="btn btn-danger tags font-default btn-sm">
                            {{ $tags[$i] }}
                        </a>
                    @endfor
                </div><!-- End Block -->


            @if( $images->count() != 0 )
                <!-- Start Block -->
                    <div class="btn-block margin-bottom-20 po">
                        <h3>{{trans('misc.similar_photos')}}</h3>
                        <div id="imagesFlex" class="flex-images btn-block margin-bottom-40">
                            @include('includes.images')
                        </div>
                    </div>
                    <!-- End Block -->
            @endif

            <!-- Start Block -->
                <div class="btn-block margin-bottom-20">
                    <h3>{{trans('misc.comments')}}(<span
                            id="totalComments">{{number_format( $response->comments()->count() )}}</span>)</h3>


                    @if( Auth::check() && $response->status == 'pending' )
                        <div class="alert alert-warning" role="alert">
                            <i class="glyphicon glyphicon-info-sign myicon-right"></i> {{ trans('misc.pending_approval') }}
                        </div>
                    @endif

                    @if( Auth::check() && $response->status == 'active' )


                        <div class="media">
            <span class="pull-left">
                <img alt="Image" src="{{ asset('avatar')}}/{{ Auth::user()->avatar }}" class="media-object img-circle"
                     width="50">
            </span>

                            <div class="media-body">
                                <form action="{{ url('comment/store') }}" method="post" id="commentsForm">
                                    <div class="form-group text-form">
                                        <input type="hidden" name="image_id" value="{{ $response->id }}"/>
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <textarea name="comment" rows="3" required="required" min="2" id="comments"
                                                  class="form-control input-sm textarea-comments mentions-textarea"></textarea>
                                    </div>

                                    <!-- Alert -->
                                    <div class="alert alert-danger alert-small display-none" id="dangerAlertComments">
                                        <ul class="list-unstyled" id="showErrorsComments"></ul>
                                    </div><!-- Alert -->

                                    <div class="form-group ">
                                        <button type="submit" class="btn btn-success btn-lg custom-rounded"
                                                id="commentSend">{{ trans('auth.send') }} <i
                                                class="fa fa-paper-plane"></i></button>
                                        <small class="pull-right text-muted">{{$settings->comment_length}}</small>
                                    </div>
                                </form>
                            </div><!-- media body -->
                        </div><!-- media -->
                        <hr/>
                    @endif


                    <div class="gridComments" id="gridComments" style="padding-top: 15px;">
                        @include('includes.comments')
                    </div><!-- gridComments -->

                    @if( $comments_sql->count() == 0 )

                        <div class="btn-block text-center noComments">
                            <i class="icon icon-MessageRight ico-no-result"></i>
                        </div>

                        <h3 class="margin-top-none text-center no-result row-margin-20 noComments">
                            {{ trans('misc.no_comments_yet') }}
                        </h3>
                    @endif

                    @if( Auth::guest() )
                        <hr/>
                        <div class="alert alert-loggin text-center alert-custom" role="alert">
                            {{ trans('auth.logged_in_comments') }}

                            @if( $settings->registration_active == '1' )
                                <a href="{{url('register')}}"
                                   class="btn btn-xs btn-success">{{ trans('auth.sign_up') }}</a>
                            @endif

                            <a href="{{url('login')}}">{{ trans('auth.login') }}</a>

                        </div>
                    @endif

                </div><!-- End Block -->

            </div><!-- /COL MD -->

            <div class="col-md-3">

                @if( Auth::check() &&  isset($response->user()->id) && Auth::user()->id == $response->user()->id )
                    <div class="row margin-bottom-20">

                        <div class="col-md-12">
                            <a class="btn btn-success btn-block margin-bottom-5"
                               href="{{ url('edit/photo',$response->id) }}"><i
                                    class="fa fa-pencil myicon-right "></i> {{trans('admin.edit')}}</a>
                        </div>
                        <div class="col-md-12">
                            <form method="POST" action="{{ url('delete/photo', $response->id) }}" accept-charset="UTF-8"
                                  class="displayInline">
                                @csrf
                                <button type="button" class="btn btn-danger btn-block" id="deletePhoto">
                                    <i class="fa fa-times-circle myicon-right "></i> {{trans('admin.delete')}}
                                </button>
                            </form>
                        </div>
                    </div>
                    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"
                            type="text/javascript"></script>

                    <script type="text/javascript">
                        $("#deletePhoto").click(function (e) {
                            e.preventDefault();

                            var element = $(this);
                            var form = $(element).parents('form');

                            element.blur();

                            swal(
                                {
                                    title: "{{trans('misc.delete_confirm')}}",
                                    type: "warning",
                                    showLoaderOnConfirm: true,
                                    showCancelButton: true,
                                    confirmButtonColor: "#DD6B55",
                                    confirmButtonText: "{{trans('misc.yes_confirm')}}",
                                    cancelButtonText: "{{trans('misc.cancel_confirm')}}",
                                    closeOnConfirm: false,
                                },
                                function (isConfirm) {
                                    if (isConfirm) {
                                        form.submit();
                                    }
                                });
                        });</script>
                @endif

            <!-- Start Panel -->
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="media none-overflow">
                            <div class="media-left">
                                <a href="{{url($response->user()->username)}}">
                                    <img class="media-object img-circle"
                                         src="{{url('avatar/',$response->user()->avatar)}}" width="50" height="50">
                                </a>
                            </div>
                            <div class="media-body">
                                <a href="{{url($response->user()->username)}}" class="text-username font-default">
                                    <h4 class="media-heading">{{$response->user()->username}}</h4>
                                </a>
                                <small
                                    class="media-heading text-muted btn-block margin-zero">{{trans('misc.published')}} {{App\Helper::formatDate($response->date)}}</small>
                                <small
                                    class="media-heading text-muted">{{ number_format(App\Models\User::totalImages( $response->user()->id))}} {{trans_choice('misc.images_plural', App\Models\User::totalImages( $response->user()->id ))}}</small>
                                <p class="margin-top-10">
                                    @if( Auth::check() && $response->user()->id != Auth::user()->id )
                                        <button type="button"
                                                class="btn btn-xs add-button btn-follow myicon-right btnFollow {{ $activeFollow }}"
                                                data-toggle="tooltip" data-placement="top"
                                                data-id="{{ $response->user()->id }}"
                                                data-follow="{{ trans('users.follow') }}"
                                                data-following="{{ trans('users.following') }}">
                                            <i class="glyphicon glyphicon{{ $icoFollow }} myicon-right"></i> {{ $textFollow }}
                                        </button>
                                    @endif

                                    @if( Auth::check() && $response->user()->id != Auth::user()->id && $response->user()->paypal_account != '' || Auth::guest()  && $response->user()->paypal_account != '' )
                                        <button type="button" class="btn btn-sm btn-default" id="btnFormPP"
                                                title="{{trans('misc.buy_coffee')}}">
                                            <i class="fa fa-paypal"
                                               style="color: #003087"></i> @if( Auth::guest() ) {{trans('misc.coffee')}} @endif
                                        </button>
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                </div><!-- End Panel -->

                @if( Auth::check() && $response->status == 'active')
                    <div class="row margin-bottom-20">
                        <!-- col-xs-6 -->
                        <div class="col-xs-6" style="width: 50%;border-right: 1px solid #e3e3e3;">
                            @if( Auth::check()  )
                                <a href="#" class="btnLike likeButton {{$statusLike}}" data-id="{{$response->id}}"
                                   data-like="{{trans('misc.like')}}" data-unlike="{{trans('misc.unlike')}}">
                                    <h3 class="btn-block text-center margin-top-10"><i class="{{$icoLike}}"></i></h3>
                                    <small class="btn-block text-center text-muted textLike">{{$textLike}}</small>
                                </a>
                            @else

                                <a href="{{url('login')}}" class="btnLike">
                                    <h3 class="btn-block text-center margin-top-10"><i class="fa fa-heart-o"></i></h3>
                                    <small class="btn-block text-center text-muted">{{trans('misc.like')}}</small>
                                </a>

                            @endif
                        </div><!-- col-xs-6 -->


                        <!-- col-xs-6 -->
                        <div class="col-xs-6" style="width: 50%;">
                            @if( Auth::check() )

                                <a href="#" class="btn-collection" data-toggle="modal" data-target="#collections"
                                   id="collections-modal-btn">
                                    <h3 class="btn-block text-center margin-top-10"><i class="fa fa-folder-open-o"></i>
                                    </h3>
                                    <small class="btn-block text-center text-muted">{{trans('misc.collection')}}</small>
                                </a>
                                <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                Launch demo modal
                                </button> -->
                            @else

                                <a href="{{url('login')}}" class="btn-collection">
                                    <h3 class="btn-block text-center margin-top-10"><i class="fa fa-folder-open-o"></i>
                                    </h3>
                                    <small class="btn-block text-center text-muted">{{trans('misc.collection')}}</small>
                                </a>

                            @endif
                        </div><!-- col-xs-6 -->
                    </div>
                @endif


            <!-- Start Panel -->
                <div class="panel panel-default">
                    <div class="panel-body padding-zero">
                        <ul class="list-stats list-inline">
                            <li>
                                <h4 class="btn-block text-center">{{App\Helper::formatNumber($response->visits()->count())}}</h4>
                                <small class="btn-block text-center text-muted">{{trans('misc.views')}}</small>
                            </li>

                            <li>
                                <h4 class="btn-block text-center"
                                    id="countLikes">{{App\Helper::formatNumber($response->likes()->count())}}</h4>
                                <small class="btn-block text-center text-muted">{{trans('misc.likes')}}</small>
                            </li>

                            <li>
                                <h4 class="btn-block text-center">{{App\Helper::formatNumber($response->downloads()->count())}}</h4>
                                <small class="btn-block text-center text-muted">{{trans('misc.downloads')}}</small>
                            </li>

                        </ul>

                    </div>
                </div><!-- End Panel -->

                @if( $response->featured == 'yes' )

                <!-- Start Panel -->
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <i class="icon icon-Medal myicon-right"></i> <span
                                class="text-muted">{{trans('misc.featured_on')}} </span>
                            <strong>{{ App\Helper::formatDate($response->featured_date) }}</strong>

                        </div>
                    </div><!-- End Panel -->

                @endif

            <!-- btn-group -->
                <div class="btn-group btn-block margin-bottom-20">


                    @if($response->item_for_sale == 'free'
                        || Auth::check() && Auth::user()->id == $response->user_id
                        && $response->item_for_sale == 'free')

                        <form action="{{url('download/stock', $stockImages[0]->token)}}" method="post">
                            {{-- <!-- <form action="{{url('download/stock')}}" method="post"> --> --}}

                            @csrf

                            @guest
                                @if($settings->downloads == 'all')
                                    @captcha
                                @endif
                            @endguest

                            <div class="form-group">

                                <dd>
                                    @foreach( $stockImages as $stock )
                                        <?php
                                        // 	 	switch( $stock->type ) {
                                        // 		case 'small':
                                        // 			$_size          = trans('misc.s');
                                        // 			break;
                                        // 		case 'medium':
                                        // 			$_size          = trans('misc.m');
                                        // 			break;
                                        // 		case 'large':
                                        // 			$_size          = trans('misc.l');
                                        // 			break;
                                        //   case 'vector':
                                        // 			$_size          = trans('misc.v');
                                        // 			break;

                                        // 	}
                                        ?>
                                        <div class="radio margin-bottom-15" style="display:none;">
                                            <label class="padding-zero">
                                                <input id="popular_sort" class="no-show"
                                                       @if($stock->type == 'large') checked @endif name="type"
                                                       type="radio" value="{{$stock->type}}">
                                                <span class="input-sm"
                                                      style="width: 95%; float: left; position: absolute; padding: 0 10px; height: auto">
                  {{-- <!-- <span class="label label-default myicon-right">{{ $_size ?? '' }}</span> {{$stock->type == 'vector' ? trans('misc.vector_graphic').' ('.strtoupper($stock->extension).')' : $stock->resolution}} --> --}}
                  <span class="pull-right">{{$stock->size}}</span>
                  </span>
                                            </label>
                                        </div>
                                    @endforeach

                                </dd>
                            </div>
                            <!-- form-group -->

                            <!-- btn-free -->
                            <!-- <button type="submit" class="btn btn-success btn-lg btn-block dropdown-toggle" id="downloadBtn"> -->
                            <button type="submit" class="btn btn-success btn-lg btn-block " id="downloadBtn">
                                <i class="fa fa-cloud-download myicon-right"></i> {{trans('misc.download')}}
                            </button>
                            <!-- btn-free -->
                        </form>

                    @else
                        <form action="{{url('purchase/stock', !$stockImages->isEmpty()? $stockImages[0]->token:'')}}"
                              method="post" id="formBuy">
                            {{-- <!-- <form action="{{url('purchase/stock')}}" method="post" id="formBuy"> --> --}}
                            @csrf

                            @if(Auth::guest() || Auth::check() && Auth::user()->id != $response->user_id)
                                <div class="form-group has-feedback">
                                    <select name="license" class="form-control" id="license">
                                        <option value="regular">{{trans('misc.license_regular')}}</option>
                                        <option value="extended">{{trans('misc.license_extended')}}</option>
                                    </select>
                                    @if($settings->link_license != '')
                                        <small class="text-center btn-block margin-top-5">
                                            <a href="{{$settings->link_license}}"
                                               target="_blank">{{trans('misc.view_license_details')}}</a>
                                        </small>
                                    @endif
                                </div>
                                <hr/>
                            @endif

                            <div class="form-group">

                                <dd>
                                    @foreach( $stockImages as $stock )
                                        <?php
                                        // 	 	switch( $stock->type ) {
                                        // 		case 'small':
                                        // 			$_size          = trans('misc.s');
                                        // 			break;
                                        // 		case 'medium':
                                        // 			$_size          = trans('misc.m');
                                        // 			break;
                                        // 		case 'large':
                                        // 			$_size          = trans('misc.l');
                                        // 			break;
                                        //   case 'vector':
                                        //       $_size          = trans('misc.v');
                                        //       break;

                                        // 	}
                                        ?>
                                        <div class="radio margin-bottom-15" style="display:none;">
                                            <label class="padding-zero itemPrice" data-type="{{$stock->type}}"
                                                   data-amount="{{$response->price}}">
                                                <input id="popular_sort" class="no-show"
                                                       @if($stock->type == 'large') checked @endif name="type"
                                                       type="radio" value="{{$stock->type}}">
                                                <span class="input-sm"
                                                      style="width: 95%; float: left; position: absolute; padding: 0 10px; height: auto">
              <span class="pull-right">{{$stock->size}}</span>
              </span>
                                            </label>
                                        </div>
                                    @endforeach

                                </dd>
                            </div>
                            <!-- form-group -->

                            @if(Auth::check() && Auth::user()->id != $response->user()->id)
                            <!-- Payment Options -->
                                <h5>Select payment method</h5>
                                <div class="payment-panel-main">
                                    <div class="radio margin-bottom-15 payment-panel-box">
                                        <label class="padding-zero paymentOption" data-type="stripe" data-amount="">
                                            <input class="no-show" name="payment_option" type="radio" value="stripe"
                                                   checked>
                                            <span class="input-sm"
                                                  style="width: 95%; float: left; position: absolute; padding: 0 10px; height: auto; margin-top: -4px;">
                  <span class="label label-payment-icon label-default myicon-right"><i class="fab fa-stripe"></i></span>
                </span>
                                        </label>
                                    </div>
                                    <div class="radio margin-bottom-15 payment-panel-box">
                                        <label class="padding-zero paymentOption" data-type="paypal" data-amount="">
                                            <input class="no-show" name="payment_option" type="radio" value="paypal">
                                            <span class="input-sm"
                                                  style="width: 95%; float: left; position: absolute; padding: 0 10px; height: auto; margin-top: -4px;">
                  <span class="label label-payment-icon label-default myicon-right"><i
                          class="fab fa-cc-paypal"></i></span>
                </span>
                                        </label>
                                    </div>
                                    <!--<div class="radio margin-bottom-15 payment-panel-box">
                                      <label class="padding-zero paymentOption" data-type="wallet" data-amount="">
                                      <input class="no-show" name="payment_option" type="radio" value="wallet">
                                      <span class="input-sm" style="width: 95%; float: left; position: absolute; padding: 0 10px; height: auto; margin-top: -4px;">
                                        <span class="label label-payment-icon label-default myicon-right"><i class="fas fa-wallet"></i></span>
                                      </span>
                                    </label>
                                  </div>-->

                                </div>
                            @endif
                            <style>
                                /* Payment radio css */
                                .label.label-payment-icon {
                                    display: inline;
                                    padding: 0;
                                    font-size: 30px;
                                    line-height: 1;
                                    text-align: center;
                                    white-space: nowrap;
                                    border-radius: 0;
                                    background-color: transparent;
                                    color: #000;
                                }

                                .payment-panel-main {
                                    display: -ms-flexbox !important;
                                    display: flex !important;
                                }

                                .payment-panel-main .payment-panel-box {
                                    -ms-flex-preferred-size: 0;
                                    flex-basis: 0;
                                    -ms-flex-positive: 1;
                                    flex-grow: 1;
                                    max-width: 100%;
                                }

                                /* Payment radio css */
                            </style>
                            <!-- Payment Options -->

                            <!-- btn-sale -->


                            @if(Auth::check() && Auth::user()->id != $response->user()->id)
                            <!-- Commented by shahzad
        <button type="submit" class="btn btn-success btn-lg btn-block dropdown-toggle" data-type="small" id="downloadButton">
            <i class="fa fa-cloud-download myicon-right"></i> {{trans('misc.download')}}
                                </button>-->

                                @if(Auth::check())

                                <!-- Paypal Button -->
                                    <!-- Set up a container element for the button -->
                                    <div id="paypalDiv" class="hide">
                                        <div id="paypal-button-container"></div>
                                    </div>
                                    <!-- Paypal Button -->

                                    <div id="stripeDiv">
                                        <button type="submit"
                                                class="btn btn-success btn-lg btn-block dropdown-toggle stripeBtn"
                                                data-type="small" id="downloadButton">
                                            <i class="fa fa-shopping-cart myicon-right"></i>
                                            {{trans('misc.buy')}}
                                            <span id="priceItem">{{ $settings->currency_position == 'left' ? $settings->currency_symbol : null }}<span
                                                    id="itemPrice">{{$response->price}}</span>{{ $settings->currency_position == 'right' ? $settings->currency_symbol : null }} <small
                                                    class="sm-currency-code">{{$settings->currency_code}}</small></span>
                                        </button>
                                    </div>
                                @else
                                    <button type="submit" class="btn btn-success btn-lg btn-block dropdown-toggle"
                                            data-type="small" id="downloadButton">
                                        <i class="fa fa-shopping-cart myicon-right"></i>
                                        {{trans('misc.buy')}}
                                        <span id="priceItem">{{ $settings->currency_position == 'left' ? $settings->currency_symbol : null }}<span
                                                id="itemPrice">{{$response->price}}</span>{{ $settings->currency_position == 'right' ? $settings->currency_symbol : null }} <small
                                                class="sm-currency-code">{{$settings->currency_code}}</small></span>
                                    </button>
                            @endif
                        @endif
                        <!-- btn-sale -->
                        </form>

                    @endif


                </div><!-- End btn-group -->

                @if($response->item_for_sale == 'free')

                    <?php
                    switch ($response->how_use_image) {
                        case 'free':
                            $license = trans('misc.use_free');
                            $iconLicense = 'glyphicon glyphicon-ok';
                            break;
                        case 'free_personal':
                            $license = trans('misc.use_free_personal');
                            $iconLicense = 'icon-warning';
                            break;
                        case 'editorial_only':
                            $license = trans('misc.use_editorial_only');
                            $iconLicense = 'icon-warning';
                            break;
                        case 'web_only':
                            $license = trans('misc.use_web_only');
                            $iconLicense = 'icon-warning';
                            break;
                    }
                    ?>
                <!-- Start Panel -->
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <h5 style="font-size:14px;"><i class="fab fa-creative-commons myicon-right"
                                                           aria-hidden="true"></i>
                                <strong>{{trans('misc.license_and_use')}}</strong></h5>
                            <small class="text-muted"><i class="{{$iconLicense}} myicon-right"></i> {{$license}}</small>

                            @if( $response->attribution_required == 'yes' )
                                <small class="btn-block text-muted"><i
                                        class="glyphicon glyphicon-ok myicon-right"></i> {{trans('misc.attribution_required')}}
                                </small>
                            @else
                                <small class="btn-block text-muted"><i
                                        class="glyphicon glyphicon-remove myicon-right"></i> {{trans('misc.no_attribution_required')}}
                                </small>
                            @endif

                        </div>
                    </div><!-- End Panel -->
                @endif

                @if( $response->status == 'active' )
                <!-- Start Panel -->
                    <div class="panel panel-default">
                        <div class="panel-body d-flex">
                            <h5 class="pull-left margin-zero" style="font-size:14px; line-height: inherit;"><i
                                    class="icon icon-Share myicon-right" aria-hidden="true"></i>
                                <strong>{{trans('misc.share')}}</strong></h5>

                            <ul class="list-inline pull-right margin-zero" style="float:right !important">
                                <li><a title="Facebook"
                                       href="https://www.facebook.com/sharer/sharer.php?u={{ url('photo',$response->id) }}"
                                       target="_blank"><img loading="lazy" src="{{url('img/social')}}/facebook.png"
                                                            width="20"/></a>
                                </li>
                                <li><a title="Twitter"
                                       href="https://twitter.com/intent/tweet?url={{ url('photo',$response->id) }}&text={{ e( $response->title ) }}"
                                       data-url="{{ url('photo',$response->id) }}" target="_blank"><img width="20"
                                                                                                        src="{{url('img/social')}}/twitter.png"/></a>
                                </li>
                                <li style="padding-right: 0;"><a title="Pinterest"
                                                                 href="//www.pinterest.com/pin/create/button/?url={{ url('photo',$response->id) }}&media={{ url('/') . '/uploads/preview/' . $response->preview }}&description={{ e( $response->title ) }}"
                                                                 target="_blank"><img width="20"
                                                                                      src="{{url('img/social')}}/pinterest.png"/></a>
                                </li>
                            </ul>
                        </div>
                    </div><!-- End Panel -->
                @endif

                @if( $response->exif != '' || $response->camera != '' )
                <!-- Start Panel -->
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <h5 style="font-size:14px;"><i class="icon icon-DSLRCamera myicon-right"
                                                           aria-hidden="true"></i>
                                <strong>{{trans('misc.exif_data')}}</strong></h5>

                            @if( $response->camera != ''  )
                                <small class="btn-block text-muted">{{trans('misc.photo_taken_with')}}</small>
                                <small class="btn-block text-muted"><a
                                        href="{{url('cameras',$response->camera)}}">{{$response->camera}}</a></small>
                            @endif

                            <small class="btn-block text-muted wordSpacing">{{$response->exif}}</small>

                        </div>
                    </div><!-- End Panel -->
                @endif

                @if( $response->colors != '' )
                    <?php
                    $colors = explode(',', $response->colors);
                    $count_colors = count($colors);
                    ?>

                <!-- Start Panel -->
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <h5 style="font-size:14px;margin-top: 10px;
    margin-bottom: 10px;"><i class="icon icon-Drop myicon-right" aria-hidden="true"></i>
                                <strong>{{trans('misc.color_palette')}}</strong></h5>

                            @for( $c = 0; $c < $count_colors; ++$c )

                                <a title="#{{$colors[$c]}}" href="{{url('colors') }}/{{$colors[$c]}}"
                                   class="colorPalette showTooltip"
                                   style="background-color: {{ '#'.$colors[$c] }};"></a>

                            @endfor

                        </div>
                    </div><!-- End Panel -->
                @endif

                <ul class="list-group">
                    <li class="list-group-item"><i class="icon icon-info fa fa-info-circle myicon-right"></i>
                        <strong>{{trans('misc.details')}}</strong></li>


                    <li class="list-group-item"><span
                            class="badge data-xs-img">{{App\Helper::formatDate($response->date)}}</span> {{trans('misc.published')}}
                    </li>
                    <li class="list-group-item"><span
                            class="badge data-xs-img">{{strtoupper($response->extension)}} </span> {{trans('misc.image_type')}}
                    </li>
                    {{-- <!-- <li class="list-group-item"> <span class="badge data-xs-img">{{$stockImages[2]->resolution}}</span> {{trans('misc.resolution')}}</li> --> --}}
                    <li class="list-group-item"><span class="badge data-xs-img"><a
                                href="{{url('category',$response->category->slug)}}"
                                title="{{$response->category->name}}">{{str_limit($response->category->name, 18, '...') }}</a></span> {{trans('misc.category')}}
                    </li>
                    {{-- <!-- <li href="#" class="list-group-item"> <span class="badge data-xs-img">{{$stockImages[2]->size}}</span> {{trans('misc.file_size')}}</li> --> --}}
                </ul>


                @if( Auth::check() )
                    <div class="modal fade" id="reportImage" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                                            class="sr-only">Close</span></button>
                                    <h4 class="modal-title text-center" id="myModalLabel">
                                        <strong>{{ trans('misc.report_photo') }}</strong>
                                    </h4>
                                </div><!-- Modal header -->

                                <div class="modal-body listWrap">

                                    <!-- form start -->
                                    <form method="POST" action="{{ url('report/photo') }}" enctype="multipart/form-data"
                                          id="formReport">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="hidden" name="id" value="{{ $response->id }}">
                                        <!-- Start Form Group -->
                                        <div class="form-group">
                                            <label>{{ trans('admin.reason') }}</label>
                                            <select name="reason" class="form-control">
                                                <option value="copyright">{{ trans('admin.copyright') }}</option>
                                                <option
                                                    value="privacy_issue">{{ trans('admin.privacy_issue') }}</option>
                                                <option
                                                    value="violent_sexual_content">{{ trans('admin.violent_sexual_content') }}</option>
                                            </select>

                                        </div><!-- /.form-group-->

                                        <button type="submit" class="btn btn-sm btn-danger"
                                                id="reportPhoto">{{ trans('misc.report_photo') }}</button>

                                    </form>

                                </div><!-- Modal body -->
                            </div><!-- Modal content -->
                        </div><!-- Modal dialog -->
                    </div><!-- Modal -->
                @endif

                @if( Auth::check() )
                    <div class="btn-block text-center">
                        <a href="#" data-toggle="modal" data-target="#reportImage"><i
                                class="icon-warning myicon-right"></i> {{ trans('misc.report_photo') }}</a>
                    </div>
                @endif

                @if( isset( $settings->google_adsense ) )
                    <div class="margin-top-20">
                        <?php echo html_entity_decode($settings->google_adsense); ?>
                    </div>
                @endif

            </div><!-- /COL MD -->
        </div>
    </div><!-- container wrap-ui -->

    @if( Auth::check() )
        <form id="form_pp" name="_xclick" action="https://www.paypal.com/cgi-bin/webscr" method="post"
              style="display:none">
            <input type="hidden" name="cmd" value="_donations">
            <input type="hidden" name="return" value="{{url('photo',$response->id)}}">
            <input type="hidden" name="cancel_return" value="{{url('photo',$response->id)}}">
            <input type="hidden" name="currency_code" value="USD">
            <input type="hidden" name="item_name"
                   value="{{trans('misc.support').' @'.$response->user()->username}} - {{$settings->title}}">
            <input type="hidden" name="business" value="{{$response->user()->paypal_account}}">
            <input type="submit">
        </form>
    @endif

@endsection

@section('javascript')
    <script src="{{ asset('plugins/iCheck/icheck.min.js') }}" type="text/javascript"></script>
    <script type="text/javascript">
        var URL_BASE = '<?php echo url('/') ?>';

        $photo_small = false;
        $photo_regular_small = false;
        $photo_extended_small = false;

        $photo_medium = false;
        $photo_regular_medium = false;
        $photo_extended_medium = false;

        $photo_large = false;
        $photo_regular_large = false;
        $photo_extended_large = false;

        $photo_vector = false;
        $photo_regular_vector = false;
        $photo_extended_vector = false;

        $autor = false;

        $('#imagesFlex').flexImages({maxRows: 1, truncate: true});

        $('#btnFormPP').click(function (e) {
            $('#form_pp').submit();
        });

        $('input').iCheck({
            radioClass: 'iradio_flat-green',
            checkboxClass: 'icheckbox_square-green',
        });

        @if (session('noty_error'))
        swal({
            title: "{{ trans('misc.error_oops') }}",
            text: "{{ trans('misc.already_sent_report') }}",
            type: "error",
            confirmButtonText: "{{ trans('users.ok') }}"
        });
        @endif

        @if (session('noty_success'))
        swal({
            title: "{{ trans('misc.thanks') }}",
            text: "{{ trans('misc.send_success') }}",
            type: "success",
            confirmButtonText: "{{ trans('users.ok') }}"
        });
        @endif

        @if( Auth::check() )

        $("#reportPhoto").click(function (e) {
            var element = $(this);
            e.preventDefault();
            element.attr({'disabled': 'true'});

            $('#formReport').submit();

        });

        // Comments Delete
        $(document).on('click', '.deleteComment', function () {

            var $id = $(this).data('id');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            swal(
                {
                    title: "{{trans('misc.delete_confirm')}}",
                    type: "warning",
                    showLoaderOnConfirm: true,
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "{{trans('misc.yes_confirm')}}",
                    cancelButtonText: "{{trans('misc.cancel_confirm')}}",
                    closeOnConfirm: false,
                },
                function (isConfirm) {
                    if (isConfirm) {

                        element = $(this);

                        element.removeClass('deleteComment');

                        $.post("{{url('comment/delete')}}",
                            {comment_id: $id},
                            function (data) {
                                if (data.success == true) {
                                    window.location.reload();
                                } else {
                                    //bootbox.alert(data.error);
                                    //window.location.reload();
                                }

                            }, 'json');

                    }
                });
        });

        // Likes Comments
        $(document).on('click', '.likeComment', function () {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            element = $(this);

            element.html('<i class="fa fa-spinner fa-spin"></i>');

            $.post("{{url('comment/like')}}",
                {
                    comment_id: $(this).data('id')
                }, function (data) {
                    if (data.success == true) {
                        if (data.type == 'like') {
                            element.html('<i class="fa fa-heart myicon-right"></i>');
                            element.parent('.btn-block').find('.count').html(data.count).fadeIn();
                            element.parent('.btn-block').find('.like-small').fadeIn();
                            element.blur();

                        } else if (data.type == 'unlike') {
                            element.html('<i class="fa fa-heart-o myicon-right"></i>');

                            if (data.count == 0) {
                                element.parent('.btn-block').find('.count').html(data.count).fadeOut();
                                element.parent('.btn-block').find('.like-small').fadeOut();
                            } else {
                                element.parent('.btn-block').find('.count').html(data.count).fadeIn();
                                element.parent('.btn-block').find('.like-small').fadeIn();
                            }

                            element.blur();
                        }
                    } else {
                        bootbox.alert(data.error);
                        window.location.reload();
                    }

                    if (data.session_null) {
                        window.location.reload();
                    }
                }, 'json');
        });
        @endif

        //<<<---------- Comments Likes
        $(document).on('click', '.comments-likes', function () {
            element = $(this);
            var id = element.attr("data-id");
            var info = 'comment_id=' + id;

            element.removeClass('comments-likes');

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                url: "{{ url('comments/likes') }}",
                data: info,
                success: function (data) {


                    $('#collapse' + id).html(data);
                    $('[data-toggle="tooltip"]').tooltip();

                    if (data == '') {
                        $('#collapse' + id).html("{{trans('misc.error')}}");
                    }
                }//<-- $data
            });
        });
        @if( Auth::check() && Auth::user()->id == $response->user()->id )

        var $autor = true;

        // Delete Photo

        @endif

            @if(Auth::check() && Auth::user()->id != $response->user()->id)
            @php
                $purchasesUser = App\Models\Purchases::whereImagesId($response->id)->whereUserId(Auth::user()->id)->get();
            @endphp

            @foreach ($purchasesUser as $key)
            $photo_{{$key->type}} = true;
        $photo_{{$key->license}}_{{$key->type}} = true;
        @endforeach
        @endif

        @if(Auth::check() && Auth::user()->id != $response->user()->id && $response->item_for_sale == 'sale')

        function stripHtml(html) {
            var tmp = document.createElement("DIV");
            tmp.innerHTML = html;
            return tmp.textContent || tmp.innerText || "";
        }

        function confirmPurchase() {
            // Confirm Buy Photo
            $("#downloadBtn").on('click', function (e) {
                e.preventDefault();

                var element = $(this);
                var form = $(element).parents('form');
                var priceItem = stripHtml($('#priceItem').html());
                var type = element.attr('data-type');
                var typeLicense = $('#license').val();
                var $alreadyBought = '';
                var $alreadyBoughtText = '<br><h6 class="alert alert-warning margin-top-5 alert-small"><i class="fa fa-warning myicon-right"></i> {{trans('misc.already_bought_text')}} <a href="{{url('user/dashboard/purchases')}}" style="color:#FFF;" target="_blank"><u>{{trans('misc.my_purchases')}}</u></a></h6>';

                element.blur();

                // Send form if the user bought the photo
                /*if (type == 'small' && $photo_small == true) {
                  form.submit();
                  return false;
                } else if (type == 'medium' && $photo_medium == true) {
                  form.submit();
                  return false;
                } else if (type == 'large' && $photo_large == true) {
                  form.submit();
                  return false;
                } else if (type == 'vector' && $photo_vector == true) {
                  form.submit();
                  return false;
                }*/

                //***** Regular License and Extended License *****
                if (type == 'small'
                    && $photo_small == true
                    && $photo_regular_small == true
                    && typeLicense == 'regular'
                    || $photo_small == true
                    && $photo_extended_small == true
                    && typeLicense == 'extended'
                ) {
                    $alreadyBought = $alreadyBoughtText;

                } else if (type == 'medium'
                    && $photo_medium == true
                    && $photo_regular_medium == true
                    && typeLicense == 'regular'
                    || $photo_medium == true
                    && $photo_extended_medium == true
                    && typeLicense == 'extended'
                ) {
                    $alreadyBought = $alreadyBoughtText;

                } else if (type == 'large'
                    && $photo_large == true
                    && $photo_regular_large == true
                    && typeLicense == 'regular'
                    || $photo_large == true
                    && $photo_extended_large == true
                    && typeLicense == 'extended'
                ) {
                    $alreadyBought = $alreadyBoughtText;

                } else if (type == 'vector'
                    && $photo_vector == true
                    && $photo_regular_vector == true
                    && typeLicense == 'regular'
                    || $photo_vector == true
                    && $photo_extended_vector == true
                    && typeLicense == 'extended'
                ) {
                    $alreadyBought = $alreadyBoughtText;
                }

                switch (type) {
                    case 'small':
                        $typeImage = '{{trans('misc.small_photo')}}';
                        break;

                    case 'medium':
                        $typeImage = '{{trans('misc.medium_photo')}}';
                        break;

                    case 'large':
                        $typeImage = '{{trans('misc.large_photo')}}';
                        break;

                    case 'vector':
                        $typeImage = '{{trans('misc.vector_graphic')}}';
                        break;
                }

                switch (typeLicense) {
                    case 'regular':
                        $license = '{{trans('misc.license_regular')}}';
                        break;

                    case 'extended':
                        $license = '{{trans('misc.license_extended')}}';
                        break;
                }

                swal({
                        html: true,
                        title: "{{trans('misc.confirm_purchase')}}",
                        text: "{{trans('misc.text_confirm_purchase')}} <strong>" + priceItem + "</strong> {{trans('misc.text_confirm_purchase_2')}} <br> " + $typeImage + " - " + $license + $alreadyBought,
                        type: "warning",
                        showLoaderOnConfirm: true,
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "{{trans('misc.yes_confirm_buy')}}",
                        cancelButtonText: "{{trans('misc.cancel_confirm')}}",
                        closeOnConfirm: false,
                    },
                    function (isConfirm) {
                        if (isConfirm) {
                            swal({
                                title: "{{trans('misc.thanks')}}",
                                text: "{{trans('misc.please_wait')}}",
                                type: "success",
                                timer: 4000
                            });
                            form.submit();

                            //element.html('<i class="fa fa-cloud-download myicon-right"></i> {{trans('misc.download')}}');

                            if (type == 'small' && typeLicense == 'regular') {
                                $photo_small = true;
                                $photo_regular_small = true;

                            } else if (type == 'small' && typeLicense == 'extended') {
                                $photo_small = true;
                                $photo_extended_small = true;

                            } else if (type == 'medium' && typeLicense == 'regular') {
                                $photo_medium = true;
                                $photo_regular_medium = true;

                            } else if (type == 'medium' && typeLicense == 'extended') {
                                $photo_medium = true;
                                $photo_extended_medium = true;

                            } else if (type == 'large' && typeLicense == 'regular') {
                                $photo_large = true;
                                $photo_regular_large = true;

                            } else if (type == 'large' && typeLicense == 'extended') {
                                $photo_large = true;
                                $photo_extended_large = true;

                            } else if (type == 'vector' && typeLicense == 'regular') {
                                $photo_vector = true;
                                $photo_regular_vector = true;

                            } else if (type == 'vector' && typeLicense == 'extended') {
                                $photo_vector = true;
                                $photo_extended_vector = true;
                            }
                        }// isConfirm
                    });
            });
        }// FUNCTION
        @endif

        //<<---- PAGINATION AJAX
        $(document).on('click', '.pagination a', function (e) {
            e.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{ url("/") }}/ajax/comments?photo={{$response->id}}&page=' + page


            }).done(function (data) {
                if (data) {

                    scrollElement('#gridComments');

                    $('.gridComments').html(data);

                    jQuery(".timeAgo").timeago();

                    $('[data-toggle="tooltip"]').tooltip();
                } else {
                    sweetAlert("{{trans('misc.error_oops')}}", "{{trans('misc.error')}}", "error");
                }
                //<**** - Tooltip
            });
        });//<<---- PAGINATION AJAX


        @if(Auth::check())

        var $currentImage = $('.itemPrice').attr("data-type");
        var $formBuy = $('#formBuy');

        if ($currentImage == 'small' && $photo_small == false || $currentImage == 'small' && $autor == false) {
            if (typeof confirmPurchase == 'function') {
                confirmPurchase();
            }
        }   //alert($currentImage);

        @endif

        $('#license').on('change', function () {
            $price = $('#itemPrice').html();

            if ($(this).val() == 'regular') {
                $('#itemPrice').html(($price / 10));
            } else {
                $('#itemPrice').html(($price * 10));
            }
        });

        /* Payment Option */
        $('.paymentOption').on('click', function () {
            switch ($(this).attr("data-type")) {
                case 'stripe':
                    $("#paypalDiv").slideUp();
                    $("#stripeDiv").slideDown();
                    break;

                case 'paypal':
                    $("#stripeDiv").slideUp();
                    $("#paypalDiv").slideDown();
                    break;
            }
        });

        /* Payment Option */

        var strMoney = {{$response->price}}; //Set for Stripe
        $('.itemPrice').on('click', function () {

            var type = $(this).attr("data-type");
            var amount = $(this).attr("data-amount");
            var buttonDownload = '<i class="fa fa-cloud-download myicon-right"></i> {{trans('misc.download')}}';
            var license = $('#license').val();

            if (license == 'regular') {
                var valueOriginal = {{$response->price}};
            } else {
                var valueOriginal = ({{$response->price}} * 10);
            }

            var amountMedium = (valueOriginal * 2);
            var amountLarge = (valueOriginal * 3);
            var amountVector = (valueOriginal * 4);

            if (type == 'small') {

                if ($autor == false) {
                    if (typeof confirmPurchase == 'function') {
                        confirmPurchase();
                    }
                    $('#downloadButton').html('<i class="fa fa-shopping-cart myicon-right"></i> {{trans('misc.buy')}} <span id="priceItem">{{ $settings->currency_position == 'left' ? $settings->currency_symbol : null }}<span id="itemPrice">' + valueOriginal + '</span>{{ $settings->currency_position == 'right' ? $settings->currency_symbol : null }} <small class="sm-currency-code">{{$settings->currency_code}}</small></span>')
                        .attr('data-type', 'small');
                    strMoney = valueOriginal;
                }

            } else if (type == 'medium') {

                if ($autor == false) {
                    if (typeof confirmPurchase == 'function') {
                        confirmPurchase();
                    }
                    $('#downloadButton').html('<i class="fa fa-shopping-cart myicon-right"></i> {{trans('misc.buy')}} <span id="priceItem">{{ $settings->currency_position == 'left' ? $settings->currency_symbol : null }}<span id="itemPrice">' + amountMedium + '</span>{{ $settings->currency_position == 'right' ? $settings->currency_symbol : null }} <small class="sm-currency-code">{{$settings->currency_code}}</small></span>')
                        .attr('data-type', 'medium');
                    strMoney = amountMedium;
                }

            } else if (type == 'large') {

                if ($autor == false) {
                    if (typeof confirmPurchase == 'function') {
                        confirmPurchase();
                    }
                    $('#downloadButton').html('<i class="fa fa-shopping-cart myicon-right"></i> {{trans('misc.buy')}} <span id="priceItem">{{ $settings->currency_position == 'left' ? $settings->currency_symbol : null }}<span id="itemPrice">' + amountLarge + '</span>{{ $settings->currency_position == 'right' ? $settings->currency_symbol : null }} <small class="sm-currency-code">{{$settings->currency_code}}</small></span>')
                        .attr('data-type', 'large');
                    strMoney = amountLarge;
                }

            } else if (type == 'vector') {

                if ($autor == false) {
                    if (typeof confirmPurchase == 'function') {
                        confirmPurchase();
                    }
                    $('#downloadButton').html('<i class="fa fa-shopping-cart myicon-right"></i> {{trans('misc.buy')}} <span id="priceItem">{{ $settings->currency_position == 'left' ? $settings->currency_symbol : null }}<span id="itemPrice">' + amountVector + '</span>{{ $settings->currency_position == 'right' ? $settings->currency_symbol : null }} <small class="sm-currency-code">{{$settings->currency_code}}</small></span>')
                        .attr('data-type', 'vector');
                    strMoney = amountVector;
                }
            }
        });

        $("#collections-modal-btn").click(function () {
            $("#collections").css('opacity', '1');
        });

    </script>

    <!-- Stripe Checkout Added by Shahzad -->
    <script src="https://checkout.stripe.com/v2/checkout.js"></script>
    <script>
        var handler = StripeCheckout.configure({
            key: '{{env("STRIPE_KEY")}}',
            image: 'https://projects.hexawebstudio.com/darquise-nantel/img/favicon.png',
            locale: 'auto',
            token: function (token) {
                // You can access the token ID with `token.id`.
                // Get the token ID to your server-side code for use.
                console.log("Token created: " + token.id);
                $('.stripeBtn').parents('form').append($('<input>').attr({
                    type: 'hidden',
                    name: 'stripeToken',
                    value: token.id
                })).submit();
            },
            opened: function () {
                console.log("Form opened");
                $(".stripeBtn").prop("disabled", false);
            },
            closed: function () {
                console.log("Form closed");
                $(".stripeBtn").prop("disabled", false);
            }
        });

        $('.stripeBtn').on('click', function (e) {
            $(this).prop("disabled", true);
            // Open Checkout with further options:
            handler.open({
                name: '{{$response->title}}',
                description: '{{$response->description}}',
                amount: strMoney * 100
            });
            e.preventDefault();
        });

        // Close Checkout on page navigation:
        $(window).on('popstate', function () {
            handler.close();
        });


    </script>
    <!-- Stripe Checkout addedd by shahzad -->

    <!-- Paypal Checkout Added by shahzad -->
    <!-- Include the PayPal JavaScript SDK -->
    <script
        src="https://www.paypal.com/sdk/js?client-id=ASy70TwJR4ZZ9M40E_o-EBaF0Ni6c58Cfu46kgsBbti22YddJrR78ZX1yUJd573C820D1rR9d9-GmzAJ&currency=USD"></script>

    <script>
        // Render the PayPal button into #paypal-button-container
        paypal.Buttons({

            // Set up the transaction
            createOrder: function (data, actions) {
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: strMoney
                        }
                    }]
                });
            },

            // Finalize the transaction
            onApprove: function (data, actions) {
                return actions.order.capture().then(function (orderData) {
                    // Successful capture! For demo purposes:
                    console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
                    var transaction = orderData.purchase_units[0].payments.captures[0];
                    //alert('Transaction '+ transaction.status + ': ' + transaction.id + '\n\nSee console for all available details');

                    //window.location = 'thankyou.php?txt_id=' + transaction.id;


                    // Replace the above to show a success message within this page, e.g.
                    // const element = document.getElementById('paypal-button-container');
                    // element.innerHTML = '';
                    // element.innerHTML = '<h3>Thank you for your payment!</h3>';
                    // Or go to another URL:  actions.redirect('thank_you.html');

                    $('.stripeBtn').parents('form').append($('<input>').attr({
                        type: 'hidden',
                        name: 'paypalTxnId',
                        value: transaction.id
                    })).submit();
                });
            },

            onError: function (err) {
                // For example, redirect to a specific error page
                //window.location.href = "/your-error-page-here";
                console.log(err);
            }


        }).render('#paypal-button-container');
    </script>
    <!-- Paypal Checkout Added by shahzad -->


@endsection
