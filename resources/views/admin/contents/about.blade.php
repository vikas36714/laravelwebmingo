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
              <li class="breadcrumb-item active">Manage About Us</li>
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
                <form action="{{ route('admin.about.update', 1) }}" enctype="multipart/form-data" name="category" method="POST">
                    @csrf
                <div class="form-group row">
                  <div class="col-sm-12">
                  <h3 class="h3-title">{{$pageTitle}}</h3>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-4">
                    <label class="label-control">About Image</label>
                    <input type="file" name="image" class="text-control">
                    <img src="{{asset('public/images/about_images/'.$about->image)}}" class="img-fluid" style="height: 30px;">
                  </div>
                  <div class="col-sm-4">
                    <label class="label-control">Heading</label>
                    <input type="text" placeholder="Enter heading" name="heading" value="{{$about->heading}}" class="text-control">
                  </div>
                  <div class="col-sm-4">
                    <label class="label-control">Short Description</label>
                    <textarea cols="4" rows="2" name="short_description" class="text-control" placeholder="Short description here">{{$about->short_description}}</textarea>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-12">
                    <label class="label-control">Description</label>
                    <textarea name="description" class="text-control" rows="4" cols="8" placeholder="Enter About Description">{{$about->description}}</textarea>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-12">
                    <h3 class="h3-title">Section 1</h3>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-4">
                    <label class="label-control">Heading</label>
                    <input type="text" placeholder="Enter heading" name="section1_heading" value="{{$about->section1_heading}}" class="text-control">
                  </div>
                  <div class="col-sm-8">
                    <label class="label-control">Description</label>
                    <textarea cols="4" rows="2" name="section1_description" class="text-control" placeholder="Short description here">{{$about->section1_description}}</textarea>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-12">
                    <h3 class="h3-title">Section 2</h3>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-4">
                    <label class="label-control">Heading</label>
                    <input type="text" placeholder="Enter heading" name="section2_heading" value="{{$about->section2_heading}}" class="text-control" value="Our Mission">
                  </div>
                  <div class="col-sm-8">
                    <label class="label-control">Description</label>
                    <textarea cols="4" rows="2" name="section2_description" class="text-control" placeholder="Short description here">{{$about->section2_description}}</textarea>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-12">
                    <h3 class="h3-title">Section 3</h3>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-4">
                    <label class="label-control">Image</label>
                    <input type="file" name="section3_image" class="text-control">
                    <img src="{{asset('public/images/about_images/'.$about->section3_image)}}" class="img-fluid" style="height: 30px;">
                  </div>
                  <div class="col-sm-4">
                    <label class="label-control">Heading</label>
                    <input type="text" placeholder="Enter heading" name="section3_heading" value="{{$about->section3_heading}}" class="text-control" value="Our Story so far">
                  </div>
                  <div class="col-sm-4">
                    <label class="label-control">Description</label>
                    <textarea cols="4" rows="2" name="section3_description" class="text-control" placeholder="Short description here">{{$about->section3_description}}</textarea>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-12 text-center">
                    <button class="btn btn-dark" type="submit">Update About Content</button>
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
