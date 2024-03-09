<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use App\Http\Requests\ImageRequest;
use App\Http\Requests\GalleryRequest;
use App\Http\Requests\ImageNameRequest;
use App\Http\Services\Dashboard\Gallery\GalleryService;

class GalleryController extends Controller
{
    public function __construct(private readonly GalleryService $gallery_service)
    {
    }
    public function index()
    {
        return $this->gallery_service->index();
    }
    public function store(GalleryRequest $request)
    {
        return $this->gallery_service->store($request);
    }

    public function show($id)
    {
        return $this->gallery_service->show($id);
    }

    public function edit($id)
    {

        return $this->gallery_service->edit($id);
    }

    public function update($id, GalleryRequest $request)
    {
        return $this->gallery_service->update($request, $id);
    }
    public function destroy($id)
    {
        return $this->gallery_service->destroy($id);
    }

    public function addImage($id, ImageRequest $request)
    {

        return $this->gallery_service->addImage($id, $request);
    }
    public function deleteImage($gallery_id, $image_id)
    {
        return $this->gallery_service->deleteImage($gallery_id, $image_id);
    }
    public function deleteMoveImage(Request $request)
    {
      return $this->gallery_service->deleteMoveImage($request);
    }
    public function changeImageName($gallery_id, $image_id, ImageNameRequest $request)
    {
        return $this->gallery_service->changeImageName($gallery_id, $image_id, $request);
    }
}
