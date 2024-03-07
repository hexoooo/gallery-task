<?php

namespace App\Models;

use App\Models\Image;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Gallery extends Model
{
    use HasFactory;
    protected $table = 'galleries';

    public function images()
    {
        return $this->hasMany(Image::class);
    }
}
