{{-- @extends('app') --}}

@extends('new_template.layouts.app')


@section('title'){{ e($title ?? '') }}@endsection

@section('content')

<!-- Main Search Container -->
<!--<div class="container-fluid" style="background-color: #fff;">-->
<div class="container-fluid" style="">
    <div class="row m-0 mt-2 fixed-row-search">
        <div class="col-md-2 align-self-center" id="toggleCol1">
            <div class="filters-head-area row">
                <div class="col-6 align-self-center" id="filterBtnDiv">
                    <h6 class="toggleFiltersBtn">
                        <img loading="lazy" src="{{ asset('search-page-img/filters.png') }}" alt="" class="set-filter-icon">
                        <span>Filters</span>
                    </h6>
                </div>
                <div class="col-6 text-right  align-self-center hideClearBtnDiv">
                    <button class="btn-clear-filters ">Clear all</button>
                </div>
            </div>
        </div>
        <div class="col-md-10">
            <form action="{{ url('/search') }}" id="formSearch" method="get">
                <input type="hidden" id="sort" name="sort" value="<?php echo \Request::query('sort'); ?>">
                <input type="hidden" id="sub_category" name="sub_category" value="<?php echo \Request::query('sub_category'); ?>">
                <div class="main-search-bar search-bar-search-page">
                    <div class="row no-gutters">

                        <div class="col-2">
                            <select class="select2-icon" name="by" id="by">
                                <option <?php echo (\Request::query('by') == 'by-industry') ? 'selected' : ''; ?> value="by-industry">By Industry</option>
                                <option <?php echo (\Request::query('by') == 'by-profession') ? 'selected' : ''; ?> value="by-profession">By Profession</option>
                            </select>
                        </div>
                        <div class="col-2 second-search">
                            <?php if (\Request::query('type') !== NULL) { ?>
                                <select class="select22-icon" name="type" id="type" style="<?php echo (\Request::query('type') == null) ? 'display:none;' : 'display:block;' ?>">
                                <?php } else { ?>
                                    <select class="select22-icon" id="type" style="<?php echo (\Request::query('type') == null) ? 'display:none;' : 'display:block;' ?>">
                                    <?php } ?>
                                    <option value="all" data-icon="far fa-images">All</option>
                                    <?php
                                    $getCategoriesSearchBar = \App\Models\Categories::where('slug', '!=', 'uncategorized')->where('parent_id', '=', '0')->get();

                                    foreach ($getCategoriesSearchBar as $categSearchBar) {
                                        if ($categSearchBar->id == \Request::query('type')) {
                                    ?>
                                            <option selected value="{{ $categSearchBar->id }}" data-icon="fas fa-photo-video">{{ $categSearchBar->name }}</option>
                                        <?php
                                        } else {
                                        ?>
                                            <option value="{{ $categSearchBar->id }}" data-icon="fas fa-photo-video">{{ $categSearchBar->name }}</option>
                                    <?php
                                        }
                                    }
                                    ?>
                                    </select>

                                    <?php if (\Request::query('artist') !== NULL) { ?>
                                        <select class="select222-icon" name="artist" id="artist" style="<?php echo (\Request::query('artist') == null) ? 'display:none;' : 'display:block' ?>">
                                        <?php } else { ?>
                                            <select class="select222-icon" id="artist" style="<?php echo (\Request::query('artist') == null) ? 'display:none;' : 'display:block' ?>">
                                            <?php } ?>
                                            <option value="all" data-icon="far fa-images">All</option>
                                            <?php
                                            $getCategoriesSearchBar = \App\Models\Types::get();

                                            foreach ($getCategoriesSearchBar as $categSearchBar) {

                                                if ($categSearchBar->types_id == \Request::query('artist')) {
                                            ?>
                                                    <option selected value="{{ $categSearchBar->types_id }}" data-icon="fas fa-photo-video">{{ $categSearchBar->type_name }}</option>
                                                <?php
                                                } else {
                                                ?>
                                                    <option value="{{ $categSearchBar->types_id }}" data-icon="fas fa-photo-video">{{ $categSearchBar->type_name }}</option>
                                            <?php
                                                }
                                            }
                                            ?>
                                            <?php
                                            // $getTypeSearchBar = \App\Models\Types::get();

                                            // foreach($getTypeSearchBar as $typeSearchBar){
                                            ?>
                                            {{-- <!-- <option value="{{ $typeSearchBar->types_id }}" data-icon="fas fa-photo-video">{{ $typeSearchBar->type_name }}</option> -->--}}
                                            <?php
                                            // }
                                            ?>
                                            </select>

                        </div>
                        <div class="col-8">
                            <div class="input-group">
                                <input type="text" class="form-control mt-0" name="txt_search" id="txt_search" placeholder="Search" value="{{ Request::query('txt_search') }}">
                                <div class="input-group-append">
                                    <button class="btn btn-secondary" id="btnSubmitSearch" type="button">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
    <div class="row m-0">
        <div class="col-md-2 border-side-bar p-1" id="sideBarSearch">
            <div class="side-bar">
                <div class="sort-by-search">
                    <div class="accordion" id="faq11">
                        <div class="card">
                            <div class="card-header" id="faqhead1">
                                <a href="#" class="btn btn-header-link collapsed" data-toggle="collapse" data-target="#faq1" aria-expanded="true" aria-controls="faq1">Sort by</a>
                            </div>
                            <div id="faq1" class="collapse show" aria-labelledby="faqhead1" data-parent="#faq11">
                                <div class="card-body">
                                    <!-- <ul class="d-flex flex-wrap justify-content-center sort-by-ul">
                                            <li class="mb-2">
                                                <button class="btn-sort-by-search active">
                                                Most Relevant
                                                </button>
                                            </li>
                                            <li class="mb-2 ">
                                                <button class="btn-sort-by-search">
                                                Fresh Content
                                                </button>
                                            </li>
                                        </ul> -->
                                    <ul class="sort-by-ul" style="column-count: 2;">
                                        <li class="mb-2">
                                            <!-- <button name="sort" id="sort-Downloaded" class="btn-sort-by-search ">
                                                Most Downloaded
                                                </button> -->
                                            <input type="button" style="<?php echo (\Request::query('artist') != null) ? 'display:none;' : 'display:block;' ?>" name="sortOption" id="sortOption-Downloaded" class="btn-sort-by-search <?php echo (\Request::query('sort') == "Downloaded") ? 'active' : ''; ?>" value="Downloaded">
                                        </li>
                                        <li class="mb-2 ">
                                            <!-- <button name="sort" id="sort-Fresh" class="btn-sort-by-search active">
                                                Fresh Content
                                                </button> -->
                                            <input type="button" name="sortOption" id="sortOption-Fresh" class="btn-sort-by-search <?php echo (\Request::query('sort') == "Fresh") ? 'active' : ''; ?>" value="Fresh">
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="accordion" id="faq22Type" style="<?php echo (\Request::query('type') != null) ? 'display:block;' : 'display:none;' ?>">
                        <div class="card">
                            <div class="card-header" id="faqhead2">
                                <a href="#" class="btn btn-header-link collapsed " data-toggle="collapse" data-target="#faq2" aria-expanded="true" aria-controls="faq2">Type</a>
                            </div>

                            <div id="faq2" class="collapse show" aria-labelledby="faqhead2" data-parent="#faq22">
                                <div class="card-body">
                                    <ul class="sort-by-ul" style="column-count: 2;">

                                        <?php
                                        $getCategories = \App\Models\Categories::where('slug', '!=', 'uncategorized')->where('link_with', '!=', '0')->where('parent_id', '=', '0')->get();

                                        foreach ($getCategories as $categ) {
                                            if ($categ->id == \Request::query('type')) {
                                        ?>

                                                <li class="mb-2 "><a href="javascript:;" id="btnType-{{ $categ->id }}" class="btn-sort-by-search active">
                                                        {{ $categ->name }}
                                                    </a>
                                                </li>
                                            <?php
                                            } else {
                                            ?>
                                                <li class="mb-2 "><a href="javascript:;" id="btnType-{{ $categ->id }}" class="btn-sort-by-search ">
                                                        {{ $categ->name }}
                                                    </a>
                                                </li>
                                        <?php
                                            }
                                        }
                                        ?>
                                        <!-- <li class="mb-2 "><button class="btn-sort-by-search">
                                                Fresh Content
                                                </button>
                                            </li> -->
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="accordion" id="faq33Artist" style="<?php echo (\Request::query('artist') != null) ? 'display:block;' : 'display:none;' ?>">
                        <div class="card">
                            <div class="card-header" id="faqhead3">
                                <a href="#" class="btn btn-header-link collapsed" data-toggle="collapse" data-target="#faq3" aria-expanded="true" aria-controls="faq3">Artist</a>
                            </div>

                            <div id="faq3" class="collapse show" aria-labelledby="faqhead3" data-parent="#faq33">
                                <div class="card-body">
                                    <ul class="sort-by-ul" style="column-count: 2;">

                                        <?php
                                        $getArtistTypes = \App\Models\Types::get();

                                        foreach ($getArtistTypes as $type) {

                                            if ($type->types_id == \Request::query('artist')) {
                                        ?>

                                                <li class="mb-2">
                                                    <button id="btnArtist-{{ $type->types_id }}" class="btn-sort-by-search active">
                                                        {{ $type->type_name }}
                                                    </button>
                                                </li>
                                            <?php
                                            } else {
                                            ?>
                                                <li class="mb-2">
                                                    <button id="btnArtist-{{ $type->types_id }}" class="btn-sort-by-search">
                                                        {{ $type->type_name }}
                                                    </button>
                                                </li>
                                        <?php
                                            }
                                        }
                                        ?>
                                        <!-- <li class="mb-2 "><button class="btn-sort-by-search">
                                                Fresh Content
                                                </button>
                                            </li>
                                            <li class="mb-2 "><button class="btn-sort-by-search">
                                                Fresh Content
                                                </button>
                                            </li> -->
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="accordion" id="faq44" style="<?php echo (\Request::query('artist') != null) ? 'display:none;' : 'display:block;' ?>">
                        <div class="card">
                            <div class="card-header" id="faqhead4">
                                <a href="#" class="btn btn-header-link collapsed " data-toggle="collapse" data-target="#faq4" aria-expanded="true" aria-controls="faq4">Sub Category</a>
                            </div>

                            <div id="faq4" class="collapse show" aria-labelledby="faqhead4" data-parent="#faq44">
                                <div class="card-body">
                                    <select class="select2-icon2" name="select_sub_category" id="select_sub_category">

                                        <?php
                                            if(\Request::query("sub_category") == ""){
                                        ?>
                                                <option value="All">All Sub Category</option>

                                        <?php
                                            }
                                            $getSubCategory = \App\Models\Categories::where('parent_id', '!=', '0')->get();
                                            foreach ($getSubCategory as $subCat) {
                                                if(\Request::query('sub_category') == $subCat->id){
                                        ?>
                                                    <option selected value="{{ $subCat->id }}">{{ $subCat->name }}</option>

                                        <?php
                                                }else{
                                        ?>
                                                    <option value="{{ $subCat->id }}">{{ $subCat->name }}</option>
                                        <?php
                                                }
                                            }
                                        ?>

                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="accordion" id="faq44s" style="<?php echo (\Request::query('type') != 4) ? 'display:none;' : 'display:block;' ?>">

                        <?php

                        foreach($getParentMusicTypes as $pmt){ ?>

                        <?php

                            $getChildMusicTypes = \App\Models\MusicType::where('parent_id','=', $pmt->id)->where('is_deleted','=','0')->get();




                            if(count($getChildMusicTypes) > 0){
                        ?>
                            <div class="card">
                                <div class="card-header" id="faqhead4-<?php echo $pmt->id; ?>">
                                    <a href="#" class="btn btn-header-link collapsed " data-toggle="collapse" data-target="#faq4-<?php echo $pmt->id; ?>" aria-expanded="true" aria-controls="faq4-<?php echo $pmt->id; ?>"><?php echo $pmt->music_type; ?></a>
                                </div>

                                <div id="faq4-<?php echo $pmt->id; ?>" class="collapse show" aria-labelledby="faqhead4-<?php echo $pmt->id; ?>" data-parent="#faq44s">
                                    <div class="card-body">
                                        <select class="form-control" name="select_parent_music_type[]" id="select_parent_music_type-<?php echo $pmt->id; ?>">
                                            <option value="">Select <?php echo $pmt->music_type; ?></option>
                                            <?php
                                                $index = 0;
                                                foreach ($getChildMusicTypes as $cmt) {
                                                    if(\Request::query('select_parent_music_type') != null){
                                                        $Data = \Request::query('select_parent_music_type');
                                                        $countData = count($Data);
                                                        // dd($countData);

                                                        if(in_array($cmt->id, $Data)){
                                            ?>
                                                            <option selected value="{{ $cmt->id }}">{{ $cmt->music_type }}</option>
                                            <?php

                                                        }else{
                                            ?>
                                                            <option value="{{ $cmt->id }}">{{ $cmt->music_type }}</option>
                                            <?php
                                                        }
                                                        $index++;
                                                    }else{
                                            ?>
                                                        <option value="{{ $cmt->id }}">{{ $cmt->music_type }}</option>
                                            <?php
                                                    }
                                                }
                                            ?>

                                        </select>
                                    </div>
                                </div>
                            </div>
                        <?php
                            }
                        }
                        ?>
                    </div>
                    <!-- <div class="accordion" id="faq66">
                            <div class="card">
                                <div class="card-header" id="faqhead5">
                                    <a href="#" class="btn btn-header-link " data-toggle="collapse" data-target="#faq5"
                                    aria-expanded="true" aria-controls="faq5">Include Keywords</a>
                                </div>

                                <div id="faq5" class="collapse show" aria-labelledby="faqhead5" data-parent="#faq66">
                                    <div class="card-body">
                                        <textarea name="" id="" class="form-control" placeholder="Enter Keywords" rows="2"></textarea>
                                        <p>
                                            Enter a comma-separated list of keywords to exclude from this search
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                    <!-- <div class="accordion" id="faq77">
                            <div class="card">
                                <div class="card-header" id="faqhead6">
                                    <a href="#" class="btn btn-header-link " data-toggle="collapse" data-target="#faq6"
                                    aria-expanded="true" aria-controls="faq6">Image size</a>
                                </div>

                                <div id="faq6" class="collapse show" aria-labelledby="faqhead6" data-parent="#faq77">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="measurement ">Measurement</label>
                                            <select class="form-control form-search-page" id="measurement">
                                                <option>Pixel</option>
                                                <option>Inches - 300</option>
                                                <option>Inches - 150</option>
                                                <option>Inches - 150</option>
                                                <option>Inches - 150</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="min-width">Min Width</label>
                                            <input type="number" class="form-control form-search-page" id="min-width">
                                        </div>
                                        <div class="form-group">
                                            <label for="min-height">Min Height</label>
                                            <input type="number" class="form-control form-search-page" id="min-height">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                </div>
            </div>
        </div>
        <div class="col-md-10 mt-4" id="mainSection">
            <div class="tag-box-area">
                <div class="row">
                    <div class="col-md-8">
                        <h2>

                            @if($images['type'] !== null)

                                {{ 'Stock' }}
                            @else

                                {{ 'Artist' }}
                            @endif

                        </h2>
                        <p>
                        @if(isset($images['type']) != NULL && $images['type'] != "4")
                            {{ $images['images']->total() }} {{ ($images['type'] !== null) ? 'Stock' : 'Artist' }} photos, vectors, and illustrations are available royalty-free.
                        @elseif(isset($images['type']) != NULL && $images['type'] == "4")

                            {{ $images['images']->total() }} {{ ($images['type'] !== null) ? 'Stock' : 'Artist' }} music files are available royalty-free.
                        @else
                        {{ $images['images']->total() }} {{ ($images['type'] !== null) ? 'Stock' : 'Artist' }} photographers, videographers, musicians and animators are available royalty-free.
                        @endif
                        </p>
                    </div>
                    <div class="col-md-4 text-right">
                        <!-- <ul class="pagination d-flex justify-content-end"> -->
                            <!-- <li><a href="">«</a></li>
                            <li><a href="" class="active">1</a></li>
                            <li><a href="">»</a></li> -->


                        <!-- </ul> -->

                        {{ $images['images']->appends(request()->query())->links() }}

                    </div>
                </div>
                <div class="tags-search mt-3" style="<?php echo (\Request::query('artist') != null) ? 'display:none;' : 'display:block;' ?>">
                    <ul class="d-flex flex-wrap">
                        @foreach($sliceArrayAnyTenImageTags as $ImageTags)
                            @php
                                $slashString = preg_replace('/[^A-Za-z0-9\-]/', '/', $ImageTags);
                            @endphp
                        <li><a id="tags-{{ $slashString }}" href="javascript:;">{{ $ImageTags }}</a></li>
                        @endforeach
                        <!-- <li><a href="" class="active">father and son</a></li> -->
                    </ul>
                </div>
            </div>
            </form>

            @if(isset($images['type']) != NULL)

                @if($images['type'] == 4)
                    <div class="row">
                        <div class="col-12">
                        <?php

                            if($images['images']->total() != 0){
                                foreach($images['images'] as $imge){
                        ?>
                                    <div class="audio-song-box">
                                        <div class="audio-head d-flex">
                                            <h1 class="align-self-end"><?php echo $imge->original_name; ?></h1>
                                            <div class="audio-icons ml-auto d-flex align-self-center">
                                                <!-- <a href="" class="icon-one"><i class="fas fa-download"></i></a>
                                                <a href="" class="icon-one"><i class="fas fa-heart"></i></a> -->
                                                <a href="<?php echo url('/uploads/audio/large/'). '/'. $imge->thumbnail; ?>" download="<?php echo $imge->thumbnail; ?>" class="buy-track"><i class="fas fa-download"></i> Download</a>
                                            </div>
                                        </div>
                                        <audio controls class="audio-one">
                                            <source src="<?php echo url('/uploads/audio/large/').'/' . $imge->thumbnail; ?>"  type="audio/mp3">
                                        </audio>
                                    </div>
                        <?php
                                }
                            }else{
                        ?>
                                <div class="btn-block text-center">
                                    <i class="icon icon-Picture ico-no-result"></i>
                                </div>

                                <h3 class="margin-top-none text-center no-result no-result-mg">
                                    {{ trans('misc.no_results_found') }}
                                </h3>
                        <?php
                            }
                        ?>
                        </div>
                    </div>
                @else
                    <div class="search-page-grid-area">
                        @if($images['type'] !== null)
                            @php
                                $i = 0;
                            @endphp
                            @if($images['images']->total() > 0)
                                <section class="baguetteBoxOne gallery" id="photos">
                                    @foreach($images['images'] as $image)

                                        @php
                                            $colors = explode(",", $image->colors);
                                            $color = $colors[0];
                                            if($image->extension == 'png' ) {
                                            $background = 'background: url('.url('img/pixel.gif').') repeat center center #e4e4e4;';
                                            } else {
                                            $background = 'background-color: #'.$color.'';
                                            }
                                            if($settings->show_watermark == '1') {
                                            $thumbnail = 'uploads/preview/'.$image->preview;
                                            } else {
                                            $stockImage = App\Models\Stock::whereImagesId($image->id)->whereType('small')->select('name')->first();
                                            $thumbnail = 'uploads/small/'.$stockImage->name;
                                            }

                                            $watermarkedVideoPath = 'uploads/video/water_mark_large/';
                                        @endphp

                                        @if($image->is_type == "video")
                                            <div class="box">
                                                <a href="{{ url('video', $image->id ) }}/{{str_slug($image->title)}}">
                                                    <video onmouseover="this.play()" onmouseout="this.pause()" width="320" height="240" muted loop>
                                                        @if($image->extension == "mp4")
                                                            <source src="{{ asset($watermarkedVideoPath) }}{{ '/watermark-'.$image->thumbnail }}" type="video/mp4">
                                                        @endif
                                                        <!-- <source src="movie.ogg" type="video/ogg"> -->
                                                        Your browser does not support the video tag.
                                                    </video>
                                                </a>
                                            </div>
                                        @else
                                            <div class="box">
                                                <a href="{{ url('photo', $image->id ) }}/{{str_slug($image->title)}}"><img class="img-fluid" src="{{ asset($thumbnail) }}"></a>
                                            </div>
                                        @endif
                                    @endforeach
                                </section>
                            @else
                                <div class="row">
                                    <div class="col-md-12 margin-top-20 margin-bottom-20">
                                        <div class="btn-block text-center">
                                            <i class="icon icon-Picture ico-no-result"></i>
                                        </div>
                                        <h3 class="margin-top-none text-center no-result no-result-mg">
                                            No results have been found
                                        </h3>
                                    </div>
                                </div>
                            @endif
                        @else

                            @php
                                $i = 0;
                            @endphp
                            @if($images['images']->total() > 0)
                                <div class="row">
                                    @foreach($images['images'] as $image)
                                    <div class="col-lg-4 col-md-6 mb-4-cutom">
                                        <div class="choose-photographer-box">
                                		<div class="pt-4 pb-1 pl-3 pr-3">
                                			<div class="">
                            					<img loading="lazy" src="<?php echo url('/')?>/avatar/<?php echo $image->avatar; ?>" alt="" class="photographer-thimbnial">
                                			    <h4 class="title-this-photographer">{{ $image->username }}</h4>
                                                <p class="tag-one-photographer">{{ $image->type_name }}</p>
                                                <p class="tag-one-photographer" style="    margin-left: 77px;">{{ $image->CountryName }}</p>
                                                        <?php
                                                            if($image->user_type_id == "1"){
                                                        ?>
                                                              <div class="mt-4" style="text-align: center;">
                                            			        <?php
                                                                $queryGetDataById = App\Models\Images::where(['is_type' => 'image', 'user_id' => $image->id])->limit(4)->get();
                                                                // var_dump($userPhotographer->id);
                                                                // dd(count($queryGetDataById));
                                                                if(count($queryGetDataById) > 0){


                                                            ?>
                                            			        @foreach($queryGetDataById as $dataUserImages)
                                                			        @php
                                                    			        if($settings->show_watermark == '1') {
                                        								    $thumbnail = 'uploads/preview/'.$dataUserImages->preview;
                                        								} else {
                                            								$stockImage = App\Models\Stock::whereImagesId($dataUserImages->id)->whereType('small')->select('name')->first();
                                            								$thumbnail = 'uploads/small/'.$stockImage->name;
                                        								}
                                    								@endphp
                                    								<a data-fancybox href="{{ asset($thumbnail) }}">

                                                					    <img loading="lazy" src="{{ asset($thumbnail) }}" alt="" class="set-img-size">
                                                    			    </a>
                                            					@endforeach
                                            					<?php
                                                                }
                                        					?>
                                            					<!--<img loading="lazy" src="<?php //echo url('/')?>/avatar/<?php //echo $userPhotographer->avatar; ?>" alt="" class="set-img-size">-->
                                            					<!--<img loading="lazy" src="<?php //echo url('/')?>/avatar/<?php //echo $userPhotographer->avatar; ?>" alt="" class="set-img-size">-->
                                            					<!--<img loading="lazy" src="<?php //echo url('/')?>/avatar/<?php //echo $userPhotographer->avatar; ?>" alt="" class="set-img-size">-->
                                        					</div>
                                                        <?php
                                                            }else if($image->user_type_id == "3"){
                                                        ?>
                                                                <div class="mt-4" style="text-align: center;">
                                                			        <?php
                                                                        $queryVideosGetDataById = App\Models\Images::where(['is_type' => 'video', 'user_id' => $image->id])->limit(4)->get();
                                                                        // var_dump($userVideographer->id);
                                                                        // dd(count($queryVideosGetDataById));
                                                                        if(count($queryVideosGetDataById) > 0){


                                                                    ?>
                                                    			        @foreach($queryVideosGetDataById as $dataUserVideos)
                                                        			        @php
                                                            			        if($settings->show_watermark == '1') {
                                                								    $thumbnail = 'uploads/preview/'.$dataUserVideos->preview;
                                                								} else {
                                                    								$stockImage = App\Models\Stock::whereImagesId($dataUserVideos->id)->whereType('small')->select('name')->first();
                                                    								$thumbnail = 'uploads/small/'.$stockImage->name;
                                                								}

                                                								$watermarkedVideoPathScreenShot = 'uploads/video/screen_shot/';
                                                								$watermarkedVideoPath = 'uploads/video/water_mark_large/';

                                                								$VideoFileScreenShotName = explode('.', $dataUserVideos->thumbnail)[0];

                                                								$realVideoFileName = $dataUserVideos->thumbnail;
                                            								@endphp
                                            								<a data-fancybox href="{{ asset($watermarkedVideoPath) }}{{ '/watermark-'.$realVideoFileName }}">
                                                    					        <img loading="lazy" src="{{ asset($watermarkedVideoPathScreenShot) }}{{ '/screen-shot-'.$VideoFileScreenShotName.'.png' }}" alt="" class="set-img-size">
                                                    					    </a>
                                                    					@endforeach
                                                					<?php
                                                                        }
                                                					?>
                                            					<!--<img loading="lazy" src="<?php //echo url('/')?>/avatar/<?php //echo $userVideographer->avatar; ?>" alt="" class="set-img-size">-->
                                            					<!--<img loading="lazy" src="<?php //echo url('/')?>/avatar/<?php //echo $userVideographer->avatar; ?>" alt="" class="set-img-size">-->
                                            					<!--<img loading="lazy" src="<?php //echo url('/')?>/avatar/<?php //echo $userVideographer->avatar; ?>" alt="" class="set-img-size">-->
                                        					   </div>
                                                        <?php
                                                            }else if($image->user_type_id == "2"){
                                                        ?>
                                                                <div class="mt-4" style="text-align: center;">
                                                    			        <?php
                                                                        $queryAnimationsGetDataById = App\Models\Images::where(['is_type' => 'video', 'user_id' => $image->id])->limit(4)->get();
                                                                        if(count($queryAnimationsGetDataById) > 0){


                                                                    ?>
                                                    			        @foreach($queryAnimationsGetDataById as $dataUserAnimations)
                                                        			        @php
                                                            			        if($settings->show_watermark == '1') {
                                                								    $thumbnail = 'uploads/preview/'.$dataUserAnimations->preview;
                                                								} else {
                                                    								$stockImage = App\Models\Stock::whereImagesId($dataUserAnimations->id)->whereType('small')->select('name')->first();
                                                    								$thumbnail = 'uploads/small/'.$stockImage->name;
                                                								}

					                        									$watermarkedVideoPathScreenShot = 'uploads/video/screen_shot/';

                                                								$AnimationFileScreenShotName = explode('.', $dataUserAnimations->thumbnail)[0];

                                                								$watermarkedVideoPath = 'uploads/video/water_mark_large/';

                                                								$realVideoFileName = $dataUserAnimations->thumbnail;
                                            								@endphp
                                            								<a data-fancybox href="{{ asset($watermarkedVideoPath) }}{{ '/watermark-'.$realVideoFileName }}">
                                                    					        <img loading="lazy" src="{{ asset($watermarkedVideoPathScreenShot) }}{{ '/screen-shot-'.$AnimationFileScreenShotName.'.png' }}" alt="" class="set-img-size">
                                                					        </a>
                                                    					@endforeach
                                                    					<!--<img loading="lazy" src="<?php echo url('/')?>/avatar/<?php //echo $userAnimator->avatar; ?>" alt="" class="set-img-size">-->
                                                    					<!--<img loading="lazy" src="<?php echo url('/')?>/avatar/<?php //echo $userAnimator->avatar; ?>" alt="" class="set-img-size">-->
                                                    					<!--<img loading="lazy" src="<?php echo url('/')?>/avatar/<?php //echo $userAnimator->avatar; ?>" alt="" class="set-img-size">-->
                                                    					<?php
                                                                        }else{
                                                                    ?>
                                                                    <p class="dummy-text-when-another-div-empty">
                                                                                No Animation Available
                                                                            </p>
                                                                    <?php
                                                                        }
                                                					?>
                            					                </div>
                                                        <?php
                                                            }else if($image->user_type_id == "4"){
                                                        ?>
                                              			        <div class="mt-4" style="text-align: center;">
                                                			        <?php
                                                                        $queryMusiciansGetDataById = App\Models\Images::where(['is_type' => 'audio', 'user_id' => $image->id])->limit(1)->get();
                                                                        if(count($queryMusiciansGetDataById) > 0){
                                                                    ?>
                                                        			        @foreach($queryMusiciansGetDataById as $dataUserMusicians)
                                                        			            {{-- @php --}}
                                                            <!--    			        if($settings->show_watermark == '1') {-->
                                                    								<!--    $thumbnail = 'uploads/preview/'.$dataUserMusicians->preview;-->
                                                    								<!--} else {-->
                                                        				<!--				$stockImage = App\Models\Stock::whereImagesId($dataUserMusicians->id)->whereType('small')->select('name')->first();-->
                                                        				<!--				$thumbnail = 'uploads/small/'.$stockImage->name;-->
                                                    								<!--}-->

                                                    								$watermarkedMusicPath = 'uploads/audio/large/';

                                                								{{-- @endphp --}}
                                                								<!--<div class="row">-->
                                                        <!--								<div class="col-2 align-self-center">-->
                                                        <!--                                    <a href="javascript:;" class="btn-music-play" id="playMusic">-->
                                                        <!--                                        <i class="fas fa-play"></i>-->
                                                        <!--                                    </a>-->
                                                        <!--                                    <a href="javascript:;" class="btn-music-play" id="pauseMusic" style="display: none;">-->
                                                        <!--                                        <i class="fas fa-pause"></i>-->
                                                        <!--                                    </a>-->
                                                        <!--                                </div>-->
                                                        <!--								<div class="col-10">-->

                                                        <!--                                  <div id="waveform"></div>-->
                                                                                            <!--<wavesurfer-->
                                                                                            <!--    data-url="http://ia902606.us.archive.org/35/items/shortpoetry_047_librivox/song_cjrg_teasdale_64kb.mp3"-->
                                                                                            <!--    data-plugins="minimap,timeline"-->

                                                                                            <!--    data-minimap-height="30"-->
                                                                                            <!--    data-minimap-wave-color="#ddd"-->
                                                                                            <!--    data-minimap-progress-color="#999"-->
                                                                                            <!--    data-timeline-font-size="13px"-->
                                                                                            <!--    data-timeline-container="#timeline"-->
                                                                                            <!-->
                                                                                            <!--</wavesurfer>-->
                                                                                            <!--<div id="timeline"></div>-->
                                                        <!--                                </div>-->
                                                    				<!--				</div>-->

                                                                    				<div class="wave d-flex" data-path="{{ asset('uploads/audio/large'). '/'. $dataUserMusicians->thumbnail }}">
                                                                                                <div class="align-self-center music-col-2">
                                                                                                    <a href="javascript:;" class="btn-music-play" id="baton-playMusic#{{ $dataUserMusicians->thumbnail}}">
                                                                                                        <i class="fas fa-play"></i>
                                                                                                    </a>
                                                                                                    <a href="javascript:;" class="btn-music-play" id="baton-pauseMusic#{{ $dataUserMusicians->thumbnail }}" style="display: none;">
                                                                                                        <i class="fas fa-pause"></i>
                                                                                                    </a>
                                                                                                </div>

                                                                                                <div class="wave-container music-col-10"></div>
                                                                                            </div>


                                                            					@endforeach
                                                					<?php
                                                                        }else{
                                                                    ?>
                                                                            <p class="dummy-text-when-another-div-empty">
                                                                                No Music Available
                                                                            </p>

                                                                    <?php
                                                                        }
                                                					?>
                                    					        </div>
                                                        <?php
                                                            }
                                                        ?>


                            			    </div>
                            		    </div>
                            			<div class="bottom" style="background-image: url(https://projects.hexawebstudio.com/darquise-nantel/uploads/thumbnail/musicWave.png)">
                            				<div class="">
                            					<div class="d-md-flex">
                            						<a href="<?php echo url('/')?>/artist/<?php echo $image->id; ?>" class="btn-portfolio-one w-100 mt-0">Portfolio</a>
                            						<a href="<?php echo url('/')?>/request-to-book?photographerId=<?php echo $image->id ;?>&amp;cityId=<?php echo $image->city_id; ?>" class="button-book-one w-100">Book artist</a>

                            					</div>
                            				</div>
                            			</div>
                                	</div>
                                	</div>
                                    @endforeach
                                </div>
                            @else
                                <div class="row">
                                    <div class="col-md-12 margin-top-20 margin-bottom-20">
                                        <div class="btn-block text-center">
                                            <i class="icon icon-Picture ico-no-result"></i>
                                        </div>
                                        <h3 class="margin-top-none text-center no-result no-result-mg">
                                        No results have been found
                                        </h3>
                                    </div>
                                </div>
                            @endif
                        @endif
                    </div>
                @endif
            @else
                <div class="search-page-grid-area">
                    @if($images['type'] !== null)
                        @php
                            $i = 0;
                        @endphp
                        @if($images['images']->total() > 0)
                            <section class="baguetteBoxOne gallery" id="photos">
                                @foreach($images['images'] as $image)

                                    @php
                                        $colors = explode(",", $image->colors);
                                        $color = $colors[0];
                                        if($image->extension == 'png' ) {
                                        $background = 'background: url('.url('img/pixel.gif').') repeat center center #e4e4e4;';
                                        } else {
                                        $background = 'background-color: #'.$color.'';
                                        }
                                        if($settings->show_watermark == '1') {
                                        $thumbnail = 'uploads/preview/'.$image->preview;
                                        } else {
                                        $stockImage = App\Models\Stock::whereImagesId($image->id)->whereType('small')->select('name')->first();
                                        $thumbnail = 'uploads/small/'.$stockImage->name;
                                        }

                                        $watermarkedVideoPath = 'uploads/video/water_mark_large/';
                                    @endphp

                                    @if($image->is_type == "video")
                                        <div class="box">
                                            <a href="{{ url('video', $image->id ) }}/{{str_slug($image->title)}}">
                                                <video onmouseover="this.play()" onmouseout="this.pause()" width="320" height="240" muted loop>
                                                    @if($image->extension == "mp4")
                                                        <source src="{{ asset($watermarkedVideoPath) }}{{ '/watermark-'.$image->thumbnail }}" type="video/mp4">
                                                    @endif
                                                    <!-- <source src="movie.ogg" type="video/ogg"> -->
                                                    Your browser does not support the video tag.
                                                </video>
                                            </a>
                                        </div>
                                    @else
                                        <div class="box">
                                            <a href="{{ url('photo', $image->id ) }}/{{str_slug($image->title)}}"><img class="img-fluid" src="{{ asset($thumbnail) }}"></a>
                                        </div>
                                    @endif
                                @endforeach
                            </section>
                        @else
                            <div class="row">
                                <div class="col-md-12 margin-top-20 margin-bottom-20">
                                    <div class="btn-block text-center">
                                        <i class="icon icon-Picture ico-no-result"></i>
                                    </div>
                                    <h3 class="margin-top-none text-center no-result no-result-mg">
                                        No results have been found
                                    </h3>
                                </div>
                            </div>
                        @endif
                    @else

                        @php
                            $i = 0;
                        @endphp
                        @if($images['images']->total() > 0)
                            <div class="row">
                                @foreach($images['images'] as $image)
                                <div class="col-lg-4 col-md-6 mb-4-cutom">
                                    <div class="choose-photographer-box">
                                		<div class="pt-4 pb-1 pl-3 pr-3">
                                			<div class="">
                            					<img loading="lazy" src="<?php echo url('/')?>/avatar/<?php echo $image->avatar; ?>" alt="" class="photographer-thimbnial">
                                			    <h4 class="title-this-photographer">{{ $image->username }}</h4>
                                                <p class="tag-one-photographer">{{ $image->type_name }}</p>
                                                <p class="tag-one-photographer" style="    margin-left: 77px;">{{ $image->CountryName }}</p>
                                                        <?php
                                                            if($image->user_type_id == "1"){
                                                        ?>
                                                              <div class="mt-4" style="text-align: center;">
                                            			        <?php
                                                                $queryGetDataById = App\Models\Images::where(['is_type' => 'image', 'user_id' => $image->id])->limit(4)->get();
                                                                // var_dump($userPhotographer->id);
                                                                // dd(count($queryGetDataById));
                                                                if(count($queryGetDataById) > 0){


                                                            ?>
                                            			        @foreach($queryGetDataById as $dataUserImages)
                                                			        @php
                                                    			        if($settings->show_watermark == '1') {
                                        								    $thumbnail = 'uploads/preview/'.$dataUserImages->preview;
                                        								} else {
                                            								$stockImage = App\Models\Stock::whereImagesId($dataUserImages->id)->whereType('small')->select('name')->first();
                                            								$thumbnail = 'uploads/small/'.$stockImage->name;
                                        								}
                                    								@endphp
                                    								<a data-fancybox href="{{ asset($thumbnail) }}">

                                                					    <img loading="lazy" src="{{ asset($thumbnail) }}" alt="" class="set-img-size">
                                                    			    </a>
                                            					@endforeach
                                            					<?php
                                                                }
                                        					?>
                                            					<!--<img loading="lazy" src="<?php //echo url('/')?>/avatar/<?php //echo $userPhotographer->avatar; ?>" alt="" class="set-img-size">-->
                                            					<!--<img loading="lazy" src="<?php //echo url('/')?>/avatar/<?php //echo $userPhotographer->avatar; ?>" alt="" class="set-img-size">-->
                                            					<!--<img loading="lazy" src="<?php //echo url('/')?>/avatar/<?php //echo $userPhotographer->avatar; ?>" alt="" class="set-img-size">-->
                                        					</div>
                                                        <?php
                                                            }else if($image->user_type_id == "3"){
                                                        ?>
                                                                <div class="mt-4" style="text-align: center;">
                                                			        <?php
                                                                        $queryVideosGetDataById = App\Models\Images::where(['is_type' => 'video', 'user_id' => $image->id])->limit(4)->get();
                                                                        // var_dump($userVideographer->id);
                                                                        // dd(count($queryVideosGetDataById));
                                                                        if(count($queryVideosGetDataById) > 0){


                                                                    ?>
                                                    			        @foreach($queryVideosGetDataById as $dataUserVideos)
                                                        			        @php
                                                            			        if($settings->show_watermark == '1') {
                                                								    $thumbnail = 'uploads/preview/'.$dataUserVideos->preview;
                                                								} else {
                                                    								$stockImage = App\Models\Stock::whereImagesId($dataUserVideos->id)->whereType('small')->select('name')->first();
                                                    								$thumbnail = 'uploads/small/'.$stockImage->name;
                                                								}

                                                								$watermarkedVideoPathScreenShot = 'uploads/video/screen_shot/';
                                                								$watermarkedVideoPath = 'uploads/video/water_mark_large/';

                                                								$VideoFileScreenShotName = explode('.', $dataUserVideos->thumbnail)[0];

                                                								$realVideoFileName = $dataUserVideos->thumbnail;
                                            								@endphp
                                            								<a data-fancybox href="{{ asset($watermarkedVideoPath) }}{{ '/watermark-'.$realVideoFileName }}">
                                                    					        <img loading="lazy" src="{{ asset($watermarkedVideoPathScreenShot) }}{{ '/screen-shot-'.$VideoFileScreenShotName.'.png' }}" alt="" class="set-img-size">
                                                    					    </a>
                                                    					@endforeach
                                                					<?php
                                                                        }
                                                					?>
                                            					<!--<img loading="lazy" src="<?php //echo url('/')?>/avatar/<?php //echo $userVideographer->avatar; ?>" alt="" class="set-img-size">-->
                                            					<!--<img loading="lazy" src="<?php //echo url('/')?>/avatar/<?php //echo $userVideographer->avatar; ?>" alt="" class="set-img-size">-->
                                            					<!--<img loading="lazy" src="<?php //echo url('/')?>/avatar/<?php //echo $userVideographer->avatar; ?>" alt="" class="set-img-size">-->
                                        					   </div>
                                                        <?php
                                                            }else if($image->user_type_id == "2"){
                                                        ?>
                                                                <div class="mt-4" style="text-align: center;">
                                                    			        <?php
                                                                        $queryAnimationsGetDataById = App\Models\Images::where(['is_type' => 'video', 'user_id' => $image->id])->limit(4)->get();
                                                                        // var_dump($userAnimator->id);
                                                                        // dd(count($queryAnimationsGetDataById));
                                                                        if(count($queryAnimationsGetDataById) > 0){


                                                                    ?>
                                                    			        @foreach($queryAnimationsGetDataById as $dataUserAnimations)
                                                        			        @php
                                                            			        if($settings->show_watermark == '1') {
                                                								    $thumbnail = 'uploads/preview/'.$dataUserAnimations->preview;
                                                								} else {
                                                    								$stockImage = App\Models\Stock::whereImagesId($dataUserAnimations->id)->whereType('small')->select('name')->first();
                                                    								$thumbnail = 'uploads/small/'.$stockImage->name;
                                                								}

					                        									$watermarkedVideoPathScreenShot = 'uploads/video/screen_shot/';

                                                								$AnimationFileScreenShotName = explode('.', $dataUserAnimations->thumbnail)[0];

                                                								$watermarkedVideoPath = 'uploads/video/water_mark_large/';

                                                								$realVideoFileName = $dataUserAnimations->thumbnail;
                                            								@endphp
                                            								<a data-fancybox href="{{ asset($watermarkedVideoPath) }}{{ '/watermark-'.$realVideoFileName }}">
                                                    					        <img loading="lazy" src="{{ asset($watermarkedVideoPathScreenShot) }}{{ '/screen-shot-'.$AnimationFileScreenShotName.'.png' }}" alt="" class="set-img-size">
                                                					        </a>
                                                    					@endforeach
                                                    					<!--<img loading="lazy" src="<?php echo url('/')?>/avatar/<?php //echo $userAnimator->avatar; ?>" alt="" class="set-img-size">-->
                                                    					<!--<img loading="lazy" src="<?php echo url('/')?>/avatar/<?php //echo $userAnimator->avatar; ?>" alt="" class="set-img-size">-->
                                                    					<!--<img loading="lazy" src="<?php echo url('/')?>/avatar/<?php //echo $userAnimator->avatar; ?>" alt="" class="set-img-size">-->
                                                    					<?php
                                                                        }else{
                                                                    ?>
                                                                    <p class="dummy-text-when-another-div-empty">
                                                                                No Animation Available
                                                                            </p>
                                                                    <?php
                                                                        }
                                                					?>
                            					                </div>
                                                        <?php
                                                            }else if($image->user_type_id == "4"){
                                                        ?>
                                              			        <div class="mt-4" style="text-align: center;">
                                                			        <?php
                                                                        $queryMusiciansGetDataById = App\Models\Images::where(['is_type' => 'audio', 'user_id' => $image->id])->limit(1)->get();
                                                                        if(count($queryMusiciansGetDataById) > 0){
                                                                    ?>
                                                        			        @foreach($queryMusiciansGetDataById as $dataUserMusicians)
                                                        			           {{--  @php --}}
                                                            <!--    			        if($settings->show_watermark == '1') {-->
                                                    								<!--    $thumbnail = 'uploads/preview/'.$dataUserMusicians->preview;-->
                                                    								<!--} else {-->
                                                        				<!--				$stockImage = App\Models\Stock::whereImagesId($dataUserMusicians->id)->whereType('small')->select('name')->first();-->
                                                        				<!--				$thumbnail = 'uploads/small/'.$stockImage->name;-->
                                                    								<!--}-->

                                                    								$watermarkedMusicPath = 'uploads/audio/large/';

                                                								{{-- @endphp --}}
                                                								<!--<div class="row">-->
                                                        <!--								<div class="col-2 align-self-center">-->
                                                        <!--                                    <a href="javascript:;" class="btn-music-play" id="playMusic">-->
                                                        <!--                                        <i class="fas fa-play"></i>-->
                                                        <!--                                    </a>-->
                                                        <!--                                    <a href="javascript:;" class="btn-music-play" id="pauseMusic" style="display: none;">-->
                                                        <!--                                        <i class="fas fa-pause"></i>-->
                                                        <!--                                    </a>-->
                                                        <!--                                </div>-->
                                                        <!--								<div class="col-10">-->

                                                        <!--                                  <div id="waveform"></div>-->
                                                                                            <!--<wavesurfer-->
                                                                                            <!--    data-url="http://ia902606.us.archive.org/35/items/shortpoetry_047_librivox/song_cjrg_teasdale_64kb.mp3"-->
                                                                                            <!--    data-plugins="minimap,timeline"-->

                                                                                            <!--    data-minimap-height="30"-->
                                                                                            <!--    data-minimap-wave-color="#ddd"-->
                                                                                            <!--    data-minimap-progress-color="#999"-->
                                                                                            <!--    data-timeline-font-size="13px"-->
                                                                                            <!--    data-timeline-container="#timeline"-->
                                                                                            <!-->
                                                                                            <!--</wavesurfer>-->
                                                                                            <!--<div id="timeline"></div>-->
                                                        <!--                                </div>-->
                                                    				<!--				</div>-->

                                                    				<div class="wave d-flex" data-path="{{ asset('uploads/audio/large'). '/'. $dataUserMusicians->thumbnail }}">
                                                                                                <div class="align-self-center music-col-2">
                                                                                                    <a href="javascript:;" class="btn-music-play" id="baton-playMusic#{{ $dataUserMusicians->thumbnail}}">
                                                                                                        <i class="fas fa-play"></i>
                                                                                                    </a>
                                                                                                    <a href="javascript:;" class="btn-music-play" id="baton-pauseMusic#{{ $dataUserMusicians->thumbnail }}" style="display: none;">
                                                                                                        <i class="fas fa-pause"></i>
                                                                                                    </a>
                                                                                                </div>

                                                                                                <div class="wave-container music-col-10"></div>
                                                                                            </div>


                                                            					@endforeach
                                                					<?php
                                                                        }else{
                                                                    ?>
                                                                            <p class="dummy-text-when-another-div-empty">
                                                                                No Music Available
                                                                            </p>

                                                                    <?php
                                                                        }
                                                					?>
                                    					        </div>
                                                        <?php
                                                            }
                                                        ?>


                            			    </div>
                            		    </div>
                            			<div class="bottom" style="background-image: url(https://projects.hexawebstudio.com/darquise-nantel/uploads/thumbnail/musicWave.png)">
                            				<div class="">
                            					<div class="d-md-flex">
                            						<a href="<?php echo url('/')?>/artist/<?php echo $image->id; ?>" class="btn-portfolio-one w-100 mt-0">Portfolio</a>
                            						<a href="<?php echo url('/')?>/request-to-book?photographerId=<?php echo $image->id ;?>&amp;cityId=<?php echo $image->city_id; ?>" class="button-book-one w-100">Book artist</a>

                            					</div>
                            				</div>
                            			</div>
                                	</div>
                                	</div>
                                @endforeach
                            </div>
                        @else
                            <div class="row">
                                <div class="col-md-12 margin-top-20 margin-bottom-20">
                                    <div class="btn-block text-center">
                                        <i class="icon icon-Picture ico-no-result"></i>
                                    </div>
                                    <h3 class="margin-top-none text-center no-result no-result-mg">
                                    No results have been found
                                    </h3>
                                </div>
                            </div>
                        @endif
                    @endif
                </div>
            @endif
        </div>
    </div>
