@extends('layouts.html')

@section('title', 'Home')

@section('body')
    @component('components.navbar')
    @endcomponent
    <div class="container">
        <div>
            <div class="d-flex justify-content-start flex-wrap">
                @foreach ($users as $user)
                    {{-- <div class="col-xs-12 col-md-6 col-lg-3"> --}}
                    @component('components.profile-card')
                        @slot('id')
                            {{ $user->id }}
                        @endslot
                        @slot('src')
                            {{ Storage::url($user->avatar) }}
                        @endslot
                        @slot('name')
                            {{ $user->first_name }} {{ $user->last_name }}
                        @endslot
                        @slot('description')
                            {{ $user->description }}
                        @endslot
                        @slot('createdAt')
                            {{ $user->created_at }}
                        @endslot
                    @endcomponent
                    {{-- </div> --}}
                @endforeach
            </div>
        </div>
        <div class="container">
            {{ $users->links() }}
        </div>
    </div>
@endsection