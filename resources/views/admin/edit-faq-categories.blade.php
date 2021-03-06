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
            		{{{ 'FAQ Category' }}}
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
                <form class="form-horizontal" method="post" action="{{{ url('panel/admin/faq-categories/update') }}}" enctype="multipart/form-data">

                	<input type="hidden" name="_token" value="{{{ csrf_token() }}}">
                	<input type="hidden" name="id" value="{{{ $categories->id }}}">

					@include('errors.errors-forms')

                 <!-- Start Box Body -->
                  <div class="box-body">
                    <div class="form-group">
                      <label class="col-sm-2 control-label">{{{ trans('admin.name') }}}</label>
                      <div class="col-sm-10">
                        <input type="text" value="{{{ $categories->name }}}" name="name" class="form-control" placeholder="{{{ trans('admin.name') }}}">
                      </div>
                    </div>
                  </div><!-- /.box-body -->

                  <!-- Start Box Body -->
                  <div class="box-body">
                    <div class="form-group">
                      <label class="col-sm-2 control-label">{{{ trans('admin.slug') }}}</label>
                      <div class="col-sm-10">
                        <input type="text" value="{{{ $categories->slug }}}" name="slug" class="form-control" placeholder="{{{ trans('admin.slug') }}}">
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
                          <input type="radio" name="mode" value="on" @if( $categories->mode == 'on' ) checked @endif>
                          {{{ trans('admin.active') }}}
                        </label>
                      </div>

                      <div class="radio">
                        <label class="padding-zero">
                          <input type="radio" @if(  $categories->id == 1 ) disabled="disabled" @endif name="mode" value="off" @if( $categories->mode == 'off' ) checked @endif>
                          {{{ trans('admin.disabled') }}}
                        </label>
                      </div>

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

                  <!-- Start Box Body -->
                  <div class="box-body">
                    <div class="form-group">
                      <label class="col-sm-2 control-label">{{{ 'Parent Category ?' }}}</label>
                      <div class="col-sm-10">

                    <div class="radio">
                        <label class="padding-zero"  id="parent_id-yes" >
                          <input type="radio" name="parent_id" value="yes" @if( $categories->parent_id != '0' ) checked @endif>
                          {{{ trans('admin.active') }}}
                        </label>
                    </div>

                      <div class="radio">
                        <label class="padding-zero" id="parent_id-no" >
                          <input type="radio" name="parent_id" value="no" @if( $categories->parent_id == '0' ) checked @endif>
                          {{{ trans('admin.disabled') }}}
                        </label>
                      </div>

                      </div>
                    </div>
                  </div><!-- /.box-body -->

                <!-- Start Box Body -->
                <div class="box-body" style="<?php echo ($categories->parent_id != "0") ? 'display:block' : 'display:none'?>;" id="DivParentCategory">
                  <div class="form-group">
                    <label class="col-sm-2 control-label">{{ 'Parent Category' }}</label>
                    <div class="col-sm-10">
                      <select name="parent_category" class="form-control">
                        <option value="">Select Parent Category</option>
                        @if($data != "")
                            @foreach($data as $parentCategory)
                                @if($parentCategory->parent_id == "0")
                                    @if($categories->parent_id == $parentCategory->id)
                                        <option selected value="{{ $parentCategory->id }}">{{ $parentCategory->name }}</option>
                                    @else
                                        <option value="{{ $parentCategory->id }}">{{ $parentCategory->name }}</option>
                                    @endif
                                @endif
                            @endforeach
                        @endif
                        </select>
                    </div>
                  </div>
                </div><!-- /.box-body -->


                  <div class="box-footer">
                    <a href="{{{ url('panel/admin/faq-categories') }}}" class="btn btn-default">{{{ trans('admin.cancel') }}}</a>
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

<script>
    console.log('hellow world');
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
