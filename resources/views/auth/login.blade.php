@extends('layouts.app')

@section('content')
<body class="my-login-page">
    <section class="h-100">
		<div class="container h-100">
			<div class="row justify-content-md-center h-100">
				<div class="card-wrapper">
					<div class="brand">
						<img src="img/logo.jpg" alt="logo">
					</div>
					<div class="card fat">
						<div class="card-body">
							<h4 class="card-title text-center">KALOLA</h4>
							<form method="POST" action="{{ route('login') }}" class="my-login-validation">
                                @csrf
								<div class="form-group">
									<label for="username">Username</label>
									<input id="username" type="username" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>
									@error('username')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
								</div>

								<div class="form-group">
									<label for="password">Password</label>
									<input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
								    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
								</div>
                                <br>

								<div class="form-group m-0">
									<button type="submit" class="btn btn-primary btn-block">
                                        {{ __('Login') }}
									</button>
								</div>
							</form>
						</div>
					</div>
					<div class="footer">
						Copyright &copy; 2020 &mdash; KALOLA 
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection
