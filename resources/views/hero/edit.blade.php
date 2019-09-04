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
                    <input type="file" class="form-control-file mt-3" onchange="handleFiles(this.files)" name="images[]" id="images" multiple accept="image/*">
                    <a href="#" id="fileSelect">Select some files</a>
                    <div id="fileList"></div>
                </div>
                <?php print_r($hero->images); ?>
                <a href="{{ url()->previous() }}" class="mr-3">Cancel</a>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>

    <script>

        let input = document.querySelector ('#images');

        handleClickImage();

        function handleClickImage() {
           let images = document.querySelectorAll ('.hero-image');
            images.forEach (
                function (currentValue, currentIndex) {
                    currentValue.addEventListener ('click', function (e) {
                        console.log (this);
                        this.parentNode.removeChild (this);

                    });
                });
        }


        input.addEventListener ('change', function (e) {
            console.log (input.files);
        });


        const fileSelect = document.getElementById("fileSelect"),
            fileElem = document.getElementById("fileElem"),
            fileList = document.getElementById("fileList");

        fileSelect.addEventListener("click", function (e) {
            if (fileElem) {
                fileElem.click();
            }
            e.preventDefault(); // prevent navigation to "#"
        }, false);

        function handleFiles(files) {
            if (!files.length) {
                fileList.innerHTML = "<p>No files selected!</p>";
            } else {
                fileList.innerHTML = "";
                const list = document.querySelector(".images-list");
                //fileList.appendChild(list);
                for (let i = 0; i < files.length; i++) {
                    const div = document.createElement("div");
                    div.classList.add('hero-image', 'mr-3', 'mt-3', 'd-inline-block');
                    list.appendChild(div);

                    const img = document.createElement("img");
                    img.src = window.URL.createObjectURL(files[i]);
                    //img.height = 60;
                    img.onload = function() {
                        window.URL.revokeObjectURL(this.src);
                    }
                    div.appendChild(img);

                    /*const info = document.createElement("span");
                    info.innerHTML = files[i].name + ": " + files[i].size + " bytes";
                    div.appendChild(info);*/
                }
            }
            handleClickImage();
        }


    </script>

@endsection