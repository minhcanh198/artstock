@extends('admin.layout')

@section('css')
<link href="{{{ asset('plugins/iCheck/all.css') }}}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h4>
            {{{ trans('admin.admin') }}}
            	<i class="fa fa-angle-right margin-separator"></i>
            		{{{ 'Route' }}}
            			<i class="fa fa-angle-right margin-separator"></i>
            				{{{ trans('misc.add_new') }}}
          </h4>

        </section>

        <!-- Main content -->
        <section class="content">

        	<div class="content">

        		<div class="row">

        	<div class="box box-danger">
                <div class="box-header with-border">
                  <h3 class="box-title">{{{ trans('misc.add_new') }}}</h3>
                </div><!-- /.box-header -->



                <!-- form start -->
                <form class="form-horizontal" method="post" action="{{{ url('panel/admin/destinations/routes/add') }}}" enctype="multipart/form-data">

                	<input type="hidden" name="_token" value="{{{ csrf_token() }}}">

					@include('errors.errors-forms')

                 <!-- Start Box Body -->
                  <div class="box-body">
                    <div class="form-group">
                      <label class="col-sm-2 control-label">{{ 'Route Name' }}</label>
                      <div class="col-sm-10">
                        <input type="text" value="{{{ old('route_name') }}}" name="route_name" class="form-control" placeholder="{{ 'Route Name' }}">
                      </div>
                    </div>
                  </div><!-- /.box-body -->

                  <!-- Start Box Body -->
                  <div class="box-body">
                    <div class="form-group">
                      <label class="col-sm-2 control-label">{{ 'Route Tagline' }}</label>
                      <div class="col-sm-10">
                        <input type="text" value="{{{ old('route_tagline') }}}" name="route_tagline" class="form-control" placeholder="{{ 'Route Tagline' }}">
                      </div>
                    </div>
                  </div><!-- /.box-body -->

                    <!-- Start Box Body -->
                    <div class="box-body">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">{{ 'Country' }}</label>
                            <div class="col-sm-10">
                            <select name="country_id" id="country_id" class="form-control">
                                <option value="">Select Country</option>
                                @foreach($countryData as $data)
                                    <option value="{{ $data->id }}">{{ $data->country_name }}</option>
                                @endforeach
                                </select>
                            </div>
                        </div>
                    </div><!-- /.box-body -->

                    <!-- Start Box Body -->
                    <div class="box-body">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">{{ 'State' }}</label>
                            <div class="col-sm-10">
                                <select name="state_id" id="state_id" class="form-control">
                                    <option value="">Select State</option>
                                   {{-- @foreach($stateData as $data)
                                        <option value="{{ $data->id }}">{{ $data->state_name }}</option>
                                    @endforeach --}}
                                </select>
                            </div>
                        </div>
                    </div><!-- /.box-body -->

                    <!-- Start Box Body -->
                    <div class="box-body">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">{{ 'City' }}</label>
                            <div class="col-sm-10">
                                <select name="city_id" id="city_id" class="form-control">
                                    <option value="">Select City</option>
                                   {{-- @foreach($stateData as $data)
                                        <option value="{{ $data->id }}">{{ $data->state_name }}</option>
                                    @endforeach --}}
                                </select>
                            </div>
                        </div>
                    </div><!-- /.box-body -->

                     <!-- Start Box Body -->
                  <div class="box-body">
                    <div class="form-group">
                      <label class="col-sm-2 control-label">{{ "Route Description" }}</label>
                      <div class="col-sm-10">

                      	<textarea name="route_description" rows="5" cols="40" id="content" class="form-control" placeholder="{{ trans('admin.content') }}">{{{ old('description') }}}</textarea>
                      </div>
                    </div>
                  </div><!-- /.box-body -->

                  <!-- Start Box Body -->
                  <div class="box-body">
                    <div class="form-group">
                      <label class="col-sm-2 control-label">{{{ trans('admin.status') }}}</label>
                      <div class="col-sm-10">

                      	<div class="radio">
                        <label class="padding-zero">
                          <input type="radio" name="route_status" value="1" checked>
                          {{{ trans('admin.active') }}}
                        </label>
                      </div>

                      <div class="radio">
                        <label class="padding-zero">
                          <input type="radio" name="route_status" value="0">
                          {{{ trans('admin.disabled') }}}
                        </label>
                      </div>

                      </div>
                    </div>
                  </div><!-- /.box-body -->

                  <!-- Start Box Body -->
                  <div class="box-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">{{ 'Image' }}</label>
                        <div class="col-sm-10">

                            <!-- <div class="btn-block margin-bottom-10">
                                <img loading="lazy" src="{{url('/img_city/')}}" style="width:150px">
                            </div> -->

                            <div class="btn btn-info box-file">
                                <input type="file" accept="image/*" name="route_img" class="filePhoto"  />
                                <i class="glyphicon glyphicon-cloud-upload myicon-right"></i> {{ trans('misc.upload') }}
                            </div>

                            <!-- <p class="help-block">{{ trans('admin.thumbnail_desc') }}</p> -->

                            <div class="btn-default btn-lg btn-border btn-block pull-left text-left display-none fileContainer">
                                <i class="glyphicon glyphicon-paperclip myicon-right"></i>
                                <small class="myicon-right file-name-file"></small> <i class="icon-cancel-circle delete-attach-file-2 pull-right" title="{{ trans('misc.delete') }}"></i>
                            </div>
                        </div>
                    </div>
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                    <a href="{{{ url('panel/admin/destinations/routes') }}}" class="btn btn-default">{{{ trans('admin.cancel') }}}</a>
                    <button type="submit" class="btn btn-success pull-right">{{{ trans('admin.save') }}}</button>
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
	<script src="{{{ asset('plugins/iCheck/icheck.min.js') }}}" type="text/javascript"></script>

	<script type="text/javascript">
		//Flat red color scheme for iCheck
        $('input[type="radio"]').iCheck({
          radioClass: 'iradio_flat-red'
        });

        // $(function () {
	    // // Replace the <textarea id="editor1"> with a CKEditor
	    // // instance, using default configuration.
	    // 	CKEDITOR.replace('content');
	 	//  });

        $(document).ready(function(){
            $("#country_id").change(function(){
                var getId = $(this).val();
                const baseUrl = '<?php echo url('/') ?>';
                $.ajax({
                    url: baseUrl + '/panel/admin/destinations/get-states-by-country/' + getId,
                    type:'GET',
                    dataType:'json',
                    success:function(res){
                        console.log(res);
                        $("#state_id").empty();
                        var stateOption = "";
                        stateOption += "<option value='selected'>Select State</option>";
                        $.each( res, function( key, value ) {
                            stateOption +='<option value="'+ value.id +'">'+ value.state_name + '</option>';
                        });
                        $("#state_id").append(stateOption);
                    },error:function(){
                        alert('Error  While Getting State By Country Id ');
                    }
                });
            });

            $("#state_id").change(function(){
                var getId = $(this).val();
                $("#city_id").empty();
                var stateOption = "";
                if(getId != ""){
                    const baseUrl = '<?php echo url('/') ?>';
                    $.ajax({
                        url: baseUrl + '/panel/admin/destinations/get-cities-by-state/' + getId,
                        type:'GET',
                        dataType:'json',
                        success:function(res){
                            console.log(res);
                            $("#city_id").empty();
                            var cityOption = "";
                            cityOption += "<option value='selected'>Select City</option>";
                            $.each( res, function( key, value ) {
                                cityOption +='<option value="'+ value.id +'">'+ value.city_name + '</option>';
                            });
                            $("#city_id").append(cityOption);
                        },error:function(){
                            alert('Error  While Getting City By State Id ');
                        }
                    });
                }else{
                    var cityOption = "";
                    cityOption += "<option value='selected'>Select City</option>";
                    $("#city_id").append(cityOption);
                }
            });
        });

        $(".filePhoto").on('change', function(){

var element = $(this);

element.parents('.box-file').find('.text-file').html('{{trans('misc.choose_image')}}');

  var loaded = false;
  if(window.File && window.FileReader && window.FileList && window.Blob){
  // Check empty input filed
      if($(this).val()) {
console.log($(this).val());
          oFReader = new FileReader(), rFilter = /^(?:image\/gif|image\/ief|image\/jpeg|image\/jpeg|image\/jpeg|image\/png|image\/svg+xml|image\/svg|image)$/i;
          if($(this)[0].files.length === 0){return}

          var oFile = $(this)[0].files[0];
    var fsize = $(this)[0].files[0].size; //get file size
          var ftype = $(this)[0].files[0].type; // get file type

    // Validate formats
    if(!rFilter.test(oFile.type) && oFile.type != 'image/svg+xml') {
              element.val('');
              alert("{{ trans('misc.formats_available') }}");
              return false;
          }

    // Validate Size
    // if(!rFilter.test(oFile.type)) {
          // 	element.val('');
          // 	alert("{{ trans('misc.formats_available') }}");
          // 	return false;
          // }

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
