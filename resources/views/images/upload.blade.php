@extends('new_template.layouts.app')
 
@section('title')
  {{-- trans('users.upload').' - ' --}}
  {{ 'Image Upload'.' - ' }}
@endsection

@section('css')

<link href="{{ asset('public/plugins/iCheck/all.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('public/plugins/tagsinput/jquery.tagsinput.min.css') }}" rel="stylesheet" type="text/css" />


<style type="text/css">


img {
display: block;
max-width: 100%;
}
.preview {
overflow: hidden;
width: 160px; 
height: 160px;
margin: 10px;
border: 1px solid red;
}
.modal-lg{
max-width: 1000px !important;
}
</style>

@endsection

@section('content')

<div class="container margin-bottom-40 padding-top-40">
    
                                            <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
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
                                            <img id="image" src="">
                                            </div>
                                            <div class="col-md-4">
                                            <div class="preview"></div>
                                            </div>
                                            </div>
                                            </div>
                                            </div>
                                            <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                            <button type="button" class="btn btn-primary" id="rotate">Rotate</button>
                                            <button type="button" class="btn btn-primary" id="crop">Crop</button>
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
				<?php if( $settings->limit_upload_user == 0 ) {
					$limit = strtolower(trans('admin.unlimited'));
				} else {
					$limit = $settings->limit_upload_user;
				} ?>
				<li class="margin-bottom-10"><i class="glyphicon glyphicon-warning-sign myicon-right"></i>  {{ trans('conditions.terms') }}</li>
				<li class="margin-bottom-10"><i class="glyphicon glyphicon-info-sign myicon-right"></i>  {{ trans('conditions.upload_max', ['limit' => $limit ]) }}</li>
				<li class="margin-bottom-10"><i class="glyphicon glyphicon-info-sign myicon-right"></i>  {{ trans('conditions.sex_content') }}</li>
				<li class="margin-bottom-10"><i class="glyphicon glyphicon-info-sign myicon-right"></i>  {{ trans('conditions.own_images') }}</li>
			</ul>

		</div>
		
		

