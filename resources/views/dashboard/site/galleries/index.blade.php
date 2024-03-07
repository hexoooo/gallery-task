@extends('dashboard.core.app')

@section('content')
    <div class="container">
        <h2>Gallery</h2>

        {{-- Display a form for creating a new album --}}
        <form action="{{ route('galleries.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="album_name">Album Name:</label>
                <input type="text" name="name" id="album_name" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Create Album</button>
        </form>

        <hr>

        {{-- Display existing albums and images --}}
        @isset($albums)
            @foreach ($albums as $album)
                <div class="card">
                    <div class="card-header" contenteditable="true" data-name-type="album">
                        {{ $album->name }}
                    </div>
                    <div class="card-body">
                        @isset($album->images)
                            @foreach ($album->images as $image)
                                <div class="image-container" data-image-id="{{ $image->id }}">
                                    <img src="{{ $image->getUrl() }}" alt="{{ $image->name }}" class="img-thumbnail"
                                        style="max-width: 150px; max-height: 150px;">
                                    <button class="delete-image btn btn-danger mt-2">Delete Image</button>
                                </div>
                            @endforeach
                        @endisset

                        <form action="{{ route('images.store') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="file" name="image[]" id="image" class="form-control" multiple>
                            <button type="submit" class="btn btn-primary mt-2">Upload Image</button></button>
                        </form>

                        <form action="{{ route('galleries.destroy', ['gallery' => $album->id]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger mt-2">Delete Album</button>
                        </form>
                        <form action="{{ route('galleries.edit', ['gallery' => $album->id]) }}" method="POST">
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
@endsection
