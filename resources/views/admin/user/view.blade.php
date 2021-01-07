@extends('layouts.app')

@section('content')

<section class="breadcrumb-section">
    <div class="container">
      <div class="row">
        <div class="col-md-12 col-xs-12">
          <div class="content-header">
            <h3 class="content-header-title">Users</h3>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
              <li class="breadcrumb-item">Manage Users</li>
              <li class="breadcrumb-item active">View User Information</li>
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
              <div class="tabs-users-info">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                  <li class="nav-item"> <a class="nav-link active" id="general-tab" data-toggle="tab" href="#general" role="tab" aria-controls="general" aria-selected="true">General</a> </li>
                  <li class="nav-item"> <a class="nav-link" id="bookings-tab" data-toggle="tab" href="#bookings" role="tab" aria-controls="bookings" aria-selected="false">Bookings</a> </li>
                  <li class="nav-item"> <a class="nav-link" id="wallet-tab" data-toggle="tab" href="#wallet" role="tab" aria-controls="wallet" aria-selected="false">Wallet History</a> </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                  <div class="tab-pane fade show active" id="general" role="tabpanel" aria-labelledby="general-tab">
                    <div class="tabcontent-userinfo">
                      <div class="btn-custm"> <a href="" class="btn btn-sm btn-warning">Send Email</a> <a href="" class="btn btn-sm btn-info">Send SMS</a> </div>
                      <h3 class="h3-title">Profile Info</h3>
                      <div class="table-responsive">
                        <table class="table table-bordered tabl-info">
                          <tbody>
                            <tr>
                              <th>Reg. Date</th>
                              <td>{{$user->created_at}}</td>
                              <th>Name</th>
                              <td>{{$user->name}}</td>
                            </tr>
                            <tr>
                              <th>Email Id</th>
                              <td>{{$user->email}}</td>
                              <th>Mobile No. </th>
                              <td>{{$user->mobile_number}}</td>
                            </tr>
                            <tr>
                              <th>Gender</th>
                              <td>{{$user->gender}}</td>
                              <th>Address</th>
                              <td>{{$user->address}}</td>
                            </tr>
                            <tr>
                              <th>Landmark</th>
                              <td>{{$user->landmark}}</td>
                              <th>State</th>
                              <td>{{$user->state}}</td>
                            </tr>
                            <tr>
                              <th>City</th>
                              <td>{{$user->city}}</td>
                              <th>Pincode</th>
                              <td>{{$user->pincode}}</td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane fade" id="bookings" role="tabpanel" aria-labelledby="bookings-tab">
                    <div class="tabcontent-userbooking">
                      <div class="table-responsive">
                        <table class="table table-bordered table-fitems forall">
                          <thead>
                            <tr>
                              <th>Sr. No.</th>
                              <th>Created at</th>
                              <th>Booking ID</th>
                              <th>Vendor</th>
                              <th>Package</th>
                              <th>Amount</th>
                              <th>Payment Status</th>
                              <th>Booking Status</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td>01</td>
                              <td>12.10.2020 12:10PM</td>
                              <td>143284</td>
                              <td>Vendor Name<br>
                                im@gmail.com</td>
                              <td><a href="#" data-target="#package-info" data-toggle="modal">Gold</a></td>
                              <td><i class="fas fa-rupee-sign"></i> 1200</td>
                              <td><a href="#" data-target="#payment-info" data-toggle="modal"><span class="badge badge-success">Success</span></a></td>
                              <td><span class="badge badge-info">Ongoing</span></td>
                              <td><ul class="action">
                                  <li><a href="view-booking-detail.php" title="View Booking Information"><i class="fas fa-eye"></i></a></li>
                                  <li><a href="#" title="Cancel Booking"><i class="fas fa-times"></i></a></li>
                                </ul></td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane fade" id="wallet" role="tabpanel" aria-labelledby="wallet-tab">
                    <div class="tabcontent-userbooking">
                      <div class="table-responsive">
                        <table class="table table-bordered table-fitems forall">
                          <thead>
                            <tr>
                              <th>Sr. No.</th>
                              <th>Date &amp; Time</th>
                              <th>Mode</th>
                              <th>Service Type</th>
                              <th>Transaction ID</th>
                              <th>Amount</th>
                              <th>Type</th>
                              <th>Status</th>
                              <th>Avail. Bal</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td>01</td>
                              <td>10-10-10 10:00am</td>
                              <td>Online</td>
                              <td>Add Money To Wallet</td>
                              <td><a href="#" data-target="#payment_detail" data-toggle="modal">OFF1513929178</a></td>
                              <td><i class="fa fa-inr"></i> 200</td>
                              <td>Credit</td>
                              <td>Cancelled</td>
                              <td><i class="fa fa-inr"></i> 0</td>
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

@endsection
