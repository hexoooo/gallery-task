@extends('dashboard.core.app')
@section('title', 'gallery')
@section('content')
    <h1>{{ $gallery->name }} </h1>
<form action="{{ route('galleries.addimage', ['gallery' => $gallery->id]) }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="image">Add Image:</label>
        <input type="file" name="image[]" id="image" class="form-control" multiple>
        <button type="submit" class="btn btn-primary mt-2">Add Image</button>
    </div>
</form>
    @if ($gallery->getMedia())
        <div class="row">
            @foreach ($gallery->getMedia() as $image)
                <div class="col-md-4 mb-3">
                    <img src="{{$image->getUrl() }}" alt="{{ $image->name }}" class="img-thumbnail">
                    <p>{{ $image->name }}</p>
                </div>
            @endforeach
        </div>
@endif
    @endsection