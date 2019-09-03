@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="media">
                <div class="hero-image mr-3">
                    <img src="{{$hero->images}}" class="mr-3" alt="{{$hero->nickname}}">
                </div>
                <div class="media-body">
                    <h5 class="mt-0">{{$hero->nickname}}</h5>
                    <h6 class="mt-0">{{$hero->real_name}}</h6>
                    <p>{{$hero->superpowers}}</p>
                    <p>{{$hero->origin_description}}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
