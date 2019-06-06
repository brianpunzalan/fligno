@extends('layouts.html')

@section('title', "$user->first_name $user->last_name")

@section('headers')
	<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
@endsection

@section('body')
    @component('components.navbar')
		@endcomponent
		<div id="profile">
			<div class="container-fluid">
				<div class="row">
					<div class="col-sm-12 col-md-4 border-right">
					<div class="container">
						<img class="img-thumbnail rounded-circle mt-5 mx-auto d-block" src="{{ asset(Storage::url($user->avatar)) }}">
					</div>
					</div>
					<div class="col-sm-12 col-md-8">
						<div id="personal-information" class="mt-5 text-center text-md-left">
							<h1 class="display-2">{{ $user->first_name }} {{ $user->last_name }}</h1>
							<div>
								<a href="mailto:{{ $user->email}}">
									<i class="fa fa-envelope"></i>
									<span>{{ $user->email }}</span>
								</a>
							</div>
							<div class="jumbotron jumbotron-fluid mt-5 p-5">
								<div class="container">
									<h1 class="display-5">About Me</h1>
									<p class="lead">{{ $user->description }}</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
@endsection