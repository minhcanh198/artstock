@extends('dashboard.layout')

@section('css')
<link href="{{ asset('plugins/iCheck/all.css') }}" rel="stylesheet" type="text/css" />
<style>
/**
 * The CSS shown here will not be introduced in the Quickstart guide, but shows
 * how you can use CSS to style your Element's container.
 */
.StripeElement {
  box-sizing: border-box;

  height: 35px;

  padding: 8px 12px;

  border: 1px solid #ccc;
  background-color: white;
  -webkit-transition: box-shadow 150ms ease;
  transition: box-shadow 150ms ease;

  margin-top: 10px;
}

.StripeElement--focus {
	border-color: #3c8dbc;
}

.StripeElement--invalid {
  border-color: #fa755a;
}

.StripeElement--webkit-autofill {
  background-color: #fefde5 !important;
}


.rate {
    float: left;
    height: 46px;
    padding: 0 10px;
}
.rate:not(:checked) > input {
    position:absolute;
    top:-9999px;
}
.rate:not(:checked) > label {
    float:right;
    width:1em;
    overflow:hidden;
    white-space:nowrap;
    cursor:pointer;
    font-size:30px;
    color:#ccc;
}
.rate:not(:checked) > label:before {
    content: '★ ';
}
.rate > input:checked ~ label {
    color: #ffc700;
}
.rate:not(:checked) > label:hover,
.rate:not(:checked) > label:hover ~ label {
    color: #deb217;
}
.rate > input:checked + label:hover,
.rate > input:checked + label:hover ~ label,
.rate > input:checked ~ label:hover,
.rate > input:checked ~ label:hover ~ label,
.rate > label:hover ~ input:checked ~ label {
    color: #c59b08;
}
</style>
@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h4>
            {{ trans('admin.admin') }}
            	<i class="fa fa-angle-right margin-separator"></i>
            		{{ trans('misc.review') }}
          </h4>

        </section>

        <!-- Main content -->
        <section class="content">

          <div class="alert alert-danger display-none" id="error">
              <ul class="list-unstyled" id="showErrors"></ul>
            </div>

        	<div class="content">
            <div class="row">
              <div class="box box-success">

                <!-- form start -->
                <form class="form-horizontal padding-top-20" enctype="multipart/form-data" method="post" action="{{url('user/dashboard/process-review')}}" id="formReview">

                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="shootId" id="shootId" value="{{ $shootId }}">


                    <!-- Start Box Body -->
                    <div class="box-body">
                    <div id="errorReviewStar" style="display:none;"></div>
                        <div class="form-group">
                            <div id="errorReviewStar" style="display:none;" class="col-sm-6"></div>
                            <label class="col-sm-2 control-label">{{ trans('misc.rate') }}</label>
                            <div class="col-sm-10">

                                <div class="rate">
                                    <input type="radio" id="star-5" name="rate" value="5" />
                                    <label for="star-5">5 stars</label>
                                    <input type="radio" id="star-4" name="rate" value="4" />
                                    <label for="star-4">4 stars</label>
                                    <input type="radio" id="star-3" name="rate" value="3" />
                                    <label for="star-3">3 stars</label>
                                    <input type="radio" id="star-2" name="rate" value="2" />
                                    <label for="star-2">2 stars</label>
                                    <input type="radio" id="star-1" name="rate" value="1" />
                                    <label for="star-1">1 star</label>
                                </div>
                                <input type="hidden"  value="" name="review_rate" id="review_rate" class="form-control">
                            </div>
                        </div>
                    </div><!-- /.box-body -->


                    <div class="box-body">
                    <div id="errorReviewDescription" style="display:none;"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">{{ trans('misc.description') }}</label>
                            <div class="col-sm-10">
                                <textarea name="description" id="description" class="form-control"  rows="10"></textarea>
                            </div>
                        </div>
                    </div><!-- /.box-body -->



                     <!-- Start Box Body -->
                <div class="box-body">
                <div id="errorReviewImage" style="display:none;"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Attach Image</label>
                        <div class="col-sm-10">

                            <div class="btn-block margin-bottom-10">

                            </div>

                            <div class="btn btn-info box-file">
                                <input type="file" accept="image/*" name="review_image" id="review_image" class="filePhoto" />
                                <i class="glyphicon glyphicon-cloud-upload myicon-right"></i>
                                <span class="text-file">{{ trans('misc.choose_image') }}</span>
                            </div>

                            <div class="btn-default btn-lg btn-border btn-block pull-left text-left display-none fileContainer">
                                <i class="glyphicon glyphicon-paperclip myicon-right"></i>
                                <small class="myicon-right file-name-file"></small> <i class="icon-cancel-circle delete-image btn pull-right" title="{{ trans('misc.delete') }}"></i>
                            </div>
                        </div>
                    </div>
                </div><!-- /.box-body -->

                    <div class="box-footer">
                        <a href="{{url('user/dashboard/my-shoots')}}" class="btn btn-default"><i class="fa fa-long-arrow-left"></i> {{ trans('auth.back') }}</a>
                        <button type="button" class="btn btn-success pull-right spin-btn" id="addReviewsBtn">
                            {{ trans('misc.add_reviews') }} <span></span>
                        </button>
                    </div><!-- /.box-footer -->
                </form>

        		</div><!-- /.row -->

        	</div><!-- /.content -->

          <!-- Your Page Content Here -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
