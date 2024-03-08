<?php

namespace App\Repository;

interface GalleryRepositoryInterface extends RepositoryInterface
{
    public function addImage($modelId, array $images = []);
    public function deleteImage($galleryId, $imageId);
    public function deleteMoveImage($old_gallery, $new_gallery);

}
