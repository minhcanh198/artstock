@extends('admin.layout')

@section('content')
<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h4>
           {{ trans('admin.admin') }} <i class="fa fa-angle-right margin-separator"></i> {{ 'Cities' }} ({{$data->count()}})
          </h4>
     
        </section>

        <!-- Main content -->
        <section class="content">
        	       	
		    @if(Session::has('success_message'))
		    <div class="alert alert-success">
		    	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">×</span>
								</button>
		        <i class="fa fa-check margin-separator"></i> {{ Session::get('success_message') }}	        
		    </div>
		@endif
		    
        	<div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title"> {{ 'Cities' }}</h3>
                  <div class="box-tools">
                    <a href="{{ url('panel/admin/destinations/cities/add') }}" class="btn btn-sm btn-success no-shadow pull-right">
	        	        	<i class="glyphicon glyphicon-plus myicon-right"></i> {{ trans('misc.add_new') }}
	        		      </a>
                  </div>
                </div><!-- /.box-header -->
                
                
		
                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">
               <tbody>
               	
               	@if( $data->count() !=  0 )
                   <tr>
                      <th class="active">ID</th>
                      <th class="active">{{ 'City Name' }}</th>
                      <th class="active">{{ 'City Slug' }}</th>
                      <th class="active">{{ 'Country' }}</th>
                      {{-- <!-- <th class="active">{{ 'State' }}</th> -->--}}
                      <th class="active">{{ 'Status' }}</th>
                      <th class="active">{{ 'Action' }}</th>

                    </tr>
                  
                  @foreach( $data as $city )
                    <tr>
                      <td>{{ $city->id }}</td>
                      <td>{{ $city->city_name }}</td>
                      <td>{{ $city->city_slug }}</td>
                      <td>{{ $city->country_name }}</td>
                      {{-- <!-- <td>{{ $city->state_name }}</td> --> --}}
                      <?php 
                            if( $city->is_active == '1' ) {
                                $mode = 'success';
                            } else {
                                $mode = 'danger';
                            } 
                        ?>
                      <td><span class="label label-{{$mode}}">{{ ($city->is_active == "1") ? 'Active' : 'Inactive' }}</span></td>
                      <td>
                      	<a href="{{ url('panel/admin/destinations/cities/edit/').'/'.$city->id }}" class="btn btn-success btn-xs padding-btn">
                      		{{ trans('admin.edit') }}
                      	</a> 
                     
                     
                      	<a href="javascript:void(0);" data-url="{{ url('panel/admin/destinations/cities/delete/').'/'.$city->id }}" class="btn btn-danger btn-xs padding-btn actionDelete">
                      		{{ trans('admin.delete') }}
                        </a>
                      		
                      		</td>
                    </tr><!-- /.TR -->
                    @endforeach
                    
                    @else
                    <hr />
                    	<h3 class="text-center no-found">{{ trans('misc.no_results_found') }}</h3>
                    @endif
                                        
                  </tbody>
                  
      
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
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
	var url     = element.attr('data-url');
	
	element.blur();
	
	swal(
		{   title: "{{trans('misc.delete_confirm')}}",  
		 text: "{{trans('misc.confirm_delete_category')}}",  
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
		    	 	window.location.href = url;
		    	 	}
		    	 });
		    	 
		    	 
		 });
</script>
@endsection
