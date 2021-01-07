<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="{{ asset('css/bootstrap-4.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-5 mx-auto">
                <div class="myform form ">
                    @if (session('message'))
                        <div class="alert alert-success" role="alert">{{ session('message') }}</div>
                    @elseif(session('error'))
                        <div class="alert alert-danger" role="alert">{{ session('error') }}</div>
                    @endif
                    <h5 class="text-center">Vendor Login</h5>
                    <div class="logo login-logo mb-3">
                        <img src="{{asset('images/logo.png')}}" class="img-fluid">
                    </div>
                    <form method="POST" action="{{ route('vendor.login') }}" name="login">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputId">Email</label>
                            <input type="text" name="email" class="form-control" id="email" placeholder="Enter Email">
                            @if ($errors->has('email'))
                                <span class="text-danger">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Password</label>
                            <input type="password" name="password" id="password" class="form-control"
                                placeholder="Enter Password">
                                @if ($errors->has('password'))
                                <span class="text-danger">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12 text-center ">
                                <button type="submit" class=" btn btn-block mybtn btn-dark tx-tfm">Login</button>
                            </div>
                        </div>
                        {{-- <div class="form-group text-center">
                            <a href="#forgot-pass" data-target="#forgot-pass" data-toggle="modal">Forgot Password ?</a>
                        </div> --}}
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- <div class="modal fade" id="forgot-pass" tabindex="-1" role="dialog" aria-labelledby="forgot-pass"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="forgot-pass">Forgot Password</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>

                </div>
                <div class="modal-body">
                    <span class="success" style="color:green; margin-top:10px; margin-bottom: 10px;"></span>
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <x-jet-label for="label-control" value="{{ __('Email Address') }}" />
                            <x-jet-input class="form-control" id="email_id" type="email" name="email"
                                placeholder="Enter Registered Email Address" />
                        </div>
                    </div>
                    <div class="form-group row">
						<div class="col-sm-12 text-center">

							<button type="button" id="resetbtn" class="btn btn-dark">Reset Now</button>
						</div>
					</div>
                </div>
            </div>
        </div>
    </div> --}}
    <script src="{{ asset('js/jquery.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/poppers.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/bootstrap-4.js') }}" type="text/javascript"></script>

</body>

</html>
