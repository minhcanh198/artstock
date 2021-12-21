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
            		{{{ 'Music Sub Type' }}}
            			<i class="fa fa-angle-right margin-separator"></i>
            				{{{ trans('admin.edit') }}}
          </h4>

        </section>

        <!-- Main content -->
        <section class="content">

        	<div class="content">

        		<div class="row">

        	<div class="box box-danger">
                <div class="box-header with-border">
                  <h3 class="box-title">{{{ trans('admin.edit') }}}</h3>
                </div><!-- /.box-header -->



                <!-- form start -->
                <form class="form-horizontal" method="post" action="{{{ url('panel/admin/music-sub-type/update') }}}" enctype="multipart/form-data">

                	<input type="hidden" name="_token" value="{{{ csrf_token() }}}">
                	<input type="hidden" name="id" value="{{{ $musicType->id }}}">

					@include('errors.errors-forms')

                 <!-- Start Box Body -->
                  <div class="box-body">
                    <div class="form-group">
                      <label class="col-sm-2 control-label">{{ 'Music Sub Type Name' }}</label>
                      <div class="col-sm-10">
                        <input type="text" value="{{{ $musicType->music_type }}}" name="music_type" class="form-control" placeholder="{{{ trans('admin.name') }}}">
                      </div>
                    </div>
                  </div><!-- /.box-body -->

                  <!-- Start Box Body -->
                  <div class="box-body">
                    <div class="form-group">
                      <label class="col-sm-2 control-label">{{{ 'Select Parent Music Type' }}}</label>
                      <div class="col-sm-10">
                        <select name="parent_id" class="form-control" id="parent_id">
                        <option value="">Select Parent Music Type</option>
                        <?php
                          foreach($parentMusicTypeData as $pmtd){
                            if($musicType->parent_id == $pmtd->id){
                        ?>
                              <option selected value="<?php echo $pmtd->id; ?>"><?php echo $pmtd->music_type; ?></option>
                        <?php
                            }else{
                        ?>

                              <option value="<?php echo $pmtd->id; ?>"><?php echo $pmtd->music_type; ?></option>
                        <?php
                            }
                          }
                        ?>
                        </select>
                      </div>
                    </div>
                  </div><!-- /.box-body -->


                  <div class="box-footer">
                    <a href="{{{ url('panel/admin/music-sub-type') }}}" class="btn btn-default">{{{ trans('admin.cancel') }}}</a>
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
	<script src="{{{ asset('plugins/iCheck/icheck.min.js') }}}" type="text/javascript"></script>

	<script type="text/javascript">
		//Flat red color scheme for iCheck
        $('input[type="radio"]').iCheck({
          radioClass: 'iradio_flat-red'
        });
	</script>


@endsection
