<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Nhuja Band</title>
        <link type="image/x-icon" href="{{ asset('assets/admin-assets/img/logo/logo 1.jpg') }}" rel="icon">
        <link href="{{ asset('assets/front-assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">
		<!-- Google Font: Source Sans Pro -->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
		<!-- Font Awesome -->
		<link rel="stylesheet" href="{{ asset('assets/admin-assets/plugins/fontawesome-free/css/all.min.css') }}">
		<!-- Theme style -->
		<link rel="stylesheet" href="{{ asset('assets/admin-assets/css/adminlte.min.css') }}">
		<link rel="stylesheet" href="{{ asset('assets/admin-assets/css/custom.css') }}">
	</head>
	<body class="hold-transition login-page">
		<div class="login-box">
			<!-- /.login-logo -->
            @include('admin.message')
			<div class="card card-outline card-primary">
			  	<div class="card-header text-center">
					<h3>Forgot Password</h3>
			  	</div>
			  	<div class="card-body">
                    <img src="{{ asset('assets/admin-assets/img/logo/logo.png')}}" alt="" srcset="" width="300px" style="text-align: center; margin-bottom:20px;">
					<form action="{{ route('admin.processForgotPassword') }}" method="post">
                        @csrf
				  		<div class="input-group mb-3">
							<input type="email" value="{{ old('email') }}" name="email" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email">
							<div class="input-group-append">
					  			<div class="input-group-text">
									<span class="fas fa-envelope"></span>
					  			</div>
							</div>
                            @error('email')
                            <p class="invalid-feedback">{{ $message }}</p>
                            @enderror

				  		</div>
				  		<div class="row justify-content-center">
							<!-- /.col -->
							<div class="col-4 ">
					  			<button type="submit" class="btn btn-primary btn-block ">Submit</button>
							</div>
							<!-- /.col -->
				  		</div>
					</form>
			  	</div>
                	  	<!-- /.card-body -->
			</div>
                  <p class="mb-1 mt-1" style="text-align: center;!important">
                    <a href="{{ route('admin.login') }}">Login</a>
              </p>
			<!-- /.card -->
		</div>
		<!-- ./wrapper -->
		<!-- jQuery -->
		<script src="{{ asset('assets/admin-assets/plugins/jquery/jquery.min.js') }}"></script>
		<!-- Bootstrap 4 -->
		<script src="{{ asset('assets/admin-assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
		<!-- AdminLTE App -->
		<script src="{{ asset('assets/admin-assets/js/adminlte.min.js') }}"></script>
		<!-- AdminLTE for demo purposes -->
		<script src="{{ asset('assets/admin-assets/js/demo.js') }}"></script>
	</body>
</html>
