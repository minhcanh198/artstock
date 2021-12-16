@extends('admin.layout')

@section('css')
<link href="{{ asset('public/plugins/iCheck/all.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('public/plugins/tagsinput/jquery.tagsinput.min.css') }}" rel="stylesheet" type="text/css" />
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
                    License Page Settings

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
                  <h3 class="box-title">License Page Settings</h3>
                </div><!-- /.box-header -->

                <!-- form start -->
                <form class="form-horizontal" method="POST" action="{{ url('panel/admin/license-page-settings') }}" enctype="multipart/form-data">

                	<input type="hidden" name="_token" value="{{ csrf_token() }}">

					@include('errors.errors-forms')

                 <!-- Start Box Body -->
                  <div class="box-body">
                    <div class="form-group">
                      <!-- <label class="col-sm-2 control-label">{{ trans('admin.name_site') }}</label> -->
                      <label class="col-sm-2 control-label">Header Heading</label>
                      <div class="col-sm-10">
                        <input type="text" value="{{ $licensePageSettings->header_heading }}" name="header_heading" class="form-control" placeholder="Header Heading">
                      </div>
                    </div>
                  </div><!-- /.box-body -->  

                  <!-- Start Box Body --> 
                  <div class="box-body">
                    <div class="form-group">
                      <!-- <label class="col-sm-2 control-label">{{ trans('admin.name_site') }}</label> -->
                      <label class="col-sm-2 control-label">Header Description</label>
                      <div class="col-sm-10">
                        <textarea name="header_description" class="form-control" placeholder="Header Description">{{ $licensePageSettings->header_description }}</textarea>
                      </div>
                    </div>
                  </div><!-- /.box-body -->   

                   <!-- Start Box Body -->
                  <div class="box-body">
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Header Main Image</label>
                      <div class="col-sm-10">

                        <div class="btn-block margin-bottom-10">
                        @if($licensePageSettings->header_main_image != null)
                          <img src="{{url('/public/license_page/header_assets/').'/'. $licensePageSettings->header_main_image }}" style="width:200px">
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
                   <!-- <div class="box-body">
                    <div class="form-group">
                      <label class="col-sm-2 control-label">{{ trans('admin.content') }}</label>
                      <div class="col-sm-10">
                      	
