<?php

namespace App\Http\Services\Dashboard\Gallery;

use App\Http\Traits\FileManager;
use App\Models\Gallery;
use App\Repository\GalleryRepositoryInterface;
use Illuminate\Support\Facades\DB;

class GalleryService
{
    use FileManager;
    public function __construct(private readonly GalleryRepositoryInterface $gallery_repository)
    {
    }

    public function index()
    {
        $albums = $this->gallery_repository->paginate(25);
        return view('dashboard.site.galleries.index', compact('albums'));
    }
    public function store($request)
    {
        $this->gallery_repository->create($request->validated());
        return redirect()->route('galleries.index')->with(['success' => 'new album added successfully']);
    }
    public function show($id)
    {
        $gallery = $this->gallery_repository->getById($id);
        return view('dashboard.site.galleries.show', compact('gallery'));
    }
    public function edit($id)
    {
        $gallery = $this->gallery_repository->getById($id);
        return view('dashboard.site.galleries.edit', compact('gallery'));
    }

    public function update($request, $id)
    {
        $this->gallery_repository->update($id, $request->validated());
        // dd($this->gallery_repository->getById($id));
        return redirect()->route('galleries.index')->with(['success' => 'album updated successfully']);
    }

    public function destroy($id)
    {
        $this->gallery_repository->delete($id);
        return redirect()->route('galleries.index')->with(['success' => 'album deleted successfully']);
    }
    public function addImage($id, $request)
    {
        $this->gallery_repository->addImage($id, $request->image);
        return redirect()->route('galleries.index')->with(['success' => 'image added successfully']);
    }
    public function deleteImage($gallery_id, $image_id)
    {
       return $this->gallery_repository->deleteImage($gallery_id, $image_id);
    }
    public function deleteMoveImage($old_gallery, $new_gallery)
    {
       return $this->gallery_repository->deleteMoveImage($old_gallery, $new_gallery);
    }
}
