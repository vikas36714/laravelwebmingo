@extends('layouts.app')

@section('content')
    <section class="content-main-body">
        <div class="container">
            <div class="row mb-3">
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card counter-dash">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col mr-2">
                                    <div class="heading">Total Services</div>
                                    <div class="heading-2 font-weight-bold">40,000</div>
                                    <div class="heading-3">
                                        <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>
                                        <span>Since last month</span>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-file-alt fa-2x text-primary"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card counter-dash">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col mr-2">
                                    <div class="heading">Total Sales</div>
                                    <div class="heading-2 font-weight-bold"><i class="fas fa-rupee-sign"></i>1200</div>
                                    <div class="heading-3">
                                        <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 8.48%</span>
                                        <span>Since last month</span>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-window-restore fa-2x text-success"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card counter-dash">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col mr-2">
                                    <div class="heading">Total Packages</div>
                                    <div class="heading-2 font-weight-bold">870+</div>
                                    <div class="heading-3">
                                        <span class="text-danger mr-2"><i class="fa fa-arrow-down"></i> 9.98%</span>
                                        <span>Since last month</span>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-chart-line fa-2x text-dark"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card counter-dash">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col mr-2">
                                    <div class="heading">Site Traffic</div>
                                    <div class="heading-2 font-weight-bold">6,50,900</div>
                                    <div class="heading-3">
                                        <span class="text-danger mr-2"><i class="fa fa-arrow-up"></i> 9.98%</span>
                                        <span>Since last week</span>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-chart-bar fa-2x text-danger"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-7">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h4 class="card-title">Users Report</h4>
                            <canvas id="myChart"></canvas>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header card-head card-header-large bg-light d-flex align-items-center">
                            <div class="flex">
                                <h4 class="card-header__title">Recent Leads</h4>
                                <div class="card-subtitle text-muted">Pending Leads</div>
                            </div>
                            <div class="ml-auto"> <a href="pending-leads.php" class="btn btn-light">Browse All</a> </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered tabl-leads">
                                <thead>
                                    <tr>
                                        <th>Lead ID</th>
                                        <th>User</th>
                                        <th>Package</th>
                                        <th>Amount</th>
                                        <th>Payment</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr>
                                        <td>121</td>
                                        <td>User</td>
                                        <td>Gold</td>
                                        <td><i class="fas fa-rupee-sign"></i> 1200</td>
                                        <td><span class="badge badge-success">Success</span></td>
                                        <td>
                                            <ul class="action">
                                                  <li><a href="#" data-target="#assign-vendor" data-toggle="modal" title="Assign to Vendor"><i class="fas fa-reply-all"></i></a></li>
                                            </ul>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
                <div class="col-sm-5">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h4 class="card-title">Registration Traffic</h4>
                            <canvas id="polar-chart"></canvas>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-body">
                            <h4 class="card-title">Today Activity</h4>
                            <ul class="bullet-line-list">
                                <li>
                                    <p class="dated">12:00PM</p>
                                    <p>New User has Joined</p>
                                </li>
                                <li>
                                    <p class="dated">1:00PM</p>
                                    <p>Gold Package Lead has registered</p>
                                </li>
                                <li>
                                    <p class="dated">2:00PM</p>
                                    <p>User has added <i class="fas fa-rupee-sign"></i>12 to Wallet</p>
                                </li>
                                <li>
                                    <p class="dated">3:00PM</p>
                                    <p class="mb-0">Vendor has purchased Lead</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
