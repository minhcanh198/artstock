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
            		{{{ 'Booking Calendar' }}}
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
                <form class="form-horizontal" method="post" action="{{{ url('panel/admin/booking-calendar') }}}" enctype="multipart/form-data">
                	
                	<input type="hidden" name="_token" value="{{{ csrf_token() }}}">	
			
					@include('errors.errors-forms')
									
                    <!-- Start Box Body -->
                    <div class="box-body">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">{{{ 'Calendar Header' }}}</label>
                            <div class="col-sm-10">
                                <input type="text" value="{{ $calendarPageSettings->calendar_question }}" name="calendar_question" class="form-control" placeholder="{{{ 'Calendar Question' }}}">
                            </div>
                        </div>
                    </div><!-- /.box-body -->
                    
                    <!-- Start Box Body -->
                    <div class="box-body">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">{{{ 'Calendar Content' }}}</label>
                            <div class="col-sm-10">
                                <input type="text" value="{{ $calendarPageSettings->calendar_paragraph }}" name="calendar_paragraph" class="form-control" placeholder="{{{ 'Calendar Paragraph' }}}">
                            </div>
                        </div>
                    </div><!-- /.box-body -->

                    <!-- Start Box Body -->
                    <div class="box-body">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">{{{ 'Calendar Important Note' }}}</label>
                            <div class="col-sm-10">
                                <textarea id="basic-example" name="calendar_important_note" placeholder="Important Note">{{ $calendarPageSettings->calendar_important_note }}</textarea>
                            </div>
                        </div>
                    </div><!-- /.box-body -->

                    <!-- Start Box Body -->
                    <div class="box-body">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">{{{ 'Calendar Last Minute Header' }}}</label>
                            <div class="col-sm-10">
                                <input type="text" value="{{ $calendarPageSettings->calendar_last_minute_header }}" name="calendar_last_minute_header" class="form-control" placeholder="{{{ 'Calendar Last Minute Header' }}}">
                            </div>
                        </div>
                    </div><!-- /.box-body -->

                    <!-- Start Box Body -->
                    <div class="box-body">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">{{{ 'Calendar Last Minute Content' }}}</label>
                            <div class="col-sm-10">
                                <input type="text" value="{{ $calendarPageSettings->calendar_last_minute_content }}" name="calendar_last_minute_content" class="form-control" placeholder="{{{ 'Calendar Last Minute Content' }}}">
                            </div>
                        </div>
                    </div><!-- /.box-body -->
                  
                    <div class="box-footer">
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