@include('errors.errors-forms')
    <!-- form start -->
    <form method="POST" action="{{ url('upload/image') }}" enctype="multipart/form-data" id="formUpload" files="true">

    	<input type="hidden" name="_token" value="{{ csrf_token() }}">
    	
    	<input type="hidden" name="base64data" id="base64data" value="">
        
        <?php /* Commented by shahzad ?>
		<div class="filer-input-dragDrop position-relative" id="draggable" style="width: 750px;
    height: 500px;">
            <input type="hidden" name="baseTxtImg" id="baseTxtImg" value="">
			<!--<input type="file" accept="image/*" name="photo" id="filePhoto" class="input-big-image">-->
			<!--<input type="file" accept="image/*"  name="photo"  class="img-upload-input-bs" editor="#img-upload-panel" target="#image" status="#status" passurl=""  pshape="square" w=300 h=300 size="viewport"/>
<img src="" alt="" id="image"/>-->
            <input type="file" name="photo" id="uploadPhoto" class="image" onchange="loadFile(event)">
			<!-- previewPhoto -->
                <!--<div class="previewPhoto" style="visibility: hidden;" data-cropzee="filePhoto"></div>-->
            <!-- previewPhoto -->
            <!-- Using Bootstrap Modal -->
    
      <div class="btn btn-danger btn-sm btn-remove-photo display-none" id="removePhoto">
        <i class="icon icon-Delete myicon-right"></i> {{trans('misc.delete')}}
        </div>

			<div class="filer-input-inner">
				<div class="filer-input-icon">
					<i class="fa fa-cloud-upload"></i> 
					</div>
					<div class="filer-input-text">
						<h3 class="margin-bottom-10">{{ trans('misc.click_select_image') }} Developer test</h3>
						<h3>{{ trans('misc.max_size') }}: {{  $settings->min_width_height_image.' - '.App\Helper::formatBytes($settings->file_size_allowed * 1024)}} </h3>
					
					</div> 
				</div>
			
			
			</div>
			<?php Commented by shahzad */ ?>
            <!--<div class="preview"></div>-->
             <img id="outputt" width="120" src="">
			<div class="panel panel-default padding-20 border-none">

				<div class="panel-body">
				    
				    
				    <!-- upload image test -->
				    <!-- Start Form Group -->
                    <div class="form-group">
                      <label>{{ trans('misc.type_image') }} Developer test</label>
                      	<select name="type_image" class="form-control" id="typeImage">
                            <option value="image">{{ trans('misc.image') }}</option>
                            <option value="vector">{{ trans('misc.type_vector_graphic') }}</option>
                          </select>
                            
                          <span class="btn-block display-none" id="imageSpan">
                            <!--<button type="button" class="btn btn-default btn-block" id="upload_file" style="margin-top: 10px;border-style: dashed;padding: 12px;">
                            <i class="fa fa-cloud-upload myicon-right"></i> Select a file (JPG, PNG, GIF)
                            </button>-->
                            
                            <img id="output" width="120" src="">
                            <br />
                            <input type="file" name="photo" id="uploadPhoto" class="image" onchange="loadFile(event)">
                            <input type="hidden" name="baseTxtImg" id="baseTxtImg" value="">
                            <small class="help-block"><i class="fa fa-cloud-upload myicon-left"></i> Select a file (JPG, PNG, GIF)</small>
                          </span>
                          
                          <span class="btn-block display-none" id="vector" style="display:none;">
                            <!--<button type="button" class="btn btn-default btn-block" id="upload_file" style="margin-top: 10px;border-style: dashed;padding: 12px;">
                            <i class="fa fa-cloud-upload myicon-right"></i> {{trans('misc.select_vector')}}
                            </button>-->

                            <input type="file" name="file" id="uploadFile" style="/*visibility: hidden;*/">
                            <small class="help-block"><i class="fa fa-cloud-upload myicon-left"></i> {{trans('misc.select_vector')}}</small>
                          </span>
                    </div><!-- /.form-group-->
                    <small class="help-block" id="fileDocument"></small>
				    
				    <!-- upload image test -->
				    
				    
				    
				    
                 <!-- Start Form Group -->
                    <div class="form-group">
                      <label>{{ trans('admin.title') }}</label>
                        <input type="text" value="{{ old('title') }}" name="title" id="title" class="form-control" placeholder="{{ trans('admin.title') }}">
                    </div><!-- /.form-group-->

                   <!-- Start Form Group -->
                    <div class="form-group">
                      <label>{{ trans('misc.tags') }}</label>
                        <input type="text" value="{{ old('tags') }}" id="tagInput"  name="tags" class="form-control" placeholder="{{ trans('misc.tags') }}">
                      	<p class="help-block">* {{ trans('misc.add_tags_guide') }} ({{trans('misc.maximum_tags', ['limit' => $settings->tags_limit ]) }})</p>
                  </div><!-- /.form-group-->

                 <!-- Start Form Group -->
                 <div class="form-group">
                    <label>{{ trans('misc.category') }}</label>
                    <select name="categories_id" id="categoryId" class="form-control">
                      <option value="">Select Category</option>
                      @foreach(  App\Models\Categories::where('mode','on')->where('parent_id','=','0')->where('slug','!=','uncategorized')->orderBy('name')->get() as $category )
                        <option value="{{$category->id}}">{{ $category->name }}</option>
                      @endforeach
                    </select>
                  </div><!-- /.form-group-->

                   <!-- Start Form Group -->
                   <div class="form-group" id="subCategoryDiv" style="display:none;">
                    <label>{{ trans('misc.subcategory') }}</label>
                    <select name="sub_categories_id" id="subCategoryId" class="form-control">
                      <option value="">Select Sub Category</option>
                     
                    </select>
                  </div><!-- /.form-group-->

                  @if($settings->sell_option == 'on')
                  <!-- Start Form Group -->
                    <div class="form-group">
                      <label style="display:none;">{{ trans('misc.item_for_sale') }}</label>
                      	<select hidden name="item_for_sale" class="form-control" id="itemForSale">
                            <option value="free">{{ trans('misc.no_free') }}</option>
                            <option selected value="sale">{{ trans('misc.yes_for_sale') }}</option>
                          </select>
                  </div><!-- /.form-group-->

                  <!-- Start Form Group -->
                     <!--<div class="form-group display-none" id="priceBox">-->
                     <div class="form-group " id="priceBox">
                       <label>({{ $settings->currency_symbol }}) {{ trans('misc.price') }}</label>
                         <input type="number" value="" name="price" class="form-control onlyNumber" autocomplete="off" id="price" placeholder="{{ trans('misc.price') }}">
                         <p class="help-block">* {{ trans('misc.user_gain', ['percentage' => (100 - $settings->fee_commission)]) }}</p>

                         <div class="alert alert-success">
                           <h4>{{trans('misc.price_formats')}}</h4>
                           <ul class="list-unstyled">
                             <li><strong>{{trans('misc.small_photo_price')}}</strong> {{ $settings->currency_position == 'left' ? $settings->currency_symbol : null }}<span id="s-price">0</span>{{ $settings->currency_position == 'right' ? $settings->currency_symbol : null }}</li>
                             <li><strong>{{trans('misc.medium_photo_price')}}</strong> {{ $settings->currency_position == 'left' ? $settings->currency_symbol : null }}<span id="m-price">0</span>{{ $settings->currency_position == 'right' ? $settings->currency_symbol : null }}</li>
                             <li><strong>{{trans('misc.large_photo_price')}}</strong> {{ $settings->currency_position == 'left' ? $settings->currency_symbol : null }}<span id="l-price">0</span>{{ $settings->currency_position == 'right' ? $settings->currency_symbol : null }}</li>
                             <li><strong>{{trans('misc.vector_photo_price')}}</strong> {{ $settings->currency_position == 'left' ? $settings->currency_symbol : null }}<span id="v-price">0</span>{{ $settings->currency_position == 'right' ? $settings->currency_symbol : null }} {{trans('misc.if_included')}}</li>
                           </ul>
                           <small>{{trans('misc.price_maximum')}} {{\App\Helper::amountFormat($settings->max_sale_amount)}} | {{trans('misc.price_minimum')}} {{\App\Helper::amountFormat($settings->min_sale_amount)}}</small>
                         </div>
                     </div><!-- /.form-group-->

                     @endif

                  <!-- Start Form Group -->
                    <div class="form-group options_free" style="display:none;">
                      <label>{{ trans('misc.how_use_image') }}</label>
                      	<select name="how_use_image" class="form-control">
                            <!--<option value="free">{{ trans('misc.use_free') }}</option>-->
                            <!--<option value="free_personal">{{ trans('misc.use_free_personal') }}</option>-->
                             <option value="editorial_only">{{ trans('misc.use_editorial_only') }}</option>
                              <option value="web_only">{{ trans('misc.use_web_only') }}</option>
                          </select>
                  </div><!-- /.form-group-->

                  

                  <!-- Start form-group -->
                    <div class="form-group options_free" style="display:none;">
                      <label>{{ trans('misc.attribution_required') }}</label>

                      	<div class="radio">
                        <label class="padding-zero">
                          <input type="radio" name="attribution_required" value="yes">
                          {{ trans('misc.yes') }}
                        </label>
                      </div>

                      <div class="radio">
                        <label class="padding-zero">
                          <input type="radio" name="attribution_required" checked="checked" value="no">
                          {{ trans('misc.no') }}
                        </label>
                      </div>

                    </div><!-- /.form-group -->


                  <div class="form-group">
                      <label>{{ trans('admin.description') }} ({{ trans('misc.optional') }})</label>
                      	<textarea name="description" rows="4" id="description" class="form-control" placeholder="{{ trans('admin.description') }}">{{ old('description') }}</textarea>
                    </div>

                    <!-- Alert -->
                    <div class="alert alert-danger display-none" id="dangerAlert">
							<ul class="list-unstyled" id="showErrors"></ul>
						</div><!-- Alert -->

                  <div class="box-footer text-center">
                  	<hr />
                    <button type="submit" id="upload" class="btn btn-lg btn-success custom-rounded" data-error="{{trans('misc.error')}}" data-msg-error="{{trans('misc.err_internet_disconnected')}}">
                      <i class="fa fa-cloud-upload myicon-right"></i> {{ trans('users.upload') }}
                    </button>
                  </div><!-- /.box-footer -->
                </form>

         	</div>
         </div>

         </div><!-- wrap-center -->

		</div>
		<!-- col-md-12-->

		@else

		<div class="btn-block text-center margin-top-40">
	    			<i class="icon-warning ico-no-result"></i>
	    		</div>

		<h3 class="margin-top-none text-center no-result no-result-mg">
	    		{{trans('misc.limit_uploads_user')}}
	    	</h3>

		@endif


