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
            		{{{ trans('misc.categories') }}}
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
                <form class="form-horizontal" method="post" action="{{{ url('panel/admin/sub-categories/update') }}}" enctype="multipart/form-data">

                	<input type="hidden" name="_token" value="{{{ csrf_token() }}}">
                	<input type="hidden" name="id" value="{{{ $subCategories->id }}}">

					@include('errors.errors-forms')

                 <!-- Start Box Body -->
                  <div class="box-body">
                    <div class="form-group">
                      <label class="col-sm-2 control-label">{{{ trans('admin.name') }}}</label>
                      <div class="col-sm-10">
                        <input type="text" value="{{{ $subCategories->name }}}" name="name" class="form-control" placeholder="{{{ trans('admin.name') }}}">
                      </div>
                    </div>
                  </div><!-- /.box-body -->

                  <!-- Start Box Body -->
                  <div class="box-body">
                    <div class="form-group">
                      <label class="col-sm-2 control-label">{{{ trans('admin.slug') }}}</label>
                      <div class="col-sm-10">
                        <input type="text" value="{{{ $subCategories->slug }}}" name="slug" class="form-control" placeholder="{{{ trans('admin.slug') }}}">
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
                          <input type="radio" name="mode" value="on" @if( $subCategories->mode == 'on' ) checked @endif>
                          {{{ trans('admin.active') }}}
                        </label>
                      </div>

                      <div class="radio">
                        <label class="padding-zero">
                          <input type="radio" @if(  $subCategories->id == 1 ) disabled="disabled" @endif name="mode" value="off" @if( $subCategories->mode == 'off' ) checked @endif>
                          {{{ trans('admin.disabled') }}}
                        </label>
                      </div>

                      </div>
                    </div>
                  </div><!-- /.box-body -->

                  <!-- Start Box Body -->
                  <div class="box-body">
                    <div class="form-group">
                      <label class="col-sm-2 control-label">{{{ trans('admin.parentCategory') }}}</label>
                      <div class="col-sm-10">
                        <select id="parent_cate" name="parent_cate" class="form-control">
                          <option value="">Select Parent Category</option>
                          @foreach ($parentData as $pc)
                            @if($pc->id == $subCategories->parent_id)
                              <option selected value="{{ $pc->id }}">{{ $pc->name }}</option>
                            @else
                              <option value="{{ $pc->id }}">{{ $pc->name }}</option>
                            @endif
                          @endforeach
                        </select>
                      </div>
                    </div>
                  </div><!-- /.box-body -->

                  <!-- Start Box Body -->
                  <div class="box-body">
                    <div class="form-group">
                      <label class="col-sm-2 control-label">{{ trans('admin.thumbnail') }} ({{trans('misc.optional')}})</label>
                      <div class="col-sm-10">
                      	<div class="btn btn-info box-file">
                      		<input type="file" accept="image/*" name="thumbnail" />
                      		<i class="glyphicon glyphicon-cloud-upload myicon-right"></i> {{ trans('misc.replace_image') }}
                      		</div>

                      <p class="help-block">{{ trans('admin.thumbnail_desc') }}</p>

                      <div class="btn-default btn-lg btn-border btn-block pull-left text-left display-none fileContainer">
					     	<i class="glyphicon glyphicon-paperclip myicon-right"></i>
					     	<small class="myicon-right file-name-file"></small> <i class="icon-cancel-circle delete-attach-file-2 pull-right" title="{{ trans('misc.delete') }}"></i>
					     </div>
                      </div>
                    </div>
                  </div><!-- /.box-body -->


                  <div class="box-footer">
                    <a href="{{{ url('panel/admin/sub-categories') }}}" class="btn btn-default">{{{ trans('admin.cancel') }}}</a>
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
