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
           {{ trans('admin.admin') }} <i class="fa fa-angle-right margin-separator"></i> {{ trans_choice('misc.pending_request_details', 0) }} 
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
                    
                </div><!-- /.box-header -->

                <div class="box-body table-responsive no-padding">
               
                  <div class="table-div">
                  <table cellspacing="0" class=" dashboard-table-custom uk-table dataTable" id="dt_colVis" width="100%">
                    <thead>
                      
                    </thead>
                    <tbody>
                    <h3 class="text-center" style="font-size: 36px;">General</h3>
                      <tr>
                        <td class="">City:</td>
                        @php 
                          $getCountryName = \App\Models\Country::where('id','=',$data->CountryId)->first();
                        @endphp
                        <td class="">{{ $data->city_name }}, {{ $getCountryName->country_name }} </td>
                      </tr>
                      <tr>
                        <td class="">Reference #:</td>
                        <td class="">{{ $data->reference_no }}</td>
                      </tr>
                      <tr>
                        <td class="">Work :</td>
                        <td class="">{{ $data->photoshoot_type }}</td>
                      </tr>
                      <tr>
                        <td class="">Package:</td>
                        <td class="">{{ ($data->package_hours != "") ? $data->package_hours . ' hour' : $data->package_minutes . ' minute' }} - {{ $data->package_price }} USD - {{ $data->number_of_photos }} photos</td>
                      </tr>

                      <tr>
                        <td class="">Requested Shoot Length:</td>
                        <td class="">{{ ($data->package_hours != "") ? $data->package_hours . ' hour' : $data->package_minutes . ' minute' }}</td>
                      </tr>

                      <tr>
                        <td class="">Requested Date(s):</td>
                        <td class="">{{  App\Helper::formatDate($data->requested_date) }} - {{ $data->requested_time }} (preferred)</td>
                      </tr>
                      
                      <tr>
                        <td class="">Requested Customer:</td>
                        <td class="">{{ $data->UserName }}</td>
                      </tr>

                      <tr>
                        <td class="">Requested Photographer:</td>
                        <td class="">{{ $data->UserNameArtist }}</td>
                      </tr>
                      @if($data->participants_adults_count >= 0)
                        <tr>
                          <td class="">Adults Participants:</td>
                          <td class="">{{ $data->participants_adults_count }}</td>
                        </tr>
                      @endif

                      @if($data->participants_children_count >= 1)
                        <tr>
                          <td class="">Children Participants:</td>
                          <td class="">{{ $data->participants_children_count }}</td>
                        </tr>
                      @endif

                      @if($data->participants_infants_count >= 1)
                        <tr>
                          <td class="">Infants Participants:</td>
                          <td class="">{{ $data->participants_infants_count }}</td>
                        </tr>
                      @endif

                      @if($data->important_information != "")
                      <tr>
                        <td class="">My Comments:</td>
                        <td class="">{{ $data->important_information }}</td>
                      </tr>
                      @endif
                      
                      @if($data->time_restriction != "")
                      <tr>
                        <td class="">Time Restriction:</td>
                        <td class="">{{ $data->time_restriction }}</td>
                      </tr>
                      @endif
                    </tbody>
                  </table>
                  @if($data->trip_reason != "" || $data->preferred_style != "" || $data->level_of_direction != "")
                  <table cellspacing="0" class=" dashboard-table-custom uk-table dataTable" id="dt_colVis" width="100%">
                    <tbody>
                      
                      <h3 class="text-center" style="font-size: 36px;">Inspiration</h3>
                        
                      <tr>
                        <td class="">Occasion:</td>
                        <td class="">{{ $data->trip_reason }}</td>
                      </tr>
                      
                      <tr>
                        <td class="">Style:</td>
                        <td class="">{{ $data->preferred_style }}</td>
                      </tr>

                      <tr>
                        <td class="" >Level of direction:</td>
                        <td class="" >{{ $data->level_of_direction }}</td>
                      </tr>
                    </tbody>
                  </table> 
                  @endif   
                  <table cellspacing="0" class=" dashboard-table-custom uk-table dataTable" id="dt_colVis" width="100%">    
                    <tbody>
                      <h3 class="text-center" style="font-size: 36px;">Route</h3>
                        
                      @if($data->route_id != 0)
                        @php
                          $getRouteDetails = \App\Models\Routes::where('id','=',$data->route_id)->first();
                        @endphp
                        <tr>
                          <td class="">Route:</td>
                          <td class="">{{ $getRouteDetails->route_name }}</td>
                        </tr>
                        
                        <tr>
                          <td class="">Route Description:</td>
                          <td class="">{{ $getRouteDetails->description }}</td>
                        </tr>

                       {{--<tr>
                          <td class="" >Level of direction:</td>
                          <td class="" >{{ $data->level_of_direction }}</td>
                        </tr>--}} 
                      @else
                        @php
                          $getUserDetailss = \App\Models\User::where('id','=',$data->customer_id)->first();
                        @endphp
                        <tr>
                          <td class="">Route:</td>
                          <td class="">{{ 'Custom Route for ' . $getUserDetailss->username }} - {{ $data->city_name }}</td>
                        </tr>
                        
                        <tr>
                          <td class="">Route Vision:</td>
                          <td class="">{{ $data->describe_route }}</td>
                        </tr>

                        <tr>
                          <td class="">Requested Meeting Location:</td>
                          <td class="">{{ $data->requested_meeting_location }}</td>
                        </tr> 
                      @endif
                        
                    </tbody>
                  </table>
                  </div>
                  


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