@else
    <div class="btn-block text-center margin-top-40">
  	    			<i class="icon-warning ico-no-result"></i>
  	    		</div>

  	   <h3 class="margin-top-none text-center no-result no-result-mg">
  	    	{{trans('misc.confirm_email')}} <strong>{{Auth::user()->email}}</strong>
  	    	</h3>
          @endif
          {{-- Verify User Active --}}

	</div><!-- row -->
</div><!-- container -->

@endsection

@section('javascript')

<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script>-->
<!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css"></script>-->
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.css"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.js"></script>
<script src="https://wmlgl.github.io/cropperjs-gif/dist/cropperjs-gif-all.js"></script>


<script src="{{ asset('public/plugins/iCheck/icheck.min.js') }}" type="text/javascript"></script>
	<script src="{{ asset('public/plugins/tagsinput/jquery.tagsinput.min.js') }}" type="text/javascript"></script>

<script>
        /* Crop Modal Window */
        var $modal = $('#modal');
        var image = document.getElementById('image');
        var cropper;
        $("body").on("change", ".image", function(e){
                var files = e.target.files;
                var done = function (url) { console.log(image.width); console.log(image.height);
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
                } 
                else if (FileReader) {
                    reader = new FileReader();
                    reader.onload = function (e) {
                        done(reader.result);
                    };
                reader.readAsDataURL(file);
                }
            }
        });
        
        /* Get Selected image size */
        //var _URL = window.URL || window.webkitURL;
        var imgWidth, imgHeight;
        $("#uploadPhoto").change(function(e) {
            var file, img;
        
        
            if ((file = this.files[0])) {
                img = new Image();
                img.onload = function() {
                    //alert(this.width + " " + this.height);
                    imgWidth = this.width;
                    imgHeight = this.height;
                };
                /*img.onerror = function() {
                    alert( "not a valid file: " + file.type);
                };
                img.src = _URL.createObjectURL(file);*/
        
        
            }
        
        });
        /* Get Selected image size */
        
        
        $modal.on('shown.bs.modal', function () {
        cropper = new Cropper(image, {
            aspectRatio: imgWidth/imgHeight,
            viewMode: 1,
            preview: '.preview',
            rotatable:true
        });
        }).on('hidden.bs.modal', function () {
        cropper.destroy();
        cropper = null;
        });

        $("#rotate").click(function(){
            cropper.rotate(90);
            //cropper.move(1, -1).rotate(45).scale(1, -1);
        });

