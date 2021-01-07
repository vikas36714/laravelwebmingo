@extends('layouts.app')

@section('content')
<section class="breadcrumb-section">
    <div class="container">
      <div class="row">
        <div class="col-md-12 col-xs-12">
          <div class="content-header">
            <h3 class="content-header-title">Content Management</h3>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
              <li class="breadcrumb-item">Content Management</li>
              <li class="breadcrumb-item active">Manage Refund &amp; Cancellation</li>
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
                <form action="{{ route('admin.refund-cancellation.update', 1) }}" enctype="multipart/form-data" name="rc" method="POST">
                    @csrf
                <div class="form-group row">
                  <div class="col-sm-12">
                  <h3 class="h3-title">{{$pageTitle}}</h3>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-4">
                    <label class="label-control">Image</label>
                    <input type="file" name="image" class="text-control">
                    <img src="{{asset('public/images/refund_cancellation_image/'.$refundCancellations->image)}}" class="img-fluid" style="height: 30px;">
                  </div>
                  <div class="col-sm-4">
                    <label class="label-control">Heading</label>
                    <input type="text" name="heading" placeholder="Enter heading" class="text-control" value="{{$refundCancellations->heading}}">
                  </div>
                  <div class="col-sm-4">
                    <label class="label-control">Short Description</label>
                    <textarea cols="4" rows="2" name="short_description" class="text-control" placeholder="Short description here">{{$refundCancellations->short_description}}</textarea>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-12">
                    <label class="label-control">Description</label>
                    <textarea class="text-control" name="description" rows="4" cols="8" placeholder="Enter About Description">{{$refundCancellations->description}}</textarea>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-12 text-center">
                    <button class="btn btn-dark" type="submit">Update Policy</button>
                  </div>
                </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
