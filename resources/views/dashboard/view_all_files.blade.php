@extends('dashboard.layout')

@section('content')
<style>
.btn-one-dashboard-new {
    padding: 8px 30px;
    border-radius: 30px;
    color: #fff;
    background: #ef595f;
    transition: 0.5s;
    margin-right: 6px;
}


.btn-one-dashboard-new-2 {
    background-color: #3A3A3A;
    color: #fff;
    padding: 8px 30px;
    border-radius: 30px;
    text-align: center;
    transition: 0.5s;
}
.help-tip{
    position: absolute;
    top: 25px;
    right: 10px;
    text-align: center;
    background-color: #BCDBEA;
    border-radius: 50%;
    width: 24px;
    height: 24px;
    font-size: 14px;
    line-height: 26px;
    cursor: default;
}

.help-tip:before{
    content:'?';
    font-weight: bold;
    color:#fff;
}

.help-tip:hover p{
    display:block;
    transform-origin: 100% 0%;

    -webkit-animation: fadeIn 0.3s ease-in-out;
    animation: fadeIn 0.3s ease-in-out;

}

.help-tip p{    /* The tooltip */
    display: none;
    text-align: left;
    background-color: #1E2021;
    padding: 20px;
    width: 300px;
    position: absolute;
    border-radius: 3px;
    box-shadow: 1px 1px 1px rgba(0, 0, 0, 0.2);
    right: -4px;
    color: #FFF;
    font-size: 13px;
    line-height: 1.4;
}

.help-tip p:before{ /* The pointer of the tooltip */
    position: absolute;
    content: '';
    width:0;
    height: 0;
    border:6px solid transparent;
    border-bottom-color:#1E2021;
    right:10px;
    top:-12px;
}

.help-tip p:after{ /* Prevents the tooltip from being hidden */
    width:100%;
    height:40px;
    content:'';
    position: absolute;
    top:-40px;
    left:0;
}

/* CSS animation */

@-webkit-keyframes fadeIn {
    0% {
        opacity:0;
        transform: scale(0.6);
    }

    100% {
        opacity:100%;
        transform: scale(1);
    }
}

@keyframes fadeIn {
    0% { opacity:0; }
    100% { opacity:100%; }
}






  .modal-confirm {
	color: #636363;
	width: 400px;
}
.modal-confirm .modal-content {
	padding: 20px;
	border-radius: 5px;
	border: none;
	text-align: center;
	font-size: 14px;
}
.modal-confirm .modal-header {
	border-bottom: none;
	position: relative;
}
.modal-confirm h4 {
	text-align: center;
	font-size: 26px;
	margin: 30px 0 -10px;
}
.modal-confirm .close {
	position: absolute;
	top: -5px;
	right: -2px;
}
.modal-confirm .modal-body {
	color: #999;
}
.modal-confirm .modal-footer {
	border: none;
	text-align: center;
	border-radius: 5px;
	font-size: 13px;
	padding: 10px 15px 25px;
}
.modal-confirm .modal-footer a {
	color: #999;
}
.modal-confirm .icon-box {
	width: 80px;
	height: 80px;
	margin: 0 auto;
	border-radius: 50%;
	z-index: 9;
	text-align: center;
	border: 3px solid #f15e5e;
}
.modal-confirm .icon-box i {
	color: #f15e5e;
	font-size: 46px;
	display: inline-block;
	margin-top: 13px;
}
.modal-confirm .btn, .modal-confirm .btn:active {
	color: #fff;
	border-radius: 4px;
	background: #60c7c1;
	text-decoration: none;
	transition: all 0.4s;
	line-height: normal;
	min-width: 120px;
	border: none;
	min-height: 40px;
	border-radius: 3px;
	margin: 0 5px;
}
.modal-confirm .btn-secondary {
	background: #c1c1c1;
}
.modal-confirm .btn-secondary:hover, .modal-confirm .btn-secondary:focus {
	background: #a8a8a8;
}
.modal-confirm .btn-danger {
	background: #f15e5e;
}
.modal-confirm .btn-danger:hover, .modal-confirm .btn-danger:focus {
	background: #ee3535;
}
.trigger-btn {
	display: inline-block;
	margin: 100px auto;
}