@endsection

@section('javascript')

	<!-- icheck -->
	<script src="{{ asset('plugins/iCheck/icheck.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('js/jquery.form.js') }}"></script>
  <script src="https://js.stripe.com/v3/"></script>
  <script src='https://js.paystack.co/v1/inline.js'></script>

    <script type="text/javascript">

    $("#addReviewsBtn").click(function(){
        var reviewStar          = $("#review_rate").val();
        var reviewDescription   = $("#description").val();
        var reviewImage         = document.getElementById("review_image").value;
        // console.log(reviewImage);

        if(reviewStar == "")
        {
            $("#errorReviewStar").html('Required');
            $("#errorReviewStar").css('color','red');
            $("#errorReviewStar").show();
            setTimeout(function(){
                $('#errorReviewStar').hide();
            }, 3000);

        }else if(reviewDescription == ""){
            $("#errorReviewDescription").html('Required');
            $("#errorReviewDescription").css('color','red');
            $("#errorReviewDescription").show();
            setTimeout(function(){
                $('#errorReviewDescription').hide();
            }, 3000);
        }else if(reviewImage == ""){
            $("#errorReviewImage").html('Required');
            $("#errorReviewImage").css('color','red');
            $("#errorReviewImage").show();
            setTimeout(function(){
                $('#errorReviewImage').hide();
            }, 3000);
        }else{
            $("#formReview").submit();
        }
    });

    $(document).ready(function(){
        console.log('ready ');
        $('input[id^="star-"]').click(function(){
            let Value = $(this).val();
            $("#review_rate").val('');
            $("#review_rate").val(Value);

        });
    });



$(".filePhoto").on('change', function(){

var element = $(this);

element.parents('.box-file').find('.text-file').html('{{trans('misc.choose_image')}}');

  var loaded = false;
  if(window.File && window.FileReader && window.FileList && window.Blob){
  // Check empty input filed
      if($(this).val()) {

          oFReader = new FileReader(), rFilter = /^(?:image\/gif|image\/ief|image\/jpeg|image\/jpeg|image\/jpeg|image\/png|image)$/i;
          if($(this)[0].files.length === 0){return}

          var oFile = $(this)[0].files[0];
    var fsize = $(this)[0].files[0].size; //get file size
          var ftype = $(this)[0].files[0].type; // get file type

    // Validate formats
    if(!rFilter.test(oFile.type)) {
              element.val('');
              alert("{{ trans('misc.formats_available') }}");
              return false;
          }

    // Validate Size
    if(!rFilter.test(oFile.type)) {
              element.val('');
              alert("{{ trans('misc.formats_available') }}");
              return false;
          }

          oFReader.onload = function (e) {

              var image = new Image();
      image.src = oFReader.result;

              image.onload = function() {

        element.parents('.box-body').find('.fileContainer').removeClass('display-none');
        element.parents('.box-body').find('.file-name-file').html(oFile.name);
      };// <<--- image.onload
    }
      oFReader.readAsDataURL($(this)[0].files[0]);
      }// Check empty input filed
  }// window File
});
// END UPLOAD PHOTO

$('.delete-image').click(function(){
    var element = $(this);

    element.parents('.box-body').find('.fileContainer').addClass('display-none');
    element.parents('.box-body').find('.file-name-file').html('');
    element.parents('.box-body').find('.filePhoto').val('');
});

</script>
@endsection
