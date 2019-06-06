<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
	<a class="navbar-brand" href="/">Fligno</a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>

	<div class="collapse navbar-collapse" id="navbarSupportedContent">
		<form class="form-inline my-2 my-lg-0 w-75 justify-content-end" action="/search" method="get">
			@csrf
			<input class="form-control mr-sm-2 w-75" type="search" name="q" placeholder="Search" aria-label="Search">
			<button class="btn btn-success my-2 my-sm-0" type="submit">Search</button>
		</form>
		<ul class="navbar-nav ml-auto mt-2 mt-lg-0">
			@guest
				@if (Route::has('login'))
					<li class="nav-item active">
						<a class="nav-link" href="{{ route('login') }}">Login <span class="sr-only">(current)</span></a>
					</li>
					@if (Route::has('register'))
						<li class="nav-item">
							<a class="nav-link" href="{{ route('register') }}">Register</a>
						</li>
					@endif
				@endif
			@else
			<li class="nav-item dropdown">
					<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
							{{ Auth::user()->first_name }} {{ Auth::user()->last_name }} <span class="caret"></span>
					</a>

					<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
							<a class="dropdown-item" href="{{ route('user.profile', ['id' => Auth::user()->id]) }}">
								{{ __('Profile') }}
							</a>
							<a class="dropdown-item" href="{{ route('logout') }}"
								 onclick="event.preventDefault();
															 document.getElementById('logout-form').submit();">
									{{ __('Logout') }}
							</a>

							<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
									@csrf
							</form>
					</div>
			</li>
			@endguest
		</ul>
	</div>
</nav>