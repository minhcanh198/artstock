@extends('dashboard.layout')

@section('content')
<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h4>
           {{ trans('admin.admin') }} <i class="fa fa-angle-right margin-separator"></i> {{ 'Music Packages' }} ({{$data->count()}})
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
                  <h3 class="box-title"> {{ 'Music Packages' }}</h3>
                  <div class="box-tools">
                    <a href="{{ url('user/dashboard/packages/musician-package/add') }}" class="btn btn-sm btn-success no-shadow pull-right">
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
                      <th class="active">{{ 'Hours' }}</th>
                      <th class="active">{{ 'Minutes' }}</th>
                      <th class="active">{{ 'Price' }}</th>
                      <th class="active">{{ 'Number of Music' }}</th>
                      <th class="active">{{ trans('admin.actions') }}</th>
                      <th class="active">{{ trans('admin.status') }}</th>
                    </tr>
                  
                  @foreach( $data as $package )
                    <tr>
                      <td>{{ $package->id }}</td>
                      <td>{{ ($package->musician_hours == "") ? '---' : $package->musician_hours }}</td>
                      <td>{{ ($package->musician_minutes == "") ? '---' : $package->musician_minutes }}</td>
                      <td>{{ $package->musician_price }}</td>
                      <td>{{ $package->number_of_music }}</td>
                      <td>
                      	<a href="{{ url('user/dashboard/packages/musician-package/edit/').'/'.$package->id }}" class="btn btn-success btn-xs padding-btn">
                      		{{ trans('admin.edit') }}
                      	</a> 
                     
                      	<a href="javascript:void(0);" data-url="{{ url('user/dashboard/packages/musician-package/delete/').'/'.$package->id }}" class="btn btn-danger btn-xs padding-btn actionDelete">
                      		{{ trans('admin.delete') }}
                      		</a>
                      		
                      		</td>
                      		<?php if( $package->mode == 'on' ) {
                      			$mode = 'success';
                      		} else {
                      			$mode = 'danger';
                      		} ?>
                      <td><span class="label label-{{$mode}}">{{ ucfirst($package->mode) }}</span></td>
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
