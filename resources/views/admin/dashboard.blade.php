<?php

// Total
$images = App\Models\Images::where('is_type', '=', 'image')
    ->orderBy('id', 'DESC')
    ->take(5)
    ->get();
$total_images = App\Models\Images::where('is_type', '=', 'image')->count();

$videos = App\Models\Images::where('is_type', '=', 'video')
    ->orderBy('id', 'DESC')
    ->take(5)
    ->get();
$total_videos = App\Models\Images::where('is_type', '=', 'video')->count();

$audios = App\Models\Images::where('is_type', '=', 'audio')
    ->orderBy('id', 'DESC')
    ->take(5)
    ->get();
$totalAudio = App\Models\Images::where('is_type', '=', 'audio')->count();

$animations = App\Models\Images::where('is_type', '=', 'image')
    ->where('extension', 'gif')
    ->orderBy('id', 'DESC')
    ->take(5)
    ->get();
$totalAnimation = App\Models\Images::where('is_type', '=', 'image')
    ->where('extension', 'gif')
    ->count();

$users = App\Models\User::orderBy('id', 'DESC')->take(5)->get();

// Statistics of the month

// Today
$stat_revenue_today = App\Models\Purchases::where('date', '>=', date('Y-m-d H:i:s', strtotime('today')))
    ->sum('earning_net_admin');

// Week
$stat_revenue_week = App\Models\Purchases::whereBetween('date', [
    Carbon\Carbon::parse()->startOfWeek(),
    Carbon\Carbon::parse()->endOfWeek(),
])
    ->sum('earning_net_admin');

// Month
$stat_revenue_month = App\Models\Purchases::whereMonth('date', date('m'))
    ->sum('earning_net_admin');

?>
@extends('admin.layout')

