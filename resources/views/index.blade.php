@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-12">

            @if(session()->get('success'))
                <div class="alert alert-success text-center">
                    {{ session()->get('success') }}
                </div>
            @endif

            <ul class="list-unstyled">
                @foreach($heros as $hero)
                    <li class="media mb-4">
                        <div class="hero-image mr-3">
                            <a href="{{route('hero.show', ['hero' => $hero->id])}}" class="d-flex">
                                <img src="{{$hero->images[0]}}" class="mr-3" alt="{{$hero->nickname}}">
                            </a>
                        </div>
                        <div class="media-body">
                            <h5 class="mt-0 mb-1">{{$hero->nickname}}</h5>
                            {{$hero->catch_phrase}}
                        </div>
                    </li>
                @endforeach
            </ul>
            @if(\Auth::check())
                <div class="d-flex">
                    <a href="{{route('hero.create')}}" class="btn btn-primary mx-auto">Add new</a>
                </div>
            @endif
            <div class="mt-4 mb-4">
                {{ $heros->links() }}
            </div>
        </div>
    </div>
@endsection
