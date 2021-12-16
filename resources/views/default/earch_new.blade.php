{{-- @extends('app')--}}

@extends('new_template.layouts.app')


@section('title'){{ e($title ?? '') }}@endsection

@section('content')

<!-- Main Search Container -->
<div class="container-fluid" style="background-color: #fff;">
    <div class="row m-0 mt-2 fixed-row-search">
        <div class="col-md-2 align-self-center" id="toggleCol1">
            <div class="filters-head-area row">
                <div class="col-6 align-self-center" id="filterBtnDiv">
                    <h6 class="toggleFiltersBtn">
                        <img src="{{ asset('public/search-page-img/filters.png') }}" alt="" class="set-filter-icon">
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
                                            <input type="button" name="sortOption" id="sortOption-Downloaded" class="btn-sort-by-search <?php echo (\Request::query('sort') == "Downloaded") ? 'active' : ''; ?>" value="Downloaded">
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
                                        $getCategories = \App\Models\Categories::where('slug', '!=', 'uncategorized')->where('parent_id', '=', '0')->get();

                                        foreach ($getCategories as $categ) {
                                            if ($categ->id == \Request::query('type')) {
                                        ?>

                                                <li class="mb-2 "><button id="btnType-{{ $categ->id }}" class="btn-sort-by-search active">
                                                        {{ $categ->name }}
                                                    </button>
                                                </li>
                                            <?php
                                            } else {
                                            ?>
                                                <li class="mb-2 "><button id="btnType-{{ $categ->id }}" class="btn-sort-by-search ">
                                                        {{ $categ->name }}
                                                    </button>
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

                                            if ($type->id == \Request::query('type')) {
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
                    <div class="accordion" id="faq44">
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
                        <h2>Men</h2>
                        <p>
                            27,131,554 men stock photos, vectors, and illustrations are available royalty-free.
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
                <div class="tags-search mt-3">
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

            <div class="search-page-grid-area">
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
                                $background = 'background: url('.url('public/img/pixel.gif').') repeat center center #e4e4e4;';
                                } else {
                                $background = 'background-color: #'.$color.'';
                                }
                                if($settings->show_watermark == '1') {
                                $thumbnail = 'public/uploads/preview/'.$image->preview;
                                } else {
                                $stockImage = App\Models\Stock::whereImagesId($image->id)->whereType('small')->select('name')->first();
                                $thumbnail = 'public/uploads/small/'.$stockImage->name;
                                }

                                $watermarkedVideoPath = 'public/uploads/video/water_mark_large/';
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
            </div>
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

        $('button[id^="btnType-"]').click(function() {
            $('button[id^="btnType-"]').removeClass("active");
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