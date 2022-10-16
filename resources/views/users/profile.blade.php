<?php
$trueProfile = true;

$userID = $user->id;

$downloadsCount = App\Models\Images::join('downloads', function ($join) use ($userID) {
    $join->on('downloads.images_id', '=', 'images.id')->where('images.user_id', '=', $userID);
})->count();

if ($user->cover == '') {
    $cover = 'background: #232a29;';
} else {
    $cover = "background: url('cover/$user->cover') no-repeat center center #232a29; background-size: cover;";
}

$purchases = App\Models\Purchases::leftJoin('images', function ($join) {
    $join->on('purchases.images_id', '=', 'images.id');
})
    ->where('images.user_id', $user->id)
    ->select('purchases.*')
    ->addSelect('images.id')
    ->addSelect('images.title')
    ->orderBy('purchases.id', 'DESC');

if (Auth::check()) {

    // FOLLOW ACTIVE
    $followActive = App\Models\Followers::where('follower', Auth::user()->id)
        ->where('following', $user->id)
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

}//<<<<---- *** END AUTH ***
?>

{{-- @extends('app') --}}
@extends('new_template.layouts.app')

@section('title') {{ $title }} @endsection

@section('content')
    <style>
        .changePass {
            position: relative;
        }

        .changePass input {
            padding: 10px;
            border-radius: 10px;
            display: none;
            margin: 10px auto 0px;
            width: 50%;
        }

        .changePass .changePassBtn {
            overflow: hidden;
        }

        .preview {
            overflow: hidden;
            width: 160px;
            height: 160px;
            margin: 10px;
            border: 1px solid red;
        }

        .modal-lg {
            max-width: 1000px !important;
        }

        img {
            max-width: 100%;
        }
    </style>
    <div class="jumbotron profileUser index-header jumbotron_set jumbotron-cover-user"
         style="{{$cover}} padding: 209px 0 80px;">

        <div class="container wrap-jumbotron position-relative">

        @if( Auth::check() && Auth::user()->id == $user->id )
            <!-- *********** COVER ************* -->
                <form class="pull-left myicon-right position-relative" style="z-index: 100;"
                      action="{{url('upload/cover')}}" method="POST" id="formCover" accept-charset="UTF-8"
                      enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <button type="button" class="btn btn-default btn-border btn-sm" id="cover_file"
                            style="margin-top: 10px; background-color: #fff; padding: 4px 14px;">
                        <i class="icon-camera fa fa-camera myicon-right"></i> {{ trans('misc.change_cover') }}
                    </button>
                    <input type="file" name="photo" id="uploadCover" accept="image/*" style="visibility: hidden;">
                </form><!-- *********** COVER ************* -->

            @endif
        </div>
    </div>

    <div class="container-fluid margin-bottom-40 margin-top-40">

        <div class="row"></div>
        <!-- Col MD -->
        <div class="col-md-12">

            <div class="center-block text-center profile-user-over">
                <div class="text-center">
                    <a href="{{ url($user->username) }}" class="w-100 d-flex justify-content-center">
                        <img loading="lazy" src="{{ asset('avatar').'/'.$user->avatar }}" width="150" height="150"
                             class="img-circle border-avatar-profile avatarUser img-object-center"/>
                    </a>
                </div>


                <h1 class="title-item none-overflow font-default">
                    <a href="{{ $user->personal_website }}">
                        @if( $user->name != '' )
                            {{ e( $user->name ) }} <small class="text-muted">{{ '@'.$user->username }}</small>

                        @else

                            {{ e( $user->username ) }}

                        @endif
                    </a>
                </h1>
                @if(!empty($user->personal_website))
                    <small style="display:block;"><a
                            href="{{ $user->personal_website }}">{{  $user->personal_website }}</a></small>
            @endif


            @if( Auth::check() && Auth::user()->id == $user->id )
                <!-- *********** AVATAR ************* -->
                    <form action="{{url('upload/avatar')}}" method="POST" id="formAvatar" accept-charset="UTF-8"
                          enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button type="button" class="btn btn-default btn-border btn-sm" id="avatar_file"
                                style="margin-top: 10px; background-color: #fff; padding: 4px 14px;">
                            <i class="icon-camera fa fa-camera myicon-right"></i> {{ trans('misc.change_avatar') }}
                        </button>
                        <input type="file" name="photo" id="uploadAvatar" accept="image/*"
                               style="visibility: hidden; display: block;">
                    </form><!-- *********** AVATAR ************* -->
                    <form id="personalWebForm" action="{{ url('add/personal') }}" method="post"
                          enctype="multipart/form-data" style="margin-bottom:2em;">
                        @csrf
                        <div class="changePass">
                            <button type="button"
                                    class="changePassBtn btn btn-success">{{ (Auth::user()->personal_website)?Auth::user()->personal_website:'Add Personal Website' }}
                                <i class="fa fa-pencil"></i></button>
                            <input type="url" placeholder="Add Your Personal Website..." name="personal_website"
                                   value="{{ Auth::user()->personal_website }}"/>
                        </div>
                    </form>
                    <div class="container margin-bottom-40 padding-top-40">

                        <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel"
                             aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalLabel">Crop Your Image</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="img-container">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <img id="image" src="" style="max-width: 100%">
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="preview"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel
                                        </button>
                                        <button type="button" class="btn btn-primary" id="rotate">Rotate</button>
                                        <button type="button" class="btn btn-primary" id="crop">Crop and Save</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>

            <div class="row">

            @if( Auth::user()->status == 'active' )

                @if( $settings->limit_upload_user == 0 || $imagesUploads < $settings->limit_upload_user || Auth::user()->role == 'admin'  )

                    <!-- col-md-12 -->
                        <div class="col-md-8 offset-md-2 mt-4">

                            <div class="wrap-center center-block">

                                <div class="alert alert-warning" role="alert">

                                    <ul class="padding-zero">
                                        <?php if ($settings->limit_upload_user == 0) {
                                            $limit = strtolower(trans('admin.unlimited'));
                                        } else {
                                            $limit = $settings->limit_upload_user;
                                        } ?>
                                        <li class="margin-bottom-10"><i
                                                class="glyphicon glyphicon-warning-sign myicon-right"></i> {{ trans('conditions.terms') }}
                                        </li>
                                        <li class="margin-bottom-10"><i
                                                class="glyphicon glyphicon-info-sign myicon-right"></i> {{ trans('conditions.upload_max', ['limit' => $limit ]) }}
                                        </li>
                                        <li class="margin-bottom-10"><i
                                                class="glyphicon glyphicon-info-sign myicon-right"></i> {{ trans('conditions.sex_content') }}
                                        </li>
                                        <li class="margin-bottom-10"><i
                                                class="glyphicon glyphicon-info-sign myicon-right"></i> {{ trans('conditions.own_images') }}
                                        </li>
                                    </ul>

                                </div>
                                @endif
                                @endif
                                @endif

                                @if( Auth::check() && $user->id != Auth::user()->id )
                                    <button type="button"
                                            class="btn btn-xs add-button btn-follow myicon-right btnFollow {{ $activeFollow }}"
                                            data-toggle="tooltip" data-placement="top" data-id="{{ $user->id }}"
                                            data-follow="{{ trans('users.follow') }}"
                                            data-following="{{ trans('users.following') }}">
                                        <i class="glyphicon glyphicon{{ $icoFollow }} myicon-right"></i> {{ $textFollow }}
                                    </button>
                                @endif

                                @if( Auth::check() && $user->id != Auth::user()->id && $user->paypal_account != '' || Auth::guest()  && $user->paypal_account != '' )
                                    <button type="button" class="btn btn-sm btn-default" id="btnFormPP"
                                            title="{{trans('misc.buy_coffee')}}">
                                        <i class="fa fa-paypal myicon-right"
                                           style="color: #003087"></i> {{trans('misc.coffee')}}
                                    </button>
                                @endif

                                @if( Auth::check() && $user->id != Auth::user()->id )
                                    <a href="#" class="btn btn-sm btn-default" data-toggle="modal"
                                       data-target="#reportUser" title="{{trans('misc.report')}}">
                                        <i class="fa fa-flag"></i>
                                    </a>
                                @endif

                                <h4 class="text-bold line-sm position-relative font-family-primary font-default text-muted mb-4"
                                    style="font-size: 22px;">{{ trans('users.about_me') }}</h4>

                                <small class="center-block subtitle-user">
                                    {{ trans('misc.member_since') }} {{ App\Helper::formatDate($user->date) }}
                                </small>

                                @if( $user->countries_id != '' )
                                    <small class="center-block subtitle-user d-block mr-auto ml-auto">
                                        <i class="fa fa-map-marker myicon-right"></i> {{ $user->country()->country_name }}
                                    </small>
                                @endif

                                @if( $user->bio != '' )
                                    <h4 class="text-center bio-user none-overflow"
                                        style="font-size: 18px;">{{ e($user->bio) }}</h4>
                                @endif

                                @if( $user->website != ''
                                                  || $user->twitter != ''
                                                  || $user->facebook != ''
                                              )

                                    @if( $user->website != '' )
                                        <a target="_blank" href="{{ e( $user->website ) }}"
                                           title="{{ trans('misc.website_misc') }}" class="urls-bio icons-bio"
                                           data-toggle="tooltip" data-placement="top">
                                            <i class="icon-link fa fa-link myicon-right"></i>
                                        </a>
                                    @endif

                                    @if( $user->twitter != '' )
                                        <a target="_blank" href="{{ e($user->twitter) }}" title="Twitter"
                                           class="urls-bio icons-bio" data-toggle="tooltip" data-placement="top">
                                            <i class="icon-twitter fa fa-twitter myicon-right"></i>
                                        </a>
                                    @endif

                                    @if( $user->facebook != '' )
                                        <a target="_blank" href="{{ e($user->facebook) }}" title="Facebook"
                                           class="urls-bio icons-bio" data-toggle="tooltip" data-placement="top">
                                            <i class="fa fa-facebook-square myicon-right"></i>
                                        </a>
                                    @endif

                                    @if( $user->instagram != '' )
                                        <a target="_blank" href="{{ e($user->instagram) }}" title="Instagram"
                                           class="urls-bio icons-bio" data-toggle="tooltip" data-placement="top">
                                            <i class="fa fa-instagram myicon-right"></i>
                                        </a>
                                    @endif

                                @endif

                                <ul class="nav nav-pills inlineCounterProfile justify-list-center">

                                    <li>
                                        <small
                                            class="btn-block sm-btn-size text-left counter-sm">{{ App\Helper::formatNumber($user->images()->count()) }}</small>
                                        <span class="text-muted">{{trans('misc.images')}}</span>
                                    </li><!-- End Li -->

                                    @if( Auth::check() && Auth::user()->id == $user->id )
                                        <li>
                                            <small
                                                class="btn-block sm-btn-size text-left counter-sm">{{ App\Helper::formatNumber($user->images_pending()->count()) }}</small>
                                            <a href="{{url( 'photos/pending')}}"
                                               class="text-muted link-nav-user">{{trans('misc.photos_pending')}}</a>
                                        </li><!-- End Li -->
                                    @endif

                                    <li>
                                        <small
                                            class="btn-block sm-btn-size text-left counter-sm">{{ App\Helper::formatNumber($downloadsCount) }}</small>
                                        <span class="text-muted">{{trans('misc.downloads')}}</span>
                                    </li><!-- End Li -->

                                    @if($settings->sell_option == 'on')
                                        <li>
                                            <small
                                                class="btn-block sm-btn-size text-left counter-sm">{{ App\Helper::formatNumber($purchases->count()) }}</small>
                                            <span class="text-muted">{{trans('misc.sales')}}</span>
                                        </li><!-- End Li -->
                                    @endif

                                    <li>
                                        <small
                                            class="btn-block sm-btn-size text-left counter-sm">{{ App\Helper::formatNumber($user->followers()->count()) }}</small>
                                        <a href="{{url($user->username, 'followers')}}"
                                           class="text-muted link-nav-user">{{trans('users.followers')}}</a>
                                    </li><!-- End Li -->

                                    <li>
                                        <small
                                            class="btn-block sm-btn-size text-left counter-sm">{{ App\Helper::formatNumber($user->following()->count()) }}</small>
                                        <a href="{{url( $user->username, 'following')}}"
                                           class="text-muted link-nav-user">{{trans('users.following')}}</a>
                                    </li><!-- End Li -->

                                    <li>
                                        <small
                                            class="btn-block sm-btn-size text-left counter-sm">{{ App\Helper::formatNumber($user->collections()->count()) }}</small>
                                        <a href="{{url( $user->username, 'collections')}}"
                                           class="text-muted link-nav-user">{{trans('misc.collections')}}</a>
                                    </li><!-- End Li -->
                                </ul>

                            </div><!-- Center Div -->

                            <hr/>

                            @if( $images->total() != 0 )

                                <div id="imagesFlex" class="flex-images btn-block margin-bottom-40 dataResult">
                                    @include('includes.images')

                                    @if( $images->count() != 0  )
                                        <div class="container-paginator">
                                            {{ $images->links() }}
                                        </div>
                                    @endif

                                </div><!-- Image Flex -->

                            @else
                                <div class="btn-block text-center">
                                    <i class="icon icon-Picture ico-no-result"></i>
                                </div>

                                <h3 class="margin-top-none text-center no-result no-result-mg">
                                    {{ trans('users.user_no_images') }}
                                </h3>
                            @endif

                        </div><!-- /COL MD -->
            </div><!-- row -->

            @if( Auth::check() && $user->id != Auth::user()->id && $user->paypal_account != '' || Auth::guest()  && $user->paypal_account != '' )
                <form id="form_pp" name="_xclick" action="https://www.paypal.com/cgi-bin/webscr" method="post"
                      style="display:none">
                    <input type="hidden" name="cmd" value="_donations">
                    <input type="hidden" name="return" value="{{url($user->username)}}">
                    <input type="hidden" name="cancel_return" value="{{url($user->username)}}">
                    <input type="hidden" name="currency_code" value="USD">
                    <input type="hidden" name="item_name"
                           value="{{trans('misc.support').' @'.$user->username}} - {{$settings->title}}">
                    <input type="hidden" name="business" value="{{$user->paypal_account}}">
                    <input type="submit">
                </form>
            @endif

            @if( Auth::check() )
                <div class="modal fade" id="reportUser" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-sm">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                                        class="sr-only">Close</span></button>
                                <h4 class="modal-title text-center" id="myModalLabel">
                                    <strong>{{ trans('misc.report') }}</strong>
                                </h4>
                            </div><!-- Modal header -->

                            <div class="modal-body listWrap">

                                <!-- form start -->
                                <form method="POST" action="{{ url('report/user') }}" enctype="multipart/form-data"
                                      id="formReport">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="id" value="{{ $user->id }}">
                                    <!-- Start Form Group -->
                                    <div class="form-group">
                                        <label>{{ trans('admin.reason') }}</label>
                                        <select name="reason" class="form-control">
                                            <option value="spoofing">{{ trans('admin.spoofing') }}</option>
                                            <option value="copyright">{{ trans('admin.copyright') }}</option>
                                            <option value="privacy_issue">{{ trans('admin.privacy_issue') }}</option>
                                            <option
                                                value="violent_sexual_content">{{ trans('admin.violent_sexual_content') }}</option>
                                        </select>

                                    </div><!-- /.form-group-->

                                    <button type="submit"
                                            class="btn btn-sm btn-danger reportUser">{{ trans('misc.report') }}</button>

                                </form>

                            </div><!-- Modal body -->
                        </div><!-- Modal content -->
                    </div><!-- Modal dialog -->
                </div><!-- Modal -->
            @endif
        </div>
    </div>
