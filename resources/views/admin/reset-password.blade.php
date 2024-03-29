<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Nhuja Band</title>
        <link type="image/x-icon" href="{{ asset('assets/admin-assets/img/logo/logo 1.jpg') }}" rel="icon">
        <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">
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
					<h3>Reset Password</h3>
			  	</div>
			  	<div class="card-body">
                    <img src="{{ asset('assets/admin-assets/img/logo/logo.png')}}" alt="" srcset="" width="300px" style="text-align: center; margin-bottom:20px;">
					<form action="{{ route('admin.processResetPassword') }}" method="post">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">
				  		<div class="input-group mb-3">
							<input type="password" name="new_password" id="new_password" class="form-control @error('new_password') is-invalid @enderror" placeholder="New Password">
							<div class="input-group-append">
					  			<div class="input-group-text">
								<span class="fas fa-lock"></span>
					  			</div>
							</div>
                            @error('new_password')
                            <p class="invalid-feedback">{{ $message }}</p>
                            @enderror

				  		</div>
                          <div class="input-group mb-3">
							<input type="password" name="confirm_password" id="confirm_password" class="form-control @error('confirm_password') is-invalid @enderror" placeholder="Confirm Password">
							<div class="input-group-append">
					  			<div class="input-group-text">
									<span class="fas fa-lock"></span>
					  			</div>
							</div>
                            @error('confirm_password')
                            <p class="invalid-feedback">{{ $message }}</p>
                            @enderror

				  		</div>
				  		<div class="row justify-content-center">
							<!-- /.col -->
							<div class="col-4 ">
					  			<input type="submit" class="btn btn-primary btn-block btn-lg" value="Submit">
							</div>
							<!-- /.col -->
				  		</div>
					</form>
			  	</div>
                	  	<!-- /.card-body -->
			</div>
                  <p class="mb-1 mt-1" style="text-align: center;!important">
                    <a href="{{ route('admin.login') }}">Click Here to Login</a>
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