function cropGif(){
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
                onerror: function(code, error){
                    console.log(code, error)
                }
            },
            cropper,
            function(blob){
                previewImg.src = URL.createObjectURL(blob);

                // test send blob
                var xhr = new XMLHttpRequest();
                xhr.open('POST', "/post/test");
                xhr.onprogress = function(e){
                    tmp.innerText = "upload progress: " + e.loaded;
                };
                xhr.onreadystatechange = function(e){
                    tmp.innerText = "upload status: " + xhr.status + ", " + xhr.readyState;
                }
                if(blob.slice) {
                    xhr.send(blob.slice(0, 10))
                } else {
                    var fileReader = new FileReader();
                    fileReader.onload = function(event) {
                        xhr.send(event.target.result)
                    };
                    fileReader.readAsArrayBuffer(blob);
                }
            });
        }
$("#crop").click(function(){
// $('#modal .preview img').attr('src');
canvas = cropper.getCroppedCanvas({
/*width: 160,
height: 160,*/

width: 800,
height: 800,

});
canvas.toBlob(function(blob) {
url = URL.createObjectURL(blob);
var reader = new FileReader();
var myBlob;
var xhr = new XMLHttpRequest();
xhr.open('GET', $('#modal .preview img').attr('src'), true);
xhr.responseType = 'blob';
xhr.onload = function(e) {
  if (this.status == 200) {
    myBlob = this.response;
    console.log(myBlob);
    reader.readAsDataURL(myBlob); 
    reader.onloadend = function() {
    console.log(reader);
    var base64data = reader.result; 
    // console.log(base64data); 
    $modal.modal('hide');
    alert("Image Cropped Successfully!");
    
    //$("#base64data").val(base64data);
    $("#baseTxtImg").val(base64data);
    $("#output").attr("src",base64data);
    
    
    /*$.ajax({
    type: "POST",
    dataType: "json",
    url: "image",
    data: {'_token': $('meta[name="_token"]').attr('content'), 'image': base64data},
    success: function(data){
    console.log(data);
    //$modal.modal('hide');
    //alert("Crop image successfully uploaded");
    }
    });*/
    }
  }
};
xhr.send();
});
})
/* Crop Modal Window  */

