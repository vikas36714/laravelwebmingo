@extends('layouts.app')

@section('content')

<section class="breadcrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-xs-12">
                <div class="content-header">
                    <h3 class="content-header-title">Vendor Loan</h3>
                    <button class="btn btn-dark btn-save" data-target="#apply-new-loan" data-toggle="modal"
                        type="button"><i class="fas fa-plus"></i> Apply New Loan</button>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                        <li class="breadcrumb-item">Vendors</li>
                        <li class="breadcrumb-item active">Manage Vendor Loan</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="content-main-body">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                @if (session('message'))
                <div class="alert alert-success" role="alert">{{ session('message') }}</div>
                @elseif(session('error'))
                <div class="alert alert-danger" role="alert">{{ session('error') }}</div>
                @endif
                <span id="message"></span>
                <div class="card">
                    <div class="card-body">
                        <div class="card-block">
                            <div class="table-responsive">
                                <table class="table table-bordered table-fitems">
                                    <thead>
                                        <tr>
                                            <th>Sr. No.</th>
                                            <th>Created at</th>
                                            <th>Loan ID</th>
                                            <th>Vendor ID</th>
                                            <th>Loan Amount</th>
                                            <th>Loan Remaining</th>
                                            <th>Deduction (%)</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{! $n=1 }}
                                        @foreach ($vendorLoans as $vendorLoan)
                                        <tr>
                                            <td>{{$n++}}</td>
                                            <td>{{$vendorLoan->created_at}}</td>
                                            <td>{{$vendorLoan->loan_id}}</td>
                                            <td><a href="#" id="view-vendor-details"
                                                    data-id="{{$vendorLoan->vendor_id}}" data-target="#vendor-info"
                                                    data-toggle="modal">
                                                    {{$vendorLoan->vendor_id}}</a></td>
                                            <td><i class="fas fa-rupee-sign"></i>{{$vendorLoan->loan_amount}}</td>
                                            <td><i class="fas fa-rupee-sign"></i>{{$vendorLoan->loan_remaining}}</td>
                                            <td>{{$vendorLoan->deduction}}%</td>
                                            <td>
                                                @if($vendorLoan->status == 'pending')
                                                <span class="badge badge-warning">Pending</span>
                                                @endif
                                                @if($vendorLoan->status == 'active')
                                                <span class="badge badge-secondary">Active</span>
                                                @endif
                                                @if($vendorLoan->status == 'completed')
                                                <span class="badge badge-success">Completed</span>
                                                @endif
                                            </td>
                                            <td>
                                                <ul class="action">
                                                    <li><a href="#" data-id="{{$vendorLoan->loan_id}}"
                                                            data-target="#edit-loan" id="get-loan" data-toggle="modal"
                                                            title="Edit Loan"><i class="fas fa-pencil-alt"></i></a></li>
                                                    <li><a href="{{route('admin.vendor-loan-history', $vendorLoan->vendor_id)}}"
                                                            title="Loan History"><i class="fas fa-history"></i></a></li>
                                                </ul>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<div class="modal" id="vendor-info">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Vendor Info</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-4">
                        <label class="content-label">Vendor Name</label>
                        <h3 class="content-head" id="vendor_name"></h3>
                    </div>
                    <div class="col-sm-4">
                        <label class="content-label">Vendor Email</label>
                        <h3 class="content-head" id="vendor_email"></h3>
                    </div>
                    <div class="col-sm-4">
                        <label class="content-label">Mobile No.</label>
                        <h3 class="content-head" id="vendor_mobile_number"></h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <label class="content-label">Address</label>
                        <h3 class="content-head" id="vendor_address"></h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <label class="content-label">State</label>
                        <h3 class="content-head" id="vendor_state"></h3>
                    </div>
                    <div class="col-sm-4">
                        <label class="content-label">City</label>
                        <h3 class="content-head" id="vendor_city"></h3>
                    </div>
                    <div class="col-sm-4">
                        <label class="content-label">Pincode</label>
                        <h3 class="content-head" id="vendor_pincode"></h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="apply-new-loan">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="add_loan_form" method="post" action="javascript:void(0)">
                @csrf
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Apply New Loan</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <label class="label-control">Vendor ID</label>
                            <input type="text" name="vendor_id" id="vendor_id" class="form-control vendor_id"
                                placeholder="Enter Vendor ID">
                            <span class="vendor_valid"></span>
                        </div>

                        <div class="col-sm-6 align-self-end">
                            <button id="validate_btn" class="btn btn-dark btn-sm">Validate</button>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-12">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <tr>
                                        <th>Vendor Name</th>
                                        <th>Email</th>
                                        <th>State</th>
                                        <th>City</th>
                                    </tr>
                                    <!-- Binding vendor data-->
                                    <tbody id="vendor_data"></tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-6">
                            <label class="label-control">Loan Amount</label>
                            <input type="number" name="loan_amount" id="loan_amount" placeholder="Enter Loan Amount"
                                class="form-control loan_amount" disabled>
                        </div>
                        <div class="col-sm-6">
                            <label class="label-control">Deduction (%)</label>
                            <input type="number" name="deduction" id="deduction" placeholder="Enter in %"
                                class="form-control deduction" disabled>
                            <span class="noted-text">Deduction in every successfull booking.</span>
                        </div>
                        <span id="loan_remaining"></span>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-12">
                            <label class="label-control">Loan Details</label>
                            <textarea cols="4" name="loan_details" id="loan_details" rows="2"
                                placeholder="Detail here.." class="form-control loan_details" disabled></textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-12 text-center">
                            <button class="btn btn-dark" id="apply_loan" type="submit" disabled>Apply Now</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal" id="edit-loan">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Edit Loan</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form id="edit_loan_form" method="post" action="javascript:void(0)">
                    @csrf
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <label class="label-control">Vendor ID</label>
                            <input type="text" name="vendor_id" id="edit_vendor_id" class="form-control" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-12">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <tr>
                                        <th>Vendor Name</th>
                                        <th>Email</th>
                                        <th>State</th>
                                        <th>City</th>
                                    </tr>
                                    <!-- Binding vendor data-->
                                    <tbody id="tbl_in_edit_vendor"></tbody>

                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-6">
                            <label class="label-control">Loan Amount</label>
                            <input type="number" name="loan_amount" id="edit_loan_amount" readonly class="form-control">
                        </div>
                        <div class="col-sm-6">
                            <label class="label-control">Deduction (%)</label>
                            <input type="number" name="deduction" id="edit_deduction" placeholder="Enter in %"
                                class="form-control">
                            <span class="noted-text">Deduction in every successfull booking.</span>
                            <span id="edit_loan_remaining"></span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-12">
                            <label class="label-control">Loan Details</label>
                            <textarea cols="4" rows="2" name="loan_details" id="edit_loan_details"
                                placeholder="Detail here.." class="form-control"></textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-12 text-center">
                            <input type="hidden" name="loan_id" id="loan_id">
                            <button class="btn btn-dark" type="submit" id="update_loan">Update Loan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script type="text/javascript">
    //-------------------- Check Vendor Exist or not ----------------------//
    $('body').on('click', '#validate_btn', function () {
        var vendor_id = $('#vendor_id').val();
        $('#vendor_data').empty(); // emplty city old value
        $.ajax({
            url: "{{url('admin/dashboard/vendor-loan/check-vendor-exist')}}",
            type: "GET",
            data: {
                vendor_id: vendor_id
            },
            dataType: 'json',
            success: function (data) {
                $('.vendor_valid').html('<h5>Vendor is Valid</h5>').css('color', 'green');
                var trHTML = '';
                trHTML += '<tr><td>' + data.first_name + ' ' + data.last_name + '</td><td>' + data
                    .email + '</td><td>' + data.state + '</td><td>' + data.city + '</td></tr>';
                $('#vendor_data').append(trHTML);
                $('#loan_amount').prop('disabled', false)
                $('#deduction').prop('disabled', false)
                $('#loan_details').prop('disabled', false)
                $('#apply_loan').prop('disabled', false)
            },
            error: function (data) {
                $('.vendor_valid').html('<h5>Vendor is Not Valid</h5>').css('color', 'red');
                $('#loan_amount').prop('disabled', true)
                $('#deduction').prop('disabled', true)
                $('#loan_details').prop('disabled', true)
                $('#apply_loan').prop('disabled', true)
            }
        });
    });

    //-------------------- Loan Apply Code ----------------------//
    $('body').on('click', '#apply_loan', function (e) {
        e.preventDefault()
        $.ajax({
            url: "{{route('admin.vendor-loan.store')}}",
            type: "POST",
            data: $('#add_loan_form').serialize(),
            dataType: 'json',
            success: function (data) {
                $('#apply-new-loan').modal('hide');
                document.getElementById("add_loan_form").reset();
                $('#vendor_data').empty();
                $('.vendor_valid').empty();
                $('#message').html(
                    '<div class="alert alert-success" role="alert">Loan Applied Succesfully</div>'
                    );
                if (data) {
                    location.reload();
                }
            },
            error: function (data) {
                $('#apply-new-loan').modal('hide');
                $('#message').html(
                    '<div class="alert alert-danger" role="alert">Loan Not Applied, Somthing Went Wrong !!</div>'
                    );
            }
        });
    });

    //--------------------Get Loan Remaining After Diduction from Loan Amount --------------------//
    $('#loan_amount,#deduction').on('keyup', function () {
        var loan_amount = $('#loan_amount').val();
        var deduction = $('#deduction').val();
        var loan_remaining = loan_amount - (loan_amount * (deduction / 100));
        $("#loan_remaining").html('<input type="hidden" name="loan_remaining" value="' + loan_remaining +
            '" />')
    });

    //-------------------- Get Loan Details ----------------------//
    $('body').on('click', '#get-loan', function () {
        $('#tbl_in_edit_vendor').empty();
        $.ajax({
            url: "{{url('admin/dashboard/vendor-loan/get-vendor-loan')}}" + '/' + $(this).data('id'),
            type: "GET",
            dataType: 'json',
            success: function (data) {
                //$('.vendor_valid').html('<h5>Vendor is Valid</h5>').css('color', 'green');
                var trHTML = '';
                trHTML += '<tr><td>' + data.vendorLoan.name + '</td><td>' + data.vendorLoan.email +
                    '</td><td>' + data.vendorDetails.state + '</td><td>' + data.vendorDetails.city +
                    '</td></tr>';
                $('#tbl_in_edit_vendor').append(trHTML);
                $('#edit_vendor_id').val(data.vendorLoan.vendor_id);
                $('#loan_id').val(data.vendorLoan.loan_id);
                $('#edit_loan_amount').val(data.vendorLoan.loan_amount);
                $('#edit_deduction').val(data.vendorLoan.deduction);
                $('#edit_loan_details').val(data.vendorLoan.loan_details);
            },
            error: function (data) {
                console.log('error..')
            }
        });
    });

    //---------Get Loan Remaining After Diduction from Loan Amount in EDit Loan Form ---------//
    $('#edit_deduction').on('keyup', function () {
        var edit_loan_amount = $('#edit_loan_amount').val();
        var edit_deduction = $('#edit_deduction').val();
        var loan_remaining = edit_loan_amount - (edit_loan_amount * (edit_deduction / 100));
        $("#edit_loan_remaining").html('<input type="hidden" name="loan_remaining" value="' + loan_remaining +
            '" />')
    });

    //-------------------- Update Loan Code ----------------------//
    $('body').on('click', '#update_loan', function (e) {
        e.preventDefault()
        $.ajax({
            url: "{{route('admin.vendor-loan.update')}}",
            type: "POST",
            data: $('#edit_loan_form').serialize(),
            dataType: 'json',
            success: function (data) {
                $('#edit-loan').modal('hide');
                document.getElementById("edit_loan_form").reset();
                $('#vendor_data').empty();
                $('#message').html(
                    '<div class="alert alert-success" role="alert">Loan Applied Updated</div>');
                if (data) {
                    location.reload();
                }
            },
            error: function (data) {
                $('#edit-loan').modal('hide');
                $('#message').html(
                    '<div class="alert alert-danger" role="alert">Loan Applied Not Updated, Somthing Went Wrong !!</div>'
                    );
            }
        });
    });
</script>
@endpush
