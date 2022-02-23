@extends('admin.layout')

@section('css')
<link href="{{ asset('plugins/iCheck/all.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('plugins/tagsinput/jquery.tagsinput.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')

<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h4>
            {{ trans('admin.admin') }}
            	<i class="fa fa-angle-right margin-separator"></i>
            		<!-- {{ trans('admin.general_settings') }} -->
                    Destination Page Settings

          </h4>

        </section>

        <!-- Main content -->
        <section class="content">

        	 @if(Session::has('success_message'))
		    <div class="alert alert-success">
		    	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">×</span>
								</button>
		       <i class="fa fa-check margin-separator"></i> {{ Session::get('success_message') }}
		    </div>
		@endif

        	<div class="content">

        		<div class="row">

        	<div class="box box-danger">
                <div class="box-header with-border">
                  <!-- <h3 class="box-title">{{ trans('admin.general_settings') }}</h3> -->
                  <h3 class="box-title">Destination Page Settings</h3>
                </div><!-- /.box-header -->

                <!-- form start -->
                <form class="form-horizontal" method="POST" action="{{ url('panel/admin/destination-page-settings') }}" enctype="multipart/form-data">

                	<input type="hidden" name="_token" value="{{ csrf_token() }}">

					@include('errors.errors-forms')

                    <!-- Start Box Body -->
                    <div class="box-body">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Title</label>
                            <div class="col-sm-10">
                                <input type="text" name="title" id="title" class="form-control" value="{{ ($destinationPageSettings != null && $destinationPageSettings->title != '') ? $destinationPageSettings->title : '' }}">
                            </div>
                        </div>
                    </div><!-- /.box-body -->

                    <!-- Start Box Body -->
                    <div class="box-body">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Banner Heading</label>
                            <div class="col-sm-10">
                                <input type="text" name="header_heading" id="header_heading" class="form-control" value="{{ ($destinationPageSettings != null && $destinationPageSettings->header_heading != '') ? $destinationPageSettings->header_heading : '' }}">
                            </div>
                        </div>
                    </div><!-- /.box-body -->

                    <!-- Start Box Body -->
                    <div class="box-body">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Banner Description</label>
                            <div class="col-sm-10">
                                <input type="text" name="header_description" id="header_description" class="form-control" value="{{ ($destinationPageSettings != null && $destinationPageSettings->header_description != '') ? $destinationPageSettings->header_description : '' }}">
                            </div>
                        </div>
                    </div><!-- /.box-body -->

                    <!-- Start Box Body -->
                    <div class="box-body">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Header Main Image</label>
                            <div class="col-sm-10">
                                <div class="btn-block margin-bottom-10">
                                    @if($destinationPageSettings != null && $destinationPageSettings->header_main_image != null)
                                        <img src="{{url('/destination_page/assets/').'/'. $destinationPageSettings->header_main_image }}" style="width:200px">
                                    @endif
                                </div>
                                <div class="btn btn-info box-file">
                                    <input type="file" accept="image/*" name="header_main_image" class="filePhoto" />
                                    <i class="glyphicon glyphicon-cloud-upload myicon-right"></i>
                                    <span class="text-file">{{ trans('misc.choose_image') }}</span>
                                </div>
                                <p class="help-block">{{ trans('misc.recommended_size') }} 1280x850 px (JPG)</p>
                                <div class="btn-default btn-lg btn-border btn-block pull-left text-left display-none fileContainer">
                                    <i class="glyphicon glyphicon-paperclip myicon-right"></i>
                                    <small class="myicon-right file-name-file"></small> <i class="icon-cancel-circle delete-image btn pull-right" title="{{ trans('misc.delete') }}"></i>
                                </div>
                            </div>
                        </div>
                    </div><!-- /.box-body -->

                    <!-- Start Box Body -->
                    <div class="box-body">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">First Section Heading</label>
                            <div class="col-sm-10">
                                <input type="text" name="first_section_heading" id="first_section_heading" class="form-control" value="{{ ($destinationPageSettings != null && $destinationPageSettings->first_section_header != '') ? $destinationPageSettings->first_section_header : '' }}">
                            </div>
                        </div>
                    </div><!-- /.box-body -->

                    <!-- Start Box Body -->
                    <div class="box-body">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Second Section Heading</label>
                            <div class="col-sm-10">
                                <input type="text" name="second_section_heading" id="second_section_heading" class="form-control" value="{{ ($destinationPageSettings != null && $destinationPageSettings->second_section_header != '') ? $destinationPageSettings->second_section_header : '' }}">
                            </div>
                        </div>
                    </div><!-- /.box-body -->

                    <!-- Start Box Body -->
                    <div class="box-body">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Second Section Content</label>
                            <div class="col-sm-10">
                                <input type="text" name="second_section_content" id="second_section_content" class="form-control" value="{{ ($destinationPageSettings != null && $destinationPageSettings->second_section_content != '') ? $destinationPageSettings->second_section_content : '' }}">
                            </div>
                        </div>
                    </div><!-- /.box-body -->

                    <!-- Start Box Body -->
                    <div class="box-body">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Third Section Content</label>
                            <div class="col-sm-10">
                                <input type="text" name="third_section_content" id="third_section_content" class="form-control" value="{{ ($destinationPageSettings != null && $destinationPageSettings->third_section_content != '') ? $destinationPageSettings->third_section_content : '' }}">
                            </div>
                        </div>
                    </div><!-- /.box-body -->

                    <!-- Start Box Body -->
                    <div class="box-body">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Third Section Main Image</label>
                            <div class="col-sm-10">
                                <div class="btn-block margin-bottom-10">
                                    @if($destinationPageSettings != null && $destinationPageSettings->third_section_main_image != null)
                                        <img src="{{url('/destination_page/assets/').'/'. $destinationPageSettings->third_section_main_image }}" style="width:200px">
                                    @endif
                                </div>
                                <div class="btn btn-info box-file">
                                    <input type="file" accept="image/*" name="third_section_main_image" class="filePhoto" />
                                    <i class="glyphicon glyphicon-cloud-upload myicon-right"></i>
                                    <span class="text-file">{{ trans('misc.choose_image') }}</span>
                                </div>
                                <p class="help-block">{{ trans('misc.recommended_size') }} 1280x850 px (JPG)</p>
                                <div class="btn-default btn-lg btn-border btn-block pull-left text-left display-none fileContainer">
                                    <i class="glyphicon glyphicon-paperclip myicon-right"></i>
                                    <small class="myicon-right file-name-file"></small> <i class="icon-cancel-circle delete-image btn pull-right" title="{{ trans('misc.delete') }}"></i>
                                </div>
                            </div>
                        </div>
                    </div><!-- /.box-body -->

                    <!-- Start Box Body -->
                    <div class="box-body">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Third Section Button Text</label>
                            <div class="col-sm-10">
                                <input type="text" name="third_section_button_text" id="third_section_button_text" class="form-control" value="{{ ($destinationPageSettings != null && $destinationPageSettings->third_section_button_text != '') ? $destinationPageSettings->third_section_button_text : '' }}">
                            </div>
                        </div>
                    </div><!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" class="btn btn-success">{{ trans('admin.save') }}</button>
                    </div><!-- /.box-footer -->
                </form>
              </div>

        		</div><!-- /.row -->

        	</div><!-- /.content -->

          <!-- Your Page Content Here -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
