@extends('layouts.app')

@section('content')
<section class="breadcrumb-section">
    <div class="container">
      <div class="row">
        <div class="col-md-12 col-xs-12">
          <div class="content-header">
            <h3 class="content-header-title">Enquiry</h3>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
              <li class="breadcrumb-item">Enquiry</li>
              <li class="breadcrumb-item active">Manage Contact Us</li>
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
                        <th>Order #</th>
                        <th>Email</th>
                        <th>Mobile No.</th>
                        <th>Query</th>
                        <th>Updated at</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        {{! $n=1 }}
                        @foreach ($supports as $support)
                            <tr>
                                <td>{{$n++}}</td>
                                <td>{{$support->created_at}}</td>
                                <td>{{$support->order_id}}</td>
                                <td>{{$support->email}}</td>
                                <td>{{$support->mobile_number}}</td>
                                <td><a href="#" data-target="#view-query" data-toggle="modal">View</a></td>
                                <td>{{$support->updated_at}}</td>
                                <td>
                                <ul class="action">
                                    <li><a onclick="return confirm('Are you sure ? want to delete this support.')" href="{{route('admin.enquery.support-destroy', $support->id) }}" class="Delete Support"><i class="fas fa-trash"></i></a></li>
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
