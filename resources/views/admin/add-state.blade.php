@extends('admin.layout')

@section('css')
<link href="{{{ asset('public/plugins/iCheck/all.css') }}}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h4>
            {{{ trans('admin.admin') }}} 
            	<i class="fa fa-angle-right margin-separator"></i> 
            		{{{ 'Country' }}}
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
                <form class="form-horizontal" method="post" action="{{{ url('panel/admin/destinations/states/add') }}}" enctype="multipart/form-data">
                	
                	<input type="hidden" name="_token" value="{{{ csrf_token() }}}">	
			
					@include('errors.errors-forms')
									
                    <!-- Start Box Body -->
                    <div class="box-body">
                        <div class="form-group">
                        <label class="col-sm-2 control-label">{{{ 'State Name' }}}</label>
                        <div class="col-sm-10">
                            <input type="text" value="{{{ old('state_name') }}}" name="state_name" class="form-control" placeholder="{{{ 'State Name' }}}">
                        </div>
                        </div>
                    </div><!-- /.box-body -->

                    <!-- Start Box Body -->
                    <div class="box-body">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">{{ 'Country' }}</label>
                            <div class="col-sm-10">
                            <select name="country_id" class="form-control">
                                <option value="">Select Country</option>
                                @foreach($countryData as $data)
                                    <option value="{{ $data->id }}">{{ $data->country_name }}</option>
                                @endforeach
                                </select>
                            </div>
                        </div>
                    </div><!-- /.box-body -->
                  
                  <div class="box-footer">
                    <a href="{{{ url('panel/admin/destinations/states') }}}" class="btn btn-default">{{{ trans('admin.cancel') }}}</a>
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
	<script src="{{{ asset('public/plugins/iCheck/icheck.min.js') }}}" type="text/javascript"></script>
	
	<script type="text/javascript">
		//Flat red color scheme for iCheck
        $('input[type="radio"]').iCheck({
          radioClass: 'iradio_flat-red'
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
