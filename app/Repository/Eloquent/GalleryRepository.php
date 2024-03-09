<?php

namespace App\Repository\Eloquent;

use App\Models\User;
use App\Models\Gallery;
use Illuminate\Database\Eloquent\Model;
use App\Repository\GalleryRepositoryInterface;

class GalleryRepository extends Repository implements GalleryRepositoryInterface
{
    protected Model $model;

    public function __construct(Gallery $model)
    {
        parent::__construct($model);
    }
    public function addImage($modelId, array $images = [])
    {
        $model = $this->getById($modelId);
        foreach ($images as $image) {
            $model->addMedia($image)->toMediaCollection();
        }
    }
    public function deleteImage($galleryId, $imageId)
    {
        $model = $this->getById($galleryId);
        $image = $model->getMedia()->find($imageId);

        if ($image) {

            $image->delete();
        }
    }
    public function deleteMoveImage($old_gallery_id, $new_gallery_id)
    {
        $model = $this->getById($old_gallery_id);
        $new_gallery = $this->getById($new_gallery_id);
        $images = $model->getMedia();

        if ($images) {
            foreach ($images as $image) {

                $image->move($new_gallery);
            }
            $model->delete();
            return response()->json(['success' => true, 'message' => 'Images moved successfully']);
        }

        return response()->json(['success' => false]);
    }
    public function changeImageName($gallery_id, $image_id, $name)
    {

        $model = $this->getById($gallery_id);
        $image = $model->getMedia()->find($image_id);
        $image->update(['name' => $name]);
    }
}
