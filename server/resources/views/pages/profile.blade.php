@extends('layouts.html')

@section('title', "$user->first_name $user->last_name")

@section('headers')
	<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
@endsection

@section('body')
    @component('components.navbar')
		@endcomponent
		<div id="profile"
			@if (Auth::check())
				data-auth='{{ auth()->user()->id === $user->id ? true : false  }}'
			@endif
			data-avatar='{{ asset(Storage::url($user->avatar)) }}'
			data-first_name='{{ $user->first_name }}'
			data-last_name='{{ $user->last_name }}'
			data-email='{{ $user->email }}'
			data-description='{{ $user->description }}'
		></div>
@endsection