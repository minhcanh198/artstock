@extends('dashboard.layout')

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
            		{{{ 'Animation Package' }}}
            			<i class="fa fa-angle-right margin-separator"></i>
            				{{{ trans('misc.add_new') }}}
          </h4>

        </section>

        <!-- Main content -->
        <section class="content">

        	<div class="content">

        		<div class="row">

        	<div class="box box-header">
                <div class="box-header with-border">
                  <h3 class="box-title">{{{ trans('misc.add_new') }}}</h3>
                </div><!-- /.box-header -->



                <!-- form start -->
                <form class="form-horizontal" method="post" action="{{{ url('user/dashboard/packages/animator-package/add') }}}" enctype="multipart/form-data">

                	<input type="hidden" name="_token" value="{{{ csrf_token() }}}">

          @include('errors.errors-forms')

                  <!-- Start Box Body -->
                  <div class="box-body">
                    <div class="form-group">
                      <label class="col-sm-2 control-label">{{{ 'Hours OR Minutes ? ' }}}</label>
                      <div class="col-sm-10">
                        <select name="hoursOrMinutes" class="form-control" id="hoursOrMinutes" >
                          <option value="">Select </option>
                          <option value="hours">Hours</option>
                          <option value="minutes">Minutes</option>
                        </select>
                      </div>
                    </div>
                  </div><!-- /.box-body -->

                 <!-- Start Box Body -->
                  <div class="box-body" id="divHours" style="display:none;">
                    <div class="form-group">
                      <label class="col-sm-2 control-label">{{{ 'Hours' }}}</label>
                      <div class="col-sm-10">
                        <input type="text" value="{{{ old('name') }}}" id="txtHours" name="animator_hours" class="form-control" placeholder="{{ 'Hours' }}">
                      </div>
                    </div>
                  </div><!-- /.box-body -->

                  <!-- Start Box Body -->
                  <div class="box-body" id="divMinutes" style="display:none;">
                    <div class="form-group">
                      <label class="col-sm-2 control-label">{{{ 'Minutes' }}}</label>
                      <div class="col-sm-10">
                        <input type="text" value="{{{ old('name') }}}" id="txtMinutes" name="animator_minutes" class="form-control" placeholder="{{ 'Minutes' }}">
                      </div>
                    </div>
                  </div><!-- /.box-body -->

                  <!-- Start Box Body -->
                  <div class="box-body">
                    <div class="form-group">
                      <label class="col-sm-2 control-label">{{{ 'Price' }}}</label>
                      <div class="col-sm-10">
                        <input type="text" value="{{{ old('name') }}}" name="animator_price" class="form-control" placeholder="{{ 'Price of package' }}">
                      </div>
                    </div>
                  </div><!-- /.box-body -->

                   <!-- Start Box Body -->
                   <div class="box-body">
                    <div class="form-group">
                      <label class="col-sm-2 control-label">{{{ 'Number of Animations' }}}</label>
                      <div class="col-sm-10">
                        <input type="text" value="{{{ old('name') }}}" name="number_of_animations" class="form-control" placeholder="{{ 'Number of Animations' }}">
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
                          <input type="radio" name="mode" value="on" checked>
                          {{{ trans('admin.active') }}}
                        </label>
                      </div>

                      <div class="radio">
                        <label class="padding-zero">
                          <input type="radio" name="mode" value="off">
                          {{{ trans('admin.disabled') }}}
                        </label>
                      </div>

                      </div>
                    </div>
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                    <a href="{{{ url('user/dashboard/packages/animator-package') }}}" class="btn btn-default">{{{ trans('admin.cancel') }}}</a>
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
	</script>

    <script>

      $("#hoursOrMinutes").change(function(){
        let getValue = $(this).val();
        if(getValue == "hours"){
          $("#txtMinutes").hide();
          $("#divMinutes").hide();
          $("#txtHours").show();
          $("#divHours").show();
        }else if(getValue == "minutes"){
          $("#txtHours").hide();
          $("#divHours").hide();
          $("#txtMinutes").show();
          $("#divMinutes").show();
        }else{
          $("#txtHours").hide();
          $("#txtMinutes").hide();
          $("#divHours").hide();
          $("#divMinutes").hide();
        }
      });

        $('label[id^="parent_id-"]').click(function(){
            var val = $(this).attr('id').split('-')[1];
            console.log(val);

            if(val == "yes"){
                $("#DivParentCategory").show();
            }else{
                $("#DivParentCategory").hide();
            }
        });
    </script>


@endsection
