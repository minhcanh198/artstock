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
           {{ trans('admin.admin') }} <i class="fa fa-angle-right margin-separator"></i> {{ trans_choice('misc.cancelled_requests', 0) }} ({{ count($data) }})
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
                    @if( count($data) !=  0 && $data->count() != 0 )

                        {{-- <form action="{{ url('user/dashboard/photos') }}" id="formSort" method="get">
                            <select name="sort" id="sort" class="form-control input-sm" style="width: auto; padding-right: 20px;">
                                <option @if( $sort == '') selected="selected" @endif value="">{{ trans('admin.sort_id') }}</option>
                                <option @if( $sort == 'pending') selected="selected" @endif value="pending">{{ trans('admin.pending') }}</option>
                                <option @if( $sort == 'title') selected="selected" @endif value="title">{{ trans('admin.sort_title') }}</option>
                                <option @if( $sort == 'likes') selected="selected" @endif value="likes">{{ trans('admin.sort_likes') }}</option>
                                <option @if( $sort == 'downloads') selected="selected" @endif value="downloads">{{ trans('admin.sort_downloads') }}</option>
                            </select>
                        </form> --}}
                        <!-- form -->
                  <div class="box-tools">

                <!-- form -->
                    {{--<form role="search" autocomplete="off" action="{{ url('user/dashboard/photos') }}" method="get">
	                 <div class="input-group input-group-sm" style="width: 150px;">
	                  <input type="text" name="q" class="form-control pull-right" placeholder="Search">

	                  <div class="input-group-btn">
	                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
	                  </div>
	                </div>
                </form>--}}
                <!-- form -->


                  </div>
                  @endif

              </div><!-- /.box-header -->

                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">
               <tbody>

               	@if( count($data) !=  0 && $data->count() != 0 )
                   <tr>
                      <th class="active">ID</th>
                      <th class="active">{{ trans('misc.referenceNo') }}</th>
                      <th class="active">{{ trans('misc.city') }}</th>
                      <th class="active">{{ trans('misc.country') }}</th>
                      <th class="active">{{ trans('misc.req_customer') }}</th>
                      <th class="active">{{ trans('misc.req_photographer') }}</th>
                      
                      <th class="active">{{ trans('admin.req_date') }}</th>
                      <th class="active">{{ trans('admin.status') }}</th>
                      <th class="active">{{ trans('admin.actions') }}</th>
                    </tr>

                  @foreach( $data as $shoots )
                    <tr>
                      <td>{{ $shoots->id }}</td>
                      <td>{{ $shoots->reference_no }}</td>
                      <td>{{ $shoots->city_name }}</td>
                      @php 
                        $getCountryName = \App\Models\Country::where('id','=',$shoots->CountryId)->first();
                      @endphp
                      <td>{{ $getCountryName->country_name }}</td>
                      <td>{{ $shoots->UserName }}</td>
                      <td>{{ $shoots->UserNameArtist }}</td>
                      
                      <td>{{ App\Helper::formatDate($shoots->requested_date) }} - {{ $shoots->requested_time }} (preferred)</td>

                     <?php if( $shoots->status == 'pending' ) {
                      			$mode    = 'warning';
								$_status = trans('admin.pending');
                      		} elseif( $shoots->status == 'approved' ) {
                      			$mode = 'success';
								$_status = $shoots->status;
							} elseif( $shoots->status == 'rejected' ) {
                                $mode = 'danger';
                                $_status = $shoots->status;
                            } elseif( $shoots->status == 'cancelled' ) {
                                $mode = 'danger';
                                $_status = $shoots->status;
                            } else{
                                $mode = 'success';
                                $_status = $shoots->status;
                            }

                      		?>
                      <td><span class="label label-{{$mode}}">{{ $_status }}</span></td>
                      <td>

                   <a href="{{ url('panel/admin/booking-cancelled-details', $shoots->id) }}" class="btn btn-success btn-sm padding-btn" target="_blank">
                      	<i class="fa fa-eye myicon-right "></i> {{ trans('admin.view_detail') }}
                      	</a>

                      </td>

                    </tr><!-- /.TR -->
                    @endforeach

                    @else
                    	<h3 class="text-center no-found">{{ trans('misc.no_results_found') }}</h3>

                    	@if( isset( $query ) || isset( $sort )  )
                    	<div class="col-md-12 text-center padding-bottom-15">
                    		<a href="{{url('user/dashboard/my-shoots')}}" class="btn btn-sm btn-danger">{{ trans('auth.back') }}</a>
                    	</div>

                    	@endif
                    @endif

                  </tbody>


                  </table>



                </div><!-- /.box-body -->
              </div><!-- /.box -->
         {{-- @if( $data->count() != 0 )
             {{ $data->appends(['q' => $query, 'sort' => $sort])->links() }}
             @endif --}}
            </div>
          </div>

          <!-- Your Page Content Here -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
@endsection

@section('javascript')

<script type="text/javascript">

$(document).on('change','#sort',function(){
	 	$('#formSort').submit();
	 });

$(".actionDelete").click(function(e) {
   	e.preventDefault();

   	var element = $(this);
	var id     = element.attr('data-url');
	var form    = $(element).parents('form');

	element.blur();

	swal(
		{   title: "{{trans('misc.delete_confirm')}}",
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
