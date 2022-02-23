{{-- @extends('app') --}}
@extends('new_template.layouts.app')

@section('title'){{ $category->name.' - ' }}@endsection

@section('content')
<style>
.color-black {
    color: #000;
}
</style>

<!-- Paypal Checkout Added by shahzad -->
<!-- Include the PayPal JavaScript SDK -->
<script src="https://www.paypal.com/sdk/js?client-id=ASy70TwJR4ZZ9M40E_o-EBaF0Ni6c58Cfu46kgsBbti22YddJrR78ZX1yUJd573C820D1rR9d9-GmzAJ&currency=USD"></script>
<!-- Paypal Checkout Added by shahzad -->

	<div class="jumbotron md index-header jumbotron_set jumbotron-cover" style="height:50%;">
		<div class="container wrap-jumbotron position-relative">
			<h1 class="title-site title-sm">{{ $category->name }}</h1>
			@if( $images->total() != 0 )
				<p class="subtitle-site"><strong>({{number_format($images->total())}}) {{trans_choice('misc.images_available_category',$images->total() )}}</strong></p>
			@else
				<p class="subtitle-site"><strong>{{$settings->title}}</strong></p>
			@endif
			<div class="row mt-5">
				<div class="col-lg-2">
				</div>
				<div class="col-lg-8">
					<form method="post" action="<?php echo url('/sub-category-music/search-by-industry')?>">
					@csrf
					<div class="input-group">
					@php
					$urlSegment = \Request::segment(2);
					@endphp
						<input type="text" class="form-control mt-0" id="txt_search_industry" name="txt_search_industry" placeholder="Search" value="{{ (isset($q)) ? $q : '' }}">
						<input type="hidden" class="form-control" id="txt_search_industry_id" name="txt_search_industry_id" value="{{ $category->id }}">
						<input type="hidden" class="form-control" id="slug" name="slug" value="music">
						<div class="input-group-append" id="buttonSectionDiv">
							<!-- <button class="btn btn-secondary" id="btnSubmitTxtIndustrySearch" type="submit"> -->
							<button class="btn btn-secondary" type="submit">
								<i class="fa fa-search"></i>
							</button>
							@if($urlSegment == "search-by-industry")
							<a class="btn btn-secondary" id="btnClearSearch" href="{{ url('/sub-category-music/').'/'. $category->slug }}" style="border-left:1px solid;">
								Clear Search  <i class="fa fa-refresh"></i>
							</a>
							@endif

						</div>
					</div>
					</form>
				</div>
				<div class="col-lg-2">
				</div>
			</div>
		</div>
    </div>

<div class="container">

    <div class="row" >

        <div class="tabs">
            <div class="tabs__navigation" data-aos="fade-down">
                @php
                    $getCategoryDetails = \DB::table('categories')->where('name','=', $category->name)->first();
                    $getCategoriesList = \DB::table('categories')->where('slug','!=', 'uncategorized')->where('parent_id','=', $getCategoryDetails->parent_id)->where('parent_id','!=', $getCategoryDetails->id)->orderBy('name', 'asc')->get();
                @endphp
                @foreach($getCategoriesList as $categor)
                {{-- <!-- <button  id="buttonCategories|{{ $categor->slug }}" data-target="{{ $categor->slug }}">{{ $categor->name }}</button> --> --}}
                    <a href="{{ url('/'). '/sub-category-music/'. $categor->slug }}">{{ $categor->name }}</a>
                @endforeach
            </div>
        </div>
    </div>