@section('css')
    <link href="{{ asset('plugins/morris/morris.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('plugins/jvectormap/jquery-jvectormap-1.2.2.css')}}" rel="stylesheet" type="text/css"/>
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                {{ trans('admin.dashboard') }} v{{$settings->version}}
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ url('panel/admin') }}"><i class="fa fa-dashboard"></i> {{ trans('admin.home') }}</a>
                </li>
                <li class="active">{{ trans('admin.dashboard') }}</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">

            <div class="row">

                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-aqua">
                        <div class="inner">
                            <h3>{{ App\Models\Purchases::count() }}</h3>
                            <p>{{ trans('misc.purchases') }}</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-ios-cart"></i>
                        </div>
                        <a href="{{url('panel/admin/purchases')}}" class="small-box-footer">{{trans('misc.view_more')}}
                            <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div><!-- ./col -->

                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-green">
                        <div class="inner">
                            <h3>{{ \App\Helper::amountFormatDecimal( App\Models\Purchases::sum('earning_net_admin') )  }}
                                <sup style="font-size: 12px">{{$settings->currency_code}}</sup></h3>
                            <p>{{ trans('misc.earnings') }}</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-social-usd"></i>
                        </div>
                        <span class="small-box-footer">{{trans('misc.earnings_total')}}</span>
                    </div>
                </div><!-- ./col -->

                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-yellow">
                        <div class="inner">
                            <h3>{{ \App\Helper::formatNumber( \App\Models\User::count() ) }}</h3>
                            <p>{{ trans('misc.members') }}</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-ios-people"></i>
                        </div>
                        <a href="{{url('panel/admin/members')}}" class="small-box-footer">{{trans('misc.view_more')}} <i
                                class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div><!-- ./col -->

                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-red">
                        <div class="inner">
                            <h3>{{ \App\Helper::formatNumber( $total_images ) }}</h3>
                            <p>{{ trans_choice('misc.images_plural', $total_images) }}</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-images"></i>
                        </div>
                        <a href="{{url('panel/admin/images')}}" class="small-box-footer">{{trans('misc.view_more')}} <i
                                class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div><!-- ./col -->

            </div>

            <div class="row">

                <section class="col-md-12">
                    <div class="box">
                        <div class="box-header with-border text-center">
                            <h3 class="box-title"><i
                                    class="fa fa-bar-chart-o"></i> {{trans('misc.statistics_of_the_month')}}</h3>
                        </div>
                        <div class="box-footer">
                            <div class="row">
                                <div class="col-sm-4 col-xs-12">
                                    <div class="description-block border-right">
                                        <h2 class="{{$stat_revenue_today > 0 ? 'text-green' : 'text-red' }}">{{ \App\Helper::amountFormatDecimal($stat_revenue_today) }}</h2>
                                        <span class="description-text text-black">{{trans('misc.revenue_today')}}</span>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-4 col-xs-12">
                                    <div class="description-block border-right">
                                        <h2 class="{{$stat_revenue_week > 0 ? 'text-green' : 'text-red' }}">{{ \App\Helper::amountFormatDecimal($stat_revenue_week) }}</h2>
                                        <span class="description-text text-black">{{trans('misc.revenue_week')}}</span>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-4 col-xs-12">
                                    <div class="description-block">
                                        <h2 class="{{$stat_revenue_month > 0 ? 'text-green' : 'text-red' }}">{{ \App\Helper::amountFormatDecimal($stat_revenue_month) }}</h2>
                                        <span class="description-text text-black">{{trans('misc.revenue_month')}}</span>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->
                        </div><!-- /.box-footer -->
                    </div><!-- /.box -->
                </section>

                <section class="col-md-7">
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs pull-right ui-sortable-handle">
                            <li class="pull-left header"><i
                                    class="ion ion-ios-people"></i> {{ trans('admin.user_registration') }}</li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active">
                                <div class="chart" id="chart1"></div>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="col-md-5">
                    <!-- Map box -->
                    <div class="box box-solid bg-purple-gradient">
                        <div class="box-header">

                            <i class="fa fa-map-marker"></i>
                            <h3 class="box-title">
                                {{ trans('admin.user_countries') }}
                            </h3>
                        </div>
                        <div class="box-body">
                            <div id="world-map" style="height: 350px; width: 100%;"></div>
                        </div><!-- /.box-body-->
                    </div>
                    <!-- /.box -->
                </section>

            </div><!-- ./row -->

            <div class="row">
                <div class="col-md-6">
                    <div class="box box-danger">
                        <div class="box-header with-border">
                            <h3 class="box-title">{{ trans('admin.latest_members') }}</h3>
                            <div class="box-tools pull-right">
                            </div>
                        </div><!-- /.box-header -->

                        <div class="box-body">
                            <ul class="products-list product-list-in-box">
                                @foreach( $users as $user )
                                    @php
                                        switch (  $user->status ) {
                                          case 'active':
                                            $user_color_status = 'success';
                                            $user_txt_status = trans('misc.active');
                                            break;

                                        case 'pending':
                                            $user_color_status = 'info';
                                            $user_txt_status = trans('misc.pending');
                                            break;

                                        case 'suspended':
                                            $user_color_status = 'warning';
                                            $user_txt_status = trans('admin.suspended');
                                            break;

                                        }
                                    @endphp

                                    <li class="item">
                                        <div class="product-img">
                                            <img loading="lazy" src="{{ asset('avatar').'/'.$user->avatar }}"
                                                 style="height: auto !important;"/>
                                        </div>
                                        <div class="product-info">
                                            <a href="{{ url($user->username) }}" target="_blank"
                                               class="product-title">@if($user->name !='' ) {{ $user->name }} @else {{ $user->username }} @endif
                                                <span
                                                    class="label label-{{ $user_color_status }} pull-right">{{ $user_txt_status }}</span>
                                            </a>
                                            <span class="product-description">
                        {{ '@'.$user->username }} / {{ App\Helper::formatDate($user->date) }}
                      </span>
                                        </div>
                                    </li><!-- /.item -->
                                @endforeach

                            </ul><!-- /.users-list -->
                        </div><!-- /.box-body -->

                        <div class="box-footer text-center">
                            <a href="{{ url('panel/admin/members') }}"
                               class="uppercase">{{ trans('admin.view_all_members') }}</a>
                        </div><!-- /.box-footer -->

                    </div>
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">@lang('misc.recent_photos')</h3>
                            <div class="box-tools pull-right">
                            </div>
                        </div><!-- /.box-header -->

                        @if( $total_images != 0 )
                            <div class="box-body">

                                <ul class="products-list product-list-in-box">

                                    @foreach( $images as $image )
                                        <?php
                                        switch ($image->status) {
                                            case 'active':
                                                $color_status = 'success';
                                                $txt_status = trans('misc.active');
                                                break;

                                            case 'pending':
                                                $color_status = 'warning';
                                                $txt_status = trans('admin.pending');
                                                break;
                                        }

                                        if ($image->finalized == 1) {
                                            $color_status = 'default';
                                            $txt_status = trans('misc.finalized');
                                        }
                                        ?>
                                        <li class="item">
                                            <div class="product-img">
                                                <img loading="lazy"
                                                     src="{{ url('uploads/thumbnail',$image->thumbnail) }}"
                                                     style="height: auto !important;"/>
                                            </div>
                                            <div class="product-info">
                                                <a href="{{ url('photo',$image->id) }}" target="_blank"
                                                   class="product-title">{{ $image->title }}
                                                    <span
                                                        class="label label-{{ $color_status }} pull-right">{{ $txt_status }}</span>
                                                </a>
                                                <span class="product-description">
                          {{ date('d M, Y', strtotime($image->date)) }}
                        </span>
                                            </div>
                                        </li><!-- /.item -->
                                    @endforeach
                                </ul>
                            </div><!-- /.box-body -->

                            <div class="box-footer text-center">
                                <a href="{{ url('user/dashboard/photos') }}"
                                   class="uppercase">{{ trans('misc.view_all') }}</a>
                            </div><!-- /.box-footer -->

                        @else
                            <div class="box-body">
                                <h5>{{ trans('admin.no_result') }}</h5>
                            </div><!-- /.box-body -->

                        @endif

                    </div>
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">{{ trans('admin.latest_audios') }}</h3>
                            <div class="box-tools pull-right">
                            </div>
                        </div><!-- /.box-header -->

                        @if( $totalAudio != 0 )
                            <div class="box-body">

                                <ul class="products-list product-list-in-box">

                                    @foreach( $audios as $audio )
                                        <?php
                                        switch ($audio->status) {
                                            case 'active':
                                                $color_status = 'success';
                                                $txt_status = trans('misc.active');
                                                break;

                                            case 'pending':
                                                $color_status = 'warning';
                                                $txt_status = trans('misc.pending');
                                                break;

                                        }
                                        ?>
                                        <li class="item">
                                            <div class="audio-info col-md-4">
                                                <a href="{{ url('video', $audio->id ) }}/{{str_slug($audio->title)}}"
                                                   target="_blank" class="product-title">{{ $audio->title }}
                                                    <span
                                                        class="label label-{{ $color_status }} pull-right">{{ $txt_status }}</span>
                                                </a>
                                                <span class="product-description">
                        {{ trans('misc.by') }} {{ '@'.$audio->user()->username }} / {{ App\Helper::formatDate($audio->date) }}
                      </span>
                                            </div>
                                            <div class="product-img col-md-8">
                                                <audio controls="">
                                                    <source
                                                        src="{{asset('uploads/audio/large/'.$audio->thumbnail)}}"
                                                        type="audio/mpeg"

                                                    >
                                                    Your browser does not support the audio element.
                                                </audio>
                                            </div>

                                        </li><!-- /.item -->
                                    @endforeach
                                </ul>
                            </div><!-- /.box-body -->

                            <div class="box-footer text-center">
                                <a href="{{ url('panel/admin/videos') }}"
                                   class="uppercase">{{ trans('admin.view_all_audios') }}</a>
                            </div><!-- /.box-footer -->

                        @else
                            <div class="box-body">
                                <h5>{{ trans('admin.no_result') }}</h5>
                            </div><!-- /.box-body -->

                        @endif

                    </div>

                </div>
                <div class="col-md-6">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">{{ trans('admin.latest_videos') }}</h3>
                            <div class="box-tools pull-right">
                            </div>
                        </div><!-- /.box-header -->

                        @if( $total_videos != 0 )
                            <div class="box-body">

                                <ul class="products-list product-list-in-box">

                                    @foreach( $videos as $video )
                                        <?php
                                        switch ($video->status) {
                                            case 'active':
                                                $color_status = 'success';
                                                $txt_status = trans('misc.active');
                                                break;

                                            case 'pending':
                                                $color_status = 'warning';
                                                $txt_status = trans('misc.pending');
                                                break;

                                        }
                                        $explodeVideoThumbnail = explode(".", $video->thumbnail)[0] . '.png';
                                        ?>
                                        <li class="item">
                                            <div class="product-img">
                                                <img loading="lazy"
                                                     src="{{ asset('uploads/video/screen_shot/').'/screen-shot-'.$explodeVideoThumbnail }}"
                                                     style="height: auto !important;"/>
                                            </div>
                                            <div class="product-info">
                                                <a href="{{ url('video', $video->id ) }}/{{str_slug($video->title)}}"
                                                   target="_blank" class="product-title">{{ $video->title }}
                                                    <span
                                                        class="label label-{{ $color_status }} pull-right">{{ $txt_status }}</span>
                                                </a>
                                                <span class="product-description">
                        {{ trans('misc.by') }} {{ '@'.$video->user()->username }} / {{ App\Helper::formatDate($video->date) }}
                      </span>
                                            </div>
                                        </li><!-- /.item -->
                                    @endforeach
                                </ul>
                            </div><!-- /.box-body -->

                            <div class="box-footer text-center">
                                <a href="{{ url('panel/admin/videos') }}"
                                   class="uppercase">{{ trans('admin.view_all_videos') }}</a>
                            </div><!-- /.box-footer -->

                        @else
                            <div class="box-body">
                                <h5>{{ trans('admin.no_result') }}</h5>
                            </div><!-- /.box-body -->

                        @endif

                    </div>
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">{{ trans('admin.latest_anime') }}</h3>
                            <div class="box-tools pull-right"></div>
                        </div><!-- /.box-header -->

                        @if( $totalAnimation != 0 )
                            <div class="box-body">
                                <ul class="products-list product-list-in-box">

                                    @foreach( $animations as $anime )
                                        <?php
                                        switch ($anime->status) {
                                            case 'active':
                                                $color_status = 'success';
                                                $txt_status = trans('misc.active');
                                                break;

                                            case 'pending':
                                                $color_status = 'warning';
                                                $txt_status = trans('misc.pending');
                                                break;
                                        }
                                        ?>
                                        <li class="item">
                                            <div class="product-img">
                                                <img loading="lazy"
                                                     src="{{ asset('uploads/thumbnail/').'/'.$anime->thumbnail }}"
                                                     style="height: auto !important;"/>
                                            </div>
                                            <div class="product-info">
                                                <a href="{{ url('photo') }}/{{$anime->id}}" target="_blank"
                                                   class="product-title">{{ $anime->title }}
                                                    <span
                                                        class="label label-{{ $color_status }} pull-right">{{ $txt_status }}</span>
                                                </a>
                                                <span class="product-description">
                            {{ trans('misc.by') }} {{ '@'.$anime->user()->username }} / {{ App\Helper::formatDate($anime->date) }}
                          </span>
                                            </div>
                                        </li><!-- /.item -->
                                    @endforeach
                                </ul>
                            </div><!-- /.box-body -->

                            <div class="box-footer text-center">
                                <a href="{{ url('panel/admin/images') }}"
                                   class="uppercase">{{ trans('admin.view_all_anime') }}</a>
                            </div><!-- /.box-footer -->

                        @else
                            <div class="box-body">
                                <h5>{{ trans('admin.no_result') }}</h5>
                            </div><!-- /.box-body -->

                        @endif

                    </div>
                </div>
            </div>
        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->
