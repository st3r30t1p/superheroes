@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="media">
                <div class="hero-image mr-3">
                    <div class="row">
                        @foreach($hero->images as $image)
                            <div class="col-12">
                                <img src="{{$image}}" class="mr-3 mb-3" alt="{{$hero->nickname}}">
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="media-body">
                    <div class="mb-3">Nickname: <h4 class="d-inline">{{$hero->nickname}}</h4></div>
                    <div class="mb-3">Real Name: <h5 class="d-inline">{{$hero->real_name}}</h5></div>
                    <div class="mb-3">Super Powers: <p class="d-inline">{{$hero->superpowers}}</p></div>
                    <div class="mb-3">Description: <p class="d-inline">{{$hero->origin_description}}</p></div>
                </div>
            </div>
            <a href="{{ route('hero.index') }}" class="mr-3">Cancel</a>
            @if(\Auth::check())
                <a href="{{route('hero.edit', $hero->id)}}" class="btn btn-primary">Edit</a>
                <form action="{{ route('hero.destroy', $hero->id)}}" method="post" class="d-inline-block">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" type="submit">Delete</button>
                </form>
            @endif
        </div>
    </div>
@endsection
