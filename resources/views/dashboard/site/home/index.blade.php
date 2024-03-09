@extends('dashboard.core.app')
@section('title', 'home')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>welcome to your gallery home</h1>
                    <div class="card-body">
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-lg-3 col-6">

                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{$galleries->count()}}</h3>
                        <p>total gallries</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-images"></i>

                    </div>
                    <a href="{{ route('galleries.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
@endsection
