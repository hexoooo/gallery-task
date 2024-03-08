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
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false]);

    }
    public function deleteMoveImage($old_gallery, $new_gallery)
    {
        $model = $this->getById($old_gallery);
        $images = $model->getMedia();

        if ($images) {
            foreach ($images as $image) {

                $image->move($new_gallery);
                
            }
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false]);

    }
}
