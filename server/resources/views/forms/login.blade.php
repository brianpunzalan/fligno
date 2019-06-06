@extends('layouts.html')

@section('title', 'Login')

@section('body')
	<div class="container mt-5">
	@component('components.card')
		@slot('header')
				{{ __('Login') }}
		@endslot
		<form action="{{ route('login') }}" method="post">
			@csrf
			<div class="form-group">
				<label for="email">Email address</label>
				<input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" aria-describedby="emailHelp" placeholder="Enter email">
				<small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
				@error('email')
					<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
					</span>
				@enderror
			</div>
			<div class="form-group">
				<label for="password">Password</label>
				<input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" placeholder="Password">
				@error('password')
					<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
					</span>
				@enderror
			</div>
			<div class="form-group form-check">
				<input type="checkbox" name="remember" id="remember" class="form-check-input" {{ old('remember') ? 'checked' : '' }}>
				<label class="form-check-label" for="remember">{{ __('Remember Me')}}</label>
			</div>
			<button type="submit" class="btn btn-primary">{{ __('Login') }}</button>
			@if (Route::has('password.request'))
				<a class="btn btn-link" href="{{ route('password.request') }}">
						{{ __('Forgot Your Password?') }}
				</a>
			@endif
		</form>
		@slot('footer')
			If you have time please review our <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a>. It may help you get to know more about the application.
		@endslot
	@endcomponent
	</div>
@endsection