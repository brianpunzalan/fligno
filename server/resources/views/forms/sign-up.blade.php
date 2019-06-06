@extends('layouts.html')

@section('title', 'Register')

@section('headers')
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.1/cropper.min.css" />
	<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('body')
	<div class="container mt-5">
	@component('components.card')
		@slot('header')
			{{ __('Sign Up') }}
		@endslot
		<form action="{{ route('register.submit') }}" enctype="multipart/form-data" method="POST">
			@csrf
			<div id="avatar">
			</div>
			<div class="form-group">
				<label for="first_name">First Name</label>
				<input type="text" class="form-control" id="first_name" name="first_name" placeholder="Enter your First Name" required>
			</div>
			<div class="form-group">
					<label for="last_name">Last Name</label>
					<input type="text" class="form-control" id="last_name" name="last_name" placeholder="Enter your Last Name" required>
			</div>
			<div class="form-group">
				<label class="d-block">Gender</label>
				<div class="form-check form-check-inline">
					<input class="form-check-input" type="radio" id="genderMale" name="gender" value="Male" checked>
					<label class="form-check-label" for="genderMale">
						Male
					</label>
				</div>
				<div class="form-check form-check-inline">
					<input class="form-check-input" type="radio" id="genderFemale" name="gender" value="Female">
					<label class="form-check-label" for="genderFemale">
						Female
					</label>
				</div>
				<div class="form-check form-check-inline">
					<input class="form-check-input" type="radio" id="genderOthers" name="gender" value="Others">
					<label class="form-check-label" for="genderOthers">
						Others
					</label>
				</div>
			</div>
			<div class="form-group">
				<label for="email">Email address</label>
				<input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Enter email" required>
				<small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
			</div>
			<div class="form-group">
					<label for="description">About yourself</label>
					<textarea rows="5" class="form-control" id="description" name="description" placeholder="Tell me about yourself"></textarea>
			</div>
			<div class="form-group">
				<label for="password">Password</label>
				<input type="password" class="form-control" id="password" name="password" placeholder="Password" aria-describedby="passwordHelp" required>
				<small id="passwordHelp" class="form-text text-muted">Rest assured that we would not anything what you typed in here.</small>
			</div>
			<button type="submit" class="btn btn-primary">Submit</button>
		</form>
		@slot('footer')
			By signing up, you indicate that you have read and agreed to Fligno's 
			<a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a>
		@endslot
	@endcomponent
	</div>
@endsection

{{-- @section('scripts')
	<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.1/cropper.min.js"></script>
	<script>
		function toggleContainer() {
			const cropperContainer = document.getElementById('cropper-container');
			const avatarContainer = document.getElementById('avatar-container');
			avatarContainer.classList.toggle('d-none');
			cropperContainer.classList.toggle('d-none');
		}

		{
			function handleAvatarCancel() {
				toggleContainer();
			}

			function handleAvatarSave() {
				console.log('save');
				toggleContainer();
			}
		}

		{
			const avatar = document.getElementById('avatar');
			avatar.addEventListener('change', function(e)	{
				const file = e.target.files[0];
				const fileReader = new FileReader();
				const image = document.getElementById('cropper-image');
				const cropperContainer = document.getElementById('cropper-container');
				const avatarContainer = document.getElementById('avatar-container');
				const resultingImage = document.getElementById('cropper-resulting-image');
				let cropper = null;

				// switch container view
				toggleContainer();

				console.log('changed', file, image)

				if (file) {
					fileReader.readAsDataURL(file);
				}

				fileReader.addEventListener("load", function(e) {
					console.log('loaded')
					image.src = fileReader.result;
					cropper = new Cropper(image, {
						aspectRatio: 1 / 1,
						crop(event) {
							console.log(cropper.getCroppedCanvas());
							resultingImage.src = cropper.getCroppedCanvas().toDataURL;
						}
					});
				});
			})
		}

		{
			const form = document.getElementsByTagName('form');
			form.addEventListener('submit', function (e) {
				console.log(e);
				return true;
			})
		}
	</script>
@endsection --}}