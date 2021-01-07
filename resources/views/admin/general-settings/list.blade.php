@extends('layouts.app')

@section('content')
<section class="breadcrumb-section">
    <div class="container">
      <div class="row">
        <div class="col-md-12 col-xs-12">
          <div class="content-header">
            <h3 class="content-header-title">Website Setting</h3>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
              <li class="breadcrumb-item">Website Setting</li>
              <li class="breadcrumb-item active">General Settings</li>
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
                <form action="{{ route('admin.general-settings.update', 1) }}" enctype="multipart/form-data" name="general_settings" method="POST">
                    @csrf
                <div class="form-group row">
                  <div class="col-sm-12">
                    <h3 class="h3-title">Header Setting</h3>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-4">
                    <label class="label-control">Logo</label>
                    <input type="file" name="header_setting_logo" class="text-control">
                    <img src="{{asset('public/images/general_settings_images/'.$generalSettings->header_setting_logo)}}" class="img-fluid" style="height: 30px;">
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-12">
                    <h3 class="h3-title">Footer Setting</h3>
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-sm-4">
                    <label class="label-control">Logo</label>
                    <input type="file" name="footer_setting_logo" class="text-control">
                    <img src="{{asset('public/images/general_settings_images/'.$generalSettings->footer_setting_logo)}}" class="img-fluid" style="height: 30px;">
                  </div>

                  <div class="col-sm-4">
                    <label class="label-control">About Footer Text</label>
                  <textarea cols="4" rows="2" placeholder="Enter About Text" name="footer_setting_about_text" class="text-control">{{$generalSettings->footer_setting_about_text}}</textarea>
                  </div>

                  <div class="col-sm-4">
                    <label class="label-control">Footer Copyright</label>
                  <input type="text" placeholder="Enter Copyright Text" value="{{$generalSettings->footer_setting_copyright}}" name="footer_setting_copyright" class="text-control">
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-sm-12">
                    <h3 class="h3-title">General Setting</h3>
                  </div>
                </div>

                 <div class="form-group row">
                  <div class="col-sm-4">
                    <label class="label-control">Address</label>
                    <textarea cols="4" rows="2" placeholder="Enter About Text" name="general_setting_address" class="text-control">{{$generalSettings->general_setting_address}}</textarea>
                  </div>

                  <div class="col-sm-4">
                    <label class="label-control">Call Us</label>
                    <input placeholder="Enter Contact No." name="general_setting_call_us" class="text-control" value="{{$generalSettings->general_setting_call_us}}">
                  </div>

                  <div class="col-sm-4">
                    <label class="label-control">Email Us</label>
                    <input placeholder="Enter Email" name="general_setting_email_us" class="text-control" value="{{$generalSettings->general_setting_email_us}}">
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-sm-12 text-center">
                    <button class="btn btn-dark" type="submit">Update Settings</button>
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
