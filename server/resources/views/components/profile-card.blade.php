<div class="card profile mb-5 mt-5 mx-auto w-25">
	<a href="/user/{{ $id }}">
		<img src="{{ $src }}" class="card-img-top" alt="{{ $name }}">
		<div class="card-body">
		<h5 class="card-title">{{ $name }}</h5>
			<p class="card-text">{{ $description }}</p>
			<p class="card-text"><small class="text-muted">{{ $createdAt }}</small></p>
		</div>
	</a>
</div>