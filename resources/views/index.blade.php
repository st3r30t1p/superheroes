@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-12">
            <ul class="list-unstyled">
                @foreach($heros as $hero)
                <li class="media mb-4">
                    <div class="hero-image mr-3">
                        <a href="{{route('hero.show', ['hero' => $hero->id])}}" class="d-flex">
                            <img src="{{$hero->images}}" class="mr-3" alt="{{$hero->nickname}}">
                        </a>
                    </div>
                    <div class="media-body">
                        <h5 class="mt-0 mb-1">{{$hero->nickname}}</h5>
                        {{$hero->catch_phrase}}
                    </div>
                </li>
                @endforeach
            </ul>
            {{ $heros->links() }}
        </div>
    </div>
@endsection
