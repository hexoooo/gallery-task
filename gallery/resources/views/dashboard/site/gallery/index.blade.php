@extends('dashboard.core.app')

@section('content')
    <div class="container">
        <h2>Gallery</h2>

        {{-- Display a form for creating a new album --}}
        <form action="{{ route('gallery.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="album_name">Album Name:</label>
                <input type="text" name="album_name" id="album_name" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Create Album</button>
        </form>

        <hr>

        {{-- Display existing albums and images --}}
        @isset($albums)
            @foreach ($albums as $album)
                <div class="card">
                    <div class="card-header">
                        {{ $album->name }}
                    </div>
                    <div class="card-body">@isset($gallery->images)
                        
                        @foreach ($gallery->images as $image)
                        <img src="{{ $image->getUrl() }}" alt="{{ $image->name }}" class="img-thumbnail"
                        style="max-width: 150px; max-height: 150px;">
                        @endforeach
                        @endisset


                        <form action="{{ route('images.edit', ['image' => $album->id]) }}" class="dropzone" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                        </form>

                        <form action="{{ route('gallery.destroy', ['gallery' => $album->id]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger mt-2">Delete Album</button>
                        </form>
                    </div>
                </div>
                <hr>
            @endforeach
        @endisset

    </div>
@endsection
@section('js_addons')
<script>
    Dropzone.autoDiscover = false;
    $(document).ready(function () {
        $(".dropzone").dropzone({
            paramName: "image",
            maxFilesize: 5,
            acceptedFiles: "image/*",
            init: function () {
                this.on("success", function (file, response) {
                    // Handle success
                    console.log(response);
                });

                this.on("error", function (file, response) {
                    // Handle errors
                    console.log(response);
                });

                this.on("removedfile", function (file) {
                    // Handle file removal
                    $.ajax({
                        type: 'POST',
                        url: '{{ route("gallery.remove", ["image" => $image->id]) }}',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function (data) {
                            console.log(data);
                        },
                        error: function (error) {
                            console.log(error);
                        }
                    });
                });
            }
        });
    });
</script>
@endsection