</div>

@endsection

@section('javascript')
<script type="text/javascript">
    function formatText(icon) {
        return $('<span><i class="fas ' + $(icon.element).data('icon') + '"></i> ' + icon.text + '</span>');
    };


    $('#imagesFlex').flexImages({
        rowHeight: 320
    });

    $('.select2-icon').select2({
        minimumResultsForSearch: Infinity,
        // width: "50%",
        templateSelection: formatText,
        templateResult: formatText
    });

    // $(".toggleFiltersBtn").click(function(){
    //   $("#sideBarSearch").slideToggle();
    //   $("#oneTwo").toggleClass("col-md-9-toggle");
    // });

    $(document).ready(function() {

        $('#formSearch').find(":input").prop("disabled", false);

        $("#btnSubmitSearch").click(function() {
			console.log('here clicked');
			$("#formSearch").find(":input").filter(function() {
				return !this.value;
			}).attr("disabled", "disabled");
			$("#formSearch").submit();

		});

        $("#txt_search").keyup(function(event) {
            if (event.keyCode === 13) {
                // alert('herer');
                $("#formSearch").find(":input").filter(function() {
				return !this.value;
			}).attr("disabled", "disabled");
			$("#formSearch").submit();
            }
        });

        $('input[id^="sortOption-"]').click(function(){
            $('input[id^="sortOption-"]').removeClass("active");
            $(this).addClass("active");
            var idSortOption = $(this).attr('id').split('-')[1];
            console.log(idSortOption);
            $("#sort").val(idSortOption);
            const baseUrl = '<?php echo url("/") ?>';
            console.log(baseUrl);


            $("#formSearch").find(":input").filter(function() {
                return !this.value;
            }).attr("disabled", "disabled");

            var data = $("#formSearch").serialize();

            window.location.href = baseUrl + '/search?' + data;
        });

        $('button[id^="btnArtist-"]').click(function() {
            $('button[id^="btnArtist-"]').removeClass("active");
            $(this).addClass("active");
            var idArtist = $(this).attr('id').split('-')[1];
            console.log(idArtist);
            $('select[name="artist"]').val(idArtist).trigger('change');

            const baseUrl = '<?php echo url("/") ?>';
            console.log(baseUrl);


            $("#formSearch").find(":input").filter(function() {
                return !this.value;
            }).attr("disabled", "disabled");

            var data = $("#formSearch").serialize();

            window.location.href = baseUrl + '/search?' + data;

        });

        $('a[id^="btnType-"]').click(function() {
            $('a[id^="btnType-"]').removeClass("active");
            $(this).addClass("active");
            var idType = $(this).attr('id').split('-')[1];
            console.log(idType);
            $('select[name="type"]').val(idType).trigger('change');

            const baseUrl = '<?php echo url("/") ?>';
            console.log(baseUrl);


            $("#formSearch").find(":input").filter(function() {
                return !this.value;
            }).attr("disabled", "disabled");

            var data = $("#formSearch").serialize();

            window.location.href = baseUrl + '/search?' + data;

        });

        $('a[id^="tags-"]').click(function(){
            var getValue = $(this).attr('id').split('-')[1];
            var RemoveSlash = getValue.replace(/[^a-zA-Z ]/g, " "); // Replaces all Slashes with spaces.

            $("#txt_search").empty();
            $("#txt_search").val(RemoveSlash);

            const baseUrl = '<?php echo url("/") ?>';
            console.log(baseUrl);


            $("#formSearch").find(":input").filter(function() {
                return !this.value;
            }).attr("disabled", "disabled");

            var data = $("#formSearch").serialize();

            window.location.href = baseUrl + '/search?' + data;

        });

        $("#select_sub_category").change(function(){
            var getValue =  $(this).val();
            console.log("Sub Category -===>" + getValue);

            $("#sub_category").empty();
            $("#sub_category").val(getValue);

            $("#formSearch").find(":input").filter(function() {
                return !this.value;
            }).attr("disabled", "disabled");

            var data = $("#formSearch").serialize();

            window.location.href = baseUrl + '/search?' + data;

        });

        $('select[id^="select_parent_music_type"]').change(function(){
            var valueMusicType = $(this).val();

            $("#formSearch").find(":input").filter(function() {
                return !this.value;
            }).attr("disabled", "disabled");

            var data = $("#formSearch").serialize();

            window.location.href = baseUrl + '/search?' + data;
        });

        $('.select2-icon2').select2({
            minimumResultsForSearch: Infinity,
            // width: "50%",
            templateSelection: formatText,
            templateResult: formatText
        });
        <?php if (\Request::query('type') !== NULL) { ?>
            $('select[name=type]').select2({
                minimumResultsForSearch: Infinity,
                // width: "50%",
                templateSelection: formatText,
                templateResult: formatText
            });
        <?php } ?>
        <?php if (\Request::query('artist') !== NULL) { ?>
            $('select[name=artist]').select2({
                minimumResultsForSearch: Infinity,
                // width: "50%",
                templateSelection: formatText,
                templateResult: formatText
            });
        <?php } ?>

        $(".toggleFiltersBtn").click(function() {
            $("#sideBarSearch").toggle();
            $(".filters-head-area").toggleClass("filters-head-area-closed")
            $("#mainSection").toggleClass("col-md-9-toggle");
            $("#filterBtnDiv").toggleClass("col-md-12");
            $("#toggleCol1").toggleClass("col-md-1-custom");
            $(".hideClearBtnDiv").toggle();
        });
    });
    //<<---- PAGINATION AJAX
    // $(document).on('click', '.pagination a', function(e) {
    //     e.preventDefault();
    //     var page = $(this).attr('href').split('page=')[1];
    //     $.ajax({
    //         headers: {
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //         },
    //         url: '{{ url("/") }}/ajax/search?q={{$q}}&page=' + page


    //     }).done(function(data) {
    //         if (data) {

    //             scrollElement('#imagesFlex');

    //             $('.dataResult').html(data);

    //             $('.hovercard').hover(
    //                 function() {
    //                     $(this).find('.hover-content').fadeIn();
    //                 },
    //                 function() {
    //                     $(this).find('.hover-content').fadeOut();
    //                 }
    //             );

    //             $('#imagesFlex').flexImages({
    //                 rowHeight: 320
    //             });
    //             jQuery(".timeAgo").timeago();

    //             $('[data-toggle="tooltip"]').tooltip();
    //         } else {
    //             sweetAlert("{{trans('misc.error_oops')}}", "{{trans('misc.error')}}", "error");
    //         }
    //         //<**** - Tooltip
    //     });

    // }); //<<---- PAGINATION AJAX
</script>
@endsection
