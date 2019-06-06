@extends('layouts.html')

@section('title', 'Success!')

@section('body')
<div class="container mt-5">
	<div class="jumbotron">
		<h1 class="display-4">Congratulations  {{ $user->first_name }}</h1>
		<p class="lead">You have successfully registered to our application.</p>
		<hr class="my-4">
		<a class="btn btn-primary btn-lg" href="{{ route('home') }}" role="button">Home</a>
	</div>
</div>
@endsection