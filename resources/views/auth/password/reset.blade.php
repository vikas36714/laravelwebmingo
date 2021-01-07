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
                <div class="logo login-logo mb-3">
                    <img src="{{asset('images/logo.png') }}" class="img-fluid">
                </div>
            <form method="POST" action="{{url('/reset-password')}}">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                 <div class="form-group row">
                    <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>
                   <div class="col-md-6">
                         <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" autocomplete="email" autofocus>

                         @error('email')
                             <span class="invalid-feedback" role="alert">
                                 <strong>{{ $message }}</strong>
                             </span>
                         @enderror
                     </div>
                 </div>

                 <div class="form-group row">
                     <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
                     <div class="col-md-6">
                         <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password">

                         @error('password')
                             <span class="invalid-feedback" role="alert">
                                 <strong>{{ $message }}</strong>
                             </span>
                         @enderror
                     </div>

                 </div>

               <div class="form-group row">
                     <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirm Password</label>
                     <div class="col-md-6">
                         <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">
                     </div>
                 </div>

              <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                         <button type="submit" class="btn btn-primary">
                             Reset Password
                         </button>
                     </div>
                 </div>
             </form>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/jquery.js') }}" type="text/javascript"></script>
	<script src="{{ asset('js/poppers.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/bootstrap-4.js') }}" type="text/javascript"></script>
    <script>
</body>
</html>

