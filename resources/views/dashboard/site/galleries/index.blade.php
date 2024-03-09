@extends('dashboard.core.app')
@section('title', 'galleries')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>glleries</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">galleries</h3>
                            <div class="card-tools">
                                <form action="{{ route('galleries.store') }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <input type="text" name="name" class="form-control form-control-sm mr-3 w-50 "
                                            placeholder="Add new album">
                                        <button type="submit" class="btn  btn-dark btn-sm ">Create new album</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="card-body">

                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Name</th>
                                        <th>Operations</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($galleries as $gallery)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $gallery->name }}</td>
                                            <td>
                                                <div class="operations-btns" style="">
                                                    <a href="{{ route('galleries.show', $gallery->id) }}"
                                                        class="btn  btn-dark">view and edit</a>
                                                    {{-- <a href="{{ route('galleries.show', $gallery->id) }}"
                                                   class="btn  btn-dark">Show')</a> --}}
                                                    <button class="btn btn-danger waves-effect waves-light"
                                                        data-toggle="modal"
                                                        data-target="#delete-modal{{ $loop->iteration }}">Delete
                                                    </button>

                                                    <!-- Delete Modal -->
                                                    <div id="delete-modal{{ $loop->iteration }}" class="modal fade"
                                                        tabindex="-1" role="dialog" aria-labelledby="delete-modal-label"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="delete-modal-label">Delete
                                                                        Album</h5>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    @if ($gallery->getMedia()->count() > 0 && $galleries->count() > 1)
                                                                        <p>Are you sure you want to delete the album and its
                                                                            images?</p>
                                                                        <label for="move-to-gallery">Move images to:</label>
                                                                        <select id="move-to-gallery{{ $loop->iteration }}"
                                                                            class="form-control">
                                                                            @foreach ($galleries as $otherGallery)
                                                                                @if ($otherGallery->id !== $gallery->id)
                                                                                    <option value="{{ $otherGallery->id }}">
                                                                                        {{ $otherGallery->name }}</option>
                                                                                @endif
                                                                            @endforeach
                                                                        </select>
                                                                    @else
                                                                        <p>Are you sure you want to delete the album</p>
                                                                    @endif
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">Close</button>
                                                                    @if ($gallery->getMedia()->count() > 0 && $galleries->count() > 1)
                                                                        <button type="button" class="btn btn-danger"
                                                                            onclick="deleteAndMove({{ $gallery->id }}, $('#move-to-gallery{{ $loop->iteration }}').val())">
                                                                            Delete and Move
                                                                        </button>
                                                                    @endif
                                                                    <form
                                                                        action="{{ route('galleries.destroy', $gallery->id) }}"
                                                                        method="post">
                                                                        @csrf
                                                                        @method('delete')
                                                                        <button type="submit" class="btn btn-danger">
                                                                            Delete
                                                                        </button>
                                                                    </form>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- End Delete Modal -->
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        @include('dashboard.core.includes.no-entries', ['columns' => 5])
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
@section('js_addons')
    <script>
        function deleteAndMove(oldGalleryId, newGalleryId) {
            // Perform AJAX request to delete the album and move images
            $.ajax({
                url: '{{ route('galleries.moveImageDelete') }}',
                type: 'POST',
                data: {
                    oldGalleryId: oldGalleryId,
                    newGalleryId: newGalleryId,
                    _token: '{{ csrf_token() }}'
                },
                success: function(data) {
                    location.reload();
                },
                error: function(xhr, status, error) {
                    // Handle error
                    console.error(error);
                }
            });
        }
    </script>
@endsection