@endsection
@section('javascript')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.css"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.js"></script>
    <script src="https://wmlgl.github.io/cropperjs-gif/dist/cropperjs-gif-all.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script type="text/javascript">

        $('#imagesFlex').flexImages({rowHeight: 320});

        $('#btnFormPP').click(function (e) {
            $('#form_pp').submit();
        });

        @if( Auth::check() )

        $(".reportUser").click(function (e) {
            var element = $(this);
            e.preventDefault();
            element.attr({'disabled': 'true'});

            $('#formReport').submit();

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
        @endif


        //<<---- PAGINATION AJAX
        $(document).on('click', '.pagination a', function (e) {
            e.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{ url("/") }}/ajax/user/images?id={{$user->id}}&page=' + page


            }).done(function (data) {
                if (data) {

                    scrollElement('#imagesFlex');

                    $('.dataResult').html(data);

                    $('.hovercard').hover(
                        function () {
                            $(this).find('.hover-content').fadeIn();
                        },
                        function () {
                            $(this).find('.hover-content').fadeOut();
                        }
                    );

                    $('#imagesFlex').flexImages({rowHeight: 320});
                    jQuery(".timeAgo").timeago();

                    $('[data-toggle="tooltip"]').tooltip();
                } else {
                    sweetAlert("{{trans('misc.error_oops')}}", "{{trans('misc.error')}}", "error");
                }
                //<**** - Tooltip
            });

        });//<<---- PAGINATION AJAX

        @if( Auth::check() && Auth::user()->id == $user->id )

        //<<<<<<<=================== * UPLOAD AVATAR  * ===============>>>>>>>//
        /* Crop Modal Window */
        var $modal = $('#modal');
        var image = document.getElementById('image');
        var cropper;
        $("body").on("change", "#uploadAvatar", function (e) {
            var files = e.target.files;
            var done = function (url) {
                image.src = url;
                $modal.modal('show');
            };
            var reader;
            var file;
            var url;
            if (files && files.length > 0) {
                file = files[0];
                if (URL) {
                    done(URL.createObjectURL(file));
                } else if (FileReader) {
                    reader = new FileReader();
                    reader.onload = function (e) {
                        done(reader.result);
                    };
                    reader.readAsDataURL(file);
                }
            }
        });

        /* Get Selected image size */
        var imgWidth, imgHeight;
        $("#uploadAvatar").change(function (e) {
            var file, img;
            if ((file = this.files[0])) {
                img = new Image();
                img.onload = function () {
                    console.log("this.width")
                    console.log(this.width)
                    console.log(this.height)
                    imgWidth = this.width;
                    imgHeight = this.height;
                };
            }

        });
        /* Get Selected image size */


        $modal.on('shown.bs.modal', function () {
            cropper = new Cropper(image, {
                aspectRatio: imgWidth / imgHeight,
                viewMode: 1,
                preview: '.preview',
                rotatable: true
            });
        }).on('hidden.bs.modal', function () {
            cropper.destroy();
            cropper = null;
        });

        $("#rotate").click(function () {
            cropper.rotate(90);
            //cropper.move(1, -1).rotate(45).scale(1, -1);
        });

        function cropGif() {
            CropperjsGif.crop({
                    // debug: true,
                    encoder: {
                        workers: 2,
                        quality: 10,
                        workerScript: "../dist/gif.worker.js"
                    },
                    src: gifImg.src,
                    background: '#fff',
                    maxWidth: 600,
                    maxHeight: 600,
                    onerror: function (code, error) {
                        console.log(code, error)
                    }
                },
                cropper,
                function (blob) {
                    previewImg.src = URL.createObjectURL(blob);

                    // test send blob
                    var xhr = new XMLHttpRequest();
                    xhr.open('POST', "/post/test");
                    xhr.onprogress = function (e) {
                        tmp.innerText = "upload progress: " + e.loaded;
                    };
                    xhr.onreadystatechange = function (e) {
                        tmp.innerText = "upload status: " + xhr.status + ", " + xhr.readyState;
                    }
                    if (blob.slice) {
                        xhr.send(blob.slice(0, 10))
                    } else {
                        var fileReader = new FileReader();
                        fileReader.onload = function (event) {
                            xhr.send(event.target.result)
                        };
                        fileReader.readAsArrayBuffer(blob);
                    }
                });
        }

        $("#crop").click(function () {
            canvas = cropper.getCroppedCanvas({
                width: 160,
                height: 160,
            });
            var cropImage = cropper.getCroppedCanvas().toDataURL();
            canvas.toBlob(function (blob) {
                url = URL.createObjectURL(blob);

                var reader = new FileReader();
                var myBlob;
                var xhr = new XMLHttpRequest();
                xhr.open('GET', $('#modal .preview img').attr('src'), true);
                xhr.responseType = 'blob';
                xhr.onload = function (e) {
                    if (this.status == 200) {
                        myBlob = this.response;
                        reader.readAsDataURL(myBlob);
                        reader.onloadend = function () {
                            var base64data = reader.result;
                            $modal.modal('hide');
                            $.ajax({
                                type: "POST",
                                dataType: "json",
                                url: "upload/avatar",
                                data: {
                                    '_token': $('meta[name="_token"]').attr('content'),
                                    'photo': cropImage
                                },
                                success: function (e) {
                                    if (e) {
                                        if (e.success == false) {
                                            $('.wrap-loader').hide();

                                            var error = '';
                                            for ($key in e.errors) {
                                                error += '' + e.errors[$key] + '';
                                            }
                                            swal({
                                                title: "{{ trans('misc.error_oops') }}",
                                                text: "" + error + "",
                                                type: "error",
                                                confirmButtonText: "{{ trans('users.ok') }}"
                                            });

                                            $('#uploadAvatar').val('');

                                        } else {
                                            alert("Avatar changed Successfully!");
                                            $('#uploadAvatar').val('');
                                            $('.img-circle').attr('src', e.avatar);

                                        }

                                    }//<-- e
                                    else {
                                        swal({
                                            title: "{{ trans('misc.error_oops') }}",
                                            text: '{{trans("misc.error")}}',
                                            type: "error",
                                            confirmButtonText: "{{ trans('users.ok') }}"
                                        });

                                        $('#uploadAvatar').val('');
                                    }
                                }//<----- SUCCESS

                            });
                        }
                    }
                };
                xhr.send();
            });
        })
        /* Crop Modal Window  */
        //<<<<<<<=================== * UPLOAD AVATAR  * ===============>>>>>>>//

        //<<<<<<<=================== * UPLOAD COVER  * ===============>>>>>>>//
        $(document).on('change', '#uploadCover', function () {

            $('.wrap-loader').show();

            (function () {
                $("#formCover").ajaxForm({
                    dataType: 'json',
                    error: function error(responseText, statusText, xhr, $form) {
                        $('.wrap-loader').hide();
                        $('#uploadCover').val('');
                        $('.popout').addClass('popout-error').html('{{trans('misc.error')}} (' + xhr +
                            ')').fadeIn('500').delay('5000').fadeOut('500');
                        /*alert('status: ' + statusText + '\n\rresponseText: \n' + responseText + '\n\nxhr: \n' + xhr);*/
                    },
                    success: function (e) {
                        if (e) {
                            if (e.success == false) {
                                $('.wrap-loader').hide();

                                var error = '';
                                for ($key in e.errors) {
                                    error += '' + e.errors[$key] + '';
                                }
                                swal({
                                    title: "{{ trans('misc.error_oops') }}",
                                    text: "" + error + "",
                                    type: "error",
                                    confirmButtonText: "{{ trans('users.ok') }}"
                                });

                                $('#uploadCover').val('');

                            } else {

                                $('#uploadCover').val('');

                                $('.jumbotron-cover-user').css({
                                    background: 'url("' + e.cover + '") center center #232a29',
                                    'background-size': 'cover'
                                });
                                ;
                                $('.wrap-loader').hide();
                            }

                        }//<-- e
                        else {
                            $('.wrap-loader').hide();
                            swal({
                                title: "{{ trans('misc.error_oops') }}",
                                text: '{{trans("misc.error")}}',
                                type: "error",
                                confirmButtonText: "{{ trans('users.ok') }}"
                            });

                            $('#uploadCover').val('');
                        }
                    }//<----- SUCCESS
                }).submit();
            })(); //<--- FUNCTION %
        });//<<<<<<<--- * ON * --->>>>>>>>>>>
        //<<<<<<<=================== * UPLOAD COVER  * ===============>>>>>>>//



        @endif
        //Shows Input Box When Focussed
        $(".changePassBtn").click(function () {
            var neww = $(".changePass input").css("width");
            $(this).animate({}, 300, function () {
                $(".changePass input").fadeIn(300, function () {
                }).css("display", "block").focus();
            });
        });

        //Shows Button When Unfocussed
        $(".changePass input").blur(function () {
            $(".changePassBtn").css("width", "auto");
            var neww = $(".changePassBtn").css("width");
            $(this).animate({}, 300, function () {
                $(".changePassBtn").show(0, function () {
                    $(".changePass input").fadeOut(500, function () {
                        if ($(".changePass input").val() != "") {
                            $(".changePassBtn").html($(".changePass input").val() + ' <i class="fa fa-spin fa-spinner"></i>');
                            var form = $('#personalWebForm');
                            var url = form.attr('action');
                            $.ajax({
                                url: url,
                                type: 'POST',
                                data: form.serialize(),
                                dataType: 'JSON',
                                success: function (data) {
                                    if (data.success) {
                                        swal("Good job!", "Successfully Added!", "success");
                                    } else {
                                        swal("Failed!", data.msg, "error");
                                    }
                                    $(".changePassBtn").html($(".changePass input").val() + ' <i class="fa fa-pencil"></i>');
                                }, error: function (err) {
                                    $(".changePassBtn").html($(".changePass input").val() + ' <i class="fa fa-pencil"></i>');
                                    console.log(err);
                                }
                            });
                        }
                    });
                });
            });
        });
        $('#personalWebForm').on('submit', function (e) {
            e.preventDefault();
            if ($(".changePass input").val() != "") {
                $(".changePassBtn").html($(".changePass input").val() + ' <i class="fa fa-spin fa-spinner"></i>');
                var form = $('#personalWebForm');
                var url = form.attr('action');
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: form.serialize(),
                    dataType: 'JSON',
                    success: function (data) {
                        if (data.success) {
                            swal("Good job!", "Successfully Added!", "success");
                        } else {
                            swal("Failed!", data.msg, "error");
                        }
                        $(".changePassBtn").html($(".changePass input").val() + ' <i class="fa fa-pencil"></i>');
                    }, error: function (err) {
                        $(".changePassBtn").html($(".changePass input").val() + ' <i class="fa fa-pencil"></i>');
                        console.log(err);
                    }
                });
            }
        });
    </script>

@endsection
