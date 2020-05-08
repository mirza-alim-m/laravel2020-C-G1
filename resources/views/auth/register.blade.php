@extends('layouts.app')

@section('content')

<body class="bg-gradient-primary">
<center><div class="limiter">
    <div class="container-login100">
            @error('name')
                <div class='alert alert-danger alert-dismissible'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                    <strong>{{ $message }}</strong>
                </div>
            @enderror

            @error('email')
                <div class='alert alert-danger alert-dismissible'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                    <strong>{{ $message }}</strong>
                </div>
             @enderror
            @error('password')
                <div class='alert alert-danger alert-dismissible'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                    <strong>{{ $message }}</strong>
                </div>
            @enderror

			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<br>
					<img src="{{ asset('images/book-shop.png') }}" alt="IMG">
				</div>

		<form class="login100-form validate-form" action="{{ route('register') }}" method="POST">
        @csrf
			<span class="login100-form-title"style="margin-top: 30px">Tambah Akun</span>

            <div class="wrap-input100 validate-input">
				<input class="input100" placeholder="Nama" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
				<span class="focus-input100"></span>
				<span class="symbol-input100">
					<i class="fa fa-user" aria-hidden="true"></i>
				</span>
			</div>

			<div class="wrap-input100 validate-input">
				<input class="input100" placeholder="Email" id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
				<span class="focus-input100"></span>
				<span class="symbol-input100">
					<i class="fa fa-envelope" aria-hidden="true"></i>
				</span>
			</div>

			<div class="wrap-input100 validate-input">
				<input class="input100" placeholder="Password" id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
				<span class="focus-input100"></span>
				<span class="symbol-input100">
					<i class="fa fa-lock" aria-hidden="true"></i>
				</span>
			</div>

            <div class="wrap-input100 validate-input">
				<input class="input100" placeholder="Password Confirm" id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
				<span class="focus-input100"></span>
				<span class="symbol-input100">
					<i class="fa fa-lock" aria-hidden="true"></i>
				</span>
			</div>

            <div class="container-login100-form-btn">
                <button type="submit" class="login100-form-btn">{{ __('Register') }}</button>
            </div>
		</form>
	</div>
</div></center>
</body>


<!-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> -->
@endsection
