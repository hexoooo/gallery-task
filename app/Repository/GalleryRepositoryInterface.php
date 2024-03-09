<?php

namespace App\Repository;

interface GalleryRepositoryInterface extends RepositoryInterface
{
    public function addImage($modelId, array $images = []);
    public function deleteImage($galleryId, $imageId);
    public function deleteMoveImage($old_gallery_id, $new_gallery_id);
    public function changeImageName($gallery_id, $image_id, $name);
}