@endsection

@section('javascript')

	<!-- icheck -->
	<script src="{{ asset('plugins/iCheck/icheck.min.js') }}" type="text/javascript"></script>
	<script src="{{ asset('plugins/tagsinput/jquery.tagsinput.min.js') }}" type="text/javascript"></script>

    <script src="{{{ asset('plugins/ckeditor/ckeditor.js') }}}" type="text/javascript"></script>

    <script type="text/javascript">
		$(function () {
	    // Replace the <textarea id="editor1"> with a CKEditor
	    // instance, using default configuration.
	    	CKEDITOR.replace('content');
	 	 });
	</script>

	<script type="text/javascript">
		//Flat red color scheme for iCheck
        $('input[type="radio"]').iCheck({
          radioClass: 'iradio_flat-red'
        });

        $("#tagInput").tagsInput({

		 'delimiter': [','],   // Or a string with a single delimiter. Ex: ';'
		 'width':'auto',
		 'height':'auto',
	     'removeWithBackspace' : true,
	     'minChars' : 3,
	     'maxChars' : 25,
	     'defaultText':'{{ trans("misc.add_tag") }}',
	     /*onChange: function() {
         	var input = $(this).siblings('.tagsinput');
         	var maxLen = 4;

			if( input.children('span.tag').length >= maxLen){
			        input.children('div').hide();
			    }
			    else{
			        input.children('div').show();
			    }
			},*/
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
  <!-- <script>
    tinymce.init({
      selector: 'textarea#basic-example',
      height: 500,
      menubar: false,
      plugins: [
        'advlist autolink lists link image charmap print preview anchor',
        'searchreplace visualblocks code fullscreen',
        'insertdatetime media table paste code help wordcount'
      ],
      toolbar: 'undo redo | formatselect | ' +
      'bold italic backcolor | alignleft aligncenter ' +
      'alignright alignjustify | bullist numlist outdent indent | ' +
      'removeformat | help',
      content_css: '//www.tiny.cloud/css/codepen.min.css'
    });

    </script> -->


@endsection