@endsection

@section('javascript')

    <!-- Morris -->
    <script src="{{ asset('plugins/morris/raphael-min.js')}}" type="text/javascript"></script>
    <script src="{{ asset('plugins/morris/morris.min.js')}}" type="text/javascript"></script>

    <!-- knob -->
    <script src="{{ asset('plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')}}" type="text/javascript"></script>
    <script src="{{ asset('plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}" type="text/javascript"></script>
    <script src="{{ asset('plugins/knob/jquery.knob.js')}}" type="text/javascript"></script>

    <script type="text/javascript">

        var IndexToMonth = [
            "{{trans('months.01') }}",
            "{{trans('months.02') }}",
            "{{trans('months.03') }}",
            "{{trans('months.04') }}",
            "{{trans('months.05') }}",
            "{{trans('months.06') }}",
            "{{trans('months.07') }}",
            "{{trans('months.08') }}",
            "{{trans('months.09') }}",
            "{{trans('months.10') }}",
            "{{trans('months.11') }}",
            "{{trans('months.12') }}"
        ];

        //** Charts
        new Morris.Area({
            // ID of the element in which to draw the chart.
            element: 'chart1',
            // Chart data records -- each entry in this array corresponds to a point on
            // the chart.
            data: [
                    <?php
                    for ( $i = 0; $i < 30; ++$i) {

                    $date = date('Y-m-d', strtotime('today - ' . $i . ' days'));
                    $members = App\Models\User::whereRaw("DATE(date) = '" . $date . "'")->count();

                    //print_r(DB::getQueryLog());
                    ?>

                {
                    days: '<?php echo $date; ?>', value: <?php echo $members ?> },

                <?php } ?>
            ],
            // The name of the data record attribute that contains x-values.
            xkey: 'days',
            // A list of names of data record attributes that contain y-values.
            ykeys: ['value'],
            // Labels for the ykeys -- will be displayed when you hover over the
            // chart.
            labels: ['{{ trans("admin.members") }}'],
            pointFillColors: ['#FF5500'],
            lineColors: ['#DDD'],
            hideHover: 'auto',
            gridIntegers: true,
            resize: true,
            xLabelFormat: function (x) {
                var month = IndexToMonth[x.getMonth()];
                var year = x.getFullYear();
                var day = x.getDate();
                return day + ' ' + month;
                //return  year + ' '+ day +' ' + month;
            },
            dateFormat: function (x) {
                var month = IndexToMonth[new Date(x).getMonth()];
                var year = new Date(x).getFullYear();
                var day = new Date(x).getDate();
                return day + ' ' + month;
                //return year + ' '+ day +' ' + month;
            },

        });// <------------ MORRIS


        /* jQueryKnob */
        $(".knob").knob();

        //jvectormap data
        var visitorsData = {
            <?php

                $users_countries = App\Models\User::where('countries_id', '<>', '')->groupBy('countries_id')->get();

                foreach ( $users_countries as $key ) {

                $total = App\Models\Countries::find($key->countries_id);
                ?>

            "{{ $key->country()->country_code }}": {{ $total->users()->count() }}, <?php } ?>
        };

        //World map by jvectormap
        $('#world-map').vectorMap({
            map: 'world_mill_en',
            backgroundColor: "transparent",
            regionStyle: {
                initial: {
                    fill: '#e4e4e4',
                    "fill-opacity": 1,
                    stroke: 'none',
                    "stroke-width": 0,
                    "stroke-opacity": 1
                }
            },
            series: {
                regions: [{
                    values: visitorsData,
                    scale: ["#92c1dc", "#00a65a"],
                    normalizeFunction: 'polynomial'
                }]
            },
            onRegionLabelShow: function (e, el, code) {
                if (typeof visitorsData[code] != "undefined")
                    el.html(el.html() + ': ' + visitorsData[code] + ' {{ trans("admin.registered_members") }}');
            }
        });
    </script>
@endsection
