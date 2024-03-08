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
            <button type="submit" class="btn btn-success">Create Album</button>
        </form>

        <hr>

        {{-- Display existing albums and images --}}
        @isset($albums)
            @foreach ($albums as $album)
                <div class="card mt-3">
                    <div class="row">
                        <form class="form-inline mt-2 mb-2 col-md-10" enctype="multipart/form-data"
                            action="{{ route('galleries.update', ['gallery' => $album->id]) }}" method="POST">
                            <input class="form-control mr-sm-2 mt-2 mb-2 col-md-6" type="text" name="name"
                                value="{{ $album->name }}">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-primary ml-2">Edit Album Name</button>
                        </form>
                        <form class="form-inline mt-2 mb-2 col-md-2" enctype="multipart/form-data"
                            action="{{ route('galleries.show', ['gallery' => $album->id]) }}" method="get">
                            <button type="submit" class="btn btn-primary mt-2 mb-2 col-md-12">View Album</button>
                        </form>
                    </div>
                    <div class="card-body">
                        @if ($album->getMedia())
                            <div class="row">
                                @foreach ($album->getMedia() as $image)
                                    <div class="col-md-4 image mb-3 position-relative">
                                        <!-- Trash button above the image -->
                                        <button
                                            class="delete-image btn btn-danger btn-sm position-absolute top-0 start-50 translate-middle-x"
                                            data-image-id="{{ $image->id }}" data-gallery-id="{{ $album->id }}">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>

                                        <!-- Image -->
                                        <img src="{{ $image->getUrl() }}" alt="{{ $image->name }}" class="img-thumbnail"
                                            style="max-width: 200px; max-height: 200px;">
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                    <div class="row mt-2">
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteAlbumModal"
                                data-gallery-id="{{ $album->id }}">
                            Delete Album
                        </button>
                        <button type="button" class="btn btn-warning ml-2" data-toggle="modal"
                                data-target="#moveImageModal" data-gallery-id="{{ $album->id }}">
                            Move Images
                        </button>
                    </div>
                </div>
                <hr>
            @endforeach
        @endisset
    </div>

    <!-- Delete Album Modal -->
    <div class="modal fade" id="deleteAlbumModal" tabindex="-1" role="dialog" aria-labelledby="deleteAlbumModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteAlbumModalLabel">Delete Album Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this album?
                </div>
                <div class="modal-footer">
                    <form id="deleteAlbumForm" class="delete-album-form" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Delete Album</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Move Image Modal -->
    <div class="modal fade" id="moveImageModal" tabindex="-1" role="dialog" aria-labelledby="moveImageModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="moveImageModalLabel">Move Images to Another Album</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="moveImageForm" action="" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="destinationAlbum">Select Destination Album:</label>
                            <select class="form-control" id="destinationAlbum" name="destination_album_id">
                                @foreach ($albums as $destinationAlbum)
                                    <option value="{{ $destinationAlbum->id }}">{{ $destinationAlbum->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" id="moveImageBtn" class="btn btn-warning">Move Images</button>
                </div>
            </div>
        </div>
    </div>

    @endsection

    @section('js_addons')
    <script>
        var imageId, galleryId, deleteButton;

        // jQuery code for making an AJAX request when delete button is clicked
        $('.delete-image').on('click', function () {
            imageId = $(this).data('image-id');
            galleryId = $(this).data('gallery-id');
            deleteButton = $(this);

            $('#deleteAlbumModal').modal('show');
        });

        // Set the delete album form action dynamically based on the clicked album
        $('#deleteAlbumModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var galleryId = button.data('gallery-id');
            var modal = $(this);
            modal.find('.delete-album-form').attr('action', function () {
                return '{{ route('galleries.destroy', ['gallery' => ':galleryId']) }}'.replace(':galleryId', galleryId);
            });
        });

        // Set the move image form action dynamically based on the clicked album
        $('#moveImageModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var destinationGalleryId = button.data('gallery-id');
            var modal = $(this);
            modal.find('#moveImageForm').attr('action', function () {
                return '{{ route('galleries.moveImage', ['new_gallery' => ':destinationGalleryId', 'old_gallery' => ':galleryId']) }}'.replace(':galleryId', galleryId).replace(':destinationGalleryId', destinationGalleryId);
            });
        });

        // Handle move image button click
        $('#moveImageBtn').on('click', function () {
            // Get the selected destination album ID
            var destinationAlbumId = $('#destinationAlbum').val();
            // Make AJAX request to move the image
            $.ajax({
                type: 'POST',
                url: $('#moveImageForm').attr('action'),
                data: {
                    _token: '{{ csrf_token() }}',
                    image_id: imageId,
                    source_gallery_id: galleryId,
                    destination_gallery_id: destinationAlbumId
                },
                success: function (response) {
                    if (response.success) {
                        console.log('Image moved successfully');
                        // Remove the image container from the UI
                        deleteButton.parent().remove();
                    } else {
                        console.log('Failed to move image: ' + response.message);
                    }
                },
                error: function (error) {
                    console.log('Error moving image: ' + error);
                }
            });
            // Hide the modal
            $('#moveImageModal').modal('hide');
        });
    </script>
    @endsection
</script>
