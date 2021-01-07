@extends('layouts.app')

@section('content')

<section class="breadcrumb-section">
    <div class="container">
      <div class="row">
        <div class="col-md-12 col-xs-12">
          <div class="content-header">
            <h3 class="content-header-title">Vendors</h3>
            <button class="btn btn-dark btn-save" onclick="window.location.href='{{route('admin.vendor.create')}}'"><i class="fas fa-plus"></i> Add Vendor</button>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
              <li class="breadcrumb-item">Master</li>
              <li class="breadcrumb-item active">Manage Vendors</li>
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
          <div class="card">
            <div class="card-body">
              <div class="card-block">
                <div class="table-responsive">
                  <table class="table table-bordered table-fitems">
                    <thead>
                      <tr>
                        <th>Sr. No.</th>
                        <th>Created at</th>
                        <th>Profile</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Mobile No.</th>
                        <th>Status</th>
                        <th>Updated at</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        {{! $n=1 }}
                        @foreach ($vendors as $vendor)
                        <tr>
                            <td>{{$n++}}</td>
                            <td>{{$vendor->created_at}}</td>
                            <td>
                                @if($vendor->profile_pic)
                                    <img src="{{asset('public/images/vendor_images/'.$vendor->profile_pic)}}" class="img-fluid" style="height: 30px;">
                                @else
                                    <img src="{{asset('public/images/usr.png')}}" class="img-fluid" style="height: 30px;">
                                @endif
                            </td>
                            <td>{{$vendor->first_name}} {{$vendor->last_name}}</td>
                            <td>{{$vendor->email}} <i class="fas fa-check-circle text-success"></i></td>
                            <td>{{$vendor->mobile_number}} <i class="fas fa-times-circle text-danger"></i></td>
                            <td>
                                <span @if ($vendor->status) class='badge badge-success' @else class='badge badge-secondary'@endif>{{$vendor->status ? 'Active' : 'Deactive'}}
                                </span>
                            </td>
                            <td>{{$vendor->updated_at}}</td>
                            <td>
                            <ul class="action">
                                <li><a href="{{ route('admin.vendor.view', $vendor->id) }}" title="View Vendor Info"><i class="fas fa-eye"></i></a></li>
                                <li><a href="{{ route('admin.vendor.edit', $vendor->id) }}" title="Edit Vendor"><i class="fas fa-pencil-alt"></i></a></li>
                                <li><a href="#" title="Disabled Vendor"><i class="fas fa-times"></i></a></li>
                                <li><a onclick="return confirm('Are you sure ? want to delete this Vendor.')" href="{{ route('admin.vendor.destroy', $vendor->id) }}" title="Delete Vendor"><i class="fas fa-trash"></i></a></li>
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

@endsection
