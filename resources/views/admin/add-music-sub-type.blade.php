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
            		{{{ 'Music Sub Type' }}}
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
                <form class="form-horizontal" method="post" action="{{{ url('panel/admin/music-sub-type/add') }}}" enctype="multipart/form-data">
                	
                	<input type="hidden" name="_token" value="{{{ csrf_token() }}}">	
			
					@include('errors.errors-forms')
									
                 <!-- Start Box Body -->
                  <div class="box-body">
                    <div class="form-group">
                      <label class="col-sm-2 control-label">{{{ 'Music Sub Type Name' }}}</label>
                      <div class="col-sm-10">
                        <input type="text" value="{{{ old('name') }}}" name="music_type" class="form-control" placeholder="{{{ trans('admin.name') }}}">
                      </div>
                    </div>
                  </div><!-- /.box-body -->

                  <!-- Start Box Body -->
                  <div class="box-body">
                    <div class="form-group">
                      <label class="col-sm-2 control-label">{{{ 'Select Parent Music Type' }}}</label>
                      <div class="col-sm-10">
                        <select name="parent_id" class="form-control" id="parent_id">
                        <?php
                          foreach($musicTypeData as $mtd){
                        ?>
                            <option value="<?php echo $mtd->id; ?>"><?php echo $mtd->music_type; ?></option>
                        <?php
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
	
	<!-- icheck -->
	<script src="{{{ asset('public/plugins/iCheck/icheck.min.js') }}}" type="text/javascript"></script>
	
	<script type="text/javascript">
		//Flat red color scheme for iCheck
        $('input[type="radio"]').iCheck({
          radioClass: 'iradio_flat-red'
        });
	</script>

    <script>
  
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