.images-box-dashboard img {
    height: auto;
    width: 100%;
}

.title-box-dashboard {
    margin-bottom: 20px;
    text-align:center;
}


.music-box-dashboard li {
     margin-bottom: 16px;
}


/* PRELOADER START */

.preloader {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 9999;
    background-image: url('<?php echo url('loader/preloader.gif')?>');
    background-repeat: no-repeat;
    background-color: #FFF;
    background-position: center;
}


/* PRELOADER END */

/*.images-box-dashboard {*/
/*    display: flex;*/
/*    flex-wrap: wrap;*/
/*}*/

/*.images-box-dashboard li {*/
/*    flex: 0 0 16.6666666667%;*/
/*    max-width: 16.6666666667%;*/
/*    margin-bottom: 16px;*/
/*}*/

.images-box-dashboard li {
    margin-bottom: 16px;
}

.images-box-dashboard {
    -webkit-column-count: 5;
  -moz-column-count: 5;
  column-count: 5;
  -webkit-column-gap: 1em;
  -moz-column-gap: 1em;
  column-gap: 1em;

}

</style>
<!-- Modal HTML -->
<div id="myModalCustFiles" class="modal fade">
	<div class="modal-dialog modal-confirm">
		<div class="modal-content">
			<div class="modal-header flex-column">
				<div class="icon-box">
				</div>
				<h4 class="modal-title w-100">Are you sure?</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			</div>
			<div class="modal-body">
				 <p>Do you really want to reject these files?</p>
			</div>
			<div class="modal-footer justify-content-center">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
				<button type="button" class="btn btn-danger" id="btnYesModalCustomerTerm">Yes</button>
			</div>
		</div>
	</div>
