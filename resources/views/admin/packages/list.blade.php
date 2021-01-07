@extends('layouts.app')

@section('content')

<section class="breadcrumb-section">
    <div class="container">
      <div class="row">
        <div class="col-md-12 col-xs-12">
          <div class="content-header">
            <h3 class="content-header-title">Package Category</h3>
          <button class="btn btn-dark btn-save" onClick="window.location.href='{{route('admin.packages.create')}}'"><i class="fas fa-plus"></i> Add Package</button>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
              <li class="breadcrumb-item">Master</li>
              <li class="breadcrumb-item active">Manage Packages</li>
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
          <div class="card">
            <div class="card-body">
              <div class="card-block">
                <div class="table-responsive">
                  <table class="table table-bordered table-fitems">
                    <thead>
                      <tr>
                        <th>Sr. No.</th>
                        <th>Created at</th>
                        <th>Package Category</th>
                        <th>Package</th>
                        <th>Services</th>
                        <th>MRP</th>
                        <th>Discount</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>Updated at</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        {{! $n=1 }}
                        @foreach ($packages as $package)
                            <tr>
                                <td>{{$n++}}</td>
                                <td>{{$package->created_at}}</td>
                                <td><a href="#" data-target="#package-category-info" data-id="{{$package->package_category_id}}" id="view_package_category" data-toggle="modal">
                                    {{$package->package_category_name}}</a></td>
                                <td>{{$package->name}}</td>
                                <td>{{$package->services->pluck('name')->implode(', ')}}</td>
                                <td><i class="fas fa-rupee-sign"></i>{{$package->amount}}</td>
                                <td>{{$package->discount}}</td>
                                <td><i class="fas fa-rupee-sign"></i>{{$package->after_discount}}</td>
                                <td>
                                    <span @if ($package->status) class='badge badge-success' @else class='badge badge-secondary'@endif>{{$package->status ? 'Active' : 'Pending'}}
                                    </span>
                                </td>
                                <td>{{$package->updated_at}}</td>
                                <td><ul class="action">
                                    <li><a href="{{route('admin.packages.edit',$package->id)}}"><i class="fas fa-pencil-alt"></i></a></li>
                                    <li><a href="#"><i class="fas fa-times"></i></a></li>
                                    <li><a onclick="return confirm('Are you sure ? want to delete this Package.')" href="{{route('admin.packages.destroy', $package->id) }}"><i class="fas fa-trash"></i></a></li>
                                </ul></td>
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

  <div class="modal" id="package-category-info">
      <div class="modal-dialog">
          <div class="modal-content">

              <!-- Modal Header -->
              <div class="modal-header">
                  <h4 class="modal-title">View Information</h4>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>

              <!-- Modal body -->
              <div class="modal-body">
                  <div class="table-responsive">
                      <table class="table-bordered table">
                          <!-- Bind dynamic row td-->
                          <tbody id="package_category_tbl">

                          </tbody>
                      </table>
                  </div>
              </div>
          </div>
      </div>
  </div>

@endsection
