@extends('new_template.layouts.app')
@section('title'){{ $useGuidePageSettings->title.' - ' }}@endsection
@section('content')
<div id="use_guide_page">
    <div class="bg-license" style="background-image:url(<?php echo url('use_guide_page/header_assets/') . '/' . $useGuidePageSettings->header_main_image; ?>);">
        <div class="container wrap-jumbotron position-relative">
            <h1 class="title-site">{{ $useGuidePageSettings->header_heading }}</h1>
            <p>{{ $useGuidePageSettings->header_description }}</p>
        </div>
    </div>
    <div class="row">
        <div class="col-12 text-center">
            <div class="box-div about-new-box-1">
                <h4><b>{{ $useGuidePageSettings->section_header }}</b></h4>
                <p>{{ $useGuidePageSettings->section_description }} </p>
                <div>
                    {!! $useGuidePageSettings->link_youtube_video !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
