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
                    Use Guide Page Settings

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
                  <h3 class="box-title">Use Guide Page Settings</h3>
                </div><!-- /.box-header -->

                <!-- form start -->
                <form class="form-horizontal" method="POST" action="{{ url('panel/admin/use-guide-page-settings') }}" enctype="multipart/form-data">

                	<input type="hidden" name="_token" value="{{ csrf_token() }}">

					@include('errors.errors-forms')

                 <!-- Start Box Body -->
                  <div class="box-body">
                    <div class="form-group">
                      <!-- <label class="col-sm-2 control-label">{{ trans('admin.name_site') }}</label> -->
                      <label class="col-sm-2 control-label">Header Heading</label>
                      <div class="col-sm-10">
                        <input type="text" value="{{ $useGuidePageSettings->header_heading }}" name="header_heading" class="form-control" placeholder="Header Heading">
                      </div>
                    </div>
                  </div><!-- /.box-body -->

                  <!-- Start Box Body -->
                  <div class="box-body">
                    <div class="form-group">
                      <!-- <label class="col-sm-2 control-label">{{ trans('admin.name_site') }}</label> -->
                      <label class="col-sm-2 control-label">Header Description</label>
                      <div class="col-sm-10">
                        <textarea name="header_description" class="form-control" placeholder="Header Description">{{ $useGuidePageSettings->header_description }}</textarea>
                      </div>
                    </div>
                  </div><!-- /.box-body -->

                   <!-- Start Box Body -->
                  <div class="box-body">
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Header Main Image</label>
                      <div class="col-sm-10">

                        <div class="btn-block margin-bottom-10">
                        @if($useGuidePageSettings->header_main_image != null)
                          <img src="{{url('/use_guide_page/header_assets/').'/'. $useGuidePageSettings->header_main_image }}" style="width:200px">
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
                      <!-- <label class="col-sm-2 control-label">{{ trans('admin.name_site') }}</label> -->
                      <label class="col-sm-2 control-label">Section Header</label>
                      <div class="col-sm-10">
                        <input type="text" value="{{ $useGuidePageSettings->section_header }}" name="section_header" class="form-control" placeholder="Section Header">
                      </div>
                    </div>
                  </div><!-- /.box-body -->

                  <!-- Start Box Body -->
                  <div class="box-body">
                    <div class="form-group">
                      <!-- <label class="col-sm-2 control-label">{{ trans('admin.name_site') }}</label> -->
                      <label class="col-sm-2 control-label">Section Description</label>
                      <div class="col-sm-10">
                        <textarea name="section_description" class="form-control" placeholder="Section Description">{{ $useGuidePageSettings->section_description }}</textarea>
                      </div>
                    </div>
                  </div><!-- /.box-body -->

                  <!-- Start Box Body -->
                  <div class="box-body">
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Embed Code Youtube Video</label>
                      <div class="col-sm-10">
                        <textarea name="link_youtube_video" class="form-control" placeholder="Section Description">{{ $useGuidePageSettings->link_youtube_video }}</textarea>
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


@endsection

