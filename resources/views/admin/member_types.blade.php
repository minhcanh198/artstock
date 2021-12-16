@extends('admin.layout')

@section('content')
<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h4>
           {{ trans('admin.admin') }} <i class="fa fa-angle-right margin-separator"></i> {{ trans('admin.member_types') }} ({{$data->total()}})
          </h4>

        </section>

        <!-- Main content -->
        <section class="content">

        	 @if(Session::has('info_message'))
		    <div class="alert alert-warning">
		    	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">×</span>
								</button>
		      <i class="fa fa-warning margin-separator"></i>  {{ Session::get('info_message') }}
		    </div>
		@endif

		    @if(Session::has('success_message'))
		    <div class="alert alert-success">
		    	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">×</span>
								</button>
		       <i class="fa fa-check margin-separator"></i>  {{ Session::get('success_message') }}
		    </div>
		@endif

        	<div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">
                  	@if( $data->count() != 0 && $data->currentPage() != 1 )
                  		<a href="{{url('panel/admin/member_types')}}">{{ trans('admin.view_all_types') }}</a>
                  	@else
                  		{{ trans('admin.member_types') }}
                  	@endif

                  	</h3>
                    <div class="box-tools">
                        
                        <a href="{{ route('type.create') }}" class="btn btn-sm btn-success no-shadow pull-right">
                            <i class="glyphicon glyphicon-plus myicon-right"></i> {{ trans('misc.add_new') }}
                        </a>
                        

                        {{-- @if( $data->total() !=  0 )
                            <!-- form -->
                            <form role="search" autocomplete="off" action="{{ url('panel/admin/member_types') }}" method="get">
                                <div class="input-group input-group-sm" style="width: 150px;">
                                    <input type="text" name="q" class="form-control pull-right" placeholder="Search">

                                    <div class="input-group-btn">
                                        <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                    </div>
                                </div>
                            </form><!-- form -->
                        @endif --}}

                    </div>
                </div><!-- /.box-header -->



                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">
               <tbody>

               	@if( $data->total() !=  0 && $data->count() != 0 )
                   <tr>
                      <th class="active">ID</th>
                      <th class="active">{{ trans('admin.type_name') }}</th>
                      <th class="active">{{ trans('admin.date') }}</th>
                      <th class="active">{{ trans('admin.status') }}</th>
                      <th class="active">{{ trans('admin.actions') }}</th>
                    </tr>

                  @foreach( $data as $type )
                    <tr>
                      <td>{{ $type->types_id }}</td>
                      <td>{{ $type->type_name }}</td>
                      <td>{{ App\Helper::formatDate($type->created_at) }}</td>
                     <?php if( $type->mode == 'on' ) {
                      			$mode    = 'success';
								$_status = trans('admin.active');
                      		} else {
                      			$mode = 'warning';
								$_status = trans('admin.disabled');
                      		}

                      		?>
                      <td><span class="label label-{{$mode}}">{{ $_status }}</span></td>
                      <td>



                     {{-- @if( $user->id <> Auth::user()->id && $user->id <> 1 ) --}}

                   <a href="{{ route('type.edit', $type->types_id) }}" class="btn btn-success btn-xs padding-btn">
                      		{{ trans('admin.edit') }}
                      	</a>

                   {!! Form::open([
			            'method' => 'DELETE',
			            'route' => ['type.destroy', $type->types_id],
			            'id' => 'form'.$type->types_id,
			            'class' => 'displayInline'
				        ]) !!}
	            	{!! Form::submit(trans('admin.delete'), ['data-url' => $type->types_id, 'class' => 'btn btn-danger btn-xs padding-btn actionDelete']) !!}
	        	{!! Form::close() !!}

	       {{-- @else
	        ------------
                      		@endif --}}

                      		</td>

                    </tr><!-- /.TR -->
                    @endforeach

                    @else
                    <hr />
                    	<h3 class="text-center no-found">{{ trans('misc.no_results_found') }}</h3>

                    	@if( isset( $query ) )
                    	<div class="col-md-12 text-center padding-bottom-15">
                    		<a href="{{url('panel/admin/member_types')}}" class="btn btn-sm btn-danger">{{ trans('auth.back') }}</a>
                    	</div>

                    	@endif
                    @endif

                  </tbody>


                  </table>



                </div><!-- /.box-body -->
              </div><!-- /.box -->
             {{ $data->appends(['q' => $query])->links() }}
            </div>
          </div>

          <!-- Your Page Content Here -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
@endsection

@section('javascript')

<script type="text/javascript">

$(".actionDelete").click(function(e) {
   	e.preventDefault();

   	var element = $(this);
	var id     = element.attr('data-url');
	var form    = $(element).parents('form');

	element.blur();

	swal(
		{   title: "{{trans('misc.delete_confirm')}}",
		text: "{{trans('admin.delete_member_type_confirm')}}",
		  type: "warning",
		  showLoaderOnConfirm: true,
		  showCancelButton: true,
		  confirmButtonColor: "#DD6B55",
		   confirmButtonText: "{{trans('misc.yes_confirm')}}",
		   cancelButtonText: "{{trans('misc.cancel_confirm')}}",
		    closeOnConfirm: false,
		    },
		    function(isConfirm){
		    	 if (isConfirm) {
		    	 	form.submit();
		    	 	//$('#form' + id).submit();
		    	 	}
		    	 });


		 });
</script>
@endsection
