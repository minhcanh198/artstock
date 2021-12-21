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
            		{{{ 'FAQ' }}}
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
                <form class="form-horizontal" method="post" action="{{{ url('panel/admin/faq/update') }}}" enctype="multipart/form-data">

                	<input type="hidden" name="_token" value="{{{ csrf_token() }}}">
                	<input type="hidden" name="id" value="{{{ $faq->id }}}">

					@include('errors.errors-forms')

                 <!-- Start Box Body -->
                  <div class="box-body">
                    <div class="form-group">
                      <label class="col-sm-2 control-label">{{{ 'Question' }}}</label>
                      <div class="col-sm-10">
                        <input type="text" value="{{{ $faq->faq_question }}}" name="question" class="form-control" placeholder="{{{ 'Question' }}}">
                      </div>
                    </div>
                  </div><!-- /.box-body -->

                   <!-- Start Box Body -->
                   <div class="box-body">
                    <div class="form-group">
                      <label class="col-sm-2 control-label">{{{ 'Answer' }}}</label>
                      <div class="col-sm-10">
                        {{-- <!-- <input type="text" value="{{{ $faq->faq_answer }}}" name="answer" class="form-control" placeholder="{{{ 'Answer' }}}"> --> --}}
                        <textarea id="basic-example" name="answer" placeholder="Answer">{{{ $faq->faq_answer }}}</textarea>
                      </div>
                    </div>
                  </div><!-- /.box-body -->

                    <!-- Start Box Body -->
                <div class="box-body">
                  <div class="form-group">
                    <label class="col-sm-2 control-label">{{ 'Faq Category' }}</label>
                    <div class="col-sm-10">
                      <select name="faq_category" class="form-control">
                        <option value="">Select Faq Category</option>
                        @foreach($data as $faqCategory)
                            @if($faqCategory->parent_id != "0")
                                @if($faqCategory->id == $faq->faq_category_id)
                                    <option selected value="{{ $faqCategory->id }}">{{ $faqCategory->name }}</option>
                                @else
                                    <option value="{{ $faqCategory->id }}">{{ $faqCategory->name }}</option>
                                @endif
                            @endif
                        @endforeach
                        </select>
                    </div>
                  </div>
                </div><!-- /.box-body -->

                  <div class="box-footer">
                    <a href="{{{ url('panel/admin/faq') }}}" class="btn btn-default">{{{ trans('admin.cancel') }}}</a>
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