/* Tags Input */
$("#tagInput").tagsInput({

    'delimiter': [','],   // Or a string with a single delimiter. Ex: ';'
    'width':'auto',
    'height':'auto',
      'removeWithBackspace' : true,
      'minChars' : 3,
      'maxChars' : 25,
      'defaultText':'{{ trans("misc.add_tag") }}',
      onChange: function() {
          var input = $(this).siblings('.tagsinput');
          var maxLen = {{$settings->tags_limit}};
    
      if( input.children('span.tag').length >= maxLen){
              input.children('div').hide();
          }
          else{
              input.children('div').show();
          }
      },
});
/* Tags Input */

//Flat red color scheme for iCheck
$('input[type="radio"]').iCheck({
  radioClass: 'iradio_flat-red'
});

function replaceString(string) {
  return string.replace(/[\-\_\.\+]/ig,' ')
}


    $('#itemForSale').on('change', function(){
        if($(this).val() == 'sale') {
            $('#priceBox').slideDown();
            $('.options_free').slideUp();
    
        } 
        else {
            $('#priceBox').slideUp();
            $('.options_free').slideDown();
        }
    });
    
    $('#typeImage').on('change', function(){
      if($(this).val() == 'vector') {
        $('#vector').slideDown();

        /*$('#imageSpan').slideUp('fast');
        $('#uploadPhoto').val('');
        $('#baseTxtImg').val('');
        $('#output').attr('src', '');
        $('#fileDocument').html('Testing by developer');*/

      } else {
          /*$('#imageSpan').slideDown();*/

          $('#vector').slideUp('fast');
          $('#uploadFile').val('');
          //$('#fileDocument').html('');
      }
    });
    
    /*$('#typeImage').on('change', function(){
      if($(this).val() == 'vector') {
        $('#vector').slideDown();
      } else {
          $('#vector').slideUp('fast');
          $('#uploadFile').val('');
          $('#fileDocument').html('');
      }
    });*/



    $(".onlyNumber").keydown(function (e) {
      // Allow: backspace, delete, tab, escape, enter and .
      if ($.inArray(e.keyCode, [46, 8, 9, 27, 13]) !== -1 ||
          // Allow: Ctrl+A, Command+A
          (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) ||
          // Allow: home, end, left, right, down, up
          (e.keyCode >= 35 && e.keyCode <= 40)) {
              // let it happen, don't do anything
              return;
      }
      // Ensure that it is a number and stop the keypress
      if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
          e.preventDefault();
      }
    });

    
    $("#categoryId").change(function(){
      var catid = $(this).val();
      const baseUrl = '<?php echo url("/"); ?>';
      $.ajax({
        url: baseUrl + '/get-subCat-by-category/' + catid,
        type: 'GET',
        dataType: 'json',
        success:function(res){
            $("#subCategoryId").empty();
          var option = "";
          $.each( res, function( key, value ) {
            // alert(value.id);
            option +='<option value="'+ value.id +'">'+ value.name +'</option>';
          });
          $("#subCategoryId").append(option);
          $("#subCategoryDiv").show();
        },
        error:function(){
          console.log('error on function getting sub category by category');
        }
      });
    });

    $('#price').on('keyup', function() {

      var valueOriginal = $('.onlyNumber').val();
      var value = parseFloat($('.onlyNumber').val());
      var element = $(this).val();

      if (element != '') {

        if (valueOriginal >= {{$settings->min_sale_amount}} && valueOriginal <= {{$settings->max_sale_amount}}) {
          var amountSmall = value;
        } else {
          amountSmall = 0;
        }
          var amountMedium = (amountSmall * 2);
          var amountLarge = (amountSmall * 3);
          var amountVector = (amountSmall * 4);


          $('#s-price').html(amountSmall);
          $('#m-price').html(amountMedium);
          $('#l-price').html(amountLarge);
          $('#v-price').html(amountVector);

      }

      if (valueOriginal == '') {
        $('#s-price').html('0');
        $('#m-price').html('0');
        $('#l-price').html('0');
        $('#v-price').html('0');
      }
    });


/* Image Preveiw */
/*var loadFile = function(event) {
    var image = document.getElementById('output');
    image.src = URL.createObjectURL(event.target.files[0]);

};*/
/* Image Preview */




</script>

@endsection