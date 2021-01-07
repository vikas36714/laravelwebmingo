@extends('layouts.app')

@section('content')
<section class="breadcrumb-section">
    <div class="container">
      <div class="row">
        <div class="col-md-12 col-xs-12">
          <div class="content-header">
            <h3 class="content-header-title">Users</h3>
            <button class="btn btn-dark btn-save" data-target="#add-user" data-toggle="modal"><i class="fas fa-plus"></i> Add Users</button>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
              <li class="breadcrumb-item">Master</li>
              <li class="breadcrumb-item active">Manage Users</li>
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
            <span class="success"></span>
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
                        @foreach ($users as $user)
                        <tr>
                        <td>{{$n++}}</td>
                            <td>{{$user->created_at}}</td>
                            <td>
                                @if($user->profile_pic)
                                <img src="{{asset('public/images/user_images/'.$user->profile_pic)}}" class="img-fluid" style="height: 30px;">
                            @else
                                <img src="{{asset('public/images/usr.png')}}" class="img-fluid" style="height: 30px;">
                            @endif
                            </td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}} <i class="fas fa-check-circle text-success"></i></td>
                            <td>{{$user->mobile_number}} <i class="fas fa-times-circle text-danger"></i></td>
                            <td>
                                <span @if ($user->status) class='badge badge-success' @else class='badge badge-secondary'@endif>{{$user->status ? 'Active' : 'Deactive'}}
                                </span>
                            </td>
                            <td>{{$user->updated_at}}</td>
                            <td>
                              <ul class="action">
                                <li><a href="{{ route('admin.user.view', $user->id) }}" title="View User Info"><i class="fas fa-eye"></i></a></li>
                                <li><a href="{{ route('admin.user.edit', $user->id) }}" title="Edit User"><i class="fas fa-pencil-alt"></i></a></li>
                                <li><a href="#" title="change status"><i class="fas fa-times"></i></a></li>
                                <li><a onclick="return confirm('Are you sure ? want to delete this user.')" href="{{ route('admin.user.destroy', $user->id) }}" title="delete user"><i class="fas fa-trash"></i></a></li>
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

  <div class="modal" id="add-user">
      <div class="modal-dialog">
          <div class="modal-content">

              <!-- Modal Header -->
              <div class="modal-header">
                  <h4 class="modal-title">Add User</h4>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>

              <!-- Modal body -->
              <div class="modal-body">
            <form action="{{ route('admin.user.store') }}" method="POST" enctype="multipart/form-data" >
                @csrf
                  <div class="form-group row">
                      <div class="col-sm-6">
                          <label class="label label-control">Profile Picture</label>
                          <input type="file" name="profile_pic" id="profile_photo" class="text-control">
                          @if ($errors->has('profile_pic'))
                                <span class="text-danger">
                                    <span>{{ $errors->first('profile_pic') }}</span>
                                </span>
                          @endif
                      </div>
                      <div class="col-sm-6">
                          <label class="label label-control">Name</label>
                          <input type="text" name="name" id="name" class="text-control" placeholder="Enter Name" value="{{ old('name') }}">
                          @if ($errors->has('name'))
                                <span class="text-danger">
                                    <span>{{ $errors->first('name') }}</span>
                                </span>
                          @endif
                      </div>
                  </div>

                  <div class="form-group row">
                      <div class="col-sm-6">
                          <label class="label label-control">Email</label>
                          <input type="text" name="email" id="email" placeholder="Enter Email" class="text-control" value="{{ old('email') }}">
                          @if ($errors->has('email'))
                                <span class="text-danger">
                                    <span>{{ $errors->first('email') }}</span>
                                </span>
                          @endif
                      </div>
                      <div class="col-sm-6">
                          <label class="label label-control">Mobile No.</label>
                          <input type="number" name="mobile_number" id="mobile_number" class="text-control" placeholder="Enter Mobile No." value="{{ old('mobile_number') }}">
                          @if ($errors->has('mobile_number'))
                                <span class="text-danger">
                                    <span>{{ $errors->first('mobile_number') }}</span>
                                </span>
                          @endif
                      </div>
                  </div>

                  <div class="form-group row">
                      <div class="col-sm-6">
                          <label class="label label-control">Password</label>
                          <input type="password" name="password" id="password" placeholder="Enter Password" class="text-control">
                          @if ($errors->has('password'))
                                <span class="text-danger">
                                    <span>{{ $errors->first('password') }}</span>
                                </span>
                          @endif
                      </div>
                      <div class="col-sm-6">
                          <label class="label label-control">Re-Enter Password</label>
                          <input type="password" name="confirm_password" id="confirm_password" class="text-control" placeholder="Re-Enter Password">
                          @if ($errors->has('confirm_password'))
                                <span class="text-danger">
                                    <span>{{ $errors->first('confirm_password') }}</span>
                                </span>
                          @endif
                      </div>
                  </div>

                  <div class="form-group row">
                      <div class="col-sm-12 text-center">
                          <button class="btn btn-dark" type="submit"><i class="fas fa-plus"></i> Add User</button>
                      </div>
                  </div>
                </form>
              </div>
          </div>
      </div>
  </div>
@endsection
