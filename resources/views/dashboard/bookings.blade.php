@extends('dashboard.layout')

@section('content')
    <style>
        .help-tip {
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

        .help-tip:before {
            content: '?';
            font-weight: bold;
            color: #fff;
        }

        .help-tip:hover p {
            display: block;
            transform-origin: 100% 0%;

            -webkit-animation: fadeIn 0.3s ease-in-out;
            animation: fadeIn 0.3s ease-in-out;

        }

        .help-tip p { /* The tooltip */
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

        .help-tip p:before { /* The pointer of the tooltip */
            position: absolute;
            content: '';
            width: 0;
            height: 0;
            border: 6px solid transparent;
            border-bottom-color: #1E2021;
            right: 10px;
            top: -12px;
        }

        .help-tip p:after { /* Prevents the tooltip from being hidden */
            width: 100%;
            height: 40px;
            content: '';
            position: absolute;
            top: -40px;
            left: 0;
        }

        /* CSS animation */

        @-webkit-keyframes fadeIn {
            0% {
                opacity: 0;
                transform: scale(0.6);
            }

            100% {
                opacity: 100%;
                transform: scale(1);
            }
        }

        @keyframes fadeIn {
            0% {
                opacity: 0;
            }
            100% {
                opacity: 100%;
            }
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
    </style>
    <!-- Modal HTML -->
    <div id="myModalCuso" class="modal fade">
        <div class="modal-dialog modal-confirm">
            <div class="modal-content">
                <div class="modal-header flex-column">
                    <div class="icon-box">
                    </div>
                    <h4 class="modal-title w-100">Are you sure?</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <!-- <p>Do you really want to delete these records? This process cannot be undone.</p> -->
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <button type="button" class="btn btn-danger" id="btnYesModal">Yes</button>
                </div>
            </div>
        </div>
    </div>

    <div id="myModalPayment" class="modal fade">
        <div class="modal-dialog modal-confirm">
            <div class="modal-content">
                <div class="modal-header flex-column">

                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <label>Paypal Email</label>

                    <input type="hidden" name="paymentrefNo" id="paymentrefNo" class="form-control">
                    <input type="text" name="paypal_email" id="paypal_email" class="form-control"
                           placeholder="Please provide paypal email for payment">
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="btnYesModalPaymentArtist">Submit</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h4>
                {{ trans('admin.admin') }} <i
                    class="fa fa-angle-right margin-separator"></i> {{ trans_choice('misc.my_clients_requests', 0) }}
                ({{ count($data) }})
            </h4>
        </section>

        <!-- Main content -->
        <section class="content">

            @if(Session::has('info_message'))
                <div class="alert alert-warning">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <i class="fa fa-warning margin-separator"></i> {{ Session::get('info_message') }}
                </div>
            @endif

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

                                        <th class="active">{{ trans('admin.req_date') }}</th>
                                        <th class="active">{{ trans('admin.status') }}</th>
                                        <th colspan="2" class="active">{{ trans('admin.actions') }}</th>
                                        <th colspan="1" class="active">{{ 'Payment Status' }}</th>
                                        <th class="active">{{ 'View Reviews' }}
                                            <div class="help-tip">
                                                <p>Review link will be show when status is completed.</p>
                                            </div>
                                        </th>
                                    </tr>

                                    @foreach( $data as $shoots )
                                        <tr>
                                            <td>{{ $shoots->id }}</td>
                                            <td>{{ $shoots->reference_no }}</td>
                                            @php
                                                $getCityName = DB::table('new_cities')->where('id','=',$shoots->city_id)->first();
                                            @endphp
                                            <td>{{ $getCityName->name }}</td>
                                            <td>
                                                @php
                                                    if($shoots->country_id)
                                                        $getCountryName = \App\Models\NewCountries::where('id','=',$shoots->country_id)->first();
                                                @endphp
                                                {{($shoots->country_id?$getCountryName->name:'')}}</td>
                                            @php
                                                $getUserName = \App\Models\User::where('id','=',$shoots->customer_id)->first();
                                            @endphp
                                            <td>{{ $getUserName ? $getUserName->username : 'N/A' }}</td>

                                            <td>{{ App\Helper::formatDate($shoots->requested_date) }}
                                                - {{ $shoots->requested_time }} (preferred)
                                            </td>

                                            <?php if ($shoots->status == 'pending') {
                                                $mode = 'warning';
                                                $_status = trans('admin.pending');
                                            } elseif ($shoots->status == 'approved') {
                                                $mode = 'success';
                                                $_status = $shoots->status;
                                            } elseif ($shoots->status == 'rejected') {
                                                $mode = 'danger';
                                                $_status = $shoots->status;
                                            } elseif ($shoots->status == 'cancelled') {
                                                $mode = 'danger';
                                                $_status = $shoots->status;
                                            } else {
                                                $mode = 'success';
                                                $_status = $shoots->status;
                                            }

                                            ?>
                                            <td><span class="label label-{{$mode}}">{{ $_status }}</span></td>
                                            @if($shoots->status == "pending")
                                                <td>
                                                    <select class="form-control" id="updateStatus-{{ $shoots->id }}"
                                                            name="updateStatus">
                                                        <option value="">Select ..</option>
                                                        <option value="approved">Approved</option>
                                                        <option value="rejected">Rejected</option>
                                                        <!-- <option value="completed">Completed</option> -->
                                                    </select>
                                                </td>
                                            @elseif($shoots->status == "approved" && $shoots->isPaid == '1')
                                                <td>
                                                    <select class="form-control" id="updateStatus-{{ $shoots->id }}"
                                                            name="updateStatus">
                                                        <option value="">Select ..</option>
                                                        <option value="completed">Completed</option>
                                                    </select>
                                                </td>
                                            @else
                                                <td></td>
                                            @endif
                                            <td>
                                                <a class="" role="button" data-toggle="collapse"
                                                   href="#collapseExample<?php echo $shoots->reference_no; ?>"
                                                   aria-expanded="false"
                                                   aria-controls="collapseExample<?php echo $shoots->reference_no; ?>">
                                                    Options
                                                </a>
                                                <div class="collapse"
                                                     id="collapseExample<?php echo $shoots->reference_no; ?>">
                                                    <ul class="well" style="padding:10px; list-style: none;">

                                                        @if($shoots->status == "completed" && $shoots->isCustomerAction == "rejected")
                                                            <li style="margin-bottom:10px;">
                                                                <button class="btn btn-success btn-sm padding-btn"
                                                                        id="btnUploadFile#{{ $shoots->reference_no }}">
                                                                    Upload Files
                                                                </button>
                                                            </li>
                                                        @endif
                                                        @if($shoots->isCustomerAction == "approved")
                                                            @if($shoots->isArtistPaymentRequest == "1")
                                                                <li style="margin-bottom:10px;">
                                                                    <button disabled
                                                                            class="btn btn-success btn-sm padding-btn">
                                                                        Payment Requested
                                                                    </button>
                                                                </li>
                                                            @else
                                                                <li style="margin-bottom:10px;">
                                                                    <button class="btn btn-success btn-sm padding-btn"
                                                                            id="paymentRequest#{{ $shoots->reference_no }}">
                                                                        Payment Request
                                                                    </button>
                                                                </li>
                                                            @endif
                                                        @endif
                                                        <li style="margin-bottom:10px;">
                                                            <a href="{{ url('user/dashboard/my-bookings-details', $shoots->id) }}"
                                                               class="btn btn-success btn-sm padding-btn"
                                                               target="_blank">
                                                                <i class="fa fa-eye myicon-right "></i> {{ trans('admin.view_detail') }}
                                                            </a>
                                                        </li>
                                                        <li style="margin-bottom:10px;">
                                                            <start-chat :receiver-id="{{ $shoots->customer_id }}"
                                                                        :current-user="{{ (Auth::user() != null) ? Auth::user() : '' }}"
                                                                        style="width: 100%">
                                                            </start-chat>

                                                        </li>

                                                    </ul>
                                                </div>
                                            </td>
                                            <?php
                                            if($shoots->status == "approved" || $shoots->status == "completed"){
                                            ?>
                                            <td>
                                                <?php
                                                if ($shoots->isPaid == 1) {
                                                    echo 'Paid';
                                                } else {
                                                    echo 'Not Paid';
                                                }
                                                ?>
                                            </td>
                                            <?php
                                            }else{
                                            ?>
                                            <td>------</td>
                                            <?php
                                            }
                                            ?>
                                            @if($shoots->status == "completed" && $shoots->isReviewGiven == "1")
                                                <td>
                                                    <a href="{{ url('user/dashboard/view-review', $shoots->id) }}"
                                                       class="" target="_blank">
                                                        <i class="fa fa-eye myicon-right "></i> {{ 'View' }}
                                                    </a>
                                                </td>
                                            @elseif($shoots->status == "completed" && $shoots->isReviewGiven == "0")
                                                <td>

                                                    No review given yet.
                                                </td>
                                            @else
                                                <td>
                                                    ---------
                                                </td>
                                            @endif

                                        </tr><!-- /.TR -->
                                    @endforeach

                                @else
                                    <h3 class="text-center no-found">{{ trans('misc.no_results_found') }}</h3>

                                    @if( isset( $query ) || isset( $sort )  )
                                        <div class="col-md-12 text-center padding-bottom-15">
                                            <a href="{{url('user/dashboard/my-shoots')}}"
                                               class="btn btn-sm btn-danger">{{ trans('auth.back') }}</a>
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

        <section style="padding: 0px 0px 30px 0px; display:none;" id="sectionUploadFile">
            <div class="upload-flies-btn">
                <h4>Upload Customer files</h4>
                <form id="formCustomerFiles" method="post" action="{{ url('user/dashboard/upload-file-customer') }}"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="row">

                        <div class="col-lg-6">
                            <input type="file" name="filesUpload[]" class="customUploadFile" multiple>
                            <input type="hidden" id="txtReferenceNo" name="txtReferenceNo">
                        </div>
                        <div class="col-lg-6">
                            <button class="btn btn-success" id="uploadCustomerFiles" style="float:right;">Submit
                            </button>
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

        $('button[id^="btnUploadFile#"]').click(function () {
            console.log('clicked');
            var getReferenceNumber = $(this).attr('id').split("#")[1];
            console.log(getReferenceNumber);
            $("#txtReferenceNo").val(getReferenceNumber);
            $("#sectionUploadFile").show();
            $('html, body').animate({
                scrollTop: $("#sectionUploadFile").offset().top
            }, 2000);
        });

        $('select[id^="updateStatus-"]').change(function () {
            let valueId = $(this).attr('id').split('-')[1];
            let value = $(this).val();

            if (value != "") {
                console.log(value);
                $("#myModalCuso .modal-body").empty();
                $("#myModalCuso .icon-box").empty();
                if (value == "cancelled") {
                    var msg = '<p> Do you really want to cancel this request.</p>';
                    var headIcon = '<i class="fa fa-times"></i>';
                } else if (value == "approved") {
                    console.log('in approved');
                    alert('in approved');
                    var msg = '<p> Do you really want to approve this request.</p>';
                    var headIcon = '<i class="fa fa-check"></i>';
                } else if (value == "rejected") {
                    var msg = '<p> Do you really want to reject this request.</p>';
                    var headIcon = '<i class="fa fa-times"></i>';
                } else if (value == "completed") {
                    var msg = '<p> Do you really want to complete this request.</p>';
                    var headIcon = '<i class="fa fa-check"></i>';
                } else {
                    var msg = '';
                    var headIcon = '';
                }

                let hideData = '<input type="hidden" name="shootId" id="shootId" value="' + valueId + '">';
                let statusValue = '<input type="hidden" name="statusValue" id="statusValue" value="' + value + '">';
                $("#myModalCuso .modal-body").append(msg);
                $("#myModalCuso .modal-body").append(hideData);
                $("#myModalCuso .modal-body").append(statusValue);
                $("#myModalCuso .icon-box").append(headIcon);
                $("#myModalCuso").modal();

            }
        });

        $('#myModalCuso').on('hidden.bs.modal', function (e) {
            let shootIDValue = $("#shootId").val();
            $('#updateStatus-' + shootIDValue + ' option[value=""]').attr('selected', true);
        });

        $("#btnYesModal").click(function () {
            let shootId = $("#shootId").val();
            let statusVal = $("#statusValue").val();
            let _token = $('meta[name="_token"]').attr('content');

            console.log(shootId);
            console.log(statusVal);
            const baseUrl = '<?php echo url("/") ?>';
            $.ajax({
                url: baseUrl + '/user/dashboard/update-booking-request-status',
                type: 'post',
                data: {shootId: shootId, statusVal: statusVal, _token: _token},
                dataType: 'json',
                success: function (resp) {
                    location.reload();
                },
                error: function () {
                    console.log('error in updating booking status');
                }
            });
        });

        $(document).on('change', '#sort', function () {
            $('#formSort').submit();
        });

        $('button[id^="paymentRequest#"]').click(function () {
            var getReferenceNo = $(this).attr('id').split('#')[1];
            console.log(getReferenceNo);
            $("#paymentrefNo").val(getReferenceNo);
            $("#myModalPayment").modal();

        });

        $("#btnYesModalPaymentArtist").click(function () {
            const baseUrl = '<?php echo url("/") ?>';
            let _token = $('meta[name="_token"]').attr('content');

            var paypalEmail = $("#paypal_email").val();
            var refNo = $("#paymentrefNo").val();


            $.ajax({
                url: baseUrl + '/user/dashboard/artist-payment-request',
                type: 'post',
                data: {refNo: refNo, paypalEmail: paypalEmail, _token: _token},
                dataType: 'json',
                success: function (resp) {
                    location.reload();
                },
                error: function () {
                    console.log('error in updating booking status');
                }
            });
        });

        $(".actionDelete").click(function (e) {
            e.preventDefault();

            var element = $(this);
            var id = element.attr('data-url');
            var form = $(element).parents('form');

            element.blur();

            swal(
                {
                    title: "{{trans('misc.delete_confirm')}}",
                    type: "warning",
                    showLoaderOnConfirm: true,
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "{{trans('misc.yes_confirm')}}",
                    cancelButtonText: "{{trans('misc.cancel_confirm')}}",
                    closeOnConfirm: false,
                },
                function (isConfirm) {
                    if (isConfirm) {
                        form.submit();
                        //$('#form' + id).submit();
                    }
                });


        });
    </script>
@endsection
