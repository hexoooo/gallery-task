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
}