</div>
<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h4>
           {{ trans('admin.admin') }} <i class="fa fa-angle-right margin-separator"></i> {{ trans_choice('misc.my_clients_requests', 0) }}
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
                    @if(count($gImages) > 0)
                        <div class="">
                            <!-- PRELOADER START -->
                                <div class="preloader"></div>
                            <!-- PRELOADER END -->
                            <h3 class="title-box-dashboard">Images</h3>

                            <ul class="images-box-dashboard" style="list-style: none;">
                                @foreach($gImages as $gimg)
                                <!--//customer_file_name-->
                                <li class="">
                                    <a data-fancybox href="<?php echo url('customer_files/'.$refNo.'/').'/'. $gimg->customer_file_name; ?>">
                					    <img src="<?php echo url('customer_files/'.$refNo.'/').'/'. $gimg->customer_file_name; ?>" alt="" class="photographer-thimbnial">
                					 </a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                      <hr>
                    @endif
                    @if(count($gVideo) > 0)
                          <div class="">
                              <h3 class="title-box-dashboard">Videos</h3>
                            <ul class="images-box-dashboard" style="list-style: none;">
                                @foreach($gVideo as $gvid)
                                <li class="">
                                    <video onmouseover="this.play()" onmouseout="this.pause()" width="100%" height="100%" muted="" loop="">
        							<!--<source src="https://projects.hexawebstudio.com/darquise-nantel/uploads/video/water_mark_large/watermark-person-slicing-fruits-121599847070rke90rxnwv.mp4" type="video/mp4">-->
        							<source src="<?php echo url('customer_files/'.$refNo.'/').'/'. $gvid->customer_file_name; ?>" type="video/mp4">
                            						<!-- <source src="movie.ogg" type="video/ogg"> -->
                            			Your browser does not support the video tag.
                            		</video>
                                </li>
                                @endforeach

                            </ul>
                          </div>
                          <hr>
                      @endif
                      @if(count($gAudio) > 0)
                          <div class="">
                              <h3 class="title-box-dashboard">Music</h3>
                            <ul class="music-box-dashboard" style="list-style: none;">
                                @foreach($gAudio as $gmus)
                                    <li class="">
                                        <div class="BigwaveCustomer d-flex" data-path="<?php echo url('customer_files/'.$refNo.'/') .'/'. $gmus->customer_file_name; ?>">
                                            <div class="align-self-center music-col-2">
                                                <a href="javascript:;" class="btn-music-play" id="BigbatonCustomer-playMusic#<?php echo $gmus->customer_file_name; ?>">
                                                    <i class="fa fa-play" aria-hidden="true"></i>
                                                </a>
                                                <a href="javascript:;" class="btn-music-play" id="BigbatonCustomer-pauseMusic#<?php echo $gmus->customer_file_name; ?>" style="display: none;">
                                                    <i class="fa fa-pause" aria-hidden="true"></i>
                                                </a>
                                            </div>

                                            <div class="wave-container music-col-10"></div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                          </div>
                        <hr>
                        @endif
             <div>
                 <ul class="checkbox" style="list-style: none;">
                     <li>
                        <label><input type="checkbox" id="chkCustTerms" value="">I agree that the artist delivered correct Products and/or Services.</label>
                        <div id="errorCustTermsDiv" style="display:none; color:red;">Please checked this before approving.</div>
                     </li>
                     <li style="margin-top: 30px;">
                       <a href="javascript:;" id="custApprove" class="btn-one-dashboard-new"> Approve </a>
                       <a href="javascript:;" id="custReject" class="btn-one-dashboard-new-2"> Reject </a>
                     </li>
                </ul>
             </div>

              </div><!-- /.box-header -->

                <div class="box-body table-responsive no-padding">




                </div><!-- /.box-body -->
              </div><!-- /.box -->

            </div>
          </div>

          <!-- Your Page Content Here -->

        </section><!-- /.content -->

           <section style="padding: 0px 0px 30px 0px; display:none;" id="sectionUploadFile" >
                <div class="upload-flies-btn">
                    <h4>Upload Customer files</h4>
                    <form id="formCustomerFiles" method="post" action="{{ url('user/dashboard/upload-file-customer') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">

                            <div class="col-lg-6">
                                <input type="file" name="filesUpload[]" class="customUploadFile" multiple>
                                <input type="hidden" id="txtReferenceNo" name="txtReferenceNo">
                            </div>
                            <div class="col-lg-6">
                                <button class="btn btn-success" id="uploadCustomerFiles" style="float:right;">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
           </section>
        <!-- /.content -->
      </div><!-- /.content-wrapper -->
@endsection

@section('javascript')

<script type="text/javascript">
document.addEventListener('contextmenu', event => event.preventDefault());

// document.onkeypress = function (event) {
// event = (event || window.event);
// if (event.keyCode == 123) {
// return false;
// }
// }
// document.onmousedown = function (event) {
// event = (event || window.event);
// if (event.keyCode == 123) {
// return false;
// }
// }
// document.onkeydown = function (event) {
// event = (event || window.event);
// if (event.keyCode == 123) {
// return false;
// }
// }

