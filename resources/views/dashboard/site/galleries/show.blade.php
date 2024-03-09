@extends('dashboard.core.app')
@section('title', 'gallery')
@section('content')
    <h1><a href="{{ route('galleries.index') }}" class="text-decoration-none">galleries</a>/{{ $gallery->name }} gallery </h1>

    {{-- <div class="row mb-3 ml-3 justify-content-left align-items-right flex-start mt-3 "> --}}
    <form action="{{ route('galleries.addimage', ['gallery' => $gallery->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group mb-3 ml-3 justify-content-left align-items-right flex-start mt-3 ">
            <label for="image">Add Image:</label>
            <div class="row  ">
                <input type="file" name="image[]" id="image" class="form-control form-control-sm mr-3 w-50 " multiple>
                <button type="submit" class="btn btn-primary btn-sm">Add Image</button>
            </div>
        {{-- </div> --}}
    </form>
</div>

    <form action="{{ route('galleries.update', ['gallery' => $gallery->id]) }}" method="post">
        @csrf
        @method('PUT')
        <div class="row mb-3 ml-3 justify-content-left align-items-right flex-start mt-3 ">
            <label for="image">change album name:</label>
        </div>
        <div class="row mb-3 ml-3 justify-content-left align-items-right flex-start mt-3 ">
            <input type="text" name="name" value="{{ $gallery->name }}">
            <button class="btn btn-primary btn-sm ml-3">Edit
                name</button>
        </div>
    </form>
    @if ($gallery->getMedia())
        <div class="row">
            @foreach ($gallery->getMedia() as $image)
                <div class="col-md-4 mb-3">
                    <form action="{{ route('galleries.deleteImage', ['gallery' => $gallery->id, 'id' => $image->id]) }}"
                        method="post">
                        @csrf
                        <button
                            class="delete-image btn btn-danger btn-sm position-absolute top-0 start-50 translate-middle-x"
                            type="submit">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </form>
                    <img src="{{ $image->getUrl() }}" alt="{{ $image->name }}"
                        class="img-thumbnail object-fit-cover rounded mb-1" width="200" height="200">
                    <form
                        action="{{ route('galleries.ChangeImageName', ['gallery_id' => $gallery->id, 'image_id' => $image->id]) }}"
                        method="post">
                        @csrf

                        <input type="text" value="{{ $image->name }} "name='name'></input> <button type="submit"
                            class="btn btn-primary btn-sm mb-1">change image name </button>
                    </form>
                </div>
            @endforeach
        </div>
    @endif
@endsection
