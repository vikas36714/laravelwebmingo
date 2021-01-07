@extends('layouts.app')

@section('content')

<section class="breadcrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-xs-12">
                <div class="content-header">
                    <h3 class="content-header-title">Leads</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                        <li class="breadcrumb-item">Leads</li>
                        <li class="breadcrumb-item active">Manage Leads</li>
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
                <div class="card">
                    <div class="card-body">
                        <div class="card-block">
                            <div class="table-responsive">
                                <table class="table table-bordered table-fitems" id="order_tbl">
                                    <thead>
                                        <tr>
                                            <th>Sr. No.</th>
                                            <th>Created at</th>
                                            <th>Lead ID</th>
                                            <th>User</th>
                                            <th>Vendor</th>
                                            <th>Package</th>
                                            <th>Amount</th>
                                            <th>Payment Status</th>
                                            <th>Lead Status</th>
                                            <th>Updated at</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
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
<div class="modal" id="package-info">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">View Package</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-4">
                        <label class="content-label">Category</label>
                        <h3 class="content-head" id="category"></h3>
                    </div>
                    <div class="col-sm-4">
                        <label class="content-label">Sub Category</label>
                        <h3 class="content-head" id="sub_category"></h3>
                    </div>
                    <div class="col-sm-4">
                        <label class="content-label">Sub Sub</label>
                        <h3 class="content-head" id="sub_sub_category"></h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-8">
                        <label class="content-label">Package Name</label>
                        <h3 class="content-head" id="package"></h3>
                    </div>
                    <div class="col-sm-4">
                        <label class="content-label">Price</label>
                        <h3 class="content-head" id="price"><i class="fas fa-rupee-sign"></i></h3>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table-bordered table">
                        <thead>
                            <tr>
                                <th>Sr. No.</th>
                                <th>Service</th>
                                <th>Amount (<i class="fas fa-rupee-sign"></i>)</th>
                            </tr>
                        </thead>
                        <tbody id="service_tbl">

                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="2" class="text-right">Sub Amount</th>
                                <th id="sub_total"></th>
                            </tr>
                            <tr class="text-success">
                                <th colspan="2" class="text-right">Discount</th>
                                <th id="discount"> </th>
                            </tr>
                            <tr>
                                <th colspan="2" class="text-right">Discounted Amount</th>
                                <th id="discounted_amount"> </th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal" id="assign-vendor">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Assign to Vendor</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div class="form-group row justify-content-center">
                    <div class="col-sm-6">
                        <label class="label label-control">Vendor</label>
                        <select class="text-control">
                            <option>Select Vendor</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12 text-center">
                        <button class="btn btn-dark" type="submit">Assign to Vendor</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal" id="payment-info">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Payment Information</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th>Date &amp; Time</th>
                                <td>12.10.2020 12:00PM</td>
                                <th>Payment Status</th>
                                <td>Success</td>
                            </tr>
                            <tr>
                                <th>Payment Mode</th>
                                <td>Wallet</td>
                                <th>Transaction ID</th>
                                <td>34738974389</td>
                            </tr>
                            <tr>
                                <th>Amount</th>
                                <td><i class="fas fa-rupee-sign"></i> 1200</td>
                                <th>Avail. Balance</th>
                                <td><i class="fas fa-rupee-sign"></i> 1200</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@push('scripts')
<script type="text/javascript">
    $(function () {

        var table = $('#order_tbl').DataTable({
            processing: true,
            serverSide: true,
            ajax: "",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'created_at',
                    name: 'created_at'
                },
                {
                    data: 'order_number',
                    name: 'order_number'
                },
                {
                    data: 'user',
                    name: 'user'
                },
                {
                    data: 'vendor_id',
                    name: 'vendor_id'
                },
                {
                    data: 'package',
                    name: 'package'
                },
                {
                    data: 'total_amount',
                    name: 'total_amount'
                },
                {
                    data: 'payment_status',
                    name: 'payment_status'
                },
                {
                    data: 'order_status',
                    name: 'order_status'
                },
                {
                    data: 'updated_at',
                    name: 'updated_at'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: true,
                    searchable: true
                },
            ]
        });

        //-------------------- Get Package Details ----------------------//
        $('body').on('click', '#package_details', function () {
            var package_id = $(this).data('id');

            $.ajax({
                url: "{{route('vendor.manage-order.get-package-details')}}",
                type: "GET",
                data: {'package_id': package_id},
                dataType: 'json',
                success: function (data) {
                    $('#category').text(data.category_name);
                    $('#sub_category').text(data.category_name);
                    $('#sub_sub_category').text(data.sub_sub_category_name);
                    $('#package').text(data.name);
                    $('#price').text(data.amount);
                    var trHTML = '';
                    var sr_no=1;
                    var sub_total = 0;
                    $.each(data.services, function (i, service) {
                        trHTML += '<tr><td>'  + sr_no++ + '</td><td>' + service.service_name + '</td><td>' + '<i class="fas fa-rupee-sign"></i> ' +service.service_amount + '</td></tr>';
                        sub_total += parseFloat(service.service_amount);
                    });
                    $('#service_tbl').append(trHTML);
                    $('#sub_total').html('<i class="fas fa-rupee-sign"></i> '+sub_total);
                    // $('#discount').html('<i class="fas fa-rupee-sign"></i> ('+data.discount+')%');
                    // $('#discounted_amount').html('<i class="fas fa-rupee-sign"></i> '+data.after_discount);
                },
                error: function (data) {
                    console.log('error..')
                }
            });
        });

    });
</script>
@endpush
