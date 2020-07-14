@extends('layouts.app')

@section('content')

<body class="bg-gradient-primary">
<center><div class="limiter">
        
        <!-- @error('email')
            <div class='alert alert-danger alert-dismissible'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Gagal!</strong> Email atau Password salah.</div>
        @enderror
        @error('password')
            <div class='alert alert-danger alert-dismissible'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong></i> Gagal!</strong> Email atau Password salah.</div>
        @enderror -->
    <div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<br>
					<img src="{{ asset('images/book-shop.png') }}" alt="IMG">
				</div>

		<form class="login100-form validate-form" action="{{ route('login') }}" method="POST" novalidate>
        @csrf
			<span class="login100-form-title" style="margin-top: 30px">Login</span>

			<div class="wrap-input100 validate-input">
				<input class=" form-control @error('email') is-invalid @enderror" placeholder="Email" id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
				<!-- <span class="focus-input100"></span>
				<span class="symbol-input100">
					<i class="fa fa-envelope" aria-hidden="true"></i>
				</span> -->
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
			</div>

			<div class="wrap-input100 validate-input">
				<input placeholder="Password" id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
				<!-- <span class="focus-input100"></span>
				<span class="symbol-input100">
					<i class="fa fa-lock" aria-hidden="true"></i>
				</span> -->
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
			</div>

            <div class="container-login100-form-btn">
                <div class="form-group row">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                        <label class="form-check-label" for="remember">{{ __('Remember Me') }}</label>
                    </div>
                </div>

                <div class="container-login100-form-btn">
                    <button type="submit" class="login100-form-btn">{{ __('Login') }}</button>
                </div>

            @if (Route::has('password.request'))
                <div class="text-center p-t-30">
                    <a class="txt2" href="{{ route('password.request') }}">{{ __('Forgot Your Password?') }}</a>
                </div>
            @endif
            </div><br>
            <!-- <br><label>{{ __('Sign in With Your Account') }}</label><br> -->
            <a href="{{ url('/auth/google') }}" class="btn btn-google"><i class="fa fa-google"></i>{{ __(' Sign in With Your Google Account') }}</a>
            <!-- <a href="{{ url('/auth/github') }}" class="btn btn-light"><i class="fa fa-github"></i></a>
            <a href="{{ url('/auth/facebook') }}" class="btn btn-facebook"><i class="fa fa-facebook"></i></a> -->
		</form>
	</div>
</div></center>
</body>


<!-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

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
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> -->
@endsection
