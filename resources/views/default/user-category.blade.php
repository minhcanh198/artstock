{{-- @extends('app') --}}
@extends('new_template.layouts.app')

@section('title'){{ $category->type_name.' - ' }}@endsection

@section('content')
	<div class="jumbotron md index-header jumbotron_set jumbotron-cover" style="height:50%;">
      <div class="container wrap-jumbotron position-relative">
        <h1 class="title-site title-sm">{{ $category->type_name }}</h1>


       @if( count($images) != 0 )
        	<p class="subtitle-site"><strong id="strongBannerText">({{number_format(count($images))}}) {{trans_choice('misc.profile_images_available_category',count($images) )}}</strong></p>
        @else
        	<p class="subtitle-site"><strong>{{$settings->title}}</strong></p>
        @endif

        <?php
			$categorySlug = $category->type_name;
			if($categorySlug == "Animator" ){
		?>
				<p class="text-center" style=" color: #fff;">Find animation professionals & designers on ArtStock. Discuss the animation project with your chosen animator and they will get it done for you.
 </p>
		<?php
			}else if($categorySlug == "Photographer"){
		?>
				<p class="text-center" style=" color: #fff;">Find Experience Photographers with ArtStock. Connect with and Hire a Professional Photographer for your Photo Shoot.
</p>
		<?php
			}else if($categorySlug == "Videographer"){
		?>
				<p class="text-center" style=" color: #fff;">You can find the perfect videographer for your video production, editing or post production job. ArtStock streamlines the process of attracting a skilled videographer and makes it much easier.
</p>
		<?php
			}else if($categorySlug == "Musician"){
		?>
				<p class="text-center" style=" color: #fff;">Find musicians, bands, recording sessions, and more with ArtStock. Explore the musicians with the help of their profile and choose the one which fits your needs. </p>
		<?php
			}
		?>

		<div class="row mt-5">

			<div class="col-lg-2">
			</div>
			<div class="col-lg-8">
				<div class="input-group">
					<input type="text" class="form-control mt-0 animation-banner-search-input" id="txt_search_artist" name="txt_search_artist" placeholder="Search">
					<input type="hidden" class="form-control" id="txt_search_artist_type_id" name="txt_search_artist_type_id" value="{{ $category->types_id }}">
					<div class="input-group-append" id="buttonSectionDiv">
						<button class="btn btn-secondary animation-banner-search-btn " id="btnSubmitTxtArtistSearch" type="button">
							<i class="fa fa-search"></i>
						</button>


					</div>
				</div>
			</div>
			<div class="col-lg-2">
			</div>
		</div>

      </div>
    </div>

<div class="container margin-bottom-40">

<!-- Col MD -->
<div class="col-md-12 margin-top-20 margin-bottom-20" id="DivImageFlex">

	@if( count($images) != 0 )

		<div id="imagesFlex" class="flex-images btn-block margin-bottom-40 dataResult">
			@include('includes.ajax-users-artist')


			@if( count($images) != 0  )
					<!-- <div class="container-paginator"> -->
						{{-- $images->links() --}}
						<!-- </div> -->
						@endif

		</div><!-- Image Flex -->



	@else
	  <div class="btn-block text-center">
	    			<i class="icon icon-Picture ico-no-result"></i>
	    		</div>

	    		<h3 class="margin-top-none text-center no-result no-result-mg">
	    		{{ trans('misc.no_results_found') }}
	    	</h3>
	  @endif

 </div><!-- /COL MD -->

 </div><!-- container wrap-ui -->


@endsection

@section('javascript')