{{--                      	<textarea name="content"rows="5" cols="40" id="content" class="form-control" placeholder="{{ trans('admin.content') }}">{{ $licensePageSettings->content }}</textarea> --}}
                      </div>
                    </div>
                  </div> -->
                  <!-- /.box-body -->

                  <!-- Start Box Body -->

                  <div class="box-body">
                    <div class="form-group">
                      <!-- <label class="col-sm-2 control-label">{{ trans('admin.name_site') }}</label> -->
                      <label class="col-sm-2 control-label">Section 1 Header</label>
                      <div class="col-sm-10">
                        <input type="text" value="{{ $licensePageSettings->section_1_heading }}" name="section_1_heading" class="form-control" placeholder="Section 1 Header">
                      </div>
                    </div>
                  </div><!-- /.box-body -->  

                  <!-- Start Box Body -->
                  <div class="box-body">
                    <div class="form-group">
                      <!-- <label class="col-sm-2 control-label">{{ trans('admin.name_site') }}</label> -->
                      <label class="col-sm-2 control-label">Section 1 Description</label>
                      <div class="col-sm-10">
                      <input type="text" id="section_1_description" class="form-control" name="section_1_description" placeholder="Section 1 Description" value="{{ $licensePageSettings->section_1_description }}">
                        <!-- <textarea name="section_1_description" class="form-control" placeholder="Section 1 Description">{{ $licensePageSettings->section_1_description }}</textarea> -->
                      </div>
                    </div>
                  </div><!-- /.box-body -->   

                  <!-- Start Box Body -->
                  <div class="box-body">
                    <div class="form-group">
                      <!-- <label class="col-sm-2 control-label">{{ trans('admin.name_site') }}</label> -->
                      <label class="col-sm-2 control-label">Section 1 Content</label>
                      <div class="col-sm-10">
                      <textarea id="basic-example" name="section_1_content" placeholder="Section 1 Content">{{ $licensePageSettings->section_1_content }}</textarea>
                        {{-- <!-- <textarea name="section_1_content" class="form-control" placeholder="Section 1 Content">{{ $licensePageSettings->section_1_content }}</textarea> -->--}}
                      </div>
                    </div>
                  </div><!-- /.box-body -->

                  <!-- Start Box Body -->

                  <div class="box-body">
                    <div class="form-group">
                      <!-- <label class="col-sm-2 control-label">{{ trans('admin.name_site') }}</label> -->
                      <label class="col-sm-2 control-label">Section 2 Header</label>
                      <div class="col-sm-10">
                        <input type="text" value="{{ $licensePageSettings->section_2_heading }}" name="section_2_heading" class="form-control" placeholder="Section Header 2">
                      </div>
                    </div>
                  </div><!-- /.box-body -->  

                  <!-- Start Box Body -->
                  <div class="box-body">
                    <div class="form-group">
                      <!-- <label class="col-sm-2 control-label">{{ trans('admin.name_site') }}</label> -->
                      <label class="col-sm-2 control-label">Section 2 Description</label>
                      <div class="col-sm-10">
                        <input type="text" id="section_2_description" class="form-control" name="section_2_description" placeholder="Section 2 Description" value="{{ $licensePageSettings->section_2_description }}">
                        <!-- <textarea name="section_2_description" class="form-control" placeholder="Section 2 Description">{{ $licensePageSettings->section_2_description }}</textarea> -->
                      </div>
                    </div>
                  </div><!-- /.box-body --> 


                  <!-- Start Box Body -->
                  <div class="box-body">
                    <div class="form-group">
                      <!-- <label class="col-sm-2 control-label">{{ trans('admin.name_site') }}</label> -->
                      <label class="col-sm-2 control-label">Content 1 Header</label>
                      <div class="col-sm-10">
                        <input type="text" value="{{ $licensePageSettings->section_2_content_1_header }}" name="section_2_content_1_header" class="form-control" placeholder="Content 1 Heading">
                      </div>
                    </div>
                  </div><!-- /.box-body -->  

                  <!-- Start Box Body -->
                  <div class="box-body">
                    <div class="form-group">
                      <!-- <label class="col-sm-2 control-label">{{ trans('admin.name_site') }}</label> -->
                      <label class="col-sm-2 control-label">Content 1 Description</label>
                      <div class="col-sm-10">
                      <input type="text" id="section_2_content_1_description" name="section_2_content_1_description" class="form-control" placeholder="Content 1 Description" value="{{ $licensePageSettings->section_2_content_1_description }}">
                        <!-- <textarea name="section_2_content_1_description" class="form-control" placeholder="Content 1 Description">{{ $licensePageSettings->section_2_content_1_description }}</textarea> -->
                      </div>
                    </div>
                  </div><!-- /.box-body -->   

                   <!-- Start Box Body -->
                  <div class="box-body">
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Content 1 Image</label>
                      <div class="col-sm-10">

                        <div class="btn-block margin-bottom-10">
                        @if($licensePageSettings->section_2_content_1_image != null)
                          <img src="{{url('/public/license_page/section_2_content/').'/'. $licensePageSettings->section_2_content_1_image }}" style="width:200px">
                        @endif
                        </div>

                      	<div class="btn btn-info box-file">
                      		<input type="file" accept="image/*" name="section_2_content_1_image" class="filePhoto" />
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
                      <label class="col-sm-2 control-label">Content 2 Header</label>
                      <div class="col-sm-10">
                        <input type="text" value="{{ $licensePageSettings->section_2_content_2_header }}" name="section_2_content_2_header" class="form-control" placeholder="Content 2 Heading">
                      </div>
                    </div>
                  </div><!-- /.box-body -->  

                  <!-- Start Box Body -->
                  <div class="box-body">
                    <div class="form-group">
                      <!-- <label class="col-sm-2 control-label">{{ trans('admin.name_site') }}</label> -->
                      <label class="col-sm-2 control-label">Content 2 Description</label>
                      <div class="col-sm-10">
                      <input type="text" id="section_2_content_2_description" name="section_2_content_2_description" class="form-control" placeholder="Content 2 Description" value="{{ $licensePageSettings->section_2_content_2_description }}">
                        <!-- <textarea name="section_2_content_1_description" class="form-control" placeholder="Content 1 Description">{{ $licensePageSettings->section_2_content_1_description }}</textarea> -->
                      </div>
                    </div>
                  </div><!-- /.box-body -->   

                   <!-- Start Box Body -->
                  <div class="box-body">
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Content 2 Image</label>
                      <div class="col-sm-10">

                        <div class="btn-block margin-bottom-10">
                        @if($licensePageSettings->section_2_content_2_image != null)
                          <img src="{{url('/public/license_page/section_2_content/').'/'. $licensePageSettings->section_2_content_2_image }}" style="width:200px">
                        @endif
                        </div>

                      	<div class="btn btn-info box-file">
                      		<input type="file" accept="image/*" name="section_2_content_2_image" class="filePhoto" />
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
                      <label class="col-sm-2 control-label">Content 3 Header</label>
                      <div class="col-sm-10">
                        <input type="text" value="{{ $licensePageSettings->section_2_content_3_header }}" name="section_2_content_3_header" class="form-control" placeholder="Content 3 Heading">
                      </div>
                    </div>
                  </div><!-- /.box-body -->  

                  <!-- Start Box Body -->
                  <div class="box-body">
                    <div class="form-group">
                      <!-- <label class="col-sm-2 control-label">{{ trans('admin.name_site') }}</label> -->
                      <label class="col-sm-2 control-label">Content 3 Description</label>
                      <div class="col-sm-10">
                      <input type="text" id="section_2_content_3_description" name="section_2_content_3_description" class="form-control" placeholder="Content 3 Description" value="{{ $licensePageSettings->section_2_content_3_description }}">
                        <!-- <textarea name="section_2_content_1_description" class="form-control" placeholder="Content 1 Description">{{ $licensePageSettings->section_2_content_1_description }}</textarea> -->
                      </div>
                    </div>
                  </div><!-- /.box-body -->   

                   <!-- Start Box Body -->
                  <div class="box-body">
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Content 3 Image</label>
                      <div class="col-sm-10">

                        <div class="btn-block margin-bottom-10">
                        @if($licensePageSettings->section_2_content_3_image != null)
                          <img src="{{url('/public/license_page/section_2_content/').'/'. $licensePageSettings->section_2_content_3_image }}" style="width:200px">
                        @endif
                        </div>

                      	<div class="btn btn-info box-file">
                      		<input type="file" accept="image/*" name="section_2_content_3_image" class="filePhoto" />
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
                      <label class="col-sm-2 control-label">Content 4 Header</label>
                      <div class="col-sm-10">
                        <input type="text" value="{{ $licensePageSettings->section_2_content_4_header }}" name="section_2_content_4_header" class="form-control" placeholder="Content 4 Heading">
                      </div>
                    </div>
                  </div><!-- /.box-body -->  

                  <!-- Start Box Body -->
                  <div class="box-body">
                    <div class="form-group">
                      <!-- <label class="col-sm-2 control-label">{{ trans('admin.name_site') }}</label> -->
                      <label class="col-sm-2 control-label">Content 4 Description</label>
                      <div class="col-sm-10">
                      <input type="text" id="section_2_content_4_description" name="section_2_content_4_description" class="form-control" placeholder="Content 4 Description" value="{{ $licensePageSettings->section_2_content_4_description }}">
                        <!-- <textarea name="section_2_content_1_description" class="form-control" placeholder="Content 1 Description">{{ $licensePageSettings->section_2_content_1_description }}</textarea> -->
                      </div>
                    </div>
                  </div><!-- /.box-body -->   

                   <!-- Start Box Body -->
                  <div class="box-body">
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Content 4 Image</label>
                      <div class="col-sm-10">

                        <div class="btn-block margin-bottom-10">
                        @if($licensePageSettings->section_2_content_4_image != null)
                          <img src="{{url('/public/license_page/section_2_content/').'/'. $licensePageSettings->section_2_content_4_image }}" style="width:200px">
                        @endif
                        </div>

                      	<div class="btn btn-info box-file">
                      		<input type="file" accept="image/*" name="section_2_content_4_image" class="filePhoto" />
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
                      <label class="col-sm-2 control-label">Section 3 Header</label>
                      <div class="col-sm-10">
                        <input type="text" value="{{ $licensePageSettings->section_3_heading }}" name="section_3_heading" class="form-control" placeholder="Section Header 3">
                      </div>
                    </div>
                  </div><!-- /.box-body -->  

                  <!-- Start Box Body -->
                  <div class="box-body">
                    <div class="form-group">
                      <!-- <label class="col-sm-2 control-label">{{ trans('admin.name_site') }}</label> -->
                      <label class="col-sm-2 control-label">Section 3 Description</label>
                      <div class="col-sm-10">
                      <input type="text" id="section_3_description" class="form-control" name="section_3_description" placeholder="Section 3 Description" value="{{ $licensePageSettings->section_3_description }}">
                        <!-- <textarea name="section_description_3" class="form-control" placeholder="Section 3 Description">{{ $licensePageSettings->section_3_description }}</textarea> -->
                      </div>
                    </div>
                  </div><!-- /.box-body -->   

                  <!-- Start Box Body -->
                  <div class="box-body">
                    <div class="form-group">
                      <!-- <label class="col-sm-2 control-label">{{ trans('admin.name_site') }}</label> -->
                      <label class="col-sm-2 control-label">Section 3 Content</label>
                      <div class="col-sm-10">
                      <textarea id="basic-example" name="section_3_content" placeholder="Section 3 Content">{{ $licensePageSettings->section_3_content }}</textarea>
                        <!-- <textarea name="section_3_content" class="form-control" placeholder="Section 3 Content">{{ $licensePageSettings->section_3_content }}</textarea> -->
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
	<script src="{{ asset('public/plugins/iCheck/icheck.min.js') }}" type="text/javascript"></script>
	<script src="{{ asset('public/plugins/tagsinput/jquery.tagsinput.min.js') }}" type="text/javascript"></script>

    <script src="{{{ asset('public/plugins/ckeditor/ckeditor.js') }}}" type="text/javascript"></script>

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
  <script>
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

    </script>


@endsection

