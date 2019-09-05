@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">

            @include('message-info.errors')

            @include('message-info.success')

            <form action="{{route('hero.update', $hero->id)}}" method="post" enctype="multipart/form-data" name="hero">
                @method('PATCH')
                @csrf
                <div class="form-group">
                    <label for="nickname">Nickname:</label>
                    <input type="text" class="form-control" name="nickname" id="nickname" value={{ $hero->nickname }}>
                </div>
                <div class="form-group">
                    <label for="realName">Real Name:</label>
                    <input type="text" class="form-control" name="real_name" id="realName" value={{ $hero->real_name }}>
                </div>
                <div class="form-group">
                    <label for="description">Description:</label>
                    <textarea class="form-control" id="description" rows="3" name="origin_description">{{$hero->origin_description}}</textarea>
                </div>
                <div class="form-group">
                    <label for="superpowers">Superpowers:</label>
                    <textarea class="form-control" id="superpowers" rows="3" name="superpowers">{{$hero->superpowers}}</textarea>
                </div>
                <div class="form-group">
                    <label for="catchPhrase">Catch Phrase:</label>
                    <input type="text" class="form-control" name="catch_phrase" id="catchPhrase" value={{ $hero->catch_phrase }}>
                </div>
                <div class="form-group">
                    <label for="images">Images:</label>
                    <div class="images-list">
                        @foreach($hero->images as $image)
                            <div class="hero-image mr-3 mt-3 d-inline-block">
                                <img src="{{$image}}" alt="{{$hero->nickname}}">
                            </div>
                        @endforeach
                    </div>
                    <input type="file" class="form-control-file mt-3" name="images[]" id="images" multiple accept="image/*">
                </div>
                <a href="{{ route('hero.show', $hero->id) }}" class="mr-3">Cancel</a>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
@endsection