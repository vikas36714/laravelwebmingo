@extends('layouts.app')

@section('content')
<section class="breadcrumb-section">
    <div class="container">
      <div class="row">
        <div class="col-md-12 col-xs-12">
          <div class="content-header">
            <h3 class="content-header-title">Lead Status</h3>
            <button class="btn btn-dark btn-save" type="button" data-target="#add-lead-status" data-toggle="modal"><i class="fas fa-plus"></i> Add Status</button>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="manage-leads.php">Manage Leads</a></li>
              <li class="breadcrumb-item active">Manage Lead Status</li>
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
                <div class="alert alert-success" role="alert">
                    {{ session('message') }}
                </div>
            @elseif(session('error'))
                <div class="alert alert-danger" role="alert">
                    {{ session('error') }}
                </div>
            @endif
          <table class="table table-bordered th-head">
            <tbody>
              <tr>
                <th>Order Id</th>
                <th>Package</th>
                <th>Payment Status</th>
                <th>Order Status</th>
                <th>Order Total</th>
                <th>Vendor</th>
              </tr>
              <tr>
                <td>{{$order->order_number}}</td>
                <td><a href="#" data-target="#package-info" data-toggle="modal">{{$order->cart_details}}</a></td>
                <td><a href="#" data-target="#payment-info" data-toggle="modal"><span class="badge badge-success">Success</span></a></td>
                <td><span class="badge badge-warning">{{$order->order_status}}</span></td>
                <td><i class="fa fa-inr"></i>106</td>
                <td>{{$order->vendor_first_name}} {{$order->vendor_last_name}}<br>
                    {{$order->vendor_email}}</td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="col-sm-12">
          <div class="card">
            <div class="card-body">
              <div class="card-block">
                <div class="table-responsive">
                  <table class="table table-bordered table-fitems forall">
                    <thead>
                      <tr>
                        <th>Sr. No.</th>
                        <th>Created at</th>
                        <th>Order Status</th>
                        <th>Added By</th>
                        <th>Remark</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>01</td>
                        <td>12.10.2020 12:10PM</td>
                        <td>Confirmed</td>
                        <td>Admin</td>
                        <td>-</td>
                      </tr>
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
              <h3 class="content-head">Salon</h3>
            </div>
            <div class="col-sm-4">
              <label class="content-label">Sub Category</label>
              <h3 class="content-head">HairCut</h3>
            </div>
            <div class="col-sm-4">
              <label class="content-label">Sub Sub</label>
              <h3 class="content-head">For Men</h3>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-8">
              <label class="content-label">Package Name</label>
              <h3 class="content-head">Gold</h3>
            </div>
            <div class="col-sm-4">
              <label class="content-label">Price</label>
              <h3 class="content-head"><i class="fas fa-rupee-sign"></i> 1200</h3>
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
              <tbody>
                <tr>
                  <td>01</td>
                  <td>Hair Cut</td>
                  <td><i class="fas fa-rupee-sign"></i> 1200</td>
                </tr>
                <tr>
                  <td>02</td>
                  <td>Shave</td>
                  <td><i class="fas fa-rupee-sign"></i> 1200</td>
                </tr>
                <tr>
                  <td>03</td>
                  <td>D-Tan</td>
                  <td><i class="fas fa-rupee-sign"></i> 1200</td>
                </tr>
              </tbody>
              <tfoot>
                <tr>
                  <th colspan="2" class="text-right">Sub Amount</th>
                  <th><i class="fas fa-rupee-sign"></i> 1200</th>
                </tr>
                <tr class="text-success">
                  <th colspan="2" class="text-right">Discount</th>
                  <th><i class="fas fa-rupee-sign"></i> 80 (10%)</th>
                </tr>
                <tr>
                  <th colspan="2" class="text-right">Discounted Amount</th>
                  <th><i class="fas fa-rupee-sign"></i> 1120</th>
                </tr>
              </tfoot>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="modal" id="add-lead-status">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Add Lead Status</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <form action="{{ route('vendor.manage-order-status.store') }}" method="POST" enctype="multipart/form-data" >
            @csrf
        <div class="form-group row">
          <div class="col-sm-12">
            <label class="label-control label">Order Status</label>
            <select class="form-control" name="order_status">
              <option value="">Select Order Status</option>
              <option value="new">New</option>
              <option value="confirm">Confirm</option>
              <option value="accepted">Accepted</option>
              <option value="ongoing">Ongoing</option>
              <option value="completed">Completed</option>
              <option value="cancelled">Cancelled</option>
            </select>
          </div>
        </div>
        <div class="form-group row">
          <div class="col-sm-12">
            <label class="label-control label">Remark</label>
            <input type="text" name="remark" class="form-control" placeholder="Enter Remark">
          </div>
        </div>
        <div class="form-group row">
          <div class="col-sm-12 text-center">
              <input type="hidden" value="{{$order->id}}" name="order_id">
            <button type="submit" class="btn btn-dark">Add Status</button>
          </div>
        </div>
    </form>
      </div>
    </div>
  </div>
@endsection
@push('scripts')

@endpush
