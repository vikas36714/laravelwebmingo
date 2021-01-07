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
              <li class="breadcrumb-item active">Pending Leads</li>
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
                  <table class="table table-bordered table-fitems forall">
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
                      <tr>
                        <td>01</td>
                        <td>12.10.2020 12:10PM</td>
                        <td>143284</td>
                        <td>User<br>
                          email@gmail.com<br>
                          226003</td>
                        <td>Not Assigned</td>
                        <td><a href="#" data-target="#package-info" data-toggle="modal">Gold</a></td>
                        <td><i class="fas fa-rupee-sign"></i> 1200</td>
                        <td><a href="#" data-target="#payment-info" data-toggle="modal"><span class="badge badge-success">Success</span></a></td>
                        <td><span class="badge badge-warning">Pending</span></td>
                        <td>12.10.2020 12:00PM</td>
                        <td><ul class="action">
                            <li><a href="#" title="Edit Lead"><i class="fas fa-pencil-alt"></i></a></li>
                            <li><a href="#"><i class="fas fa-times"></i></a></li>
                            <li><a href="#"><i class="fas fa-trash"></i></a></li>
                          </ul></td>
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

@endpush