<script type="text/javascript">

        $("#txt_search_artist").keydown(function(e){
            if(e.which === 13){
                $("#btnSubmitTxtArtistSearch").click();
            }
        });

		// const baseUrl = '<?php //echo url("/")?>';
		$("#btnSubmitTxtArtistSearch").click(function(){
			var searchArtistValue = $("#txt_search_artist").val();
			var searchArtistTypeId = $("#txt_search_artist_type_id").val();
			console.log(baseUrl);
			$.ajax({
				url: baseUrl + '/search-artist',
				type: 'POST',
				data: {"_token": "{{ csrf_token() }}", "searchArtistValue" : searchArtistValue, "searchArtistTypeId": searchArtistTypeId},
				dataType: 'json',
				success: function(res){
					console.log(res);
					// console.log(res.images.length);
					$("#buttonSectionDiv #btnClearSearch").remove();
					const baseUrl = '<?php echo url("/")?>';
					if(res.length > 0){
						var html = '';

						html += '<div id="imagesFlex" class="flex-images btn-block margin-bottom-40 dataResult">';
						html += '<div class="row">';
						$.each(res , function( index, value ) {
							console.log( value[0].username );
				// 			html +=	'<div class="col-md-4 mb-4-cutom">';
								// 		'<div class="choose-photographer-box">'+
								// 			'<div class="header-photographer">'+
								// 				'<div class="row">'+
								// 					'<div class="col-sm-4">'+
								// 						'<img src="' + baseUrl + '/public/avatar/' + value[0].avatar + '" alt="" class="set-img-size">'+
								// 					'</div>'+
								// 					'<div class="col-sm-7 offset-md-1">'+
								// 						'<h4 class="title-this">' + value[0].username + '</h4>'+
								// 						'<p class="tag-one">' + value[0].type_name  + '</p>'+
								// 					'</div>'+
								// 				'</div>'+
								// 			'</div>';

								// 			if(value[0].user_type_id == "1"){

								// 				html += '<div class="bottom" style="background-image: url('+ baseUrl +'/public/uploads/thumbnail/' +  value[0].img + ')">'+
								// 							'<div class="row">'+
								// 								'<div class="col-5 offset-7">'+
								// 									'<a href="' + baseUrl + '/artist/' + value[0].id + '" class="btn-portfolio-one mb-2">Portfolio</a>' +
								// 									'<a href="' + baseUrl + '/request-to-book?photographerId=' +  value[0].id + '&cityId=' + value[0].city_id + '" class="button-book-one mb-2">Book artist</a>'+
								// 									'<a href="javascript:;" class="button-chat-two" >Chat</a>'+
								// 								'</div>'+
								// 							'</div>'+
								// 						'</div>';
								// 			}else if(value[0].user_type_id == "3"){

								// 				html +=	'<div class="bottom" style="background-image: url(' + baseUrl +  '/public/uploads/video/screen_shot/'+ value[0].ScreenShot + ')">'+
								// 							'<div class="row">'+
								// 								'<div class="col-5 offset-7">'+
								// 									'<a href="' + baseUrl + '/artist/' + value[0].id + '" class="btn-portfolio-one mb-2">Portfolio</a>'+
								// 									'<a href="' + baseUrl + '/request-to-book?photographerId=' + value[0].id  + '&cityId=' + value[0].city_id + '" class="button-book-one mb-2">Book artist</a>'+
								// 									'<a href="javascript:;" class="button-chat-two" >Chat</a>'+
								// 								'</div>'+
								// 							'</div>'+
								// 						'</div>';
								// 			}else if(value[0].user_type_id == "2"){
								// 				html += '<div class="bottom" style="background-image: url('+ baseUrl + '/public/uploads/video/screen_shot/' + value[0].ScreenShot + ')">'+
								// 							'<div class="row">'+
								// 								'<div class="col-5 offset-7">'+
								// 									'<a href="' + baseUrl + '/artist/' + value[0].id + '" class="btn-portfolio-one mb-2">Portfolio</a>'+
								// 									'<a href="' + baseUrl + '/request-to-book?photographerId=' + value[0].id + '&cityId=' + value[0].city_id + '" class="button-book-one mb-2">Book artist</a>'+
								// 									'<a href="javascript:;" class="button-chat-two" >Chat</a>'+
								// 								'</div>'+
								// 							'</div>'+
								// 						'</div>';
								// 			}else if(value[0].user_type_id == "4"){
								// 				html += '<div class="bottom" style="background-image: url('+ baseUrl + '/public/uploads/thumbnail/musicWave.png'+ ')" >'+
								// 							'<div class="row">'+
								// 								'<div class="col-5 offset-7">'+
								// 									'<a href="'+ baseUrl + '/artist/' + value[0].id + '" class="btn-portfolio-one mb-2">Portfolio</a>'+
								// 									'<a href="'+ baseUrl + '/request-to-book?photographerId=' + value[0].id + '&cityId=' + value[0].city_id + '" class="button-book-one mb-2">Book artist</a>'+
								// 									'<a href="javascript:;" class="button-chat-two" >Chat</a>'+
								// 								'</div>'+
								// 							'</div>'+
								// 						'</div>';
								// 			}



								// 		html += ' </div>';



								 html += '<div class="col-lg-4 col-md-6 mb-4-cutom">'+
                							    '<div class="choose-photographer-box">'+
                                            		'<div class="pt-4 pb-4 pl-3 pr-3">'+
                                            			'<div class="">'+
                                            			    '<a data-fancybox href="' + baseUrl + '/avatar/' + value[0].avatar +'">'+
                                        					    '<img src="' + baseUrl + '/avatar/' + value[0].avatar +'" alt="" class="photographer-thimbnial">'+
                                        					 '</a>'+
                                            			    '<h4 class="title-this-photographer">' + value[0].username + '</h4>'+
                                                            '<p class="tag-one-photographer">' + value[0].type_name + '</p>'+
                                                            '<p class="tag-one-photographer" style="    margin-left: 77px;">'+ value[0].CountryName + '</p>';

                                                            if(value[0].user_type_id == "1"){//1 user type photographer
                                                			    html +='<div class="mt-4" style="text-align: center;">';
                                                			    if(value[0].img != null){
                                                			        var splitImgs = value[0].img.split(',');
                                                			        //   for(var i=0; i < splitImgs.length; i++){
                                                			        for(var i=0; i < 4; i++){
                                                			            if(splitImgs[i] != undefined){
                                            								html +='<a data-fancybox href="' + baseUrl + '/uploads/preview/' + splitImgs[i] +'">'+
                                                        					    '<img src="' + baseUrl + '/uploads/preview/' + splitImgs[i] +'" alt="" class="set-img-size">'+
                                                            			    '</a>';
                                                			            }
                                                			        }
                                                			    }
                                            					html +='</div>';
                                                            }else if(value[0].user_type_id == "3"){//3 user type videographer
                                                                html +='<div class="mt-4" style="text-align: center;">';
                                                                if(value[0].vid != null){
                                                			        var splitVids = value[0].vid.split(',');
                                                			        //   for(var i=0; i < splitImgs.length; i++){
                                                			        for(var i=0; i < 4; i++){
                                                			            if(splitVids[i] != undefined){
                                                			                    var realFileName = splitVids[i];
                                                        			         //   console.log(realFileName);
                                                        			            var getFileNameScreenShot = splitVids[i].split('.')[0] + '.png';
                                                        			         //   console.log('asd ==>'+ getFileNameScreenShot);
                                            								html +='<a data-fancybox href="' + baseUrl + '/uploads/video/water_mark_large/watermark-' + realFileName +'">'+
                                                        					    '<img src="' + baseUrl + '/uploads/video/screen_shot/screen-shot-' + getFileNameScreenShot +'" alt="" class="set-img-size">'+
                                                            			    '</a>';
                                                			            }
                                                			        }
                                                                }
                                            					html +='</div>';
                                                            }else if(value[0].user_type_id == "2"){//2 user type animation
                                                                html +='<div class="mt-4" style="text-align: center;">';
                                                                if(value[0].ani != null){
                                                			        var splitAnis = value[0].ani.split(',');
                                                			        //   for(var i=0; i < splitImgs.length; i++){
                                                			        for(var i=0; i < 4; i++){
                                                			            if(splitAnis[i] != undefined){
                                                			                    var realFileNameAni = splitAnis[i];
                                                        			         //   console.log(realFileNameAni);
                                                        			            var getFileNameScreenShotAni = splitAnis[i].split('.')[0] + '.png';
                                                        			         //   console.log('asd ==>'+ getFileNameScreenShotAni);
                                            								html +='<a data-fancybox href="' + baseUrl + '/uploads/video/water_mark_large/watermark-' + realFileNameAni +'">'+
                                                        					    '<img src="' + baseUrl + '/uploads/video/screen_shot/screen-shot-' + getFileNameScreenShotAni +'" alt="" class="set-img-size">'+
                                                            			    '</a>';
                                                			            }
                                                			        }
                                                                }
                                            					html +='</div>';
                                                            }else if(value[0].user_type_id == "4"){//4 user type musician
                                                            console.log('in musician');
                                                            console.log(value[0].mus);
                                                                html +='<div class="mt-4" style="text-align: center;">';
                                                                if(value[0].mus != null){
                                                			        var splitMus = value[0].mus.split(',');
                                                			        //   for(var i=0; i < splitImgs.length; i++){
                                                			        for(var i=0; i < 1; i++){
                                                			            if(splitMus[i] != undefined){
                                            								// htmlDiv +='<div class="qwewave" data-path="' + baseUrl + '/public/uploads/audio/large/' + splitMus[i] +'">'+
                                            								// '<button type="button" id="baton#'+ splitMus[i] + '">Play / Pause</button>'+
                                                    //     					   // '<img src="' + baseUrl + '/public/uploads/audio/large/' + splitMus[i] +'" alt="" class="set-img-size">'+
                                                    //     					    '<div class="wave-container"></div>'+
                                                    //         			    '</div>';

                                                            			    html += '<div class="qwewaveUserSearch d-flex" data-path="' + baseUrl + '/uploads/audio/large/' + splitMus[i] +'">'+
                                                                                '<div class="align-self-center music-col-2">'+
                                                                                    '<a href="javascript:;" class="btn-music-play" id="userSearchbaton-playMusic#'+ splitMus[i] +'">'+
                                                                                        '<i class="fas fa-play"></i>'+
                                                                                    '</a>'+
                                                                                    '<a href="javascript:;" class="btn-music-play" id="userSearchbaton-pauseMusic#'+ splitMus[i] +'" style="display: none;">'+
                                                                                        '<i class="fas fa-pause"></i>'+
                                                                                    '</a>'+
                                                                                '</div>'+

                                                                                '<div class="wave-container music-col-10"></div>'+
                                                                            '</div>';
                                                			            }
                                                			        }
                                                                }else{
                                                                    html += '<p class="dummy-text-when-another-div-empty">No Music Available</p>';
                                                                }
                                            					html +='</div>';
                                                            }
                                        			    html +='</div>'+
                                        		    '</div>'+
                                        			'<div class="bottom" style="background-image: url(https://projects.hexawebstudio.com/darquise-nantel/uploads/thumbnail/musicWave.png)">'+
                                        				'<div class="">'+
                                        					'<div class="d-md-flex">'+
                                        						'<a href="' + baseUrl + '/artist/' + value[0].id + '" class="btn-portfolio-one w-100 mt-0">Portfolio</a>'+
                                        				// 		'<a href="' + baseUrl + '/request-to-book?photographerId=' + value[0].id + '&cityId=' + value[0].city_id+ '" class="button-book-one w-100">Book artist</a>'+
                                        						'<a href="' + baseUrl + '/request-to-book?photographerId=' + value[0].id + '" class="button-book-one w-100">Book artist</a>'+
                                        					'</div>'+
                                        				'</div>'+
                                        			'</div>'+
                                            	'</div>'+
                                	        '</div>';


								//  html += '<div class="choose-photographer-box">'+
        //                             		'<div class="pt-4 pb-4 pl-3 pr-3">'+
        //                             			'<div class="">'+
        //                             			    '<a data-fancybox href="' + baseUrl + '/public/avatar/' + value[0].avatar + '">'+
        //                         					'<img src="' + baseUrl + '/public/avatar/' + value[0].avatar + '" alt="" class="photographer-thimbnial">'+
        //                         					'</a>'+
    				// 								'<h4 class="title-this-photographer">' + value[0].username + '</h4>'+
								// 					'<p class="tag-one-photographer">' + value[0].type_name  + '</p>'+
								// 					'<p class="tag-one-photographer" style="    margin-left: 77px;">' + value[0].CountryName  + '</p>';
        //                                         	if(value[0].user_type_id == "1"){
        //                                 			    html += '<div class="mt-4" style="text-align: center;" id="'+ value[0].id +'" >';
        //                                 			        $.ajax({
        //                                 			           url : baseUrl + '/getLimitImagesByUserId/'+ value[0].id,
        //                                 			           type:'get',
        //                                 			           dataType:'json',
        //                                 			           success:function(responseImage){
        //                                 			               var Imagehtml = '';
        //                                 			               console.log(responseImage);
        //                                 			               $.each( responseImage, function( key, valueImage ) {
        //                                 			                   Imagehtml += '<a data-fancybox href="'+ baseUrl +'/public/uploads/preview/' + valueImage.preview + '">'+
        //                                     					                '<img src="'+ baseUrl + '/public/uploads/preview/' + valueImage.preview + '" alt="" class="set-img-size">'+
        //                                     					                '</a>';
        //                                                           });
        //                                                           $("#"+ value[0].id).append(Imagehtml);
        //                                 			           },
        //                                 			           error:function(){
        //                                 			               console.log('errro while fetching limit images by user id ');
        //                                 			           }
        //                                 			        });

        //                             					html += '</div>';
        //                                         	}else if(value[0].user_type_id == "3"){
        //                                         	    html += '<div class="mt-4" style="text-align: center;" id="'+ value[0].id +'">';
        //                             			            $.ajax({
        //                                 			           url : baseUrl + '/getLimitVideosByUserId/'+ value[0].id,
        //                                 			           type:'get',
        //                                 			           dataType:'json',
        //                                 			           success:function(responseVideo){
        //                                 			               var Videohtml = '';
        //                                 			               $.each(responseVideo, function( key, valueVideo ) {
        //         								                        // var splitThumbnail = ;
        //         								                        // alert(JSON.stringify(valueVideo));
        //                                     					         Videohtml += '<a data-fancybox href="'+ baseUrl + '/public/uploads/video/screen_shot/screen-shot-'+ valueVideo.thumbnail.split('.')[0] + '.png' +'">'+
        //                                     					        '<img src="'+ baseUrl + '/public/uploads/video/screen_shot/screen-shot-'+ valueVideo.thumbnail.split('.')[0] + '.png' +'" alt="" class="set-img-size">'+
        //                                     					        '</a>';
        //                                                           });
        //                                                           $("#"+ value[0].id).append(Videohtml);
        //                                 			           },
        //                                 			           error:function(){
        //                                 			               console.log('errro while fetching limit video by user id ');
        //                                 			           }
        //                                 			        });
        //                             					html += '</div>';

        //                                         	}else if(value[0].user_type_id == "2"){
        //                                         	    html += '<div class="mt-4" style="text-align: center;" id="'+ value[0].id +'" >';
        //                                 			        $.ajax({
        //                                 			           url : baseUrl + '/getLimitVideosByUserId/'+ value[0].id,
        //                                 			           type:'get',
        //                                 			           dataType:'json',
        //                                 			           success:function(responseAnimation){
        //                                 			               var Animationhtml = '';
        //                                 			               console.log(responseAnimation);
        //                                 			               $.each(responseAnimation, function( key, valueAnimation ) {
        //                                 			                   console.log(valueAnimation);
        //                                 			                   var splitAnimationThumbnail = valueAnimation.thumbnail.split('.')[0];
        //                                     					        Animationhtml += '<a data-fancybox href="'+ baseUrl + '/public/uploads/video/screen_shot/screen-shot-' + splitAnimationThumbnail + '.png' + '">'+
        //                                     					            '<img src="'+ baseUrl + '/public/uploads/video/screen_shot/screen-shot-' + splitAnimationThumbnail + '.png' + '" alt="" class="set-img-size">'+
        //                                     					        '</a>';
        //                                                           });
        //                                                           $("#"+ value[0].id).append(Animationhtml);
        //                                 			           },
        //                                 			           error:function(){
        //                                 			               console.log('errro while fetching limit images by user id ');
        //                                 			           }
        //                                 			        });

        //                             					html += '</div>';
        //                                         	}

        //                         			    html += '</div>'+
        //                         		    '</div>'+
        //                         			'<div class="bottom" style="background-image: url(https://projects.hexawebstudio.com/darquise-nantel/public/uploads/thumbnail/musicWave.png)">'+
        //                         				'<div class="">'+
        //                         					'<div class="d-md-flex">'+

        //                         						'<a href="' + baseUrl + '/artist/' + value[0].id + '" class="btn-portfolio-one w-100 mt-0">Portfolio</a>'+
        //                 								'<a href="'+ baseUrl + '/request-to-book?photographerId=' + value[0].id + '&cityId=' + value[0].city_id + '" class="button-book-one w-100">Book artist</a>'+
        //                 								// <!--<a href="javascript:;" class="button-chat-two" >Chat</a>-->
        //                         					'</div>'+
        //                         				'</div>'+
        //                         			'</div>'+
        //                         	    '</div>';

								// 	html += '</div>';
								});
							html += '</div>';
							html += '</div>';
							$("#DivImageFlex").empty();
							$("#DivImageFlex").append(html);

                            $('.qwewaveUserSearch').each(function(){
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


                                var mainDataGetUserSearch = '';
                                $(document).on('click', 'a[id^="userSearchbaton-playMusic#"]', function(){
                                    var dataGet = $(this).attr('id').split('#')[1];
                                    mainDataGetUserSearch = dataGet;
                                    wavesurfer.play();
                                    $(this).hide();
                                    // $("#pauseMusic").show();
                                    // $("#baton-pauseMusic#"+ dataGet).css('display','block');
                                    $('a[id^="userSearchbaton-pauseMusic#'+ dataGet +'"]').css('display','inline');
                                });
                                // $('a[id^="baton-pauseMusic#"]').click(function() {
                                $(document).on('click', 'a[id^="userSearchbaton-pauseMusic#"]', function(){
                                    var dataGet = $(this).attr('id').split('#')[1];
                                    mainDataGetUserSearch = dataGet;
                                    wavesurfer.pause();
                                    $(this).hide();
                                    $('a[id^="userSearchbaton-playMusic#'+ dataGet +'"]').css('display','inline');
                                });

                                wavesurfer.on('finish', function () {
                                    $('a[id^="userSearchbaton-pauseMusic#'+ mainDataGetUserSearch +'"]').css('display','none');
                                    $('a[id^="userSearchbaton-playMusic#'+ mainDataGetUserSearch +'"]').css('display','inline');
                                });
                            });

							//Clearing Banner Text And Change Count of users start
							$("#strongBannerText").empty();
							var txt = '<?php echo trans('misc.profile_images_available_category2') ?>';
							var txtbanner = '(' + res.length + ') ' + txt;
							$("#strongBannerText").append(txtbanner);
							//Clearing Banner Text And Change Count of users end


							//Adding Clear Search Button start
							var buttonSec = '<button class="btn btn-secondary" id="btnClearSearch" type="button" style="border-left:1px solid;">'+
							'Clear Search  <i class="fa fa-refresh"></i>'+
							'</button>';
							$("#buttonSectionDiv").append(buttonSec);
							//Adding Clear Search Button end

					}else{
						var icon = '<?php echo trans('misc.no_results_found'); ?>';
						var html ='<div class="btn-block text-center">'+
										'<i class="icon icon-Picture ico-no-result"></i>'+
									'</div>'+

									'<h3 class="margin-top-none text-center no-result no-result-mg">'+
										icon
									'</h3>';
									$("#DivImageFlex").empty();
									$("#DivImageFlex").append(html);


									//Clearing Banner Text And Change Count of users start
									$("#strongBannerText").empty();
									var txt = '<?php echo trans('misc.profile_images_available_category2') ?>';
									var txtbanner = '(' + res.length + ') ' + txt;
									$("#strongBannerText").append(txtbanner);
									//Clearing Banner Text And Change Count of users end


									//Adding Clear Search Button start
									var buttonSec = '<button class="btn btn-secondary" id="btnClearSearch" type="button" style="border-left:1px solid;">'+
													'Clear Search  <i class="fa fa-refresh"></i>'+
												'</button>';
												$("#buttonSectionDiv").append(buttonSec);
									//Adding Clear Search Button end
					}

				},
				error: function(){
					console.log('error while getting search result of user type');
				}
			});
		});

		$(document).on('click', '#btnClearSearch', function(){
			var searchArtistTypeId = $("#txt_search_artist_type_id").val();
			$.ajax({
				url: baseUrl + '/search-artist',
				type: 'POST',
				data: {"_token": "{{ csrf_token() }}","searchArtistTypeId": searchArtistTypeId},
				dataType: 'json',
				success: function(res){
					console.log(res);
					$("#buttonSectionDiv #btnClearSearch").remove();
					$("#txt_search_artist").val('');
					const baseUrl = '<?php echo url("/")?>';
					if(res.length > 0){
						var html = '';

						html += '<div id="imagesFlex" class="flex-images btn-block margin-bottom-40 dataResult">';
						html += '<div class="row">';
						$.each(res , function( index, value ) {
							console.log(index);
							console.log(value[0].username);
				// 			html +=	'<div class="col-md-4 mb-4-cutom">';
								// 		'<div class="choose-photographer-box">'+
								// 			'<div class="header-photographer">'+
								// 				'<div class="row">'+
								// 					'<div class="col-sm-4">'+
								// 						'<img src="' + baseUrl + '/public/avatar/' + value[0].avatar + '" alt="" class="set-img-size">'+
								// 					'</div>'+
								// 					'<div class="col-sm-7 offset-md-1">'+
								// 						'<h4 class="title-this">' + value[0].username + '</h4>'+
								// 						'<p class="tag-one">' + value[0].type_name  + '</p>'+
								// 					'</div>'+
								// 				'</div>'+
								// 			'</div>';

								// 			if(value[0].user_type_id == "1"){

								// 				html += '<div class="bottom" style="background-image: url('+ baseUrl +'/public/uploads/thumbnail/' +  value[0].img + ')">'+
								// 							'<div class="row">'+
								// 								'<div class="col-5 offset-7">'+
								// 									'<a href="' + baseUrl + '/artist/' + value[0].id + '" class="btn-portfolio-one mb-2">Portfolio</a>' +
								// 									'<a href="' + baseUrl + '/request-to-book?photographerId=' +  value[0].id + '&cityId=' + value[0].city_id + '" class="button-book-one mb-2">Book artist</a>'+
								// 									'<a href="javascript:;" class="button-chat-two" >Chat</a>'+
								// 								'</div>'+
								// 							'</div>'+
								// 						'</div>';
								// 			}else if(value[0].user_type_id == "3"){

								// 				html +=	'<div class="bottom" style="background-image: url(' + baseUrl +  '/public/uploads/video/screen_shot/'+ value[0].ScreenShot + ')">'+
								// 							'<div class="row">'+
								// 								'<div class="col-5 offset-7">'+
								// 									'<a href="' + baseUrl + '/artist/' + value[0].id + '" class="btn-portfolio-one mb-2">Portfolio</a>'+
								// 									'<a href="' + baseUrl + '/request-to-book?photographerId=' + value[0].id  + '&cityId=' + value[0].city_id + '" class="button-book-one mb-2">Book artist</a>'+
								// 									'<a href="javascript:;" class="button-chat-two" >Chat</a>'+
								// 								'</div>'+
								// 							'</div>'+
								// 						'</div>';
								// 			}else if(value[0].user_type_id == "2"){
								// 				html += '<div class="bottom" style="background-image: url('+ baseUrl + '/public/uploads/video/screen_shot/' + value[0].ScreenShot + ')">'+
								// 							'<div class="row">'+
								// 								'<div class="col-5 offset-7">'+
								// 									'<a href="' + baseUrl + '/artist/' + value[0].id + '" class="btn-portfolio-one mb-2">Portfolio</a>'+
								// 									'<a href="' + baseUrl + '/request-to-book?photographerId=' + value[0].id + '&cityId=' + value[0].city_id + '" class="button-book-one mb-2">Book artist</a>'+
								// 									'<a href="javascript:;" class="button-chat-two" >Chat</a>'+
								// 								'</div>'+
								// 							'</div>'+
								// 						'</div>';
								// 			}else if(value[0].user_type_id == "4"){
								// 				html += '<div class="bottom" style="background-image: url('+ baseUrl + '/public/uploads/thumbnail/musicWave.png'+ ')" >'+
								// 							'<div class="row">'+
								// 								'<div class="col-5 offset-7">'+
								// 									'<a href="'+ baseUrl + '/artist/' + value[0].id + '" class="btn-portfolio-one mb-2">Portfolio</a>'+
								// 									'<a href="'+ baseUrl + '/request-to-book?photographerId=' + value[0].id + '&cityId=' + value[0].city_id + '" class="button-book-one mb-2">Book artist</a>'+
								// 									'<a href="javascript:;" class="button-chat-two" >Chat</a>'+
								// 								'</div>'+
								// 							'</div>'+
								// 						'</div>';
								// 			}



								// 		html += ' </div>';
								//  html += '<div class="choose-photographer-box">'+
        //                             		'<div class="pt-4 pb-4 pl-3 pr-3">'+
        //                             			'<div class="">'+
        //                             			    '<a data-fancybox href="' + baseUrl + '/public/avatar/' + value[0].avatar + '">'+
        //                         					'<img src="' + baseUrl + '/public/avatar/' + value[0].avatar + '" alt="" class="photographer-thimbnial">'+
        //                         					'</a>'+
    				// 								'<h4 class="title-this-photographer">' + value[0].username + '</h4>'+
								// 					'<p class="tag-one-photographer">' + value[0].type_name  + '</p>'+
								// 					'<p class="tag-one-photographer" style="    margin-left: 77px;">' + value[0].CountryName  + '</p>';
        //                                         	if(value[0].user_type_id == "1"){
        //                                 			    html += '<div class="mt-4" style="text-align: center;" id="'+ value[0].id +'" >';
        //                                 			        $.ajax({
        //                                 			           url : baseUrl + '/getLimitImagesByUserId/'+ value[0].id,
        //                                 			           type:'get',
        //                                 			           dataType:'json',
        //                                 			           success:function(responseImage){
        //                                 			               var Imagehtml = '';
        //                                 			               console.log(responseImage);
        //                                 			               $.each( responseImage, function( key, valueImage ) {
        //                                 			                   Imagehtml += '<a data-fancybox href="'+ baseUrl +'/public/uploads/preview/' + valueImage.preview + '">'+
        //                                     					                '<img src="'+ baseUrl + '/public/uploads/preview/' + valueImage.preview + '" alt="" class="set-img-size">'+
        //                                     					                '</a>';
        //                                                           });
        //                                                           $("#"+ value[0].id).append(Imagehtml);
        //                                 			           },
        //                                 			           error:function(){
        //                                 			               console.log('errro while fetching limit images by user id ');
        //                                 			           }
        //                                 			        });

        //                             					html += '</div>';
        //                                         	}else if(value[0].user_type_id == "3"){
        //                                         	    html += '<div class="mt-4" style="text-align: center;" id="'+ value[0].id +'">';
        //                             			            $.ajax({
        //                                 			           url : baseUrl + '/getLimitVideosByUserId/'+ value[0].id,
        //                                 			           type:'get',
        //                                 			           dataType:'json',
        //                                 			           success:function(responseVideo){
        //                                 			               var Videohtml = '';
        //                                 			               $.each(responseVideo, function( key, valueVideo ) {
        //         								                        // var splitThumbnail = ;
        //         								                        // alert(JSON.stringify(valueVideo));
        //         								                        Videohtml += '<a data-fancybox href="'+ baseUrl + '/public/uploads/video/screen_shot/screen-shot-'+ valueVideo.thumbnail.split('.')[0] + '.png' +'">'+
        //                                     					        '<img src="'+ baseUrl + '/public/uploads/video/screen_shot/screen-shot-'+ valueVideo.thumbnail.split('.')[0] + '.png' +'" alt="" class="set-img-size">'+
        //                                     					        '</a>';
        //                                                           });
        //                                                           $("#"+ value[0].id).append(Videohtml);
        //                                 			           },
        //                                 			           error:function(){
        //                                 			               console.log('errro while fetching limit video by user id ');
        //                                 			           }
        //                                 			        });
        //                             					html += '</div>';

        //                                         	}else if(value[0].user_type_id == "2"){
        //                                         	    html += '<div class="mt-4" style="text-align: center;" id="'+ value[0].id +'" >';
        //                                 			        $.ajax({
        //                                 			           url : baseUrl + '/getLimitVideosByUserId/'+ value[0].id,
        //                                 			           type:'get',
        //                                 			           dataType:'json',
        //                                 			           success:function(responseAnimation){
        //                                 			               var Animationhtml = '';
        //                                 			               console.log(responseAnimation);
        //                                 			               $.each(responseAnimation, function( key, valueAnimation ) {
        //                                 			                   console.log(valueAnimation);
        //                                 			                   var splitAnimationThumbnail = valueAnimation.thumbnail.split('.')[0];
        //                                 			                    Animationhtml += '<a data-fancybox href="'+ baseUrl + '/public/uploads/video/screen_shot/screen-shot-' + splitAnimationThumbnail + '.png' + '">'+
        //                                     					            '<img src="'+ baseUrl + '/public/uploads/video/screen_shot/screen-shot-' + splitAnimationThumbnail + '.png' + '" alt="" class="set-img-size">'+
        //                                     					        '</a>';
        //                                                           });
        //                                                           $("#"+ value[0].id).append(Animationhtml);
        //                                 			           },
        //                                 			           error:function(){
        //                                 			               console.log('errro while fetching limit images by user id ');
        //                                 			           }
        //                                 			        });

        //                             					html += '</div>';
        //                                         	}

        //                         			    html += '</div>'+
        //                         		    '</div>'+
        //                         			'<div class="bottom" style="background-image: url(https://projects.hexawebstudio.com/darquise-nantel/public/uploads/thumbnail/musicWave.png)">'+
        //                         				'<div class="">'+
        //                         					'<div class="d-md-flex">'+

        //                         						'<a href="' + baseUrl + '/artist/' + value[0].id + '" class="btn-portfolio-one w-100 mt-0">Portfolio</a>'+
        //                 								'<a href="'+ baseUrl + '/request-to-book?photographerId=' + value[0].id + '&cityId=' + value[0].city_id + '" class="button-book-one w-100">Book artist</a>'+
        //                 								// <!--<a href="javascript:;" class="button-chat-two" >Chat</a>-->
        //                         					'</div>'+
        //                         				'</div>'+
        //                         			'</div>'+
        //                         	    '</div>';
								// 	html += '</div>';

								 html += '<div class="col-lg-4 col-md-6 mb-4-cutom">'+
                							    '<div class="choose-photographer-box">'+
                                            		'<div class="pt-4 pb-4 pl-3 pr-3">'+
                                            			'<div class="">'+
                                            			    '<a data-fancybox href="' + baseUrl + '/avatar/' + value[0].avatar +'">'+
                                        					    '<img src="' + baseUrl + '/avatar/' + value[0].avatar +'" alt="" class="photographer-thimbnial">'+
                                        					 '</a>'+
                                            			    '<h4 class="title-this-photographer">' + value[0].username + '</h4>'+
                                                            '<p class="tag-one-photographer">' + value[0].type_name + '</p>'+
                                                            '<p class="tag-one-photographer" style="    margin-left: 77px;">'+ value[0].CountryName + '</p>';

                                                            if(value[0].user_type_id == "1"){//1 user type photographer
                                                			    html +='<div class="mt-4" style="text-align: center;">';
                                                			    if(value[0].img != null){
                                                			        var splitImgs = value[0].img.split(',');
                                                			        //   for(var i=0; i < splitImgs.length; i++){
                                                			        for(var i=0; i < 4; i++){
                                                			            if(splitImgs[i] != undefined){
                                            								html +='<a data-fancybox href="' + baseUrl + '/uploads/preview/' + splitImgs[i] +'">'+
                                                        					    '<img src="' + baseUrl + '/uploads/preview/' + splitImgs[i] +'" alt="" class="set-img-size">'+
                                                            			    '</a>';
                                                			            }
                                                			        }
                                                			    }
                                            					html +='</div>';
                                                            }else if(value[0].user_type_id == "3"){//3 user type videographer
                                                                html +='<div class="mt-4" style="text-align: center;">';
                                                                if(value[0].vid != null){
                                                			        var splitVids = value[0].vid.split(',');
                                                			        //   for(var i=0; i < splitImgs.length; i++){
                                                			        for(var i=0; i < 4; i++){
                                                			            if(splitVids[i] != undefined){
                                            								html +='<a data-fancybox href="' + baseUrl + '/uploads/video/screen_shot/screen-shot-' + splitVids[i] +'">'+
                                                        					    '<img src="' + baseUrl + '/uploads/video/screen_shot/screen-shot-' + splitVids[i] +'" alt="" class="set-img-size">'+
                                                            			    '</a>';
                                                			            }
                                                			        }
                                                                }
                                            					html +='</div>';
                                                            }else if(value[0].user_type_id == "2"){//2 user type animation
                                                                html +='<div class="mt-4" style="text-align: center;">';
                                                                if(value[0].ani != null){
                                                			        var splitAnis = value[0].ani.split(',');
                                                			        //   for(var i=0; i < splitImgs.length; i++){
                                                			        for(var i=0; i < 4; i++){
                                                			            if(splitAnis[i] != undefined){
                                            								html +='<a data-fancybox href="' + baseUrl + '/uploads/video/screen_shot/screen-shot-' + splitAnis[i] +'">'+
                                                        					    '<img src="' + baseUrl + '/uploads/video/screen_shot/screen-shot-' + splitAnis[i] +'" alt="" class="set-img-size">'+
                                                            			    '</a>';
                                                			            }
                                                			        }
                                                                }
                                            					html +='</div>';
                                                            }else if(value[0].user_type_id == "4"){//4 user type musician
                                                            console.log('in musician');
                                                            console.log(value[0].mus);
                                                                html +='<div class="mt-4" style="text-align: center;">';
                                                                if(value[0].mus != null){
                                                			        var splitMus = value[0].mus.split(',');
                                                			        //   for(var i=0; i < splitImgs.length; i++){
                                                			        for(var i=0; i < 1; i++){
                                                			            if(splitMus[i] != undefined){
                                            								// htmlDiv +='<div class="qwewave" data-path="' + baseUrl + '/public/uploads/audio/large/' + splitMus[i] +'">'+
                                            								// '<button type="button" id="baton#'+ splitMus[i] + '">Play / Pause</button>'+
                                                    //     					   // '<img src="' + baseUrl + '/public/uploads/audio/large/' + splitMus[i] +'" alt="" class="set-img-size">'+
                                                    //     					    '<div class="wave-container"></div>'+
                                                    //         			    '</div>';

                                                            			    html += '<div class="qwewaveClear d-flex" data-path="' + baseUrl + '/uploads/audio/large/' + splitMus[i] +'">'+
                                                                                '<div class="align-self-center music-col-2">'+
                                                                                    '<a href="javascript:;" class="btn-music-play" id="Clearbaton-playMusic#'+ splitMus[i] +'">'+
                                                                                        '<i class="fas fa-play"></i>'+
                                                                                    '</a>'+
                                                                                    '<a href="javascript:;" class="btn-music-play" id="Clearbaton-pauseMusic#'+ splitMus[i] +'" style="display: none;">'+
                                                                                        '<i class="fas fa-pause"></i>'+
                                                                                    '</a>'+
                                                                                '</div>'+

                                                                                '<div class="wave-container music-col-10"></div>'+
                                                                            '</div>';
                                                			            }
                                                			        }
                                                                }else{
                                                                    html += '<p class="dummy-text-when-another-div-empty">No Music Available</p>';
                                                                }
                                            					html +='</div>';
                                                            }
                                        			    html +='</div>'+
                                        		    '</div>'+
                                        			'<div class="bottom" style="background-image: url(https://projects.hexawebstudio.com/darquise-nantel/uploads/thumbnail/musicWave.png)">'+
                                        				'<div class="">'+
                                        					'<div class="d-md-flex">'+
                                        						'<a href="' + baseUrl + '/artist/' + value[0].id + '" class="btn-portfolio-one w-100 mt-0">Portfolio</a>'+
                                        				// 		'<a href="' + baseUrl + '/request-to-book?photographerId=' + value[0].id + '&cityId=' + value[0].city_id+ '" class="button-book-one w-100">Book artist</a>'+
                                        						'<a href="' + baseUrl + '/request-to-book?photographerId=' + value[0].id + '" class="button-book-one w-100">Book artist</a>'+
                                        					'</div>'+
                                        				'</div>'+
                                        			'</div>'+
                                            	'</div>'+
                                	        '</div>';
								});
							html += '</div>';
							html += '</div>';
							$("#DivImageFlex").empty();
							$("#DivImageFlex").append(html);

							$('.qwewaveClear').each(function(){
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


                                var mainDataGetClear = '';
                                $(document).on('click', 'a[id^="Clearbaton-playMusic#"]', function(){
                                    var dataGet = $(this).attr('id').split('#')[1];
                                    mainDataGetClear = dataGet;
                                    wavesurfer.play();
                                    $(this).hide();
                                    // $("#pauseMusic").show();
                                    // $("#baton-pauseMusic#"+ dataGet).css('display','block');
                                    $('a[id^="Clearbaton-pauseMusic#'+ dataGet +'"]').css('display','inline');
                                });
                                // $('a[id^="baton-pauseMusic#"]').click(function() {
                                $(document).on('click', 'a[id^="Clearbaton-pauseMusic#"]', function(){
                                    var dataGet = $(this).attr('id').split('#')[1];
                                    mainDataGetClear = dataGet;
                                    wavesurfer.pause();
                                    $(this).hide();
                                    $('a[id^="Clearbaton-playMusic#'+ dataGet +'"]').css('display','inline');
                                });

                                wavesurfer.on('finish', function () {
                                    $('a[id^="Clearbaton-pauseMusic#'+ mainDataGetClear +'"]').css('display','none');
                                    $('a[id^="Clearbaton-playMusic#'+ mainDataGetClear +'"]').css('display','inline');
                                });
                            });

							//Clearing Banner Text And Change Count of users start
							$("#strongBannerText").empty();
							var txt = '<?php echo trans('misc.profile_images_available_category2') ?>';
							var txtbanner = '(' + res.length + ') ' + txt;
							$("#strongBannerText").append(txtbanner);
							//Clearing Banner Text And Change Count of users end

					}else{
						var icon = '<?php echo trans('misc.no_results_found'); ?>';
						var html ='<div class="btn-block text-center">'+
										'<i class="icon icon-Picture ico-no-result"></i>'+
									'</div>'+

									'<h3 class="margin-top-none text-center no-result no-result-mg">'+
										icon
									'</h3>';
									$("#DivImageFlex").empty();
									$("#DivImageFlex").append(html);

									//Clearing Banner Text And Change Count of users start
							$("#strongBannerText").empty();
							var txt = '<?php echo trans('misc.profile_images_available_category2') ?>';
							var txtbanner = '(' + res.length + ') ' + txt;
							$("#strongBannerText").append(txtbanner);
							//Clearing Banner Text And Change Count of users end
					}

				},
				error: function(){
					console.log('error while getting search result of user type');
				}
			});
		});

 $('#imagesFlex').flexImages({ rowHeight: 320 });

//<<---- PAGINATION AJAX
        $(document).on('click','.pagination a', function(e){
			e.preventDefault();
			var page = $(this).attr('href').split('page=')[1];
			$.ajax({
				headers: {
        	'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    		},
					url: '{{ url("/") }}/ajax/category?slug={{$category->slug}}&page=' + page


			}).done(function(data){
				if( data ) {

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

					$('#imagesFlex').flexImages({ rowHeight: 320 });
					jQuery(".timeAgo").timeago();

					$('[data-toggle="tooltip"]').tooltip();
				} else {
					sweetAlert("{{trans('misc.error_oops')}}", "{{trans('misc.error')}}", "error");
				}
				//<**** - Tooltip
			});

		});//<<---- PAGINATION AJAX


</script>


@endsection
