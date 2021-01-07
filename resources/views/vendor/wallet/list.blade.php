@extends('layouts.app')

@section('content')

<section class="breadcrumb-section">
    <div class="container">
      <div class="row">
        <div class="col-md-12 col-xs-12">
          <div class="content-header">
            <h3 class="content-header-title">Vendors</h3>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
              <li class="breadcrumb-item">Vendor Wallet</li>
              <li class="breadcrumb-item active">Wallet History</li>
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
                          <table class="table-bordered table-fitems table">
                              <thead>
                                  <tr>
                                      <th>Date &amp; Time</th>
                                      <th>Vendor ID</th>
                                      <th>Avail. Wallet</th>
                                      <th>Loan / Remaining Loan</th>
                                      <th>Last Transaction</th>
                                      <th>Status</th>
                                  </tr>
                              </thead>

                              <tbody>
                                  <tr>
                                      <td>12.10.2020 12:00PM</td>
                                      <td><a href="#" data-target="#vendor-info" data-toggle="modal">ST-LUC-0001</a></td>
                                      <td><i class="fas fa-rupee-sign"></i> 1200</td>
                                      <td><i class="fas fa-rupee-sign"></i> 8000 / 6000</td>
                                      <td><i class="fas fa-rupee-sign"></i> 80</td>
                                      <td><span class="badge badge-success">Active</span></td>
                                  </tr>
                              </tbody>
                          </table>
                      </div>
                  </div>
              </div>
          </div>
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
                        <th>Date &amp; Time</th>
                        <th>Booking ID</th>
                        <th>Transaction ID</th>
                        <th>Amount</th>
                        <th>Type</th>
                        <th>Avail. Wallet</th>
                        <th>Booking Status</th>
                        <th>Remark</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>01</td>
                        <td>10-10-10 10:00am</td>
                        <td><a href="#" data-target="#package-info" data-toggle="modal">BOO0001</a></td>
                        <td><a href="#" data-target="#payment-detail" data-toggle="modal">OFF1513929178</a></td>
                        <td><i class="fas fa-rupee-sign"></i> 200</td>
                        <td><span class="badge badge-success">Credited</span></td>
                        <td><i class="fas fa-rupee-sign"></i> 900</td>
                        <td><span class="badge badge-info">Completed</span></td>
                        <td>Comission Credited</td>
                      </tr>

                      <tr>
                        <td>02</td>
                        <td>10-10-10 10:00am</td>
                        <td><a href="#" data-target="#package-info" data-toggle="modal">BOO0001</a></td>
                        <td><a href="#" data-target="#payment-detail" data-toggle="modal">OFF1513929178</a></td>
                        <td><i class="fas fa-rupee-sign"></i> 80</td>
                        <td><span class="badge badge-danger">Debited</span></td>
                        <td><i class="fas fa-rupee-sign"></i> 880</td>
                        <td><span class="badge badge-info">Completed</span></td>
                        <td>5% Paid to Loan</td>
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
                <tr class="text-success">
                  <th colspan="2" class="text-right">Comission</th>
                  <th><i class="fas fa-rupee-sign"></i> 160 (10%)</th>
                </tr>
              </tfoot>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
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
              <h3 class="content-head">User Name</h3>
            </div>
            <div class="col-sm-4">
              <label class="content-label">Vendor Email</label>
              <h3 class="content-head">user@gnmai.com</h3>
            </div>
            <div class="col-sm-4">
              <label class="content-label">Mobile No.</label>
              <h3 class="content-head">+91-9898989898</h3>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-12">
              <label class="content-label">Address</label>
              <h3 class="content-head">hello</h3>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-4">
              <label class="content-label">State</label>
              <h3 class="content-head">Maharashtra</h3>
            </div>
            <div class="col-sm-4">
              <label class="content-label">City</label>
              <h3 class="content-head">Mumbai</h3>
            </div>
            <div class="col-sm-4">
              <label class="content-label">Pincode</label>
              <h3 class="content-head">989898</h3>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="modal" id="payment-detail">
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

@endpush
