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
              <li class="breadcrumb-item active">Edit User</li>
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
              <div class="card-block">
                <div class="tabs-users-info">
                    <form action="{{ route('admin.user.edit', $user->id) }}" method="POST" enctype="multipart/form-data" >
                        @csrf
                  <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item"> <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="true">Profile Information</a> </li>
                    <li class="nav-item"> <a class="nav-link" id="changepass-tab" data-toggle="tab" href="#changepass" role="tab" aria-controls="changepass" aria-selected="false">Login &amp; Security</a> </li>
                  </ul>
                  <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                      <div class="tabcontent-userinfo">

                        <div class="form-group row">
                          <div class="col-sm-4">
                            <label class="label label-control">Profile Picture</label>
                            <input type="file" name="profile_pic" class="text-control">
                            <img src="{{asset('public/images/user_images/'.$user->profile_pic)}}" class="img-fluid" style="height: 30px;">
                          </div>
                          <div class="col-sm-4">
                            <label class="label label-control">Name</label>
                          <input type="text" name="name" value="{{$user->name}}" class="text-control" placeholder="Enter Name">
                          </div>
                          <div class="col-sm-4">
                            <label class="label label-control">Email</label>
                            <input type="text" name="email" value="{{$user->email}}" placeholder="Enter Email" class="text-control">
                          </div>
                        </div>
                        <div class="form-group row">
                          <div class="col-sm-4">
                            <label class="label label-control">Mobile No.</label>
                            <input type="number" name="mobile_number" value="{{$user->mobile_number}}" class="text-control" placeholder="Enter Mobile No.">
                          </div>
                          <div class="col-sm-4">
                            <label class="label label-control">Gender</label>
                            <div class="d-block">
                              <label><input type="radio" name="gender" {{ $user->gender == 'male' ? 'checked' : ''}} value="male"> Male &nbsp;&nbsp;</label>
                              <label><input type="radio" name="gender" {{ $user->gender == 'female' ? 'checked' : ''}} value="female"> Female</label>
                            </div>
                          </div>
                          <div class="col-sm-4">
                            <label class="label label-control">State</label>
                            <select class="form-control" name="state_id" id="state">
                              <option value="">Select State</option>
                              @foreach ($states as $state)
                                <option value="{{$state->id}}" {{ $state->id == $user->state_id ? 'selected' : ''}}>{{$state->name}}</option>
                              @endforeach
                            </select>
                          </div>
                        </div>
                        <div class="form-group row">
                          <div class="col-sm-4">
                            <label class="label label-control">City</label>
                            <!-- Dynamic bind city using state id form ajax --->
                             <select class="form-control" name="city_id" id="city">
                                <option value="{{$user->city_id}}">{{$user->city_name}}</option>
                             </select>
                          </div>
                          <div class="col-sm-4">
                            <label class="label label-control">Pincode</label>
                            <input type="text" name="pincode" value="{{$user->pincode}}" class="text-control" placeholder="Enter Pincode">
                          </div>
                        </div>
                        <div class="form-group row">
                          <div class="col-sm-8">
                            <label class="label label-control">Address</label>
                            <input type="text" name="address" value="{{$user->address}}" class="text-control" placeholder="Enter Address">
                          </div>
                          <div class="col-sm-4">
                            <label class="label label-control">Landmark</label>
                            <input type="text" name="landmark" value="{{$user->landmark}}" class="text-control" placeholder="Enter Landmark">
                          </div>
                        </div>
                        <div class="form-group row">
                          <div class="col-sm-12 text-center">
                              <button class="btn btn-dark" type="submit">Update Profile</button>
                          </div>
                        </div>

                      </div>
                    </div>
                    <div class="tab-pane fade" id="changepass" role="tabpanel" aria-labelledby="changepass-tab">
                      <div class="tabcontent-userinfo">
                        <div class="form-group row">
                          <div class="col-sm-4">
                            <label class="label label-control">Old Password</label>
                            <input type="password" name="old_password" placeholder="Enter Old Password" class="text-control">
                            @if ($errors->has('old_password'))
                                <span class="text-danger">
                                    <span>{{ $errors->first('old_password') }}</span>
                                </span>
                            @endif
                          </div>
                          <div class="col-sm-4">
                            <label class="label label-control">New Password</label>
                            <input type="password" name="password" placeholder="Enter New Password" class="text-control">
                            @if ($errors->has('password'))
                                <span class="text-danger">
                                    <span>{{ $errors->first('password') }}</span>
                                </span>
                            @endif
                            <span class="noted-text">Password should be minimum 6 characters</span>
                          </div>
                          <div class="col-sm-4">
                            <label class="label label-control">Re-Enter Password</label>
                            <input type="password" name="confirm_password" placeholder="Re-Enter Password" class="text-control">
                            @if ($errors->has('confirm_password'))
                                <span class="text-danger">
                                    <span>{{ $errors->first('confirm_password') }}</span>
                                </span>
                            @endif
                          </div>
                        </div>
                        <div class="form-group row">
                          <div class="col-sm-12 text-center">
                              <button class="btn btn-dark" type="submit">Update Security</button>
                          </div>
                        </div>
                    </form>
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
@endsection
