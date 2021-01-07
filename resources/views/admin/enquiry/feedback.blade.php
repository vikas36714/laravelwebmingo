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
              <li class="breadcrumb-item active">Manage Feedback</li>
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
                        <th>Profile</th>
                        <th>User</th>
                        <th>Feedback</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        {{! $n=1 }}
                        @foreach ($feedbacks as $feedback)
                            <tr>
                            <td>{{$n++}}</td>
                            <td>{{$feedback->created_at}}</td>
                            <td>{{$feedback->order_id}}</td>
                            <td><img src="{{asset('public/images/'.$feedback->profile_pic)}}" class="img-fluid" style="height:50px;"></td>
                            <td>{{$feedback->user}}</td>
                            <td><a href="#" data-target="#view-query" data-toggle="modal">View</a></td>
                            <td>
                                <ul class="action">
                                    <li><a onclick="return confirm('Are you sure ? want to delete this feedback.')" href="{{route('admin.enquery.feedback-destroy', $feedback->id) }}" class="Delete Feedback"><i class="fas fa-trash"></i>
                                    </a></li>
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