// PRELOADER START
$(document).ready(function() {

    // setTimeout(function() {
        $('.preloader').fadeOut('slow');
    // }, 1000);
});
// PRELOADER END
///////////////*****//////////////////

    $("#custApprove").click(function(){
        var isCheckTermsCustomer = $('#chkCustTerms:checkbox:checked').length > 0;
        if(isCheckTermsCustomer == false){
            $("#errorCustTermsDiv").show('slow');
            setInterval(function(){
                $("#errorCustTermsDiv").hide('slow');
            }, 3000);
        }

        const baseUrl = '<?php echo url("/") ?>';
        var refNo = '<?php echo $refNo; ?>';
        var customerAction = 'approved';
        $.ajax({
          url: baseUrl + '/user/dashboard/update-customer-action',
          type: 'post',
          data: {"_token": "{{ csrf_token() }}",refNo : refNo, customerAction : customerAction},
          dataType: 'json',
          success:function(resp){
            // location.reload();
            location.href = baseUrl + '/user/dashboard/my-shoots';
          },
          error:function(){
            console.log('error in updating booking status');
          }
        });
    });

    $('button[id^="btnUploadFile#"]').click(function(){
        console.log('clicked');
        var getReferenceNumber = $(this).attr('id').split("#")[1];
        console.log(getReferenceNumber);
        $("#txtReferenceNo").val(getReferenceNumber);
        $("#sectionUploadFile").show();
        $('html, body').animate({
        scrollTop: $("#sectionUploadFile").offset().top
    }, 2000);
    });

  $('select[id^="updateStatus-"]').change(function(){
    let valueId = $(this).attr('id').split('-')[1];
    let value = $(this).val();

    if(value != ""){
      console.log(value);
      $("#myModalCuso .modal-body").empty();
      $("#myModalCuso .icon-box").empty();
      if(value == "cancelled"){
        var msg = '<p> Do you really want to cancel this request.</p>';
        var headIcon = '<i class="fa fa-times"></i>';
      }else if(value == "approved"){
        console.log('in approved');
        alert('in approved');
        var msg = '<p> Do you really want to approve this request.</p>';
        var headIcon = '<i class="fa fa-check"></i>';
      }else if(value == "rejected"){
        var msg = '<p> Do you really want to reject this request.</p>';
        var headIcon = '<i class="fa fa-times"></i>';
      }else if(value == "completed"){
        var msg = '<p> Do you really want to complete this request.</p>';
        var headIcon = '<i class="fa fa-check"></i>';
      }else{
        var msg = '';
        var headIcon = '';
      }

      let hideData = '<input type="hidden" name="shootId" id="shootId" value="'+ valueId +'">';
      let statusValue = '<input type="hidden" name="statusValue" id="statusValue" value="'+ value +'">';
      $("#myModalCuso .modal-body").append(msg);
      $("#myModalCuso .modal-body").append(hideData);
      $("#myModalCuso .modal-body").append(statusValue);
      $("#myModalCuso .icon-box").append(headIcon);
      $("#myModalCuso").modal();

    }
  });

  $('#myModalCuso').on('hidden.bs.modal', function (e) {
    let shootIDValue = $("#shootId").val();
    $('#updateStatus-'+ shootIDValue +' option[value=""]').attr('selected', true);
  });

  $("#btnYesModal").click(function(){
    let shootId = $("#shootId").val();
    let statusVal = $("#statusValue").val();
    let _token   = $('meta[name="_token"]').attr('content');

    console.log(shootId);
    console.log(statusVal);
    const baseUrl = '<?php echo url("/") ?>';
    $.ajax({
      url: baseUrl + '/user/dashboard/update-booking-request-status',
      type: 'post',
      data: {shootId : shootId, statusVal : statusVal, _token : _token },
      dataType: 'json',
      success:function(resp){
        location.reload();
      },
      error:function(){
        console.log('error in updating booking status');
      }
    });
  });

  //Clicked On Reject Button
  $("#custReject").click(function(){
     $("#myModalCustFiles").modal();
  });

  //Clicked Yes Reject Button
  $("#btnYesModalCustomerTerm").click(function(){

      const baseUrl = '<?php echo url("/") ?>';
       var refNo = '<?php echo $refNo; ?>';
        var customerAction = 'rejected';
        $.ajax({
          url: baseUrl + '/user/dashboard/update-customer-action',
          type: 'post',
          data: {"_token": "{{ csrf_token() }}",refNo : refNo, customerAction : customerAction},
          dataType: 'json',
          success:function(resp){
            // location.reload();
            location.href = baseUrl + '/user/dashboard/my-shoots';
          },
          error:function(){
            console.log('error in updating booking status');
          }
        });
  });

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
