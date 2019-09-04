@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="m-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{route('hero.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="nickname">Nickname:</label>
                    <input type="text" class="form-control" name="nickname" id="nickname">
                </div>
                <div class="form-group">
                    <label for="realName">Real Name:</label>
                    <input type="text" class="form-control" name="real_name" id="realName">
                </div>
                <div class="form-group">
                    <label for="description">Description:</label>
                    <textarea class="form-control" id="description" rows="3" name="origin_description"></textarea>
                </div>
                <div class="form-group">
                    <label for="superpowers">Superpowers:</label>
                    <textarea class="form-control" id="superpowers" rows="3" name="superpowers"></textarea>
                </div>
                <div class="form-group">
                    <label for="catchPhrase">Catch Phrase:</label>
                    <input type="text" class="form-control" name="catch_phrase" id="catchPhrase">
                </div>
                <div class="form-group">
                    <label for="images">Images:</label>
                    <input type="file" class="form-control-file" name="images[]" id="images" multiple>
                </div>
                <a href="{{ url()->previous() }}" class="mr-3">Cancel</a>
                <button type="submit" class="btn btn-primary">Create</button>
            </form>
        </div>
    </div>
@endsection