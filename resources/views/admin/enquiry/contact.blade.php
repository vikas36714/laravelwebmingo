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
                        <th>Name</th>
                        <th>Email</th>
                        <th>Mobile No.</th>
                        <th>Subject</th>
                        <th>Query</th>
                        <th>Updated at</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        {{! $n=1 }}
                        @foreach ($contacts as $contact)
                        <tr>
                            <td>{{$n++}}</td>
                            <td>{{$contact->created_at}}</td>
                            <td>{{$contact->name}}</td>
                            <td>{{$contact->email}}</td>
                            <td>{{$contact->mobile_number}}</td>
                            <td>{{$contact->subject}}</td>
                            <td><a href="#" data-target="#view-query" data-toggle="modal">View</a></td>
                            <td>{{$contact->updated_at}}</td>
                            <td>
                            <ul class="action">
                                <li><a onclick="return confirm('Are you sure ? want to delete this contact.')" href="{{route('admin.enquery.contact-destroy', $contact->id) }}" class="Delete Enquiry"><i class="fas fa-trash"></i></a></li>
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
