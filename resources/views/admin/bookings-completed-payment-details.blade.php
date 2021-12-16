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
           {{ trans('admin.admin') }} <i class="fa fa-angle-right margin-separator"></i> {{ trans_choice('misc.completed_request_details', 0) }} 
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
                    <h3 class="text-center" style="font-size: 36px;">Booking Payment Details</h3>
                      
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
                      
                      @php
                      
                        $getPaymentDetails = DB::table('payments')->where('RequestReferenceNo','=', $data->reference_no)->first();
                       
                      @endphp
                        <tr>
                            <td>First Name</td>
                            <td><?php echo $getPaymentDetails->FirstName; ?></td>
                        </tr>
                        <tr>
                            <td>Last Name</td>
                            <td><?php echo $getPaymentDetails->LastName; ?></td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td><?php echo $getPaymentDetails->Email; ?></td>
                        </tr>
                        <tr>
                            <td>Phone</td>
                            <td><?php echo $getPaymentDetails->Phone; ?></td>
                        </tr>
                        <tr>
                            <td>Total Amount</td>
                            <td><?php echo 'USD '.$getPaymentDetails->TotalAmount; ?></td>
                        </tr>
                        <tr>
                            <td>Paypal Email</td>
                            <td><?php echo $data->paypal_email; ?></td>
                        </tr>
                        <tr>
                            <td>Admin Percentage</td>
                            <td><?php echo $getPaymentDetails->AdminPercentage . '%'; ?></td>
                        </tr>
                        <tr>
                            <td>Admin Amount</td>
                            <td><?php echo 'USD '.$getPaymentDetails->TotalAmount / 100 * $getPaymentDetails->AdminPercentage; ?></td>
                        </tr>
                        <tr>
                            <td>Artist Percentage</td>
                            <td><?php echo '70%'; ?></td>
                        </tr>
                        <tr>
                            <td>Artist Amount</td>
                            <td><?php $amount = $getPaymentDetails->TotalAmount / 100 * 70; echo 'USD '.$amount; ?></td>
                        </tr>
                    </tbody>
                  </table>
                 
                  </div>
                  <div id="paypal-button-container"></div>
                  


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

<script src="https://www.paypalobjects.com/api/checkout.js"></script>
    <script>
        $(document).ready(function() {
            $("#shipping-address").change(function() {
                if ($("#shipping-address:checked").val()) {
                    $("#shippingAddress").show();
                } else {
                    $("#shippingAddress").hide();
                }
            });
        });
        paypal.Button.render({
            // Set your environment
            env: 'sandbox', // sandbox | production
            // Specify the style of the button
            style: {
                layout: 'vertical', // horizontal | vertical
                size: 'responsive', // medium | large | responsive
                shape: 'rect', // pill | rect
                color: 'gold' // gold | blue | silver | white | black
            },
            // Specify allowed and disallowed funding sources
            //
            // Options:
            // - paypal.FUNDING.CARD
            // - paypal.FUNDING.CREDIT
            // - paypal.FUNDING.ELV
            funding: {
                allowed: [
                    paypal.FUNDING.CARD,
                    paypal.FUNDING.CREDIT
                ],
                disallowed: []
            },
            // PayPal Client IDs - replace with your own
            // Create a PayPal app: https://developer.paypal.com/developer/applications/create
            client: {
                // sandbox: 'ASy70TwJR4ZZ9M40E_o-EBaF0Ni6c58Cfu46kgsBbti22YddJrR78ZX1yUJd573C820D1rR9d9-GmzAJ',
                sandbox: 'Af2bltpOqE862RjRSbzf3Q7yP3hr-3Tu6-WmeIQ8eDZp7PDsvz86VX36TSFaNPsp-8ETQQI_O36RjNZ8',
                production: '<insert production client id>'
            },
            payment: function(data, actions) {
                return actions.payment.create({
                    payment: {
                        transactions: [{
                            amount: {
                                total: <?php echo $amount ?>,
                                currency: 'USD'
                            }
                        }]
                    }
                });
            },
            onAuthorize: function(data, actions) {
                return actions.payment.execute()
                    .then(function() {
                        // console.log(data);
                        var html = '<input type="hidden" name="amount" value="<?php echo $amount; ?>"><input type="hidden" name="transaction_id" value="' + data.paymentID + '"><input type="hidden" name="payment_status" value="succeeded"><input type="hidden" name="payment_method" value="PayPal">';
                        $("#checkOutPaymentForm").append(html);
                        // alert_success('Payment Completed Successfully!');
                        console.log('Payment Completed Successfully!');
                        $('#checkOutPaymentForm').submit();
                    });
            },
            onError: function(err) {
                console.log(err, 'Kindly fill the form and calculate the shipping amount to preceed payment!');
                // alert_danger('Kindly fill the form and calculate the shipping amount to preceed payment!');
            }
        }, '#paypal-button-container');
    </script>
@endsection
