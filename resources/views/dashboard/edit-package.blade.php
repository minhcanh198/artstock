@extends('dashboard.layout')

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
            		{{{ 'Photo Package' }}}
            			<i class="fa fa-angle-right margin-separator"></i> 
            				{{{ trans('admin.edit') }}}
          </h4>

        </section>

        <!-- Main content -->
        <section class="content">

        	<div class="content">
        		
        		<div class="row">
    
        	<div class="box box-header">
                <div class="box-header with-border">
                  <h3 class="box-title">{{{ trans('admin.edit') }}}</h3>
                </div><!-- /.box-header -->
               
               
               
                <!-- form start -->
                <form class="form-horizontal" method="post" action="{{{ url('user/dashboard/packages/photographer-package/update') }}}" enctype="multipart/form-data">
                	
                	<input type="hidden" name="_token" value="{{{ csrf_token() }}}">	
                	<input type="hidden" name="id" value="{{{ $package->id }}}">	
			
          @include('errors.errors-forms')
          
                  <!-- Start Box Body -->
                  <div class="box-body">
                    <div class="form-group">
                      <label class="col-sm-2 control-label">{{{ 'Hours OR Minutes ? ' }}}</label>
                      <div class="col-sm-10">
                        <select name="hoursOrMinutes" class="form-control" id="hoursOrMinutes" >
                          <option value="">Select </option>
                          <option {{ ($package->hours != "") ? 'selected' : '' }} value="hours">Hours</option>
                          <option {{ ($package->minutes != "") ? 'selected' : '' }} value="minutes">Minutes</option>
                        </select>
                      </div>
                    </div>
                  </div><!-- /.box-body -->
                  
                  
                 <!-- Start Box Body -->
                  <div class="box-body" id="divHours" style="<?php echo ($package->hours != '') ? 'display:block' : 'display:none'; ?>">
                    <div class="form-group">
                      <label class="col-sm-2 control-label">{{ 'Hours' }}</label>
                      <div class="col-sm-10">
                        <input type="text" value="{{{ $package->hours }}}" id="txtHours" name="hours" class="form-control" placeholder="{{ 'Hours' }}">
                      </div>
                    </div>
                  </div><!-- /.box-body -->

                  
                  <!-- Start Box Body -->
                  <div class="box-body" id="divMinutes" style="<?php echo ($package->minutes != '') ? 'display:block' : 'display:none'; ?>">
                    <div class="form-group">
                      <label class="col-sm-2 control-label">{{ 'Minutes' }}</label>
                      <div class="col-sm-10">
                        <input type="text" value="{{{ $package->minutes }}}" id="txtMinutes" name="minutes" class="form-control" placeholder="{{ 'Minutes' }}">
                      </div>
                    </div>
                  </div><!-- /.box-body -->
                  

                 <!-- Start Box Body -->
                  <div class="box-body">
                    <div class="form-group">
                      <label class="col-sm-2 control-label">{{ 'Price' }}</label>
                      <div class="col-sm-10">
                        <input type="text" value="{{{ $package->price }}}" name="price" class="form-control" placeholder="{{ 'Price' }}">
                      </div>
                    </div>
                  </div><!-- /.box-body -->

                 <!-- Start Box Body -->
                  <div class="box-body">
                    <div class="form-group">
                      <label class="col-sm-2 control-label">{{ 'Number of Photos' }}</label>
                      <div class="col-sm-10">
                        <input type="text" value="{{{ $package->number_of_photos }}}" name="number_of_photos" class="form-control" placeholder="{{ 'Number of Photos' }}">
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
                          <input type="radio" name="mode" value="on" @if( $package->mode == 'on' ) checked @endif>
                          {{{ trans('admin.active') }}}
                        </label>
                      </div>
                      
                      <div class="radio">
                        <label class="padding-zero">
                          <input type="radio" @if(  $package->id == 1 ) disabled="disabled" @endif name="mode" value="off" @if( $package->mode == 'off' ) checked @endif>
                          {{{ trans('admin.disabled') }}}
                        </label>
                      </div>
                      
                      </div>
                    </div>
                  </div><!-- /.box-body -->   
                  
                  <div class="box-footer">
                    <a href="{{{ url('user/dashboard/packages/photographer-package') }}}" class="btn btn-default">{{{ trans('admin.cancel') }}}</a>
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
	
	<!-- Morris -->
	<script src="{{{ asset('public/plugins/iCheck/icheck.min.js') }}}" type="text/javascript"></script>
	
  <script type="text/javascript">
  
  $("#hoursOrMinutes").change(function(){
        let getValue = $(this).val();
        if(getValue == "hours"){

          $("#txtMinutes").val('');
          $("#txtMinutes").hide();
          $("#divMinutes").hide();
          $("#txtHours").show();
          $("#divHours").show();
        }else if(getValue == "minutes"){
          $("#txtHours").val('');
          $("#txtHours").hide();
          $("#divHours").hide();
          $("#txtMinutes").show();
          $("#divMinutes").show();
        }else{
          $("#txtHours").val('');
          $("#txtMinutes").val('');
          $("#txtHours").hide();
          $("#txtMinutes").hide();
          $("#divHours").hide();
          $("#divMinutes").hide();
        }
      });
  


		//Flat red color scheme for iCheck
        $('input[type="radio"]').iCheck({
          radioClass: 'iradio_flat-red'
        });
	</script>
	

@endsection