<!-- Col MD -->
    <div class="row">
        <div class="col-12">

            <?php
				if($images->total() != 0){
					foreach($images as $img_key => $imge){

					    $userDetails = App\Models\User::where('id','=', $imge->user_id)->first();
			?>
			            <?php /*?>
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
						<?php */?>


						<div class="audio-song-box Bigwave" data-path="<?php echo url('/uploads/audio/large/').'/' . $imge->thumbnail; ?>">

                            <div class="row">
                                <div class="col-md-6">
                                    <span class="d-block">
                            			<h5 class="text-overflow author-label mg-bottom-xs" title="{{ $userDetails->username }}">
                            				<img src="{{ url('/') .'/avatar/'. $userDetails->avatar }}" alt="User" class="img-circle img-circle-2">
                            				<span class="color-black">{{ $userDetails->username }}</span>
                        				</h5>
                            				<!--<span class="btn-block date-color text-overflow">{{ $imge->title }}</span>-->
                            				<span class="timeAgo btn-block date-color text-overflow" data="{{ $imge->date }}"></span>
                            	    </span>
                                </div>
                                <div class="col-md-6">
                                    <div class="audio-icons ml-auto d-flex align-self-center justify-content-end">
                                        <!-- <a href="" class="icon-one"><i class="fas fa-download"></i></a>
                                        <a href="" class="icon-one"><i class="fas fa-heart"></i></a> -->
                                        <!--<a href="javascript:;<?php //echo url('/uploads/audio/large/'). '/'. $imge->thumbnail; ?>" @if( $imge->item_for_sale == 'free' ) download="<?php echo $imge->thumbnail; ?>" @endif class="buy-track"><span>${{$imge->price}}</span> Buy</a>-->
                                        <form action="{{url('purchase/audio', $imge->token_id)}}" method="post">
                                        @csrf
                                        <!--<input type="text" name="token_id" value="{{$imge->token_id}}">-->
                                        <!--<button type="submit" class="buy-track stripeBtn" data-name="{{$imge->title}}" data-description="{{$imge->description}}" data-amount="{{$imge->price}}"><span>${{$imge->price}}</span> Buy</button>-->


                                        <!-- DropDown Button Start -->
                                        <div class="dropdown">
                                          <button class="btn buy-track dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <span>${{$imge->price}}</span> Buy
                                          </button>
                                          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                              <li class="dropdown-item">
                                                <a class="stripeBtn btn btn-primary" href="javascript:;"  data-name="{{$imge->title}}" data-description="{{$imge->description}}" data-amount="{{$imge->price}}">Stripe</a>
                                              </li>
                                              <li class="dropdown-item">
                                                <div id="paypal-button-container-{{$imge->id}}"></div>
                                              </li>
                                          </div>
                                        </div>
                                        <!-- DropDown Button End -->

                                        <script>
                                        // Render the PayPal button into #paypal-button-container
                                        paypal.Buttons({

                                            style: {
                                                 layout: 'horizontal',
                                                 tagline: 'false'
                                            },

                                            // Set up the transaction
                                            createOrder: function(data, actions) {
                                                return actions.order.create({
                                                    purchase_units: [{
                                                        amount: {
                                                            value: '{{$imge->price}}'
                                                        }
                                                    }]
                                                });
                                            },

                                            // Finalize the transaction
                                            onApprove: function(data, actions) {
                                                return actions.order.capture().then(function(orderData) {
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

                                                    $('#paypal-button-container-{{$imge->id}}').parents('form').append($('<input>').attr({ type: 'hidden', name: 'payment_option', value: 'paypal' }));
                                                    $('#paypal-button-container-{{$imge->id}}').parents('form').append($('<input>').attr({ type: 'hidden', name: 'paypalTxnId', value: transaction.id }));
                                                    $('#paypal-button-container-{{$imge->id}}').parents('form').submit();
                                                });
                                            },

                                            onError: function (err) {
                                                // For example, redirect to a specific error page
                                                //window.location.href = "/your-error-page-here";
                                                console.log('Some Error Occured!');
                                              }


                                        }).render('#paypal-button-container-{{$imge->id}}');
                                        </script>


                                        <!--<span class="align-self-center ml-2 p-0">
            								<span class="myicon-right"><i class="fa fa-heart-o myicon-right"></i> 1</span>
                            				<span class="myicon-right"><i class="icon icon-Download myicon-right"></i> 1</span>
                            			</span>--><!-- Span Out -->
                            			</form>

                                    </div>
                                </div>
                            </div>
                    	    <!--<button type="button">Play / Pause</button>-->

                    	    <div class="row music-main-page-home">
                    	        <div class="align-self-center col-md-2 text-center">{{ $imge->title }}</div>
                        	    <div class="align-self-center col-md-1 text-center">
                                    <a href="javascript:;" class="btn-music-play" id="Bigbaton-playMusic#{{ $img_key }}">
                                        <i class="fas fa-play"></i>
                                    </a>
                                    <a href="javascript:;" class="btn-music-play" id="Bigbaton-pauseMusic#{{ $img_key }}" style="display: none;">
                                        <i class="fas fa-pause"></i>
                                    </a>
                                </div>
                    	        <div class="wave-container col-md-8 p-0"></div>

                	        </div>


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
			<?php

				if($images->total() != 0){

			?>
					<form method="get" action="<?php echo url('/'). '/search'; ?>">
                        <input type="hidden" name="type" value="4">
                        <input type="hidden" id="sort-Fresh" class="btn-sort-by-search" name="sort" value="Fresh">
                        <div class="music-btn text-center">
                            <button type="submit" class="theme-btn">Browse All</button>
                        </div>
                    </form>
			<?php
				}
			?>
        </div>
    </div>

 </div><!-- container wrap-ui -->
 <section class="section-popular mb-5">
		<div class="container">
			<div class="row mb-4">
				<div class="col-12">
					<div class="d-flex">
						<div class="">
						<?php
							$categorySlug = $parentCategory->slug;
							if($categorySlug == "animation" ){
						?>
								<h1 class="popular-title">Popular Animators</h1>
						<?php
							}else if($categorySlug == "photo"){
						?>
								<h1 class="popular-title">Popular Photographers</h1>
						<?php
							}else if($categorySlug == "video"){
						?>
								<h1 class="popular-title">Popular Videographers</h1>
						<?php
							}else if($categorySlug == "music"){
						?>
								<h1 class="popular-title">Popular Musicians</h1>
						<?php
							}
						?>
						</div>
						<div class="ml-auto align-self-center">
							{{-- <a class="btn-see-all" href="">See All</a> --}}
						</div>
					</div>
				</div>
			</div>
			<userslidercategory categorySlug=<?php echo $parentCategory->slug; ?> sessionUser=<?php echo (\Auth::user()) ? \Auth::user()->id : ''; ?>></userslidercategory>
		</div>
	</section>

@endsection

@section('javascript')

<script type="text/javascript">

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


<!-- Stripe Checkout Added by Shahzad -->
<script src="https://checkout.stripe.com/v2/checkout.js"></script>
<script>
$('.stripeBtn').on('click', function(e) {
  var strBtn = $(this);

  strBtn.prop("disabled", true);
    // Open Checkout with further options:
      StripeCheckout.configure({
        key: '{{env("STRIPE_KEY")}}',
        image: 'https://projects.hexawebstudio.com/darquise-nantel/img/favicon.png',
        locale: 'auto',
        token: function(token) {
        // You can access the token ID with `token.id`.
        // Get the token ID to your server-side code for use.
        console.log("Token created: " + token.id);

        strBtn.parents('form').append($('<input>').attr({ type: 'hidden', name: 'payment_option', value: 'stripe' }));
        strBtn.parents('form').append($('<input>').attr({ type: 'hidden', name: 'stripeToken', value: token.id }));
        strBtn.parents('form').submit();

      },
      opened: function() {
      	console.log("Form opened");
      	strBtn.prop("disabled", false);
      },
      closed: function() {
      	console.log("Form closed");
      	strBtn.prop("disabled", false);
      }
    }).open({
    name: strBtn.data('name'),
    description: strBtn.data('description'),
    amount: strBtn.data('amount')*100
  });
  e.preventDefault();
});

// Close Checkout on page navigation:
$(window).on('popstate', function() {
  handler.close();
});



</script>
<!-- Stripe Checkout addedd by shahzad -->


@endsection
